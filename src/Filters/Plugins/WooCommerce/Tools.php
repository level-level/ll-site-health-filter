<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce;

/**
 * Tools
 *
 * @author Level Level <info@level-level.com>
 * @license GPLv3
 * @package Clarkson
 * @subpackage Filters\SiteHealth\Filters\Plugins\WooCommerce
 */
class Tools extends Tab {
	protected $slug = 'tools';

	public function register_hooks() {
		add_filter( 'woocommerce_admin_status_tabs', array( $this, 'unset_tabs' ), 10, 1 );
	}
}
