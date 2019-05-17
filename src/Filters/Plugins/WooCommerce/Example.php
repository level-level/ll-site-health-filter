<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce;

/**
 * Example
 *
 * @author Level Level <info@level-level.com>
 * @license GPLv3
 * @package Clarkson
 * @subpackage Filters\SiteHealth\Filters\Plugins\WooCommerce
 */
class Example {
	public function register_hooks() {
		add_action( 'woocommerce_admin_status_content_example_slug', array( $this, 'add_example_admin_status_content_example_slug') );

		add_filter( 'woocommerce_admin_status_tabs', array( $this, 'add_example_admin_status_tabs' ), 10, 1 );
	}

	public function add_example_admin_status_tabs( $tabs ){
		$tabs['example'] = __( 'Example title', 'woocommerce' );
		return $tabs;
	}

	public function add_example_admin_status_content_example_slug() {
		?>
		<div class="">
			Example
		</div>
		<?php
	}
}
