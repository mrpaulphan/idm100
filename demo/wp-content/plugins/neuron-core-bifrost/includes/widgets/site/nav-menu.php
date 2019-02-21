<?php
namespace NeuronElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */
class NeuronNavMenu extends Widget_Base {

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
		return 'neuron-nav-menu';
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
		return __('Nav Menu', 'neuron-core');
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
		return 'eicon-nav-menu neuron-badge';
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

	private function get_all_menus() {
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
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
			'nav_menu_functionality',
			[
				'label' => __('Functionality', 'neuron-core'),
			]
		);

		$this->add_control(
			'nav_menu_raw',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __('<strong>If there is any issue on the mega menu or dropdown menu, please reload the editor.</strong>', 'neuron-core'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info'
			]
		);
		
		$menus = $this->get_all_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'nav_menu',
				[
					'label' => __('Menu', 'neuron-core'),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys($menus)[0],
					'save_default' => true,
					'description' => sprintf(__('Go to the <a href="%s" target="_blank">Menus Screen</a> to manage your menus.', 'neuron-core'), admin_url('nav-menus.php')),
				]
			);
		} else {
			$this->add_control(
				'nav_menu',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus Screen</a> to create one.', 'neuron-core'), admin_url('nav-menus.php?action=edit&menu=0')),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->add_control(
			'nav_menu_layout',
			[
                'label' => __('Layout', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'horizontal' => __('Horizontal', 'neuron-core'),
					'vertical' => __('Vertical', 'neuron-core')
				],
				'default' => 'horizontal',
				'render_type' => 'template'
			]
		);

		$this->add_responsive_control(
			'nav_menu_alignment',
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
					'{{WRAPPER}} nav > ul:not(.sub-menu)' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} nav > ul li.menu-item-has-children .menu-item-icon' => '{{VALUE}}: auto',
					'{{WRAPPER}} nav > ul li.menu-item-has-children ul.sub-menu' => 'padding-{{VALUE}}: 1.8333333333rem',
				],
				'label_block' => false,
				'default' => 'left'
			]
		);

		$this->add_control(
			'nav_menu_mobile_menu_heading',
			[
				'label' => __('Mobile Menu', 'neuron-core'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'nav_menu_mobile_visibility',
			[
				'label' => __('Visibility', 'neuron-core'),
				'type' => Controls_Manager::SWITCHER,
				'description' => __('Activate the mobile menu on the mobile devices.', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'm-nav-menu--breakpoint-'
			]
		);

		$this->add_control(
			'nav_menu_mobile_breakpoint',
			[
				'label' => __('Breakpoint', 'neuron-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'desktop' => __('Desktop', 'neuron-core'),
					'tablet' => __('Tablet', 'neuron-core'),
					'mobile' => __('Mobile', 'neuron-core'),
				],
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				],
				'prefix_class' => 'm-nav-menu--breakpoint-',
				'default' => 'mobile'
			]
		);

		$this->add_control(
			'nav_menu_mobile_full_width',
			[
				'label' => __('Full Width', 'neuron-core'),
				'type' => Controls_Manager::SWITCHER,
				'description' => __('Stretch the dropdown of the menu to full width.', 'neuron-core'),
				'prefix_class' => 'm-nav-menu--',
				'return_value' => 'stretch',
				'default' => 'stretch',
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'nav_menu_mobile_dropdown_toggle_alignment',
			[
				'label' => __('Toggle Alignment', 'neuron-core'),
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
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile-icon-holder' => 'justify-content: flex-{{VALUE}} !important; -webkit-box-pack: {{VALUE}} !important; -ms-flex-pack: {{VALUE}} !important;'
				],
				'default' => 'start'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'nav_menu_style',
			[
				'label' => __('Main Menu', 'neuron-core'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'nav_menu_typography',
				'selector' => '{{WRAPPER}} nav > ul > li > a',
			]
		);

		$this->start_controls_tabs('nav_menu_normal');

		$this->start_controls_tab(
			'nav_menu_normal_tab',
			[
				'label' => __('Normal', 'neuron-core'),
			]
		);

		$this->add_control(
			'nav_menu_normal_color',
			[
				'label' => __('Text Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--horizontal > ul > li > a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--vertical > ul > li > a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--mobile nav > ul > li > a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_menu_hover_tab',
			[
				'label' => __('Hover', 'neuron-core'),
			]
		);

		$this->add_control(
			'nav_menu_hover_color',
			[
				'label' => __('Text Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--horizontal ul li:hover > a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--vertical ul li:hover > a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--mobile nav ul li:hover > a' => 'color: {{VALUE}} !important',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_menu_active_tab',
			[
				'label' => __('Active', 'neuron-core'),
			]
		);

		$this->add_control(
			'nav_menu_active_color',
			[
				'label' => __('Text Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--horizontal ul li.menu-item.current_page_ancestor > a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--horizontal ul li.menu-item.current_page_item > a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--vertical ul li.menu-item.current_page_ancestor > a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--vertical ul li.menu-item.current_page_item > a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--mobile ul li.menu-item.current_page_ancestor > a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--mobile ul li.menu-item.current_page_item > a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'nav_menu_horizontal_padding',
			[
				'label' => __('Horizontal Padding', 'neuron-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'size_units' => ['px', 'rem'],
				'devices' => ['desktop', 'tablet'],
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--horizontal > ul > li' => 'margin-left: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .m-nav-menu--vertical > ul > li' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'nav_menu_vertical_padding',
			[
				'label' => __('Vertical Padding', 'neuron-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'size_units' => ['px', 'rem'],
				'devices' => ['desktop', 'tablet'],
				'selectors' => [
					'{{WRAPPER}} nav > ul > li' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .m-nav-menu--vertical > ul > li.menu-item-has-children > .menu-item-icon' => 'margin-top: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .m-nav-menu--mobile nav > ul > li.menu-item-has-children > .menu-item-icon' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'nav_menu_dropdown',
			[
				'label' => __('Dropdown', 'neuron-core'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'nav_menu_dropdown_typography',
				'exclude' => ['line_height'],
				'selector' => '{{WRAPPER}} nav ul li.menu-item-has-children > ul.sub-menu li a, {{WRAPPER}} nav ul li.menu-item.menu-item-has-children.m-mega-menu > ul.sub-menu > li.menu-item ul.sub-menu li.menu-item a',
			]
		);

		$this->add_responsive_control(
			'nav_menu_dropdown_background_color',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} nav ul li.menu-item-has-children > ul.sub-menu' => 'background-color: {{VALUE}} !important',
				],
				'separator' => 'after'
			]
		);

		$this->start_controls_tabs('nav_menu_dropdown_tabs');

		$this->start_controls_tab(
			'nav_menu_dropdown_normal_tab',
			[
				'label' => __('Normal', 'neuron-core'),
			]
		);

		$this->add_responsive_control(
			'nav_menu_dropdown_normal_text_color',
			[
				'label' => __('Text Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} nav ul li.menu-item-has-children > ul.sub-menu li a' => 'color: {{VALUE}} !important',
				],
				'separator' => 'after'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_menu_dropdown_hover_tab',
			[
				'label' => __('Hover', 'neuron-core'),
			]
		);

		$this->add_responsive_control(
			'nav_menu_dropdown_hover_text_color',
			[
				'label' => __('Text Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} nav ul li.menu-item-has-children > ul.sub-menu li:hover > a' => 'color: {{VALUE}} !important',
				],
				'separator' => 'after'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_menu_dropdown_active_tab',
			[
				'label' => __('Active', 'neuron-core'),
			]
		);

		$this->add_responsive_control(
			'nav_menu_dropdown_active_text_color',
			[
				'label' => __('Text Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} nav ul li.menu-item-has-children > ul.sub-menu li.current-menu-item > a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} nav ul li.menu-item-has-children > ul.sub-menu li.current_page_ancestor > a' => 'color: {{VALUE}} !important',
				],
				'separator' => 'after'
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'nav_menu_dropdown_width',
			[
				'label' => __('Width', 'neuron-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'rem'],
				'range' => [
					'px' => [
						'max' => '400'
					]
				],
				'selectors' => [
					'{{WRAPPER}} nav ul li.menu-item-has-children > ul.sub-menu' => 'min-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'nav_menu_layout' => 'horizontal'
				]
			]
		);

		$this->add_responsive_control(
			'nav_menu_dropdown_spacing',
			[
				'label' => __('Spacing', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'rem', 'em'],
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--horizontal ul li.menu-item-has-children > ul.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .m-nav-menu--horizontal ul li.menu-item-has-children:not(.m-mega-menu) > ul.sub-menu ul.sub-menu' => 'margin-top: -{{TOP}}{{UNIT}} !important; margin-left: calc({{RIGHT}}{{UNIT}} + 1px) !important;',
					'{{WRAPPER}} .m-nav-menu--horizontal ul li.menu-item-has-children:not(.m-mega-menu) > ul.sub-menu ul.sub-menu::before' => 'left: calc(-{{RIGHT}}{{UNIT}} - 1px) !important; width: calc({{RIGHT}}{{UNIT}} + 2px) !important;',
					'{{WRAPPER}} .m-nav-menu--horizontal ul li.menu-item-has-children:not(.m-mega-menu) > ul.sub-menu ul.sub-menu.sub-menu--left' => 'margin-right: calc({{RIGHT}}{{UNIT}} + 1px) !important; margin-left: 0 !important;',
					'{{WRAPPER}} .m-nav-menu--horizontal ul li.menu-item-has-children:not(.m-mega-menu) > ul.sub-menu ul.sub-menu.sub-menu--left::before' => 'right: calc(-{{LEFT}}{{UNIT}} - 1px) !important; width: calc({{LEFT}}{{UNIT}} + 2px) !important; left: auto !important;',
					'{{WRAPPER}} .m-nav-menu--horizontal ul.m-mega-menu-holder li.menu-item-has-children.m-mega-menu > ul.sub-menu' => 'padding-top: {{TOP}}{{UNIT}} !important; padding-bottom: {{BOTTOM}}{{UNIT}} !important;',
					'{{WRAPPER}} .m-nav-menu--horizontal ul.m-mega-menu-holder li.menu-item-has-children.m-mega-menu > ul.sub-menu > li' => 'padding-right: {{RIGHT}}{{UNIT}} !important; padding-left: {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .m-nav-menu--vertical ul li.menu-item-has-children > ul.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .m-nav-menu--mobile ul li.menu-item-has-children > ul.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'nav_menu_dropdown_vertical_padding',
			[
				'label' => __('Vertical Padding', 'neuron-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'rem'],
				'selectors' => [
					'{{WRAPPER}} nav ul li.menu-item-has-children > ul.sub-menu li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				]
			]
		);

		$this->add_responsive_control(
			'nav_menu_dropdown_offset',
			[
				'label' => __('Offset', 'neuron-core'),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--horizontal > ul > li.menu-item-has-children > ul.sub-menu' => 'margin-top: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .m-nav-menu--horizontal > ul > li.menu-item-has-children > ul.sub-menu::before' => 'height: {{SIZE}}{{UNIT}} !important; top: -{{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .m-nav-menu--vertical > ul > li.menu-item-has-children > ul.sub-menu' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .m-nav-menu--mobile ul li.menu-item-has-children > ul.sub-menu' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
				],
				'size_units' => ['px', 'rem']
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'nav_menu_dropdown_divider',
				'selector' => '{{WRAPPER}} nav ul li.menu-item-has-children:not(.m-mega-menu) > ul.sub-menu li',
				'exclude' => ['width'],
			]
		);

		$this->add_responsive_control(
			'nav_menu_dropdown_divider_width',
			[
				'label' => __('Border Width', 'neuron-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} nav ul li.menu-item-has-children:not(.m-mega-menu) > ul.sub-menu li' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} nav ul li.menu-item-has-children:not(.m-mega-menu) > ul.sub-menu li:last-child' => 'border-bottom-width: 0 !important',
				],
				'condition' => [
					'nav_menu_dropdown_divider_border!' => '',
				],
			]
		);

		$this->add_control(
			'nav_menu_carret_heading',
			[
				'label' => __('Carret', 'neuron-core'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'nav_menu_carret_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} nav ul li.menu-item-has-children > ul.sub-menu li.menu-item-has-children::after' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--vertical ul li.menu-item-has-children .menu-item-icon svg' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--mobile ul li.menu-item-has-children .menu-item-icon svg' => 'color: {{VALUE}} !important',
				]
			]
		);

		$this->add_responsive_control(
			'nav_menu_carret_size',
			[
				'label' => __('Size', 'neuron-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} nav ul li.menu-item-has-children > ul.sub-menu li.menu-item-has-children::after' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .m-nav-menu--vertical ul li.menu-item-has-children .menu-item-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .m-nav-menu--mobile ul li.menu-item-has-children .menu-item-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				]
			]
		);
		
		$this->add_control(
			'nav_menu_mega_menu_heading',
			[
				'label' => __('Mega Menu', 'neuron-core'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'nav_menu_layout' => 'horizontal'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'nav_menu_mega_menu_typography',
				'label' => __('Title', 'neuron-core'),
				'exclude' => ['line_height'],
				'selector' => '{{WRAPPER}} nav > ul.m-mega-menu-holder > li.m-mega-menu > .sub-menu > li.menu-item-has-children > a',
				'condition' => [
					'nav_menu_layout' => 'horizontal'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'nav_menu_mega_menu_divider',
				'selector' => '{{WRAPPER}} .m-mega-menu-holder .m-mega-menu > ul.sub-menu > .menu-item',
				'exclude' => ['width'],
				'condition' => [
					'nav_menu_layout' => 'horizontal'
				]
			]
		);

		$this->add_control(
			'nav_menu_mega_menu_divider_width',
			[
				'label' => __('Border Width', 'neuron-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .m-mega-menu-holder .m-mega-menu > ul.sub-menu > .menu-item' => 'border-left-width: {{SIZE}}{{UNIT}} !important',
				],
				'condition' => [
					'nav_menu_mega_menu_divider_border!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'nav_menu_mobile_style',
			[
				'label' => __('Mobile', 'neuron-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'nav_menu_mobile_typography',
				'exclude' => ['line_height'],
				'selector' => '{{WRAPPER}} .m-nav-menu--mobile nav > ul > li > a',
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				]
			]
		);

		$this->add_control(
			'nav_menu_mobile_background_color',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile' => 'background-color: {{VALUE}} !important',
				],
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				]
			]
		);

		$this->add_control(
			'nav_menu_mobile_vertical_padding',
			[
				'label' => __('Vertical Padding', 'neuron-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'rem'],
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile nav > ul > li' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .m-nav-menu--mobile nav > ul > li.menu-item-has-children > .menu-item-icon' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				]
			]
		);

		$this->add_control(
			'nav_menu_mobile_offset',
			[
				'label' => __('Offset', 'neuron-core'),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile' => 'margin-top: {{SIZE}}{{UNIT}} !important;'
				],
				'size_units' => ['px', 'rem'],
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				],
			]
		);

		$this->add_control(
			'nav_menu_mobile_padding',
			[
				'label' => __('Padding', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'rem', 'em'],
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile nav ul.menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->start_controls_tabs('nav_menu_mobile_tabs');

		$this->start_controls_tab(
			'nav_menu_mobile_normal_tab',
			[
				'label' => __('Normal', 'neuron-core'),
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				]
			]
		);

		$this->add_control(
			'nav_menu_mobile_normal_text_color',
			[
				'label' => __('Text Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile nav > ul > li > a' => 'color: {{VALUE}} !important',
				],
				'separator' => 'after',
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_menu_mobile_hover_tab',
			[
				'label' => __('Hover', 'neuron-core'),
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				]
			]
		);

		$this->add_control(
			'nav_menu_mobile_hover_text_color',
			[
				'label' => __('Text Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile nav ul li:hover > a' => 'color: {{VALUE}} !important',
				],
				'separator' => 'after',
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_menu_mobile_active_tab',
			[
				'label' => __('Active', 'neuron-core'),
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				]
			]
		);

		$this->add_control(
			'nav_menu_mobile_active_text_color',
			[
				'label' => __('Text Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile nav ul li.menu-item.current_page_ancestor > a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .m-nav-menu--mobile ul li.menu-item.current_page_item > a' => 'color: {{VALUE}} !important',
				],
				'separator' => 'after',
				'condition' => [
					'nav_menu_mobile_visibility' => 'yes'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'nav_menu_mobile_toggle_heading',
			[
				'label' => __('Toggle Icon', 'neuron-core'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'nav_menu_mobile_toggle_size',
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
					'{{WRAPPER}} .m-nav-menu--mobile-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}} !important',
				]
			]
		);

		$this->add_control(
			'nav_menu_mobile_toggle_padding',
			[
				'label' => __('Padding', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'rem', 'em'],
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('nav_menu_mobile_toggle_normal');

		$this->start_controls_tab(
			'nav_menu_mobile_toggle_normal_tab',
			[
				'label' => __('Normal', 'neuron-core'),
			]
		);

		$this->add_control(
			'nav_menu_mobile_toggle_normal_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile-icon svg line' => 'stroke: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'nav_menu_mobile_toggle_normal_bg_color',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile-icon' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_menu_mobile_toggle_hover_tab',
			[
				'label' => __('Hover', 'neuron-core'),
			]
		);

		$this->add_control(
			'nav_menu_mobile_toggle_hover_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile-icon:hover svg line' => 'stroke: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'nav_menu_mobile_toggle_hover_bg_color',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-nav-menu--mobile-icon:hover' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
		 * Layout
		 */
		$nav_menu_class = ['m-nav-menu--holder'];
		if ($settings['nav_menu_layout'] == 'vertical') {
			$nav_menu_class[] = 'm-nav-menu--vertical';
			add_filter('wp_nav_menu_objects', 'bifrost_remove_mega_menu_class', 10, 3);
		} else {
			$nav_menu_class[] = 'm-nav-menu--horizontal';
		}

		$args = [
			'menu' => $settings['nav_menu'],
			'container' => 'nav',
			'container_class' => implode(' ', $nav_menu_class),
			'container_id' => $this->get_ID(),
			'menu_class' => 'menu'
		];

		$responsive_args = [
			'menu' => $settings['nav_menu'],
			'container' => 'nav',
			'container_class' => 'l-primary-header--responsive__nav'
		];

		if ($settings['nav_menu']) {
			wp_nav_menu($args);
		}
	?>
		<div class="m-nav-menu--mobile-holder" id="<?php echo $this->get_ID() ?>">
			<div class="m-nav-menu--mobile-icon-holder d-flex justify-content-center">
				<a href="#" class="m-nav-menu--mobile-icon d-inline-flex" id="m-nav-menu--mobile-icon">
					<svg style="enable-background:new 0 0 139 139;" width="42px" height="42px" version="1.1" viewBox="0 0 139 139" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><line class="st0" x1="26.5" x2="112.5" y1="46.3" y2="46.3"/><line class="st0" id="XMLID_9_" x1="26.5" x2="112.5" y1="92.7" y2="92.7"/><line class="st0" id="XMLID_8_" x1="26.5" x2="112.5" y1="69.5" y2="69.5"/></svg>
				</a>
			</div>
			<div class="m-nav-menu--mobile">
				<?php
				if ($settings['nav_menu']) {
					wp_nav_menu($responsive_args);
				}
				?>
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
