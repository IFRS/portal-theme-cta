<?php

function cta_load_css_js() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
    }

    wp_enqueue_style('css-cta', get_stylesheet_directory_uri().(WP_DEBUG ? '/css/cta.css' : '/css/cta.min.css'), array(), WP_DEBUG ? false : filemtime(get_stylesheet_directory() . '/css/cta.min.css'), 'all');

    wp_enqueue_script('repositorioTAjs', get_theme_file_uri('/js/repositorioTA.js'), array(), WP_DEBUG ? false : filemtime(get_stylesheet_directory() . '/js/repositorioTA.js'), true);
}

add_action( 'wp_enqueue_scripts', 'cta_load_css_js');
