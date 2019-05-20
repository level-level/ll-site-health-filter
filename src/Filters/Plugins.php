<?php

namespace Clarkson\Filters\SiteHealth\Filters;

use Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce;

class Plugins {
	public function register_hooks() {
		add_action( 'plugins_loaded', array( $this, 'register_plugin_hooks' ) );
	}

	public function register_plugin_hooks() {
		if ( defined( 'WC_VERSION' ) ) {
			( new WooCommerce() )->register_hooks();
		}
	}
}
