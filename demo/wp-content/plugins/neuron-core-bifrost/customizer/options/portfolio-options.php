<?php 
/**
 * Portfolio Options
 */

// Create Panel and Sections
Kirki::add_panel('portfolio_options', array(
    'title'       => esc_attr__('Portfolio', 'neuron-core'),
    'priority'    => 4
));
Kirki::add_section('portfolio_functionality_options', array(
    'title'       => esc_attr__('Functionality', 'neuron-core'),
    'panel'		  => 'portfolio_options',
    'priority'    => 1
));
// Kirki::add_section('portfolio_style_options', array(
//     'title'       => esc_attr__('Style', 'neuron-core'),
//     'panel'		  => 'portfolio_options',
//     'priority'    => 2
// ));
// Kirki::add_section('portfolio_thumbnail_options', array(
//     'title'       => esc_attr__('Thumbnail', 'neuron-core'),
//     'panel'		  => 'portfolio_options',
//     'priority'    => 3
// ));
Kirki::add_section('portfolio_item_options', array(
    'title'       => esc_attr__('Portfolio Item', 'neuron-core'),
    'panel'		  => 'portfolio_options',
    'priority'    => 4
));

/**
 * Functionality
 */
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_type',
//     'label'       => esc_html__('Type', 'neuron-core'),
//     'description' => __('Select the type of portfolio.', 'neuron-core'),
// 	'section'     => 'portfolio_functionality_options',
// 	'default'     => '1',
//     'choices'     => array(
//         '1' => esc_attr__('Meta Inside', 'neuron-core'),
//         '2' => esc_attr__('Meta Outside', 'neuron-core')
//     )
// ));
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_sortable',
//     'label'       => esc_html__('Sortable Visibility', 'neuron-core'),
//     'description' => __('Show the portfolio categories as filters.', 'neuron-core'),
// 	'section'     => 'portfolio_functionality_options',
// 	'default'     => '1',
//     'choices'     => array(
//         '1' => esc_attr__('Show', 'neuron-core'),
//         '2' => esc_attr__('Hide', 'neuron-core')
//     ),
// ));
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_sortable_alignment',
//     'label'       => esc_html__('Sortable Alignment', 'neuron-core'),
//     'description' => __('Select the alignment of filters.', 'neuron-core'),
// 	'section'     => 'portfolio_functionality_options',
// 	'default'     => '1',
//     'choices'     => array(
//         '1' => esc_attr__('Left', 'neuron-core'),
//         '2' => esc_attr__('Center', 'neuron-core'),
//         '3' => esc_attr__('Right', 'neuron-core')
//     ),
//     'active_callback' => array(
//         array(
//             'setting'  => 'portfolio_sortable',
//             'operator' => '==',
//             'value'    => '1'
//         ),
//     )
// ));
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_pagination_visibility',
//     'label'       => esc_html__('Pagination Visibility', 'neuron-core'),
//     'description' => __('Select the pagination visibility. <br /><small>The pagination will not be displayed if there are less posts than posts per page number, even if the option is show.</small>', 'neuron-core'),
// 	'section'     => 'portfolio_functionality_options',
// 	'default'     => '1',
//     'choices'     => array(
//         '1' => esc_attr__('Show', 'neuron-core'),
//         '2' => esc_attr__('Hide', 'neuron-core')
//     ),
// ));
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_pagination_style',
//     'label'       => esc_html__('Pagination Style', 'neuron-core'),
//     'description' => __('Select the pagination style, normal is with numbers and arrows and Show More is with button.', 'neuron-core'),
// 	'section'     => 'portfolio_functionality_options',
// 	'default'     => '1',
//     'choices'     => array(
//         '1' => esc_attr__('Normal', 'neuron-core'),
//         '2' => esc_attr__('Show More', 'neuron-core')
//     ),
// ));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'text',
	'settings'    => 'portfolio_prefix',
    'label'       => esc_html__('Prefix', 'neuron-core'),
    'description' => __('Change the portfolio prefix before the post, e.g. <br /> https://neuronthemes.com/<b>portfolio</b>/portfolio-1#.<br /> <small>Note: The default prefix is portfolio. Do not forget to click save changes on the the permalinks after.</small>', 'neuron-core'),
	'section'     => 'portfolio_functionality_options'
));

/**
 * Style
 */
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_columns',
//     'label'       => esc_html__('Columns', 'neuron-core'),
//     'description' => __('Select the columns of portfolio, default is 3 columns.', 'neuron-core'),
// 	'section'     => 'portfolio_style_options',
// 	'default'     => '3',
//     'choices'     => array(
//         '1' => esc_attr__('1 Column', 'neuron-core'),
//         '2' => esc_attr__('2 Columns', 'neuron-core'),
//         '3' => esc_attr__('3 Columns', 'neuron-core'),
//         '4' => esc_attr__('4 Columns', 'neuron-core'),
//         '5' => esc_attr__('5 Columns', 'neuron-core'),
//         '6' => esc_attr__('6 Columns', 'neuron-core')
//     ),
// ));
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_animation',
//     'label'       => esc_html__('Animation', 'neuron-core'),
//     'description' => __('Select initial loading animation for portfolio items.', 'neuron-core'),
// 	'section'     => 'portfolio_style_options',
// 	'default'     => '2',
//     'choices'     => array(
//         '1' => esc_attr__('None', 'neuron-core'),
//         '2' => esc_attr__('Fade In', 'neuron-core'),
//         '3' => esc_attr__('Fade In Up', 'neuron-core'),
//         '4' => esc_attr__('Fade In (with delay)', 'neuron-core'),
//         '5' => esc_attr__('Fade In Up (with delay)', 'neuron-core')
//     ),
// ));
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_spacing',
//     'label'       => esc_html__('Spacing', 'neuron-core'),
//     'description' => __('Add custom spacing between portfolio items.', 'neuron-core'),
// 	'section'     => 'portfolio_style_options',
// 	'default'     => '2',
//     'choices'     => array(
//         '1' => esc_attr__('On', 'neuron-core'),
//         '2' => esc_attr__('Off', 'neuron-core')
//     )
// ));
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'slider',
// 	'settings'    => 'portfolio_spacing_value',
// 	'label'       => __('Spacing Value', 'neuron-core'),
// 	'description' => __('Move the slider to set the value of spacing. <br /> <small>Note: The value is represented in pixels.</small>', 'neuron-core'),
//     'section'     => 'portfolio_style_options',
//     'default'     => 30,
// 	'choices'     => array(
// 		'min'  => '0',
// 		'max'  => '100',
// 		'step' => '1',
//     ),
//     'active_callback' => array(
//         array(
//             'setting'  => 'portfolio_spacing',
//             'operator' => '==',
//             'value'    => '1'
//         ),
//     )
// ));

// Hover
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'custom',
// 	'settings'    => 'portfolio_hover_title',
// 	'section'     => 'portfolio_style_options',
// 	'default'     => '<h1>' . esc_html__('Hover', 'neuron-core') . '</h1><hr>'
// ));
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_hover_visibility',
//     'label'       => esc_html__('Visibility', 'neuron-core'),
//     'description' => __('Select the visibility of the hover.', 'neuron-core'),
// 	'section'     => 'portfolio_style_options',
// 	'default'     => '1',
//     'choices'     => array(
//         'show' => esc_attr__('Show', 'neuron-core'),
//         'hide' => esc_attr__('Hide', 'neuron-core')
//     )
// ));
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_hover_animation',
//     'label'       => esc_html__('Animation', 'neuron-core'),
//     'description' => __('Select the animation of the hover.', 'neuron-core'),
// 	'section'     => 'portfolio_style_options',
// 	'default'     => '1',
//     'choices'     => array(
//         'translate' => esc_attr__('Translate', 'neuron-core'),
//         'scale' => esc_attr__('Scale', 'neuron-core')
//     )
// ));

/**
 * Thumbnail Resizer
 */
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_thumbnail_resizer',
//     'label'       => esc_html__('Thumbnail', 'neuron-core'),
//     'description' => __('Activate a thumbnail resizer, it will crop all the images to a given width & height. <br /><small>Note: Do not forget to regenerate thumbnails.</small>', 'neuron-core'),
// 	'section'     => 'portfolio_thumbnail_options',
// 	'default'     => '2',
//     'choices'     => array(
//         '1' => esc_attr__('On', 'neuron-core'),
//         '2' => esc_attr__('Off', 'neuron-core')
//     ),
// ));

// $thumbnail_sizes = [];
// $index = 1;
// foreach (get_intermediate_image_sizes() as $image_size) {
//     $thumbnail_sizes[$index++] = $image_size;
// }
// Kirki::add_field('neuron_kirki', array(
// 	'type'        => 'select',
// 	'settings'    => 'portfolio_thumbnail_sizes',
//     'label'       => esc_html__('Thumbnail Size', 'neuron-core'),
//     'description' => __('Select the image size, you can add new thumbnail sizes in the general options.', 'neuron-core'),
// 	'section'     => 'portfolio_thumbnail_options',
// 	'default'     => 1,
//     'choices'     => $thumbnail_sizes,
//     'active_callback' => array(
//         array(
//             'setting'  => 'portfolio_thumbnail_resizer',
//             'operator' => '==',
//             'value'    => '1'
//         ),
//     )
// ));

/**
 * Portfolio Item Settings
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'portfolio_item_share',
    'label'       => esc_html__('Share', 'neuron-core'),
    'description' => __('Select the visibility of share icons. <br /><small>Note: Make sure to install and activate the NeuronThemes Share plugin.</small>', 'neuron-core'),
	'section'     => 'portfolio_item_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'portfolio_item_navigation_message',
	'section'     => 'portfolio_item_options',
	'default'     => '<h1>' . esc_html__('Navigation', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'portfolio_item_navigation_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Show or hide the navigation on portfolio item.', 'neuron-core'),
	'section'     => 'portfolio_item_options',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'portfolio_item_navigation_category',
    'label'       => esc_html__('Category', 'neuron-core'),
    'description' => __('Enable if you want the posts to be navigated only in the same category.', 'neuron-core'),
	'section'     => 'portfolio_item_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Enable', 'neuron-core'),
        '2' => esc_attr__('Disable', 'neuron-core')
    ),
));

// Gallery
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'portfolio_item_gallery_message',
	'section'     => 'portfolio_item_options',
	'default'     => '<h1>' . esc_html__('Gallery', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'portfolio_item_gallery_columns',
    'label'       => esc_html__('Columns', 'neuron-core'),
    'description' => __('Select the columns of gallery.', 'neuron-core'),
	'section'     => 'portfolio_item_options',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('1 Column', 'neuron-core'),
        '2' => esc_attr__('2 Columns', 'neuron-core'),
        '3' => esc_attr__('3 Columns', 'neuron-core'),
        '4' => esc_attr__('4 Columns', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'portfolio_item_gallery_animation',
    'label'       => esc_html__('Animation', 'neuron-core'),
    'description' => __('Select initial loading animation for gallery.', 'neuron-core'),
	'section'     => 'portfolio_item_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('None', 'neuron-core'),
        '2' => esc_attr__('Fade In', 'neuron-core'),
        '3' => esc_attr__('Fade In Up', 'neuron-core'),
        '4' => esc_attr__('Fade In (with delay)', 'neuron-core'),
        '5' => esc_attr__('Fade In Up (with delay)', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'portfolio_item_thumbnail_resizer',
    'label'       => esc_html__('Resizer', 'neuron-core'),
    'description' => __('Activate a thumbnail resizer, it will crop all the images to a given width & height. <br /><small>Note: Do not forget to regenerate thumbnails.</small>', 'neuron-core'),
	'section'     => 'portfolio_item_options',
	'default'     => 'no',
    'choices'     => array(
        'yes' => esc_attr__('On', 'neuron-core'),
        'no' => esc_attr__('Off', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'portfolio_item_thumbnail_sizes',
    'label'       => esc_html__('Image Sizes', 'neuron-core'),
    'description' => __('Select the image size, you can add new thumbnail sizes in the general options.', 'neuron-core'),
	'section'     => 'portfolio_item_options',
	'default'     => 'medium',
    'choices'     => neuron_image_sizes(),
    'active_callback' => array(
        array(
            'setting'  => 'portfolio_item_thumbnail_resizer',
            'operator' => '==',
            'value'    => 'yes'
        ),
    )
));