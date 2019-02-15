<?php
/**
 * CTA
 * Handles the custom posts with CMB2 plugin.
 */

if ( file_exists(__DIR__ . '/../../../plugins/cmb2/init.php') ) {
    require_once __DIR__ . '/../../../plugins/cmb2/init.php';
    // hook the function to the cmb2_init action
    add_action( 'cmb2_init', 'infos_recursos_ta' );

    // create the function that creates metaboxes and populates them with fields
    function infos_recursos_ta() {
        // set the prefix (start with an underscore to hide it from the custom fields list
        $prefix = '_infos_recurso_ta_';

        // create the metabox
        $cmb = new_cmb2_box( array(
            'id'            => 'infos_recursos_ta',
            'title'         => 'Informações do Recurso de TA',
            'object_types'  => array( 'recurso-ta' ), // post type
            'context'       => 'advanced', // 'normal', 'advanced' or 'side'
            'priority'      => 'high', // 'high', 'core', 'default' or 'low'
            'show_names'    => true, // show field names on the left
        ) );

        // galeria de imagens
        $cmb->add_field( array(
            'name' => 'Imagens',
            'desc' => 'Galeria de imagens do Recurso de TA',
            'id'   => $prefix.'imagens',
            'type' => 'file_list',
            'query_args' => array( 'type' => 'image' ), // Only images attachment
            'text' => array(
                'add_upload_files_text' => 'Carregar Imagens',
                'remove_image_text' => 'Remover Imagens',
                'file_text' => 'Imagem:',
                'file_download_text' => 'Baixar',
                'remove_text' => 'Remover',
            ),
        ) );

        // arquivos
        $cmb->add_field( array(
            'name' => 'Arquivos',
            'desc' => 'Manuais, artes, etc.',
            'id'   => $prefix.'arquivos',
            'type' => 'file_list',
            'text' => array(
                'add_upload_files_text' => 'Carregar Arquivos',
                'remove_image_text' => 'Remover Arquivos',
                'file_text' => 'Arquivo: ',
                'file_download_text' => 'Download',
                'remove_text' => 'Remover',

            ),
        ));

        //vídeos
        $cmb->add_field(array(
            'name'    => 'Vídeos',
            'desc'    => 'Links do YouTube',
            'repeatable' => true,
            'id'      => $prefix.'videos',
            'type'    => 'oEmbed',
            'text' => array(
                'add_row_text' => "+ Vídeo"
            ),
        ));

        // categorias-ta Taxonomy
        $categorias_ta_metabox = new_cmb2_box( array(
            'id'           => 'categorias_ta_taxonomy_metabox',
            'title'        => 'Categorias de TA',
            'object_types' => array( 'recurso-ta' ),
            'context'      => 'side',
            'priority'     => 'low',
            'show_names'   => false,
        ) );

        $categorias_ta_metabox->add_field( array(
            'id'                => $prefix . 'categorias_ta_taxonomy',
            'name'              => 'Categorias de TA',
            'taxonomy'          => 'categorias-ta',
            'type'              => 'taxonomy_multicheck_hierarchical',
            'show_option_none'  => false,
            'select_all_button' => false,
            'text'              => array(
                'no_terms_text' => 'Não há Categorias de TA cadastradas. Cadastre uma Categoria de TA antes de cadastrar um Recurso.'
            ),
            'remove_default'    => 'true',
            'attributes' => array(
                'required' => 'required',
            ),
        ) );
    }

    /**
     * Outputs the image gallery
     *
     * @param  string  $file_list_meta_key The field meta key.
     */
    function cmb2_output_image_list( $file_list_meta_key) {

        // Get the list of files
        $files = get_post_meta( get_the_ID(), $file_list_meta_key, true );
        echo '<div class="image-list-wrap">';

        if (!empty($files)) {
            foreach ($files as $attachment_id => $attachment_url) {
                echo '<div class="wp-caption" >';
                echo '<a rel="arquivos[galeria]" href="'.wp_get_attachment_image_src($attachment_id, 'large')[0].'" >';
                echo wp_get_attachment_image($attachment_id);
                //echo 'Galeria de fotos';
                echo '</a>';
                echo '</div>';
            }
        }
        echo '</div>';
    }

    /**
     * Outputs the file list
     *
     * @param  string  $file_list_meta_key The field meta key.
     */
    function cmb2_output_file_list( $file_list_meta_key) {

        // Get the list of files
        $files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );
        if(!empty($files)){
            echo '<div class="file-list-wrap">Downloads:<ul>';
            foreach($files as $id => $url){
                $name = basename(get_attached_file( $id ));
                echo '<li><a target="blank" href="'.$url.'">'.$name.'</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }


    /**
     * Outputs the file list
     *
     * @param  string  $meta The field meta key.
     */
    function cmb2_output_video_list($meta){
        $videos = get_post_meta( get_the_ID(), $meta, 1 );
        if(!empty($videos)){
            echo '<div class="video-list-wrap">';
            foreach($videos as $url){
                echo '<div class="video-container">';
                echo wp_oembed_get(esc_url($url), ['width' => '100%']);
                echo '</div>';
            }
            echo '</div>';
        }
    }


}
