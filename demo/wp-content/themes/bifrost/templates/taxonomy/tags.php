<?php 
/**
 * Tags
 */
if (!get_the_tags()) {
    return;
}
?>
<div class="o-blog-post__tags a-separator">
    <?php if ($neuron_posts_style_meta_icon == 'yes') : ?>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
    <?php endif; ?>
    <ul>
        <?php foreach (get_the_tags() as $tag) : ?>
            <li><a href="<?php echo esc_url(get_tag_link($tag->term_id)) ?>"><?php echo esc_attr($tag->name) ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>