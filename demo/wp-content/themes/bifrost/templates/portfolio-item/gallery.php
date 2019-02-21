<?php
/**
 * Portfolio Item Gallery
 */

/**
 * Columns
 * 
 * Change gallery items columns
 * via customizer or individually.
 */
switch (bifrost_inherit_option('portfolio_item_gallery_columns', 'portfolio_item_gallery_columns', '1')) {
    default:
        $bifrost_gallery_item_column = 'col-12';
        break;
    case '2':
        $bifrost_gallery_item_column = 'col-sm-6';
        break;
    case '3':
        $bifrost_gallery_item_column = 'col-sm-6 col-md-4';
        break;
    case '4':
        $bifrost_gallery_item_column = 'col-sm-6 col-md-3';
        break;
}

/**
 * Animation & WOW Delay
 */
$bifrost_portfolio_item_gallery_animation = bifrost_inherit_option('portfolio_item_gallery_animation', 'portfolio_item_gallery_animation', '2');
$bifrost_portfolio_item_holder_class = 'p-portfolio-gallery__item';

if ($bifrost_portfolio_item_gallery_animation == '2' || $bifrost_portfolio_item_gallery_animation == '4') {
    $bifrost_portfolio_item_holder_class .= ' h-fadeInNeuron wow';    
} elseif ($bifrost_portfolio_item_gallery_animation == '3' || $bifrost_portfolio_item_gallery_animation == '5') {
    $bifrost_portfolio_item_holder_class .= ' h-fadeInUpNeuron wow';
}

$bifrost_data_wow_delay = false;
$bifrost_data_wow_seconds = 0;

if ($bifrost_portfolio_item_gallery_animation == '4' || $bifrost_portfolio_item_gallery_animation == '5') {
    $bifrost_data_wow_delay = true;
}

if (have_rows('portfolio_item_gallery')) :
?>
<div class="p-portfolio-gallery">
    <div class="row masonry">
        <?php while (have_rows('portfolio_item_gallery')) : the_row(); ?>
            <?php 
            /**
             * WOW Animation
             */
            $bifrost_data_wow_seconds == 12 ? $bifrost_data_wow_seconds = 0 : '';
            $bifrost_wow_holder = "data-wow-delay=". $bifrost_data_wow_seconds/10 ."s";
            $bifrost_portfolio_item_resizer = get_theme_mod('portfolio_item_thumbnail_resizer') == 'yes' ? get_theme_mod('portfolio_item_thumbnail_sizes') : 'full';
            ?>
            <div class="selector <?php echo esc_attr($bifrost_gallery_item_column) ?>">
                <div class="h-lightbox <?php echo esc_attr($bifrost_portfolio_item_holder_class) ?>" <?php echo esc_attr($bifrost_data_wow_delay === true && $bifrost_data_wow_seconds ? $bifrost_wow_holder : '') ?>>
                    <?php if (get_row_layout() == 'portfolio_item_gallery_image') : ?>
                        <a class="h-calculated-image h-lightbox-link" data-mfp-src="<?php echo esc_url(get_sub_field('portfolio_item_gallery_image_obj')['url']) ?>" style="<?php echo esc_attr(bifrost_image_calculation(get_sub_field('portfolio_item_gallery_image_obj')['id'], $bifrost_portfolio_item_resizer)) ?>">
                            <?php echo wp_get_attachment_image(get_sub_field('portfolio_item_gallery_image_obj')['id'], $bifrost_portfolio_item_resizer) ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php $bifrost_data_wow_seconds = $bifrost_data_wow_seconds + 2; endwhile; ?>
    </div>
</div>
<?php
endif;