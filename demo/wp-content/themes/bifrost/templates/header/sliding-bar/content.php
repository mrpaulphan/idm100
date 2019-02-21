<?php 
/**
 * Sliding Bar Content
 */
if (bifrost_inherit_option('sliding_bar_visibility', 'sliding_bar_visibility', '2') == '2') {
    return;
}

/**
 * Skin
 */
$bifrost_sliding_bar_content_class = 'o-slidingbar__content';

if (get_theme_mod('sliding_bar_skin', '1') == '2') {
    $bifrost_sliding_bar_content_class .= ' o-slidingbar__content--dark-skin';
}

/**
 * Mobile
 */
$bifrost_sliding_bar_class = 'o-slidingbar';

if (get_theme_mod('sliding_bar_mobile', '2') == '2') {
    $bifrost_sliding_bar_class .= ' d-none d-lg-block';
}
?>
<div class="<?php echo esc_attr($bifrost_sliding_bar_class) ?>">
    <div class="<?php echo esc_attr($bifrost_sliding_bar_content_class) ?>">
        <div class="h-hide-scrollbar">
            <div class="h-hide-scrollbar__holder">
                <div class="o-slidingbar__content__holder">
                    <div class="o-slidingbar__close-icon d-inline-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </div>
                    <?php 
                    $bifrost_sliding_bar = get_theme_mod('sliding_bar_sidebar', 'sliding-bar');
                    if ($bifrost_sliding_bar && is_active_sidebar($bifrost_sliding_bar)) {
                        dynamic_sidebar($bifrost_sliding_bar);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="o-slidingbar__overlay"></div>
</div>