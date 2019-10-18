<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins;

use Clarkson\Filters\SiteHealth\Filters\Plugins\GravityForms\SystemReport;
use Clarkson\Filters\SiteHealth\Filters\Plugins\GravityForms\Updates;

class GravityForms {
	public function register_hooks() {
		( new SystemReport() )->register_hooks();
		( new Updates() )->register_hooks();
	}
}
