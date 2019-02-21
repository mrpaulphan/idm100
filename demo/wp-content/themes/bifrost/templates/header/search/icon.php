<?php 
/**
 * Search Icon
 */

 /**
 * Visibility
 */
if (bifrost_inherit_option('header_search_visibility', 'header_search_visibility', '2') == '2') {
    return;
}

/**
 * Mobile
 */
$bifrost_site_search_icon_class = '';

if (get_theme_mod('header_search_mobile', '2') == '1') {
    $bifrost_site_search_icon_class = 'a-site-search-icon d-flex';
} else {
    $bifrost_site_search_icon_class = 'a-site-search-icon d-none d-lg-flex';
}
?>
<a class="<?php echo esc_attr($bifrost_site_search_icon_class) ?>" href="#">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
</a>