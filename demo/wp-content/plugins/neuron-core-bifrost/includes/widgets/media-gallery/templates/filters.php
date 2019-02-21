<?php 
/**
 * Media Gallery Filters
 */
if (!$settings['media_gallery_filters_visibility'] || $settings['media_gallery_filters_visibility'] == 'no' || $settings['media_gallery_layout'] == 'carousel') {
    return;
}
$media_gallery_filters_class = ['m-filters'];

/**
 * All Filter
 */
if ($settings['media_gallery_filters_filter_all_string']) {
    $neuron_media_gallery_filter_all = $settings['media_gallery_filters_filter_all_string'];
} else {
    $neuron_media_gallery_filter_all = __('Show All', 'neuron-core');
}

/**
 * Filters Alignment
 */
if ($settings['media_gallery_style_filters_alignment'] == 'center') {
    $media_gallery_filters_class[] = 'h-align-center';
} elseif ($settings['media_gallery_style_filters_alignment'] == 'right') {
    $media_gallery_filters_class[] = 'h-align-right';
}
?>
<div class="<?php echo esc_attr(implode(' ', $media_gallery_filters_class)) ?>">
    <ul id="filters">
        <?php if ($settings['media_gallery_filters_filter_all']) : ?>
            <li class="active" data-filter="*"><a><?php echo esc_attr($neuron_media_gallery_filter_all) ?></a></li>
        <?php endif; ?>
        <?php 
            if ($settings['media_gallery_filters']) {
                foreach ($settings['media_gallery_filters'] as $term) {
                    $term_info = get_term_by('slug', $term, 'media_category');
                    echo '<li data-filter=".'. esc_attr($term_info->slug) .'"><a>'. esc_attr($term_info->name) .'</a></li>';
                }
            } else {
                foreach (get_terms('media_category') as $term) {
                    echo '<li data-filter=".'. esc_attr($term->slug) .'"><a>'. esc_attr($term->name) .'</a></li>';
                }
            }
        ?>
    </ul>
</div>