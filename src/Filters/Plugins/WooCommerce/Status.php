<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce;

use Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce\Tab;

class Status extends Tab {
	public function __construct() {
		$this->title = __( 'System status', 'woocommerce' );
		$this->slug  = 'status';
	}

	public function register_hooks() {
		add_action( 'woocommerce_admin_status_content_' . $this->slug, array( $this, 'set_content' ) );
	}
}
