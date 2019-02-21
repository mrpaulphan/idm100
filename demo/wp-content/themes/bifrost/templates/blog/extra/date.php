<?php 
/**
 * Date of Post in Blog
 */
?>
<span class="o-blog-post__time a-separator">
    <?php if ($neuron_posts_style_meta_icon == 'yes') : ?>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
    <?php endif; ?>
    <span><?php the_time(get_option('date_format')) ?></span>
</span>