<?php 
/**
 * Default Logo
 */
$bifrost_logo_display = $bifrost_light_logo_display = $bifrost_logo_style = [];

/**
 * Logos
 */
$bifrost_dark_logo = get_theme_mod('header_dark_logo');
$bifrost_light_logo = get_theme_mod('header_light_logo');
$bifrost_text_logo = get_theme_mod('header_logo_text');
$bifrost_custom_dark_logo = get_field('header_dark_logo');
$bifrost_custom_light_logo = get_field('header_light_logo');

/**
 * Logo Attributes
 */
$bifrost_logo_width = get_theme_mod('header_logo_width');
$bifrost_logo_height = get_theme_mod('header_logo_height');
$bifrost_logo_custom_width = get_field('header_logo_width');
$bifrost_logo_custom_height = get_field('header_logo_height');
$bifrost_logo_text_size = get_theme_mod('header_logo_text_size');

/**
 * Logo Classes & Extensions
 */
$bifrost_logo_class = 'a-logo a-logo--image';
$bifrost_dark_logo_img_class = 'a-logo--image__inner a-logo--image__inner--dark';
$bifrost_light_logo_img_class = 'a-logo--image__inner a-logo--image__inner--light';
$bifrost_logo_ext = 'png';

/**
 * Dark Logo
*/
if ($bifrost_custom_dark_logo) {
    $bifrost_logo_display = $bifrost_custom_dark_logo;  
} elseif ($bifrost_custom_light_logo) {
    $bifrost_logo_display = $bifrost_custom_light_logo;  
} elseif ($bifrost_dark_logo) {
    $bifrost_logo_display = $bifrost_dark_logo;  
} elseif ($bifrost_light_logo) {
    $bifrost_logo_display = $bifrost_light_logo;  
} else {
    $bifrost_logo_class = 'a-logo a-logo--text';
}

/**
 * Light Logo
*/
if ($bifrost_custom_light_logo) {
    $bifrost_light_logo_display = $bifrost_custom_light_logo;
} elseif ($bifrost_light_logo) {
    $bifrost_light_logo_display = $bifrost_light_logo;
}

/**
 * Logo Attributes
*/
if ($bifrost_logo_display) {
    if ($bifrost_logo_custom_width) {
        $bifrost_logo_style[] = 'width: '. $bifrost_logo_custom_width .'px';
    } elseif ($bifrost_logo_width) {
        $bifrost_logo_style[] = 'width: '. $bifrost_logo_width .'px';
    } elseif (!strpos(wp_get_attachment_url($bifrost_logo_display), '.svg')) {
        $bifrost_logo_style[] = 'width: '. wp_get_attachment_metadata($bifrost_logo_display)['width'] .'px';
    }
    
    if ($bifrost_logo_custom_height) {
        $bifrost_logo_style[] = 'height: '. $bifrost_logo_custom_height .'px';
    } elseif ($bifrost_logo_height) {
        $bifrost_logo_style[] = 'height: '. $bifrost_logo_height .'px';
    } elseif (!strpos(wp_get_attachment_url($bifrost_logo_display), '.svg')) {
        $bifrost_logo_style[] = 'height: '. wp_get_attachment_metadata($bifrost_logo_display)['height'] .'px';
    }
}

/**
 * Logo Text Size
*/
if ($bifrost_logo_text_size && !$bifrost_logo_display && !$bifrost_light_logo_display) {
    $bifrost_logo_style[] = 'font-size: '. $bifrost_logo_text_size .'px';
}

/**
 * Logo Type
*/
if ($bifrost_logo_display && wp_check_filetype(wp_get_attachment_url($bifrost_logo_display))['ext'] == 'svg') {
    $bifrost_dark_logo_img_class .= ' style-svg';
} 

if ($bifrost_light_logo_display && wp_check_filetype(wp_get_attachment_url($bifrost_light_logo_display))['ext'] == 'svg') {
    $bifrost_light_logo_img_class .= ' style-svg';
}

?>
<div class="<?php echo esc_attr($bifrost_logo_class) ?>">
    <a href="<?php echo esc_url(home_url('/')); ?>" style="<?php echo esc_attr(implode(';', $bifrost_logo_style)) ?>">
        <?php
        // Dark Logo
        if ($bifrost_logo_display) {
            echo wp_get_attachment_image($bifrost_logo_display, 'full', '', array('class' => $bifrost_dark_logo_img_class));
        } elseif ($bifrost_text_logo) {
            echo esc_attr($bifrost_text_logo);
        } else {
            echo esc_attr(bloginfo('name'));
        }

        // Light Logo
        if ($bifrost_light_logo_display) {
            echo wp_get_attachment_image($bifrost_light_logo_display, 'full', '', array('class' => $bifrost_light_logo_img_class));
        } 
        ?>
    </a>
</div>