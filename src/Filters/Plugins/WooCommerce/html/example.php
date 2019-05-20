<div class="<?php echo sanitize_html_class( $this->slug ); ?>">
	<?php echo esc_html_e( 'Example' ); ?>
</div>


<table class="wc_status_table wc_status_table--<?php echo sanitize_html_class( $this->slug ); ?> widefat" cellspacing="0" id="<?php echo sanitize_html_class( $this->slug ); ?>">
	<thead>
		<tr>
			<th colspan="1" data-export-label="<?php esc_attr_e( 'Example table header', 'woocommerce' ); ?>"><h2><?php esc_html_e( 'Example table header', 'woocommerce' ); ?></h2></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<strong class="name"><?php esc_html_e( 'Example name', 'woocommerce' ); ?></strong>
				<p class="description"><?php esc_html_e( 'Example description', 'woocommerce' ); ?></p>
			</td>
		</tr>
	</tbody>
</table>
