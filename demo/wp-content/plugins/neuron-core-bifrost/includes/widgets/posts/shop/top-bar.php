<?php
/**
 * Shop Top Bar
 */

/**
 * Result Count
 */
$neuron_result_count_args = [
    'total'    => $query->found_posts,
    'per_page' => $settings['posts_ppp'] ? $settings['posts_ppp'] : 10,
    'current'  => $args['paged'],
];

/**
 * Result Count 
 */
$neuron_result_count = $settings['posts_meta_results_count'];
$neuron_result_count_class = 'col-sm-6';

/**
 * Catalog Ordering
 */
$neuron_catalog_ordering = $settings['posts_meta_catalog_ordering'];
$neuron_catalog_ordering_class = 'col-sm-6';

$neuron_catalog_ordering == 'no' || !$neuron_catalog_ordering ? $neuron_result_count_class = 'col-12' : '';
$neuron_result_count == 'no' || !$neuron_result_count ? $neuron_catalog_ordering_class = 'col-12' : '';

if ($neuron_result_count == 'yes' || $neuron_catalog_ordering == 'yes') :
?>
    <div class="l-woocommerce-wrapper__top-bar h-medium-bottom-padding">
        <div class="row">
            <?php if ($neuron_result_count == 'yes') : ?>
                <div class="<?php echo esc_attr($neuron_result_count_class) ?>">
                    <?php wc_get_template('loop/result-count.php', $neuron_result_count_args) ?>
                </div>
            <?php endif; ?>
            <?php if ($neuron_catalog_ordering == 'yes') : ?>
                <div class="<?php echo esc_attr($neuron_catalog_ordering_class) ?>">
                    <?php 
                        wc_get_template('loop/orderby.php', array(
                            'catalog_orderby_options' => $catalog_orderby_options,
                            'orderby' => $orderby,
                            'show_default_orderby' => $show_default_orderby,
                        ));
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>