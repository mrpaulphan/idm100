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
} elseif (get_theme_mod('shop_sidebar', '2') == '3' || !is_active_sidebar('shop-sidebar')) {
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
 * Spacing
 * 
 * It's used for the spacing between
 * shop products.
 */
$bifrost_shop_spacing = get_theme_mod('shop_spacing', 'yes');
$bifrost_shop_spacing_value = get_theme_mod('shop_spacing_value', 30);

$bifrost_shop_spacing_bool = $bifrost_shop_spacing == 'yes' || $bifrost_shop_spacing_value == '0' ? true : false; 
$bifrost_shop_spacing_row = null;

if ($bifrost_shop_spacing == 'yes' && $bifrost_shop_spacing_value) {
    $bifrost_shop_spacing_row = 'margin-left: -'. $bifrost_shop_spacing_value / 2 .'px; margin-right: -'. $bifrost_shop_spacing_value / 2 .'px';
} elseif ($bifrost_shop_spacing == 'yes' && $bifrost_shop_spacing_value == '0') {
    $bifrost_shop_spacing_row = 'margin-left: 0; margin-right: 0';
}

/**
 * Paged
 * 
 * Tell the WordPress exactly
 * what page is active.
 */
if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} elseif (get_query_var('page')) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

/**
 * Thumbnail Sizes
 */
$neuron_shop_thumbnail = get_theme_mod('shop_thumbnail_resizer', 'yes');
$neuron_shop_thumbnail_sizes = get_theme_mod('shop_thumbnail_sizes', 'medium');
$neuron_shop_thumbnail_output = null;

if ($neuron_shop_thumbnail == 'yes') {
	foreach (get_intermediate_image_sizes() as $image_size) {
		$neuron_shop_thumbnail_output[$image_size] = $image_size; 
	}
	$neuron_shop_thumbnail_output = $neuron_shop_thumbnail_output[$neuron_shop_thumbnail_sizes];
}

set_query_var('neuron_posts_thumbnail_resizer', $neuron_shop_thumbnail_output);

// Show More with Ajax
$exclude = isset($_GET['exclude']) ? $_GET['exclude'] : '';

/**
 * Query Arguments
 * 
 * Modify the query with
 * different arguments properties.
 */
$args = array(
	'post_type' => 'product',
	'paged' => $paged,
	'posts_per_page' => get_theme_mod('shop_ppp')
);

if ($exclude) {
	$args['post__not_in'] = $exclude;
}

/**
 * Catalog Orderby
 */
$orderby_options = [
	'menu_order' => esc_attr__('Default sorting', 'bifrost'),
	'popularity' => esc_attr__('Sort by popularity', 'bifrost'),
	'rating'     => esc_attr__('Sort by average rating', 'bifrost'),
	'date'       => esc_attr__('Sort by newness', 'bifrost'),
	'price'      => esc_attr__('Sort by price: low to high', 'bifrost'),
	'price-desc' => esc_attr__('Sort by price: high to low', 'bifrost')
];

$catalog_orderby_options = apply_filters('woocommerce_catalog_orderby', $orderby_options);

/**
 * Change default order
 */
if (isset($_GET['orderby'])) {
	$orderby = wc_clean(wp_unslash($_GET['orderby']));
	$show_default_orderby = 'default';
} else {
	switch (get_theme_mod('shop_catalog_ordering_default', 'menu_order')) {
		default:
			$show_default_orderby = $orderby = 'default';
			break;
		case 'popularity':
			$show_default_orderby = $orderby = 'popularity';
			break;
		case 'rating':
			$show_default_orderby = $orderby = 'rating';
			break;
		case 'date':
			$show_default_orderby = $orderby = 'date';
			break;
		case 'price':
			$show_default_orderby = $orderby = 'price';
			break;
		case 'price-desc':
			$show_default_orderby = $orderby = 'price-desc';
			break;
	}
}

/**
 * Modify Query for Orderby
 */
switch ($orderby) {
	case 'default':
		$args['orderby'] = 'menu_order';
		$args['order'] = 'asc';
		break;
	case 'popularity':
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = 'total_sales';
		$args['order'] = 'desc';
		break;
	case 'rating':
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = '_wc_average_rating';
		$args['order'] = 'desc';
		break;
	case 'date':
		$args['orderby'] = 'date';
		$args['meta_key'] = '';
		$args['order'] = 'desc';
		break;
	case 'price':
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = '_price';
		$args['order'] = 'asc';
		break;
	case 'price-desc':
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = '_price';
		$args['order'] = 'desc';
		break;
}

$query = new WP_Query($args);

/**
 * Breadcrumb
 */
$bifrost_page_breadcrumb = bifrost_inherit_option('general_breadcrumb', 'breadcrumbs_shop_visibility', '2', true);
bifrost_breadcrumbs($bifrost_page_breadcrumb, get_theme_mod('breadcrumbs_separator'));

do_action('bifrost_open_container');
?>
<div class="l-woocommerce-wrapper h-large-top-padding h-large-bottom-padding">
	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action('woocommerce_archive_description');
	?>
	<div class="<?php echo esc_attr($bifrost_row_class) ?>">
		<div class="<?php echo esc_attr($bifrost_products_class) ?>">
			<?php 
			/**
			 * Result Count 
			 */
			$bifrost_result_count = get_theme_mod('shop_result_count', 'show');
			$bifrost_result_count_class = 'col-sm-6';

			/**
			 * Catalog Ordering
			 */
			$bifrost_catalog_ordering = get_theme_mod('shop_catalog_ordering', 'show');
			$bifrost_catalog_ordering_class = 'col-sm-6';
			
			$bifrost_catalog_ordering == 'hide' ? $bifrost_result_count_class = 'col-12' : '';
			$bifrost_result_count == 'hide' ? $bifrost_catalog_ordering_class = 'col-12' : '';

			if ($bifrost_result_count == 'show' || $bifrost_catalog_ordering == 'show') :
			?>
				<div class="l-woocommerce-wrapper__top-bar h-medium-bottom-padding">
					<div class="row">
						<?php if ($bifrost_result_count == 'show') : ?>
							<div class="<?php echo esc_attr($bifrost_result_count_class) ?>">
								<?php woocommerce_result_count(); ?>
							</div>
						<?php endif; ?>
						<?php if ($bifrost_catalog_ordering == 'show') : ?>
							<div class="<?php echo esc_attr($bifrost_catalog_ordering_class) ?>">
								<?php 
								wc_get_template('loop/orderby.php', array(
									'catalog_orderby_options' => $catalog_orderby_options,
									'orderby' => $orderby,
									'show_default_orderby' => $show_default_orderby,
								));
								?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="<?php echo esc_attr($bifrost_products_holder) ?>">
				<div class="row masonry" data-masonry-id="archive-products" <?php echo wp_kses_post($bifrost_shop_spacing_bool ? 'style="'. $bifrost_shop_spacing_row .'"' : '') ?>>
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						<?php
						wc_get_template_part('content', 'product');

						$bifrost_data_wow_seconds = $bifrost_data_wow_seconds + 2;
						$bifrost_data_wow_seconds == 12 ? $bifrost_data_wow_seconds = 0 : '';
						?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
		<?php if (get_theme_mod('shop_sidebar', '2') !== '3' && is_active_sidebar('shop-sidebar')) : ?>
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

neuron_pagination($query);

get_footer();