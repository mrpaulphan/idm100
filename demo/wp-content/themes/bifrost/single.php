<?php
/**
 * Blog Single
 */
get_header();

get_template_part('templates/hero/standard');

/**
 * Sidebar
 */
$bifrost_row_class = 'row';
$bifrost_posts_class = 'col-lg-9';
$bifrost_sidebar_class = 'col-lg-3';

if (bifrost_inherit_option('blog_post_sidebar', 'blog_post_sidebar', '2') == '1') {
    $bifrost_row_class .= ' flex-row-reverse';
} elseif (bifrost_inherit_option('blog_post_sidebar', 'blog_post_sidebar', '2') == '3') {
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
 * Meta
 */
set_query_var('neuron_posts_style_meta_icon', 'no');

if (have_posts()) : while (have_posts()) : the_post();

/**
 * Breadcrumb
 */
$bifrost_page_breadcrumb = bifrost_inherit_option('general_breadcrumb', 'breadcrumbs_post_visibility', '2');
bifrost_breadcrumbs($bifrost_page_breadcrumb, get_theme_mod('breadcrumbs_separator'));

do_action('bifrost_open_container');
?>
<div class="p-blog-single h-medium-top-padding h-large-bottom-padding">
    <div class="<?php echo esc_attr($bifrost_row_class) ?>">
        <div class="<?php echo esc_attr($bifrost_posts_class) ?>">
            <div class="p-blog-single__wrapper o-blog-post">
                <?php if (has_post_thumbnail() && bifrost_inherit_option('blog_post_thumbnail', 'blog_post_thumbnail', '1') == '1') : ?> 
                    <div class="o-blog-post__thumbnail">
                        <?php the_post_thumbnail() ?>
                    </div>
                <?php endif; ?>
                <div class="o-blog-post__content">
                    <?php 
                    /**
                     * Post Title
                     */
                    if (bifrost_inherit_option('general_title', 'general_title_post', '2') == '1') {
                        the_title('<h2 class="o-blog-post__title">', '</h2>');
                    }
                    ?>
                    <div class="o-blog-post__meta">
                        <?php get_template_part('templates/blog/extra/date') ?>
                        <?php get_template_part('templates/taxonomy/categories') ?>
                    </div>
                    <div class="p-blog-single__content h-clearfix">
                        <?php the_content() ?>
                    </div>
                    <?php wp_link_pages(array('before' => '<div class="o-pagination o-pagination--pages"><span class="o-pagination__title">' . esc_attr__( 'Pages:', 'bifrost' ) . '</span><div class="o-pagination--pages__numbers">', 'after' => '</div></div>', 'link_before' => '<span>', 'link_after' => '</span>', 'next_or_number' => 'next_and_number', 'separator' => '', 'nextpagelink' => esc_attr__('&raquo;', 'bifrost'), 'previouspagelink' => esc_attr__('&laquo;', 'bifrost'), 'pagelink' => '%')); ?>
                    <?php paginate_links() ?>
                </div>
                <?php get_template_part('templates/taxonomy/tags-cloud') ?>
                <?php if (bifrost_inherit_option('blog_post_share', 'blog_post_share', '2') == '1') : ?>
                    <div class="p-blog-single__social-media">
                        <?php get_template_part('templates/extra/share') ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php comments_template() ?>

        </div>
        <?php if (bifrost_inherit_option('blog_post_sidebar', 'blog_post_sidebar', '2') != '3' && is_active_sidebar('main-sidebar')) : ?>
            <div class="<?php echo esc_attr($bifrost_sidebar_class) ?>">
                <div class="o-main-sidebar">
                    <?php get_sidebar() ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php 
do_action('bifrost_close_container');

get_template_part('templates/single/navigation');

endwhile; endif;

get_footer();