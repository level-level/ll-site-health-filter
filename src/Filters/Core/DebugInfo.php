<?php

namespace Clarkson\Filters\SiteHealth\Filters\Core;

use Clarkson\Filters\SiteHealth\SiteHealthFilter;

class DebugInfo {
	public function register_hooks() {
		add_filter( 'debug_information', array( $this, 'remove_debug_info' ) );
	}

	public function remove_debug_info( array $debug_info ): array {
		/**
		 * We want to prevent the possibility that WordPress adds new sensitive data.
		 * Therefore we don't use the unset() function explained by wordpress in <https://make.wordpress.org/core/2019/04/25/site-health-check-in-5-2/>
		 */

		// If we use all tricks to display the debug information, display it.
		if ( SiteHealthFilter::is_debug_mode() ) {
			return $debug_info;
		}

		// It looks like we shouldn't display debug information, so show only limited info.
		$is_ssl       = is_ssl();
		$core_version = get_bloginfo( 'version' );
		$debug_info   = array(
			'wp-core' => array(
				'label'  => __( 'WordPress', 'default' ),
				'fields' => array(
					'version'       => array(
						'label' => __( 'Version', 'default' ),
						'value' => $core_version,
						'debug' => $core_version,
					),
					'site_language' => array(
						'label' => __( 'Site Language', 'default' ),
						'value' => get_locale(),
					),
					'home_url'      => array(
						'label'   => __( 'Home URL', 'default' ),
						'value'   => get_bloginfo( 'url' ),
						'private' => true,
					),
					'site_url'      => array(
						'label'   => __( 'Site URL', 'default' ),
						'value'   => get_bloginfo( 'wpurl' ),
						'private' => true,
					),
					'https_status'  => array(
						'label' => __( 'Is this site using HTTPS?', 'default' ),
						'value' => $is_ssl ? __( 'Yes', 'default' ) : __( 'No', 'default' ),
						'debug' => $is_ssl,
					),
				),
			),
		);

		return $debug_info;
	}
}
