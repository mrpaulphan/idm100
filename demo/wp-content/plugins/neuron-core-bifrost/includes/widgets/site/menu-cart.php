<?php
namespace NeuronElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (!class_exists('WooCommerce')) {
	return;
}

/**
 * @since 1.0.0
 */
class NeuronMenuCart extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'neuron-menu-cart';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __('Menu Cart', 'neuron-core');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-cart-light neuron-badge';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['neuron-site-category'];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'menu_cart_functionality',
			[
				'label' => __('Functionality', 'neuron-core'),
			]
		);

		$this->add_control(
			'menu_cart_raw',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __('Do not forget to select the cart page at WooCommerce > Settings > Advanced.', 'neuron-core'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_control(
			'menu_cart_alignment',
			[
				'label' => __('Alignment', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => __('Left', 'neuron-core'),
						'icon' => 'fa fa-align-left'
					],
					'center' => [
						'title' => __('Center', 'neuron-core'),
						'icon' => 'fa fa-align-center'
					],
					'end' => [
						'title' => __('Right', 'neuron-core'),
						'icon' => 'fa fa-align-right'
					],
				],
				'label_block' => false,
				'selectors' => [
					'{{WRAPPER}} .l-primary-header__bag-holder' => 'justify-content: flex-{{VALUE}} !important; -webkit-box-pack: {{VALUE}} !important; -ms-flex-pack: {{VALUE}} !important;'
				],
				'default' => 'start'
			]
		);

		$this->add_control(
			'menu_cart_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-primary-header__bag__icon' => 'color: {{VALUE}} !important',
				]
			]
		);

		$this->add_responsive_control(
			'menu_cart_size',
			[
				'label' => __('Size', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vw'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-primary-header__bag__icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important',
				]
			]
		);

		$this->add_control(
			'menu_cart_content',
			[
				'label' => __('Hide Cart Content', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
				'selectors' => [
					'{{WRAPPER}} .l-primary-header__bag .o-mini-cart' => 'display: none !important',
				]
			]
		);
		
		$this->add_control(
			'menu_cart_badge_heading',
			[
				'label' => __('Badge', 'neuron-core'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'menu_cart_badge_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-primary-header__bag .l-primary-header__bag__icon span' => 'color: {{VALUE}} !important',
				]
			]
		);

		$this->add_control(
			'menu_cart_badge_background_color',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-primary-header__bag .l-primary-header__bag__icon span' => 'background-color: {{VALUE}} !important',
				]
			]
		);

		$this->add_responsive_control(
			'menu_cart_badge_size',
			[
				'label' => __('Size', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vw'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-primary-header__bag__icon span.number' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important; line-height: {{SIZE}}{{UNIT}} !important',
				]
			]
		);

		$this->add_responsive_control(
			'menu_cart_badge_number',
			[
				'label' => __('Number', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vw'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-primary-header__bag__icon span.number' => 'font-size: {{SIZE}}{{UNIT}} !important',
				]
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
	?>
		<div class="l-primary-header__bag-holder d-flex justify-content-center">
			<div class="l-primary-header__bag d-inline-flex">
				<a class="l-primary-header__bag__icon" href="<?php echo esc_url(wc_get_cart_url()) ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
					<span class="number">
						<?php 
							if (isset(WC()->cart->cart_contents_count)) {
								echo sprintf('%d', WC()->cart->cart_contents_count); 
							} elseif (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
								echo 0;
							}
						?>	
					</span>
				</a>
				<div class="o-mini-cart">
					<div class="o-mini-cart__holder widget_shopping_cart_content"></div>
				</div>
			</div>
		</div>
	<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {}
}
