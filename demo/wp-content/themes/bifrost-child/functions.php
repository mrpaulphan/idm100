<?php

add_action('wp_enqueue_scripts', 'bifrost_child_theme_styles', PHP_INT_MAX);
function bifrost_child_theme_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri(). '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_uri(), array( 'parent-style') );
}