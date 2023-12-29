<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\WooCommerce;

use Clarkson\Filters\SiteHealth\SiteHealthFilter;

use WC_Admin_Status;

abstract class Tab {
	protected $slug;
	protected $title;

	abstract public function register_hooks();


	/**
	 * Shows content for tabs
	 *
	 * @method set_content
	 * @see https://github.com/woocommerce/woocommerce/blob/dda34e04551c9caf1ac5ddf79ed1dd9516824a98/includes/admin/views/html-admin-page-status.php
	 * @return void
	 */
	public function set_content() {
		if ( SiteHealthFilter::is_debug_mode() ) {
			// Show default content, see url above
			switch ( $this->slug ) {
				case 'tools':
					WC_Admin_Status::status_tools();
					break;
				case 'logs':
					WC_Admin_Status::status_logs();
					break;
				default:
					WC_Admin_Status::status_report();
					break;
			}
			return;
		}

		$file = __DIR__ . '/html/' . $this->slug . '.php';
		if ( file_exists( $file ) ) {
			include_once $file;
		}
	}

	public function set_tabs( $tabs ) {
		if ( SiteHealthFilter::is_debug_mode() ) {
			return $tabs;
		}
		$tabs[ $this->slug ] = $this->title;
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
