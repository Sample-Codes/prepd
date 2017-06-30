<?php
if (!defined('ABSPATH')) {
    exit;
}

$columns = array(
    'ID' => 'ID  | Customer/User ID ',
    'customer_id' => 'Customer ID | Customer ID',
    'user_login' => 'User Login | User Login',
    'user_pass' => 'user_pass | user_pass',
    'user_nicename' => 'user_nicename | user_nicename',
    'user_email' => 'user_email | user_email',
    'user_url' => 'user_url | user_url',
    'user_registered' => 'user_registered | user_registered',
    'display_name' => 'display_name | display_name',
    'first_name' => 'first_name | first_name',
    'last_name' => 'last_name | last_name',
    'user_status' => 'user_status | user_status',
    'roles' => 'roles | roles'
);

if( is_plugin_active( 'woocommerce/woocommerce.php' ) ):
    
    $columns['billing_first_name'] = 'billing_first_name';
    $columns['billing_last_name'] = 'billing_last_name';
    $columns['billing_company'] = 'billing_company';
    $columns['billing_email'] = 'billing_email';
    $columns['billing_phone'] = 'billing_phone';
    $columns['billing_address_1'] = 'billing_address_1';
    $columns['billing_address_2'] = 'billing_address_2';
    $columns['billing_postcode'] = 'billing_postcode';
    $columns['billing_city'] = 'billing_city';
    $columns['billing_state'] = 'billing_state';
    $columns['billing_country'] = 'billing_country';
    $columns['shipping_first_name'] = 'shipping_first_name';
    $columns['shipping_last_name'] = 'shipping_last_name';
    $columns['shipping_company'] = 'shipping_company';
    $columns['shipping_address_1'] = 'shipping_address_1';
    $columns['shipping_address_2'] = 'shipping_address_2';
    $columns['shipping_postcode'] = 'shipping_postcode';
    $columns['shipping_city'] = 'shipping_city';
    $columns['shipping_state'] = 'shipping_state';
    $columns['shipping_country'] = 'shipping_country';
    
endif;

global $wpdb;

$meta_keys = $wpdb->get_results("SELECT distinct(meta_key) FROM $wpdb->usermeta");
// get meta_key value from object ##
$meta_keys = wp_list_pluck($meta_keys, 'meta_key');

foreach ($meta_keys as $meta_key) {
    if (empty($columns[$meta_key])) {
        $columns[$meta_key] = $meta_key;
    }
}
return apply_filters('hf_csv_customer_import_columns', $columns);