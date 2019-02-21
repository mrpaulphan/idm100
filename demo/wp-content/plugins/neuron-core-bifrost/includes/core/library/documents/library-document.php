<?php
/**
 * Add Library Document Base.
 *
 * @package NeuronElementor
 * @since 1.0.0
 */

namespace NeuronElementor\Core\Library\Documents;

use Elementor\Modules\Library\Documents\Library_Document as Elementor_Library_Document;

defined( 'ABSPATH' ) || die();

abstract class Library_Document extends Elementor_Library_Document {

	/**
	 * Get document edit url.
	 *
	 * Retrieve the document edit url.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	// public function get_edit_url() {
	// 	$url = parent::get_edit_url();

	// 	if ( isset( $_GET['action'] ) && 'elementor_new_post' === $_GET['action'] ) { // phpcs:ignore
	// 		$url .= '#library';
	// 	}

	// 	return $url;
	// }
}
