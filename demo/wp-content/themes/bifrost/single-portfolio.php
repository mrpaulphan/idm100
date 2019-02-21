<?php
/**
 * Portfolio Single
 */
get_header();

get_template_part('templates/hero/standard');

/**
 * Breadcrumb
 */
$bifrost_page_breadcrumb = bifrost_inherit_option('general_breadcrumb', 'breadcrumbs_portfolio_item_visibility', '2');
bifrost_breadcrumbs($bifrost_page_breadcrumb, get_theme_mod('breadcrumbs_separator'));

if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php if (get_field('portfolio_item_type') != '3') : ?>
            <div class="container">
                <div class="p-portfolio-single h-large-top-padding h-large-bottom-padding">
                    <?php
                    // Portfolio Item Type
                    if (get_field('portfolio_item_type') == '1') {
                        get_template_part('templates/portfolio-item/type/side');
                    } elseif (get_field('portfolio_item_type') == '2') {
                        get_template_part('templates/portfolio-item/type/vertical');
                    } 
                    ?>
                </div>
            </div>
        <?php endif; ?>
        <?php get_field('portfolio_item_type') == '3' ? the_content() : '' ?>
    <?php endwhile; 
endif;

// Item Navigation
get_template_part('templates/portfolio-item/navigation');

get_footer();