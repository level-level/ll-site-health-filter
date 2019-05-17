<?php

namespace Clarkson\Filters\SiteHealth\Filters;

use Clarkson\Filters\SiteHealth\Filters\Core\SiteHealth;
use Clarkson\Filters\SiteHealth\Filters\Core\DebugInfo;

/**
 * Core
 *
 * @author Level Level <info@level-level.com>
 * @license GPLv3
 * @package Clarkson
 * @subpackage Filters\SiteHealth\Filters
 */
class Core {
	public function register_hooks() {
		( new SiteHealth() )->register_hooks();
		( new DebugInfo() )->register_hooks();
	}
}
