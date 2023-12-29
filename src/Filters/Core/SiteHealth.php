<?php

namespace Clarkson\Filters\SiteHealth\Filters\Core;

use Clarkson\Filters\SiteHealth\SiteHealthFilter;

class SiteHealth {
	public function register_hooks() {
		add_filter( 'site_status_tests', array( $this, 'remove_status_tests' ) );
	}

	public function remove_status_tests( array $status_tests ): array {
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
					'label' => __( 'Secure communication', 'default' ),
					'test'  => 'ssl_support',
				),
				'http_requests'     => array(
					'label' => __( 'HTTP Requests', 'default' ),
					'test'  => 'http_requests',
				),
				'debug_enabled'     => array(
					'label' => __( 'Debugging enabled', 'default' ),
					'test'  => 'is_in_debug_mode',
				),
				'rest_availability' => array(
					'label' => __( 'REST API availability', 'default' ),
					'test'  => 'rest_availability',
				),
			),
			'async'  => array(
				'dotorg_communication' => array(
					'label' => __( 'Communication with WordPress.org', 'default' ),
					'test'  => 'dotorg_communication',
				),
			),
		);

		return $status_tests;
	}
}
