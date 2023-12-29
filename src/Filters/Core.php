<?php

namespace Clarkson\Filters\SiteHealth\Filters;

use Clarkson\Filters\SiteHealth\Filters\Core\DebugInfo;
use Clarkson\Filters\SiteHealth\Filters\Core\SiteHealth;

class Core {
	public function register_hooks() {
		( new SiteHealth() )->register_hooks();
		( new DebugInfo() )->register_hooks();
	}
}
