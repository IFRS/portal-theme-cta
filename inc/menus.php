<?php
function remove_parent_theme_locations() {
    unregister_nav_menu( 'campi' );
}
add_action( 'after_setup_theme', 'remove_parent_theme_locations', 20 );
