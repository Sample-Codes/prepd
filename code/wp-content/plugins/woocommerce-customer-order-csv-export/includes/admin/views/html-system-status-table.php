<?php
/**
 * WooCommerce Customer/Order CSV Export
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Customer/Order CSV Export to newer
 * versions in the future. If you wish to customize WooCommerce Customer/Order CSV Export for your
 * needs please refer to http://docs.woothemes.com/document/ordercustomer-csv-exporter/
 *
 * @package     WC-Customer-Order-CSV-Export/Admin/Views
 * @author      SkyVerge
 * @copyright   Copyright (c) 2012-2016, SkyVerge, Inc.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

defined( 'ABSPATH' ) or exit;

/**
 * System Status table
 *
 * @since 3.11.0
 * @version 3.11.0
 */
?>

<table class="wc_status_table widefat" cellspacing="0" id="wc-customer-order-csv-export-status">
	<thead>
		<tr>
			<th colspan="3" data-export-label="Customer/Order CSV Export"><?php _e( 'Customer/Order CSV Export', 'woocommerce-customer-order-csv-export' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td data-export-label="Order Export Format"><?php _e( 'Order Export Format', 'woocommerce-customer-order-csv-export' ); ?>:</td>
			<td class="help"><?php echo SV_WC_Plugin_Compatibility::wc_help_tip( __( 'The selected order export format.', 'woocommerce-customer-order-csv-export' ) ); ?></td>
			<td><?php echo esc_html( get_option( 'wc_customer_order_csv_export_order_format' ) ); ?></td>
		</tr>

		<tr>
			<td data-export-label="Customer Export Format"><?php _e( 'Customer Export Format', 'woocommerce-customer-order-csv-export' ); ?>:</td>
			<td class="help"><?php echo SV_WC_Plugin_Compatibility::wc_help_tip( __( 'The selected customer export format.', 'woocommerce-customer-order-csv-export' ) ); ?></td>
			<td><?php echo esc_html( get_option( 'wc_customer_order_csv_export_customer_format' ) ); ?></td>
		</tr>

		<?php $auto_export_orders = get_option( 'wc_customer_order_csv_export_auto_export_method' ); ?>

		<tr>
			<td data-export-label="Automatically Export Orders"><?php _e( 'Automatically Export Orders', 'woocommerce-customer-order-csv-export' ); ?>:</td>
			<td class="help"><?php echo SV_WC_Plugin_Compatibility::wc_help_tip( __( 'The automatic export method if enabled.', 'woocommerce-customer-order-csv-export' ) ); ?></td>
			<td><?php echo esc_html( $auto_export_orders ); ?></td>
		</tr>

		<?php if ( 'disabled' !== $auto_export_orders ) : ?>

			<tr>
				<td data-export-label="Export Start Time"><?php _e( 'Export Start Time', 'woocommerce-customer-order-csv-export' ); ?>:</td>
				<td class="help"><?php echo SV_WC_Plugin_Compatibility::wc_help_tip( __( 'The automatic export start time.', 'woocommerce-customer-order-csv-export' ) ); ?></td>
				<td><?php echo esc_html( get_option( 'wc_customer_order_csv_export_auto_export_start_time' ) ); ?></td>
			</tr>

			<tr>
				<td data-export-label="Export Interval"><?php _e( 'Export Interval (minutes)', 'woocommerce-customer-order-csv-export' ); ?>:</td>
				<td class="help"><?php echo SV_WC_Plugin_Compatibility::wc_help_tip( __( 'The automatic export start interval in minutes.', 'woocommerce-customer-order-csv-export' ) ); ?></td>
				<td><?php echo esc_html( get_option( 'wc_customer_order_csv_export_auto_export_interval' ) ); ?></td>
			</tr>

			<tr>
				<td data-export-label="Next Export"><?php _e( 'Next Export', 'woocommerce-customer-order-csv-export' ); ?>:</td>
				<td class="help"><?php echo SV_WC_Plugin_Compatibility::wc_help_tip( __( 'The automatic export start interval in minutes.', 'woocommerce-customer-order-csv-export' ) ); ?></td>
				<td>
					<?php
						if ( $scheduled_timestamp = wp_next_scheduled( 'wc_customer_order_csv_export_auto_export_orders' ) ) {
							$scheduled_desc = sprintf( __( 'Scheduled on %s', 'woocommerce-customer-order-csv-export' ), get_date_from_gmt( date( 'Y-m-d H:i:s', $scheduled_timestamp ), wc_date_format() . ' ' . wc_time_format() ) );
						} else {
							$scheduled_desc = sprintf( __( '%1$sNot scheduled%2$s', 'woocommerce-customer-order-csv-export' ), '<mark class="error">', '</mark>');
						}
						echo $scheduled_desc;
					?>
				</td>
			</tr>

			<tr>
				<td data-export-label="Order Statuses"><?php _e( 'Order Statuses', 'woocommerce-customer-order-csv-export' ); ?>:</td>
				<td class="help"><?php echo SV_WC_Plugin_Compatibility::wc_help_tip( __( 'The order statuses to be included in the automatic export.', 'woocommerce-customer-order-csv-export' ) ); ?></td>
				<td><?php echo esc_html( implode( ', ', get_option( 'wc_customer_order_csv_export_auto_export_statuses' ) ) ); ?></td>
			</tr>

		<?php endif; ?>
	</tbody>
</table>
