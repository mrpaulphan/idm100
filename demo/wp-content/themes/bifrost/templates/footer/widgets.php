<?php
/**
 * Footer Widgets
 */
$bifrost_footer_widgets_class = ['l-primary-footer__widgets'];
$bifrost_active_sidebars = is_active_sidebar('sidebar-footer-1') || is_active_sidebar('sidebar-footer-2') || is_active_sidebar('sidebar-footer-3') || is_active_sidebar('sidebar-footer-4') || is_active_sidebar('sidebar-footer-5') || is_active_sidebar('sidebar-footer-6');

if ((bifrost_inherit_option('footer_widgets', 'footer_widgets', '1') == '2' || $bifrost_active_sidebars == false) && !is_search()) {
    return;
}

/**
 * Columns
 */
$bifrost_widgets_columns = bifrost_inherit_option('footer_widgets_columns', 'footer_widgets_columns', '4');

switch ($bifrost_widgets_columns) {
    case '1':
        $bifrost_item_class = 'col-sm-12';
        break;
    case '2':
        $bifrost_item_class = 'col-sm-6';
        break;
    case '3':
        $bifrost_item_class = 'col-sm-6 col-md-4';
        break;
    default:
        $bifrost_item_class = 'col-sm-6 col-md-3';
        break;
    case '5':
        $bifrost_item_class = 'col-sm-6 col-md-4 a-col-5';
        break;
    case '6':
        $bifrost_item_class = 'col-sm-6 col-md-4 col-lg-2';
        break;
}
/**
 * Mobile Visibility
 */
if (bifrost_inherit_option('footer_mobile_visibility', 'footer_mobile_visibility', '1') == '2') {
    $bifrost_footer_widgets_class[] = 'd-none d-sm-none d-md-block';
}
?>
<div class="<?php echo esc_attr(implode(' ', $bifrost_footer_widgets_class)) ?>">
   <div class="container">
        <div class="l-primary-footer__widgets__space">
            <div class="row">
                <?php for ($i = 1; $i <= $bifrost_widgets_columns; $i++) { ?>
                    <div class="<?php echo esc_attr($bifrost_item_class) ?>">
                        <?php is_active_sidebar('sidebar-footer-' . $i) ? dynamic_sidebar('sidebar-footer-' . $i) : ''; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
   </div>
</div>