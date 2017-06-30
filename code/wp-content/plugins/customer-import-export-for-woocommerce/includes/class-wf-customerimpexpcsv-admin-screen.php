<?php
if (!defined('ABSPATH')) {
    exit;
}

class WF_CustomerImpExpCsv_Admin_Screen {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_print_styles', array($this, 'admin_scripts'));
        add_action('admin_notices', array($this, 'admin_notices'));

        add_action('admin_footer', array($this, 'add_user_bulk_actions'));
        //add_action('set-screen-option', array($this, 'add_user_bulk_actions'));
        add_action('load-users.php', array($this, 'process_users_bulk_actions'));
        add_action('bulk_actions-users', array($this, 'add_user_action'), 10, 2);
        if (is_admin()) {
            add_action('wp_ajax_wc_customer_csv_export_single', array($this, 'process_ajax_export_single_user'));
        }
    }

    /**
     * Notices in admin
     */
    public function admin_notices() {
        if (!function_exists('mb_detect_encoding')) {
            echo '<div class="error"><p>' . __('User/Customer CSV Import Export requires the function <code>mb_detect_encoding</code> to import and export CSV files. Please ask your hosting provider to enable this function.', 'wf_customer_import_export') . '</p></div>';
        }
    }

    /**
     * Admin Menu
     */
    public function admin_menu() {
        $page = add_users_page( __( 'User Import Export', 'wf_customer_import_export' ), __( 'User Import Export', 'wf_customer_import_export' ), 'list_users', 'hf_wordpress_customer_im_ex', array( $this, 'output' ) );
        $page1 = add_submenu_page( 'woocommerce', __( 'Customer Import Export', 'wf_customer_import_export' ), __( 'Customer Import Export', 'wf_customer_import_export' ),  'manage_woocommerce', 'hf_wordpress_customer_im_ex', array( $this, 'output' ) );
    }

    /**
     * Admin Scripts
     */
    public function admin_scripts() {
        global $wp_scripts;
        wp_enqueue_script('wc-enhanced-select');
        //wp_enqueue_script('chosen');
        if(function_exists('WC')){
        wp_enqueue_style('woocommerce_admin_styles', WC()->plugin_url() . '/assets/css/admin.css');
        }
        wp_enqueue_style('woocommerce-user-csv-importer', plugins_url(basename(plugin_dir_path(WF_CustomerImpExpCsv_FILE)) . '/styles/wf-style.css', basename(__FILE__)), '', '1.0.0', 'screen');

        wp_enqueue_script('woocommerce-user-csv-importer', plugins_url(basename(plugin_dir_path(WF_CustomerImpExpCsv_FILE)) . '/js/hf-user-csv-importer.js', basename(__FILE__)), array(), '2.0.0', true);
        wp_localize_script('woocommerce-user-csv-importer', 'woocommerce_user_csv_import_params', array('calendar_icon' => plugins_url(basename(plugin_dir_path(WF_CustomerImpExpCsv_FILE)) . '/images/calendar.png', basename(__FILE__))));
        wp_localize_script('woocommerce-user-csv-importer', 'woocommerce_user_csv_cron_params', array('usr_enable_ftp_ie' => '','usr_auto_export' => 'Disabled', 'usr_auto_import' => 'Disabled'));
        wp_enqueue_script('jquery-ui-datepicker');
        $jquery_version = isset($wp_scripts->registered['jquery-ui-core']->ver) ? $wp_scripts->registered['jquery-ui-core']->ver : '1.9.2';
        wp_enqueue_style('jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/' . $jquery_version . '/themes/smoothness/jquery-ui.css');
    }

    /**
     * Admin Screen output
     */
    public function output() {
        $tab = 'import';
        
        $plugin_name = 'customercsvimportexport';
	include('wf_api_manager/html/html-wf-activation-window.php' );
        
        if (!empty($_GET['tab'])) {
            if ($_GET['tab'] == 'export') {
                $tab = 'export';
            } else if ($_GET['tab'] == 'settings') {
                $tab = 'settings';
            }
        }
        include( 'views/html-wf-admin-screen.php' );
    }

    public function add_user_bulk_actions() {
        
        global $post_type, $post_status;

        $screen = get_current_screen();
        if ($screen->id != "users")   // Only add to users.php page
            return;
    ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    var $downloadToXml = $('<option>').val('hf_download_user_to_csv').text('<?php _e('Download as CSV', 'wf_customer_import_export') ?>');

                    $('select[name^="action"]').append($downloadToXml);
                });
            </script>
            <?php
       
    }

    /**
     * user page bulk export action
     * 
     */
    public function process_users_bulk_actions() {
        
        global $typenow;
        //if ($typenow == 'shop_user') {
            // get the action list
            $wp_list_table = _get_list_table('WP_Posts_List_Table');
            $action = $wp_list_table->current_action();
            if (!in_array($action, array('hf_download_user_to_csv'))) {
                return;
            }
            // security check
            //check_admin_referer('hf_download_user_to_csv');
            wp_verify_nonce( $_REQUEST['_wpnonce'], 'hf_download_user_to_csv' );

            if (isset($_REQUEST['users'])) {
                $user_ids = array_map('absint', $_REQUEST['users']);
            }
            if (empty($user_ids)) {
                return;
            }
            // give an unlimited timeout if possible
            @set_time_limit(0);

            if ($action == 'hf_download_user_to_csv') {
                include_once( 'exporter/class-wf-customerimpexpcsv-exporter.php' );
                WF_CustomerImpExpCsv_Exporter::do_export($user_ids);
            }
       // }
    }

    /**
     * Add single user download option on action list
     */
    public function add_user_action($actions) {

        //print_r($actions);exit;
        //echo "hellllllo";exit;
        $actions['hf_download_user_to_csv'] = 'Download as CSV';
        return $actions;
        //$url = wp_nonce_url(admin_url('admin-ajax.php?action=wc_customer_csv_export_single&user_id=' . $user->id), 'wc_customer_csv_export_single');
        //$name = __('Download to CSV', 'wf_customer_import_export');
        //printf('<a class="button tips %s" href="%s" data-tip="%s">%s</a>', $action, esc_url($url), $name, $name);
    }

    /**
     * Single user export
     */
    public function process_ajax_export_single_user() {

        
        if (!is_admin() || !current_user_can('edit_posts')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'wf_customer_import_export'));
        }
        if (!check_admin_referer('wc_customer_csv_export_single')) {
            wp_die(__('You have taken too long, please go back and try again.', 'wf_customer_import_export'));
        }
        $user_id = !empty($_GET['users']) ? absint($_GET['users']) : '';
        if (!$user_id) {
            die;
        }
        $user_IDS = array(0 => $user_id);
        include_once( 'exporter/class-wf-customerimpexpcsv-exporter.php' );
        WF_CustomerImpExpCsv_Exporter::do_export($user_IDS);
        wp_redirect(wp_get_referer());
        exit;
    }

    /**
     * Admin page for importing
     */
    public function admin_import_page() {
        include( 'views/html-wf-getting-started.php' );
        include( 'views/import/html-wf-import-customers.php' );
        $post_columns = include( 'exporter/data/data-wf-post-columns.php' );
        include( 'views/export/html-wf-export-customers.php' );
    }

    /**
     * Admin Page for exporting
     */
    public function admin_export_page() {
        $post_columns = include( 'exporter/data/data-wf-post-columns.php' );
        include( 'views/export/html-wf-export-customers.php' );
    }

    /**
     * Admin Page for settings
     */
    public function admin_settings_page() {
        include( 'views/settings/html-wf-settings-customers.php' );
    }

}

new WF_CustomerImpExpCsv_Admin_Screen();
