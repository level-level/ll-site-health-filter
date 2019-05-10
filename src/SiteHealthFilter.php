<?php
namespace Clarkson\Filters;

/**
 * SiteHealthFilter
 *
 * @author Level Level <info@level-level.com>
 */
class SiteHealthFilter {

	private $debug;

	function __construct() {
		$this->debug = ( defined( 'WP_DEBUG' ) ? WP_DEBUG : false );
	}

	public function register_hooks() {
		add_filter( 'site_status_tests', array( $this, 'remove_status_tests' ) );
		add_filter( 'debug_information', array( $this, 'remove_debug_info' ) );
	}

	public function remove_status_tests( $status_tests ) {
		/**
		 * We want to prevent the possibility that WordPress adds new sensitive data.
		 * Therefore we don't use the unset() function explained by wordpress in <https://make.wordpress.org/core/2019/04/25/site-health-check-in-5-2/>
		 */

		// PHP version
		unset( $status_tests['direct']['php_version'] );

		// SQL server version
		unset( $status_tests['direct']['sql_server'] );

		// PHP extionsions
		unset( $status_tests['direct']['php_extensions'] );

		// Events
		unset( $status_tests['direct']['scheduled_events'] );

		// background updates
		unset( $status_tests['async']['background_updates'] );

		return $status_tests;
	}

	public function remove_debug_info( $debug_info ) {
		/**
		 * We want to prevent the possibility that WordPress adds new sensitive data.
		 * Therefore we don't use the unset() function explained by wordpress in <https://make.wordpress.org/core/2019/04/25/site-health-check-in-5-2/>
		 */

		// Database Protection
		unset( $debug_info['wp-database'] );

		// WP Constants
		unset( $debug_info['wp-constants'] );

		// Server Architecture
		unset( $debug_info['wp-server']['fields'] );

		// Theme absolute path
		unset( $debug_info['wp-active-theme']['fields']['theme_path'] );

		// Directory Info
		unset( $debug_info['wp-paths-sizes'] );

		//Filesystem
		unset( $debug_info['wp-filesystem'] );

		//Media handling
		unset( $debug_info['wp-media'] );

		return $debug_info;
	}
}
