<?php

if (!defined('ABSPATH')) {
    exit;
}

class WF_CustomerImpExpCsv_Exporter {

    /**
     * Customer Exporter Tool
     */
    public static function do_export($user_IDS = array()) {
        global $wpdb;

        $export_limit = !empty($_POST['limit']) ? intval($_POST['limit']) : 999999999;
        $export_offset = !empty($_POST['offset']) ? intval($_POST['offset']) : 0;
        $csv_columns = include( 'data/data-wf-post-columns.php' );

        $user_columns_name = !empty($_POST['columns_name']) ? $_POST['columns_name'] : $csv_columns;
        $export_columns = !empty($_POST['columns']) ? $_POST['columns'] : array();

        $export_user_roles = !empty($_POST['user_roles']) ? $_POST['user_roles'] : array();
        $delimiter = !empty($_POST['delimiter']) ? $_POST['delimiter'] : ',';

        $settings = get_option('woocommerce_' . WF_CUSTOMER_IMP_EXP_ID . '_settings', null);
        $ftp_server = isset($settings['ftp_server']) ? $settings['ftp_server'] : '';
        $ftp_user = isset($settings['ftp_user']) ? $settings['ftp_user'] : '';
        $ftp_password = isset($settings['ftp_password']) ? $settings['ftp_password'] : '';
        $use_ftps = isset($settings['use_ftps']) ? $settings['use_ftps'] : '';
        $usr_enable_ftp_ie = isset($settings['usr_enable_ftp_ie']) ? $settings['usr_enable_ftp_ie'] : '';



        $wpdb->hide_errors();
        @set_time_limit(0);
        if (function_exists('apache_setenv'))
            @apache_setenv('no-gzip', 1);
        @ini_set('zlib.output_compression', 0);
        @ob_clean();

        if ($usr_enable_ftp_ie) {
            $file = "Customer-Export-" . date('Y_m_d_H_i_s', current_time('timestamp')) . ".csv";
            $fp = fopen($file, 'w');
        } else {
            header('Content-Type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename=Customer-Export-' . date('Y_m_d_H_i_s', current_time('timestamp')) . ".csv");
            header('Pragma: no-cache');
            header('Expires: 0');

            $fp = fopen('php://output', 'w');
        }


        $args = array(
            'fields' => 'ID', // exclude standard wp_users fields from get_users query -> get Only ID##
            'role__in' => $export_user_roles, //An array of role names. Matched users must have at least one of these roles. Default empty array.
            'number' => $export_limit, // number of users to retrieve
            'offset' => $export_offset // offset to skip from list
        );
        
        if (!empty($user_IDS)) {
            $args['include'] = $user_IDS; // An array of user IDs to include. Default empty array.
        }

        add_action('pre_user_query', array(__CLASS__, 'pre_user_query'), 20);

        $users = get_users($args);

        remove_action('pre_user_query', array(__CLASS__, 'pre_user_query'), 20);
        
        // Variable to hold the CSV data we're exporting
        $row = array();

        // Export header rows
        foreach ($csv_columns as $column => $value) {
            $temp_head = esc_attr($user_columns_name[$column]);
            if (!$export_columns || in_array($column, $export_columns))
                $row[] = $temp_head;
        }




        $row = array_map('WF_CustomerImpExpCsv_Exporter::wrap_column', $row);
        fwrite($fp, implode($delimiter, $row) . "\n");
        unset($row);

        $meta_keys = $wpdb->get_results("SELECT distinct(meta_key) FROM $wpdb->usermeta");
        // get meta_key value from object
        $meta_keys = wp_list_pluck($meta_keys, 'meta_key');
        
        // Loop users
        foreach ($users as $user) {
            //$row = array();   
            $data = WF_CustomerImpExpCsv_Exporter::get_customers_csv_row($user, $export_columns, $csv_columns);
            $data = apply_filters('hf_customer_csv_exclude_admin',$data);
            $row = array_map('WF_CustomerImpExpCsv_Exporter::wrap_column', $data);
            fwrite($fp, implode($delimiter, $row) . "\n");
            unset($row);
            unset($data);
        }

        if ($usr_enable_ftp_ie) {
            if ($use_ftps) {
                $ftp_conn = ftp_ssl_connect($ftp_server) or die("Could not connect to $ftp_server");
            } else {
                $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
            }
            $login = ftp_login($ftp_conn, $ftp_user, $ftp_password);

            // upload file
            if (ftp_put($ftp_conn, $file, $file, FTP_ASCII)) {
                $wf_customer_ie_msg = 1;
                if(function_exists('wp_redirect'))
                wp_redirect(admin_url('/admin.php?page=hf_wordpress_customer_im_ex&wf_customer_ie_msg=' . $wf_customer_ie_msg));
            } else {
                $wf_customer_ie_msg = 2;
                if(function_exists('wp_redirect'))
                wp_redirect(admin_url('/admin.php?page=hf_wordpress_customer_im_ex&wf_customer_ie_msg=' . $wf_customer_ie_msg));
            }

            // close connection
            ftp_close($ftp_conn);
        }

        fclose($fp);
        exit;
    }

    public static function format_data($data) {
        //if (!is_array($data));
        //$data = (string) urldecode($data);
        $enc = mb_detect_encoding($data, 'UTF-8, ISO-8859-1', true);
        $data = ( $enc == 'UTF-8' ) ? $data : utf8_encode($data);
        return $data;
    }

    /**
     * Wrap a column in quotes for the CSV
     * @param  string data to wrap
     * @return string wrapped data
     */
    public static function wrap_column($data) {
        return '"' . str_replace('"', '""', $data) . '"';
    }

    /**
     * Get the customer data for a single CSV row
     * @since 3.0
     * @param int $customer_id
     * @param array $export_columns - user selected columns / all
     * @return array $meta_keys customer/user meta data
     */
    public static function get_customers_csv_row($id, $export_columns, $csv_columns) {

        $user = get_user_by('ID', $id);

        $customer_data = array();
        foreach ($csv_columns as $key) {

            $customer_data[$key] = !empty($user->{$key}) ? maybe_serialize($user->{$key}) : '';
        }
        $customer_data['roles'] = implode(', ', $user->roles);

        foreach ($customer_data as $key => $value) {
            if (!$export_columns || in_array($key, $export_columns)) {
                // need to modify code
            } else {
                unset($customer_data[$key]);
            }
        }
        /*
         * CSV Customer Export Row.
         * Filter the individual row data for the customer export
         * @since 3.0
         * @param array $customer_data 
         */
        return apply_filters('hf_customer_csv_export_data', $customer_data);
    }

    /*
     * Pre User Query => Fires after the WP_User_Query has been parsed, and before the query is executed.
     */

    public static function pre_user_query($user_search) {

        global $wpdb;
        $where = '';

        if (!empty($_POST['start_date'])) {
            $date = new DateTime(sanitize_text_field($_POST['start_date']) . ' 00:00:00');
            $date_formatted = $date->format('Y-m-d H:i:s');
            $where .= $wpdb->prepare(" AND $wpdb->users.user_registered >= %s", $date_formatted);
        }
        if (!empty($_POST['end_date'])) {
            $date = new DateTime(sanitize_text_field($_POST['end_date']) . ' 00:00:00');
            $date_formatted = $date->format('Y-m-d H:i:s');
            $where .= $wpdb->prepare(" AND $wpdb->users.user_registered < %s", $date_formatted);
        }

        if (!empty($where)) {
            $user_search->query_where = str_replace('WHERE 1=1', "WHERE 1=1 $where", $user_search->query_where);
        }
        return $user_search;
    }

}
