<?php
    if (is_home()) {
        echo get_the_title(get_option( 'page_for_posts' ));
    } else {
        echo single_cat_title('', false);
    }
