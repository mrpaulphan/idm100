<?php 
/**
 * Primary Menu
 */
?>
<div class="container">
    <div class="d-flex align-items-stretch l-primary-header__holder">
        <?php get_template_part('templates/logo/default') ?>
        <div class="ml-auto d-flex align-items-stretch">
            <div class="d-flex align-items-stretch">
                <div class="l-primary-header--default__nav d-flex align-items-stretch">
                    <?php
                        // Main Menu
                        $args = array(
                            'theme_location' => 'main-menu',
                            'container' => 'nav',
                            'container_class' => 'd-flex m-nav-menu--horizontal',
                            'menu_class' => 'menu m-header-default-menu d-flex align-items-stretch'
                        );

                        if (has_nav_menu('main-menu')) {
                            wp_nav_menu($args);
                        }
                    ?>
                </div>
                <?php if (bifrost_inherit_option('sliding_bar_visibility', 'sliding_bar_visibility', '2') == '1' || bifrost_inherit_option('shopping_cart_visibility', 'shopping_cart_visibility', '2') == '1' || bifrost_inherit_option('header_search_visibility', 'header_search_visibility', '2') == '1') : ?>
                    <div class="l-primary-header__icons d-flex align-items-stretch">
                        <?php get_template_part('templates/header/search/icon') ?>
                        <?php get_template_part('templates/header/shopping-cart') ?>
                        <?php get_template_part('templates/header/sliding-bar/icon') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>