<?php

   // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'recurso-ta',
        'posts_per_page' => 100,
        'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
    );
    $tags = get_tags();
    $tags_selected = array();
    /*
     * Tags são as que já estão cadastradas e o usuário
     * só selecionou no formulário, os terms são os
     * termos que ele digitou e que serão procurados
     * dentro do corpo do texto/título das TAs
     */
    $terms_selected = array();

    if(isset($_POST)){
        if(!empty($_POST['filter_recursos'])) {
            $args['tax_query'] = array();
            // filtro por categoria
            if(!empty($_POST['filter_categorias_ta']) && $_POST['filter_categorias_ta'] != 'Todas') {
                $category = $_POST['filter_categorias_ta'];
                $args['tax_query'][] =
                    array(
                        'taxonomy' => 'categorias-ta', //or tag or custom taxonomy
                        'field' => 'id',
                        'terms' => array($category)
                    );
            }

            function gen_tags_with_terms(array $terms) {
                $combine = function ($a, array $list) use (&$combine){
                    if (empty($list)) {
                        return array($a);
                    } else {
                        return array_merge(
                                array($a, $a . ' ' . $list[0]), 
                                $combine($list[0], array_slice($list, 1)));
                    }
                };

                return $combine($terms[0], array_slice($terms, 1));
            }

            // filtro por tag/termos
            if(!empty($_POST['filter_tags'])){
                $search_string = preg_replace('/\s+/', ' ', $_POST['filter_tags']);
                $filter_tags_array = explode(' ', $search_string);

                $tags_selected = array_filter(gen_tags_with_terms($filter_tags_array),
                                function ($item) use (&$tags, &$filter_tags_array) {
                                    return in_array($item, array_column($tags, 'name'));
                                });

                $terms_selected = explode(' ', array_reduce($tags_selected, 
                                function ($result, $tagStr) {
                                    return trim(str_replace($tagStr, '', $result));
                                }, $search_string));

                if (count($tags_selected)){
                    $args['tag'] = implode("+", $tags_selected);
                }
                
                if(count($terms_selected)){
                    $args['s'] = implode('+', $terms_selected);
                }
            }
        }
    }

    // Search for a list of ATs with the tag from URL param
    // Only if it's present and no other search parameter are given
    $param_tag = get_query_var('tag', false);
    if ($param_tag && !isset($args['tag'])) {
        $args['tag'] = $param_tag;
    }
    

    $sql = repositorio_query_construct($args);
    $pageposts = $wpdb->get_results($sql, OBJECT);
    //print($sql);
    $tags_selected_ids = array();
    foreach($pageposts as $post){
        if(!isset($post->tags))
            continue;
        $tags_post = explode(',', $post->tags);
        foreach($tags_post as $tag_post){
            if(!in_array(trim($tag_post), $tags_selected_ids))
                $tags_selected_ids[] = trim($tag_post);
        }
    }
    if(!empty($tags_selected_ids)){
        $sql = repositorio_query_similar($tags_selected_ids);
        $similares = $wpdb->get_results($sql, OBJECT);
    }else{
        $similares = array();
    }
?>

<div class="lista-noticias">
    <div class="row">
        <div class="col-12">
            <h2 class="lista-noticias__title" aria-label="Repositório de Tecnologia Assistiva">
                Repositório de Tecnologia Assistiva
            </h2>
        </div>
        <div class="col-sm-12">
            <form action="<?= site_url('recurso-ta') ?>" method="post">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="tag-search" class="control-label">Filtrar por palavra-chave</label>
                        <input type="text" id="tag-search" name="filter_tags" class="form-control" />

                       
                    </div>
                    <div class="col-sm-6 form-group">
                        <?php
                        $cat_args = array(
                            'orderby'       => 'term_id',
                            'order'         => 'ASC',
                            'hide_empty'    => false, // todo: verificar
                        );
                        $cats = get_terms('categorias-ta', $cat_args);
                        ?>
                        <label for="categories" class="control-label">Filtrar por categoria</label>
                        <select class="form-control" name="filter_categorias_ta"
                            id="categories" class="form-control">
                            <option>Todas</option>
                            <?php foreach($cats as $cat): ?>
                                <?php $selected = $cat->term_id == $category ? 'selected' : ''; ?>
                                <option value="<?= $cat->term_id; ?>" <?= $selected; ?>>
                                    <?= $cat->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <input type="submit" name="filter_recursos" value="Aplicar filtros" id="buscar">
            </form>
            <?php if(!empty($similares)){ ?>
                <span class="tag-recomendacoes">
                    <b>Você também pode pesquisar por: </b>
                    <?php foreach($similares as $i => $tag): ?>
                        <a href="#" class="tag-recomendacao" data-name="<?= $tag->name; ?>"><?= $tag->name;?></a>
                        <?php if($i < count($similares) - 1) echo '-'; ?>
                    <?php endforeach; ?>
                </span>
            <?php } ?>
        </div>
    </div>
    <hr/>
    
    <?php if ($pageposts && !empty($pageposts)): ?>
        <div class="card-columns lista-noticias__content">
            <?php global $post; ?>
            <?php foreach ($pageposts as $post): ?>
                <?php setup_postdata($post); ?>
                <div class="card border-light">
                    <div class="card-body p-0">
                        <article class="noticia">
                            <?php get_template_part('partials/recursos-ta/item-list'); ?>
                        </article>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    <?php else: ?>
            <p class="text-center">Nenhuma tecnologia assistiva encontrada.</p>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">
            <nav class="text-center">
                <?php echo portal_pagination(); ?>
            </nav>
        </div>
    </div>
</div>
