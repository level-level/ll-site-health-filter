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
	private $slug = 'example';

	public function register_hooks() {
		add_action( 'woocommerce_admin_status_content_' . $this->slug, array( $this, 'set_content') );

		add_filter( 'woocommerce_admin_status_tabs', array( $this, 'set_tabs' ), 10, 1 );
	}

	public function set_tabs( $tabs ){
		$tabs[$this->slug] = __( 'Example title', 'woocommerce' );
		return $tabs;
	}

	public function set_content() {
		?>
		<div class="">
			Example
		</div>
		<?php
	}
}
