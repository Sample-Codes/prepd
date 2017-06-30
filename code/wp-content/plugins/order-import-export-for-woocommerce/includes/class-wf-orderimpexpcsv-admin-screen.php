<?php
if (!defined('ABSPATH')) {
    exit;
}

class WF_OrderImpExpCsv_Admin_Screen {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_print_styles', array($this, 'admin_scripts'));
        add_action('admin_notices', array($this, 'admin_notices'));

        add_action('admin_footer-edit.php', array($this, 'add_order_bulk_actions'));
        add_action('load-edit.php', array($this, 'process_order_bulk_actions'));
        add_action('woocommerce_admin_order_actions_end', array($this, 'add_order_action'), 10, 2);
        if (is_admin()) {
            add_action('wp_ajax_wc_order_csv_export_single', array($this, 'process_ajax_export_single_order'));
        }
    }

    /**
     * Notices in admin
     */
    public function admin_notices() {
        if (!function_exists('mb_detect_encoding')) {
            echo '<div class="error"><p>' . __('Order CSV Import Export requires the function <code>mb_detect_encoding</code> to import and export CSV files. Please ask your hosting provider to enable this function.', 'wf_order_import_export') . '</p></div>';
        }
    }

    /**
     * Admin Menu
     */
    public function admin_menu() {
        $page = add_submenu_page('woocommerce', __('Order Im-Ex', 'wf_order_import_export'), __('Order Im-Ex', 'wf_order_import_export'), apply_filters('woocommerce_csv_order_role', 'manage_woocommerce'), 'wf_woocommerce_order_im_ex', array($this, 'output'));
    }

    /**
     * Admin Scripts
     */
    public function admin_scripts() {
        global $wp_scripts;
        wp_enqueue_script('wc-enhanced-select');
        //wp_enqueue_script('chosen');
        wp_enqueue_style('woocommerce_admin_styles', WC()->plugin_url() . '/assets/css/admin.css');
        wp_enqueue_style('woocommerce-order-csv-importer', plugins_url(basename(plugin_dir_path(WF_OrderImpExpCsv_FILE)) . '/styles/wf-style.css', basename(__FILE__)), '', '1.0.0', 'screen');

        wp_enqueue_script('woocommerce-order-csv-importer', plugins_url(basename(plugin_dir_path(WF_OrderImpExpCsv_FILE)) . '/js/woocommerce-order-csv-importer.js', basename(__FILE__)), array(), '2.0.0', true);
        wp_localize_script('woocommerce-order-csv-importer', 'woocommerce_order_csv_import_params', array('calendar_icon' => plugins_url(basename(plugin_dir_path(WF_OrderImpExpCsv_FILE)) . '/images/calendar.png', basename(__FILE__))));
        wp_localize_script('woocommerce-order-csv-importer', 'woocommerce_order_csv_cron_params', array('ord_enable_ftp_ie' => '','ord_auto_export' => 'Disabled', 'ord_auto_import' => 'Disabled'));
		
        
        wp_enqueue_script('jquery-ui-datepicker');
        $jquery_version = isset($wp_scripts->registered['jquery-ui-core']->ver) ? $wp_scripts->registered['jquery-ui-core']->ver : '1.9.2';
        wp_enqueue_style('jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/' . $jquery_version . '/themes/smoothness/jquery-ui.css');
    }

    /**
     * Admin Screen output
     */
    public function output() {
        $tab = 'import';
		$plugin_name = 'ordercsvimportexport';
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

    public function add_order_bulk_actions() {
        global $post_type, $post_status;

        if ($post_type == 'shop_order' && $post_status != 'trash') {
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    var $downloadToXml = $('<option>').val('download_to_csv_wf').text('<?php _e('Download as CSV', 'wf_order_import_export') ?>');

                    $('select[name^="action"]').append($downloadToXml);
                });
            </script>
            <?php
        }
    }

    /**
     * Order page bulk export action
     * 
     */
    public function process_order_bulk_actions() {
        global $typenow;
        if ($typenow == 'shop_order') {
            // get the action list
            $wp_list_table = _get_list_table('WP_Posts_List_Table');
            $action = $wp_list_table->current_action();
            if (!in_array($action, array('download_to_csv_wf'))) {
                return;
            }
            // security check
            check_admin_referer('bulk-posts');

            if (isset($_REQUEST['post'])) {
                $order_ids = array_map('absint', $_REQUEST['post']);
            }
            if (empty($order_ids)) {
                return;
            }
            // give an unlimited timeout if possible
            @set_time_limit(0);

            if ($action == 'download_to_csv_wf') {
                include_once( 'exporter/class-wf-orderimpexpcsv-exporter.php' );
                WF_OrderImpExpCsv_Exporter::do_export('shop_order', $order_ids);
            }
        }
    }

    /**
     * Add single order download option on action list
     */
    public function add_order_action($order) {

        $action = 'download_to_csv_wf';
        $url = wp_nonce_url(admin_url('admin-ajax.php?action=wc_order_csv_export_single&order_id=' . $order->id), 'wc_order_csv_export_single');
        $name = __('Download to CSV', 'wf_order_import_export');
        printf('<a class="button tips %s" href="%s" data-tip="%s">%s</a>', $action, esc_url($url), $name, $name);
    }

    /**
     * Single order export
     */
    public function process_ajax_export_single_order() {

        if (!is_admin() || !current_user_can('edit_posts')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'wf_order_import_export'));
        }
        if (!check_admin_referer('wc_order_csv_export_single')) {
            wp_die(__('You have taken too long, please go back and try again.', 'wf_order_import_export'));
        }
        $order_id = !empty($_GET['order_id']) ? absint($_GET['order_id']) : '';
        if (!$order_id) {
            die;
        }
        $order_IDS = array(0 => $order_id);
        include_once( 'exporter/class-wf-orderimpexpcsv-exporter.php' );
        WF_OrderImpExpCsv_Exporter::do_export('shop_order', $order_IDS);
        wp_redirect(wp_get_referer());
        exit;
    }

    /**
     * Admin page for importing
     */
    public function admin_import_page() {
        include( 'views/html-wf-getting-started.php' );
        include( 'views/import/html-wf-import-orders.php' );
        $post_columns = include( 'exporter/data/data-wf-post-columns.php' );
        include( 'views/export/html-wf-export-orders.php' );
    }

    /**
     * Admin Page for exporting
     */
    public function admin_export_page() {
        $post_columns = include( 'exporter/data/data-wf-post-columns.php' );
        include( 'views/export/html-wf-export-orders.php' );
    }

    /**
     * Admin Page for settings
     */
    public function admin_settings_page() {
        include( 'views/settings/html-wf-all-settings.php' );
    }

}

new WF_OrderImpExpCsv_Admin_Screen();
