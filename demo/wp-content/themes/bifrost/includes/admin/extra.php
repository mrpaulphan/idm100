<?php 
/**
 * Elementor Notice
 * 
 * It explains to disable the
 * default font and colors.
 */
function bifrost_elementor_notice() {
	if (!get_user_meta(get_current_user_id(), 'bifrost_elementor_notice_dismiss')) {
	?>
	<div class="notice notice-warning elementor-notice-warning">
		<a class="dismiss-elementor-notice" href="?elementor-ignore-notice"><?php _e('Dismiss', 'bifrost') ?></a>
    	<p><?php _e('Elementor by default doesn\'t disable the default font and colors, to inherit the fonts and colors from theme please disable the default fonts and colors at Elementor > Settings or click on the link below.', 'bifrost'); ?></p>
		<small><?php echo esc_attr__('After you\'re done, you can dismiss this notice by clicking on the tick to the right.', 'bifrost') ?></small>
		<p><a href="<?php echo esc_url(admin_url('?page=elementor')) ?>"><?php _e('Click Here', 'bifrost') ?></a></p>
	</div>
	<?php
	}
}
add_action('admin_notices', 'bifrost_elementor_notice');
	
function bifrost_elementor_notice_dismiss() {
	if (isset($_GET['elementor-ignore-notice'])) {
		add_user_meta(get_current_user_id(), 'bifrost_elementor_notice_dismiss', 'true', true);
	}
}
add_action('admin_init', 'bifrost_elementor_notice_dismiss');