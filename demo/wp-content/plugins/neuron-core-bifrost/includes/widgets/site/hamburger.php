<?php
namespace NeuronElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */
class NeuronHamburger extends Widget_Base {

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
		return 'neuron-hamburger';
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
		return __('Hamburger', 'neuron-core');
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
		return 'eicon-menu-toggle neuron-badge';
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
			'hamburger_functionality',
			[
				'label' => __('Functionality', 'neuron-core'),
			]
		);

		$this->add_control(
			'hamburger_raw',
			[
				'raw' => __('<small>This element purpose is to open the menu when you hide the section via the fixed options.</small>', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'field_type' => 'html'
			]
		);

		$this->add_control(
			'hamburger_alignment',
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
					'{{WRAPPER}} .a-hamburger-holder' => 'justify-content: flex-{{VALUE}} !important; -webkit-box-pack: {{VALUE}} !important; -ms-flex-pack: {{VALUE}} !important;'
				],
				'default' => 'start'
			]
		);

		$this->add_responsive_control(
			'hamburger_size',
			[
				'label' => __('Size', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vw'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1
					]
				],
				'selectors' => [
					'{{WRAPPER}} .a-hamburger svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}} !important',
				]
			]
		);

		$this->add_control(
			'hamburger_selector',
			[
				'label'   => __('Selector', 'neuron-core'),
				'description' => __('Enter which section you\'d like to open with this hamburger, if nothing is set it will open all hidden sections. <br /> <small>Note: Do not enter the hashtag, only the name of the ID, the ID\'s in sections can be added in advanced tab.</small>', 'neuron-core'),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => __('a-uniqe-id', 'neuron-core')
			]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'hamburger_style',
			[
				'label' => __('Style', 'neuron-core'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs('hamburger_normal');

		$this->start_controls_tab(
			'hamburger_normal_tab',
			[
				'label' => __('Normal', 'neuron-core'),
			]
		);

		$this->add_control(
			'hamburger_normal_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-hamburger svg line' => 'stroke: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'hamburger_normal_bg_color',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-hamburger' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hamburger_hover_tab',
			[
				'label' => __('Hover', 'neuron-core'),
			]
		);

		$this->add_control(
			'hamburger_hover_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-hamburger:hover svg line' => 'stroke: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'hamburger_hover_bg_color',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-hamburger:hover' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'hamburger_padding',
			[
				'label' => __('Padding', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .a-hamburger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
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

		if ($settings['hamburger_selector']) {
			$hamburger_selector = '#' . $settings['hamburger_selector']; 
		} else {
			$hamburger_selector = '.neuron-fixed-hidden-yes';
		}
	?>
		<div class="a-hamburger-holder d-flex justify-content-center" id="<?php echo esc_attr($this->get_ID()) ?>">
			<a href="#" class="a-hamburger d-inline-flex" id="fixed-section-hamburger">
				<svg style="enable-background:new 0 0 139 139;" width="42px" height="42px" version="1.1" viewBox="0 0 139 139" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><line class="st0" x1="26.5" x2="112.5" y1="46.3" y2="46.3"/><line class="st0" id="XMLID_9_" x1="26.5" x2="112.5" y1="92.7" y2="92.7"/><line class="st0" id="XMLID_8_" x1="26.5" x2="112.5" y1="69.5" y2="69.5"/></svg>
			</a>
		</div>
		<script>
			jQuery(document).ready(function($) {
				$('.a-hamburger-holder#<?php echo esc_attr($this->get_ID()) ?> #fixed-section-hamburger').on('click', function(e) {
					e.preventDefault();
					e.stopPropagation();

					$('<?php echo esc_attr($hamburger_selector) ?>').toggleClass('active');
				});
			});
		</script>
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
