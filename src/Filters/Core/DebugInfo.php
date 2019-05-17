<?php

namespace Clarkson\Filters\SiteHealth\Filters\Core;

use Clarkson\Filters\SiteHealth\SiteHealthFilter;

/**
 * DebugInfo
 *
 * @author Level Level <info@level-level.com>
 * @license GPLv3
 * @package Clarkson
 * @subpackage Filters\SiteHealth\Filters\Core
 */
class DebugInfo {
	public function register_hooks() {
		add_filter( 'debug_information', array( $this, 'remove_debug_info' ) );
	}

	public function remove_debug_info( $debug_info ) {
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
