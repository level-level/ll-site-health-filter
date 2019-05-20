<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce;

class Tools extends Tab {

	public function __construct() {
		$this->title = __( 'Tools', 'woocommerce' );
		$this->slug  = 'tools';
	}

	public function register_hooks() {
		add_filter( 'woocommerce_admin_status_tabs', array( $this, 'unset_tabs' ), 10, 1 );
	}
}
