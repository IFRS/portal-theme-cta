<?php

function cta_load_css_js() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
    }

    wp_enqueue_style('css-cta', get_stylesheet_directory_uri().(WP_DEBUG ? '/css/cta.css' : '/css/cta.min.css'), array(), false, 'all');

    wp_enqueue_script('repositorioTAjs', get_theme_file_uri('/js/repositorioTA.js'), array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'cta_load_css_js');

