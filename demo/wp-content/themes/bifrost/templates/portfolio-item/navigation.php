<?php
/**
 * Portfolio Item Navigation
 */

/**
 * Visibility
 */
if (bifrost_inherit_option('portfolio_item_navigation_visibility', 'portfolio_item_navigation_visibility', '1') == '2') {
    return;
}

/**
 * Category
 */
if (bifrost_inherit_option('portfolio_item_navigation_category', 'portfolio_item_navigation_category', '2') == '1') {
    $bifrost_portfolio_item_category_bool = true;
} else {
    $bifrost_portfolio_item_category_bool = false;
}
?>
<div class="o-post-navigation">
    <div class="container">
        <div class="row">
            <div class="col-6 o-post-navigation__link prev">
                <?php previous_post_link('%link', '<div class="d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg><div class="o-post-navigation__text-icon"><h6 class="o-post-navigation__title">'. esc_attr__('Prev', 'bifrost') .'</h6><h6 class="o-post-navigation__subtitle">%title</h6></div></div>', $bifrost_portfolio_item_category_bool, '', 'portfolio_category'); ?>
            </div>
            <div class="col-6 o-post-navigation__link next h-align-right">
                <?php next_post_link('%link', '<div class="d-flex align-items-center"><div class="o-post-navigation__text-icon"><h6 class="o-post-navigation__title">'. esc_attr__('Next', 'bifrost') .'</h6><h6 class="o-post-navigation__subtitle">%title</h6></div><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></div>', $bifrost_portfolio_item_category_bool, '', 'portfolio_category'); ?>
            </div>
        </div>
    </div>
</div>