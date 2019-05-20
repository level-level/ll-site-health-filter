<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce;

use Clarkson\Filters\SiteHealth\SiteHealthFilter;

/**
 * Tab
 *
 * @author Level Level <info@level-level.com>
 * @license GPLv3
 * @package Clarkson
 * @subpackage Filters\SiteHealth\Filters\Plugins\WooCommerce
 */
abstract class Tab {
	protected $slug;

	abstract public function register_hooks();

	public function set_content() {
		if ( SiteHealthFilter::is_debug_mode() ) {
			switch ( $this->slug ) {
				case 'tools':
					\WC_Admin_Status::status_tools();
					break;
				case 'logs':
					\WC_Admin_Status::status_logs();
					break;
				default:
					\WC_Admin_Status::status_report();
					break;
			}
			return;
		}

		$file = dirname( __FILE__ ) . '/html/' . $this->slug . '.php';
		if ( file_exists( $file ) ) {
			include_once $file;
		}
	}

	public function set_tabs( $tabs ) {
		if ( SiteHealthFilter::is_debug_mode() ) {
			return $tabs;
		}

		$title               = str_replace( '_', ' ', $this->slug );
		$title               = ucfirst( $title );
		$tabs[ $this->slug ] = __( $title, 'woocommerce' ); // phpcs:ingore WordPress.WP.I18n.NonSingularStringLiteralText
		return $tabs;
	}

	public function unset_tabs( $tabs ) {
		if ( SiteHealthFilter::is_debug_mode() ) {
			return $tabs;
		}

		unset( $tabs[ $this->slug ] );
		return $tabs;
	}
}
