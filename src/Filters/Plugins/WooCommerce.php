<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins;

use Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce\Example;

/**
 * WooCommerce
 *
 * @author Level Level <info@level-level.com>
 * @license GPLv3
 * @package Clarkson
 * @subpackage Filters\SiteHealth\Filters\Plugins
 */
class WooCommerce {
	public function register_hooks() {
		( new Status() )->register_hooks();
		( new Tools() )->register_hooks();
	}
}
