<?php
namespace Clarkson\Filters;

/**
 * SiteHealthFilter
 *
 * @author Level Level <info@level-level.com>
 * @license GPLv3
 * @package Clarkson
 * @subpackage Filters
 */
class SiteHealthFilter {

	private $debug = false;

	public function register_hooks() {
		add_action( 'init', array( $this, 'set_debug_mode' ) );
		add_filter( 'site_status_tests', array( $this, 'remove_status_tests' ) );
		add_filter( 'debug_information', array( $this, 'remove_debug_info' ) );
	}

	/**
	 * Detects if Level Level wants to display debug information
	 *
	 * @return void
	 */
	public function set_debug_mode() {
		if (
			(
				( defined( 'WP_DEBUG' ) ? WP_DEBUG : false )
				|| ( filter_input( INPUT_GET, 'show_debug', FILTER_SANITIZE_SPECIAL_CHARS ) === 'true' )
			)
			&& current_user_can( 'administrator' )
		) {
			$this->debug = true;
		}
	}

	public function remove_status_tests( $status_tests ) {
		/**
		 * We want to prevent the possibility that WordPress adds new sensitive data.
		 * Therefore we don't use the unset() function explained by wordpress in <https://make.wordpress.org/core/2019/04/25/site-health-check-in-5-2/>
		 */

		// If we use all tricks to display the status information, display it.
		if ( $this->debug ) {
			return $status_tests;
		}

		// It looks like we shouldn't display status information, so show only limited info.
		$status_tests = array(
			'direct' => array(
				'ssl_support'       => array(
					'label' => __( 'Secure communication' ),
					'test'  => 'ssl_support',
				),
				'http_requests'     => array(
					'label' => __( 'HTTP Requests' ),
					'test'  => 'http_requests',
				),
				'debug_enabled'     => array(
					'label' => __( 'Debugging enabled' ),
					'test'  => 'is_in_debug_mode',
				),
				'rest_availability' => array(
					'label' => __( 'REST API availability' ),
					'test'  => 'rest_availability',
				),
			),
			'async'  => array(
				'dotorg_communication' => array(
					'label' => __( 'Communication with WordPress.org' ),
					'test'  => 'dotorg_communication',
				),
			),
		);

		return $status_tests;
	}

	public function remove_debug_info( $debug_info ) {
		/**
		 * We want to prevent the possibility that WordPress adds new sensitive data.
		 * Therefore we don't use the unset() function explained by wordpress in <https://make.wordpress.org/core/2019/04/25/site-health-check-in-5-2/>
		 */

		// If we use all tricks to display the debug information, display it.
		if ( $this->debug ) {
			return $debug_info;
		}

		// It looks like we shouldn't display debug information, so show only limited info.
		$is_ssl       = is_ssl();
		$core_version = get_bloginfo( 'version' );
		$debug_info   = array(
			'wp-core' => array(
				'label'  => __( 'WordPress' ),
				'fields' => array(
					'version'       => array(
						'label' => __( 'Version' ),
						'value' => $core_version,
						'debug' => $core_version,
					),
					'site_language' => array(
						'label' => __( 'Site Language' ),
						'value' => get_locale(),
					),
					'home_url'      => array(
						'label'   => __( 'Home URL' ),
						'value'   => get_bloginfo( 'url' ),
						'private' => true,
					),
					'site_url'      => array(
						'label'   => __( 'Site URL' ),
						'value'   => get_bloginfo( 'wpurl' ),
						'private' => true,
					),
					'https_status'  => array(
						'label' => __( 'Is this site using HTTPS?' ),
						'value' => $is_ssl ? __( 'Yes' ) : __( 'No' ),
						'debug' => $is_ssl,
					),
				),
			),
		);

		return $debug_info;
	}
}
