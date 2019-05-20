<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins;

use Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce\Status;
use Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce\Tools;

class WooCommerce {
	public function register_hooks() {
		( new Status() )->register_hooks();
		( new Tools() )->register_hooks();
	}
}
