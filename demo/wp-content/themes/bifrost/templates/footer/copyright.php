<?php
/**
 * Footer Copyright
 */
if (bifrost_inherit_option('footer_copyright_visibility', 'footer_copyright_visibility', '1') == '2') {
    return;
}

$bifrost_footer_copyright = get_theme_mod('footer_copyright');
if (!$bifrost_footer_copyright && get_theme_mod('footer_copyright_automated', '1') == '1') {
    $bifrost_footer_copyright = sprintf(
        '%s %s %s. %s',
        '©',
        date('Y'),
        get_bloginfo('name'),
        esc_attr__('All rights reserved.', 'bifrost')
    );
}

// Social Media
$bifrost_social_media_visibility = bifrost_inherit_option('footer_social_media_visibility', 'footer_social_media_visibility', '1');
$bifrost_social_media_enabled = get_theme_mod('footer_social_media_enabled', ['facebook', 'twitter', 'dribbble', 'pinterest', 'linkedin']);

if ($bifrost_social_media_visibility == '2' && empty($bifrost_footer_copyright)) {
    return;
} 

// Alignment
if (bifrost_inherit_option('footer_copyright_alignment', 'footer_copyright_alignment', '1') == '1') {
    $bifrost_footer_row = 'row';
    $bifrost_copyright_class = 'l-primary-footer__copyright__text';
    $bifrost_social_media_class = 'm-social-media l-primary-footer__copyright__social-media h-align-right';
} else {
    $bifrost_footer_row = 'row flex-row-reverse';
    $bifrost_copyright_class = 'l-primary-footer__copyright__text h-align-right';
    $bifrost_social_media_class = 'l-primary-footer__copyright__social-media';
}
?>
<div class="l-primary-footer__copyright">
    <div class="container">
        <div class="l-primary-footer__copyright__space">
            <div class="<?php echo esc_attr($bifrost_footer_row) ?> d-flex align-items-center">
                <div class="col-sm-6">
                    <div class="<?php echo esc_attr($bifrost_copyright_class) ?>">
                        <?php echo wpautop(wp_kses_post($bifrost_footer_copyright)) ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="<?php echo esc_attr($bifrost_social_media_class) ?>">
                        <?php bifrost_social_media($bifrost_social_media_visibility, $bifrost_social_media_enabled) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>