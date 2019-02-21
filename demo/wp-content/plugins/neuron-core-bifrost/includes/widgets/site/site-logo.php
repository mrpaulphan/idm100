<?php
namespace NeuronElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */
class NeuronSiteLogo extends Widget_Base {

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
		return 'neuron-site-logo';
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
		return __('Site Logo', 'neuron-core');
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
		return 'eicon-site-logo neuron-badge';
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
			'site_logo_functionality',
			[
				'label' => __('Functionality', 'neuron-core'),
			]
		);
		
		$this->add_control(
			'site_logo_image',
			[
				'label' => __('Image', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src()
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'site_logo_image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label' => __('Image Size', 'neuron-core'),
				'description' => __('Select the image size.', 'neuron-core'),
				'default' => 'full'
			]
		);

		$this->add_control(
			'site_logo_alignment',
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .neuron-logo' => 'justify-content: flex-{{VALUE}} !important; -webkit-box-pack: {{VALUE}} !important; -ms-flex-pack: {{VALUE}} !important;'
				],
				'default' => 'start'
			]
		);

		$this->add_control(
			'site_logo_link',
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
			'site_logo_link_external',
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
					'site_logo_link' => 'external-url'
				]
			]
		);

		$this->add_responsive_control(
			'site_logo_width',
			[
				'label' => __('Width', 'neuron-core'),
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
					'{{WRAPPER}} .neuron-logo img' => 'width: {{SIZE}}{{UNIT}}',
				],
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
		 * Image Size
		 */
		if ($settings['site_logo_image_size_size']) {
			$neuron_site_logo_size = $settings['site_logo_image_size_size'] == 'custom' ? [isset($settings['site_logo_image_size_custom_dimension']['width']) ? $settings['site_logo_image_size_custom_dimension']['width'] : 500, isset($settings['site_logo_image_size_custom_dimension']['height']) ? $settings['site_logo_image_size_custom_dimension']['height'] : 9999] : $settings['site_logo_image_size_size'];
		} else {
			$neuron_site_logo_size = 'full';
		}

		/**
		 * Link
		 */
		switch ($settings['site_logo_link']) {
			case 'none':
				$neuron_site_logo_link = 'none';
				break;
			default:
				$neuron_site_logo_link = get_home_url('/');
				break;
			case 'external-url':
				$neuron_site_logo_link = isset($settings['site_logo_link_external']['url']) && $settings['site_logo_link_external']['url'] != 0 ? $settings['site_logo_link_external']['url'] : '#';
				break;
		}
		
		echo sprintf(
			'<div class="%s"><a %s target="%s" %s>%s</a></div>',
			'neuron-logo d-flex justify-content-center',
			$neuron_site_logo_link != 'none' ? 'href='. esc_url($neuron_site_logo_link) .'' : '',
			$neuron_site_logo_link != 'none' && isset($settings['site_logo_link_external']['is_external']) && $settings['site_logo_link_external']['is_external'] == 'on' 
			? '_blank' : '_self',
			$neuron_site_logo_link != 'none' && isset($settings['site_logo_link_external']['nofollow']) && $settings['site_logo_link_external']['nofollow'] == '1' 
			? 'rel="nofollow"' : '',
			isset($settings['site_logo_image']['id']) && $settings['site_logo_image']['id'] != 0 ? wp_get_attachment_image($settings['site_logo_image']['id'], $neuron_site_logo_size) : '<img src='. \Elementor\Utils::get_placeholder_image_src() .' />'
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
