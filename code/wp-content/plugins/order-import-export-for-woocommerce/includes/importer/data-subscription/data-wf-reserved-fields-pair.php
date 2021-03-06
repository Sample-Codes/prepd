<?php

if (!defined('ABSPATH')) {
    exit;
}
// Reserved column names
return apply_filters('hf_csv_subscription_alter_order_data_columns', array(
    'subscription_id' => 'Subscription ID | Subscription ID',
    'subscription_status' => 'Subscription Status | Subscription Status ',
    'customer_id' => 'Customer ID | Customer ID',
    'customer_username' => 'customer_username | ',
    'customer_email'           => 'customer_email | ',
    'start_date' => 'Start Date | Start Date ',
    'trial_end_date' => 'Trial End Date | Trial End Date',
    'next_payment_date' => 'Next Payment Date | Next Payment Date',
    'last_payment_date' => 'Last Payment Date | Last Payment Date',
    'end_date' => 'End Date | End Date ',
    'post_parent' => 'Parent OrderID | Parent order id ',
    'billing_period' => 'Billing Period | Billing Period ',
    'billing_interval' => 'Billing Interval | Billing Interval ',
    'order_shipping' => 'Total Shipping | Total Shipping ',
    'order_shipping_tax' => 'Total Shipping Tax | Total Shipping Tax ',
    'fee_total' => 'Total Subscription Fees | Total Subscription Fees ',
    'fee_tax_total' => 'Total Fees Tax | Total Fees Tax ',
    'order_tax' => 'Subscription Total Tax | Subscription Total Tax ',
    'cart_discount' => 'Total Discount | Total Discount ',
    'cart_discount_tax' => 'Total Discount Tax | Total Discount Tax ',
    'order_total' => 'Subscription Total | Subscription Total ',
    'order_currency' => 'Subscription Currency | Subscription Currency ',
    'payment_method' => 'Payment Method | Payment Method',
    'payment_method_title' => 'Payment Method Title | Payment Method Title',
    'payment_method_post_meta' => 'Payment Method Post Meta | Payment Method Post Meta ',
    'payment_method_user_meta' => 'Payment Method User Meta | Payment Method User Meta ',
    'shipping_method' => 'Shipping Method | Shipping Method ',
    'billing_first_name' => 'Billing First Name | Billing First Name ',
    'billing_last_name' => 'Billing Last Name | Billing Last Name ',
    'billing_email' => 'Billing Email | Billing Email ',
    'billing_phone' => 'Billing Phone | Billing Phone ',
    'billing_address_1' => 'Billing Address 1 | Billing Address 1 ',
    'billing_address_2' => 'Billing Address 2 | Billing Address 2 ',
    'billing_postcode' => 'Billing Postcode | Billing Postcode',
    'billing_city' => 'Billing City | Billing City',
    'billing_state' => 'Billing State | Billing State',
    'billing_country' => 'Billing Country | Billing Country',
    'billing_company' => 'Billing Company | Billing Company ',
    'shipping_first_name' => 'Shipping First Name | Shipping First Name',
    'shipping_last_name' => 'Shipping Last Name | Shipping Last Name',
    'shipping_address_1' => 'Shipping Address 1 | Shipping Address 1',
    'shipping_address_2' => 'Shipping Address 2 | Shipping Address 2',
    'shipping_postcode' => 'Shipping Post code | Shipping Post code',
    'shipping_city' => 'Shipping City | Shipping City',
    'shipping_state' => 'Shipping State | Shipping State ',
    'shipping_country' => 'Shipping Country | Shipping Country',
    'shipping_company' => 'Shipping Company | Shipping Company ',
    'customer_note' => 'Customer Note | Customer Note',
    'order_items' => 'Subscription Items | Subscription Items ',
    'order_notes' => 'Subscription order notes | Subscription order notes ',
    'coupon_items' => 'Coupons | Coupons  ',
    'fee_items' => 'Fees | Fees ',
    'tax_items' => 'Taxes | Taxes',
    'download_permissions' => 'Download Permissions Granted | Permissions for order items will automatically be granted when the order status changes to processing or completed.'
        )
);
