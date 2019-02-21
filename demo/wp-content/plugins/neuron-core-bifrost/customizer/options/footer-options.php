<?php 
/**
 * Footer Options
 */

// Create Panel and Sections
Kirki::add_panel('footer_options', array(
	'title'       => esc_attr__('Footer', 'neuron-core'),
    'priority'    => 3
));
Kirki::add_section('footer_general_section', array(
    'title'          => esc_attr__('General', 'neuron-core'),
	'priority'       => 1,
	'panel'			=> 'footer_options'
));
Kirki::add_section('footer_copyright_section', array(
    'title'          => esc_attr__('Copyright', 'neuron-core'),
	'priority'       => 2,
	'panel'			=> 'footer_options'
));
Kirki::add_section('footer_widgets_section', array(
    'title'          => esc_attr__('Widgets', 'neuron-core'),
	'priority'       => 3,
	'panel'			=> 'footer_options'
));
Kirki::add_section('footer_social_media_section', array(
    'title'          => esc_attr__('Social Media', 'neuron-core'),
	'priority'       => 4,
	'panel'			=> 'footer_options'
));

// General Settings
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'footer_type',
    'label'       => esc_html__('Type', 'neuron-core'),
    'description' => __('Select the footer type. <br /> <small>Note: Make sure to create templates with Elementor as footer type.</small>', 'neuron-core'),
	'section'     => 'footer_general_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Default', 'neuron-core'),
        '2' => esc_attr__('Template', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'footer_template',
    'label'       => esc_html__('Template', 'neuron-core'),
    'description' => __('Select the footer template.', 'neuron-core'),
	'section'     => 'footer_general_section',
    'choices'     => neuron_get_elementor_templates('footer'),
	'active_callback' => array(
        array(
            'setting'  => 'footer_type',
            'operator' => '==',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'footer_skin',
    'label'       => esc_html__('Skin', 'neuron-core'),
    'description' => __('Select the footer skin, the default is dark.', 'neuron-core'),
	'section'     => 'footer_general_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Dark', 'neuron-core'),
        '2' => esc_attr__('Light', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'footer_type',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'footer_container',
    'label'       => esc_html__('Container', 'neuron-core'),
    'description' => __('Select if you want to use container holder for the footer. <br /> <small>Note: By selecting off, the footer will push into left and right.</small>', 'neuron-core'),
	'section'     => 'footer_general_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('On', 'neuron-core'),
        '2' => esc_attr__('Off', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'footer_type',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));

// Copyright Settings
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'footer_copyright_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Show or hide the copyright, by hiding the copyright the social media will be hidden too.', 'neuron-core'),
	'section'     => 'footer_copyright_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'footer_type',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'textarea',
	'settings'    => 'footer_copyright',
    'label'       => esc_html__('Copyright', 'neuron-core'),
    'description' => __('Enter the text that will appear in footer as copyright. <small>Note: It accepts HTML tags.</small>', 'neuron-core'),
	'section'     => 'footer_copyright_section',
	'active_callback' => array(
        array(
            'setting'  => 'footer_type',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'footer_copyright_automated',
    'label'       => esc_html__('Automated', 'neuron-core'),
    'description' => __('Enable the automated copyright, it will work only if you don\'t add copyright in the field above.', 'neuron-core'),
	'section'     => 'footer_copyright_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('On', 'neuron-core'),
        '2' => esc_attr__('Off', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'footer_type',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'footer_copyright_alignment',
    'label'       => esc_html__('Alignment', 'neuron-core'),
    'description' => __('Select the alignment of copyright, if selected left the social media will be placed on the right and so on.', 'neuron-core'),
	'section'     => 'footer_copyright_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Left', 'neuron-core'),
        '2' => esc_attr__('Right', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'footer_type',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));

// Widgets Settings
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'footer_widgets',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Show or hide the widgets on footer.', 'neuron-core'),
	'section'     => 'footer_widgets_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'footer_type',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'footer_widgets_columns',
    'label'       => esc_html__('Columns', 'neuron-core'),
    'description' => __('Select the columns of widgets, default is 4 columns.', 'neuron-core'),
	'section'     => 'footer_widgets_section',
	'default'     => '4',
    'choices'     => array(
        '1' => __('One Column', 'neuron-core'),
        '2' => __('Two Columns', 'neuron-core'),
        '3' => __('Three Columns', 'neuron-core'),
        '4' => __('Four Columns', 'neuron-core'),
        '5' => __('Five Columns', 'neuron-core'),
        '6' => __('Six Columns', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'footer_type',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'footer_mobile_visibility',
    'label'       => esc_html__('Mobile Visibility', 'neuron-core'),
    'description' => __('Select the visibility of the widgets in mobile layout mode (< 768px).', 'neuron-core'),
	'section'     => 'footer_widgets_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'footer_type',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));

// Social Media Settings
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'footer_social_media_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Show or hide the social media in footer.', 'neuron-core'),
	'section'     => 'footer_social_media_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'footer_type',
            'operator' => '!=',
            'value'    => '2'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'sortable',
    'settings'    => 'footer_social_media_enabled',
    'label'       => esc_html__('Social Media', 'neuron-core'),
	'description' => __('Select which ones you want to display as social media in footer. Click on the eye to make them visible, you can also drag & drop them. <br /><small>Note: Do not forget to add the links at Theme Options > Social Media.</small>', 'neuron-core'),
	'section'     => 'footer_social_media_section',
	'default'     => array(
		'facebook',
		'twitter',
		'dribbble',
		'pinterest',
		'linkedin'
	),
	'choices' => array(
		'facebook' => esc_attr__('Facebook', 'neuron-core'),
		'twitter' => esc_attr__('Twitter', 'neuron-core'),
		'500px' => esc_attr__('500px', 'neuron-core'),
		'google_plus' => esc_attr__('Google Plus', 'neuron-core'),
		'vimeo' => esc_attr__('Vimeo', 'neuron-core'),
		'dribbble' => esc_attr__('Dribbble', 'neuron-core'),
		'pinterest' => esc_attr__('Pinterest', 'neuron-core'),
		'youtube' => esc_attr__('Youtube', 'neuron-core'),
		'tumblr' => esc_attr__('Tumblr', 'neuron-core'),
		'linkedin' => esc_attr__('Linkedin', 'neuron-core'),
		'behance' => esc_attr__('Behance', 'neuron-core'),
		'flickr' => esc_attr__('Flickr', 'neuron-core'),
		'spotify' => esc_attr__('Spotify', 'neuron-core'),
		'instagram' => esc_attr__('Instagram', 'neuron-core'),
		'github' => esc_attr__('GitHub', 'neuron-core'),
		'houzz' => esc_attr__('Houzz', 'neuron-core'),
		'stackexchange' => esc_attr__('StackExchange', 'neuron-core'),
		'soundcloud' => esc_attr__('SoundCloud', 'neuron-core'),
		'vk' => esc_attr__('VK', 'neuron-core')
	),
	'active_callback' => array(
        array(
            'setting'  => 'footer_social_media_visibility',
            'operator' => '==',
            'value'    => '1'
		),
		array(
            'setting'  => 'footer_type',
            'operator' => '!=',
            'value'    => '2'
        ),
	)
));