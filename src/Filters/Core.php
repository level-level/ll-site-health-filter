<?php

namespace Clarkson\Filters\SiteHealth\Filters;

use Clarkson\Filters\SiteHealth\Filters\Core\SiteHealth;
use Clarkson\Filters\SiteHealth\Filters\Core\DebugInfo;

class Core {
	public function register_hooks() {
		( new SiteHealth() )->register_hooks();
		( new DebugInfo() )->register_hooks();
	}
}
