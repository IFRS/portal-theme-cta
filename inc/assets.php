<?php
function cta_load_styles() {
    /* wp_register_style( $handle, $src, $deps, $ver, $media ); */
    /* wp_enqueue_style( $handle[, $src, $deps, $ver, $media] ); */

    wp_enqueue_style('css-cta', get_stylesheet_directory_uri().(WP_DEBUG ? '/css/cta.css' : '/css/cta.min.css'), array(), null, 'all');
}

function cta_load_scripts() {
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    if (!is_admin()) {
        wp_deregister_script('jquery');
    }
}

add_action( 'wp_enqueue_scripts', 'cta_load_styles', 2 );
add_action( 'wp_enqueue_scripts', 'cta_load_scripts', 2 );
