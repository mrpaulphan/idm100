<?php 
/**
 * Header Options
 */

// Create Panel and Sections
Kirki::add_panel('header_options', array(
	'title'       => esc_attr__('Header', 'neuron-core'),
    'priority'    => 2
));
Kirki::add_section('header_layout_section', array(
    'title'          => esc_attr__('Layout', 'neuron-core'),
	'priority'       => 1,
	'panel'			 => 'header_options'
));
Kirki::add_section('header_logo_section', array(
    'title'          => esc_attr__('Logo', 'neuron-core'),
	'priority'       => 2,
	'panel'			 => 'header_options'
));
Kirki::add_section('header_search_section', array(
    'title'          => esc_attr__('Search', 'neuron-core'),
	'priority'       => 3,
	'panel'			 => 'header_options'
));
Kirki::add_section('top_header_section', array(
    'title'          => esc_attr__('Top Header', 'neuron-core'),
	'priority'       => 4,
	'panel'			 => 'header_options'
));
Kirki::add_section('sliding_bar_section', array(
    'title'          => esc_attr__('Sliding Bar', 'neuron-core'),
	'priority'       => 5,
	'panel'			 => 'header_options'
));
if (class_exists('WooCommerce')) {
	Kirki::add_section('shopping_cart_section', array(
		'title'          => esc_attr__('Shopping Cart', 'neuron-core'),
		'priority'       => 6,
		'panel'			 => 'header_options'
	));
}

// Layout Settings
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'header_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Show or hide the classic header in your website, default is show. <br /><small>Note: You\'ll still be able to place header templates.</small>', 'neuron-core'),
	'section'     => 'header_layout_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'header_type',
    'label'       => esc_html__('Type', 'neuron-core'),
    'description' => __('Select the header type. <br /> <small>Note: Make sure to create templates with Elementor as header type.</small>', 'neuron-core'),
	'section'     => 'header_layout_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Default', 'neuron-core'),
        '2' => esc_attr__('Template', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'header_template',
    'label'       => esc_html__('Template', 'neuron-core'),
    'description' => __('Select the header template.', 'neuron-core'),
	'section'     => 'header_layout_section',
    'choices'     => neuron_get_elementor_templates('header'),
    'default' => '',
	'active_callback' => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'header_skin',
    'label'       => esc_html__('Skin', 'neuron-core'),
    'description' => __('Select the header skin, the default is dark. <br /> <small>Note: Light skin means white logo text and white menu.</small>', 'neuron-core'),
	'section'     => 'header_layout_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Dark', 'neuron-core'),
        '2' => esc_attr__('Light', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => '2'
        ),
        array(
            'setting'  => 'header_visibility',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'header_position',
    'label'       => esc_html__('Position', 'neuron-core'),
    'description' => __('Select the header position, the default is static. <br /> <small>Note: Absolute header will push the content to the top of page.</small>', 'neuron-core'),
	'section'     => 'header_layout_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Static', 'neuron-core'),
        '2' => esc_attr__('Absolute', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'header_transparency',
    'label'       => esc_html__('Transparency', 'neuron-core'),
    'description' => __('Select the header transparency. <br /> <small>Note: Sticky will stay fixed in scroll.</small>', 'neuron-core'),
	'section'     => 'header_layout_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Normal', 'neuron-core'),
        '2' => esc_attr__('Sticky', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'header_sticky_template',
    'label'       => esc_html__('Sticky Template', 'neuron-core'),
    'description' => __('Select the header template that will be used as sticky.', 'neuron-core'),
	'section'     => 'header_layout_section',
    'choices'     => neuron_get_elementor_templates('header'),
	'active_callback' => array(
        array(
            'setting'  => 'header_transparency',
            'operator' => '==',
            'value'    => '2'
		),
		array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'header_autohide',
    'label'       => esc_html__('Autohide', 'neuron-core'),
    'description' => __('Switch on if you want to activate the autohide header. The header will be hidden when scrolling down, it will appear only when user scrolls up. <br /> <small>Note: This option is valid only when Sticky is selected as transparency.</small>', 'neuron-core'),
	'section'     => 'header_layout_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('On', 'neuron-core'),
        '2' => esc_attr__('Off', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'header_transparency',
            'operator' => '==',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'header_container',
    'label'       => esc_html__('Container', 'neuron-core'),
    'description' => __('Select if you want to use container holder for the header. <br /> <small>Note: By selecting off, the header will push into left and right.</small>', 'neuron-core'),
	'section'     => 'header_layout_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('On', 'neuron-core'),
        '2' => esc_attr__('Off', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => '2'
        ),
        array(
            'setting'  => 'header_visibility',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));

// Logo Settings
Kirki::add_field('neuron_kirki', array(
	'type'        => 'image',
	'settings'    => 'header_dark_logo',
	'label'       => esc_attr__('Dark', 'neuron-core'),
	'description' => esc_attr__('Upload your dark logo, will be used as dark logo in dark skin.', 'neuron-core'),
	'section'     => 'header_logo_section',
    'choices'     => array(
		'save_as' => 'id',
	),
	'active_callback' => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => '2'
        ),
        array(
            'setting'  => 'header_visibility',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'image',
	'settings'    => 'header_light_logo',
	'label'       => esc_attr__('Light', 'neuron-core'),
	'description' => esc_attr__('Upload your light logo, will be used as white logo in light skin.', 'neuron-core'),
	'section'     => 'header_logo_section',
    'choices'     => array(
		'save_as' => 'id',
	),
	'active_callback' => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => '2'
        ),
        array(
            'setting'  => 'header_visibility',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'text',
	'settings'    => 'header_logo_width',
    'label'       => esc_attr__('Width', 'neuron-core'),
    'description' => __('Enter the number that will change the logo image width. <br /><small>Note: Enter only the number without {px}.</small>', 'neuron-core'),
	'section'     => 'header_logo_section',
	'active_callback' => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => '2'
        ),
        array(
            'setting'  => 'header_visibility',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'text',
	'settings'    => 'header_logo_height',
    'label'       => esc_attr__('Height', 'neuron-core'),
    'description' => __('Enter the number that will change the logo image height. <br /><small>Note: Enter only the number without {px}.', 'neuron-core'),
	'section'     => 'header_logo_section',
	'active_callback' => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => '2'
        ),
        array(
            'setting'  => 'header_visibility',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'header_logo_text',
	'label'    => __('Text', 'neuron-core'),
	'description'  => esc_attr__('Enter the text that will appear as logo, incase you don\'t upload any image as logo.', 'neuron-core'),
	'section'  => 'header_logo_section',
	'active_callback' => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => '2'
        ),
        array(
            'setting'  => 'header_visibility',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'text',
	'settings'    => 'header_logo_text_size',
    'label'       => esc_attr__('Text Size', 'neuron-core'),
    'description' => __('Enter the number to change the logo text font size. <br /><small>Note: Enter only the number without {px}.</small.', 'neuron-core'),
	'section'     => 'header_logo_section',
	'active_callback' => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => '2'
        ),
        array(
            'setting'  => 'header_visibility',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));

// Search
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'header_search_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Select the visibility of the search.', 'neuron-core'),
	'section'     => 'header_search_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => '2'
        ),
        array(
            'setting'  => 'header_visibility',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'header_search_mobile',
    'label'       => esc_html__('Mobile', 'neuron-core'),
    'description' => __('Select the visibility of the search in mobile screens(991px and smaller).', 'neuron-core'),
	'section'     => 'header_search_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'header_search_visibility',
            'operator' => '==',
            'value'    => '1'
		),
		array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => '2'
        ),
        array(
            'setting'  => 'header_visibility',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));

// Top Header Settings
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'top_header_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Select the visibility of the top header.', 'neuron-core'),
	'section'     => 'top_header_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
	),
	'active_callback' => array(
		array(
			'setting'  => 'header_type',
			'operator' => '!=',
			'value'    => '2'
		),
	)
));
$nav_menus = wp_get_nav_menus();
$nav_menus_holder = [];

if ($nav_menus) {
	foreach ($nav_menus as $nav) {
		$nav_menus_holder[$nav->slug] = $nav->name;
	}
}

Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'top_header_menu',
    'label'       => esc_html__('Menu', 'neuron-core'),
	'description' => __('Select the menu of the top header.', 'neuron-core'),
	'section'     => 'top_header_section',
	'default'     => '',
	'choices'     => $nav_menus_holder,
	'active_callback' => array(
        array(
            'setting'  => 'top_header_visibility',
            'operator' => '==',
            'value'    => '1'
		),
		array(
			'setting'  => 'header_type',
			'operator' => '!=',
			'value'    => '2'
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'textarea',
	'settings'    => 'top_header_textarea',
    'label'       => esc_html__('Content', 'neuron-core'),
    'description' => __('Enter the content in the top header, it accepts html tags too.', 'neuron-core'),
	'section'     => 'top_header_section',
	'active_callback' => array(
        array(
            'setting'  => 'top_header_visibility',
            'operator' => '==',
            'value'    => '1'
		),
		array(
			'setting'  => 'header_type',
			'operator' => '!=',
			'value'    => '2'
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'top_header_content_alignment',
    'label'       => esc_html__('Alignment', 'neuron-core'),
    'description' => __('Select the alignment of content in the top header, if left is selected the menu will move on the right and vice versa.', 'neuron-core'),
	'section'     => 'top_header_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Left', 'neuron-core'),
        '2' => esc_attr__('Right', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'top_header_visibility',
            'operator' => '==',
            'value'    => '1'
		),
		array(
			'setting'  => 'header_type',
			'operator' => '!=',
			'value'    => '2'
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'top_header_skin',
    'label'       => esc_html__('Skin', 'neuron-core'),
    'description' => __('Select the skin of the top header.', 'neuron-core'),
	'section'     => 'top_header_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Light', 'neuron-core'),
        '2' => esc_attr__('Dark', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'top_header_visibility',
            'operator' => '==',
            'value'    => '1'
		),
		array(
			'setting'  => 'header_type',
			'operator' => '!=',
			'value'    => '2'
		),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'top_header_container',
    'label'       => esc_html__('Container', 'neuron-core'),
    'description' => __('Select if you want to use container holder for the header. <br /> <small>Note: By selecting off, the header will push into left and right.</small>', 'neuron-core'),
	'section'     => 'top_header_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('On', 'neuron-core'),
        '2' => esc_attr__('Off', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'top_header_visibility',
            'operator' => '==',
            'value'    => '1'
		),
		array(
			'setting'  => 'header_type',
			'operator' => '!=',
			'value'    => '2'
		),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'top_header_mobile',
    'label'       => esc_html__('Mobile', 'neuron-core'),
    'description' => __('Select the visibility of the top header in mobile devices(991px and smaller).', 'neuron-core'),
	'section'     => 'top_header_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'top_header_visibility',
            'operator' => '==',
            'value'    => '1'
		),
		array(
			'setting'  => 'header_type',
			'operator' => '!=',
			'value'    => '2'
		),
    )
));

// Sliding Bar Settings
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'sliding_bar_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Select the visibility of the sliding bar.', 'neuron-core'),
	'section'     => 'sliding_bar_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
	),
	'active_callback' => array(
		array(
			'setting'  => 'header_type',
			'operator' => '!=',
			'value'    => '2'
		),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'sliding_bar_mobile',
    'label'       => esc_html__('Mobile', 'neuron-core'),
    'description' => __('Select the visibility of the sliding bar in mobile devices(991px and smaller).', 'neuron-core'),
	'section'     => 'sliding_bar_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
	),
	'active_callback' => array(
		array(
			'setting'  => 'sliding_bar_visibility',
			'operator' => '==',
			'value'    => '1'
		),
		array(
			'setting'  => 'header_type',
			'operator' => '!=',
			'value'    => '2'
		),
	)
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'sliding_bar_skin',
    'label'       => esc_html__('Skin', 'neuron-core'),
    'description' => __('Select the skin of the sliding bar.', 'neuron-core'),
	'section'     => 'sliding_bar_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Light', 'neuron-core'),
        '2' => esc_attr__('Dark', 'neuron-core')
	),
	'active_callback' => array(
		array(
			'setting'  => 'sliding_bar_visibility',
			'operator' => '==',
			'value'    => '1'
		),
		array(
			'setting'  => 'header_type',
			'operator' => '!=',
			'value'    => '2'
		),
	)
));

function neuron_sliding_bar_sidebar() { 
 	$sidebars = $sidebars_choices = []; 
 	if (isset($GLOBALS['wp_registered_sidebars'])) { 
 		$sidebars = $GLOBALS['wp_registered_sidebars']; 
 	} 
 	foreach ($sidebars as $sidebar) { 
 		$sidebars_choices[$sidebar['id']] = $sidebar['name']; 
 	} 
 	Kirki::add_field('neuron_kirki', array( 
 		'type'        => 'select', 
 		'settings'    => 'sliding_bar_sidebar', 
 		'label'       => esc_attr__('Sidebar', 'neuron-core'), 
 		'description' => esc_attr__('Select which sidebar you want to display on the sliding bar section, the default is sliding bar sidebar.', 'neuron-core'), 
 		'section'     => 'sliding_bar_section', 
 		'default'     => 'sliding-bar', 
		'choices'     => $sidebars_choices,
		'active_callback' => array(
			array(
				'setting'  => 'sliding_bar_visibility',
				'operator' => '==',
				'value'    => '1'
			),
			array(
				'setting'  => 'header_type',
				'operator' => '!=',
				'value'    => '2'
			),
		)
	)); 
} 
add_action('init', 'neuron_sliding_bar_sidebar', 999); 

// Shopping Cart
if (class_exists('WooCommerce')) {
	Kirki::add_field('neuron_kirki', array(
		'type'        => 'select',
		'settings'    => 'shopping_cart_visibility',
		'label'       => esc_html__('Visibility', 'neuron-core'),
		'description' => __('Select the visibility of the shopping cart.', 'neuron-core'),
		'section'     => 'shopping_cart_section',
		'default'     => '2',
		'choices'     => array(
			'1' => esc_attr__('Show', 'neuron-core'),
			'2' => esc_attr__('Hide', 'neuron-core')
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_type',
				'operator' => '!=',
				'value'    => '2'
			),
		)
	));
	Kirki::add_field('neuron_kirki', array(
		'type'        => 'select',
		'settings'    => 'shopping_cart_mobile',
		'label'       => esc_html__('Mobile', 'neuron-core'),
		'description' => __('Select the visibility of the shopping cart in mobile screens(991px and smaller).', 'neuron-core'),
		'section'     => 'shopping_cart_section',
		'default'     => '2',
		'choices'     => array(
			'1' => esc_attr__('Show', 'neuron-core'),
			'2' => esc_attr__('Hide', 'neuron-core')
		),
		'active_callback' => array(
			array(
				'setting'  => 'shopping_cart_visibility',
				'operator' => '==',
				'value'    => '1'
			),
			array(
				'setting'  => 'header_type',
				'operator' => '!=',
				'value'    => '2'
			),
		)
	));
}