<?php
/**
 * Page
 */
get_header();

get_template_part('templates/hero/standard');

/**
 * Breadcrumb
 */
$bifrost_page_breadcrumb = bifrost_inherit_option('general_breadcrumb', 'breadcrumbs_page_visibility', '2');
bifrost_breadcrumbs($bifrost_page_breadcrumb, get_theme_mod('breadcrumbs_separator'));

/**
 * Page Title
 */
$bifrost_general_title = bifrost_inherit_option('general_title', 'general_title_page', '2');
$bifrost_main_wrapper_class = '';

if ($bifrost_general_title != '1') {
    $bifrost_main_wrapper_class = 'h-large-top-padding';
}

if ($bifrost_general_title == '1') : 
?>
    <div class="h-large-top-padding">
        <div class="container">
            <?php the_title('<h2 class="a-page-title">', '</h2>') ?>
        </div>
    </div>
<?php endif; ?>
<div class="l-main-wrapper__holder h-clearfix h-large-bottom-padding <?php echo esc_attr($bifrost_main_wrapper_class) ?>">
    <div class="container l-main-wrapper__inner">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content();
                wp_link_pages(array('before' => '<div class="o-pagination o-pagination--pages"><span class="o-pagination__title">' . esc_attr__( 'Pages:', 'bifrost' ) . '</span><div class="o-pagination--pages__numbers">', 'after' => '</div></div>', 'link_before' => '<span>', 'link_after' => '</span>', 'next_or_number' => 'next_and_number', 'separator' => '', 'nextpagelink' => esc_attr__('&raquo;', 'bifrost'), 'previouspagelink' => esc_attr__('&laquo;', 'bifrost'), 'pagelink' => '%'));
                paginate_links();
            }
        }
        ?>
    </div>
</div>
<?php
comments_template();

get_footer();