<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\GravityForms;

use Clarkson\Filters\SiteHealth\SiteHealthFilter;
use Clarkson\Filters\SiteHealth\Filters\Plugins\GravityForms\Tab;

class Updates extends Tab {

	public function __construct() {
		$this->title    = __( 'Updates', 'gravityforms' );
		$this->slug     = 'updates';
		$this->priority = 20;
	}

	public function register_hooks() {
		add_filter( 'gform_system_status_menu', array( $this, 'unset_tabs' ), 10, 1 );
		add_filter( 'gform_updates_list', array( $this, 'set_updates_list' ), 100, 1 );
	}

	public function set_updates_list( $updates ) {
		if ( SiteHealthFilter::is_debug_mode() ) {
			return $updates;
		}

		$updates = array();

		return $report;
	}
}
