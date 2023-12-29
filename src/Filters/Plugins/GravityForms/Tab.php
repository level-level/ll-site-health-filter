<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\GravityForms;

use Clarkson\Filters\SiteHealth\SiteHealthFilter;
use GF_System_Report;
use GF_Update;

abstract class Tab {
	protected $slug;
	protected $title;
	protected $priority;

	abstract public function register_hooks();

	public function set_content( $content ) {
		if ( SiteHealthFilter::is_debug_mode() ) {
			return $content;
		}

		$content = array();

		return $content;
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

	/**
	 * Remove the tab from the menu
	 */
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
