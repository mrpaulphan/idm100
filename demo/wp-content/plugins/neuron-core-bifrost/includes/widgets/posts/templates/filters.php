<?php 
/**
 * Posts Filters
 */
if (!$settings['posts_filters_visibility'] || $settings['posts_filters_visibility'] == 'no' || $settings['posts_layout'] == 'carousel') {
    return;
}
$posts_filters_class = ['m-filters'];

/**
 * Query Filters
 */
if ($settings['posts_layout_type'] == 'metro') {
    switch ($settings['posts_type']) {
        default:
            $neuron_posts_normal_query = $settings['posts_filters_query_post'];
            break;
        case 'portfolio':
            $neuron_posts_normal_query = $settings['posts_filters_query_portfolio'];
            break;
        case 'product':
            $neuron_posts_normal_query = $settings['posts_filters_query_product'];
            break;
    }
}

/**
 * All Filter
 */
if ($settings['posts_filters_filter_all_string']) {
    $neuron_posts_filter_all = $settings['posts_filters_filter_all_string'];
} else {
    $neuron_posts_filter_all = __('Show All', 'neuron-core');
}

/**
 * Filters Alignment
 */
if ($settings['posts_style_filters_alignment'] == 'center') {
    $posts_filters_class[] = 'h-align-center';
} elseif ($settings['posts_style_filters_alignment'] == 'right') {
    $posts_filters_class[] = 'h-align-right';
}
?>
<div class="<?php echo esc_attr(implode(' ', $posts_filters_class)) ?>">
    <ul id="filters">
        <?php if ($settings['posts_filters_filter_all']) : ?>
            <li class="active" data-filter="*"><a><?php echo esc_attr($neuron_posts_filter_all) ?></a></li>
        <?php endif; ?>
        <?php 
            if ($neuron_posts_normal_query) {
                foreach ($neuron_posts_normal_query as $term) {
                    $term_info = get_term_by('slug', $term, $neuron_posts_taxonomy);
                    echo '<li data-filter=".'. esc_attr($term_info->slug) .'"><a>'. esc_attr($term_info->name) .'</a></li>';
                }
            } else {
                foreach (get_terms($neuron_posts_taxonomy) as $term) {
                    echo '<li data-filter=".'. esc_attr($term->slug) .'"><a>'. esc_attr($term->name) .'</a></li>';
                }
            }
        ?>
    </ul>
</div>