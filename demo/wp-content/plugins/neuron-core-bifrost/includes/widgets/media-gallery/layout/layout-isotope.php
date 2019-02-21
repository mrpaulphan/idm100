<?php 
/**
 * Posts Layout Isotope
 */
$neuron_masonry_class = ['row', 'masonry'];

/**
 * Layout Type Model
 */
$settings['media_gallery_layout_type'] == 'fitrows' ? $neuron_masonry_class[] = 'fitRows' : '';

/**
 * Posts Columns
 * 
 * It changes the columns via the selector
 * item class, option can be inherited too.
 */
$neuron_selector_class = 'selector';

switch ($settings['media_gallery_columns']) {
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
$neuron_posts_animation = $settings['media_gallery_animation'];
$neuron_posts_item_class = 'm-media-gallery__item';

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
?>
<div class="<?php echo esc_attr(implode(' ', $neuron_masonry_class)) ?>" data-masonry-id="<?php echo md5($this->get_id()) ?>">
    <?php foreach ($neuron_gallery_media_query as $media) : ?>
        <?php 
        /**
         * WOW Animation
         */
        $neuron_data_wow_seconds == 12 ? $neuron_data_wow_seconds = 0 : '';
        $neuron_wow_holder = "data-wow-delay=". $neuron_data_wow_seconds/10 ."s";

        /**
         * Metro Column
         */
        if ($settings['media_gallery_layout_type'] == 'metro') {
            $neuron_selector_class = 'selector';
            if (isset($media['query_column'])) {
                switch ($media['query_column']) {
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
        
        /**
         * Terms
         * 
         * Get the terms that are 
         * attached to the post.
         */
        $terms_array_imp = '';
        if ($media['query_category']) {
            $terms_array = array();
            foreach ($media['query_category'] as $cat) {
                $terms_array[] = $cat;
            }
            $terms_array_imp = implode(' ', $terms_array);
        } 

        /**
         * Badge
         * 
         * Add the badge to the item class.
         */
        $neuron_posts_item_badge_class = '';
        if ($media['query_badge'] && $media['query_badge'] != 'none') {
            $neuron_posts_item_badge_class = 'm-media-gallery__item-badge--' . $media['query_badge'];
        }
        ?>
        <div class="<?php echo esc_attr($neuron_selector_class . ' ' .  $terms_array_imp) ?>" data-id="<?php the_ID() ?>">
            <div class="<?php echo esc_attr($neuron_posts_item_class . ' ' . $neuron_posts_item_badge_class) ?>" <?php echo esc_attr($neuron_data_wow_delay === true && $neuron_data_wow_seconds ? $neuron_wow_holder : '') ?>>
                <?php
                    if ($settings['media_gallery_layout_model'] == 'meta-inside') {
                        include(__DIR__ . '/../type/meta-inside.php');
                    } else {
                        include(__DIR__ . '/../type/meta-outside.php');
                    }
                ?>
            </div>
        </div>
    <?php $neuron_data_wow_seconds = $neuron_data_wow_seconds + 2; endforeach; ?>
</div>

<?php if (\Elementor\Plugin::$instance->editor->is_edit_mode() && $settings['media_gallery_layout_type'] != 'fitrows') : ?>
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