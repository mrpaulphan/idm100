<?php
/**
 * Portfolio Item Tabs
 */
if (!have_rows('portfolio_item_custom_tabs')) {
    return;
}
?>
<div class="p-portfolio-single__content__tabs">
    <ul>
        <?php
        while (have_rows('portfolio_item_custom_tabs')) : the_row();
        ?>
            <li>
                <h5 class="tabs-title"><?php echo esc_attr(get_sub_field('portfolio_item_custom_tabs_title')); ?></h5>
                <?php if (get_sub_field('portfolio_item_custom_tabs_type') == '1') : ?>
                    <p><?php echo wp_kses_post(get_sub_field('portfolio_item_custom_tabs_description')) ?></p>
                <?php else : ?>
                    <a target="<?php echo esc_attr(get_sub_field('portfolio_item_custom_tabs_link_url') ? '_BLANK' : '_SELF') ?>" href="<?php echo esc_url(get_sub_field('portfolio_item_custom_tabs_link_url')) ?>"><?php echo esc_attr(get_sub_field('portfolio_item_custom_tabs_link_title')) ?></a>
                <?php endif; ?>
            </li>
        <?php
        endwhile;
        ?>
    </ul>
</div>