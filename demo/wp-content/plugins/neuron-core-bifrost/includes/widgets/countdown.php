<?php
namespace NeuronElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */
class NeuronCountdown extends Widget_Base {

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
		return 'neuron-countdown';
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
		return __('Countdown', 'neuron-core');
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
		return 'eicon-countdown neuron-badge';
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
			'countdown_functionality',
			[
				'label' => __('Functionality', 'neuron-core'),
			]
        );

        $this->add_control(
			'due_date',
			[
				'label' => __('Due Date', 'neuron-core'),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'default' => date('Y-m-d H:i', strtotime('+1 month') + (get_option('gmt_offset') * HOUR_IN_SECONDS)),
				'description' => __('Date set according to your timezone: %s.', 'neuron-core'),
			]
        );
        
        $this->add_control(
			'view',
			[
				'label' => __('View', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'block' => __('Block', 'neuron-core'),
					'inline' => __('Inline', 'neuron-core'),
				],
				// 'prefix_class' => 'neuron-fixed-hidden-yes--',
				'default' => 'block'
			]
        );
        
        $this->add_control(
			'days',
			[
				'label' => __('Days', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				// 'prefix_class' => 'neuron-fixed-hidden-',
			]
        );
        
        $this->add_control(
			'hours',
			[
				'label' => __('Hours', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				// 'prefix_class' => 'neuron-fixed-hidden-',
			]
        );
        
        $this->add_control(
			'minutes',
			[
				'label' => __('Minutes', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				// 'prefix_class' => 'neuron-fixed-hidden-',
			]
        );
        
        $this->add_control(
			'seconds',
			[
				'label' => __('Seconds', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				// 'prefix_class' => 'neuron-fixed-hidden-',
			]
        );
        
        $this->add_control(
			'labels',
			[
				'label' => __('Labels', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				// 'prefix_class' => 'neuron-fixed-hidden-',
			]
        );
        
        $this->add_control(
			'custom_labels',
			[
				'label' => __('Custom Labels', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'neuron-core'),
				'label_off' => __('No', 'neuron-core'),
				'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'labels' => 'yes'
                ]
				// 'prefix_class' => 'neuron-fixed-hidden-',
			]
        );
        
        $this->add_control(
			'custom_labels_days',
			[
				'label'   => __('Days', 'neuron-core'),
                'type'    => Controls_Manager::TEXT,
				'default' => __('Days', 'neuron-core'),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'labels',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'custom_labels',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'days',
							'operator' => '==',
							'value' => 'yes'
						], 
					],
				]
			]
        );
        
        $this->add_control(
			'custom_labels_hours',
			[
				'label'   => __('Hours', 'neuron-core'),
                'type'    => Controls_Manager::TEXT,
				'default' => __('Hours', 'neuron-core'),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'labels',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'custom_labels',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'hours',
							'operator' => '==',
							'value' => 'yes'
						], 
					],
				]
			]
        );
        
        $this->add_control(
			'custom_labels_minutes',
			[
				'label'   => __('Minutes', 'neuron-core'),
                'type'    => Controls_Manager::TEXT,
				'default' => __('Minutes', 'neuron-core'),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'labels',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'custom_labels',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'minutes',
							'operator' => '==',
							'value' => 'yes'
						], 
					],
				]
			]
        );
        
        $this->add_control(
			'custom_labels_seconds',
			[
				'label'   => __('Seconds', 'neuron-core'),
                'type'    => Controls_Manager::TEXT,
				'default' => __('Seconds', 'neuron-core'),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'labels',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'custom_labels',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'seconds',
							'operator' => '==',
							'value' => 'yes'
						], 
					],
				]
			]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
			'countdown_boxes',
			[
				'label' => __('Boxes', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_responsive_control(
			'boxes_container_width',
			[
                'label' => __('Container Width', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'size' => '100',
                    'unit' => '%'
                ],
				'selectors' => [
					'{{WRAPPER}} .neuron-countdown-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
				],
			]
        );
        
        $this->add_control(
			'boxes_background_color',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .neuron-countdown-wrapper .neuron-countdown-item' => 'background-color: {{VALUE}}',
                ],
			]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'boxes_border',
				'selector' => '{{WRAPPER}} .neuron-countdown-wrapper .neuron-countdown-item',
				'separator' => 'before',
			]
        );
        
        $this->add_control(
			'boxes_border_radius',
			[
				'label' => __('Border Radius', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .neuron-countdown-wrapper .neuron-countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_responsive_control(
			'boxes_space_between',
			[
                'label' => __('Space Between', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .neuron-countdown-wrapper .neuron-countdown-item:not(:first-of-type)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .neuron-countdown-wrapper .neuron-countdown-item:not(:last-of-type)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
				],
			]
        );

        $this->add_control(
			'boxes_padding',
			[
				'label' => __('Padding', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .neuron-countdown-wrapper .neuron-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
			'countdown_content',
			[
				'label' => __('Content', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'content_numbers_heading',
			[
				'label' => __('Numbers', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::HEADING
			]
        );
        
        $this->add_control(
			'numbers_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .neuron-countdown-wrapper .neuron-countdown-item .neuron-countdown-numbers' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'numbers_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .neuron-countdown-wrapper .neuron-countdown-item .neuron-countdown-numbers',
			]
        );
        
        $this->add_control(
			'content_labels_heading',
			[
				'label' => __('Labels', 'neuron-core'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
			]
        );
        
        $this->add_control(
			'labels_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .neuron-countdown-wrapper .neuron-countdown-item .neuron-countdown-label' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'labels_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .neuron-countdown-wrapper .neuron-countdown-item .neuron-countdown-label',
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
        
        $countdown_markup = [];
        
        $countdown = [
            'days' => [
                'number' => '%D',
                'label' => $settings['custom_labels_days'] ? $settings['custom_labels_days'] : __('Days', 'neuron-core'),
                'visibility' => $settings['days']
            ],
            'hours' => [
                'number' => '%H',
                'label' => $settings['custom_labels_hours'] ? $settings['custom_labels_hours'] : __('Hours', 'neuron-core'),
                'visibility' => $settings['hours']
            ],
            'minutes' => [
                'number' => '%M',
                'label' => $settings['custom_labels_minutes'] ? $settings['custom_labels_minutes'] : __('Minutes', 'neuron-core'),
                'visibility' => $settings['minutes']
            ],
            'seconds' => [
                'number' => '%S',
                'label' => $settings['custom_labels_seconds'] ? $settings['custom_labels_seconds'] : __('Seconds', 'neuron-core'),
                'visibility' => $settings['seconds']
            ],
        ];

        /**
         * View
         */
        if ($settings['view'] == 'block') {
            $countdown_numbers_class = 'neuron-countdown-numbers d-block';
            $countdown_label_class = 'neuron-countdown-label d-block';
        } else {
            $countdown_numbers_class = 'neuron-countdown-numbers d-inline-block';
            $countdown_label_class = 'neuron-countdown-label d-inline-block';
        }

        foreach($countdown as $count) {
            if ($count['visibility'] == 'yes') {
                $countdown_markup[] = '<div class="neuron-countdown-item"><span class="'. $countdown_numbers_class .'">'. $count['number'] .'</span>';
                $countdown_markup[] = $settings['labels'] ? '<span class="'. $countdown_label_class .'">' . $count['label'] .'</span>' : '';
                $countdown_markup[] = '</div>';
            }
        }
		?>
		<div id="<?php echo $this->get_ID() ?>" class="neuron-countdown-wrapper"></div>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#<?php echo $this->get_ID() ?>').countdown('<?php echo $settings['due_date'] ?>', function(event) {
                    var $this = $(this).html(event.strftime('<?php echo implode('', $countdown_markup) ?>'));
                });
            });
        </script>
		<?php
	}
}
