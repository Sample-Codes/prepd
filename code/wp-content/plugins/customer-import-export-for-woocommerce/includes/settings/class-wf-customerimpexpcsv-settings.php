<?php

if (!defined('ABSPATH')) {
    exit;
}

class WF_CustomerImpExpCsv_Settings {

    /**
     * User Exporter Tool
     */
    public static function save_settings() {
        global $wpdb;

        $ftp_server = !empty($_POST['ftp_server']) ? $_POST['ftp_server'] : '';
        $ftp_user = !empty($_POST['ftp_user']) ? $_POST['ftp_user'] : '';
        $ftp_password = !empty($_POST['ftp_password']) ? $_POST['ftp_password'] : '';
        $use_ftps = !empty($_POST['use_ftps']) ? true : false;
        $usr_enable_ftp_ie = !empty($_POST['usr_enable_ftp_ie']) ? true : false;

        $settings = array();
        $settings['ftp_server'] = $ftp_server;
        $settings['ftp_user'] = $ftp_user;
        $settings['ftp_password'] = $ftp_password;
        $settings['use_ftps'] = $use_ftps;
        $settings['usr_enable_ftp_ie'] = $usr_enable_ftp_ie;


        $usr_auto_export = !empty($_POST['usr_auto_export']) ? $_POST['usr_auto_export'] : 'Disabled';
        $usr_auto_export_start_time = !empty($_POST['usr_auto_export_start_time']) ? $_POST['usr_auto_export_start_time'] : '';
        $usr_auto_export_interval = !empty($_POST['usr_auto_export_interval']) ? $_POST['usr_auto_export_interval'] : '';

        $usr_auto_import = !empty($_POST['usr_auto_import']) ? $_POST['usr_auto_import'] : 'Disabled';
        $usr_auto_import_start_time = !empty($_POST['usr_auto_import_start_time']) ? $_POST['usr_auto_import_start_time'] : '';
        $usr_auto_import_interval = !empty($_POST['usr_auto_import_interval']) ? $_POST['usr_auto_import_interval'] : '';
        $usr_auto_import_profile = !empty($_POST['usr_auto_import_profile']) ? $_POST['usr_auto_import_profile'] : '';
        $usr_auto_import_merge = !empty($_POST['usr_auto_import_merge']) ? true : false;




        $settings['usr_auto_export'] = $usr_auto_export;
        $settings['usr_auto_export_start_time'] = $usr_auto_export_start_time;
        $settings['usr_auto_export_interval'] = $usr_auto_export_interval;

        $settings['usr_auto_import'] = $usr_auto_import;
        $settings['usr_auto_import_start_time'] = $usr_auto_import_start_time;
        $settings['usr_auto_import_interval'] = $usr_auto_import_interval;
        $settings['usr_auto_import_profile'] = $usr_auto_import_profile;
        $settings['usr_auto_import_merge'] = $usr_auto_import_merge;



        $settings_db = get_option('woocommerce_' . WF_CUSTOMER_IMP_EXP_ID . '_settings', null);


        $usr_orig_export_start_inverval = '';
        if (isset($settings_db['usr_auto_export_start_time']) && isset($settings_db['usr_auto_export_interval'])) {
            $usr_orig_export_start_inverval = $settings_db['usr_auto_export_start_time'] . $settings_db['usr_auto_export_interval'];
        }

        $usr_orig_import_start_inverval = '';
        if (isset($settings_db['usr_auto_import_start_time']) && isset($settings_db['usr_auto_import_interval'])) {
            $usr_orig_import_start_inverval = $settings_db['usr_auto_import_start_time'] . $settings_db['usr_auto_import_interval'];
        }

        update_option('woocommerce_' . WF_CUSTOMER_IMP_EXP_ID . '_settings', $settings);



        if ($usr_orig_export_start_inverval !== $settings['usr_auto_export_start_time'] . $settings['usr_auto_export_interval']) {
            wp_clear_scheduled_hook('wf_user_csv_im_ex_auto_export_user');
        }

        if ($usr_orig_import_start_inverval !== $settings['usr_auto_import_start_time'] . $settings['usr_auto_import_interval']) {
            wp_clear_scheduled_hook('wf_user_csv_im_ex_auto_import_user');
        }

        wp_redirect(admin_url('/admin.php?page=' . HF_WORDPRESS_CUSTOMER_IM_EX . '&tab=settings'));
        exit;
    }

}
