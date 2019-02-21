<?php 
/**
 * Utility Options
 */

// Create Panel and Sections
Kirki::add_panel('utility_options', array(
    'title'       => esc_attr__('Utility', 'neuron-core'),
    'priority'    => 7
));
Kirki::add_section('title_section', array(
    'title'          => esc_attr__('Title', 'neuron-core'),
	'panel'			=> 'utility_options'
));
Kirki::add_section('breadcrumbs_section', array(
    'title'          => esc_attr__('Breadcrumbs', 'neuron-core'),
	'panel'			=> 'utility_options'
));
Kirki::add_section('hero_section', array(
    'title'          => esc_attr__('Hero', 'neuron-core'),
	'panel'			=> 'utility_options'
));
Kirki::add_section('to_top_section', array(
    'title'          => esc_attr__('To Top', 'neuron-core'),
	'panel'			=> 'utility_options'
));
Kirki::add_section('search_section', array(
    'title'          => esc_attr__('Search', 'neuron-core'),
	'panel'			=> 'utility_options'
));
Kirki::add_section('404_section', array(
    'title'          => esc_attr__('Error 404', 'neuron-core'),
	'panel'			=> 'utility_options'
));

// Title Options
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'general_title_page',
    'label'       => esc_html__('Page Title', 'neuron-core'),
    'description' => __('Show or hide the title on pages.', 'neuron-core'),
	'section'     => 'title_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'general_title_post',
    'label'       => esc_html__('Post Title', 'neuron-core'),
    'description' => __('Show or hide the title on posts.', 'neuron-core'),
	'section'     => 'title_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'general_title_product',
    'label'       => esc_html__('Product Title', 'neuron-core'),
    'description' => __('Show or hide the title on products.', 'neuron-core'),
	'section'     => 'title_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'general_title_portfolio_item',
    'label'       => esc_html__('Portfolio Item Title', 'neuron-core'),
    'description' => __('Show or hide the title on portfolio items.', 'neuron-core'),
	'section'     => 'title_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));

// Breadcrumbs Options
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'breadcrumbs_separator',
	'label'    => __('Separator', 'neuron-core'),
	'description'  => esc_attr__('Enter the text that will appear as separator between each breadcrumb.', 'neuron-core'),
	'section'  => 'breadcrumbs_section'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'breadcrumbs_page_visibility',
    'label'       => esc_html__('Page Visibility', 'neuron-core'),
    'description' => __('Show or hide the breadcrumb in pages.', 'neuron-core'),
	'section'     => 'breadcrumbs_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'breadcrumbs_post_visibility',
    'label'       => esc_html__('Post Visibility', 'neuron-core'),
    'description' => __('Show or hide the breadcrumb in posts.', 'neuron-core'),
	'section'     => 'breadcrumbs_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
if (class_exists('WooCommerce')) {
    Kirki::add_field('neuron_kirki', array(
        'type'        => 'select',
        'settings'    => 'breadcrumbs_product_visibility',
        'label'       => esc_html__('Product Visibility', 'neuron-core'),
        'description' => __('Show or hide the breadcrumb in products.', 'neuron-core'),
        'section'     => 'breadcrumbs_section',
        'default'     => '2',
        'choices'     => array(
            '1' => esc_attr__('Show', 'neuron-core'),
            '2' => esc_attr__('Hide', 'neuron-core')
        ),
    ));
}
if (class_exists('WooCommerce')) {
    Kirki::add_field('neuron_kirki', array(
        'type'        => 'select',
        'settings'    => 'breadcrumbs_shop_visibility',
        'label'       => esc_html__('Shop Visibility', 'neuron-core'),
        'description' => __('Show or hide the breadcrumb in shop.', 'neuron-core'),
        'section'     => 'breadcrumbs_section',
        'default'     => '2',
        'choices'     => array(
            '1' => esc_attr__('Show', 'neuron-core'),
            '2' => esc_attr__('Hide', 'neuron-core')
        ),
    ));
}
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'breadcrumbs_portfolio_item_visibility',
    'label'       => esc_html__('Portfolio Item Visibility', 'neuron-core'),
    'description' => __('Show or hide the breadcrumb in portfolio items.', 'neuron-core'),
	'section'     => 'breadcrumbs_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'breadcrumbs_archives_visibility',
    'label'       => esc_html__('Archives Visibility', 'neuron-core'),
    'description' => __('Show or hide the breadcrumb in archives(Categories, Tags, Custom Taxonomies).', 'neuron-core'),
	'section'     => 'breadcrumbs_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));

// Hero Settings
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'hero_message',
	'section'     => 'hero_section',
	'default'     => '<h1>' . esc_html__('Settings', 'neuron-core') . '</h1> <hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Show or hide the hero, all posts and pages will have the option to inherit this value or set it individually.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'dimension',
	'settings'    => 'hero_height',
	'label'       => esc_attr__('Height', 'neuron-core'),
	'description' => esc_attr__('Enter the height, do not forget to add the unit too, for example px/vh/rem/em/%.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '25vh'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_container',
    'label'       => esc_html__('Container', 'neuron-core'),
    'description' => __('Select if you want the hero to be boxed in 1140px width or not.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('On', 'neuron-core'),
        '2' => esc_attr__('Off', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_alignment',
    'label'       => esc_html__('Alignment', 'neuron-core'),
    'description' => __('Select the text alignment of the hero.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Left', 'neuron-core'),
        '2' => esc_attr__('Center', 'neuron-core'),
        '3' => esc_attr__('Right', 'neuron-core')
    ),
));

// Image 
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'hero_message_image',
	'section'     => 'hero_section',
	'default'     => '<h1>' . esc_html__('Image', 'neuron-core') . '</h1> <hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_image',
    'label'       => esc_html__('Image', 'neuron-core'),
    'description' => __('Select the image you want to display as hero background image.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '4',
    'choices'     => array(
        '1' => esc_attr__('Use the post/page featured image', 'neuron-core'),
        '2' => esc_attr__('Use the theme default image', 'neuron-core'),
        '3' => esc_attr__('Custom Image', 'neuron-core'),
        '4' => esc_attr__('No Image', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'image',
	'settings'    => 'hero_custom_image',
	'label'       => esc_attr__('Custom Image', 'neuron-core'),
	'description' => esc_attr__('Upload a custom image which will be displayed in all posts/page heroes, except those who do not inherit from the option.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '',
	'choices'     => array(
		'save_as' => 'id',
    ),
    'active_callback' => array(
        array(
            'setting'  => 'hero_image',
            'operator' => '==',
            'value'    => '3'
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_image_repeat',
    'label'       => esc_html__('Repeat', 'neuron-core'),
    'description' => __('Select the image repeat settings.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('No Repeat', 'neuron-core'),
        '2' => esc_attr__('Repeat All', 'neuron-core'),
        '3' => esc_attr__('Repeat Horizontally', 'neuron-core'),
        '4' => esc_attr__('Repeat Vertically', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_image_attachment',
    'label'       => esc_html__('Attachment', 'neuron-core'),
    'description' => __('Select the image attachment.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Scroll', 'neuron-core'),
        '2' => esc_attr__('Fixed', 'neuron-core'),
        '3' => esc_attr__('Local', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_image_position',
    'label'       => esc_html__('Position', 'neuron-core'),
    'description' => __('Select the image position.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '5',
    'choices'     => array(
        '1' => esc_attr__('Left Top', 'neuron-core'),
        '2' => esc_attr__('Left Center', 'neuron-core'),
        '3' => esc_attr__('Left Bottom', 'neuron-core'),
        '4' => esc_attr__('Center Top', 'neuron-core'),
        '5' => esc_attr__('Center Center', 'neuron-core'),
        '6' => esc_attr__('Center Bottom', 'neuron-core'),
        '7' => esc_attr__('Right Top', 'neuron-core'),
        '8' => esc_attr__('Right Center', 'neuron-core'),
        '9' => esc_attr__('Right Bottom', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_image_size',
    'label'       => esc_html__('Size', 'neuron-core'),
    'description' => __('Select the image size.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Auto', 'neuron-core'),
        '2' => esc_attr__('Cover', 'neuron-core'),
        '3' => esc_attr__('Contain', 'neuron-core'),
        '4' => esc_attr__('Initial', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_image_overlay',
    'label'       => esc_html__('Overlay', 'neuron-core'),
    'description' => __('Show an overlay for the background image.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'number',
	'settings'    => 'hero_image_overlay_opacity',
    'label'       => esc_html__('Overlay Opacity', 'neuron-core'),
    'description' => __('Enter the number of overlay opacity, the number can be in range of 0 and 1.', 'neuron-core'),
    'section'     => 'hero_section',
    'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 1,
		'step' => 0.01
    ),
    'active_callback' => array(
        array(
            'setting'  => 'hero_image_overlay',
            'operator' => '==',
            'value'    => '1',
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'color',
	'settings'    => 'hero_image_overlay_color',
    'label'       => esc_html__('Overlay Color', 'neuron-core'),
    'description' => __('Select the color of overlay.', 'neuron-core'),
    'section'     => 'hero_section',
    'active_callback' => array(
        array(
            'setting'  => 'hero_image_overlay',
            'operator' => '==',
            'value'    => '1',
        ),
    )
));

// Title
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'hero_message_title',
	'section'     => 'hero_section',
	'default'     => '<h1>' . esc_html__('Title', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_title',
    'label'       => esc_html__('Title', 'neuron-core'),
    'description' => __('Select the title you want to display in the hero.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Use the post/page title', 'neuron-core'),
        '2' => esc_attr__('Custom Title', 'neuron-core'),
        '3' => esc_attr__('No Title', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'editor',
	'settings'    => 'hero_custom_title',
    'label'       => esc_html__('Editor', 'neuron-core'),
    'description' => __('Enter the title, it accepts html tags too.', 'neuron-core'),
    'section'     => 'hero_section',
    'active_callback' => array(
        array(
            'setting'  => 'hero_title',
            'operator' => '==',
            'value'    => '2',
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_title_animation',
    'label'       => esc_html__('Animation', 'neuron-core'),
    'description' => __('Select initial loading animation for the title.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('None', 'neuron-core'),
        '2' => esc_attr__('Fade In', 'neuron-core'),
        '3' => esc_attr__('Fade In Up', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'color',
	'settings'    => 'hero_title_color',
	'label'       => __('Color', 'neuron-core'),
	'description' => __('Change the text color of title. <br /><small>Note: The default color is #232931.</small>', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '#232931',
));

// Hero Breadcrumb
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'hero_message_breadcrumb',
	'section'     => 'hero_section',
	'default'     => '<h1>' . esc_html__('Breadcrumb', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'hero_breadcrumb',
    'label'       => esc_html__('Breadcrumb', 'neuron-core'),
    'description' => __('Show the breadcrumb on the hero, below the title.', 'neuron-core'),
	'section'     => 'hero_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));

/**
 * To Top
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'to_top_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Show or hide the to top button.', 'neuron-core'),
	'section'     => 'to_top_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'to_top_skin',
    'label'       => esc_html__('Skin', 'neuron-core'),
    'description' => __('Select the skin of the to top button.', 'neuron-core'),
	'section'     => 'to_top_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Dark', 'neuron-core'),
        '2' => esc_attr__('Light', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'to_top_animation',
    'label'       => esc_html__('Animation', 'neuron-core'),
    'description' => __('Select the animation of to the top button.', 'neuron-core'),
	'section'     => 'to_top_section',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Translate', 'neuron-core'),
        '2' => esc_attr__('Scale', 'neuron-core')
    )
));

/**
 * Search
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'search_columns',
    'label'       => esc_html__('Columns', 'neuron-core'),
    'description' => __('Select the columns of the search page.', 'neuron-core'),
	'section'     => 'search_section',
	'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__('1 Column', 'neuron-core'),
        '2' => esc_attr__('2 Columns', 'neuron-core'),
        '3' => esc_attr__('3 Columns', 'neuron-core'),
        '4' => esc_attr__('4 Columns', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'search_sidebar',
    'label'       => esc_html__('Sidebar', 'neuron-core'),
    'description' => __('Select the sidebar placement in the search page or hide it.', 'neuron-core'),
	'section'     => 'search_section',
	'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__('Left', 'neuron-core'),
        '2' => esc_attr__('Right', 'neuron-core'),
        '3' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'multicheck',
	'settings'    => 'search_post_types',
    'label'       => esc_html__('Post Type', 'neuron-core'),
    'description' => __('Select the included post types in the search page.', 'neuron-core'),
	'section'     => 'search_section',
    'default'     => array('post', 'page', 'portfolio', 'product'),
    'choices'     => array(
        'post' => esc_attr__('Post', 'neuron-core'),
        'page' => esc_attr__('Page', 'neuron-core'),
        'portfolio' => esc_attr__('Portfolio', 'neuron-core'),
        'product' => esc_attr__('Product', 'neuron-core')
    ),
));

// Hero
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'search_hero_message',
	'section'     => 'search_section',
	'default'     => '<h1>' . esc_html__('Hero', 'neuron-core') . '</h1> <hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'text',
	'settings'    => 'search_hero_content',
    'label'       => esc_html__('Content', 'neuron-core'),
    'description' => __('Enter the content that will appear below the title', 'neuron-core'),
    'section'     => 'search_section'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'image',
	'settings'    => 'search_hero_image',
	'label'       => esc_attr__('Image', 'neuron-core'),
	'description' => __('Upload an image to the hero of the search page.', 'neuron-core'),
	'section'     => 'search_section',
    'choices'     => array(
		'save_as' => 'id'
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'search_hero_overlay',
    'label'       => esc_html__('Overlay', 'neuron-core'),
    'description' => __('Show an overlay for the background image.', 'neuron-core'),
	'section'     => 'search_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'number',
	'settings'    => 'search_hero_overlay_opacity',
    'label'       => esc_html__('Overlay Opacity', 'neuron-core'),
    'description' => __('Enter the number of overlay opacity, the number can be in range of 0 and 1.', 'neuron-core'),
    'section'     => 'search_section',
    'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 1,
		'step' => 0.01
    ),
    'active_callback' => array(
        array(
            'setting'  => 'search_hero_overlay',
            'operator' => '==',
            'value'    => '1',
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'color',
	'settings'    => 'search_hero_overlay_color',
    'label'       => esc_html__('Overlay Color', 'neuron-core'),
    'description' => __('Select the color of overlay.', 'neuron-core'),
    'section'     => 'search_section',
    'active_callback' => array(
        array(
            'setting'  => 'search_hero_overlay',
            'operator' => '==',
            'value'    => '1',
        ),
    )
));

/**
 * 404 Page
 */
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => '404_title',
	'label'    => __('Title', 'neuron-core'),
	'description'  => __('Default: <small>404</small>', 'neuron-core'),
	'section'  => '404_section'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'textarea',
	'settings' => '404_description',
	'label'    => __('Description', 'neuron-core'),
	'description'  => __('Default: <small>The page you were looking for couldn\'t be found. The page could be removed or you misspelled the word while searching for it.</small>', 'neuron-core'),
	'section'  => '404_section'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => '404_button_url',
	'label'    => __('Button Url', 'neuron-core'),
	'description'  => __('Default: <small>The home directory.</small>', 'neuron-core'),
	'section'  => '404_section'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => '404_button_text',
	'label'    => __('Button Text', 'neuron-core'),
	'description'  => __('Default: <small>Back to Homepage</small>', 'neuron-core'),
	'section'  => '404_section'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => '404_section_message',
	'section'     => '404_section',
	'default'     => '<h1>' . esc_html__('Hero', 'neuron-core') . '</h1> <hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'image',
	'settings'    => '404_hero_image',
	'label'       => esc_attr__('Image', 'neuron-core'),
	'description' => __('Upload an image to the hero of the 404 page.', 'neuron-core'),
	'section'     => '404_section',
    'choices'     => array(
		'save_as' => 'id'
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => '404_hero_overlay',
    'label'       => esc_html__('Overlay', 'neuron-core'),
    'description' => __('Show an overlay for the background image.', 'neuron-core'),
	'section'     => '404_section',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'number',
	'settings'    => '404_hero_overlay_opacity',
    'label'       => esc_html__('Overlay Opacity', 'neuron-core'),
    'description' => __('Enter the number of overlay opacity, the number can be in range of 0 and 1.', 'neuron-core'),
    'section'     => '404_section',
    'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 1,
		'step' => 0.01
    ),
    'active_callback' => array(
        array(
            'setting'  => '404_hero_overlay',
            'operator' => '==',
            'value'    => '1',
        ),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'color',
	'settings'    => '404_hero_overlay_color',
    'label'       => esc_html__('Overlay Color', 'neuron-core'),
    'description' => __('Select the color of overlay.', 'neuron-core'),
    'section'     => '404_section',
    'active_callback' => array(
        array(
            'setting'  => '404_hero_overlay',
            'operator' => '==',
            'value'    => '1',
        ),
    )
));