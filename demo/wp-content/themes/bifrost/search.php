<?php 
/**
 * Search Page
 */

get_header();

/**
 * Arguments
 * 
 * Modify the query with
 * different arguments properties.
 */
$args = array_merge(
    $wp_query->query_vars, 
    array('post_type' => 
        get_theme_mod('search_post_types', ['post', 'page', 'portfolio', 'product'])
    )
);

$query = new WP_Query($args);

/**
 * Columns
 */
$bifrost_search_item_class = 'selector';

switch (get_theme_mod('search_columns', '3')) {
    case '1':
        $bifrost_search_item_class .= ' col-12';
        break;
    case '2':
        $bifrost_search_item_class .= ' col-sm-6';
        break;
    default:
        $bifrost_search_item_class .= ' col-md-4 col-sm-6';
        break;
    case '4':
        $bifrost_search_item_class .= ' col-md-3 col-sm-6';
        break;
}

/**
 * Sidebar
 * 
 * Three different options for sidebar
 * two are for placements on the left
 * and the right and the other one to
 * hide the sidebar.
 */
$bifrost_search_row_class = 'row';
$bifrost_search_posts_class = 'col-lg-8';
$bifrost_search_sidebar_class = 'col-lg-4';

if (get_theme_mod('search_sidebar', '3') == '1') {
    $bifrost_search_row_class .= ' flex-row-reverse';
} elseif (get_theme_mod('search_sidebar', '3') == '3') {
    $bifrost_search_posts_class = 'col-12';
    $bifrost_search_sidebar_class = 'h-display-none';
}

/**
 * Hero 
 */
$bifrost_search_hero_style = $bifrost_search_overlay_style = [];

/**
 * Image
 */
if (get_theme_mod('search_hero_image')) {
    $bifrost_search_hero_style[] = 'background-image: url('. esc_url(wp_get_attachment_url(get_theme_mod('search_hero_image'))) .')';
}

/**
 * Overlay
 */
if (get_theme_mod('search_hero_overlay', '2') == '1') {
    if (get_theme_mod('search_hero_overlay_opacity')) {
        $bifrost_search_overlay_style[] = 'opacity: '. get_theme_mod('search_hero_overlay_opacity') .'';
    }

    if (get_theme_mod('search_hero_overlay_color')) {
        $bifrost_search_overlay_style[] = 'background-color: '. get_theme_mod('search_hero_overlay_color') .'';
    }
}

/**
 * Output the Hero
 */
echo sprintf(
    '<div class="o-hero d-flex">
        <div class="o-hero__header">
            <div class="o-hero__header__image" %s></div>
            %s
        </div>
        <div class="o-hero__content align-self-center h-align-center">
            <div class="container">
                <div class="o-hero__content__title h-fadeInNeuron wow">%s</div> 
                %s
            </div>
        </div>
    </div>',
    $bifrost_search_hero_style ? 'style="'. implode(';', $bifrost_search_hero_style) .'"' : '',
    get_theme_mod('search_hero_overlay', '2') == '1' ? '<div class="o-hero__header__overlay" style="'. implode(';', $bifrost_search_overlay_style) .'"></div>' : '',
    esc_attr($query->found_posts) . ' ' . esc_attr__('results for: ', 'bifrost') . ' ' . esc_attr(get_search_query()),
    get_theme_mod('search_hero_content') ? '<div class="o-hero__content__subtitle h-fadeInNeuron wow">'. get_theme_mod('search_hero_content') .'</div>' : ''
);
?>

<?php if (!$query->have_posts()) : ?>
    <div class="t-search h-large-bottom-padding">
        <div class="container">
            <h1><?php echo esc_attr__('Nothing Found', 'bifrost') ?></h1>
            <p><?php echo esc_attr__('The post you were looking for couldn\'t be found. The post could be removed or you misspelled the word while searching for it.', 'bifrost') ?></p>
            <?php get_search_form() ?>
        </div>
    </div>
<?php endif; ?>
<?php if ($query->have_posts()) : ?>
    <div class="l-blog-wrapper h-overflow-hidden h-large-bottom-padding">
        <div class="container">
            <div class="<?php echo esc_attr($bifrost_search_row_class) ?>">
                <div class="l-blog-wrapper__posts-holder l-blog-wrapper__posts-holder--meta-outside <?php echo esc_attr($bifrost_search_posts_class) ?>">
                    <div class="row masonry">
                        <?php while ($query->have_posts()) : $query->the_post() ?>
                            <div <?php post_class($bifrost_search_item_class) ?> id="id-<?php the_ID() ?>" data-id="<?php the_ID() ?>"> 
                                <div class="o-blog-post h-fadeInNeuron wow">
                                    <div class="o-blog-post__content">
                                        <h3 class="o-blog-post__title">
                                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                        </h3>
                                        <div class="o-blog-post__meta">
                                            <span class="o-blog-post__type a-separator">
                                                <span><?php echo esc_attr(get_post_type()) ?></span>
                                            </span>
                                        </div>
                                        <?php the_excerpt() ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php if (get_theme_mod('search_sidebar', '3') !== '3') : ?>
                    <div class="<?php echo esc_attr($bifrost_search_sidebar_class) ?>">
                        <div class="o-main-sidebar l-blog-wrapper__sidebar">
                            <?php get_sidebar() ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php 
endif; wp_reset_postdata();

neuron_pagination();

get_footer();