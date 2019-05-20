<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce;

/**
 * Status
 *
 * @author Level Level <info@level-level.com>
 * @license GPLv3
 * @package Clarkson
 * @subpackage Filters\SiteHealth\Filters\Plugins\WooCommerce
 */
class Status extends Tab {
	protected $slug = 'status';

	public function register_hooks() {
		add_action( 'woocommerce_admin_status_content_' . $this->slug, array( $this, 'set_content' ) );
	}
}
