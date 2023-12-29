<?php

namespace Clarkson\Filters\SiteHealth\Filters\Plugins\GravityForms;

use Clarkson\Filters\SiteHealth\Filters\Plugins\GravityForms\Tab;
use Clarkson\Filters\SiteHealth\SiteHealthFilter;

class SystemReport extends Tab {

	public function __construct() {
		$this->title    = __( 'System Report', 'gravityforms' );
		$this->slug     = 'report';
		$this->priority = 10;
	}

	public function register_hooks() {
		add_filter( 'gform_system_status_menu', array( $this, 'unset_tabs' ), 10, 1 );
		add_filter( 'gform_system_report', array( $this, 'set_content' ) );
	}

	public function set_content( $report ) {
		if ( SiteHealthFilter::is_debug_mode() ) {
			return $report;
		}

		$report = array(
			array(
				'title'        => esc_html__( 'Sorry!', 'll_site_health_filter' ),
				'title_export' => 'Sorry!',
				'tables'       => array(
					array(
						'title'        => esc_html__( 'You are not allowed to view this page.', 'll_site_health_filter' ),
						'title_export' => 'You are not allowed to view this page.',
						'items'        => array(
							array(
								'label'        => esc_html__( 'Description', 'll_site_health_filter' ),
								'label_export' => 'Description',
								'value'        => esc_html__( 'Please contact your system administrator if you think you shouln\'t see this message.', 'll_site_health_filter' ),
							),
						),
					),
				),
			),
		);

		return $report;
	}
}
