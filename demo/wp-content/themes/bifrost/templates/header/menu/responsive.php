<?php 
/**
 * Responsive Menu
 */
?>
 <div class="container">
    <div class="d-flex align-items-center">
        <?php get_template_part('templates/logo/default') ?>
        <div class="ml-auto d-flex align-items-center">
            <div class="l-primary-header__icons d-flex align-items-center">
                <?php get_template_part('templates/header/search/icon') ?>
                <?php get_template_part('templates/header/shopping-cart') ?>
                <?php get_template_part('templates/header/sliding-bar/icon') ?>
            </div>
            <a href="#" class="l-primary-header--responsive__icon" id="l-primary-header--responsive__icon">
                <svg style="enable-background:new 0 0 139 139;" version="1.1" viewBox="0 0 139 139" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><line class="st0" x1="26.5" x2="112.5" y1="46.3" y2="46.3"/><line class="st0" id="XMLID_9_" x1="26.5" x2="112.5" y1="92.7" y2="92.7"/><line class="st0" id="XMLID_8_" x1="26.5" x2="112.5" y1="69.5" y2="69.5"/></svg>
            </a>
        </div>
    </div>
    <div class="l-primary-header--responsive__nav">
        <?php
        // Main Menu
        $args = array(
            'theme_location' => 'main-menu',
            'container' => 'nav'
        );

        if (has_nav_menu('main-menu')) {
            wp_nav_menu($args);
        }
        ?>
    </div>
</div>