<?php
// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

global $wpdb;
// This screen requires classes from the REST API.
if ( ! did_action( 'rest_api_init' ) ) {
	\WC()->api->rest_api_includes();
}
if ( ! class_exists( 'WC_REST_System_Status_Controller', false ) ) {
	wp_die( 'Cannot load the REST API to access WC_REST_System_Status_Controller.' );
}

$system_status    = new \WC_REST_System_Status_Controller();
$settings         = $system_status->get_settings();
$pages            = $system_status->get_pages();

?>

<table class="wc_status_table widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="3" data-export-label="Settings"><h2><?php esc_html_e( 'Settings', 'woocommerce' ); ?></h2></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td data-export-label="API Enabled"><?php esc_html_e( 'API enabled', 'woocommerce' ); ?>:</td>
			<td class="help"><?php echo wc_help_tip( esc_html__( 'Does your site have REST API enabled?', 'woocommerce' ) ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></td>
			<td><?php echo $settings['api_enabled'] ? '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>' : '<mark class="no">&ndash;</mark>'; ?></td>
		</tr>
		<tr>
			<td data-export-label="Force SSL"><?php esc_html_e( 'Force SSL', 'woocommerce' ); ?>:</td>
			<td class="help"><?php echo wc_help_tip( esc_html__( 'Does your site force a SSL Certificate for transactions?', 'woocommerce' ) ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></td>
			<td><?php echo $settings['force_ssl'] ? '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>' : '<mark class="no">&ndash;</mark>'; ?></td>
		</tr>
		<tr>
			<td data-export-label="Currency"><?php esc_html_e( 'Currency', 'woocommerce' ); ?></td>
			<td class="help"><?php echo wc_help_tip( esc_html__( 'What currency prices are listed at in the catalog and which currency gateways will take payments in.', 'woocommerce' ) ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></td>
			<td><?php echo esc_html( $settings['currency'] ); ?> (<?php echo esc_html( $settings['currency_symbol'] ); ?>)</td>
		</tr>
		<tr>
			<td data-export-label="Currency Position"><?php esc_html_e( 'Currency position', 'woocommerce' ); ?></td>
			<td class="help"><?php echo wc_help_tip( esc_html__( 'The position of the currency symbol.', 'woocommerce' ) ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></td>
			<td><?php echo esc_html( $settings['currency_position'] ); ?></td>
		</tr>
		<tr>
			<td data-export-label="Thousand Separator"><?php esc_html_e( 'Thousand separator', 'woocommerce' ); ?></td>
			<td class="help"><?php echo wc_help_tip( esc_html__( 'The thousand separator of displayed prices.', 'woocommerce' ) ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></td>
			<td><?php echo esc_html( $settings['thousand_separator'] ); ?></td>
		</tr>
		<tr>
			<td data-export-label="Decimal Separator"><?php esc_html_e( 'Decimal separator', 'woocommerce' ); ?></td>
			<td class="help"><?php echo wc_help_tip( esc_html__( 'The decimal separator of displayed prices.', 'woocommerce' ) ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></td>
			<td><?php echo esc_html( $settings['decimal_separator'] ); ?></td>
		</tr>
		<tr>
			<td data-export-label="Number of Decimals"><?php esc_html_e( 'Number of decimals', 'woocommerce' ); ?></td>
			<td class="help"><?php echo wc_help_tip( esc_html__( 'The number of decimal points shown in displayed prices.', 'woocommerce' ) ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></td>
			<td><?php echo esc_html( $settings['number_of_decimals'] ); ?></td>
		</tr>
		<tr>
			<td data-export-label="Taxonomies: Product Types"><?php esc_html_e( 'Taxonomies: Product types', 'woocommerce' ); ?></th>
			<td class="help"><?php echo wc_help_tip( esc_html__( 'A list of taxonomy terms that can be used in regard to order/product statuses.', 'woocommerce' ) ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></td>
			<td>
				<?php
				$display_terms = array();
				foreach ( $settings['taxonomies'] as $slug => $name ) {
					$display_terms[] = strtolower( $name ) . ' (' . $slug . ')';
				}
				echo implode( ', ', array_map( 'esc_html', $display_terms ) );
				?>
			</td>
		</tr>
		<tr>
			<td data-export-label="Taxonomies: Product Visibility"><?php esc_html_e( 'Taxonomies: Product visibility', 'woocommerce' ); ?></th>
			<td class="help"><?php echo wc_help_tip( esc_html__( 'A list of taxonomy terms used for product visibility.', 'woocommerce' ) ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></td>
			<td>
				<?php
				$display_terms = array();
				foreach ( $settings['product_visibility_terms'] as $slug => $name ) {
					$display_terms[] = strtolower( $name ) . ' (' . $slug . ')';
				}
				echo implode( ', ', array_map( 'esc_html', $display_terms ) );
				?>
			</td>
		</tr>
	</tbody>
</table>

<table class="wc_status_table widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="3" data-export-label="WC Pages"><h2><?php esc_html_e( 'WooCommerce pages', 'woocommerce' ); ?></h2></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$alt = 1;
		foreach ( $pages as $page ) {
			$error = false;
			if ( $page['page_id'] ) {
				/* Translators: %s: page name. */
				$page_name = '<a href="' . get_edit_post_link( $page['page_id'] ) . '" aria-label="' . sprintf( esc_html__( 'Edit %s page', 'woocommerce' ), esc_html( $page['page_name'] ) ) . '">' . esc_html( $page['page_name'] ) . '</a>';
			} else {
				$page_name = esc_html( $page['page_name'] );
			}
			echo '<tr><td data-export-label="' . esc_attr( $page_name ) . '">' . wp_kses_post( $page_name ) . ':</td>';
			/* Translators: %s: page name. */
			echo '<td class="help">' . wc_help_tip( sprintf( esc_html__( 'The URL of your %s page (along with the Page ID).', 'woocommerce' ), $page_name ) ) . '</td><td>';
			// Page ID check.
			if ( ! $page['page_set'] ) {
				echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . esc_html__( 'Page not set', 'woocommerce' ) . '</mark>';
				$error = true;
			} elseif ( ! $page['page_exists'] ) {
				echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . esc_html__( 'Page ID is set, but the page does not exist', 'woocommerce' ) . '</mark>';
				$error = true;
			} elseif ( ! $page['page_visible'] ) {
				/* Translators: %s: docs link. */
				echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . wp_kses_post( sprintf( __( 'Page visibility should be <a href="%s" target="_blank">public</a>', 'woocommerce' ), 'https://codex.wordpress.org/Content_Visibility' ) ) . '</mark>';
				$error = true;
			} else {
				// Shortcode check.
				if ( $page['shortcode_required'] ) {
					if ( ! $page['shortcode_present'] ) {
						echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( esc_html__( 'Page does not contain the shortcode.', 'woocommerce' ), esc_html( $page['shortcode'] ) ) . '</mark>';
						$error = true;
					}
				}
			}
			if ( ! $error ) {
				echo '<mark class="yes">#' . absint( $page['page_id'] ) . ' - ' . esc_html( str_replace( home_url(), '', get_permalink( $page['page_id'] ) ) ) . '</mark>';
			}
			echo '</td></tr>';
		}
		?>
	</tbody>
</table>

<?php do_action( 'woocommerce_system_status_report' ); ?>
