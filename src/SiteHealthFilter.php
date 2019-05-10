<?php
namespace Clarkson\Filters;

/**
 * SiteHealthFilter
 *
 * @author Level Level <info@level-level.com>
 */
class SiteHealthFilter
{
	private $debug;

	function __construct()
	{
		$this->debug = ( defined( 'WP_DEBUG' ) ? WP_DEBUG : false );
	}

	public function register_hooks() {
		add_filter( 'site_status_tests', 'remove_status_tests' );
		add_filter( 'debug_information', 'remove_debug_info' );
	}

	public function remove_status_tests( $status_tests ) {
		unset( $status_tests['async']['background_updates'] );

		return $status_tests;
	}

	public function remove_debug_info( $debug_info ) {
		// Database Protection
		unset($debug_info['wp-database']);

		// WP Constants
		unset($debug_info['wp-constants']);

		// Server Architecture
		unset($debug_info['wp-server']['fields']);

		// Theme absolute path
		unset($debug_info['wp-active-theme']['fields']['theme_path']);

		// Directory Info
		unset($debug_info['wp-paths-sizes']);

		//Filesystem
		unset($debug_info['wp-filesystem']);

		//Media handling
		unset($debug_info['wp-media']);

		return $debug_info;
	}
}
