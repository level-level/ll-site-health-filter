<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce;

/**
 * Tab
 *
 * @author Level Level <info@level-level.com>
 * @license GPLv3
 * @package Clarkson
 * @subpackage Filters\SiteHealth\Filters\Plugins\WooCommerce
 */
abstract class Tab {
	protected $slug;

	abstract public function register_hooks();

	public function set_content() {
		$file = dirname( __FILE__ ) . '/html/' . $this->slug . '.php';
		if ( file_exists( $file ) ) {
			include_once $file;
		}
	}

	public function set_tabs( $tabs ){
		$title = str_replace( '_', ' ', $this->slug );
		$title = ucfirst( $title );
		$tabs[$this->slug] = __( $title, 'woocommerce' );
		return $tabs;
	}
}
