<?php
/**
 * Theme Functions
 *
 * @package Bifrost
 * @author NeuronThemes
 * @link http://neuronthemes.com
 */

/**
 * Global Variables
 * 
 * Defining global variables to make
 * usage easier.
 */
define('BIFROST_THEME_DIR', get_template_directory());
define('BIFROST_THEME_URI', get_template_directory_uri());
define('BIFROST_THEME_STYLESHEET', get_stylesheet_uri());
define('BIFROST_THEME_PLACEHOLDER', get_template_directory_uri() . '/assets/images/placeholder.png');
define('BIFROST_THEME_NAME', 'bifrost');
define('BIFROST_THEME_VERSION', '1.1.0');

/**
 * Content Width
 * 
 * Maximum content width is set at 1920,
 * larger images or videos will be cropped
 * to that resolution.
 */
!isset($content_width) ? $content_width = 1920 : '';

/**
 * Text Domain
 * 
 * Makes theme available for translation,
 * translations can be found in the /languages/ directory.
 */
load_theme_textdomain('bifrost', BIFROST_THEME_DIR . '/languages');

// Action to call init
add_action('after_setup_theme', 'bifrost_init');

/**
 * Init
 * 
 * Global function which adds theme support,
 * register nav menus and call actions for
 * different php, js and css files.
 */
function bifrost_init() {
    // Theme Support
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');

	/**
	 * WooCommerce Theme Support
	 * 
	 * Theme fully supports plugin WooCommerce
	 * also it's features in single product
	 * as zoom, lightbox and slider.
	 */
	if (class_exists('WooCommerce')) {
		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');
	}

	// Image Sizes
	$bifrost_general_image_sizes = get_theme_mod('general_image_sizes');
	if ($bifrost_general_image_sizes) {
		$index = 1;
		foreach ($bifrost_general_image_sizes as $image_size) {
			add_image_size('bifrost_image_size_' . $index, isset($image_size['image_size_width']) ? $image_size['image_size_width'] : '', isset($image_size['image_size_height']) ? $image_size['image_size_height'] : 9999, true);
			$index++;
		}
	}

	// Include custom files
	include(BIFROST_THEME_DIR . '/includes/functions/neuron-functions.php');
    include(BIFROST_THEME_DIR . '/includes/functions/style-functions.php');
	include(BIFROST_THEME_DIR . '/includes/admin/extra.php');
	include_once(BIFROST_THEME_DIR . '/includes/tgm/class-tgm-plugin-activation.php');
	include_once(BIFROST_THEME_DIR . '/includes/admin/acf/acf-fields.php');
	get_theme_mod('custom_fields_panel', '2') == '2' ? define('ACF_LITE' , true) : '';

    // Theme actions within init function
    add_action('tgmpa_register', 'bifrost_plugins');
    add_action('wp_enqueue_scripts', 'bifrost_external_css');
    add_action('wp_enqueue_scripts', 'bifrost_external_js');
    add_action('admin_enqueue_scripts', 'bifrost_add_extra_scripts');
    add_action('widgets_init', 'bifrost_widgets_init');
    
    // Register Menus
	register_nav_menus(
		array(
			'main-menu' => esc_html__('Main Menu', 'bifrost')
		)
	);
}

/**
 * TGMPA
 * 
 * An addon which helps theme to install
 * and activate different plugins.
 */
function bifrost_plugins() {
    $plugins = array(
        array(
            'name'      => esc_html__('Advanced Custom Fields', 'bifrost'),
            'slug'      => 'advanced-custom-fields',
            'required'  => true
        ),
        array(
			'name'      => esc_html__('Elementor', 'bifrost'),
            'slug'      => 'elementor',
            'required'  => true
        ),
        array(
			'name'        => esc_html__('Neuron Core', 'bifrost'),
            'slug'        => 'neuron-core-bifrost',
			'source'    	=> BIFROST_THEME_DIR . '/includes/plugins/neuron-core-bifrost.zip',
		    'required'    => true
		),
		array(
            'name'      => esc_html__('Revolution Slider', 'bifrost'),
			'slug'      => 'revslider',
			'source'    => BIFROST_THEME_DIR . '/includes/plugins/revslider.zip',
            'required'  => false
        ),
        array(
            'name'      => esc_html__('WooCommerce', 'bifrost'),
            'slug'      => 'woocommerce',
            'required'  => false
        ),
        array(
            'name'       => esc_html__('One Click Demo Import', 'bifrost'),
            'slug'       => 'one-click-demo-import',
            'required'   => false
		),
        array(
            'name'       => esc_html__('Contact Form 7', 'bifrost'),
            'slug'       => 'contact-form-7',
            'required'   => false
        )
    );
    $config = array(
        'id'           => 'tgmpa',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => ''
    );
    tgmpa($plugins, $config);
}

// External CSS
function bifrost_external_css() {
    wp_enqueue_style('bifrost-main-style', BIFROST_THEME_URI . '/assets/styles/bifrost.css', false, BIFROST_THEME_VERSION, null);
    wp_enqueue_style('magnific-popup', BIFROST_THEME_URI . '/assets/styles/magnific-popup.css', false, BIFROST_THEME_VERSION, null);
    wp_enqueue_style('owl-carousel', BIFROST_THEME_URI . '/assets/styles/owl.carousel.min.css', false, BIFROST_THEME_VERSION, null);
	wp_enqueue_style('bifrost-wp-style', BIFROST_THEME_STYLESHEET);
	wp_enqueue_style('bifrost-fonts', bifrost_fonts_url(), array(), BIFROST_THEME_VERSION);
	
	// Custom Style and Fonts
	wp_add_inline_style('bifrost-wp-style', bifrost_custom_style());
	wp_add_inline_style('bifrost-wp-style', bifrost_body_offset());
}

// External Javascript
function bifrost_external_js() {
	if (!is_admin()) {
		wp_enqueue_script('isotope', BIFROST_THEME_URI . '/assets/scripts/isotope.pkgd.min.js', array('jquery'), BIFROST_THEME_VERSION, TRUE);
		wp_enqueue_script('packery-mode', BIFROST_THEME_URI . '/assets/scripts/packery-mode.pkgd.min.js', array('jquery'), BIFROST_THEME_VERSION, TRUE);
		wp_enqueue_script('magnific-popup', BIFROST_THEME_URI . '/assets/scripts/jquery.magnific-popup.min.js', array('jquery'), BIFROST_THEME_VERSION, TRUE);
		wp_enqueue_script('owl-carousel', BIFROST_THEME_URI . '/assets/scripts/owl.carousel.min.js', array('jquery'), BIFROST_THEME_VERSION, TRUE);
		wp_enqueue_script('typed', BIFROST_THEME_URI . '/assets/scripts/typed.min.js', array('jquery'), BIFROST_THEME_VERSION, TRUE);
		wp_enqueue_script('wow', BIFROST_THEME_URI . '/assets/scripts/wow.min.js', array('jquery'), BIFROST_THEME_VERSION, TRUE);
		wp_enqueue_script('theia-sticky-sidebar', BIFROST_THEME_URI . '/assets/scripts/theia-sticky-sidebar.js', array('jquery'), BIFROST_THEME_VERSION, TRUE);
		wp_enqueue_script('headroom', BIFROST_THEME_URI . '/assets/scripts/headroom.js', array('jquery'), BIFROST_THEME_VERSION, TRUE);
		wp_enqueue_script('headroom-zepto', BIFROST_THEME_URI . '/assets/scripts/jQuery.headroom.js', array('jquery'), BIFROST_THEME_VERSION, TRUE);
		wp_enqueue_script('bifrost-scripts', BIFROST_THEME_URI . '/assets/scripts/bifrost.js', array('jquery'), BIFROST_THEME_VERSION, TRUE);

        is_singular() ? wp_enqueue_script('comment-reply') : '';
	}
}

// Enqueue Extra Scripts
function bifrost_add_extra_scripts() {
	wp_enqueue_style('bifrost-admin-style', BIFROST_THEME_URI . '/includes/admin/style.css', false, BIFROST_THEME_VERSION, null);
	wp_enqueue_script('bifrost-admin-script', BIFROST_THEME_URI . '/includes/admin/script.js', array('jquery'), BIFROST_THEME_VERSION, TRUE);
}

// Init Widgets
function bifrost_widgets_init() {
    register_sidebar(
    	array(
			'name' => esc_html__('Main Sidebar', 'bifrost'),
			'description' => esc_html__('Widgets on this sidebar are displayed in Blog Page.', 'bifrost'),
			'id' => 'main-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widgettitle-wrapper"><h5 class="widgettitle">',
			'after_title'   => '</h5></div>'
    	)
	);
	if (class_exists('WooCommerce')) {
		register_sidebar(
			array(
				'name' => esc_html__('Shop Sidebar', 'bifrost'),
				'description' => esc_html__('Widgets on this sidebar are displayed in Shop Pages.', 'bifrost'),
				'id' => 'shop-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widgettitle-wrapper"><h5 class="widgettitle">',
				'after_title'   => '</h3></div>'
			)
		);
	}
    register_sidebar(
    	array(
			'name' => esc_html__('Footer Sidebar 1', 'bifrost'),
			'description' => esc_html__('Widgets on this sidebar are placed on the first column of footer.', 'bifrost'),
			'id' => 'sidebar-footer-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widgettitle-wrapper"><h5 class="widgettitle">',
			'after_title'   => '</h5></div>'
    	)
	);
    register_sidebar(
    	array(
			'name' => esc_html__('Footer Sidebar 2', 'bifrost'),
			'description' => esc_html__('Widgets on this sidebar are placed on the second column of footer.', 'bifrost'),
			'id' => 'sidebar-footer-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widgettitle-wrapper"><h5 class="widgettitle">',
			'after_title'   => '</h5></div>'
    	)
	);
    register_sidebar(
    	array(
			'name' => esc_html__('Footer Sidebar 3', 'bifrost'),
			'description' => esc_html__('Widgets on this sidebar are placed on the third column of footer.', 'bifrost'),
			'id' => 'sidebar-footer-3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widgettitle-wrapper"><h5 class="widgettitle">',
			'after_title'   => '</h5></div>'
    	)
	);
    register_sidebar(
    	array(
			'name' => esc_html__('Footer Sidebar 4', 'bifrost'),
			'description' => esc_html__('Widgets on this sidebar are placed on the fourth column of footer.', 'bifrost'),
			'id' => 'sidebar-footer-4',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widgettitle-wrapper"><h5 class="widgettitle">',
			'after_title'   => '</h5></div>'
    	)
	);
    register_sidebar(
    	array(
			'name' => esc_html__('Footer Sidebar 5', 'bifrost'),
			'description' => esc_html__('Widgets on this sidebar are placed on the fifth column of footer.', 'bifrost'),
			'id' => 'sidebar-footer-5',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widgettitle-wrapper"><h5 class="widgettitle">',
			'after_title'   => '</h5></div>'
    	)
	);
    register_sidebar(
    	array(
			'name' => esc_html__('Footer Sidebar 6', 'bifrost'),
			'description' => esc_html__('Widgets on this sidebar are placed on the sixth column of footer.', 'bifrost'),
			'id' => 'sidebar-footer-6',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widgettitle-wrapper"><h5 class="widgettitle">',
			'after_title'   => '</h5></div>'
    	)
	);
	register_sidebar(
    	array(
			'name' => esc_html__('Sliding Bar Sidebar', 'bifrost'),
			'description' => esc_html__('Widgets on this sidebar are placed on the sliding bar of header.', 'bifrost'),
			'id' => 'sliding-bar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widgettitle-wrapper"><h5 class="widgettitle">',
			'after_title'   => '</h5></div>'
    	)
	);

	if (get_theme_mod('general_sidebars')) {
		foreach (get_theme_mod('general_sidebars') as $sidebar) {
			register_sidebar(
				array(
					'name' => esc_attr($sidebar['sidebar_title']),
					'description' => esc_attr($sidebar['sidebar_description']),
					'id' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $sidebar['sidebar_title']))),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widgettitle-wrapper"><h5 class="widgettitle">',
					'after_title'   => '</h3></div>'
				)
			);
		}
	}
}

/**
 * Mega Menu Classes
 * 
 * Add classes to the menu item when
 * mega menu option is clicked.
 */
add_filter('wp_nav_menu_objects', 'bifrost_mega_menu_class', 10, 2);
function bifrost_mega_menu_class($items, $args) {
	foreach ($items as $item) {
		// Activate
		if (get_field('mega_menu', $item)) {
			$item->classes[] = 'm-mega-menu';
		}

		// Columns
		switch (get_field('mega_menu_columns', $item)) {
			case '1':
				$item->classes[] = 'm-mega-menu--two';
				break;
			case '2':
				$item->classes[] = 'm-mega-menu--three';
				break;
			case '3':
				$item->classes[] = 'm-mega-menu--four';
				break;
			case '4':
				$item->classes[] = 'm-mega-menu--five';
				break;
		}

		// Unclickable
		if (get_field('menu_unclickable', $item)) {
			$item->classes[] = 'disabled';
		}

		// Label
		if (get_field('menu_label', $item) == '2') {
			$item->classes[] = 'a-menu-badge a-menu-badge--new';
		} elseif (get_field('menu_label', $item) == '3') {
			$item->classes[] = 'a-menu-badge a-menu-badge--hot';
		}
	}
	return $items;
}

/**
 * Remove Mega Menu Classes
 * 
 * Remove clases from the menu
 * items, useful for builder.
 */
function bifrost_remove_mega_menu_class($items, $args) {
	foreach ($items as $item) {
		foreach($item->classes as $key => $class) {
			if(strpos($class, 'm-mega-menu') !== false) {
				unset($item->classes[$key]);
			}
		}
	}
	return $items;
}

/**
 * Rewrite the ACF functions incase ACF fails to activate
 */
if (!function_exists('get_field') && !is_admin() && !function_exists('get_sub_field')) {
	function get_field($field_id, $post_id = null) {
		return null;
	}

	function get_sub_field($field_id, $post_id = null){
		return null;
	}
}

/**
 * WooCommerce Placeholder
 */
add_filter('woocommerce_placeholder_img_src', 'bifrost_woocommerce_placeholder_img_src');
function bifrost_woocommerce_placeholder_img_src($src) {
	$src = BIFROST_THEME_PLACEHOLDER;
	 
	return $src;
}

/**
 * Register Fonts
 */
function bifrost_fonts_url() {
	$font_url = '';
	if ('off' !== _x('on', 'Google font: on or off', 'bifrost')) {
		$font_url = add_query_arg('family', urlencode('Roboto:300,400,400i,500,700'), '//fonts.googleapis.com/css');
	}
	return $font_url;
}

/**
 * Custom Template
 */
function bifrost_get_custom_template($id) {
	if (!class_exists('Elementor\Plugin')) {
		return;
	}

	if (empty($id)) {
		return;
	}

	$content = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($id);

	return $content;
}

/**
 * Demo Importer
 * 
 * Import the content, widgets and
 * the customizer settings via the
 * plugin one click demo importer.
 */
add_filter('pt-ocdi/import_files', 'bifrost_ocdi_import_files');
function bifrost_ocdi_import_files() {
	return array(
		array(
			'import_file_name'           => esc_html__('Main Demo', 'bifrost'),
			'import_file_url'            => 'https://neuronthemes.com/bifrost/demo-importer/content.xml',
			'import_widget_file_url'     => 'https://neuronthemes.com/bifrost/demo-importer/widgets.json',
			'import_customizer_file_url' => 'https://neuronthemes.com/bifrost/demo-importer/customizer.dat',
			'import_notice'              => esc_html__('If the homepage is not assigned please go to Settings > Reading and assign the page home.', 'bifrost'),
		),
		array(
			'import_file_name'           => esc_html__('Header Templates', 'bifrost'),
			'categories'                 => array('Templates'),
			'import_file_url'            => 'https://neuronthemes.com/bifrost/demo-importer/header-templates.xml',
			'import_preview_image_url'   => 'https://neuronthemes.com/bifrost/demo-importer/header-preview.jpg',
			'import_notice'              => esc_html__('Only the Header Templates will be imported.', 'bifrost'),
		),
		array(
			'import_file_name'           => esc_html__('Home Portfolio Metro', 'bifrost'),
			'categories'                 => array('Pages'),
			'import_file_url'            => 'https://neuronthemes.com/bifrost/demo-importer/home-portfolio-metro.xml',
			'import_preview_image_url'   => 'https://neuronthemes.com/bifrost/wp-content/uploads/2019/02/home-portfolio-metro.jpg',
			'import_notice'              => esc_html__('Make sure to have the portfolio items imported and the headers.', 'bifrost'),
		),
		array(
			'import_file_name'           => esc_html__('Home Portfolio Split', 'bifrost'),
			'categories'                 => array('Pages'),
			'import_file_url'            => 'https://neuronthemes.com/bifrost/demo-importer/home-portfolio-split.xml',
			'import_preview_image_url'   => 'https://neuronthemes.com/bifrost/wp-content/uploads/2019/02/home-portfolio-split.jpg',
			'import_notice'              => esc_html__('Make sure to have the portfolio items imported and the headers.', 'bifrost'),
		),
	);
}

/**
 * After Import Setup
 * 
 * Set the Classic Home Page as front
 * page and assign the menu to 
 * the main menu location.
 */
add_action('pt-ocdi/after_import', 'bifrost_ocdi_after_import_setup');
function bifrost_ocdi_after_import_setup() {
	$main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

	if ($main_menu) {
		set_theme_mod('nav_menu_locations', array('main-menu' => $main_menu->term_id));
	}

	$front_page_id = get_page_by_title('Creative Agency');
	if ($front_page_id) {
		update_option('page_on_front', $front_page_id->ID);
		update_option('show_on_front', 'page');
	}	
	$blog_page_id = get_page_by_title('Blog');
	if ($blog_page_id) {
		update_option('page_for_posts', $blog_page_id->ID);
	}
}

/**
 * Body Offset
 */
function bifrost_body_offset() {
	if (bifrost_inherit_option('general_body_offset', 'body_offset', '2') == '2')  {
		return;
	}

	$bifrost_offset_output = [];
	$bifrost_body_offset_padding = [
		'theme-options' => get_theme_mod('body_offset_padding'),
		'acf' => [
			'padding-left' => get_field('general_body_offset_padding_left', get_queried_object()),
			'padding-right' => get_field('general_body_offset_padding_right', get_queried_object())
		]
	];

	if (get_field('general_body_offset', get_queried_object()) == '2') {
		$bifrost_body_offset_values = $bifrost_body_offset_padding['acf'];
	} else {
		$bifrost_body_offset_values = $bifrost_body_offset_padding['theme-options'];
	}

	$bifrost_offset_output[] = isset($bifrost_body_offset_values['padding-left']) && $bifrost_body_offset_values['padding-left'] != 0 ? 'padding-left:' . $bifrost_body_offset_values['padding-left'] : '';
	$bifrost_offset_output[] = isset($bifrost_body_offset_values['padding-right']) && $bifrost_body_offset_values['padding-right'] != 0 ? 'padding-right:' . $bifrost_body_offset_values['padding-right'] : ''; 

	// Offset Breakpoint
	if (bifrost_inherit_option('general_body_offset_breakpoint', 'body_offset_breakpoint', '1') == '1') {
		$bifrost_offset_media_query = '1039px';
	} else {
		$bifrost_offset_media_query = '745px';
	}

	return $bifrost_offset_output ? '@media (min-width: '. $bifrost_offset_media_query .'){ body, .l-primary-header--sticky .l-primary-header {' . implode('; ', $bifrost_offset_output) . '}}' : '';
}