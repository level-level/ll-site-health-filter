<?php

namespace Clarkson\Filters\SiteHealth\Filters;

use Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce;

/**
 * Plugins
 *
 * @author Level Level <info@level-level.com>
 * @license GPLv3
 * @package Clarkson
 * @subpackage Filters\SiteHealth\Filters
 */
class Plugins {
	public function register_hooks() {
		( new WooCommerce() )->register_hooks();
	}
}
