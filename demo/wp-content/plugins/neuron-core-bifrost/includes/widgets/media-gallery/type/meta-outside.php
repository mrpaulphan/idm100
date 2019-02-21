<?php 
/**
 * Media Gallery - Meta Outside
 * 
 * This template is called in elementor 
 * element when meta outside type is selected.
 */
$neuron_media_hover_class = ['o-neuron-hover', 'o-neuron-hover--meta-outside', 'o-neuron-hover--icon'];
$neuron_hover_holder_class = ['o-neuron-hover-holder'];
$neuron_hover_holder_body_class= ['o-neuron-hover-holder__body', 'd-flex'];

/**
 * Lightbox
 */
if ($settings['media_gallery_lightbox'] == 'yes' && !\Elementor\Plugin::$instance->editor->is_edit_mode()) {
    $neuron_hover_holder_class[] = 'h-lightbox';
}

/**
 * Hover Transition
 */
if ($settings['media_gallery_hover_animation']) {
    $neuron_media_hover_class[] = 'o-neuron-hover--'. $settings['media_gallery_hover_animation'] .'';
}

/**
 * Hover Active
 */
if ($settings['media_gallery_style_hover_active'] == 'yes') {
    $neuron_hover_holder_class[] = 'o-neuron-hover-holder--active';
}

/**
 * Content Vertical Alignment
 */
if ($settings['media_gallery_style_hover_content_vertical_alignment']) {
    $neuron_hover_holder_body_class[] = 'align-items-'. $settings['media_gallery_style_hover_content_vertical_alignment'] .'';
} else {
    $neuron_hover_holder_body_class[] = 'align-items-center';
}

/**
 * Social Media & Lightbox
 */
if ($media['query_social_media']) {
    $neuron_hover_holder_class[] = 'o-neuron-hover-holder--social-media';
}
?>
<div class="<?php echo esc_attr(implode(' ', $neuron_media_hover_class)) ?>">
    <div class="<?php echo esc_attr(implode(' ', $neuron_hover_holder_class)) ?>">
        <div class="o-neuron-hover-holder__header">
            <div class="o-neuron-hover-holder__header__media">
                <?php
                // Image Size
                if ($settings['media_gallery_thumbnail_resizer'] == 'yes') {
                    if ($settings['media_gallery_thumbnail_sizes_custom_dimension']) {
                        $media_custom_dimension = $settings['media_gallery_thumbnail_sizes_custom_dimension'];
                        $media_image_size = [isset($media_custom_dimension['width']) ? $media_custom_dimension['width'] : 500, isset($media_custom_dimension['width']) ? $media_custom_dimension['width'] : 9999];
                    } else {
                        $media_image_size = $settings['media_gallery_thumbnail_sizes_size'];
                    }
                } else {
                    $media_image_size = 'full';
                }

                if ($media['query_image']) {
                    if (strpos($media['query_image']['url'], 'assets/images/placeholder.png')) {
                        $media_image_padding = 'padding-bottom: 100%';
                    } else {
                        $media_image_padding = neuron_image_calculation($media['query_image']['id'], $media_image_size);
                    }

                    if ($settings['media_gallery_carousel_height'] == 'full') {
                        echo sprintf(
                            '<div class="h-full-height-image h-background-image-style" style="background-image: url(%s)"></div>',
                            $media['query_image']['url']
                        );
                    } elseif ($media['query_image']['id']) {
                        echo sprintf(
                            '<div class="%s" style="%s">%s</div>',
                            'h-calculated-image',
                            esc_attr($media_image_padding),
                            wp_get_attachment_image($media['query_image']['id'], $media_image_size)
                        );
                    } else {
                        echo sprintf(
                            '<div class="%s" style="%s"><img src="%s" alt="%s"></div>',
                            'h-calculated-image',
                            'padding-bottom: 100%',
                            esc_url($media['query_image']['url']),
                            esc_attr(neuron_get_attachment_alt($media['query_image']['id']))
                        );
                    }
                }
                ?>
            </div>
            <?php if ($settings['media_gallery_hover_visibility'] != 'hide') : ?>
                <div class="o-neuron-hover-holder__header__overlay"></div>
            <?php endif; ?>
        </div>
        <?php if ($settings['media_gallery_hover_visibility'] != 'hide') : ?>
            <div class="<?php echo esc_attr(implode(' ', $neuron_hover_holder_body_class)) ?>">
                <div class="o-neuron-hover-holder__body-meta">
                    <?php if ($media['query_social_media']) : ?>
                        <div class="m-social-media o-neuron-hover-holder__body-meta__social-media">
                            <ul>
                            <?php 
                                $media_social_media = explode("\n", $media['query_social_media']);
                                if ($media_social_media) {
                                    foreach ($media_social_media as $social_media) {
                                        if (strlen($social_media) > 0) {
                                            $social_media_expl = explode('==', $social_media);
                                            echo '<li><a target="_BLANK" href='. esc_url($social_media_expl[1]) .'><i class="fab fa-'. $social_media_expl[0] .'"></i></a></li>';
                                        }
                                    }    
                                }
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <?php 
                    if ($media['query_url']['url'] || $settings['media_gallery_lightbox'] == 'yes') {
                        $media['query_url']['url'] = $media['query_url']['url'] ? $media['query_url']['url'] : $media['query_image']['url'];
                        echo sprintf(
                            '<a title="%s" class="h-lightbox-link" %s %s %s></a>',
                            $media['query_title'] ? $media['query_title'] : '',
                            $settings['media_gallery_lightbox'] == 'yes' ? 'data-mfp-src='. esc_url($media['query_url']['url']) .'' : 'href='. esc_url($media['query_url']['url']) .'',
                            $media['query_url']['is_external'] == 'on' ? 'target="_BLANK"' : '',
                            $media['query_url']['nofollow'] == 'on' ? 'rel="nofollow"' : ''
                        );
                    }
                ?>
            </div>
        <?php endif; ?>
    </div>           
</div>
<?php if ($media['query_title'] || $media['query_subtitle']) : ?>
    <div class="m-media-gallery__item__content">
        <?php if ($media['query_title']) : ?>
            <h4 class="m-media-gallery__item__content__text m-media-gallery__item__content__title">
                <?php
                if ($media['query_url']['url'] && $settings['media_gallery_lightbox'] != 'yes') {
                    echo sprintf(
                        '<a href="%s" %s %s>%s</a>',
                        esc_url($media['query_url']['url']),
                        $media['query_url']['is_external'] == 'on' ? 'target="_BLANK"' : '',
                        $media['query_url']['nofollow'] == 'on' ? 'rel="nofollow"' : '',
                        esc_attr($media['query_title'])
                    );
                } else {
                    echo esc_attr($media['query_title']);
                }
                ?>
            </h4>
        <?php endif; ?>
        <?php if ($media['query_title']) : ?>
            <h5 class="m-media-gallery__item__content__text m-media-gallery__item__content__subtitle"><?php echo esc_attr($media['query_subtitle']) ?></h5>
        <?php endif; ?>
        <?php if ($media['query_description']) : ?>
            <p class="m-media-gallery__item__content__text m-media-gallery__item__content__description"><?php echo esc_attr($media['query_description']) ?></p>
        <?php endif; ?>
    </div>
<?php endif; ?>