<?php

namespace Clarkson\Filters\SiteHealth\Filters\Core;

use Clarkson\Filters\SiteHealth\SiteHealthFilter;

/**
 * SiteHealth
 *
 * @author Level Level <info@level-level.com>
 * @license GPLv3
 * @package Clarkson
 * @subpackage Filters\SiteHealth\Filters\Core
 */
class SiteHealth {
	public function register_hooks() {
		add_filter( 'site_status_tests', array( $this, 'remove_status_tests' ) );
	}

	public function remove_status_tests( $status_tests ) {
		/**
		 * We want to prevent the possibility that WordPress adds new sensitive data.
		 * Therefore we don't use the unset() function explained by wordpress in <https://make.wordpress.org/core/2019/04/25/site-health-check-in-5-2/>
		 */

		// If we use all tricks to display the status information, display it.
		if ( SiteHealthFilter::is_debug_mode() ) {
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
}
