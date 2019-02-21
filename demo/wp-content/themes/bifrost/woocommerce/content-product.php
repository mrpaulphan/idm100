<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

global $product, $bifrost_data_wow_seconds, $bifrost_data_wow_delay;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

/**
 * Type
 */
$bifrost_shop_type = get_theme_mod('shop_type', 'meta-inside');

/**
 * Columns
 * 
 * It changes the columns via the selector
 * item class.
 */
$bifrost_shop_selector_class = 'selector';

switch (get_theme_mod('shop_columns', '2-columns')) {
    case '1-column':
        $bifrost_shop_selector_class .= ' col-12';
        break;
    default:
        $bifrost_shop_selector_class .= ' col-sm-6';
        break;
    case '3-columns':
        $bifrost_shop_selector_class .= ' col-md-4 col-sm-6';
        break;
    case '4-columns':
        $bifrost_shop_selector_class .= ' col-md-3 col-sm-6';
        break;
}

/**
 * Related Products Columns
 * 
 * Override the columns of the
 * related products in product.
 */
if (is_single()) {
    switch (bifrost_inherit_option('product_related_count', 'product_related_count', '4')) {
        case '1':
            $bifrost_shop_selector_class = 'selector col-12';
            break;
        case '2':
            $bifrost_shop_selector_class = 'selector col-sm-6';
            break;
        case '3':
            $bifrost_shop_selector_class = 'selector col-md-4 col-sm-6';
            break;
        default:
            $bifrost_shop_selector_class = 'selector col-md-3 col-sm-6';
            break;
    }
}

/**
 * Spacing
 * 
 * It's used for the spacing 
 * between shop products.
 */
$bifrost_shop_spacing = get_theme_mod('shop_spacing', 'no');
$bifrost_shop_spacing_value = get_theme_mod('shop_spacing_value', 30);

$bifrost_shop_spacing_bool = $bifrost_shop_spacing == 'yes' || $bifrost_shop_spacing_value == '0' ? true : false; 
$bifrost_shop_spacing_selector = $bifrost_shop_spacing_product = null;

if ($bifrost_shop_spacing == 'yes' && $bifrost_shop_spacing_value) {
    $bifrost_shop_spacing_selector = 'padding-left: '. $bifrost_shop_spacing_value / 2 .'px; padding-right: '. $bifrost_shop_spacing_value / 2 .'px';
    $bifrost_shop_spacing_product = 'margin-bottom: '. $bifrost_shop_spacing_value .'px';
} elseif ($bifrost_shop_spacing == 'yes' && $bifrost_shop_spacing_value == '0') {
    $bifrost_shop_spacing_selector = 'padding-left: 0; padding-right: 0';
    $bifrost_shop_spacing_product = 'margin-bottom: 0';
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

/**
 * Hover Visibility
 * 
 * Pass the variable to global query to
 * inherit later in meta-inside and outside
 * of the shop types.
 */
set_query_var('neuron_posts_hover_visibility', get_theme_mod('shop_hover_visibility', 'show'));

/**
 * Hover Animation
 * 
 * Pass the variable to global query to
 * inherit later in meta-inside and outside
 * of the shop types.
 */
set_query_var('neuron_posts_hover_animation', get_theme_mod('shop_hover_animation', 'translate'));

/**
 * Thumbnail Sizes
 * 
 * It checks if the content-product is being
 * used in a single(product), if yes the values
 * will be inherit from the product settings
 */
$neuron_shop_thumbnail = is_single() ? get_theme_mod('product_thumbnail_resizer', 'no') : get_theme_mod('shop_thumbnail_resizer', 'no');
$neuron_shop_thumbnail_sizes = is_single() ? get_theme_mod('product_thumbnail_sizes', 'medium') : get_theme_mod('shop_thumbnail_sizes', 'medium');
$neuron_shop_thumbnail_output = null;

if ($neuron_shop_thumbnail == 'yes') {
	foreach (get_intermediate_image_sizes() as $image_size) {
		$neuron_shop_thumbnail_output[$image_size] = $image_size; 
	}
	$neuron_shop_thumbnail_output = $neuron_shop_thumbnail_output[$neuron_shop_thumbnail_sizes];
}
set_query_var('neuron_posts_thumbnail_resizer', $neuron_shop_thumbnail_output);

/**
 * Animation & WOW Delay
 */
$bifrost_shop_animation = get_theme_mod('shop_animation', 'fade-in');
$bifrost_shop_product_holder_class = 'product-holder';

if ($bifrost_shop_animation == 'fade-in' || $bifrost_shop_animation == 'fade-in-delay') {
    $bifrost_shop_product_holder_class .= ' h-fadeInNeuron wow';    
} elseif ($bifrost_shop_animation == 'fade-in-up' || $bifrost_shop_animation == 'fade-in-up-delay') {
    $bifrost_shop_product_holder_class .= ' h-fadeInUpNeuron wow';
}

$bifrost_wow_holder = "data-wow-delay=". $bifrost_data_wow_seconds/10 ."s";

/**
 * Hover
 */
set_query_var('neuron_posts_style_hover_icon', 'yes');
set_query_var('neuron_posts_style_hover_meta_vertical_alignment', 'center');
if (is_single()) {
    set_query_var('neuron_posts_style_hover_icon_vertical_alignment', 'center');
    set_query_var('neuron_posts_style_hover_icon_horizontal_alignment', 'center');
} else {
    set_query_var('neuron_posts_style_hover_icon_vertical_alignment', 'left');
    set_query_var('neuron_posts_style_hover_icon_horizontal_alignment', 'bottom');
}

/**
 * Override Related Products Type
 */
if (is_single() || is_cart()) {
    $bifrost_shop_type = 'meta-outside';
}
?>
<div <?php wc_product_class($bifrost_shop_selector_class); ?> data-id="<?php the_ID(); ?>" <?php echo wp_kses_post($bifrost_shop_spacing_bool ? 'style="'. $bifrost_shop_spacing_selector .'"' : '') ?>>
	<div class="<?php echo esc_attr($bifrost_shop_product_holder_class) ?>" <?php echo esc_attr($bifrost_data_wow_delay === true && $bifrost_data_wow_seconds ? $bifrost_wow_holder : ''); ?> <?php echo wp_kses_post($bifrost_shop_spacing_bool ? 'style="'. $bifrost_shop_spacing_product .'"' : '') ?>>
		<?php
        if ($bifrost_shop_type == 'meta-inside') {
            get_template_part('templates/shop/type/meta-inside'); 
        } else {
            get_template_part('templates/shop/type/meta-outside'); 
        }
		?>
	</div>
</div>
