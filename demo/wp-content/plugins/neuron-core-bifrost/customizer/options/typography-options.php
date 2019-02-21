<?php 
/**
 * Typography Options
 */

// Create Panel and Sections
Kirki::add_panel('typography_options', array(
	'title'       => esc_attr__('Typography', 'neuron-core'),
    'priority'    => 9
));
Kirki::add_section('typography_general', array(
    'title'          => esc_attr__('General', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_headings', array(
    'title'          => esc_attr__('Headings', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_paragraphs', array(
    'title'          => esc_attr__('Paragraphs', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_main_menu', array(
    'title'          => esc_attr__('Main Menu', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_mobile_menu', array(
    'title'          => esc_attr__('Mobile Menu', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_top_menu', array(
    'title'          => esc_attr__('Top Menu', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_portfolio', array(
    'title'          => esc_attr__('Portfolio', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_portfolio_item', array(
    'title'          => esc_attr__('Portfolio Item', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_blog', array(
    'title'          => esc_attr__('Blog', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_blog_single', array(
    'title'          => esc_attr__('Blog Post', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_shop', array(
    'title'          => esc_attr__('Shop', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_product', array(
    'title'          => esc_attr__('Product', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_widgets', array(
    'title'          => esc_attr__('Widgets', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_breadcrumbs', array(
    'title'          => esc_attr__('Breadcrumbs', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_hero', array(
    'title'          => esc_attr__('Hero', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_error_404', array(
    'title'          => esc_attr__('Error 404', 'neuron-core'),
	'panel'			=> 'typography_options'
));
Kirki::add_section('typography_forms', array(
    'title'          => esc_attr__('Forms', 'neuron-core'),
	'panel'			=> 'typography_options'
));

/**
 * Font Family
 */
$neuron_family_selectors = [
	'primary' => 'h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6, b, strong, ul.menu.m-header-default-menu li.menu-item > a, .o-hero .o-hero__content .o-hero__content__title, input[type=submit], button, .button, .a-button, .o-breadcrumb .o-breadcrumb__list .o-breadcrumb__list__item, .o-comments .o-comments__area .o-comment .o-comment__details .o-comment__author-meta .comment-reply-link, .o-mini-cart .o-mini-cart__holder .o-mini-cart__holder__cart-list .o-mini-cart__holder__cart-list__item .o-mini-cart__holder__cart-list__item__meta .title, .o-mini-cart .o-mini-cart__total-holder .o-mini-cart__total-holder__total .price .amount, .tagcloud a, .woocommerce .o-product .m-product-summary .product_meta > span, .woocommerce .o-product .woocommerce-tabs ul.tabs li a, .woocommerce .o-product .woocommerce-tabs .woocommerce-Tabs-panel.woocommerce-Tabs-panel--additional_information table tr th, .a-woo-badge, .woocommerce .o-product .m-product-summary table.variations tr td label, .t-404 .o-hero .o-hero__content .o-hero__content__title h1',
	'secondary' => 'body, input, textarea, select, code, .woocommerce .o-product .m-product-summary .product_meta > span span, .woocommerce .o-product .m-product-summary .product_meta > span a'
];

/**
 * Default 
 */
$neuron_attributes_selectors = [
	'h1' => 'h1, .h1',
	'h2' => 'h2, .h2, .m-site-search .m-site-search__content .m-site-search__content__inner .m-site-search__form input[type=search], .woocommerce .o-product .m-product-summary .price, .o-hero .o-hero__content .o-hero__content__title',
	'h3' => 'h3, .h3, .a-logo.a-logo--text a, .woocommerce-account .woocommerce #customer_login h2',
	'h4' => 'h4, .h4, .woocommerce .wc-bacs-bank-details-account-name, .woocommerce .o-product .woocommerce-tabs .woocommerce-Tabs-panel h2',
	'h5' => 'h5, .h5, .woocommerce .wc-bacs-bank-details-heading, .woocommerce .o-product .m-product-summary table.group_table tr td.woocommerce-grouped-product-list-item__price .amount, .woocommerce .o-product .woocommerce-tabs .woocommerce-Tabs-panel .woocommerce-Reviews #comments .commentlist .comment .comment_container .comment-text .meta .woocommerce-review__author, .o-hero .o-hero__content .o-hero__content__subtitle, .l-portfolio-wrapper .l-portfolio-wrapper__items-holder.l-portfolio-wrapper__items-holder--meta-outside .o-portfolio-item .o-portfolio-item__content .a-seperator ul li a, .woocommerce .cart-collaterals .cart_totals h2, .woocommerce-checkout .woocommerce-billing-fields h2, .woocommerce-checkout .woocommerce-shipping-fields .ship-to-different-address, .woocommerce-checkout #order_review_heading, .woocommerce-account .addresses .title h3, .woocommerce .woocommerce-order-details .woocommerce-order-details__title, .woocommerce .woocommerce-customer-details .woocommerce-columns .woocommerce-column__title, .woocommerce .woocommerce-order-downloads .woocommerce-order-downloads__title, .woocommerce table tfoot tr:last-child th, .woocommerce table tfoot tr:last-child td',
	'h6' => 'h6, .h6, legend, .m-progress-bar .m-progress-bar__label, .woocommerce .o-product .m-product-summary .product_meta > span, .woocommerce .o-product .woocommerce-tabs .woocommerce-Tabs-panel.woocommerce-Tabs-panel--additional_information table tr th, .l-portfolio-wrapper .l-portfolio-wrapper__items-holder.l-portfolio-wrapper__items-holder--meta-outside .o-portfolio-item .o-portfolio-item__content .a-seperator ul li a, .woocommerce ul.order_details li, .woocommerce ul.order_details li strong, .o-mini-cart__total-holder .o-mini-cart__total-holder__total .price .amount, .a-woo-badge, .o-mini-cart__holder .o-mini-cart__holder__cart-list .o-mini-cart__holder__cart-list__item .o-mini-cart__holder__cart-list__item__meta .title a, .o-mini-cart .o-mini-cart__holder .o-mini-cart__holder__cart-list .o-mini-cart__holder__cart-list__item .o-mini-cart__holder__cart-list__item__meta .quantity, .o-comments .o-comments__area .o-comment .o-comment__details .o-comment__date, .o-comments .o-comments__area .o-comment .o-comment__details .o-comment__author-meta .comment-reply-link',
	'paragraphs' => 'body, .wp-caption p.wp-caption-text, .select2 .selection .select2-selection .select2-selection__rendered, .m-progress-bar .m-progress-bar__label span, table td, table th, .woocommerce .o-product .m-product-summary .product_meta > span a, .l-primary-footer .l-primary-footer__copyright .l-primary-footer__copyright__space .l-primary-footer__copyright__text > *',
	'main-menu' => '.l-primary-header.l-primary-header--default ul.menu.m-header-default-menu li.menu-item > a',
	'sub-menu-parent' => 'ul.menu.m-header-default-menu li.menu-item.menu-item-has-children > ul.sub-menu li.menu-item.menu-item-has-children > a',
	'sub-menu-children' => 'ul.menu.m-header-default-menu li.menu-item.menu-item-has-children > ul.sub-menu li.menu-item a',
	'mobile-main-menu' => '.l-primary-header.l-primary-header--responsive .l-primary-header--responsive__nav nav ul.menu li.menu-item a',
	'mobile-sub-menu' => '.l-primary-header.l-primary-header--responsive .l-primary-header--responsive__nav nav ul.menu li.menu-item-has-children .sub-menu li.menu-item a',
	'top-menu' => '.m-primary-top-header .m-primary-top-header__holder .m-primary-top-header__nav .m-header-default-menu > li a',
	'top-menu-content' => '.m-primary-top-header .m-primary-top-header__holder .m-primary-top-header__content p',
	'portfolio-filters' => '.m-filters ul li a',
	'portfolio-title' => '.l-portfolio-wrapper .l-portfolio-wrapper__items-holder.l-portfolio-wrapper__items-holder--meta-outside .o-portfolio-item .o-portfolio-item__content .o-portfolio-item__title',
	'portfolio-category' => '.l-portfolio-wrapper .l-portfolio-wrapper__items-holder.l-portfolio-wrapper__items-holder--meta-outside .o-portfolio-item .o-portfolio-item__content .a-seperator ul li a',
	'portfolio-item-title' => '.p-portfolio-single .p-portfolio-single__content .p-portfolio-single__content__meta .meta-title',
	'portfolio-item-subtitle' => '.p-portfolio-single .p-portfolio-single__content .p-portfolio-single__content__meta .meta-subtitle',
	'portfolio-item-tab-title' => '.p-portfolio-single .p-portfolio-single__content__tabs ul li .tabs-title',
	'portfolio-item-tab-content' => '.p-portfolio-single .p-portfolio-single__content__tabs ul li p',
	'portfolio-item-tab-link' => '.p-portfolio-single .p-portfolio-single__content__tabs ul li a',
	'blog-title' => '.o-blog-post .o-blog-post__title',
	'blog-meta' => '.o-blog-post .o-blog-post__meta .o-blog-post__time span, .o-blog-post .o-blog-post__author .author-name a, .o-blog-post .o-blog-post__meta > *',
	'blog-single-title' => '.p-blog-single .p-blog-single__wrapper .o-blog-post .o-blog-post__title',
	'blog-single-meta' => '.p-blog-single .p-blog-single__wrapper .o-blog-post .o-blog-post__meta > *, .p-blog-single .p-blog-single__wrapper .o-blog-post .o-blog-post__meta .o-blog-post__time span, .p-blog-single .p-blog-single__wrapper .o-blog-post .o-blog-post__author .author-name a',
	'shop-title' => '.l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder. .o-neuron-hover .o-neuron-hover-holder .o-neuron-hover-holder__body .o-neuron-hover-holder__body-meta .o-neuron-hover-holder__body-meta__title',
	'shop-price' => '.l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder .o-neuron-hover .o-neuron-hover-holder .o-neuron-hover-holder__body .o-neuron-hover-holder__body-meta .o-neuron-hover-holder__body-meta__price',
	'product-title' => '.woocommerce .o-product .m-product-summary .product_title',
	'product-price' => '.woocommerce .o-product .m-product-summary .price',
	'product-meta' => '.woocommerce .o-product .m-product-summary .product_meta > span, .woocommerce .o-product .m-product-summary .product_meta > span span',
	'product-tabs-menu-title' => '.woocommerce .o-product .woocommerce-tabs ul.tabs li a',
	'product-tabs-panel-title' => '.woocommerce .o-product .woocommerce-tabs .woocommerce-Tabs-panel h2',
	'product-tabs-attribute-title' => '.woocommerce .o-product .woocommerce-tabs .woocommerce-Tabs-panel.woocommerce-Tabs-panel--additional_information table tr th',
	'product-tabs-attribute-content' => '.woocommerce .o-product .woocommerce-tabs .woocommerce-Tabs-panel.woocommerce-Tabs-panel--additional_information table tr td',
	'widgets-title' => '.widget .widgettitle-wrapper .widgettitle',
	'widgets-list' => '.widget ul li, .widget ul li a, .widget.widget.woocommerce .product_list_widget li a, .o-mini-cart__holder .o-mini-cart__holder__cart-list .o-mini-cart__holder__cart-list__item .o-mini-cart__holder__cart-list__item__meta .quantity, .widget.widget.woocommerce .product_list_widget li span',
	'widgets-tag-cloud' => '.tagcloud a',
	'breadcrumbs-title' => '.o-breadcrumb .o-breadcrumb__page',
	'breadcrumbs-navigation' => '.o-breadcrumb .o-breadcrumb__list .o-breadcrumb__list__item',
	'hero-title' => '.o-hero .o-hero__content .o-hero__content__title',
	'hero-subtitle' => '.o-hero .o-hero__content .o-hero__content__subtitle',
	'error-404-title' => '.t-404 .o-hero .o-hero__content .o-hero__content__title h1',
	'error-404-content' => '.t-404 .o-hero .o-hero__content .o-hero__content__subtitle h5',
	'forms-label' => 'label',
	'forms-input' => 'input, textarea, select, input[type=submit]',
	'forms-button' => '.a-button.a-button--regular, button, .button, .woocommerce .button, .woocommerce .o-main-sidebar input[type=submit], .woocommerce .o-main-sidebar button, .woocommerce .o-main-sidebar .button, .woocommerce a.button, .o-mini-cart__total-holder .o-mini-cart__total-holder__buttons .button',
	'forms-search' => '.m-site-search .m-site-search__content .m-site-search__content__inner .m-site-search__form input[type=search]'
];

/**
 * Font Family
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_primary',
	'label'       => esc_attr__('Primary', 'neuron-core'),
	'description' => __('Change the primary font family in theme.', 'neuron-core'),
	'section'     => 'typography_general',
	'default'     => array(
		'font-family'    => '',
	),
	'output' => array(
		array('element' => $neuron_family_selectors['primary'])
	)
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_secondary',
	'label'       => esc_attr__('Secondary', 'neuron-core'),
	'description' => __('Change the secondary font family in theme.', 'neuron-core'),
	'section'     => 'typography_general',
	'default'     => array(
		'font-family'    => '',
	),
	'output' => array(
		array('element' => $neuron_family_selectors['secondary'])
	)
));

/**
 * Headings
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_heading_one',
	'label'       => esc_attr__('Heading 1', 'neuron-core'),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['h1'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_heading_two',
	'label'       => esc_attr__('Heading 2', 'neuron-core'),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['h2'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_heading_three',
	'label'       => esc_attr__('Heading 3', 'neuron-core'),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['h3'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_heading_four',
	'label'       => esc_attr__('Heading 4', 'neuron-core'),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['h4'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_heading_five',
	'label'       => esc_attr__('Heading 5', 'neuron-core'),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['h5'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_heading_six',
	'label'       => esc_attr__('Heading 6', 'neuron-core'),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['h6'],
		),
	),
));

/**
 * Paragraphs
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_paragraphs',
	'label'       => esc_attr__('Paragraphs', 'neuron-core'),
	'section'     => 'typography_paragraphs',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['paragraphs'],
		),
	),
));

/**
 * Main Menu
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_main_menu',
	'label'       => esc_attr__('Main Menu', 'neuron-core'),
	'section'     => 'typography_main_menu',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['main-menu'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_sub_menu_parent',
	'label'       => esc_attr__('Sub Menu Parent', 'neuron-core'),
	'section'     => 'typography_main_menu',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['sub-menu-parent'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_sub_menu_children',
	'label'       => esc_attr__('Sub Menu Children', 'neuron-core'),
	'section'     => 'typography_main_menu',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['sub-menu-children'],
		),
	),
));

/**
 * Mobile Menu
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_mobile_main_menu',
	'label'       => esc_attr__('Mobile Main Menu', 'neuron-core'),
	'section'     => 'typography_mobile_menu',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['mobile-main-menu'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_mobile_sub_menu',
	'label'       => esc_attr__('Mobile Sub Menu', 'neuron-core'),
	'section'     => 'typography_mobile_menu',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['mobile-sub-menu'],
		),
	),
));

/**
 * Top Menu
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_top_menu',
	'label'       => esc_attr__('Top Menu', 'neuron-core'),
	'section'     => 'typography_top_menu',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['top-menu'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_top_menu_content',
	'label'       => esc_attr__('Top Menu Content', 'neuron-core'),
	'section'     => 'typography_top_menu',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['top-menu-content'],
		),
	),
));

/**
 * Portfolio
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_portfolio_filters',
	'label'       => esc_attr__('Filters', 'neuron-core'),
	'section'     => 'typography_portfolio',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['portfolio-filters'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_portfolio_title',
	'label'       => esc_attr__('Title', 'neuron-core'),
	'section'     => 'typography_portfolio',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['portfolio-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_portfolio_category',
	'label'       => esc_attr__('Category', 'neuron-core'),
	'section'     => 'typography_portfolio',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['portfolio-category'],
		),
	),
));

/**
 * Portfolio Item
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_portfolio_item_title',
	'label'       => esc_attr__('Title', 'neuron-core'),
	'section'     => 'typography_portfolio_item',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['portfolio-item-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_portfolio_item_subtitle',
	'label'       => esc_attr__('Subtitle', 'neuron-core'),
	'section'     => 'typography_portfolio_item',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['portfolio-item-subtitle'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'typography_portfolio_item_tabs_message',
	'section'     => 'typography_portfolio_item',
	'default'     => '<h1>' . esc_html__('Tabs', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_portfolio_item_tab_title',
	'label'       => esc_attr__('Tab Title', 'neuron-core'),
	'section'     => 'typography_portfolio_item',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['portfolio-item-tab-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_portfolio_item_tab_content',
	'label'       => esc_attr__('Tab Content', 'neuron-core'),
	'section'     => 'typography_portfolio_item',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['portfolio-item-tab-content'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_portfolio_item_tab_link',
	'label'       => esc_attr__('Tab Link', 'neuron-core'),
	'section'     => 'typography_portfolio_item',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['portfolio-item-tab-link'],
		),
	),
));

/**
 * Blog
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_blog_title',
	'label'       => esc_attr__('Title', 'neuron-core'),
	'section'     => 'typography_blog',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['blog-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_blog_meta',
	'label'       => esc_attr__('Meta', 'neuron-core'),
	'section'     => 'typography_blog',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['blog-meta'],
		),
	),
));

/**
 * Blog Single
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_blog_single_title',
	'label'       => esc_attr__('Title', 'neuron-core'),
	'section'     => 'typography_blog_single',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['blog-single-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_blog_single_meta',
	'label'       => esc_attr__('Meta', 'neuron-core'),
	'section'     => 'typography_blog_single',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['blog-single-meta'],
		),
	),
));

/**
 * Shop
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_shop_title',
	'label'       => esc_attr__('Title', 'neuron-core'),
	'section'     => 'typography_shop',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['shop-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_shop_price',
	'label'       => esc_attr__('Price', 'neuron-core'),
	'section'     => 'typography_shop',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['shop-price'],
		),
	),
));

/**
 * Product
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_product_title',
	'label'       => esc_attr__('Title', 'neuron-core'),
	'section'     => 'typography_product',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['product-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_product_price',
	'label'       => esc_attr__('Price', 'neuron-core'),
	'section'     => 'typography_product',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['product-price'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_product_meta',
	'label'       => esc_attr__('Meta', 'neuron-core'),
	'section'     => 'typography_product',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['product-meta'],
		),
	),
));

// Product Tabs
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'typography_product_tabs_message',
	'section'     => 'typography_product',
	'default'     => '<h1>' . esc_html__('Product Tabs', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_product_tabs_menu_title',
	'label'       => esc_attr__('Menu Title', 'neuron-core'),
	'section'     => 'typography_product',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['product-tabs-menu-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_product_tabs_panel_title',
	'label'       => esc_attr__('Panel Title', 'neuron-core'),
	'section'     => 'typography_product',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['product-tabs-panel-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_product_tabs_attribute_title',
	'label'       => esc_attr__('Attribute Title', 'neuron-core'),
	'section'     => 'typography_product',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['product-tabs-attribute-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_product_tabs_attribute_content',
	'label'       => esc_attr__('Attribute Content', 'neuron-core'),
	'section'     => 'typography_product',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['product-tabs-attribute-content'],
		),
	),
));

/**
 * Widgets
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_widgets_title',
	'label'       => esc_attr__('Title', 'neuron-core'),
	'section'     => 'typography_widgets',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['widgets-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_widgets_list',
	'label'       => esc_attr__('List', 'neuron-core'),
	'section'     => 'typography_widgets',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['widgets-list'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_widgets_tag_cloud',
	'label'       => esc_attr__('Tag Cloud', 'neuron-core'),
	'section'     => 'typography_widgets',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['widgets-tag-cloud'],
			'suffix' => '!important'
		),
	),
));

/**
 * Breadcrumbs
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_breadcrumbs_title',
	'label'       => esc_attr__('Title', 'neuron-core'),
	'section'     => 'typography_breadcrumbs',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['breadcrumbs-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_breadcrumbs_navigation',
	'label'       => esc_attr__('Navigation', 'neuron-core'),
	'section'     => 'typography_breadcrumbs',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['breadcrumbs-navigation'],
		),
	),
));

/**
 * Hero
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_hero_title',
	'label'       => esc_attr__('Title', 'neuron-core'),
	'section'     => 'typography_hero',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['hero-title'],
		),
	),
));

/**
 * Error 404
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_error_404_title',
	'label'       => esc_attr__('Title', 'neuron-core'),
	'section'     => 'typography_error_404',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['error-404-title'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_error_404_content',
	'label'       => esc_attr__('Content', 'neuron-core'),
	'section'     => 'typography_error_404',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['error-404-content'],
		),
	),
));

/**
 * Forms
 */
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_forms_label',
	'label'       => esc_attr__('Label', 'neuron-core'),
	'section'     => 'typography_forms',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['forms-label'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_forms_input',
	'label'       => esc_attr__('Input', 'neuron-core'),
	'section'     => 'typography_forms',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['forms-input'],
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_forms_button',
	'label'       => esc_attr__('Button', 'neuron-core'),
	'section'     => 'typography_forms',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['forms-button'],
			'suffix' => '!important'
		),
	),
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_forms_search',
	'label'       => esc_attr__('Site Search', 'neuron-core'),
	'section'     => 'typography_forms',
	'default'     => array(
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => $neuron_attributes_selectors['forms-search'],
		),
	),
));