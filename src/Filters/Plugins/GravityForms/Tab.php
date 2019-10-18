<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\GravityForms;

use Clarkson\Filters\SiteHealth\SiteHealthFilter;
use \GF_System_Report;
use \GF_Update;

abstract class Tab {
	protected $slug;
	protected $title;
	protected $priority;

	abstract public function register_hooks();


	/**
	 * Shows content for tabs
	 *
	 * @method set_content
	 * @see https://github.com/wp-premium/gravityforms/blob/3241d9c07b7b843ed74d04669c063169a7b8673e/includes/system-status/class-gf-system-status.php
	 * @return void
	 */
	public function set_content() {
		if ( SiteHealthFilter::is_debug_mode() ) {
			// Show default content, see url above
			switch ( $this->slug ) {
				case 'report':
					GF_System_Report::system_report();
					break;
				case 'updates':
					GF_Update::updates();
					break;
				default:
					do_action( "gform_system_status_page_{$this->slug}" );
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

		$tabs[ $this->priority ] = array(
			'name'  => $this->slug,
			'label' => $this->title,
		);

		return $tabs;
	}

	public function unset_tabs( $tabs ) {
		if ( SiteHealthFilter::is_debug_mode() ) {
			return $tabs;
		}

		foreach ( $tabs as $tab_index => $tab ) {
			if ( $tab['name'] === $this->slug ) {
				unset( $tabs[ $tab_index ] );
			}
		}

		return $tabs;
	}
}
