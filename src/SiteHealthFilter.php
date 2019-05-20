<?php
namespace Clarkson\Filters\SiteHealth;

use Clarkson\Filters\SiteHealth\Filters\Core;
use Clarkson\Filters\SiteHealth\Filters\Plugins;

class SiteHealthFilter {

	public function register_hooks() {
		( new Core() )->register_hooks();
		( new Plugins() )->register_hooks();
	}

	/**
	 * Detects if Level Level wants to display debug information
	 *
	 * @return bool
	 */
	public static function is_debug_mode() : bool {
		if (
			(
				( defined( 'WP_DEBUG' ) ? WP_DEBUG : false )
				|| ( filter_input( INPUT_GET, 'show_debug', FILTER_SANITIZE_SPECIAL_CHARS ) === 'true' )
			)
			&& current_user_can( 'administrator' )
		) {
			return true;
		}
		return false;
	}
}
