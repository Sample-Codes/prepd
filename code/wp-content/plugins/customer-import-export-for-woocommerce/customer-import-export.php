<?php

/*
  Plugin Name: WordPress Users & WooCommerce Customers Import Export
  Plugin URI: https://www.xadapter.com/product/wordpress-users-woocommerce-customers-import-export/
  Description: Export and Import User/Customers details From and To your WordPress/WooCommerce.
  Author: HikeForce
  Author URI: https://www.xadapter.com/vendor/hikeforce/
  Version: 1.0.7
  Text Domain: wf_customer_import_export
 */



if (!defined('ABSPATH') || !is_admin()) {
    return;
}

define("WF_CUSTOMER_IMP_EXP_ID", "wf_customer_imp_exp");
define("HF_WORDPRESS_CUSTOMER_IM_EX", "hf_wordpress_customer_im_ex");


if (!class_exists('WF_Customer_Import_Export_CSV')) :

    /*
     * Main CSV Import class
     */

    class WF_Customer_Import_Export_CSV {

        /**
         * Constructor
         */
        public function __construct() {
            define('WF_CustomerImpExpCsv_FILE', __FILE__);

            if (is_admin()) {
                add_action('admin_notices', array($this, 'wf_customer_ie_admin_notice'), 15);
                include_once ( 'includes/wf_api_manager/wf-api-manager-config.php' );
            }

            add_filter('woocommerce_screen_ids', array($this, 'woocommerce_screen_ids'));
            add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'wf_plugin_action_links'));
            add_action('init', array($this, 'load_plugin_textdomain'));
            add_action('init', array($this, 'catch_export_request'), 20);
            add_action('init', array($this, 'catch_save_settings'), 20);
            add_action('admin_init', array($this, 'register_importers'));

            include_once( 'includes/class-wf-customerimpexpcsv-admin-screen.php' );
            include_once( 'includes/importer/class-wf-customerimpexpcsv-importer.php' );

            
                require_once( 'includes/class-wf-customerimpexpcsv-cron.php' );
                $this->cron_export = new WF_CustomerImpExpCsv_Cron();
                //$this->cron_export->wf_scheduled_export_user();
                register_activation_hook(__FILE__, array($this->cron_export, 'wf_new_scheduled_export_user'));
                register_deactivation_hook(__FILE__, array($this->cron_export, 'clear_wf_scheduled_export_user'));

                require_once( 'includes/class-wf-customerimpexpcsv-import-cron.php' );
                $this->cron_import = new WF_CustomerImpExpCsv_ImportCron();
                //$this->cron_import->wf_scheduled_import_user();
                register_activation_hook(__FILE__, array($this->cron_import, 'wf_new_scheduled_import_user'));
                register_deactivation_hook(__FILE__, array($this->cron_import, 'clear_wf_scheduled_import_user'));
            
            
            if (defined('DOING_AJAX')) {
                include_once( 'includes/class-wf-customerimpexpcsv-ajax-handler.php' );
            }
        }

        public function wf_plugin_action_links($links) {
            $plugin_links = array(
                '<a href="' . admin_url('admin.php?page=hf_wordpress_customer_im_ex') . '">' . __('Import Export Users/Customers', 'wf_customer_import_export') . '</a>',
                '<a href="http://www.xadapter.com/support/forum/wordpress-users-woocommerce-customers-import-export/">' . __('Support', 'wf_customer_import_export') . '</a>',
            );
            return array_merge($plugin_links, $links);
        }

        function wf_customer_ie_admin_notice() {
            global $pagenow;
            global $post;

            if (!isset($_GET["wf_customer_ie_msg"]) && empty($_GET["wf_customer_ie_msg"])) {
                return;
            }

            $wf_customer_ie_msg = $_GET["wf_customer_ie_msg"];

            switch ($wf_customer_ie_msg) {
                case "1":
                    echo '<div class="update"><p>' . __('Successfully uploaded via FTP.', 'wf_customer_import_export') . '</p></div>';
                    break;
                case "2":
                    echo '<div class="error"><p>' . __('Error while uploading via FTP.', 'wf_customer_import_export') . '</p></div>';
                    break;
            }
        }

        /**
         * Add screen ID
         */
        public function woocommerce_screen_ids($ids) {
            $ids[] = 'admin'; // For import screen
            return $ids;
        }

        /**
         * Handle localisation
         */
        public function load_plugin_textdomain() {
            load_plugin_textdomain('wf_customer_import_export', false, dirname(plugin_basename(__FILE__)) . '/lang/');
        }

        /**
         * Catches an export request and exports the data. This class is only loaded in admin.
         */
        public function catch_export_request() {
            if (!empty($_GET['action']) && !empty($_GET['page']) && $_GET['page'] == 'hf_wordpress_customer_im_ex') {
                switch ($_GET['action']) {
                    case "export" :
                        include_once( 'includes/exporter/class-wf-customerimpexpcsv-exporter.php' );
                        WF_CustomerImpExpCsv_Exporter::do_export();
                        break;
                }
            }
        }

        public function catch_save_settings() {
            if (!empty($_GET['action']) && !empty($_GET['page']) && $_GET['page'] == 'hf_wordpress_customer_im_ex') {
                switch ($_GET['action']) {
                    case "settings" :
                        include_once( 'includes/settings/class-wf-customerimpexpcsv-settings.php' );
                        WF_CustomerImpExpCsv_Settings::save_settings();
                        break;
                }
            }
        }

        /**
         * Register importers for use
         */
        public function register_importers() {
            register_importer('wordpress_hf_user_csv', 'WordPress User/Customers (CSV)', __('Import <strong>users/customers</strong> to your site via a csv file.', 'wf_customer_import_export'), 'WF_CustomerImpExpCsv_Importer::customer_importer');
            register_importer('wordpress_hf_user_csv_cron', 'WordPress User/Customers Cron(CSV)', __('Cron Import <strong>users and customers</strong> to your store via a csv file.', 'wf_customer_import_export'), 'WF_CustomerImpExpCsv_ImportCron::user_importer');
        }

    }

    endif;

new WF_Customer_Import_Export_CSV();

