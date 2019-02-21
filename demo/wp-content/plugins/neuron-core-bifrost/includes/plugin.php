<?php
/**
 * Neuron Elementor
 * 
 * Page Builder included directly
 * to the theme with custom elements.
 */

namespace NeuronElementor;	

defined( 'ABSPATH' ) || die();

// Notice if the Elementor is not active
if (!did_action('elementor/loaded')) {
	return;
}

use Elementor\Plugin as Elementor;
use NeuronElementor\Widgets\NeuronPosts;
use NeuronElementor\Widgets\NeuronMediaGallery;
use NeuronElementor\Widgets\NeuronProgressBar;
use NeuronElementor\Widgets\NeuronTypedHeading;
use NeuronElementor\Widgets\NeuronCountdown;

use NeuronElementor\Widgets\NeuronSiteLogo;
use NeuronElementor\Widgets\NeuronSiteTitle;
use NeuronElementor\Widgets\NeuronNavMenu;
use NeuronElementor\Widgets\NeuronSearchForm;
use NeuronElementor\Widgets\NeuronMenuCart;
use NeuronElementor\Widgets\NeuronHamburger;

/**
 * Plugin class.
 *
 * @since 1.0.0
 */
final class Plugin {
	/**
	 * Plugin instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var Plugin
	 */
	public static $instance;

	/**
	 * Modules.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var object
	 */
	public $modules = [];

	/**
	 * The plugin name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $plugin_name;

	/**
	 * The plugin version number.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $plugin_version;

	/**
	 * The minimum Elementor version number required.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $minimum_elementor_version = '2.0.0';

	/**
	 * The plugin directory.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $plugin_path;

	/**
	 * The plugin URL.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $plugin_url;

	/**
	 * The plugin assets URL.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $plugin_assets_url;

	/**
	 * Ensures only one instance of the plugin class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function __construct() {
		add_action( 'plugins_loaded', [ $this, 'check_elementor_version' ] );
		add_action( 'init', [ $this, 'i18n' ] );
	}

	/**
	 * Load plugin textdomain.
	 *
	 * @since 1.0.0
	 */
	public function i18n() {
		load_plugin_textdomain( 'neuron-core', false, plugin_dir_path( NEURON_FILE ) . 'includes/languages' );
	}

	/**
	 * Checks Elementor version compatibility.
	 *
	 * First checks if Elementor is installed and active,
	 * then checks Elementor version compatibility.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function check_elementor_version() {
		if ( ! version_compare( ELEMENTOR_VERSION, self::$minimum_elementor_version, '>=' ) ) {
			if ( current_user_can( 'update_plugins' ) ) {
				add_action( 'admin_notices',
				[ $this, 'admin_notice_minimum_elementor_version' ] );
			}
			return;
		}

		spl_autoload_register( [ $this, 'autoload' ] );

		$this->add_hooks();
	}

	/**
	 * Autoload classes based on namespace.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $class Name of class.
	 */
	public function autoload( $class ) {

		// Return if NeuronElementor name space is not set.
		if ( false === strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		/**
		 * Prepare filename.
		 *
		 * @todo Refactor to use preg_replace.
		 */
		$filename = str_replace( __NAMESPACE__ . '\\', '', $class );
		$filename = str_replace( '\\', DIRECTORY_SEPARATOR, $filename );
		$filename = str_replace( '_', '-', $filename );
		$filename = dirname( __FILE__ ) . '/' . strtolower( $filename ) . '.php';

		// Return if file is not found.
		if ( ! is_readable( $filename ) ) {
			return;
		}

		include $filename;
	}

		/**
	 * Fixed Options
	 * 
	 * Add fixed option to the section,
	 * it can be used for header builder.
	 */
	public function neuron_fixed_options($section, $section_id, $args) {

		static $style_sections = [ 'section_background'];

		if (!in_array($section_id, $style_sections)) { return; }

		// Schedule content controls
		$section->start_controls_section(
			'section_fixed_tab',
			[
				'label' => __('Fixed', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$section->add_control(
			'section_fixed',
			[
				'label' => __('Fixed', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
				'prefix_class' => 'neuron-fixed-',
			]
		);

		$section->add_control(
			'section_fixed_hidden',
			[
				'label' => __('Hidden', 'neuron-core'),
				'description' => __('<small>Note: Do not forget to place a hamburger to open this section, use navigator for easier orientation.</small>', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'section_fixed' => 'yes'
				],
				'prefix_class' => 'neuron-fixed-hidden-',
			]
		);

		$section->add_control(
			'section_fixed_hidden_animation',
			[
				'label' => __('Animation', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'fade-in' => __('Fade In', 'neuron-core'),
					'fade-in-left' => __('Fade In Left', 'neuron-core'),
					'fade-in-right' => __('Fade In Right', 'neuron-core'),
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'section_fixed',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'section_fixed_hidden',
							'operator' => '==',
							'value' => 'yes'
						],
					]
				],
				'prefix_class' => 'neuron-fixed-hidden-yes--',
				'default' => 'fade-in'
			]
		);

		$section->add_control(
			'section_fixed_close_button',
			[
				'label' => __('Close Button', 'neuron-core'),
				'description' => __('If the close button doesn\'t appears, please refresh the page.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'close-button',
				'default' => 'no',
				'conditions' => [
					'terms' => [
						[
							'name' => 'section_fixed',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'section_fixed_hidden',
							'operator' => '==',
							'value' => 'yes'
						],
					]
				],
				'prefix_class' => 'neuron-fixed-hidden-yes--',
				'renter_type' => 'template',
			]
		);

		$section->add_control(
			'section_fixed_width',
			[
                'label' => __('Width', 'neuron-core'),
                'description' => __('Move the slider to set the width of fixed section.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'condition' => [
					'section_fixed' => 'yes'
				],
				'size_units' => ['px', 'rem', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'width: 100%; max-width: {{SIZE}}{{UNIT}}'
				] 
			]
		);

		$section->add_control(
			'section_fixed_alignment',
			[
				'label' => __('Alignment', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'neuron-core'),
						'icon' => 'fa fa-align-left',
					],
					'right' => [
						'title' => __('Right', 'neuron-core'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'label_block' => false,
				'condition' => [
					'section_fixed' => 'yes'
				],
				'prefix_class' => 'neuron-fixed-alignment-',
			]
		);

		$section->add_control(
			'section_fixed_close_button_heading',
			[
				'label' => __('Close Button', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name' => 'section_fixed_close_button',
							'operator' => '==',
							'value' => 'close-button'
						],
						[
							'name' => 'section_fixed_hidden',
							'operator' => '==',
							'value' => 'yes'
						],
					]
				],
			]
		);

		$section->add_control(
			'section_fixed_close_button_vertical_position',
			[
                'label' => __('Vertical Position', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'default' => [
					'unit' => '%'
				],
				'selectors' => [
					'{{WRAPPER}} .a-close-button' => 'top: {{SIZE}}{{UNIT}}'
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'section_fixed_close_button',
							'operator' => '==',
							'value' => 'close-button'
						],
						[
							'name' => 'section_fixed_hidden',
							'operator' => '==',
							'value' => 'yes'
						],
					]
				],
			]
		);

		$section->add_control(
			'section_fixed_close_button_horizontal_position',
			[
                'label' => __('Horizontal Position', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'default' => [
					'unit' => '%'
				],
				'selectors' => [
					'{{WRAPPER}} .a-close-button' => 'left: {{SIZE}}{{UNIT}}; right: auto;'
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'section_fixed_close_button',
							'operator' => '==',
							'value' => 'close-button'
						],
						[
							'name' => 'section_fixed_hidden',
							'operator' => '==',
							'value' => 'yes'
						],
					]
				],
			]
		);

		$section->add_control(
			'section_fixed_close_button_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-close-button svg' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'section_fixed_close_button',
							'operator' => '==',
							'value' => 'close-button'
						],
						[
							'name' => 'section_fixed_hidden',
							'operator' => '==',
							'value' => 'yes'
						],
					]
				],
			]
		);
		
		$section->add_control(
			'section_fixed_close_button_size',
			[
                'label' => __('Size', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .a-close-button svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important'
				],
				'range' => [
					'px' => [
						'max' => 400
					]
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'section_fixed_close_button',
							'operator' => '==',
							'value' => 'close-button'
						],
						[
							'name' => 'section_fixed_hidden',
							'operator' => '==',
							'value' => 'yes'
						],
					]
				],
			]
		);
		
		$section->end_controls_section();
	}

	/**
	 * Adds required hooks.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function add_hooks() {
		add_action( 'elementor/init', [ $this, 'init' ], 0 );

		add_action('elementor/widgets/widgets_registered', [$this, 'on_widgets_registered']);

		add_action('elementor/element/after_section_end', [$this, 'neuron_fixed_options'], 10, 3);

		add_action('elementor/element/column/layout/before_section_end', [$this, 'neuron_extend_column'], 10);

		add_action(
			'elementor/widgets/widgets_registered',
			function($widgetManager) {
				// WordPress Core
				$widgetManager->unregister_widget_type('wp-widget-pages');
				$widgetManager->unregister_widget_type('wp-widget-calendar');
				$widgetManager->unregister_widget_type('wp-widget-media_audio');
				$widgetManager->unregister_widget_type('wp-widget-media_image');
				$widgetManager->unregister_widget_type('wp-widget-media_gallery');
				$widgetManager->unregister_widget_type('wp-widget-media_video');
				$widgetManager->unregister_widget_type('wp-widget-rss');
				$widgetManager->unregister_widget_type('wp-widget-recent-comments');
				$widgetManager->unregister_widget_type('wp-widget-tag_cloud');
				$widgetManager->unregister_widget_type('wp-widget-search');
				$widgetManager->unregister_widget_type('wp-widget-categories');
				$widgetManager->unregister_widget_type('wp-widget-text');
				$widgetManager->unregister_widget_type('wp-widget-meta');
				$widgetManager->unregister_widget_type('wp-widget-archives');
				$widgetManager->unregister_widget_type('wp-widget-recent-posts');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_product_search');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_price_filter');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_layered_nav');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_layered_nav_filters');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_widget_cart');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_product_categories');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_product_tag_cloud');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_recently_viewed_products');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_recent_reviews');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_top_rated_products');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_rating_filter');
				$widgetManager->unregister_widget_type('wp-widget-woocommerce_products');
				$widgetManager->unregister_widget_type('wp-widget-rev-slider-widget');
				$widgetManager->unregister_widget_type('wp-widget-custom_html');
			}, 10, 3
		);

		add_action('elementor/editor/after_enqueue_styles', function() {
			wp_enqueue_style('neuron-elementor-style', plugin_dir_url(__FILE__) . '../assets/styles/elementor.css', false, NEURON_CORE_VERSION, null);
		});

		add_action('elementor/element/before_section_end', function() {
			wp_enqueue_script('neuron-elementor-script', plugin_dir_url(__FILE__) . '../assets/scripts/elementor.js', array('jquery'), NEURON_CORE_VERSION, TRUE);
		});

		add_action('elementor/theme/register_locations', [$this, 'neuron_register_elementor_locations']);
	}

	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Add support elementor theme locations.
	 */
	public function neuron_register_elementor_locations($elementor_theme_manager) {
		$elementor_theme_manager->register_location('header');
		$elementor_theme_manager->register_location('footer');
	}

	public function neuron_extend_column( $element ) {
		$element->update_control(
			'content_position',
			[
				'selectors' => [
					'{{WRAPPER}}.elementor-column .elementor-column-wrap' => 'align-items: {{VALUE}}',
					'{{WRAPPER}}.elementor-column .elementor-column-wrap .elementor-widget-wrap' => 'align-items: {{VALUE}}',
				],
			]
		);

		$element->add_control(
			'neuron_display',
			[
				'label' => __('Display', 'neuron-core'),
				'type' => 'select',
				'options' => [
					'' => __('Block', 'neuron-core'),
					'flex' => __('Flex', 'neuron-core'),
				],
			]
		);

		$element->add_control(
			'neuron_flex_orientation',
			[
				'label' => __('Content Orientation', 'neuron-core'),
				'type' => 'choose',
				'default' => 'row',
				'options' => [
					'row' => [
						'title' => __('Horizontal', 'neuron-core'),
						'icon' => 'eicon-ellipsis-h',
					],
					'column' => [
						'title' => __('Vertical', 'neuron-core'),
						'icon' => 'eicon-editor-list-ul',
					],
				],
				'label_block' => false,
				'prefix_class' => 'neuron-flex-',
				'condition' => ['neuron_display' => 'flex'],
			]
		);

		$element->add_control(
			'neuron_flex_align',
			[
				'label' => __('Content Align', 'neuron-core'),
				'type' => 'select',
				'options' => [
					'' => __('Default', 'neuron-core'),
					'start' => __('Left', 'neuron-core'),
					'center' => __('Middle', 'neuron-core'),
					'end' => __('Right', 'neuron-core'),
					'space-between' => __('Space Between', 'neuron-core'),
					'space-evenly' => __('Space Evenly', 'neuron-core'),
					'space-around' => __('Space Around', 'neuron-core'),
				],
				'prefix_class' => 'neuron-justify-content-',
				'condition' => [
					'neuron_display' => 'flex',
					'neuron_flex_orientation' => 'row',
				],
			]
		);

		$element->add_control(
			'neuron_flex_vertical_align',
			[
				'label' => __('Content Align', 'neuron-core'),
				'type' => 'select',
				'options' => [
					'' => __('Default', 'neuron-core'),
					'start' => __('Top', 'neuron-core'),
					'center' => __('Middle', 'neuron-core'),
					'end' => __('Bottom', 'neuron-core'),
					'space-between' => __('Space Between', 'neuron-core'),
					'space-evenly' => __('Space Evenly', 'neuron-core'),
					'space-around' => __('Space Around', 'neuron-core')
				],
				'prefix_class' => 'neuron-justify-content-',
				'condition' => [
					'neuron_display' => 'flex',
					'neuron_flex_orientation' => 'column',
				],
			]
		);
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		require __DIR__ . '/widgets/posts/base.php';
		require __DIR__ . '/widgets/media-gallery/base.php';
		require __DIR__ . '/widgets/progress-bar.php';
		require __DIR__ . '/widgets/typed-heading.php';
		require __DIR__ . '/widgets/countdown.php';

		require __DIR__ . '/widgets/site/site-logo.php';
		require __DIR__ . '/widgets/site/site-title.php';
		require __DIR__ . '/widgets/site/nav-menu.php';
		require __DIR__ . '/widgets/site/search-form.php';
		require __DIR__ . '/widgets/site/menu-cart.php';
		require __DIR__ . '/widgets/site/hamburger.php';
	}
	
	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new NeuronPosts());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new NeuronMediaGallery());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new NeuronProgressBar());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new NeuronTypedHeading());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new NeuronCountdown());

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new NeuronSiteLogo());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new NeuronSiteTitle());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new NeuronNavMenu());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new NeuronSearchForm());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new NeuronMenuCart());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new NeuronHamburger());
	}

	/**
	 * Register modules.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_modules() {
		if ( ! class_exists( 'ElementorPro\Plugin' ) ) {
			new Core\Library\Module();
		}

		// new Core\Template\Module();
	}

	/**
	 * Adds actions after Elementor init.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		// Register modules.
		$this->register_modules();

		/**
		 * Elementor Container Width
		 */
		if (!get_option('elementor_container_width')) {
			update_option('elementor_container_width', '1350');
		}

		// Add this category, after basic category.
		Elementor::$instance->elements_manager->add_category(
			'neuron-category',
			[
				'title' => __('Neuron Elements', 'neuron-core'),
				'icon'  => 'fa fa-plug',
			],
			1
		);

		Elementor::$instance->elements_manager->add_category(
			'neuron-site-category',
			[
				'title' => __('Neuron Site', 'neuron-core'),
				'icon'  => 'fa fa-plug',
			],
			2
		);

		do_action('NeuronElementor/init');
	}
}

/**
 * Returns the Plugin application instance.
 *
 * @since 1.0.0
 *
 * @return Plugin
 */
function NeuronElementor() {
	return Plugin::get_instance();
}

/**
 * Initializes the Plugin application.
 *
 * @since 1.0.0
 */
NeuronElementor();
