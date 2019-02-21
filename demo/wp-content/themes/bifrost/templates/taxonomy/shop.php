<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header();

get_template_part('templates/hero/taxonomy');

global $bifrost_data_wow_seconds, $bifrost_data_wow_delay;

/**
 * Type
 */
$bifrost_shop_type = get_theme_mod('shop_type', 'meta-inside');
if ($bifrost_shop_type == 'meta-inside') {
	$bifrost_products_holder = 'l-woocommerce-wrapper__products-holder l-woocommerce-wrapper__products-holder--meta-inside';
} else {
	$bifrost_products_holder = 'l-woocommerce-wrapper__products-holder l-woocommerce-wrapper__products-holder--meta-outside';
}

/**
 * Sidebar
 */
$bifrost_row_class = 'row';
$bifrost_products_class = 'col-lg-8';
$bifrost_sidebar_class = 'col-lg-4';

if (get_theme_mod('shop_sidebar', '2') == '1') {
    $bifrost_row_class .= ' flex-row-reverse';
} elseif (get_theme_mod('shop_sidebar', '2') == '3') {
    $bifrost_products_class = 'col-12';
    $bifrost_sidebar_class = 'h-display-none';
}

/**
 * Animation
 */
$bifrost_data_wow_delay = false;
$bifrost_data_wow_seconds = 0;

if (get_theme_mod('shop_animation', 'fade-in') == 'fade-in-delay' || get_theme_mod('shop_animation', 'fade-in') == 'fade-in-up-delay') {
    $bifrost_data_wow_delay = true;
}

/**
 * Meta
 */
set_query_var('neuron_posts_meta_thumbnail', 'yes');
set_query_var('neuron_posts_meta_title', 'yes');
set_query_var('neuron_posts_meta_price', 'yes');
set_query_var('neuron_posts_meta_results_count', 'yes');
set_query_var('neuron_posts_carousel_height', 'auto');
set_query_var('neuron_posts_style_hover_active', 'no');
set_query_var('neuron_posts_thumbnail_resizer', '');
/**
 * Hover
 */
set_query_var('neuron_posts_style_hover_icon', 'yes');
set_query_var('neuron_posts_style_hover_icon_vertical_alignment', 'left');
set_query_var('neuron_posts_style_hover_icon_horizontal_alignment', 'bottom');
set_query_var('neuron_posts_style_hover_meta_vertical_alignment', 'center');

/**
 * Hover Visibility and Hover Animation
 */
set_query_var('neuron_posts_hover_visibility', 'show');
set_query_var('neuron_posts_hover_animation', 'translate');

bifrost_breadcrumbs(get_theme_mod('breadcrumbs_shop_visibility', '2'), get_theme_mod('breadcrumbs_separator'));

do_action('bifrost_open_container');
?>
<div class="l-woocommerce-wrapper h-large-top-padding h-large-bottom-padding">
	<div class="<?php echo esc_attr($bifrost_row_class) ?>">
		<div class="<?php echo esc_attr($bifrost_products_class) ?>">
			<div class="l-woocommerce-wrapper__top-bar h-medium-bottom-padding">
				<div class="row">
					<div class="col-sm-6">
						<?php woocommerce_result_count(); ?>
					</div>
					<div class="col-sm-6">
						<?php woocommerce_catalog_ordering(); ?>
					</div>
				</div>
			</div>
			<div class="<?php echo esc_attr($bifrost_products_holder) ?>">
				<div class="row masonry">
					<?php while (have_posts()) : the_post(); ?>
						<?php
						do_action('woocommerce_shop_loop');

						wc_get_template_part('content', 'product');

						$bifrost_data_wow_seconds = $bifrost_data_wow_seconds + 2;
						$bifrost_data_wow_seconds == 12 ? $bifrost_data_wow_seconds = 0 : '';
						?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
       <?php if (get_theme_mod('shop_sidebar', '2') !== '3') : ?>
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

neuron_pagination();

get_footer();