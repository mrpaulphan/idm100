<?php 
/**
 * Portfolio Meta Outside
 */
$bifrost_portfolio_meta_outside_class = 'o-neuron-hover';
$bifrost_hover_holder_body_class = ['o-neuron-hover-holder__body', 'justify-content-center', 'd-flex'];
$bifrost_hover_holder_body_inner_class = ['o-neuron-hover-holder__body__inner', 'd-flex'];

/**
 * Hover Visibility
 */
if ($neuron_posts_hover_visibility == 'show') {
    $bifrost_portfolio_meta_outside_class .= ' o-neuron-hover--icon';
} 

/**
 * Hover Animation
 */
if ($neuron_posts_hover_animation == 'translate' && $neuron_posts_hover_visibility != 'hide') {
   $bifrost_portfolio_meta_outside_class .= ' o-neuron-hover--translate'; 
} elseif ($neuron_posts_hover_animation == 'scale' && $neuron_posts_hover_visibility != 'hide') {
    $bifrost_portfolio_meta_outside_class .= ' o-neuron-hover--scale'; 
}

/**
 * Hover Active
 */
$bifrost_hover_holder_class = ['o-neuron-hover-holder'];
$neuron_posts_style_hover_active == 'yes' ? $bifrost_hover_holder_class[] = 'o-neuron-hover-holder--active' : '';

/**
 * Hover Alignment
 */
if ($neuron_posts_style_hover_icon_vertical_alignment) {
    $bifrost_hover_holder_body_class[] = 'align-items-'. $neuron_posts_style_hover_icon_vertical_alignment .'';
}

if ($neuron_posts_style_hover_icon_horizontal_alignment) {
    $bifrost_hover_holder_body_inner_class[] = 'justify-content-'. $neuron_posts_style_hover_icon_horizontal_alignment .'';
}
?>
<div class="<?php echo esc_attr($bifrost_portfolio_meta_outside_class) ?>">
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
                        <div class="h-calculated-image" style="padding-bottom: 100%;">
                            <img src="<?php echo esc_url(BIFROST_THEME_PLACEHOLDER) ?>" alt="<?php echo esc_attr__('Placeholder Image', 'bifrost') ?>"> 
                        </div>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
            <?php if ($neuron_posts_hover_visibility != 'hide') : ?>
                <div class="o-neuron-hover-holder__header__overlay"></div>
            <?php endif; ?>
        </div>
        <?php if ($neuron_posts_hover_visibility != 'hide') : ?>
            <div class="<?php echo esc_attr(implode(' ', $bifrost_hover_holder_body_class)) ?>">
                <div class="<?php echo esc_attr(implode(' ', $bifrost_hover_holder_body_inner_class)) ?>">
                    <div class="o-neuron-hover-holder__body-meta">
                        <?php if ($neuron_posts_style_hover_icon == 'yes') : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="<?php the_permalink() ?>"></a>
            </div>
            <?php endif; ?>
    </div>
</div>
<div class="o-portfolio-item__content">
    <?php if ($neuron_posts_meta_title == 'yes') : ?>
        <h4 class="o-portfolio-item__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
    <?php endif; ?>
    <?php if ($neuron_posts_meta_categories == 'yes') : ?>
        <?php get_template_part('templates/taxonomy/categories-portfolio') ?>
    <?php endif; ?>
</div>