<?php
/**
 * Top Header
 */
$bifrost_primary_top_header = 'm-primary-top-header';
$bifrost_top_header_menu = get_theme_mod('top_header_menu');
$bifrost_top_header_textarea = get_theme_mod('top_header_textarea');

if (bifrost_inherit_option('top_header_visibility', 'top_header_visibility', '2') == '2' || (!isset($bifrost_top_header_textarea) || !isset($bifrost_top_header_menu))) {
    return;
}

/**
 * Mobile Visibility
 */
if (get_theme_mod('top_header_mobile', '2') == '2') {
    $bifrost_primary_top_header .= ' d-none d-lg-block';
}

/**
 * Alignment
 */
$bifrost_top_header_holder_class = 'm-primary-top-header__holder d-flex align-items-stretch';
$bifrost_top_header_content_class = 'm-primary-top-header__content';
$bifrost_top_header_menu_class = 'm-primary-top-header__nav d-none d-lg-flex align-items-stretch ml-auto';

if (get_theme_mod('top_header_content_alignment', '1') == '2') {
    $bifrost_top_header_holder_class .= ' flex-row-reverse';
    $bifrost_top_header_content_class .= ' ml-auto';
    $bifrost_top_header_menu_class = 'm-primary-top-header__nav d-none d-lg-flex align-items-stretch';
}

/**
 * Skin
 */
if (get_theme_mod('top_header_skin', '1') == '2') {
    $bifrost_primary_top_header .= ' m-primary-top-header--dark-skin';
}

/**
 * Container
 */
if (get_theme_mod('top_header_container', '1') == '2') {
    $bifrost_primary_top_header .= ' l-primary-header--wide-container';
}
?>
<div class="<?php echo esc_attr($bifrost_primary_top_header) ?>">
    <div class="container">
        <div class="<?php echo esc_attr($bifrost_top_header_holder_class) ?>">
            <?php if ($bifrost_top_header_textarea) : ?>
                <div class="<?php echo esc_attr($bifrost_top_header_content_class) ?>">
                    <p><?php echo wp_kses_post($bifrost_top_header_textarea) ?></p>
                </div>
            <?php endif; ?>
            <div class="<?php echo esc_attr($bifrost_top_header_menu_class) ?>">
                <?php
                // Menu
                if ($bifrost_top_header_menu) {
                    $args = array(
                        'menu' => $bifrost_top_header_menu,
                        'menu_id' => 'menu',
                        'container' => 'nav',
                        'container_class' => 'd-flex align-items-stretch',
                        'menu_class' => 'menu m-header-default-menu d-flex align-items-stretch'
                    );
                    
                    wp_nav_menu($args);
                } 
                ?>
            </div> 
        </div>
    </div>
</div>