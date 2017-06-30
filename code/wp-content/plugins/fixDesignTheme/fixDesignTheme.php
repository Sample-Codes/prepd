<?php
/**
 * @package fixDesignTheme
 * @version 1.0
 */
/*
Plugin Name: fixDesignTheme
Plugin URI: no
Description: fixDesignTheme
Author: test
Version: 1.0
Author URI: fixDesignTheme
*/

function fixDesignTheme_script()  
{  
    // Register the script like this for a plugin:  
    wp_register_script( 'fixDesignTheme-script', plugins_url( '/js/fixDesignTheme-script.js', __FILE__ ),array( 'jquery' ),'',true );  
   
 
    wp_enqueue_script( 'fixDesignTheme-script' );  
}  
add_action( 'wp_enqueue_scripts', 'fixDesignTheme_script' );




?>
