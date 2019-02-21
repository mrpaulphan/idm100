<?php
namespace NeuronElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */
class NeuronTypedHeading extends Widget_Base {

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
		return 'neuron-typed-heading';
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
		return __('Typed Heading', 'neuron-core');
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
		return 'eicon-animation-text neuron-badge';
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
			'typed_heading_functionality',
			[
				'label' => __('Functionality', 'neuron-core'),
			]
        );
        
		$this->add_control(
			'typed_heading_content',
			[
				'label' => __('Content', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __('This is an {{Amazing, Interactive}} Heading.', 'neuron-core'),
				'description' => __('Add the words inside the double curly brackets, separate the words with commas. <br /> <small>{{First Word, Second Word, Third Word}}</small>', 'neuron-core')
			]
		);

		$this->add_control(
			'typed_heading_loop',
			[
				'label' => __('Loop', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'typed_heading_cursor_char',
			[
				'label' => __('Cursor Character', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'typed_heading_type_speed',
			[
				'label' => __('Type Speed', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 9999,
				'step' => 1,
				'default' => 110,
			]
		); 

		$this->add_control(
			'typed_heading_start_delay',
			[
				'label' => __('Start Delay', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 9999,
				'step' => 1,
				'default' => 310,
			]
		);

		$this->add_control(
			'typed_heading_back_delay',
			[
				'label' => __('Back Delay', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 9999,
				'step' => 1,
				'default' => 510,
			]
		);

		$this->add_control(
			'typed_heading_back_speed',
			[
				'label' => __('Back Speed', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 9999,
				'step' => 1,
				'default' => 60,
			]
		);

		$this->add_control(
			'typed_heading_html_tag',
			[
				'label' => __('HTML Tag', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'h1' => __('H1', 'neuron-core'),
					'h2' => __('H2', 'neuron-core'),
					'h3' => __('H3', 'neuron-core'),
					'h4' => __('H4', 'neuron-core'),
					'h5' => __('H5', 'neuron-core'),
					'h6' => __('H6', 'neuron-core'),
					'div' => __('div', 'neuron-core'),
					'span' => __('span', 'neuron-core'),
					'p' => __('p', 'neuron-core')
				],
				'default' => 'h1'
			]
		);

		$this->add_control(
			'typed_heading_alignment',
			[
				'label' => __('Alignment', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'neuron-core'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'neuron-core'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'neuron-core'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
			]
		);
        
		$this->end_controls_section();
		

		$this->start_controls_section(
			'style_section',
			[
				'label' => __('Style', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'typed_heading_content_color',
			[
				'label' => __('Content Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-typed-block' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'typed_heading_typed_color',
			[
				'label' => __('Typed Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-typed-block span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'typed_heading_typed_background_color',
			[
				'label' => __('Typed Background Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-typed-block span' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typed_heading_content_typography',
				'label' => __('Content Typography', 'neuron-core'),
				'selector' => '{{WRAPPER}} .a-typed-block'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typed_heading_typography',
				'label' => __('Typed Typography', 'neuron-core'),
				'selector' => '{{WRAPPER}} .a-typed-block span'
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
		$neuron_temporary_strings = $settings['typed_heading_content'];
		$neuron_typed_heading_class = ['a-typed-block'];

		if ($settings['typed_heading_content']) {
			$typed_span = "<span id='typed-strings-". $this->get_id() ."'></span>";
			preg_match_all("/\\{{(.*?)\\}}/", $settings['typed_heading_content'], $typed_strings);
			$settings['typed_heading_content'] = preg_replace("/\\{{(.*?)\\}}/", $typed_span, $settings['typed_heading_content']);
			$typed_strings[1][0] = explode(', ', $typed_strings[1][0]);
		}
		
		// Alignment
		if ($settings['typed_heading_alignment'] == 'center') {
			$neuron_typed_heading_class[] = 'h-align-center';		
		} elseif ($settings['typed_heading_alignment'] == 'right') {
			$neuron_typed_heading_class[] = 'h-align-right';			
		}

		// HTML Output
		echo '<'. esc_attr($settings['typed_heading_html_tag']) .' class="'. esc_attr(implode(' ', $neuron_typed_heading_class)) .'">' . wp_kses_post($settings['typed_heading_content']) . '</'. esc_attr($settings['typed_heading_html_tag']) .'>';
		?>
		<script>
			jQuery(document).ready(function($){
				new Typed("#typed-strings-<?php echo esc_attr($this->get_id()) ?>", {
					'cursorChar': '<?php echo esc_attr($settings['typed_heading_cursor_char'] ?  $settings['typed_heading_cursor_char'] : '_') ?>', 
					'backSpeed': <?php echo esc_attr($settings['typed_heading_back_speed'] ?  $settings['typed_heading_back_speed'] : '60') ?>,  
					'backDelay': <?php echo esc_attr($settings['typed_heading_back_delay'] ?  $settings['typed_heading_back_delay'] : '510') ?>, 
					'startDelay': <?php echo esc_attr($settings['typed_heading_start_delay'] ?  $settings['typed_heading_start_delay'] : '510') ?>, 
					'typeSpeed': <?php echo esc_attr($settings['typed_heading_type_speed'] ?  $settings['typed_heading_type_speed'] : '510') ?>,  
					'loop': <?php echo esc_attr($settings['typed_heading_loop'] === 'yes' ? 'true' : 'false') ?>,
					'strings': [<?php foreach( $typed_strings[1][0] as $neuron_explode ){ if ($neuron_explode != null ){ echo "\"" . esc_attr($neuron_explode) . "\"" . ","; } }?>]
				});
			});
		</script>
		<?php
	}
}
