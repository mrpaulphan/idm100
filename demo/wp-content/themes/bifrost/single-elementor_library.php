<?php
/**
 * Elementor Single
 */
add_filter('bifrost_display_header', '__return_false');
add_filter('bifrost_display_footer', '__return_false');
add_filter('bifrost_display_header_template', '__return_false');

get_header();

if (have_posts()) {
    while(have_posts()) {
        the_post();
        the_content();
    }
}

get_footer();