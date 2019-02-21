<?php 
/**
 * Posts Pagination
 */
if (!$settings['posts_pagination_visibility'] || $settings['posts_layout'] == 'carousel') {
    return;
}

$neuron_show_more_text = esc_html__('Show More', 'neuron-core');
$neuron_show_more_button_holder_class = ['load-more-posts-holder'];
$neuron_show_more_button_class = ['a-button a-button--regular a-button--theme-color', 'load-more-posts'];

/**
 * Hover Animation
 */
if ($settings['posts_style_pagination_hover_animation']) {
    $neuron_show_more_button_class[] = 'elementor-animation-' . $settings['posts_style_pagination_hover_animation'];
}

/**
 * Alignment
 */
if ($settings['posts_style_pagination_alignment'] == 'center') {
    $neuron_show_more_button_holder_class[] = 'h-align-center';
} elseif ($settings['posts_style_pagination_alignment'] == 'right') {
    $neuron_show_more_button_holder_class[] = 'h-align-right';
}
?>
<?php
if ($settings['posts_pagination_style'] == 'normal') {
    neuron_pagination($query);
} elseif ($query->max_num_pages > $paged) { ?>
    <div class="<?php echo esc_attr(implode(' ', $neuron_show_more_button_holder_class)) ?>">
        <button type="button" class="<?php echo esc_attr(implode(' ', $neuron_show_more_button_class)) ?>" data-text="<?php echo esc_attr($neuron_show_more_text) ?>"><?php echo esc_attr($neuron_show_more_text) ?></button>
    </div>
<?php }
