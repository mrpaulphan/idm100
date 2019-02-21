<?php
/**
 * Plugin Name: Neuron Core
 * Description: Core plugin for Bifrost.
 * Version:     1.1.0
 * Author:      NeuronThemes
 * Author URI:  https://neuronthemes.com/
 * Text Domain: neuron-core
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Global Variables
 * 
 * Defining global variables to make
 * usage easier.
 */
define('NEURON_CORE_VERSION', '1.0.0');
define('NEURON_FILE', __FILE__);

/**
 * Include Plugins
 */
include_once(__DIR__ . '/includes/plugins/acf-flexible-content/acf-flexible-content.php');
include_once(__DIR__ . '/includes/plugins/acf-repeater/acf-repeater.php');
include_once(__DIR__ . '/includes/plugins/kirki/kirki.php');
include_once(__DIR__ . '/includes/plugin.php');


/**
 * Custom Post Types
 */
function neuron_custom_post_types() {
	// Prefix
	$neuron_portfolio_prefix = get_theme_mod('portfolio_prefix') ? ucfirst(get_theme_mod('portfolio_prefix')) : '';
	neuron_portfolio_post_type($neuron_portfolio_prefix);
	neuron_portfolio_categories($neuron_portfolio_prefix);

	neuron_media_categories();
}
add_action('init', 'neuron_custom_post_types');

/**
 * Load Neuron Core
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function neuron_plugins_loaded() {
	// Load localization file
	load_plugin_textdomain('neuron-core');

	include(__DIR__ . '/functions.php');
	include(__DIR__ . '/customizer/customizer-options.php');

	// Actions and Filters
	add_action('wp_enqueue_scripts', 'neuron_core_styles');
	add_action('wp_enqueue_scripts', 'neuron_core_scripts');
	add_action('admin_enqueue_scripts', 'neuron_admin_scripts');
	
	// Load localization file
	load_plugin_textdomain('neuron-core');
}
add_action('plugins_loaded', 'neuron_plugins_loaded');
