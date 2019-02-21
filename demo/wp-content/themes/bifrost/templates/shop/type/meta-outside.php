<?php
/**
 * Meta Outside
 * 
 * the template will called incase
 * the user has selected meta outside
 * as shop type.
 */
global $product;

$bifrost_shop_meta_outside_class = 'o-neuron-hover l-woocommerce-wrapper__product';
$bifrost_hover_holder_body_class = ['o-neuron-hover-holder__body', 'd-flex'];

/**
 * Hover Visibility
 */
if ($neuron_posts_hover_visibility == 'show') {
    $bifrost_shop_meta_outside_class .= ' o-neuron-hover--icon';
} 

/**
 * Hover Animation
 */
if ($neuron_posts_hover_animation == 'translate' && $neuron_posts_hover_visibility != 'hide') {
   $bifrost_shop_meta_outside_class .= ' o-neuron-hover--translate'; 
} elseif ($neuron_posts_hover_animation == 'scale' && $neuron_posts_hover_visibility != 'hide') {
    $bifrost_shop_meta_outside_class .= ' o-neuron-hover--scale'; 
}

/**
 * Hover Active
 */
$bifrost_hover_holder_class = ['o-neuron-hover-holder'];
$neuron_posts_style_hover_active == 'yes' ? $bifrost_hover_holder_class[] = 'o-neuron-hover-holder--active' : '';

/**
 * Hover Alignment
 */
$bifrost_hover_holder_body_class[] = $neuron_posts_style_hover_icon_vertical_alignment ? 'align-items-'. $neuron_posts_style_hover_icon_vertical_alignment .'' : 'align-items-center';
$bifrost_hover_holder_body_class[] = $neuron_posts_style_hover_icon_horizontal_alignment ? 'justify-content-'. $neuron_posts_style_hover_icon_horizontal_alignment .'' : 'justify-content-center';
?>
<div class="<?php echo esc_attr($bifrost_shop_meta_outside_class) ?>">
    <div class="<?php echo esc_attr(implode(' ', $bifrost_hover_holder_class)) ?>">
        <div class="o-neuron-hover-holder__header">
            <?php if ($neuron_posts_meta_thumbnail == 'yes') : ?>
                <a href="<?php the_permalink() ?>" class="o-neuron-hover-holder__header__media">
                    <?php if ($neuron_posts_carousel_height == 'full') : ?>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="h-full-height-image h-background-image-style" style="background-image: url(<?php the_post_thumbnail_url() ?>)"></div>
                        <?php else : ?>
                            <div class="h-full-height-image h-background-image-style" style="background-image: url(<?php echo esc_url(BIFROST_THEME_PLACEHOLDER) ?>)"></div>
                        <?php endif; ?>
                    <?php elseif (has_post_thumbnail()) : ?>
                        <div class="h-calculated-image" style="<?php echo esc_attr(bifrost_thumbnail_calculation($neuron_posts_thumbnail_resizer)) ?>">
                            <?php 
                            /**
                             * Thumbnail Sizes
                             * 
                             * It inherits the option via set query var.
                             */
                            if ($neuron_posts_thumbnail_resizer) {
                                the_post_thumbnail($neuron_posts_thumbnail_resizer);
                            } else {
                                the_post_thumbnail();
                            }
                            ?>
                        </div>
                    <?php else : ?>
                        <div class="h-calculated-image" style="padding-bottom: 100%">
                            <?php echo wc_placeholder_img('full'); ?>
                        </div>
                    <?php endif;?>
                </a>
            <?php endif; ?>
            <?php
            if (!$product->is_in_stock()) {
                echo '<div class="a-woo-badge a-woo-badge--red-color">' . esc_attr__('Out of Stock', 'bifrost') . '</div>';
            } elseif ($product->is_on_sale()) {
                echo '<div class="a-woo-badge a-woo-badge--theme-color">' . esc_attr__('Sale!', 'bifrost') . '</div>';
            }
            ?>
            <?php if ($neuron_posts_hover_visibility != 'hide') : ?>
                <div class="o-neuron-hover-holder__header__overlay"></div>
            <?php endif; ?>
        </div>
        <?php if ($neuron_posts_hover_visibility != 'hide') : ?>
            <div class="<?php echo esc_attr(implode(' ', $bifrost_hover_holder_body_class)) ?>">
                <?php if ($neuron_posts_style_hover_icon == 'yes') : ?>
                    <div class="o-neuron-hover-holder__button-holder">
                        <?php wc_get_template_part('woocommerce/loop/add-to-cart') ?>
                    </div>
                <?php endif; ?>
                <a href="<?php the_permalink() ?>"></a>
            </div>
         <?php endif; ?>
    </div>
    <div class="o-neuron-hover__body">
        <div class="o-neuron-hover__body-meta">
            <?php if ($neuron_posts_meta_title == 'yes') : ?>
                <h4 class="o-neuron-hover__body-meta__title"><a href="<?php the_permalink() ?>"><?php echo esc_attr($product->get_title()); ?></a></h4>
            <?php endif; ?>
            <?php if ($neuron_posts_meta_price == 'yes') : ?>
                <h6 class="o-neuron-hover__body-meta__price"><?php wc_get_template_part('woocommerce/loop/price') ?></h6>
            <?php endif; ?>
        </div>
    </div>
</div>