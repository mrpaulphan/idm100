<?php
namespace NeuronElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */
class NeuronProgressBar extends Widget_Base {

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
		return 'neuron-progress-bar';
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
		return __('Progress Bar', 'neuron-core');
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
		return 'eicon-skill-bar neuron-badge';
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
		return ['neuron-category'];
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
			'progress_bar_functionality',
			[
				'label' => __('Functionality', 'neuron-core'),
			]
        );
        
        $this->add_control(
			'progress_bar_title',
			[
				'label'   => __('Title', 'neuron-core'),
				'description' => __('Enter the title of the progress bar.', 'neuron-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Example Title', 'neuron-core')
			]
        );
        
        $this->add_control(
			'progress_bar_percentage',
			[
                'label' => __('Percentage', 'neuron-core'),
                'description' => __('Select the percentage of the progress bar between 1 and 100.', 'neuron-core'),
				'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				]
			]
        );
        
        $this->add_control(
			'progress_bar_height',
			[
				'label'   => __('Height', 'neuron-core'),
				'description' => __('Enter the height of the progress bar.', 'neuron-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
				'min'     => 1,
				'max'     => 500,
				'step'    => 1
			]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'progress_bar_style',
			[
				'label' => __('Style', 'neuron-core'),
			]
        );

        $this->add_control(
			'progress_bar_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-progress-bar .m-progress-bar__content-holder .m-progress-bar__content span' => 'background-color: {{VALUE}}',
				]
			]
        );
        
        $this->add_control(
			'progress_bar_bg_color',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-progress-bar .m-progress-bar__content-holder' => 'background-color: {{VALUE}}',
				]
			]
        );
        
        $this->add_control(
			'progress_bar_title_color',
			[
				'label' => __('Title Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-progress-bar .m-progress-bar__label .m-progress-bar__title' => 'color: {{VALUE}}',
				]
			]
        );
        
        $this->add_control(
			'progress_bar_percentage_color',
			[
				'label' => __('Percentage Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-progress-bar .m-progress-bar__label span' => 'color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'typography_section',
			[
				'label' => __('Typography', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'progress_bar_title_typography',
				'label' => __('Title', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .m-progress-bar .m-progress-bar__label .m-progress-bar__title'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'progress_bar_percentage_typography',
				'label' => __('Percentage', 'neuron-core'),
				'selector' => '{{WRAPPER}} .m-progress-bar .m-progress-bar__label span'
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
        <div class="m-progress-bar">
            <div class="m-progress-bar__label d-flex align-items-center">
                <div class="m-progress-bar__title"><?php echo esc_attr($settings['progress_bar_title']) ?></div>
                <span class="m-progress-bar__label__units ml-auto"><?php echo esc_attr($settings['progress_bar_percentage']['size']) ?>%</span>
            </div>
            <div class="m-progress-bar__content-holder" style="height: <?php echo esc_attr($settings['progress_bar_height'] / 12) ?>rem">
                <span class="m-progress-bar__content" style="width: <?php echo esc_attr($settings['progress_bar_percentage']['size']) ?>%">
                    <span class="h-expanWidthNeuron wow"></span>
                </span>
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
