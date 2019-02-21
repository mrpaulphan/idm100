<?php 
/**
 * Base Holder of Blog
 */

/**
 * Type
 */
$bifrost_blog_type = get_theme_mod('blog_type', '2');
if ($bifrost_blog_type == '1') {
    $bifrost_posts_holder = 'l-blog-wrapper__posts-holder--meta-inside';
} else {
    $bifrost_posts_holder = 'l-blog-wrapper__posts-holder--meta-outside l-blog-wrapper__posts-holder--meta-outside--transparent-bg';
}

/**
 * Columns
 * 
 * It changes the columns via the selector
 * item class.
 */
$bifrost_selector_class = 'selector';

switch (get_theme_mod('blog_columns', '2')) {
    case '1':
        $bifrost_selector_class .= ' col-12';
        break;
    case '2':
        $bifrost_selector_class .= ' col-sm-6';
        break;
    default:
        $bifrost_selector_class .= ' col-md-4 col-sm-6';
        break;
    case '4':
        $bifrost_selector_class .= ' col-md-3 col-sm-6';
        break;
}

/**
 * Sidebar
 * 
 * Three different options for sidebar
 * two are for placements on the left
 * and the right and the other one to
 * hide the sidebar.
 */
$bifrost_row_class = 'row';
$bifrost_posts_class = 'col-lg-9';
$bifrost_sidebar_class = 'col-lg-3';

if (get_theme_mod('blog_sidebar', '2') == '1') {
    $bifrost_row_class .= ' flex-row-reverse';
} elseif (get_theme_mod('blog_sidebar', '2') == '3') {
    $bifrost_posts_class = 'col-12';
    $bifrost_sidebar_class = 'h-display-none';
}

/**
 * Prevent Empty Sidebar
 */
if (!is_active_sidebar('main-sidebar')) {
    $bifrost_posts_class = 'col-12';
    $bifrost_sidebar_class = 'h-display-none';
}

/**
 * Animation & WOW Delay
 */
$bifrost_blog_animation = get_theme_mod('blog_animation', '2');
$bifrost_blog_holder_class = 'o-blog-post';

if ($bifrost_blog_animation == '2' || $bifrost_blog_animation == '4') {
    $bifrost_blog_holder_class .= ' h-fadeInNeuron wow';    
} elseif ($bifrost_blog_animation == '3' || $bifrost_blog_animation == '5') {
    $bifrost_blog_holder_class .= ' h-fadeInUpNeuron wow';
}

$bifrost_data_wow_delay = false;
$bifrost_data_wow_seconds = 0;

if ($bifrost_blog_animation == '4' || $bifrost_blog_animation == '5') {
    $bifrost_data_wow_delay = true;
}

/**
 * Spacing
 * 
 * It's used for the spacing between
 * blog posts.
 */
$bifrost_blog_spacing = get_theme_mod('blog_spacing', '2');
$bifrost_blog_spacing_value = get_theme_mod('blog_spacing_value', 30);

$bifrost_blog_spacing_bool = $bifrost_blog_spacing == '1' && $bifrost_blog_spacing_value || $bifrost_blog_spacing == '1' && $bifrost_blog_spacing_value == '0' ? true : false; 
$bifrost_blog_spacing_row = $bifrost_blog_spacing_selector = $bifrost_blog_spacing_post = null;

if ($bifrost_blog_spacing == '1' && $bifrost_blog_spacing_value) {
    $bifrost_blog_spacing_row = 'margin-left: -'. $bifrost_blog_spacing_value / 2 .'px; margin-right: -'. $bifrost_blog_spacing_value / 2 .'px';
    $bifrost_blog_spacing_selector = 'padding-left: '. $bifrost_blog_spacing_value / 2 .'px; padding-right: '. $bifrost_blog_spacing_value / 2 .'px';
    $bifrost_blog_spacing_post = 'margin-bottom: '. $bifrost_blog_spacing_value .'px';
} elseif ($bifrost_blog_spacing == '1' && $bifrost_blog_spacing_value == '0') {
    $bifrost_blog_spacing_row = 'margin-left: 0; margin-right: 0';
    $bifrost_blog_spacing_selector = 'padding-left: 0; padding-right: 0';
    $bifrost_blog_spacing_post = 'margin-bottom: 0';
}

/**
 * Meta Visibility
 */
set_query_var('neuron_posts_meta_thumbnail', get_theme_mod('blog_thumbnail_visibility', 'yes'));
set_query_var('neuron_posts_meta_title', 'yes');
set_query_var('neuron_posts_meta_date', get_theme_mod('blog_date_visibility', 'yes'));
set_query_var('neuron_posts_meta_categories', get_theme_mod('blog_categories_visibility', 'yes'));
set_query_var('neuron_posts_meta_tags', get_theme_mod('blog_tags_visibility', 'no'));
set_query_var('neuron_posts_meta_excerpt', get_theme_mod('blog_excerpt_visibility', 'yes'));
set_query_var('neuron_posts_meta_author', get_theme_mod('blog_author_visibility', 'yes'));
set_query_var('neuron_posts_style_meta_icon', 'no');
set_query_var('neuron_posts_style_author_avatar', 'yes');
set_query_var('neuron_posts_style_author_alignment', 'left');
set_query_var('neuron_posts_carousel_height', 'auto');
set_query_var('neuron_posts_style_hover_active', 'no');

/**
 * Hover Visibility
 * 
 * Pass the variable to global query to
 * inherit later in meta-inside and outside
 * of the blog types.
 */
set_query_var('neuron_posts_hover_visibility', get_theme_mod('blog_hover_visibility', 'show'));

/**
 * Hover Animation
 * 
 * Pass the variable to global query to
 * inherit later in meta-inside and outside
 * of the blog types.
 */
set_query_var('neuron_posts_hover_animation', get_theme_mod('blog_hover_animation', 'scale'));

/**
 * Thumbnail Sizes
 */
$neuron_blog_thumbnail_resizer = get_theme_mod('blog_thumbnail_resizer', 'no');
$neuron_blog_thumbnail_sizes = get_theme_mod('blog_thumbnail_sizes', 'medium');
$neuron_blog_thumbnail_resizer_output = null;

if ($neuron_blog_thumbnail_resizer == 'yes') {
    foreach (get_intermediate_image_sizes() as $image_size) {
        $neuron_blog_thumbnail_resizer_output[$image_size] = $image_size; 
    }
    $neuron_blog_thumbnail_resizer_output = $neuron_blog_thumbnail_resizer_output[$neuron_blog_thumbnail_sizes];
}

set_query_var('neuron_posts_thumbnail_resizer', $neuron_blog_thumbnail_resizer_output);

/**
 * Hover
 */
set_query_var('neuron_posts_style_hover_icon', 'no');
set_query_var('neuron_posts_style_hover_icon_vertical_alignment', 'center');
set_query_var('neuron_posts_style_hover_icon_horizontal_alignment', 'center');
set_query_var('neuron_posts_style_hover_meta_vertical_alignment', 'center');

/**
 * Paged
 * 
 * Tell the WordPress exactly
 * what page is active.
 */
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

// Show more ajax, excluded posts
$exclude = isset($_GET['exclude']) ? $_GET['exclude'] : '';

/**
 * Arguments
 * 
 * Modify the query with
 * different arguments properties.
 */
$args = array(
    'post_type' => 'post',
    'paged' => $paged
);

if ($exclude) {
	$args['post__not_in'] = $exclude;
}

if (is_home()) {
    $query = new WP_Query($args);
} else {
    $query = $wp_query;
}

if ($query->have_posts()) :
?>
    <div class="l-blog-wrapper h-overflow-hidden h-large-top-padding h-large-bottom-padding">
        <div class="container">
            <div class="<?php echo esc_attr($bifrost_row_class) ?>">
                <div class="<?php echo esc_attr($bifrost_posts_class) ?>">
                    <div class="l-blog-wrapper__posts-holder <?php echo esc_attr($bifrost_posts_holder) ?>">
                        <div class="row masonry" data-masonry-id="<?php echo md5('bifrost-blog-page') ?>" <?php echo wp_kses_post($bifrost_blog_spacing_bool ? 'style="'. $bifrost_blog_spacing_row .'"' : '') ?>>
                            <?php while ($query->have_posts()) : $query->the_post() ?>
                                <?php 
                                /**
                                 * WOW Animation
                                 */
                                $bifrost_data_wow_seconds == 12 ? $bifrost_data_wow_seconds = 0 : '';
                                $bifrost_wow_holder = "data-wow-delay=". $bifrost_data_wow_seconds/10 ."s";
                                ?>
                                <div <?php post_class($bifrost_selector_class) ?> id="id-<?php the_ID() ?>" data-id="<?php the_ID() ?>" <?php echo wp_kses_post($bifrost_blog_spacing_bool ? 'style="'. $bifrost_blog_spacing_selector .'"' : '') ?>> 
                                    <div class="<?php echo esc_attr($bifrost_blog_holder_class) ?>" <?php echo esc_attr($bifrost_data_wow_delay === true && $bifrost_data_wow_seconds ? $bifrost_wow_holder : '') ?> <?php echo wp_kses_post($bifrost_blog_spacing_bool ? 'style="'. $bifrost_blog_spacing_post .'"' : '') ?>>
                                        <?php 
                                        if ($bifrost_blog_type == '1') {
                                            get_template_part('templates/blog/type/meta-inside');
                                        } else {
                                            get_template_part('templates/blog/type/meta-outside');
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php $bifrost_data_wow_seconds = $bifrost_data_wow_seconds + 2; endwhile; ?>
                        </div>
                        <?php 
                        /**
                         * Pagination
                         */
                        $bifrost_show_more_text = esc_attr__('Show More', 'bifrost');
                        if (get_theme_mod('blog_pagination_style', '1') == '2' && $query->max_num_pages > $paged) {
                        ?>
                            <div class="load-more-posts-holder h-align-center h-medium-top-padding">
                                <button type="button" class="button main-color load-more-posts" data-text="<?php echo esc_attr($bifrost_show_more_text) ?>" data-nofilters="false"><?php echo esc_attr($bifrost_show_more_text) ?></button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php if (get_theme_mod('blog_sidebar', '2') !== '3' && is_active_sidebar('main-sidebar')) : ?>
                    <div class="<?php echo esc_attr($bifrost_sidebar_class) ?>">
                        <div class="o-main-sidebar l-blog-wrapper__sidebar">
                            <?php get_sidebar() ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php 
endif; wp_reset_postdata();

// var_dump(get_theme_mod('blog_pagination_style', '1'));

if (get_theme_mod('blog_pagination_visibility', '1') == '1' || !is_home()) {
    neuron_pagination(); 
} 