<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

/**
 * Gallery Alignment
 */
$bifrost_product_row_class = 'row';
$bifrost_product_gallery_class = 'col-md-6';
$bifrost_product_summary_class = 'col-md-6';

if (bifrost_inherit_option('product_gallery_alignment', 'product_gallery_alignment', '1') == '2') {
	$bifrost_product_row_class .= ' flex-row-reverse';
} 

/**
 * Gallery Width
 */
$bifrost_product_gallery_width = bifrost_inherit_option('product_gallery_width', 'product_gallery_width', '1');

if ($bifrost_product_gallery_width == '2') {
	$bifrost_product_gallery_class = 'col-md-8';
	$bifrost_product_summary_class = 'col-md-4';
} elseif ($bifrost_product_gallery_width == '3') {
	$bifrost_product_gallery_class = 'col-md-9';
	$bifrost_product_summary_class = 'col-md-3';
}
?>
<div class="o-product">
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
		<div class="<?php echo esc_attr($bifrost_product_row_class) ?>">
			<div class="<?php echo esc_attr($bifrost_product_gallery_class) ?>">
				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 * 
				 * Modified: We're showing only product_images
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10 
				 * @hooked woocommerce_show_product_images - 20
				 */
				woocommerce_show_product_images();
				?>
			</div>
			<div class="<?php echo esc_attr($bifrost_product_summary_class) ?>">
				<div class="summary entry-summary m-product-summary">
					<?php
					/**
					 * Product Title
					 */
					if (bifrost_inherit_option('general_title', 'general_title_product', '2') == '2') {
						remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
					}
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action('woocommerce_single_product_summary');
					?>
					<?php if (get_theme_mod('product_share', '2') == '1') : ?>
						<?php get_template_part('templates/extra/share') ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
