<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices(); ?>


<?php 

		wc_print_notices();

/**
 * My Account navigation.
 * @since 2.6.0
 */
do_action( 'woocommerce_account_navigation' ); ?>

<p class="myaccount_user">
	<?php
	printf(
		__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
		$current_user->display_name,
		wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
	);

	printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
		wc_customer_edit_account_url()
	);
	?>
</p>

<p>
	<?php
	printf(__( '<strong>Make your weekly meal plan selections on our<a href="http://www.myprepdmeals.com/meal-plan-order-form"> meal plan order page</a>.</strong>', 'woocommerce' ),
		wc_customer_edit_account_url()
	);
	?>
</p>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<div class="woocommerce_account_subscriptions">

	<?php if ( WC_Subscriptions::is_woocommerce_pre( '2.6' ) ) : ?>
	<h2><?php esc_html_e( 'My Subscriptions', 'woocommerce-subscriptions' ); ?></h2>
	<?php endif; ?>

	<?php if ( ! empty( $subscriptions ) ) : ?>
	<table class="shop_table shop_table_responsive my_account_subscriptions my_account_orders">

	<thead>
		<tr>
			<th class="subscription-id order-number"><span class="nobr"><?php esc_html_e( 'Subscription', 'woocommerce-subscriptions' ); ?></span></th>
			<th class="subscription-status order-status"><span class="nobr"><?php esc_html_e( 'Status', 'woocommerce-subscriptions' ); ?></span></th>
			<th class="subscription-next-payment order-date"><span class="nobr"><?php echo esc_html_x( 'Next Payment', 'table heading', 'woocommerce-subscriptions' ); ?></span></th>
			<th class="subscription-total order-total"><span class="nobr"><?php echo esc_html_x( 'Total', 'table heading', 'woocommerce-subscriptions' ); ?></span></th>
			<th class="subscription-actions order-actions">&nbsp;</th>
		</tr>
	</thead>

	<tbody>
	<?php foreach ( $subscriptions as $subscription_id => $subscription ) : ?>
		<tr class="order">
			<td class="subscription-id order-number" data-title="<?php esc_attr_e( 'ID', 'woocommerce-subscriptions' ); ?>">
				<a href="<?php echo esc_url( $subscription->get_view_order_url() ); ?>"><?php echo esc_html( sprintf( _x( '#%s', 'hash before order number', 'woocommerce-subscriptions' ), $subscription->get_order_number() ) ); ?></a>
				<?php do_action( 'woocommerce_my_subscriptions_after_subscription_id', $subscription ); ?>
			</td>
			<td class="subscription-status order-status" style="text-align:left; white-space:nowrap;" data-title="<?php esc_attr_e( 'Status', 'woocommerce-subscriptions' ); ?>">
				<?php echo esc_attr( wcs_get_subscription_status_name( $subscription->get_status() ) ); ?>
			</td>
			<td class="subscription-next-payment order-date" data-title="<?php echo esc_attr_x( 'Next Payment', 'table heading', 'woocommerce-subscriptions' ); ?>">
				<?php echo esc_attr( $subscription->get_date_to_display( 'next_payment' ) ); ?>
				<?php if ( ! $subscription->is_manual() && $subscription->has_status( 'active' ) && $subscription->get_time( 'next_payment' ) > 0 ) : ?>
					<?php
					// translators: placeholder is the display name of a payment gateway a subscription was paid by
					$payment_method_to_display = sprintf( __( 'Via %s', 'woocommerce-subscriptions' ), $subscription->get_payment_method_to_display() );
					$payment_method_to_display = apply_filters( 'woocommerce_my_subscriptions_payment_method', $payment_method_to_display, $subscription );
					?>
				<br/><small><?php echo esc_attr( $payment_method_to_display ); ?></small>
				<?php endif; ?>
			</td>
			<td class="subscription-total order-total" data-title="<?php echo esc_attr_x( 'Total', 'Used in data attribute. Escaped', 'woocommerce-subscriptions' ); ?>">
				<?php echo wp_kses_post( $subscription->get_formatted_order_total() ); ?>
			</td>
			<td class="subscription-actions order-actions">
				<a href="<?php echo esc_url( $subscription->get_view_order_url() ) ?>" class="button view"><?php echo esc_html_x( 'View', 'view a subscription', 'woocommerce-subscriptions' ); ?></a>
				<?php do_action( 'woocommerce_my_subscriptions_actions', $subscription ); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>

	</table>
	<?php else : ?>

		<p class="no_subscriptions">
		<p>It looks like you do not have any active subscriptions. <a href="https://www.myprepdmeals.com/my-account/subscriptions/">Renew</a></p>
		
		</p>

	<?php endif; ?>

</div>

<?php do_action( 'woocommerce_after_my_account' ); ?>

