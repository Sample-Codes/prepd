<?php
require_once ('../../../../wp-load.php');

global $wpdb;
$updated_meals_order=$order_item_id=$json['success']=$order_status=$subscription_order_status=$subscription_order_item_id= "";

if (isset($_REQUEST) && !empty($_REQUEST)) {

    $updated_meals_order 		= $_REQUEST['updated_meals_order']; 
    $order_item_id 	        	= $_REQUEST['order_item_id'];
    $subscription_order_item_id = $_REQUEST['subscription_order_item_id'];
	$order_status 			    = wc_update_order_item_meta($order_item_id,'meals_order',$updated_meals_order);
	$subscription_order_status  = wc_update_order_item_meta($subscription_order_item_id,'meals_order',$updated_meals_order);

	if ( $order_status == 1 && $subscription_order_status == 1 ){
		$json['success'] = "Yes";
	}else{
		$json['success'] = "No";
	}
}else{
	$json['success'] = "No";
}
header('Content-Type: application/json');
echo json_encode($json);
exit;
?>