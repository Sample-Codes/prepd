<?php
require_once ('../../../../wp-load.php');
global $wpdb;
$zipcode = "";
$flag = true;
$message=$zipcode_arr= array();

//if (is_ajax_request()) {
    header('Content-Type: application/json');
    
    if (isset($_POST)) {
        
        if(isset($_POST['zipcode'])) {
            $zipcode = $_POST['zipcode'];
            $zipcode_arr = $wpdb->get_results( "SELECT * FROM wp_meals_delivery_locations WHERE zipcode = ".$zipcode."", OBJECT );

            if(count($zipcode_arr) > 0){
                 $flag = true;
            }else{
                 $flag = false;
            }
           
        } else {
            $flag = false;
        }
        
    } else {
        $flag = false;
    }
    echo json_encode($flag);
    exit();
//} else {
   // header("Location: index.php");
//}