<?php
/**
 * To Top
 * 
 * Show the to top button
 * at the bottom of footer.
 */
$bifrost_to_top_class = ['a-to-top'];

if (get_theme_mod('to_top_visibility', '2') == '2') {
    return;
}

/**
 * Skin
 */
if (get_theme_mod('to_top_skin', '1') == '1') {
    $bifrost_to_top_class[] = 'a-to-top--dark';
} else {
    $bifrost_to_top_class[] = 'a-to-top--white';
}

/**
 * animation
 */
if (get_theme_mod('to_top_animation', '1') == '1') {
    $bifrost_to_top_class[] = 'a-to-top--translate';
} else {
    $bifrost_to_top_class[] = 'a-to-top--scale';
}
?>
<a href="#" class="<?php echo esc_attr(implode(' ', $bifrost_to_top_class)) ?>">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
</a>