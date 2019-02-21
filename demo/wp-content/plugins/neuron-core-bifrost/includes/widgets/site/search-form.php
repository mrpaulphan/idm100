<?php
namespace NeuronElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */
class NeuronSearchForm extends Widget_Base {

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
		return 'neuron-search-form';
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
		return __('Search Form', 'neuron-core');
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
		return 'eicon-site-search neuron-badge';
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
			'search_form_functionality',
			[
				'label' => __('Functionality', 'neuron-core')
			]
		);

		$this->add_control(
			'search_form_raw',
			[
				'raw' => __('<small>If you\'re experiencing issues while opening the lightbox of the search, please reload the page on editor or check it on the front-end.</small>', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'field_type' => 'html'
			]
		);
		
		$this->add_control(
			'search_form_placeholder',
			[
				'label' => __('Placeholder', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __('Search...', 'neuron-core')
			]
		);

		$this->add_control(
			'search_form_alignment',
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
					'{{WRAPPER}} .a-site-search-icon-holder' => 'justify-content: flex-{{VALUE}} !important; -webkit-box-pack: {{VALUE}} !important; -ms-flex-pack: {{VALUE}} !important;'
				],
				'default' => 'start'
			]
		);

		$this->add_responsive_control(
			'search_form_size',
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
					'{{WRAPPER}} .a-site-search-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}} !important',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'search_form_style',
			[
				'label' => __('Style', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs('search_form_normal');

		$this->start_controls_tab(
			'search_form_normal_tab',
			[
				'label' => __('Normal', 'neuron-core'),
			]
		);

		$this->add_control(
			'search_form_normal_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-site-search-icon svg line' => 'stroke: {{VALUE}} !important',
					'{{WRAPPER}} .a-site-search-icon svg circle' => 'stroke: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'search_form_hover_tab',
			[
				'label' => __('Hover', 'neuron-core'),
			]
		);

		$this->add_control(
			'search_form_hover_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-site-search-icon:hover svg line' => 'stroke: {{VALUE}} !important',
					'{{WRAPPER}} .a-site-search-icon:hover svg circle' => 'stroke: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'search_form_overlay',
			[
				'label' => __('Overlay', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'search_form_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .m-site-search .m-site-search__content .m-site-search__content__inner .m-site-search__form input[type="search"]'
			]
		);

		$this->add_control(
			'search_form_text_color',
			[
				'label' => __('Text Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-site-search .m-site-search__content .m-site-search__content__inner .m-site-search__form input[type="search"]' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-site-search .m-site-search__content .m-site-search__content__inner .m-site-search__form .m-site-search__form__icon span' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-site-search .m-site-search__content .m-site-search__content__inner .m-site-search__form input::-webkit-input-placeholder' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-site-search .m-site-search__content .m-site-search__content__inner .m-site-search__form input:-moz-placeholder' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-site-search .m-site-search__content .m-site-search__content__inner .m-site-search__form input::-moz-placeholder' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-site-search .m-site-search__content .m-site-search__content__inner .m-site-search__form input:-ms-input-placeholder' => 'color: {{VALUE}} !important',
				]
			]
		);

		$this->add_control(
			'search_form_background_color',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-site-search .m-site-search__content' => 'background-color: {{VALUE}} !important'
				]
			]
		);

		$this->add_responsive_control(
			'search_form_icon_size',
			[
				'label' => __('Icon Size', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vw'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1
					]
				],
				'selectors' => [
					'{{WRAPPER}} .m-site-search .m-site-search__content .m-site-search__content__inner .m-site-search__form .m-site-search__form__icon span svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
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

		/**
		 * Placeholder
		 */
		if ($settings['search_form_placeholder']) {
			$neuron_search_form_placeholder = $settings['search_form_placeholder'];
		} else {
			$neuron_search_form_placeholder = __('Search...', 'default-neuron');
		}
	?>
        <div class="m-site-search-holder">
			<div class="a-site-search-icon-holder d-flex justify-content-center">
				<a class="a-site-search-icon d-inline-flex" href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
				</a>
			</div>
			<div class="m-site-search">
				<div class="m-site-search__content">
					<div class="m-site-search__close-icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
					</div>
					<div class="container">
						<div class="m-site-search__content__inner">
							<div class="m-site-search__form">
								<form action="<?php echo esc_url(home_url('/')) ?>" method="get">
									<input class="m-site-search__form__input" placeholder="<?php echo esc_attr($neuron_search_form_placeholder) ?>" type="search" name="s" id="search" />
									<label class="m-site-search__form__icon">
										<input type="submit" />
										<span>
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
										</span>
									</label>
								</form>
							</div>
						</div>
					</div>
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
