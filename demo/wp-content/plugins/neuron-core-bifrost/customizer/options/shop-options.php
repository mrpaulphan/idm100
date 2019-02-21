<?php 
/**
 * Shop Options
 */
// Create Panel and Sections
Kirki::add_panel('shop_options', array(
    'title'       => esc_attr__('Shop', 'neuron-core'),
    'priority'    => 6
));
Kirki::add_section('shop_functionality_section', array(
    'title'          => esc_attr__('Functionality', 'neuron-core'),
	'priority'       => 1,
	'panel'			=> 'shop_options'
));
Kirki::add_section('shop_style_section', array(
    'title'          => esc_attr__('Style', 'neuron-core'),
	'priority'       => 2,
	'panel'			=> 'shop_options'
));
Kirki::add_section('shop_thumbnail_section', array(
    'title'          => esc_attr__('Thumbnail', 'neuron-core'),
	'priority'       => 3,
	'panel'			=> 'shop_options'
));
Kirki::add_section('shop_product_section', array(
    'title'          => esc_attr__('Product', 'neuron-core'),
	'priority'       => 4,
	'panel'			=> 'shop_options'
));

/**
 * Functionality
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_type',
    'label'       => esc_html__('Type', 'neuron-core'),
    'description' => __('Select the type of shop.', 'neuron-core'),
	'section'     => 'shop_functionality_section',
	'default'     => 'meta-inside',
    'choices'     => array(
        'meta-inside' => esc_attr__('Meta Inside', 'neuron-core'),
        'meta-outside' => esc_attr__('Meta Outside', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_sidebar',
    'label'       => esc_html__('Sidebar', 'neuron-core'),
    'description' => __('Select the placement of sidebar or hide it, default is right.', 'neuron-core'),
	'section'     => 'shop_functionality_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Left', 'neuron-core'),
        '2' => esc_attr__('Right', 'neuron-core'),
        '3' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_result_count',
    'label'       => esc_html__('Result Count', 'neuron-core'),
    'description' => __('Show or hide the result count.', 'neuron-core'),
	'section'     => 'shop_functionality_section',
	'default'     => 'show',
    'choices'     => array(
        'show' => esc_attr__('Show', 'neuron-core'),
        'hide' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_catalog_ordering',
    'label'       => esc_html__('Catalog Ordering', 'neuron-core'),
    'description' => __('Show or hide the catalog ordering.', 'neuron-core'),
	'section'     => 'shop_functionality_section',
	'default'     => 'show',
    'choices'     => array(
        'show' => esc_attr__('Show', 'neuron-core'),
        'hide' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_catalog_ordering_default',
    'label'       => esc_html__('Default Order', 'neuron-core'),
    'description' => __('Select which order you want to set default.', 'neuron-core'),
	'section'     => 'shop_functionality_section',
	'default'     => 'menu_order',
    'choices'     => array(
        'menu_order' => esc_attr__('Default sorting', 'neuron-core'),
        'popularity' => esc_attr__('Sort by popularity', 'neuron-core'),
        'rating' => esc_attr__('Sort by average rating', 'neuron-core'),
        'date' => esc_attr__('Sort by newness', 'neuron-core'),
        'price' => esc_attr__('Sort by price: low to high', 'neuron-core'),
        'price-desc' => esc_attr__('Sort by price: high to low', 'neuron-core')
    ),
    'active_callback' => array(
        array(
            'setting'  => 'shop_catalog_ordering',
            'operator' => '==',
            'value'    => 'show'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'text',
	'settings'    => 'shop_ppp',
    'label'       => esc_attr__('Posts Per Page', 'neuron-core'),
    'description' => __('Enter the number of products you want to display on the first page, a pagination will be created if there are more products than this number.', 'neuron-core'),
    'section'     => 'shop_functionality_section'
));

/**
 * Style
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_columns',
    'label'       => esc_html__('Columns', 'neuron-core'),
    'description' => __('Select the columns of Shop, default is two columns.', 'neuron-core'),
	'section'     => 'shop_style_section',
	'default'     => '2-columns',
    'choices'     => array(
        '1-column' => esc_attr__('1 Column', 'neuron-core'),
        '2-columns' => esc_attr__('2 Columns', 'neuron-core'),
        '3-columns' => esc_attr__('3 Columns', 'neuron-core'),
        '4-columns' => esc_attr__('4 Columns', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_animation',
    'label'       => esc_html__('Animation', 'neuron-core'),
    'description' => __('Select initial loading animation for products.', 'neuron-core'),
	'section'     => 'shop_style_section',
	'default'     => 'fade-in',
    'choices'     => array(
        'none' => esc_attr__('None', 'neuron-core'),
        'fade-in' => esc_attr__('Fade In', 'neuron-core'),
        'fade-in-up' => esc_attr__('Fade In Up', 'neuron-core'),
        'fade-in-delay' => esc_attr__('Fade In (with delay)', 'neuron-core'),
        'fade-in-up-delay' => esc_attr__('Fade In Up (with delay)', 'neuron-core'),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_spacing',
    'label'       => esc_html__('Spacing', 'neuron-core'),
    'description' => __('Add custom spacing between products.', 'neuron-core'),
	'section'     => 'shop_style_section',
	'default'     => 'no',
    'choices'     => array(
        'yes' => esc_attr__('On', 'neuron-core'),
        'no' => esc_attr__('Off', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'slider',
	'settings'    => 'shop_spacing_value',
	'label'       => __('Spacing Value', 'neuron-core'),
	'description' => __('Move the slider to set the value of spacing. <br /> <small>Note: The value is represented in pixels.</small>', 'neuron-core'),
    'section'     => 'shop_style_section',
    'default'     => 30,
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
    ),
    'active_callback' => array(
        array(
            'setting'  => 'shop_spacing',
            'operator' => '==',
            'value'    => 'yes'
        ),
    )
));

// Hover
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'shop_hover_title',
	'section'     => 'shop_style_section',
	'default'     => '<h1>' . esc_html__('Hover', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_hover_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Select the visibility of the hover.', 'neuron-core'),
	'section'     => 'shop_style_section',
	'default'     => 'show',
    'choices'     => array(
        'show' => esc_attr__('Show', 'neuron-core'),
        'hide' => esc_attr__('Hide', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_hover_animation',
    'label'       => esc_html__('Animation', 'neuron-core'),
    'description' => __('Select the animation of the hover.', 'neuron-core'),
	'section'     => 'shop_style_section',
	'default'     => 'translate',
    'choices'     => array(
        'translate' => esc_attr__('Translate', 'neuron-core'),
        'scale' => esc_attr__('Scale', 'neuron-core')
    )
));

/**
 * Thumbnail Resizer
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_thumbnail_resizer',
    'label'       => esc_html__('Thumbnail', 'neuron-core'),
    'description' => __('Activate a thumbnail resizer, it will crop all the images to a given width & height. <br /><small>Note: Do not forget to regenerate thumbnails.</small>', 'neuron-core'),
	'section'     => 'shop_thumbnail_section',
	'default'     => 'no',
    'choices'     => array(
        'yes' => esc_attr__('On', 'neuron-core'),
        'no' => esc_attr__('Off', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'shop_thumbnail_sizes',
    'label'       => esc_html__('Thumbnail Size', 'neuron-core'),
    'description' => __('Select the image size, you can add new thumbnail sizes in the general options.', 'neuron-core'),
	'section'     => 'shop_thumbnail_section',
	'default'     => 'medium',
    'choices'     => neuron_image_sizes(),
    'active_callback' => array(
        array(
            'setting'  => 'shop_thumbnail_resizer',
            'operator' => '==',
            'value'    => 'yes'
        ),
    )
));

/**
 * Product Settings
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'product_sidebar',
    'label'       => esc_html__('Sidebar', 'neuron-core'),
    'description' => __('Select the placement of sidebar or hide it, default is hidden.', 'neuron-core'),
	'section'     => 'shop_product_section',
	'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__('Left', 'neuron-core'),
        '2' => esc_attr__('Right', 'neuron-core'),
        '3' => esc_attr__('Hide', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'product_navigation',
    'label'       => esc_html__('Navigation', 'neuron-core'),
    'description' => __('Select the visibility of the navigation.', 'neuron-core'),
	'section'     => 'shop_product_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    )
));

// Gallery
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'product_share',
    'label'       => esc_html__('Share', 'neuron-core'),
    'description' => __('Select the visibility of share icons. <br /><small>Note: Make sure to install and activate the NeuronThemes Share plugin.</small>', 'neuron-core'),
	'section'     => 'shop_product_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'product_gallery_message',
	'section'     => 'shop_product_section',
	'default'     => '<h1>' . esc_html__('Gallery', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'product_gallery_alignment',
    'label'       => esc_html__('Alignment', 'neuron-core'),
    'description' => __('Select the alignment of the gallery, if left is selected the content will move right and vice versa.', 'neuron-core'),
	'section'     => 'shop_product_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Left', 'neuron-core'),
        '2' => esc_attr__('Right', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'product_gallery_width',
    'label'       => esc_html__('Width', 'neuron-core'),
    'description' => __('Select the width of the gallery.', 'neuron-core'),
	'section'     => 'shop_product_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('One Half (1/2)', 'neuron-core'),
        '2' => esc_attr__('Two Third Column (2/3)', 'neuron-core'),
        '3' => esc_attr__('Three Fourth Column (3/4)', 'neuron-core')
    )
));

// Related
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'product_gallery_related',
	'section'     => 'shop_product_section',
	'default'     => '<h1>' . esc_html__('Related', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'product_related',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Select the visibility of the related products.', 'neuron-core'),
	'section'     => 'shop_product_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'product_related_count',
    'label'       => esc_html__('Number', 'neuron-core'),
    'description' => __('Select how many products you want to display in related section.', 'neuron-core'),
	'section'     => 'shop_product_section',
	'default'     => '4',
    'choices'     => array(
        '1' => esc_attr__('1 Product', 'neuron-core'),
        '2' => esc_attr__('2 Products', 'neuron-core'),
        '3' => esc_attr__('3 Products', 'neuron-core'),
        '4' => esc_attr__('4 Products', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'product_thumbnail_resizer',
    'label'       => esc_html__('Thumbnail', 'neuron-core'),
    'description' => __('Activate a thumbnail resizer, it will crop all the related products images to a given width & height. <br /><small>Note: Do not forget to regenerate thumbnails.</small>', 'neuron-core'),
	'section'     => 'shop_product_section',
	'default'     => 'no',
    'choices'     => array(
        'yes' => esc_attr__('On', 'neuron-core'),
        'no' => esc_attr__('Off', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'product_thumbnail_sizes',
    'label'       => esc_html__('Thumbnail Size', 'neuron-core'),
    'description' => __('Select the image size, you can add new thumbnail sizes in the general options.', 'neuron-core'),
	'section'     => 'shop_product_section',
	'default'     => 'medium',
    'choices'     => neuron_image_sizes(),
    'active_callback' => array(
        array(
            'setting'  => 'product_thumbnail_resizer',
            'operator' => '==',
            'value'    => 'yes'
        ),
    )
));
