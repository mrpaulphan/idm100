<?php 
/**
 * Attachment Page
 */
get_header();

/**
 * Breadcrumb
 */
$bifrost_page_breadcrumb = bifrost_inherit_option('general_archive_breadcrumb', 'breadcrumbs_archives_visibility', '2');
bifrost_breadcrumbs($bifrost_page_breadcrumb, get_theme_mod('breadcrumbs_separator'));

if (have_posts()) :
?>
    <div class="l-blog-wrapper h-large-top-padding h-large-bottom-padding">
        <div class="container">
            <div class="l-blog-wrapper__posts-holder">
                <?php while (have_posts()) : the_post() ?>
                    <div <?php post_class() ?> id="id-<?php the_ID() ?>" data-id="<?php the_ID() ?>"> 
                        <div class="o-blog-post">
                            <a href="<?php echo wp_get_attachment_url(get_the_ID()) ?>">
                                <?php echo wp_get_attachment_image(get_the_ID(), 'full') ?>
                            </a>
                            <a href="<?php echo wp_get_attachment_url(get_the_ID()) ?>">
                                <?php echo wp_get_attachment_url(get_the_ID()) ?>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php 
endif; wp_reset_postdata();

get_footer();
