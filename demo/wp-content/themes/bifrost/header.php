<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="robots" content="noindex, nofollow" />
        <?php 
        /**
         * Queried Object
         * 
         * In case it is shop page get_queried_object won't 
         * work, it needs to be changed to a custom WooCommerce
         * function wc_get_page_id.
         */
        $bifrost_queried_object = class_exists('WooCommerce') && is_shop() ? wc_get_page_id('shop') : get_queried_object();

        /**
         * Redirect
         */
        if (get_field('general_redirect', $bifrost_queried_object) && get_field('general_redirect_url', $bifrost_queried_object)) {
            wp_redirect(get_field('general_redirect_url', $bifrost_queried_object));
            exit;
        }

        wp_head();
        ?>
    </head>
    <body <?php body_class() ?>>
        <div class="l-theme-wrapper">
            <?php 
             /**
             * Header Visibility
             */
            if (bifrost_inherit_option('header_visibility', 'header_visibility', '1') == '2' && !is_search()) {
                add_filter('bifrost_display_header', '__return_false');
            }

            /**
             * Type
             */
            $bifrost_header_type = bifrost_inherit_option('header_type', 'header_type', '1');
            $bifrost_header_template = '';
            if (get_field('header_type', get_queried_object()) == '1') {
                $bifrost_header_template = get_theme_mod('header_template', '');
            } elseif (get_field('header_type', get_queried_object()) == '3' && get_field('header_template')) {
                $bifrost_header_template = get_field('header_template');
            } else {
                $bifrost_header_template = get_theme_mod('header_template', '');
            }

            /**
             * Sticky Type
             */
            $bifrost_header_sticky_template = '';
            if (get_field('header_transparency') == '1' && $bifrost_header_type == '2') {
                $bifrost_header_sticky_template = get_theme_mod('header_sticky_template');
            } elseif (get_field('header_sticky_template') && $bifrost_header_type == '2') {
                $bifrost_header_sticky_template = get_field('header_sticky_template');
            }

            /*
            * Header Options
            * 
            * Variables are attached via a custom 
            * function which inherits the page values
            * incase the options is set at Inherit
            */
            $bifrost_header_skin = bifrost_inherit_option('header_skin', 'header_skin', '1');
            $bifrost_header_position = bifrost_inherit_option('header_position', 'header_position', '1');
            $bifrost_header_transparency = bifrost_inherit_option('header_transparency', 'header_transparency', '1');
            $bifrost_header_autohide = bifrost_inherit_option('header_autohide', 'header_autohide', '1');
            $bifrost_header_container = bifrost_inherit_option('header_container', 'header_container', '1');

            $header_wrapper_class = ['l-primary-header--default-wrapper'];
            $header_class = ['l-primary-header--default'];
            $header_sticky_template_class = ['l-template-header', 'l-template-header--sticky'];
            $header_template_class = ['l-template-header'];

            // Skin
            $bifrost_header_skin == '2' ? $header_class[] = 'l-primary-header--light-skin' : '';

            // Position
            $bifrost_header_position == '2' ? $header_wrapper_class[] = 'l-primary-header--absolute' : '';
            $bifrost_header_position == '2' ? $header_template_class[] = 'l-template-header--absolute' : '';

            // Transparency
            if ($bifrost_header_transparency == '2') {
                $header_wrapper_class[] = 'l-primary-header--sticky';

                // Sticky Enabled & Skin Light 
                $bifrost_header_skin == '2' ? $header_wrapper_class[] = 'l-primary-header--sticky--skin' : '';

                // Sticky Enabled & Position Static
                $bifrost_header_position == '1' ? $header_wrapper_class[] = 'l-primary-header--default-height' : '';

                // Sticky Enabled & Autohide On
                $bifrost_header_autohide == '1' ? $header_wrapper_class[] = 'l-primary-header--autohide' : '';
                $bifrost_header_autohide == '1' ? $header_sticky_template_class[] = 'l-template-header--sticky-autohide' : '';
            } 

            // Container
            $bifrost_header_container == '2' || is_search() ? $header_class[] = 'l-primary-header--wide-container' : '';

            /*
            * Modify Classes for Responsive
            * 
            * Replaces classes from default to responsive
            * in wrapper and in header class
            */
            $header_responsive_wrapper_class = $header_responsive_class = [];

            $header_wrapper_class ? $header_responsive_wrapper_class = str_replace('default', 'responsive', $header_wrapper_class) : '';
            $header_class ? $header_responsive_class = str_replace('default', 'responsive', $header_class) : '';


            // Display Header Filter
            if (apply_filters('bifrost_display_header', true) && ($bifrost_header_type != '2')) :

            /**
             * Top Header
             */
            get_template_part('templates/header/top-header');
            ?>
            
            <div class="<?php echo esc_attr(implode(' ', $header_responsive_wrapper_class)) ?>">
                <header class="l-primary-header <?php echo esc_attr(implode(' ', $header_responsive_class)) ?>">
                    <?php get_template_part('templates/header/menu/responsive') ?>
                </header>
            </div>

            <div class="<?php echo esc_attr(implode(' ', $header_wrapper_class)) ?>">
                <header class="l-primary-header <?php echo esc_attr(implode(' ', $header_class)) ?>">
                    <?php get_template_part('templates/header/menu/primary') ?>
                </header>
            </div>

            <?php get_template_part('templates/header/search/base') ?>

            <?php 
            // End of Display Header Filter
            endif;

            // Elementor
            if ($bifrost_header_type == '2' && $bifrost_header_template && apply_filters('bifrost_display_header_template', true)) :
            ?>
                <div class="l-template-header-wrapper">
                    <?php if ($bifrost_header_transparency == '2' && $bifrost_header_sticky_template) : ?>
                        <header class="<?php echo esc_attr(implode(' ', $header_sticky_template_class)) ?>">
                            <?php echo bifrost_get_custom_template($bifrost_header_sticky_template) ?>
                        </header>
                    <?php endif; ?>
                    
                    <header class="<?php echo esc_attr(implode(' ', $header_template_class)) ?>">
                        <?php echo bifrost_get_custom_template($bifrost_header_template) ?>
                    </header>
                </div>
            <?php endif; ?>

            <div class="l-main-wrapper">