<?php
/**
 * Shop Sidebar
 */
if (is_active_sidebar('shop-sidebar') && class_exists('WooCommerce')) {
	dynamic_sidebar('shop-sidebar');
}
