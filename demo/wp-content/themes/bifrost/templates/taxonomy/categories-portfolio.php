<?php
/**
 * Portfolio Categories 
 */
$portfolio_categories = get_the_terms(get_the_ID(), 'portfolio_category');

if (!$portfolio_categories) {
    return;
}
?>
<div class="o-portfolio-item__category-holder">
    <div class="o-portfolio-item__category a-separator">
        <?php if ($neuron_posts_style_meta_icon == 'yes') : ?>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
        <?php endif; ?>
        <ul>
            <?php foreach ($portfolio_categories as $category) : ?>
                <li><a href="<?php echo esc_url(get_category_link($category->term_id)) ?>"><?php echo esc_attr($category->name) ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>