<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class WF_CustomerImpExpCsv_Cron {

    public $settings;

    public function __construct() {
        add_filter('cron_schedules', array($this, 'wf_auto_export_schedule'));
        add_action('init', array($this, 'wf_new_scheduled_export_user'));
        add_action('wf_user_csv_im_ex_auto_export_user', array($this, 'wf_scheduled_export_user'));
        $this->settings = get_option('woocommerce_' . WF_CUSTOMER_IMP_EXP_ID . '_settings', null);
        $this->exports_enabled = FALSE;
        if ($this->settings['usr_auto_export'] === 'Enabled')
            $this->exports_enabled = TRUE;
    }

    public function wf_auto_export_schedule($schedules) {
        if ($this->exports_enabled) {
            $export_interval = $this->settings['usr_auto_export_interval'];
            if ($export_interval) {
                $schedules['usr_export_interval'] = array(
                    'interval' => (int) $export_interval * 60,
                    'display' => sprintf(__('Every %d minutes', 'wf_customer_import_export'), (int) $export_interval)
                );
            }
        }
        return $schedules;
    }

    public function wf_new_scheduled_export_user() {
        if ($this->exports_enabled) {
            if (!wp_next_scheduled('wf_user_csv_im_ex_auto_export_user')) {
                $start_time = $this->settings['usr_auto_export_start_time'];
                $current_time = current_time('timestamp');
                if ($start_time) {
                    if ($current_time > strtotime('today ' . $start_time, $current_time)) {
                        $start_timestamp = strtotime('tomorrow ' . $start_time, $current_time) - ( get_option('gmt_offset') * HOUR_IN_SECONDS );
                    } else {
                        $start_timestamp = strtotime('today ' . $start_time, $current_time) - ( get_option('gmt_offset') * HOUR_IN_SECONDS );
                    }
                } else {
                    $export_interval = $this->settings['usr_auto_export_interval'];
                    $start_timestamp = strtotime("now +{$export_interval} minutes");
                }
                wp_schedule_event($start_timestamp, 'usr_export_interval', 'wf_user_csv_im_ex_auto_export_user');
            }
        }
    }

    public function wf_scheduled_export_user() {
        include_once( 'exporter/class-wf-customerimpexpcsv-exporter.php' );
        WF_CustomerImpExpCsv_Exporter::do_export('user');
    }

    public function clear_wf_scheduled_export_user() {
        wp_clear_scheduled_hook('wf_user_csv_im_ex_auto_export_user');
    }

}