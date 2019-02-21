<?php 
/**
 * Search Base
 */
$bifrost_site_search_class = 'm-site-search';

/**
 * Visibility
 */
if (bifrost_inherit_option('header_search_visibility', 'header_search_visibility', '2') == '2') {
    return;
}

/**
 * Mobile
 */
if (get_theme_mod('header_search_mobile', '2') == '2') {
    $bifrost_site_search_class .= ' d-none d-lg-block';
}
?>
<div class="<?php echo esc_attr($bifrost_site_search_class) ?>">
    <?php get_template_part('templates/header/search/content') ?>
</div>