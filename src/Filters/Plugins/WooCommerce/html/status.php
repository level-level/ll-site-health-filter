<table class="wc_status_table wc_status_table--<?php echo sanitize_html_class( $this->slug ); ?> widefat" cellspacing="0" id="<?php echo sanitize_html_class( $this->slug ); ?>">
	<thead>
		<tr>
			<th colspan="1" data-export-label="<?php esc_attr_e( 'Forbidden', 'll_site_health_filter' ); ?>"><h2><?php esc_html_e( 'Forbidden', 'll_site_health_filter' ); ?></h2></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<strong class="name"><?php esc_html_e( 'You are not allowed to view this page.', 'll_site_health_filter' ); ?></strong>
				<p class="description"><?php esc_html_e( 'Please contact your system administrator if you think you shouln\'t see this message.', 'll_site_health_filter' ); ?></p>
			</td>
		</tr>
	</tbody>
</table>
