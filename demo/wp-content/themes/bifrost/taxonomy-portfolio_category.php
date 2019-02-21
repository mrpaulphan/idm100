<?php 
/**
 * Portfolio Category
 */
get_header();

get_template_part('templates/hero/taxonomy');

/**
 * Meta
 */
set_query_var('neuron_posts_meta_thumbnail', 'yes');
set_query_var('neuron_posts_meta_title', 'yes');
set_query_var('neuron_posts_meta_categories', 'yes');
set_query_var('neuron_posts_thumbnail_resizer', false);
set_query_var('neuron_posts_style_meta_icon', 'yes');
set_query_var('neuron_posts_carousel_height', 'auto');

/**
 * Hover Visibility and Hover Animation
 */
set_query_var('neuron_posts_hover_visibility', 'show');
set_query_var('neuron_posts_hover_animation', 'translate');

/**
 * Hover
 */
set_query_var('neuron_posts_style_hover_active', 'no');
set_query_var('neuron_posts_style_hover_icon', 'yes');
set_query_var('neuron_posts_style_hover_icon_vertical_alignment', 'center');
set_query_var('neuron_posts_style_hover_icon_horizontal_alignment', 'center');
set_query_var('neuron_posts_style_hover_meta_vertical_alignment', 'center');

/**
 * Breadcrumb
 */
$bifrost_page_breadcrumb = bifrost_inherit_option('general_archive_breadcrumb', 'breadcrumbs_archives_visibility', '2');
bifrost_breadcrumbs($bifrost_page_breadcrumb, get_theme_mod('breadcrumbs_separator'));

do_action('bifrost_open_container');
?>
<div class="l-portfolio-wrapper h-large-top-padding h-large-bottom-padding">
    <div class="l-portfolio-wrapper__items-holder l-portfolio-wrapper__items-holder--meta-inside">
        <div class="row masonry" data-masonry-id="neuron-portfolio-category" >
            <?php while (have_posts()) : the_post(); ?>
                <div class="selector col-sm-6 col-md-4" data-id="<?php the_ID() ?>">
                    <div class="o-portfolio-item" >
                        <?php get_template_part('templates/portfolio/type/meta-inside')  ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php neuron_pagination() ?>
    </div>
</div>
<?php
do_action('bifrost_close_container');

get_footer();