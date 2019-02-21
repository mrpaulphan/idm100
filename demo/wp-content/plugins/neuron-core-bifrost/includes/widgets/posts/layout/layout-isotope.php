<?php 
/**
 * Posts Layout Isotope
 */
$neuron_masonry_class = ['row', 'masonry'];

/**
 * Layout Type Model
 */
$settings['posts_layout_type'] == 'fitrows' ? $neuron_masonry_class[] = 'fitRows' : '';

/**
 * Posts Columns
 * 
 * It changes the columns via the selector
 * item class, option can be inherited too.
 */
$neuron_selector_class = 'selector';

switch ($settings['posts_columns']) {
    case '1-column':
        $neuron_selector_class .= ' col-12';
        break;
    case '2-columns':
        $neuron_selector_class .= ' col-md-6';
        break;
    default:
        $neuron_selector_class .= ' col-md-6 col-lg-4';
        break;
    case '4-columns':
        $neuron_selector_class .= ' col-md-6 col-lg-3';
        break;
    case '5-columns':
        $neuron_selector_class .= ' col-md-6 a-col-5';
        break;
    case '6-columns':
        $neuron_selector_class .= ' col-md-6 col-lg-2';
        break;
}

/**
 * Animation & WOW Delay
 */
$neuron_posts_animation = $settings['posts_animation'];

if ($neuron_posts_animation == 'fade-in' || $neuron_posts_animation == 'fade-in-delay') {
    $neuron_posts_item_class .= ' h-fadeInNeuron wow';    
} elseif ($neuron_posts_animation == 'fade-in-up' || $neuron_posts_animation == 'fade-in-up-delay') {
    $neuron_posts_item_class .= ' h-fadeInUpNeuron wow';
}

$neuron_data_wow_delay = false;
$neuron_data_wow_seconds = 0;

if ($neuron_posts_animation == 'fade-in-delay' || $neuron_posts_animation == 'fade-in-up-delay') {
    $neuron_data_wow_delay = true;
}

/**
 * Meta
 */
set_query_var('neuron_posts_meta_thumbnail', $settings['posts_meta_thumbnail']);
set_query_var('neuron_posts_meta_title', $settings['posts_meta_title']);
set_query_var('neuron_posts_meta_categories', $settings['posts_meta_categories']);
set_query_var('neuron_posts_meta_tags', $settings['posts_meta_tags']);
set_query_var('neuron_posts_meta_excerpt', $settings['posts_meta_excerpt']);
set_query_var('neuron_posts_meta_author', $settings['posts_meta_author']);
set_query_var('neuron_posts_meta_price', $settings['posts_meta_price']);
set_query_var('neuron_posts_meta_results_count', $settings['posts_meta_results_count']);
set_query_var('neuron_posts_meta_catalog_ordering', $settings['posts_meta_catalog_ordering']);
set_query_var('neuron_posts_meta_ordering_default', $settings['posts_meta_ordering_default']);
?>
<div class="<?php echo esc_attr(implode(' ', $neuron_masonry_class)) ?>" data-masonry-id="<?php echo md5($this->get_id()) ?>">
    <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php 
        /**
         * WOW Animation
         */
        $neuron_data_wow_seconds == 12 ? $neuron_data_wow_seconds = 0 : '';
        $neuron_wow_holder = "data-wow-delay=". $neuron_data_wow_seconds/10 ."s";

        /**
         * Metro Column
         */
        if ($neuron_posts_metro_query && $settings['posts_layout_type'] == 'metro') {
            $neuron_selector_class = 'selector';
            foreach ($neuron_posts_metro_query as $item) {
                if (get_the_ID() == $item['post_id']) {
                    switch ($item['post_column']) {
                        case '1-column':
                            $neuron_selector_class .= ' col-md-6 col-lg-1';
                            break;
                        case '2-column':
                            $neuron_selector_class .= ' col-md-6 col-lg-2';
                            break;
                        default:
                            $neuron_selector_class .= ' col-md-6 col-lg-3';
                            break;
                        case '4-column':
                            $neuron_selector_class .= ' col-md-6 col-lg-4';
                            break;
                        case '5-column':
                            $neuron_selector_class .= ' col-md-6 col-lg-5';
                            break;
                        case '6-column':
                            $neuron_selector_class .= ' col-md-6';
                            break;
                        case '7-column':
                            $neuron_selector_class .= ' col-md-7';
                            break;
                        case '8-column':
                            $neuron_selector_class .= ' col-md-8';
                            break;
                        case '9-column':
                            $neuron_selector_class .= ' col-md-9';
                            break;
                        case '10-column':
                            $neuron_selector_class .= ' col-md-10';
                            break;
                        case '11-column':
                            $neuron_selector_class .= ' col-md-11';
                            break;
                        case '12-column':
                            $neuron_selector_class .= ' col-12';
                            break;
                    }
                } 
            }
        }

        /**
         * Terms
         * 
         * Get the terms that are 
         * attached to the post.
         */
        $terms = get_the_terms(get_the_ID(), $neuron_posts_taxonomy);
        $terms_array_imp = '';
        if ($terms) {
            $terms_array = array();
            foreach ($terms as $cat) {
                $terms_array[] = $cat->slug;
            }
            $terms_array_imp = implode(' ', $terms_array);
        }
        ?>
        <div <?php post_class($neuron_selector_class . ' ' . $terms_array_imp) ?> data-id="<?php the_ID() ?>">
            <div class="o-post <?php echo esc_attr($neuron_posts_item_class) ?>" <?php echo esc_attr($neuron_data_wow_delay === true && $neuron_data_wow_seconds ? $neuron_wow_holder : '') ?>>
                <?php
                    if ($settings['posts_layout_model'] == 'meta-inside') {
                        get_template_part('templates/'. $neuron_posts_name .'/type/meta-inside');
                    } else {
                        get_template_part('templates/'. $neuron_posts_name .'/type/meta-outside');
                    }
                ?>
            </div>
        </div>
    <?php $neuron_data_wow_seconds = $neuron_data_wow_seconds + 2; endwhile; ?>
</div>

<?php include(__DIR__ . '/../templates/pagination.php') ?>

<?php if (\Elementor\Plugin::$instance->editor->is_edit_mode() && $settings['posts_layout_type'] != 'fitrows') : ?>
<script>
    (function($) {
        var $masonry = $('.masonry[data-masonry-id=<?php echo md5($this->get_id()); ?>]');
        if ($masonry.length) {
            $masonry.isotope({
                layoutMode: 'packery',
                itemSelector: '.selector'
            });
        }
        window.dispatchEvent(new Event('resize'));
    })(jQuery);
</script>
<?php endif; ?>