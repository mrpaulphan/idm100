<?php 
/**
 * General Options
 */

// Create Section for General Options
Kirki::add_section( 'general_section', array(
    'title'          => esc_attr__('General', 'neuron-core'),
    'priority'       => 1
));

// General Settings
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'custom_fields_panel',
    'label'       => esc_html__('Custom Fields Panel', 'neuron-core'),
    'description' => esc_html__('Enable or disable the custom fields panel(ACF Panel), default is disabled.', 'neuron-core'),
	'section'     => 'general_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Enable', 'neuron-core'),
        '2' => esc_attr__('Disable', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'comments_closed',
    'label'       => esc_html__('Comments Notice', 'neuron-core'),
    'description' => esc_html__('Show or hide the notice \'Comments are Closed!\'.', 'neuron-core'),
	'section'     => 'general_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'body_offset',
    'label'       => esc_html__('Body Offset', 'neuron-core'),
    'description' => __('Create a left or right spacing to the content, best use case when creating a lateral header to eleminate the FOUC effect.', 'neuron-core'),
	'section'     => 'general_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('On', 'neuron-core'),
        '2' => esc_attr__('Off', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', [
	'type'        => 'dimensions',
	'settings'    => 'body_offset_padding',
	'label'       => esc_html__('Offset Values', 'neuron-core'),
	'description' => __('Enter the values of the offset, if you\'re using the menu on the left, add padding on the left side and so on. <br /><small>Note: Do not forget to enter the unit too.</small>', 'neuron-core'),
	'section'     => 'general_section',
	'default'     => [
		'padding-left'  => '',
		'padding-right' => '',
	],
	'choices'     => [
		'labels' => [
			'padding-left'  => esc_html__('Left', 'neuron-core'),
			'padding-right'  => esc_html__('Right', 'neuron-core'),
		],
	],
	'active_callback' => array(
		array(
			'setting'  => 'body_offset',
			'operator' => '==',
			'value'    => '1'
		),
	)
]);
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'body_offset_breakpoint',
    'label'       => esc_html__('Offset Breakpoint', 'neuron-core'),
    'description' => __('Select from which device you want to remove the offset.', 'neuron-core'),
	'section'     => 'general_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Tablet', 'neuron-core'),
        '2' => esc_attr__('Mobile', 'neuron-core')
	),
	'active_callback' => array(
		array(
			'setting'  => 'body_offset',
			'operator' => '==',
			'value'    => '1'
		),
	)
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'repeater',
    'settings'    => 'general_sidebars',
    'label'       => esc_attr__('Custom Sidebar', 'neuron-core'),
    'description' => esc_html__('Create new sidebars and use them later via the page builder for different areas.', 'neuron-core'),
    'section'     => 'general_section',
	'row_label' => array(
		'type' => 'text',
		'value' => esc_attr__('Custom Sidebar', 'neuron-core'),
	),
	'button_label' => esc_attr__('Add new sidebar area', 'neuron-core'),
	'default'      => '',
	'fields' => array(
		'sidebar_title' => array(
			'type'        => 'text',
			'label'       => esc_attr__('Sidebar Title', 'neuron-core'),
			'default'     => '',
		),
		'sidebar_description' => array(
			'type'        => 'text',
			'label'       => esc_attr__('Sidebar Description', 'neuron-core'),
			'default'     => '',
		),
	)
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'repeater',
    'settings'    => 'general_image_sizes',
    'label'       => esc_attr__('Image Size', 'neuron-core'),
    'description' => __('Create new image sizes, if you leave height blank it will be set to auto. <br /> <small>Note: Enter only the number without unit, it\'s represented in pixels.</small>', 'neuron-core'),
    'section'     => 'general_section',
	'row_label' => array(
		'type' => 'text',
		'value' => esc_attr__('Image Size', 'neuron-core'),
	),
	'button_label' => esc_attr__('Add new image size', 'neuron-core'),
	'default'      => array(
		array(
			'image_size_width' => '560',
			'image_size_height' => '400'
		)
	),
	'fields' => array(
		'image_size_width' => array(
			'type'        => 'text',
			'label'       => esc_attr__('Width', 'neuron-core'),
		),
		'image_size_height' => array(
			'type'        => 'text',
			'label'       => esc_attr__('Height', 'neuron-core'),
		),
	)
));
