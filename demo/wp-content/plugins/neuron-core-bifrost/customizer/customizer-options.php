<?php 

/**
 * Customizer Options
 * 
 * General
 * Header
 * Footer
 * Style
 * Portfolio
 * Blog
 * Shop
 * Utility
 * Social Media
 */
if (!class_exists('Kirki')){
	return;
}

// Add Config for Kirki Settings
Kirki::add_config('neuron_kirki', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod'
));

// Include Options
include(__DIR__ . '/options/general-options.php');
include(__DIR__ . '/options/header-options.php');
include(__DIR__ . '/options/footer-options.php');
include(__DIR__ . '/options/portfolio-options.php');
include(__DIR__ . '/options/blog-options.php');
if (class_exists('WooCommerce')) {
	include(__DIR__ . '/options/shop-options.php');
}
include(__DIR__ . '/options/style-options.php');
include(__DIR__ . '/options/typography-options.php');
include(__DIR__ . '/options/utility-options.php');
include(__DIR__ . '/options/social-media.php');

// Adds different style to customizer
function neuron_kirki_customizer_style($config) {
	return wp_parse_args( array(
		// 'logo_image'   => 'http://neuronthemes.com/crate/wp-content/uploads/2017/02/logo.png',
		'disable_loader' => true
	), $config );
}
add_filter('kirki_config', 'neuron_kirki_customizer_style');

// Remove WooCommerce default Panel
function neuron_customize_options($wp_customize) {
	if (class_exists('WooCommerce')) {
		$wp_customize->remove_panel('woocommerce');
	}
}
add_action('customize_register', 'neuron_customize_options');