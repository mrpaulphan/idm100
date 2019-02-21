<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $bifrost_data_wow_seconds, $bifrost_data_wow_delay;

/**
 * Related Products Visibility
 */
if (bifrost_inherit_option('product_related', 'product_related', '1') == '2') {
	return;
}

/**
 * Related Products Columns
 */
if ($related_products) {
	switch (bifrost_inherit_option('product_related_count', 'product_related_count', '4')) {
		case '1':
			unset($related_products[1], $related_products[2], $related_products[3]);
			break;
		case '2':
			unset($related_products[2], $related_products[3]);
			break;
		case '3':
			unset($related_products[3]);
			break;
	}
}

/**
 * Animation
 */
$bifrost_data_wow_delay = false;
$bifrost_data_wow_seconds = 0;

if (get_theme_mod('shop_animation', 'fade-in') == 'fade-in-delay' || get_theme_mod('shop_animation', 'fade-in') == 'fade-in-up-delay') {
    $bifrost_data_wow_delay = true;
}

if ( $related_products ) : ?>
	<section class="related products l-woocommerce-wrapper__products-holder l-woocommerce-wrapper__products-holder--meta-outside">
		<h2 class="h3"><?php esc_html_e('Related products', 'bifrost') ?></h2>
		<div class="row masonry">
			<?php foreach ($related_products as $related_product) : ?>
				<?php
				$post_object = get_post($related_product->get_id());
				setup_postdata($GLOBALS['post'] =& $post_object);
				wc_get_template_part('content', 'product'); 
				$bifrost_data_wow_seconds = $bifrost_data_wow_seconds + 2;
				$bifrost_data_wow_seconds == 12 ? $bifrost_data_wow_seconds = 0 : '';
                ?>
			<?php endforeach; ?>
		</div>
	</section>
<?php endif;

wp_reset_postdata();
