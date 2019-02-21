<?php 
/**
 * Sliding Bar Icon
 */
if (bifrost_inherit_option('sliding_bar_visibility', 'sliding_bar_visibility', '2') == '2') {
    return;
}

/**
 * Mobile
 */
if (get_theme_mod('sliding_bar_mobile', '2') == '1') {
    $bifrost_sliding_bar_icon_class = 'a-slidingbar-icon d-flex';
} else {
    $bifrost_sliding_bar_icon_class = 'a-slidingbar-icon d-none d-lg-flex';
}
?>
<div class="<?php echo esc_attr($bifrost_sliding_bar_icon_class) ?>">
    <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-right"><line x1="21" y1="10" x2="7" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="7" y2="18"></line></svg>
    </a>
</div>