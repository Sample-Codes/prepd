<?php
/*
Plugin Name: Easy Slide-In for WordPress
Plugin URI: http://codecanyon.net/item/easy-slidein-for-wordpress/7742759?ref=appscreo
Description: Create and manage beautiful marketing messages with Easy Slide-In for WordPress
Version: 2.1
Author: CreoApps
Author URI: http://codecanyon.net/user/appscreo/portfolio?ref=appscreo
*/

define ('ESI_VERSION', '2.1');
define ('ESI_PLUGIN_SELF_DIRNAME', basename(dirname(__FILE__)), true);
define ('ESI_PROTOCOL', (@$_SERVER["HTTPS"] == 'on' ? 'https://' : 'http://'), true);

//Setup proper paths/URLs and load text domains
if (is_multisite() && defined('WPMU_PLUGIN_URL') && defined('WPMU_PLUGIN_DIR') && file_exists(WPMU_PLUGIN_DIR . '/' . basename(__FILE__))) {
	define ('ESI_PLUGIN_LOCATION', 'mu-plugins', true);
	define ('ESI_PLUGIN_BASE_DIR', WPMU_PLUGIN_DIR, true);
	define ('ESI_PLUGIN_URL', str_replace('http://', ESI_PROTOCOL, WPMU_PLUGIN_URL), true);
	$textdomain_handler = 'load_muplugin_textdomain';
} else if (defined('WP_PLUGIN_URL') && defined('WP_PLUGIN_DIR') && file_exists(WP_PLUGIN_DIR . '/' . ESI_PLUGIN_SELF_DIRNAME . '/' . basename(__FILE__))) {
	define ('ESI_PLUGIN_LOCATION', 'subfolder-plugins', true);
	define ('ESI_PLUGIN_BASE_DIR', WP_PLUGIN_DIR . '/' . ESI_PLUGIN_SELF_DIRNAME, true);
	define ('ESI_PLUGIN_URL', str_replace('http://', ESI_PROTOCOL, WP_PLUGIN_URL) . '/' . ESI_PLUGIN_SELF_DIRNAME, true);
	$textdomain_handler = 'load_plugin_textdomain';
} else if (defined('WP_PLUGIN_URL') && defined('WP_PLUGIN_DIR') && file_exists(WP_PLUGIN_DIR . '/' . basename(__FILE__))) {
	define ('ESI_PLUGIN_LOCATION', 'plugins', true);
	define ('ESI_PLUGIN_BASE_DIR', WP_PLUGIN_DIR, true);
	define ('ESI_PLUGIN_URL', str_replace('http://', ESI_PROTOCOL, WP_PLUGIN_URL), true);
	$textdomain_handler = 'load_plugin_textdomain';
} else {
	wp_die(__('There was an issue with plugin installation. Please reinstall.'));
}
$textdomain_handler('esi', false, ESI_PLUGIN_SELF_DIRNAME . '/languages/');


require_once ESI_PLUGIN_BASE_DIR . '/lib/class_esi_mailchimp.php';
require_once ESI_PLUGIN_BASE_DIR . '/lib/class_esi_options.php';
require_once ESI_PLUGIN_BASE_DIR . '/lib/esi-helper.php';
require_once ESI_PLUGIN_BASE_DIR . '/lib/helpers/esi-mobile-detect.php';
require_once ESI_PLUGIN_BASE_DIR . '/optin-forms-manager/optin-forms-manager.php';

require_once ESI_PLUGIN_BASE_DIR . '/lib/class_esi_slide_in.php';
Easy_SlideIn::init();

if (is_admin()) {
	require_once ESI_PLUGIN_BASE_DIR . '/lib/class_esi_admin_form_renderer.php';
	require_once ESI_PLUGIN_BASE_DIR . '/lib/class_esi_admin_pages.php';
	ESI_AdminPages::serve();
} else {
	require_once ESI_PLUGIN_BASE_DIR . '/lib/class_esi_public_pages.php';
	ESI_PublicPages::serve();
}