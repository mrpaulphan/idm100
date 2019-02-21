<?php 
/**
 * Author of Post in Blog
 */

$neuron_posts_author_class = ['o-blog-post__author', 'd-flex align-items-center'];

if ($neuron_posts_style_author_alignment == 'center') {
    $neuron_posts_author_class[] = 'justify-content-center';
} elseif ($neuron_posts_style_author_alignment == 'right') {
    $neuron_posts_author_class[] = 'justify-content-end';
}
?>
<div class="<?php echo esc_attr(implode(' ', $neuron_posts_author_class)) ?>">
    <?php if ($neuron_posts_style_author_avatar == 'yes') : ?>
        <div class="avatar">
            <?php echo get_avatar(get_the_author_meta('ID'), 32) ?>
        </div>
    <?php endif; ?>
    <div class="author-name">
        <?php the_author_posts_link() ?>
    </div>
</div>