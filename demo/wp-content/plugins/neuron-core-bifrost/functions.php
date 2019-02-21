<?php
/**
 * Neuron Functions
 * 
 * Page Builder included directly
 * to the theme with custom elements.
 */

/**
 * Core Styles 
 */
function neuron_core_styles() {
    wp_enqueue_style('neuron-style', plugin_dir_url(__FILE__) . '/assets/styles/style.css', false, NEURON_CORE_VERSION, null);    
    wp_enqueue_style('perfect-scrollbar-style', plugin_dir_url(__FILE__) . '/assets/styles/perfect-scrollbar.css', false, NEURON_CORE_VERSION, null);    
}

/**
 * Core Scripts
 */
function neuron_core_scripts() {
    wp_enqueue_script('countdown', plugin_dir_url(__FILE__) . '/assets/scripts/jquery.countdown.min.js', array('jquery'), NEURON_CORE_VERSION, TRUE); 
    wp_enqueue_script('perfect-scrollbar', plugin_dir_url(__FILE__) . '/assets/scripts/perfect-scrollbar.min.js', array('jquery'), NEURON_CORE_VERSION, TRUE); 
}

/**
 * Admin Scripts
 */
function neuron_admin_scripts() {
    wp_enqueue_script('neuron-admin-script', plugin_dir_url(__FILE__) . '/assets/scripts/admin-script.js', array('jquery'), NEURON_CORE_VERSION, TRUE);
}
/**
 * Share Social Media
 * 
 * Implement share function
 * to singles or pages.
 */
function neuron_share_social_media() {
    $neuron_shortTitle = get_the_title();
    $neuron_shortURL = get_permalink();
    $output = array();

    $neuron_social_array = array(
		'facebook' => array(
            'icon' => 'facebook-f',
            'class' => 'facebook',
            'link' => 'https://www.facebook.com/sharer/sharer.php?u='. esc_url($neuron_shortURL) . ''
        ),
		'twitter' => array(
            'icon' => 'twitter',
            'class' => 'twitter',
            'link' => 'https://twitter.com/intent/tweet?text='. esc_attr($neuron_shortTitle) .'&amp;url='. esc_url($neuron_shortURL).''
        ),
		'google-plus' => array(
            'icon' => 'google-plus-g',
            'class' => 'google-plus',
            'link' => 'https://plus.google.com/share?url='. esc_url($neuron_shortURL) .''
        ),
		'linkedin' => array(
            'icon' => 'linkedin-in',
            'class' => 'linkedin',
            'link' => 'https://www.linkedin.com/shareArticle?mini=true&url='. esc_url($neuron_shortURL) .'&title='. esc_attr($neuron_shortTitle) .''
        ),
		'pinterest' => array(
            'icon' => 'pinterest',
            'class' => 'pinterest',
            'link' => 'https://pinterest.com/pin/create/button/?url='. esc_url($neuron_shortURL) .'&description='. esc_attr($neuron_shortTitle) .''
        )
    );

    $output[] = '<div class="m-social-media">';
    $output[] = '<ul>';
    foreach ($neuron_social_array as $neuron_social) {
        $output[] = '<li class='. $neuron_social['class'] .'><a href='. $neuron_social['link'] .'><i class="fab fa-'. $neuron_social['icon'] .'"></i></a></li>';
    }
    $output[] = '</ul>';
    $output[] = '</div>';

    echo implode(' ', $output);
}

/**
 * Portfolio Post Type
 */
function neuron_portfolio_post_type($custom_post = '') {

    $post_name = $custom_post ? $custom_post : __('Portfolio', 'neuron-core');

    // Post Type
    $labels = array(
        'name'                  => __($post_name, 'neuron-core'),
        'singular_name'         => __($post_name . ' Item', 'neuron-core'),
        'menu_name'             => _x($post_name, 'admin menu', 'neuron-core'),
        'name_admin_bar'        => _x($post_name . ' Item', 'add new on admin bar', 'neuron-core'),
        'add_new'               => __('Add New Item', 'neuron-core'),
        'add_new_item'          => __('Add New ' . $post_name . ' Item', 'neuron-core'),
        'new_item'              => __('Add New ' . $post_name . ' Item', 'neuron-core'),
        'edit_item'             => __('Edit ' . $post_name . ' Item', 'neuron-core'),
        'view_item'             => __('View Item', 'neuron-core'),
        'all_items'             => __('All ' . $post_name . ' Items', 'neuron-core'),
        'search_items'          => __('Search ' . $post_name . '', 'neuron-core'),
        'parent_item_colon'     => __('Parent ' . $post_name . ' Item:', 'neuron-core'),
        'not_found'             => __('No ' . strtolower($post_name) . ' items found', 'neuron-core'),
        'not_found_in_trash'    => __('No ' . strtolower($post_name) . ' items found in trash', 'neuron-core'),
        'filter_items_list'     => __('Filter ' . strtolower($post_name) . ' items list', 'neuron-core'),
        'items_list_navigation' => __($post_name . ' items list navigation', 'neuron-core'),
        'items_list'            => __($post_name . ' items list', 'neuron-core')
    );

    $supports = array(
        'title',
        'editor',
        'excerpt',
        'thumbnail',
        'comments',
        'author',
        'custom-fields',
        'revisions',
    );

    $args = array(
        'labels'          => $labels,
        'supports'        => $supports,
        'public'          => true,
        'capability_type' => 'post',
        'rewrite'         => array('slug' => strtolower($post_name)), // Permalinks format
        'menu_position'   => 5,
        'menu_icon'       => (version_compare( $GLOBALS['wp_version'], '3.8', '>=')) ? 'dashicons-portfolio' : false,
        'has_archive'     => true
    );
    
    register_post_type('portfolio', $args);
}

/**
 * Taxonomies
 */
function neuron_portfolio_categories($custom_post = '') {

    $post_name = $custom_post ? $custom_post : __('Portfolio', 'neuron-core');

    $labels = array(
        'name'                       => __($post_name . ' Categories', 'neuron-core'),
        'singular_name'              => __($post_name . ' Category', 'neuron-core'),
        'menu_name'                  => __($post_name . ' Categories', 'neuron-core'),
        'edit_item'                  => __('Edit ' . $post_name . ' Category', 'neuron-core'),
        'update_item'                => __('Update ' . $post_name . ' Category', 'neuron-core'),
        'add_new_item'               => __('Add New ' . $post_name . ' Category', 'neuron-core'),
        'new_item_name'              => __('New ' . $post_name . ' Category Name', 'neuron-core'),
        'parent_item'                => __('Parent ' . $post_name . ' Category', 'neuron-core'),
        'parent_item_colon'          => __('Parent ' . $post_name . ' Category:', 'neuron-core'),
        'all_items'                  => __('All ' . $post_name . ' Categories', 'neuron-core'),
        'search_items'               => __('Search ' . $post_name . ' Categories', 'neuron-core'),
        'popular_items'              => __('Popular ' . $post_name . ' Categories', 'neuron-core'),
        'separate_items_with_commas' => __('Separate ' . strtolower($post_name) . ' categories with commas', 'neuron-core'),
        'add_or_remove_items'        => __('Add or remove ' . strtolower($post_name) . ' categories', 'neuron-core'),
        'choose_from_most_used'      => __('Choose from the most used ' . strtolower($post_name) . ' categories', 'neuron-core'),
        'not_found'                  => __('No ' . strtolower($post_name) . ' categories found.', 'neuron-core'),
        'items_list_navigation'      => __($post_name . ' categories list navigation', 'neuron-core'),
        'items_list'                 => __($post_name . ' categories list', 'neuron-core'),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_ui'           => true,
        'show_tagcloud'     => true,
        'hierarchical'      => true,
        'rewrite'           => array('slug' => strtolower($post_name) . '_category'),
        'show_admin_column' => true,
        'query_var'         => true,
    );

    register_taxonomy('portfolio_category', 'portfolio', $args);
}

function neuron_media_categories() {
    $labels = array(
        'name'                       => __('Media Categories', 'neuron-core'),
        'singular_name'              => __('Media Category', 'neuron-core'),
        'menu_name'                  => __('Media Categories', 'neuron-core'),
        'edit_item'                  => __('Edit Media Category', 'neuron-core'),
        'update_item'                => __('Update Media Category', 'neuron-core'),
        'add_new_item'               => __('Add New Media Category', 'neuron-core'),
        'new_item_name'              => __('New Media Category Name', 'neuron-core'),
        'parent_item'                => __('Parent Media Category', 'neuron-core'),
        'parent_item_colon'          => __('Parent Media Category:', 'neuron-core'),
        'all_items'                  => __('All Media Categories', 'neuron-core'),
        'search_items'               => __('Search Media Categories', 'neuron-core'),
        'popular_items'              => __('Popular Media Categories', 'neuron-core'),
        'separate_items_with_commas' => __('Separate portfolio categories with commas', 'neuron-core'),
        'add_or_remove_items'        => __('Add or remove media categories', 'neuron-core'),
        'choose_from_most_used'      => __('Choose from the most used media categories', 'neuron-core'),
        'not_found'                  => __('No media categories found.', 'neuron-core'),
        'items_list_navigation'      => __('Media categories list navigation', 'neuron-core'),
        'items_list'                 => __('Media categories list', 'neuron-core'),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => false,
        'show_in_nav_menus' => false,
        'show_ui'           => true,
        'show_in_quick_edit'=> false,
        'meta_box_cb'       => false,
        'show_tagcloud'     => false,
        'hierarchical'      => false,
        'rewrite'           => array('slug' => 'media_category'),
        'show_admin_column' => false,
        'query_var'         => false,
    );

    register_taxonomy('media_category', 'attachment', $args);
}

// Elementor Setting to Customizer
function neuron_inherit_elementor_option($inherit, $customizer, $default_customizer) {
	$customizer = get_theme_mod($customizer, $default_customizer);

    if (empty($inherit)) {
        $inherit = '1';
	}
	
	if ($inherit == '1') {
        $inherit = $customizer;
    } else {
        $inherit = $inherit - 1;
	}

	return $inherit;
}

/**
 * Custom Post Types
 * 
 * Enable post types by default.
 */
function neuron_add_cpt_support() {
	$neuron_cpt_support = get_option('elementor_cpt_support');
	
	if(!$neuron_cpt_support) {
	    $neuron_cpt_support = ['page', 'post', 'portfolio'];
	    update_option('elementor_cpt_support', $neuron_cpt_support);
	} elseif (!in_array('portfolio', $neuron_cpt_support)) {
	    $neuron_cpt_support[] = 'portfolio';
	    update_option('elementor_cpt_support', $neuron_cpt_support);
	}
}
add_action('after_switch_theme', 'neuron_add_cpt_support');

/**
 * Image Calculation
 * 
 * A simple calculation which returns as padding
 * bottom the height of image, we use it to eleminate
 * the glitches of masonry when loading.
 */
function neuron_image_calculation($image_id, $image_size = 'full') {
	$image_data = wp_get_attachment_image_src($image_id, $image_size);

	return 'padding-bottom: '. number_format($image_data[2] / $image_data[1] * 100, 6) .'% !important;';
}

/**
 * Thumbnails to posts list view
 */
add_filter('manage_posts_columns', 'neuron_image_on_admin_columns');
add_filter('manage_posts_custom_column', 'neuron_manage_image_on_admin_columns', 10, 2);

function neuron_image_on_admin_columns($columns) {
    global $post;

    if (get_post_type() != 'product') {
        $columns['img'] = __('Featured Image', 'neuron-core');
    }
    return $columns;
}

function neuron_manage_image_on_admin_columns($column_name, $post_id) {
    if ($column_name == 'img') {
        echo sprintf(
            '<a href="%s">%s</a>',
            get_edit_post_link($post_id),
            get_the_post_thumbnail($post_id, array(50, 50))
        );
    }
    return $column_name;
}

/**
 * Attachment Alt
 * 
 * Simply gets the attachment alt with the
 * id of image and returns it.
 */
function neuron_get_attachment_alt($image_id) {
	return get_post_meta($image_id, '_wp_attachment_image_alt', true);
}

/**
 * HEX to RGBA
 * 
 * Convert the normal hex to
 * rgba to easier use.
 */
function neuron_hexToRgb($hex, $alpha = false) {
	$hex = str_replace('#', '', $hex);
	$length = strlen($hex);

	$rgb = [
		'r' => hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0)),
		'g' => hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0)),
		'b' => hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0))
	];

	if ($alpha == 'zero') {
		$rgb['a'] = 0;
	} elseif ($alpha) {
		$rgb['a'] = $alpha;
	} 

	return implode(', ', $rgb);
}

/**
 * Image Sizes
 */
function neuron_image_sizes() {
    $thumbnail_sizes = [];
   
    foreach (get_intermediate_image_sizes() as $image_size) {
        $thumbnail_sizes[$image_size] = $image_size;
    }

    if (get_theme_mod('general_image_sizes')) {
        $image_sizes_index = 1;
        foreach (get_theme_mod('general_image_sizes') as $image_size) {
            $thumbnail_sizes['bifrost_image_size_' . $image_sizes_index] = 'bifrost_image_size_' . $image_sizes_index;
            $image_sizes_index++;
        }
    }

    return $thumbnail_sizes;
}

/**
 * Get Elementor Templates.
 */
function neuron_get_elementor_templates($type) {
    $choices = [];

    $pages = get_posts( [
        'sort_column'    => 'post_title',
        'post_type'      => 'elementor_library',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_query'     => [
            [
                'key'   => '_elementor_template_type',
                'value' => $type,
            ],
        ],
    ] );

    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }

    return $choices;
}