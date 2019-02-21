<?php 
/**
 * Standard Hero
 * 
 * It is called on each post/page,
 * the options can be set from customizer
 * or in each post/page individually.
 */
$bifrost_hero_class = ['o-hero__header__image'];
$bifrost_hero_content_class = ['o-hero__content', 'align-self-center'];
$bifrost_hero_style = $bifrost_hero_height = $bifrost_hero_title_style = [];

/**
 * Visibility
 */
if (bifrost_inherit_option('hero_visibility', 'hero_visibility', '1') == '2') {
    return;
}

/**
 * Container
 */
if (bifrost_inherit_option('hero_container', 'hero_container', '1') == '2') {
    $bifrost_hero_content_class[] = 'h-wide-container';
}

/**
 * Alignment
 */
switch (bifrost_inherit_option('hero_alignment', 'hero_alignment', '1')) {
    default:
        $bifrost_hero_content_class[] = 'h-align-left';
        break;
    case '2':
        $bifrost_hero_content_class[] = 'h-align-center';
        break;
    case '3':
        $bifrost_hero_content_class[] = 'h-align-right';
        break;
}

/**
 * Height
 */
if (get_field('hero_height', get_queried_object()) == '2' && get_field('hero_custom_height', get_queried_object())) {
    $bifrost_hero_custom_height = get_field('hero_custom_height', get_queried_object());
} else {
    $bifrost_hero_custom_height = get_theme_mod('hero_height', '25vh');
}

if ($bifrost_hero_custom_height) {
    $bifrost_hero_height[] = 'height: '. $bifrost_hero_custom_height .'';
}

/**
 * Image
 */
$bifrost_hero_image = bifrost_inherit_option('hero_image', 'hero_image', '5');
$bifrost_hero_custom_image = (get_field('hero_image', get_queried_object()) == '4') ? get_field('hero_custom_image', get_queried_object()) : get_theme_mod('hero_custom_image');

if ($bifrost_hero_image == '1' && has_post_thumbnail()) {
    $bifrost_hero_style[] = 'background-image: url('. get_the_post_thumbnail_url(get_the_ID(), 'full') .')';
} elseif ($bifrost_hero_image == '2') {
    $bifrost_hero_style[] = 'background-image: url('. BIFROST_THEME_URI .'/assets/images/default-hero.jpg)';
} elseif ($bifrost_hero_image == '3' && $bifrost_hero_custom_image) {
    $bifrost_hero_style[] = 'background-image: url('. wp_get_attachment_url($bifrost_hero_custom_image) .')';
} else {
    $bifrost_hero_class[] = 'o-hero__header--no-image';
}

/**
 * Image Repeat
 */
switch (bifrost_inherit_option('hero_image_repeat', 'hero_image_repeat', '1')) {
    case '1':
        $bifrost_hero_style[] = 'background-repeat: no-repeat';
        break;
    case '3':
        $bifrost_hero_style[] = 'background-repeat: repeat-x';
        break;
    case '4':
        $bifrost_hero_style[] = 'background-repeat: repeat-y';
        break;
}

/**
 * Image Attachment
 */
$hero_image_attachment = bifrost_inherit_option('hero_image_attachment', 'hero_image_attachment', '1');

if ($hero_image_attachment == '2') {
    $bifrost_hero_style[] = 'background-attachment: fixed';
} elseif ($hero_image_attachment == '3') {
    $bifrost_hero_style[] = 'background-attachment: local';    
}

/**
 * Image Position
 */
switch(bifrost_inherit_option('hero_image_position', 'hero_image_position', '5')) {
    case '1':
        $bifrost_hero_style[] = 'background-position: left top';
        break;
    case '2':
        $bifrost_hero_style[] = 'background-position: left center';
        break;
    case '3':
        $bifrost_hero_style[] = 'background-position: left bottom';
        break;
    case '4':
        $bifrost_hero_style[] = 'background-position: center top';
        break;
    case '5':
        $bifrost_hero_style[] = 'background-position: center center';
        break;
    case '6':
        $bifrost_hero_style[] = 'background-position: center bottom';
        break;
    case '7':
        $bifrost_hero_style[] = 'background-position: right top';
        break;
    case '8':
        $bifrost_hero_style[] = 'background-position: right center';
        break;
    case '9':
        $bifrost_hero_style[] = 'background-position: right bottom';
        break;
}

/**
 * Image Size
 */
switch(bifrost_inherit_option('hero_image_size', 'hero_image_size', '2')) {
    case '2':
        $bifrost_hero_style[] = '-webkit-background-size: cover; -moz-background-size: cover; background-size: cover;';
        break;
    case '3':
        $bifrost_hero_style[] = '-webkit-background-size: contain; -moz-background-size: contain; background-size: contain;';
        break;
    case '4':
        $bifrost_hero_style[] = '-webkit-background-size: initial; -moz-background-size: initial; background-size: initial;';
        break;
}

/**
 * Overlay
 */
$bifrost_hero_image_overlay = bifrost_inherit_option('hero_image_overlay', 'hero_image_overlay', '2');
$bifrost_hero_image_overlay_opacity = (get_field('hero_image_overlay', get_queried_object()) == '2') ? get_field('hero_image_overlay_opacity', get_queried_object()) : get_theme_mod('hero_image_overlay_opacity');
$bifrost_hero_image_overlay_color = (get_field('hero_image_overlay', get_queried_object()) == '2') ? get_field('hero_image_overlay_color', get_queried_object()) : get_theme_mod('hero_image_overlay_color');
$bifrost_hero_image_overlay_style = [];

if ($bifrost_hero_image_overlay == '1') {
    if ($bifrost_hero_image_overlay_opacity) {
        $bifrost_hero_image_overlay_style[] = 'opacity: '. $bifrost_hero_image_overlay_opacity .'';
    }   
    if ($bifrost_hero_image_overlay_color) {
        $bifrost_hero_image_overlay_style[] = 'background-color: '. $bifrost_hero_image_overlay_color .'';       
    }     
}

/**
 * Title
 */
$bifrost_hero_title = bifrost_inherit_option('hero_title', 'hero_title', '1');
$bifrost_hero_custom_title = (get_field('hero_title', get_queried_object()) == '3') ? get_field('hero_custom_title', get_queried_object()) : get_theme_mod('hero_custom_title');
$bifrost_hero_title_markup = '';
$bifrost_hero_title_class = 'o-hero__content__title';

if ($bifrost_hero_title == '1') {
    $bifrost_hero_title_markup = get_the_title();
} elseif ($bifrost_hero_title == '2' && $bifrost_hero_custom_title) {
    $bifrost_hero_title_markup = $bifrost_hero_custom_title;
} 

/**
 * Modify Title in Home
 */
if (is_home()) {
    $bifrost_hero_title_markup = get_bloginfo('name');
}

/**
 * Title Animation
 */
if (bifrost_inherit_option('hero_title_animation', 'hero_title_animation', '2') == '2') {
    $bifrost_hero_title_class .= ' h-fadeInNeuron wow';    
} elseif (bifrost_inherit_option('hero_title_animation', 'hero_title_animation', '2') == '3') {
    $bifrost_hero_title_class .= ' h-fadeInUpNeuron wow';    
}

/**
 * Title Color
 */
$bifrost_hero_title_color = get_field('hero_title_color', get_queried_object()) == '1' ? get_theme_mod('hero_title_color', '#232931') : get_field('hero_title_color_custom');
$bifrost_hero_title_color && $bifrost_hero_title_color != '#232931' ? $bifrost_hero_title_style[] = 'color: '. $bifrost_hero_title_color .'' : '';

/**
 * Breadcrumb
 */
$bifrost_hero_breadcrumb = bifrost_inherit_option('hero_breadcrumb', 'hero_breadcrumb', '1');

/**
 * Output the Hero
 */
echo sprintf(
    '<div class="o-hero d-flex" %s>
        <div class="o-hero__header">
            <div class="%s" %s></div>
            %s
        </div>
        <div class="%s">
            <div class="container">%s %s</div>
        </div>
    </div>',
    $bifrost_hero_custom_height ? 'style="'. implode(';', $bifrost_hero_height) .'"' : '',
    implode(' ', $bifrost_hero_class),
    $bifrost_hero_style ? 'style="'. implode(';', $bifrost_hero_style) .'"' : '',
    $bifrost_hero_image_overlay == '1' ? '<div class="o-hero__header__overlay" style="'. implode(';', $bifrost_hero_image_overlay_style) .'"></div>' : '',
    implode(' ', $bifrost_hero_content_class),
    $bifrost_hero_title_markup ? '<div '. ($bifrost_hero_title_style ? 'style="'. implode(';', $bifrost_hero_title_style) .'"' : '') . ($bifrost_hero_title_class ? ' class="'. $bifrost_hero_title_class .'"' : '') .'>'. $bifrost_hero_title_markup .'</div>' : '',
    bifrost_breadcrumbs($bifrost_hero_breadcrumb, get_theme_mod('breadcrumbs_separator'), true)
);