<?php 
/**
 * Archive Page
 */
get_header();

get_template_part('templates/hero/taxonomy');

/**
 * Breadcrumb
 */
$bifrost_page_breadcrumb = bifrost_inherit_option('general_archive_breadcrumb', 'breadcrumbs_archives_visibility', '2');
bifrost_breadcrumbs($bifrost_page_breadcrumb, get_theme_mod('breadcrumbs_separator'));

get_template_part('templates/blog/base');

get_footer();