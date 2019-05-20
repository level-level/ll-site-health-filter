<table class="wc_status_table wc_status_table--<?php echo sanitize_html_class( $this->slug ); ?> widefat" cellspacing="0" id="<?php echo sanitize_html_class( $this->slug ); ?>">
	<thead>
		<tr>
			<th colspan="1" data-export-label="<?php esc_attr_e( 'Forbidden', 'woocommerce' ); ?>"><h2><?php esc_html_e( 'Forbidden', 'woocommerce' ); ?></h2></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<strong class="name"><?php esc_html_e( 'You are not allowed to access this page.', 'woocommerce' ); ?></strong>
				<p class="description"><?php esc_html_e( 'If you want access, please contact the administrator.', 'woocommerce' ); ?></p>
			</td>
		</tr>
	</tbody>
</table>
