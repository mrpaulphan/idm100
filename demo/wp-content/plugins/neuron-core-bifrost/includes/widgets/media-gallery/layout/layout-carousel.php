<?php 
/**
 * Posts Layout Carousel
 */

/**
 * Animation & WOW Delay
 */
$neuron_posts_animation = $settings['media_gallery_animation'];
$neuron_posts_item_class = 'm-media-gallery__item item';

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
<div class="owl-carousel owl-theme" id="<?php echo md5($this->get_id()); ?>">
    <?php foreach ($neuron_gallery_media_query as $media) : ?>
        <?php 
        /**
         * WOW Animation
         */
        $neuron_data_wow_seconds == 12 ? $neuron_data_wow_seconds = 0 : '';
        $neuron_wow_holder = "data-wow-delay=". $neuron_data_wow_seconds/10 ."s";

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
        <div class="<?php echo esc_attr($neuron_posts_item_class . ' ' . $neuron_posts_item_badge_class) ?>" <?php echo esc_attr($neuron_data_wow_delay === true && $neuron_data_wow_seconds ? $neuron_wow_holder : '') ?>>
            <?php
                if ($settings['media_gallery_layout_model'] == 'meta-inside') {
                    include(__DIR__ . '/../type/meta-inside.php');
                } else {
                    include(__DIR__ . '/../type/meta-outside.php');
                }
            ?>
        </div>
    <?php $neuron_data_wow_seconds = $neuron_data_wow_seconds + 2; endforeach; wp_reset_postdata(); ?>
</div>
<script type="text/javascript">
    jQuery(function ($) {
        var owl = $('#<?php echo md5($this->get_id()); ?>');

        owl.owlCarousel({
            items: <?php echo esc_attr($settings['media_gallery_carousel_items_mobile'] ? $settings['media_gallery_carousel_items_mobile'] : '1') ?>,
            margin: <?php echo esc_attr($settings['media_gallery_carousel_margin_mobile'] ? $settings['media_gallery_carousel_margin_mobile'] : '10') ?>,
            autoHeight: <?php echo esc_attr($settings['media_gallery_carousel_height'] == '1' ? 'true' : 'false') ?>,
            loop: <?php echo esc_attr($settings['media_gallery_carousel_loop'] === 'yes' ? 'true' : 'false') ?>,
            mouseDrag: <?php echo esc_attr($settings['media_gallery_carousel_mouse_drag'] === 'yes' ? 'true' : 'false') ?>,
            touchDrag: <?php echo esc_attr($settings['media_gallery_carousel_touch_drag'] === 'yes' ? 'true' : 'false') ?>,
            stagePadding: <?php echo esc_attr($settings['media_gallery_carousel_stage_padding_mobile'] ? $settings['media_gallery_carousel_stage_padding_mobile'] : '0') ?>,
            startPosition: <?php echo esc_attr($settings['media_gallery_carousel_start_position'] ? $settings['media_gallery_carousel_start_position'] : '0') ?>,
            nav: <?php echo esc_attr($settings['media_gallery_carousel_navigation'] === 'yes' ? 'true' : 'false') ?>,
            navText: [
                '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            ],
            dots: <?php echo esc_attr($settings['media_gallery_carousel_dots'] === 'yes' ? 'true' : 'false') ?>,
            autoplay: <?php echo esc_attr($settings['media_gallery_carousel_autoplay'] === 'yes' ? 'true' : 'false') ?>,
            autoplayTimeout: <?php echo esc_attr($settings['media_gallery_carousel_autoplay_timeout'] ? $settings['media_gallery_carousel_autoplay_timeout'] * 1000 : '2000') ?>,
            autoplayHoverPause: <?php echo esc_attr($settings['media_gallery_carousel_pause'] === 'yes' ? 'true' : 'false') ?>,
            smartSpeed: <?php echo esc_attr($settings['media_gallery_carousel_smart_speed'] ? $settings['media_gallery_carousel_smart_speed'] * 100 : '450') ?>,
            responsive:{
                768:{
                    items: <?php echo esc_attr($settings['media_gallery_carousel_items_tablet'] ? $settings['media_gallery_carousel_items_tablet'] : '2') ?>,
                    margin: <?php echo esc_attr($settings['media_gallery_carousel_margin_tablet'] ? $settings['media_gallery_carousel_margin_tablet'] : '5') ?>,
                    stagePadding: <?php echo esc_attr($settings['media_gallery_carousel_stage_padding_tablet'] ? $settings['media_gallery_carousel_stage_padding_tablet'] : '0') ?>
                },
                992:{
                    items: <?php echo esc_attr($settings['media_gallery_carousel_items'] ? $settings['media_gallery_carousel_items'] : '0') ?>,
                    margin: <?php echo esc_attr($settings['media_gallery_carousel_margin'] ? $settings['media_gallery_carousel_margin'] : '0') ?>,
                    stagePadding: <?php echo esc_attr($settings['media_gallery_carousel_stage_padding'] ? $settings['media_gallery_carousel_stage_padding'] : '0') ?>
                }
            }
        });
    });
</script>