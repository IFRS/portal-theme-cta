<?php
function repositorio_query_construct($args){
    $sql = "
            SELECT SQL_CALC_FOUND_ROWS wp_posts.* __tagmatches__ __termsmatches__
                                    __tags__
            FROM wp_posts
            __joincategory__
            __jointags__
            WHERE
                (__wherecategory__ AND __wheretags__)
                AND __whereterms__
                AND  wp_posts.post_type = 'recurso-ta'
                AND (wp_posts.post_status = 'publish')
            GROUP BY wp_posts.ID
            ORDER BY __matchorder__  wp_posts.post_date DESC
            LIMIT __paged__, __perpage__
        ";

    $countTerms = array(
        'title' => array(
            'full' => array(),
            'words' => array()
        ),
        'content' => array(
            'full' => array(),
            'words' => array()
        ),
        'tags' => array(),
    );

    /** Filtro de categorias **/
    $joincategory = '';
    $wherecategory = '';
    repositorio_query_categoria($args, $joincategory, $wherecategory);

    /** Busca por tags **/
    $tagMatches = '';
    $jointags = '';
    $wheretags = '';
    $orderTag = '';
    $tags = '';
    repositorio_query_tags($args, $tagMatches, $jointags, $wheretags, $orderTag, $countTerms, $tags);

    /** Busca por termos digitados pelo usuário */
    $whereterms = '';
    $orderterms = '';
    $termsmatches = '';
    repositorio_query_termos($args, $whereterms, $orderterms, $termsmatches, $countTerms);

    $bestMatch = repositorio_query_bestMatch($countTerms);


    if(isset($args['paged']))
        $paged = $args['paged'] - 1;
    else
        $paged = 0;

    if(isset($args['posts_per_page']))
        $perpage = $args['posts_per_page'];
    else
        $perpage = '';


    $search = array('__joincategory__', '__jointags__', '__wherecategory__', '__wheretags__',
                    '__whereterms__', '__paged__', '__perpage__', '__tagmatches__',
                    '__termsmatches__', '__matchorder__', '__tags__');
    $replace = array($joincategory, $jointags, $wherecategory, $wheretags,
                     $whereterms, $paged, $perpage, $tagMatches, $termsmatches,
                     $bestMatch, $tags);

    return str_replace($search, $replace, $sql);
}

function repositorio_query_categoria($args, &$joincategory, &$wherecategory){
    if(isset($args['tax_query']) && !empty($args['tax_query'])){
        $tax_queries = $args['tax_query'];
        $cat_ids = array();
        foreach($tax_queries as $tax_query){
            $cat_ids[] = $tax_query['terms'][0];
        }
        $joincategory = "LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id)";
        $wherecategory = "wp_term_relationships.term_taxonomy_id IN (".implode(',', $cat_ids).")";
    }else{
        $joincategory = ' ';
        $wherecategory = ' 1=1 ';
    }
}

function repositorio_query_tags($args, &$tagMatches, &$jointags, &$wheretags, &$orderTag, &$countTerms, &$tags){
    if(isset($args['tag']) && !empty($args['tag'])){
        $tags = explode('+', $args['tag']);
        $finalTags = array();
        foreach($tags as $tag){
            $finalTags[] = get_term_by('slug', $tag, 'post_tag')->term_id;
        }
        $jointags = "LEFT JOIN wp_term_relationships AS tt1 ON (wp_posts.ID = tt1.object_id)";
        $wheretags = " tt1.term_taxonomy_id IN (".implode(',', $finalTags).")";
        $tagMatches = ', COUNT(tt1.term_taxonomy_id) as tag_matches ';
        $countTerms['tags'][] = 'COUNT(tt1.term_taxonomy_id)';
        $orderTag = ' tag_matches DESC, ';
        $tags = ' , GROUP_CONCAT(tt1.term_taxonomy_id) as tags';
    }else{
        $tagMatches = ', 0 as tag_matches';
        $jointags = ' ';
        $wheretags = ' 1=1 ';
        $orderTag = ' ';
        $tags = '';
    }
}

function repositorio_query_termos($args, &$whereterms, &$orderterms, &$termsmatches, &$countTerms){
    if (isset($args['s']) && !empty($args['s'])) {//terms
        $terms = explode('+', $args['s']);
        $whereterms = ' ( ';
        $termsmatches = '';
        foreach ($terms as $i => $term) {
            $termArray = explode(' ', $term);

            $termsmatches .= repositorio_sql_ocorrencias('wp_posts.post_title', 'term_matches_title_'.$i, $term);
            $termsmatches .= repositorio_sql_ocorrencias('wp_posts.post_content', 'term_matches_content_'.$i, $term);

            $countTerms['title']['full'][] = 'term_matches_title_'.$i;
            $countTerms['content']['full'][] = 'term_matches_content_'.$i;

            foreach ($termArray as $j => $word) {
                $whereterms .= "
                        (
                            (wp_posts.post_title LIKE '%" . $word . "%') OR
                            (wp_posts.post_excerpt LIKE '%" . $word . "%') OR
                            (wp_posts.post_content LIKE '%" . $word . "%')
                        ) OR ";
                if(count($termArray) > 1) {
                    $termsmatches .= repositorio_sql_ocorrencias('wp_posts.post_title',
                        'term_matches_title_' . $i . '_' . $j, $word);
                    $termsmatches .= repositorio_sql_ocorrencias('wp_posts.post_content',
                        'term_matches_content_' . $i . '_' . $j, $word);

                    $countTerms['title']['words'][] = 'term_matches_title_' . $i . '_' . $j;
                    $countTerms['content']['words'][] = 'term_matches_content_' . $i . '_' . $j;
                }
            }
        }

        $whereterms = rtrim($whereterms, ' OR');

        $whereterms .= ' ) ';

        $orderterms = '';
    } else {
        $termsmatches = '';
        $whereterms = ' 1=1 ';
        $orderterms = ' ';
    }
}

function repositorio_sql_ocorrencias($column, $name, $term){
    $sql = ',
            ROUND (
                (
                    LENGTH('.$column.')
                    - LENGTH( REPLACE ( LOWER('.$column.'), "'.mb_strtolower($term).'", "") )
                ) / LENGTH("'.$term.'")
            ) AS '.$name;
    return $sql;
}

function repositorio_query_bestMatch($countTerms){
    $pesos = array(
        'title' => array(
            'mode' => 0.6, // peso total das ocorrências encontradas no título
            'full' => 0.8, // peso dedicado as ocorrências encontradas pelo termo completo
            'words' => 0.2 // peso dedicado as ocorrências encontradas pelo termo quebrado
            /*
             * exemplo: mode - 0.33
             *          full - 0.8
             *          words - 0.2
             *
             * desta forma, as ocorrências encontradas no título terão 33% de peso,
             * destes 33% sendo 80% responsáveis as ocorrências encontradas pelo termo completo
             * e 20% encontradas pelo termo quebrado
             */
        ),
        'content' => array(
            'mode' => 0.4, // peso total das ocorrências encontradas no corpo
            'full' => 0.8, // peso dedicado as ocorrências encontradas pelo termo completo
            'words' => 0.2 // peso dedicado as ocorrências encontradas pelo termo quebrado
        ),
        'tags' => 1, // peso total das ocorrências encontradas nas tags
    );
    $bestMatch = '(';
    foreach($countTerms as $type => $modes){
        if($type == 'tags') {
            foreach($modes as $column){
                $bestMatch .= '('.$column.' * '.$pesos[$type].') + ';
            }
        }else{
            foreach ($modes as $mode => $columns) {
                foreach ($columns as $column) {
                    $peso = $pesos[$type][$mode]; // peso específico do termo inteiro/quebrado
                    $pesoMode = $pesos[$type]['mode']; // peso dedicado ao title/content
                    $bestMatch .= '('.$column.' * '.$peso.' * '.$pesoMode.') + ';
                }
            }
        }
    }
    $bestMatch = rtrim($bestMatch, ' + ');
    $bestMatch .= ') DESC, ';
    if($bestMatch == '() DESC, ')
        $bestMatch = '';
    return $bestMatch;
}

function repositorio_query_similar($tags){
    $sql = '
        SELECT *
        FROM wp_terms wt
        LEFT JOIN wp_term_taxonomy wtt ON wtt.term_id = wt.term_id
        LEFT JOIN wp_term_relationship wtr ON wtr.term_taxonomy_id = wtt.term_taxonomy_id

    ';
}

// CMB2
include('cmb2.php');
