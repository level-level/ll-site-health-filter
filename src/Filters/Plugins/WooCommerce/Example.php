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
class Example extends Tab {
	protected $slug = 'example';

	public function register_hooks() {
		add_action( 'woocommerce_admin_status_content_' . $this->slug, array( $this, 'set_content' ) );

		add_filter( 'woocommerce_admin_status_tabs', array( $this, 'set_tabs' ), 10, 1 );
	}
}
