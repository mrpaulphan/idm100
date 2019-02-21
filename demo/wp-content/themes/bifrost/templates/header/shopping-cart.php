<?php 
/**
 * Mini Cart
 */
if (!class_exists('WooCommerce') || bifrost_inherit_option('shopping_cart_visibility', 'shopping_cart_visibility', '2') == '2') {
    return;
}
global $woocommerce;

/**
 * Mobile
 */
$bifrost_shopping_cart_class = 'l-primary-header__bag';
if (get_theme_mod('shopping_cart_mobile', '2') == '1') {
    $bifrost_shopping_cart_class = 'l-primary-header__bag d-flex';
} else {
    $bifrost_shopping_cart_class = 'l-primary-header__bag d-none d-lg-flex';
}
?>
<div class="<?php echo esc_attr($bifrost_shopping_cart_class) ?>">
    <a class="l-primary-header__bag__icon" href="<?php echo esc_url(wc_get_cart_url()) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
        <span class="number"><?php echo sprintf('%d', WC()->cart->cart_contents_count); ?></span>
    </a>
    <div class="o-mini-cart">
        <div class="o-mini-cart__holder widget_shopping_cart_content"></div>
    </div>
</div>

