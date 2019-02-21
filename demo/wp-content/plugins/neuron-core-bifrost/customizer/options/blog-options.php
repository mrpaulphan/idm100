<?php 
/**
 * Blog Options
 */

// Create Panel and Sections
Kirki::add_panel('blog_options', array(
    'title'       => esc_attr__('Blog', 'neuron-core'),
    'priority'    => 5
));
Kirki::add_section('blog_functionality_options', array(
    'title'          => esc_attr__('Functionality', 'neuron-core'),
	'priority'       => 1,
	'panel'			=> 'blog_options'
));
Kirki::add_section('blog_style_options', array(
    'title'          => esc_attr__('Style', 'neuron-core'),
	'priority'       => 2,
	'panel'			=> 'blog_options'
));
Kirki::add_section('blog_thumbnail_options', array(
    'title'       => esc_attr__('Thumbnail', 'neuron-core'),
    'panel'		  => 'blog_options',
    'priority'    => 3
));
Kirki::add_section('blog_post_options', array(
    'title'          => esc_attr__('Post', 'neuron-core'),
	'priority'       => 4,
	'panel'			=> 'blog_options'
));
Kirki::add_section('blog_static_options', array(
    'title'          => esc_attr__('Static', 'neuron-core'),
    'description'    => esc_attr__('The options in this section will be displayed only in the blog static page.', 'neuron-core'),
	'priority'       => 5,
	'panel'			=> 'blog_options'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_type',
    'label'       => esc_html__('Type', 'neuron-core'),
    'description' => __('Select the type of Blog.', 'neuron-core'),
	'section'     => 'blog_functionality_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Meta Inside', 'neuron-core'),
        '2' => esc_attr__('Meta Outside', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_sidebar',
    'label'       => esc_html__('Sidebar', 'neuron-core'),
    'description' => __('Select the placement of sidebar or hide it, default is right.', 'neuron-core'),
	'section'     => 'blog_functionality_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Left', 'neuron-core'),
        '2' => esc_attr__('Right', 'neuron-core'),
        '3' => esc_attr__('Hide', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_pagination_visibility',
    'label'       => esc_html__('Pagination Visibility', 'neuron-core'),
    'description' => __('Select the pagination visibility. <br /><small>The pagination will not be displayed if there are less posts than posts per page number, even if the option is show.</small>', 'neuron-core'),
	'section'     => 'blog_functionality_options',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));

/**
 * Blog Style
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_columns',
    'label'       => esc_html__('Columns', 'neuron-core'),
    'description' => __('Select the columns of Blog, default is two columns.', 'neuron-core'),
	'section'     => 'blog_style_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('1 Column', 'neuron-core'),
        '2' => esc_attr__('2 Columns', 'neuron-core'),
        '3' => esc_attr__('3 Columns', 'neuron-core'),
        '4' => esc_attr__('4 Columns', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_animation',
    'label'       => esc_html__('Animation', 'neuron-core'),
    'description' => __('Select initial loading animation for posts.', 'neuron-core'),
	'section'     => 'blog_style_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('None', 'neuron-core'),
        '2' => esc_attr__('Fade In', 'neuron-core'),
        '3' => esc_attr__('Fade In Up', 'neuron-core'),
        '4' => esc_attr__('Fade In (with delay)', 'neuron-core'),
        '5' => esc_attr__('Fade In Up (with delay)', 'neuron-core'),
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_spacing',
    'label'       => esc_html__('Spacing', 'neuron-core'),
    'description' => __('Add custom spacing between posts.', 'neuron-core'),
	'section'     => 'blog_style_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('On', 'neuron-core'),
        '2' => esc_attr__('Off', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'slider',
	'settings'    => 'blog_spacing_value',
	'label'       => __('Spacing Value', 'neuron-core'),
	'description' => __('Move the slider to set the value of spacing. <br /> <small>Note: The value is represented in pixels.</small>', 'neuron-core'),
    'section'     => 'blog_style_options',
    'default'     => 30,
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
    ),
    'active_callback' => array(
        array(
            'setting'  => 'blog_spacing',
            'operator' => '==',
            'value'    => '1'
        ),
    )
));

// Hover
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'blog_hover_title',
	'section'     => 'blog_style_options',
	'default'     => '<h1>' . esc_html__('Hover', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_hover_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Select the visibility of the hover.', 'neuron-core'),
	'section'     => 'blog_style_options',
	'default'     => 'show',
    'choices'     => array(
        'show' => esc_attr__('Show', 'neuron-core'),
        'hide' => esc_attr__('Hide', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_hover_animation',
    'label'       => esc_html__('Animation', 'neuron-core'),
    'description' => __('Select the animation of the hover.', 'neuron-core'),
	'section'     => 'blog_style_options',
	'default'     => 'scale',
    'choices'     => array(
        'translate' => esc_attr__('Translate', 'neuron-core'),
        'scale' => esc_attr__('Scale', 'neuron-core')
    )
));

// Meta
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'blog_meta_title',
	'section'     => 'blog_style_options',
	'default'     => '<h1>' . esc_html__('Meta', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_date_visibility',
    'label'       => esc_html__('Date', 'neuron-core'),
    'description' => __('Select the visibility of the date.', 'neuron-core'),
	'section'     => 'blog_style_options',
	'default'     => 'yes',
    'choices'     => array(
        'yes' => esc_attr__('Show', 'neuron-core'),
        'no' => esc_attr__('Hide', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_categories_visibility',
    'label'       => esc_html__('Categories', 'neuron-core'),
    'description' => __('Select the visibility of the categories.', 'neuron-core'),
	'section'     => 'blog_style_options',
	'default'     => 'yes',
    'choices'     => array(
        'yes' => esc_attr__('Show', 'neuron-core'),
        'no' => esc_attr__('Hide', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_tags_visibility',
    'label'       => esc_html__('Tags', 'neuron-core'),
    'description' => __('Select the visibility of the tags.', 'neuron-core'),
	'section'     => 'blog_style_options',
	'default'     => 'no',
    'choices'     => array(
        'yes' => esc_attr__('Show', 'neuron-core'),
        'no' => esc_attr__('Hide', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_excerpt_visibility',
    'label'       => esc_html__('Excerpt', 'neuron-core'),
    'description' => __('Select the visibility of the excerpt.', 'neuron-core'),
	'section'     => 'blog_style_options',
	'default'     => 'yes',
    'choices'     => array(
        'yes' => esc_attr__('Show', 'neuron-core'),
        'no' => esc_attr__('Hide', 'neuron-core')
    )
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_author_visibility',
    'label'       => esc_html__('Author', 'neuron-core'),
    'description' => __('Select the visibility of the author.', 'neuron-core'),
	'section'     => 'blog_style_options',
	'default'     => 'yes',
    'choices'     => array(
        'yes' => esc_attr__('Show', 'neuron-core'),
        'no' => esc_attr__('Hide', 'neuron-core')
    )
));

/**
 * Thumbnail Resizer
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_thumbnail_visibility',
    'label'       => esc_html__('Visibility', 'neuron-core'),
    'description' => __('Select the visibility of the thumbnail on blog pages.', 'neuron-core'),
	'section'     => 'blog_thumbnail_options',
	'default'     => 'yes',
    'choices'     => array(
        'yes' => esc_attr__('Show', 'neuron-core'),
        'no' => esc_attr__('Hide', 'neuron-core')
    ),
));

Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_thumbnail_resizer',
    'label'       => esc_html__('Resizer', 'neuron-core'),
    'description' => __('Activate a thumbnail resizer, it will crop all the images to a given width & height. <br /><small>Note: Do not forget to regenerate thumbnails.</small>', 'neuron-core'),
	'section'     => 'blog_thumbnail_options',
	'default'     => 'no',
    'choices'     => array(
        'yes' => esc_attr__('On', 'neuron-core'),
        'no' => esc_attr__('Off', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_thumbnail_sizes',
    'label'       => esc_html__('Image Sizes', 'neuron-core'),
    'description' => __('Select the image size, you can add new thumbnail sizes in the general options.', 'neuron-core'),
	'section'     => 'blog_thumbnail_options',
	'default'     => 'medium',
    'choices'     => neuron_image_sizes(),
    'active_callback' => array(
        array(
            'setting'  => 'blog_thumbnail_resizer',
            'operator' => '==',
            'value'    => 'yes'
        ),
    )
));

/**
 * Post
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_post_thumbnail',
    'label'       => esc_html__('Thumbnail', 'neuron-core'),
    'description' => __('Select the visibility of the thumbnail on post.', 'neuron-core'),
	'section'     => 'blog_post_options',
	'default'     => '1',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_post_navigation_visibility',
    'label'       => esc_html__('Navigation Visibility', 'neuron-core'),
    'description' => __('Show or hide the navigation on blog post.', 'neuron-core'),
	'section'     => 'blog_post_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_post_navigation_category',
    'label'       => esc_html__('Navigation Category', 'neuron-core'),
    'description' => __('Enable if you want the posts to be navigated only in the same category.', 'neuron-core'),
	'section'     => 'blog_post_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Enable', 'neuron-core'),
        '2' => esc_attr__('Disable', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_post_share',
    'label'       => esc_html__('Share', 'neuron-core'),
    'description' => __('Select the visibility of share icons. <br /><small>Note: Make sure to install and activate the NeuronThemes Share plugin.</small>', 'neuron-core'),
	'section'     => 'blog_post_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Show', 'neuron-core'),
        '2' => esc_attr__('Hide', 'neuron-core')
    ),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'blog_post_sidebar',
    'label'       => esc_html__('Sidebar', 'neuron-core'),
    'description' => __('Select the placement of sidebar or hide it, default is right.', 'neuron-core'),
	'section'     => 'blog_post_options',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Left', 'neuron-core'),
        '2' => esc_attr__('Right', 'neuron-core'),
        '3' => esc_attr__('Hide', 'neuron-core')
    ),
));

/**
 * Static Blog Page
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'text',
	'settings'    => 'blog_title',
    'label'       => esc_html__('Title', 'neuron-core'),
    'description' => __('Enter the text that will appear as blog title.', 'neuron-core'),
    'section'     => 'blog_static_options'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'textarea',
	'settings'    => 'blog_content',
    'label'       => esc_html__('Content', 'neuron-core'),
    'description' => __('Enter the text that will appear as blog content.', 'neuron-core'),
    'section'     => 'blog_static_options'
));