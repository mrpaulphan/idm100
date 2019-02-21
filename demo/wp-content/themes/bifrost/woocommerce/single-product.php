<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); 

get_template_part('templates/hero/standard');

/**
 * Sidebar
 */
$bifrost_sidebar_option = bifrost_inherit_option('product_sidebar', 'product_sidebar', '3');
$bifrost_row_class = 'row';
$bifrost_product_class = 'col-lg-8';
$bifrost_sidebar_class = 'col-lg-4';

if ($bifrost_sidebar_option == '1') {
    $bifrost_row_class .= ' flex-row-reverse';
} elseif ($bifrost_sidebar_option == '3') {
	$bifrost_product_class = 'col-12';
	$bifrost_sidebar_class = 'h-display-none';
}

/**
 * Breadcrumb
 */
$bifrost_page_breadcrumb = bifrost_inherit_option('general_breadcrumb', 'breadcrumbs_product_visibility', '2');
bifrost_breadcrumbs($bifrost_page_breadcrumb, get_theme_mod('breadcrumbs_separator'));

do_action('bifrost_open_container');
?>
<div class="l-woocommerce-wrapper h-large-top-padding h-large-bottom-padding">
	<div class="<?php echo esc_attr($bifrost_row_class) ?>">
		<div class="<?php echo esc_attr($bifrost_product_class) ?>">
			<?php 
			while (have_posts()) {
				the_post();
				wc_get_template_part('content', 'single-product');
			}
			?>
		</div>
		<?php if ($bifrost_sidebar_option != '3') : ?>
			<div class="<?php echo esc_attr($bifrost_sidebar_class) ?>">
				<div class="o-main-sidebar">
					<?php get_sidebar('shop') ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php 
do_action('bifrost_close_container');

get_template_part('templates/shop/product/navigation');

get_footer();
