<?php
/**
 * Blog Post 
 */
if (bifrost_inherit_option('blog_post_navigation_visibility', 'blog_post_navigation_visibility', '2') == '2') {
    return;
}

// Navigation Category
if (bifrost_inherit_option('blog_post_navigation_category', 'blog_post_navigation_category', '2') == '1') {
    $bifrost_blog_post_navigation = true;
} else {
    $bifrost_blog_post_navigation = false;
}
?>
<div class="o-post-navigation">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-6 o-post-navigation__link prev">
                <?php previous_post_link('%link', '<div class="d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg><div class="o-post-navigation__text-icon"><h6 class="o-post-navigation__title">'. esc_attr__('Prev', 'bifrost') .'</h6><h6 class="o-post-navigation__subtitle">%title</h6></div></div>', $bifrost_blog_post_navigation, '', 'category'); ?>
            </div>
            <div class="col-6 o-post-navigation__link next h-align-right">
                <?php next_post_link('%link', '<div class="d-flex align-items-center"><div class="o-post-navigation__text-icon"><h6 class="o-post-navigation__title">'. esc_attr__('Next', 'bifrost') .'</h6><h6 class="o-post-navigation__subtitle">%title</h6></div><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></div>', $bifrost_blog_post_navigation, '', 'category'); ?>
            </div>
        </div>
    </div>
</div>