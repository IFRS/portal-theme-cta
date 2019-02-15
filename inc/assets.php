<?php
function cta_load_styles() {
    /* wp_register_style( $handle, $src, $deps, $ver, $media ); */
    /* wp_enqueue_style( $handle[, $src, $deps, $ver, $media] ); */

    wp_enqueue_style('css-cta', get_stylesheet_directory_uri().(WP_DEBUG ? '/css/cta.css' : '/css/cta.min.css'), array(), null, 'all');

    //wp_enqueue_style( 'selectWooCSS', get_theme_file_uri('/css/selectWoo.min.css'));
    wp_enqueue_style('repositorioTA', get_theme_file_uri('/css/repositorioTA.css'));
}

function cta_load_scripts() {
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    if (!is_admin()) {
        wp_deregister_script('jquery');
    }

    // jQuery plugin
    //wp_enqueue_script( 'jquery2', 'https://code.jquery.com/jquery-3.3.1.js');
    
    //wp_enqueue_script( 'selectWooJS', get_theme_file_uri( '/js/selectWoo.full.js' ));
    //wp_enqueue_script( 'selectWooJSLang', get_theme_file_uri( '/js/selectWoo.pt-BR.js' ));

    // Code
    //wp_enqueue_script( 'jquery-static', get_theme_file_uri('/js/jquery.min.js'));
    //wp_enqueue_script("jquery");
    wp_enqueue_script( 'repositorioTA', get_theme_file_uri( '/js/repositorioTA.js' ), array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 'cta_load_styles', 2 );
add_action( 'wp_enqueue_scripts', 'cta_load_scripts', 1 );
