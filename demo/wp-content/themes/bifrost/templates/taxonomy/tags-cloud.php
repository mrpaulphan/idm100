<?php
/**
 * Tags Cloud
 */
if (!get_the_tags()) {
    return;
}
?>
<div class="p-blog-single__tagcloud">
    <div class="tagcloud">
        <h6 class="tagCloud__title"><?php echo esc_attr__('Tags:', 'bifrost') ?></h6>
        <?php foreach (get_the_tags() as $tag) : ?>
            <a href="<?php echo esc_url(get_tag_link($tag->term_id)) ?>"><?php echo esc_attr($tag->name) ?></a>
        <?php endforeach; ?>
    </div>
</div>