<?php

namespace Clarkson\Filters\SiteHealth\Filters;

use Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce;
use Clarkson\Filters\SiteHealth\Filters\Plugins\GravityForms;

class Plugins {
	public function register_hooks() {
		add_action( 'plugins_loaded', array( $this, 'register_plugin_hooks' ) );
	}

	public function register_plugin_hooks() {
		if ( defined( 'WC_VERSION' ) ) {
			( new WooCommerce() )->register_hooks();
		}

		if ( class_exists( 'GFForms' ) ) {
			( new GravityForms() )->register_hooks();
		}
	}
}
