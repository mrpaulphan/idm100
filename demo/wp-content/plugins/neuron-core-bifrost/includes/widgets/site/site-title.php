<?php
namespace NeuronElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */
class NeuronSiteTitle extends Widget_Base {

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
		return 'neuron-site-title';
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
		return __('Site Title', 'neuron-core');
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
		return 'eicon-site-title neuron-badge';
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
			'site_title_functionality',
			[
				'label' => __('Functionality', 'neuron-core'),
			]
		);
		
		$this->add_control(
			'site_title',
			[
                'label' => __('Title', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'site-title' => __('Site Title', 'neuron-core'),
					'custom' => __('Custom', 'neuron-core'),
				],
				'default' => 'site-title'
			]
		);

		$this->add_control(
			'site_title_custom_title',
			[
				'label' => __('Custom Title', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'site_title' => 'custom'
				]
			]
		);

		$this->add_control(
			'site_title_link',
			[
                'label' => __('Link', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'none' => __('None', 'neuron-core'),
					'site-url' => __('Site URL', 'neuron-core'),
                    'external-url' => __('External URL', 'neuron-core')
				],
				'default' => 'site-url'
			]
		);

		$this->add_control(
			'site_title_link_external',
			[
				'label' => __('External Link', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://neuronthemes.com', 'neuron-core'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
				'condition' => [
					'site_title_link' => 'external-url'
				]
			]
		);

		$this->add_responsive_control(
			'site_title_size',
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
					'{{WRAPPER}} .neuron-site-title a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'site_title_html_tag',
			[
				'label' => __('HTML Tag', 'neuron-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'site_title_style',
			[
				'label' => __('Style', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'site_title_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .neuron-site-title a' => 'color: {{VALUE}} !important',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'site_title_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .neuron-site-title a'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'site_title_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .neuron-site-title a'
			]
		);

		$this->add_control(
			'site_title_alignment',
			[
				'label' => __('Alignment', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'neuron-core'),
						'icon' => 'fa fa-align-left'
					],
					'center' => [
						'title' => __('Center', 'neuron-core'),
						'icon' => 'fa fa-align-center'
					],
					'right' => [
						'title' => __('Right', 'neuron-core'),
						'icon' => 'fa fa-align-right'
					],
				],
				'selectors' => [
					'{{WRAPPER}} .neuron-site-title' => 'text-align: {{VALUE}}',
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

		$neuron_site_title = $settings['site_title'] == 'custom' ? $settings['site_title_custom_title'] : get_bloginfo('title');

		/**
		 * Link
		 */
		switch ($settings['site_title_link']) {
			case 'none':
				$neuron_site_title_link = 'none';
				break;
			default:
				$neuron_site_title_link = get_home_url('/');
				break;
			case 'external-url':
				$neuron_site_title_link = isset($settings['site_title_link_external']['url']) && $settings['site_title_link_external']['url'] != 0 ? $settings['site_title_link_external']['url'] : '#';
				break;
		}

		echo sprintf(
			'<%s class="%s"><a %s target="%s" %s>%s</a></%s>',
			esc_attr($settings['site_title_html_tag']),
			'neuron-site-title',
			$neuron_site_title_link != 'none' ? 'href='. esc_url($neuron_site_title_link) .'' : '',
			$neuron_site_title_link != 'none' && isset($settings['site_title_link_external']['is_external']) && $settings['site_title_link_external']['is_external'] == 'on' 
			? '_blank' : '_self',
			$neuron_site_title_link != 'none' && isset($settings['site_title_link_external']['nofollow']) && $settings['site_title_link_external']['nofollow'] == '1' 
			? 'rel="nofollow"' : '',
			$neuron_site_title,
			esc_attr($settings['site_title_html_tag'])
		);
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
