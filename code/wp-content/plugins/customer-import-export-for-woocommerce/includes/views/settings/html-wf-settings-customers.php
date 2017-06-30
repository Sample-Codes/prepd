<?php

$settings 				= get_option( 'woocommerce_'.WF_CUSTOMER_IMP_EXP_ID.'_settings', null );
$ftp_server  			= isset( $settings['ftp_server'] ) ? $settings['ftp_server'] : '';
$ftp_user				= isset( $settings['ftp_user'] ) ? $settings['ftp_user'] : '';
$ftp_password           = isset( $settings['ftp_password'] ) ? $settings['ftp_password'] : '';
$use_ftps         		= isset( $settings['use_ftps'] ) ? $settings['use_ftps'] : '';
$usr_enable_ftp_ie         	= isset( $settings['usr_enable_ftp_ie'] ) ? $settings['usr_enable_ftp_ie'] : '';




$usr_auto_export = isset($settings['usr_auto_export']) ? $settings['usr_auto_export'] : 'Disabled';
$usr_auto_export_start_time = isset($settings['usr_auto_export_start_time']) ? $settings['usr_auto_export_start_time'] : '';
$usr_auto_export_interval = isset($settings['usr_auto_export_interval']) ? $settings['usr_auto_export_interval'] : '';

$usr_auto_import = isset($settings['usr_auto_import']) ? $settings['usr_auto_import'] : 'Disabled';
$usr_auto_import_start_time = isset($settings['usr_auto_import_start_time']) ? $settings['usr_auto_import_start_time'] : '';
$usr_auto_import_interval = isset($settings['usr_auto_import_interval']) ? $settings['usr_auto_import_interval'] : '';
$usr_auto_import_profile = isset($settings['usr_auto_import_profile']) ? $settings['usr_auto_import_profile'] : '';
$usr_auto_import_merge = isset($settings['usr_auto_import_merge']) ? $settings['usr_auto_import_merge'] : 0;

wp_localize_script('woocommerce-user-csv-importer', 'woocommerce_user_csv_cron_params', array('usr_enable_ftp_ie' => $usr_enable_ftp_ie , 'usr_auto_export' => $usr_auto_export, 'usr_auto_import' => $usr_auto_import));
if ($usr_scheduled_timestamp = wp_next_scheduled('wf_user_csv_im_ex_auto_export_user')) {
    $usr_scheduled_desc = sprintf(__('The next export is scheduled on <code>%s</code>', 'wf_customer_import_export'), get_date_from_gmt(date('Y-m-d H:i:s', $usr_scheduled_timestamp), wc_date_format() . ' ' . wc_time_format()));
} else {
    $usr_scheduled_desc = __('There is no export scheduled.', 'wf_customer_import_export');
}
if ($usr_scheduled_import_timestamp = wp_next_scheduled('wf_user_csv_im_ex_auto_import_user')) {
    $usr_scheduled_import_desc = sprintf(__('The next import is scheduled on <code>%s</code>', 'wf_customer_import_export'), get_date_from_gmt(date('Y-m-d H:i:s', $usr_scheduled_import_timestamp), wc_date_format() . ' ' . wc_time_format()));
} else {
    $usr_scheduled_import_desc = __('There is no import scheduled.', 'wf_customer_import_export');
}


?>
<div class="tool-box">
	<form action="<?php echo admin_url('admin.php?page=hf_wordpress_customer_im_ex&action=settings'); ?>" method="post">
		<table class="form-table">
			<tr>
				<th>
					<h3 class="title"><?php _e('FTP Settings for Export', 'wf_customer_import_export'); ?></h3>
				</th>
			</tr>
			<tr>
				<th>
					<label for="usr_enable_ftp_ie"><?php _e( 'Enable FTP', 'wf_customer_import_export' ); ?></label>
				</th>
				<td>
					<input type="checkbox" name="usr_enable_ftp_ie" id="usr_enable_ftp_ie" class="checkbox" <?php checked( $usr_enable_ftp_ie, 1 ); ?> />
				</td>
			</tr>
                        <table class="form-table" id="usr_export_section_all">
			<tr>
				<th>
					<label for="ftp_server"><?php _e( 'FTP Server Host/IP', 'wf_customer_import_export' ); ?></label>
				</th>
				<td>
					<input type="text" name="ftp_server" id="ftp_server" placeholder="<?php _e('XXX.XXX.XXX.XXX', 'wf_customer_import_export'); ?>" value="<?php echo $ftp_server; ?>" class="input-text" />
				</td>
			</tr>
			<tr>
				<th>
					<label for="ftp_user"><?php _e( 'FTP User Name', 'wf_customer_import_export' ); ?></label>
				</th>
				<td>
					<input type="text" name="ftp_user" id="ftp_user" value="<?php echo $ftp_user; ?>" class="input-text" />
				</td>
			</tr>
			<tr>
				<th>
					<label for="ftp_password"><?php _e( 'FTP Password', 'wf_customer_import_export' ); ?></label>
				</th>
				<td>
					<input type="password" name="ftp_password" id="ftp_password"  value="<?php echo $ftp_password; ?>" class="input-text" />
				</td>
			</tr>
			<tr>
				<th>
					<label for="use_ftps"><?php _e( 'Use FTPS', 'wf_customer_import_export' ); ?></label>
				</th>
				<td>
					<input type="checkbox" name="use_ftps" id="use_ftps" class="checkbox" <?php checked( $use_ftps, 1 ); ?> />
				</td>
			</tr>
                        
                        
                        
                        
                        
            <tr>
                <th>
                    <label for="usr_auto_export"><?php _e('Automatically Export Users', 'wf_customer_import_export'); ?></label>
                </th>
                <td>
                    <select class="" style="" id="usr_auto_export" name="usr_auto_export">
                        <option <?php if ($usr_auto_export === 'Disabled') echo 'selected'; ?> value="Disabled"><?php _e('Disabled', 'wf_customer_import_export'); ?></option>
                        <option <?php if ($usr_auto_export === 'Enabled') echo 'selected'; ?> value="Enabled"><?php _e('Enabled', 'wf_customer_import_export'); ?></option>
                    </select>
                </td>
            </tr>
            <tbody class="usr_export_section">
                <tr>
                    <th>
                        <label for="usr_auto_export_start_time"><?php _e('Export Start Time', 'wf_customer_import_export'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="usr_auto_export_start_time" id="usr_auto_export_start_time"  value="<?php echo $usr_auto_export_start_time; ?>"/>
                        <span class="description"><?php echo sprintf(__('Local time is <code>%s</code>.', 'wf_customer_import_export'), date_i18n(wc_time_format())) . ' ' . $usr_scheduled_desc; ?></span>
                        <br/>
                        <span class="description"><?php _e('<code>Enter like 6:18pm or 12:27am</code>', 'wf_customer_import_export'); ?></span>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="usr_auto_export_interval"><?php _e('Export Interval [ Minutes ]', 'wf_customer_import_export'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="usr_auto_export_interval" id="usr_auto_export_interval"  value="<?php echo $usr_auto_export_interval; ?>"  />
                    </td>
                </tr>
            </tbody>





            <tr>
                <th>
                    <label for="usr_auto_import"><?php _e('Automatically Import Users', 'wf_customer_import_export'); ?></label>
                </th>
                <td>
                    <select class="" style="" id="usr_auto_import" name="usr_auto_import">
                        <option <?php if ($usr_auto_import === 'Disabled') echo 'selected'; ?> value="Disabled"><?php _e('Disabled', 'wf_customer_import_export'); ?></option>
                        <option <?php if ($usr_auto_import === 'Enabled') echo 'selected'; ?> value="Enabled"><?php _e('Enabled', 'wf_customer_import_export'); ?></option>
                    </select>
                </td>
            </tr>
            <tbody class="usr_import_section">
                <tr>
                    <th>
                        <label for="usr_auto_import_start_time"><?php _e('Import Start Time', 'wf_customer_import_export'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="usr_auto_import_start_time" id="usr_auto_export_start_time"  value="<?php echo $usr_auto_import_start_time; ?>"/>
                        <span class="description"><?php echo sprintf(__('Local time is <code>%s</code>.', 'wf_customer_import_export'), date_i18n(wc_time_format())) . ' ' . $usr_scheduled_import_desc; ?></span>
                        <br/>
                        <span class="description"><?php _e('<code>Enter like 6:18pm or 12:27am</code>', 'wf_customer_import_export'); ?></span>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="usr_auto_import_interval"><?php _e('Import Interval [ Minutes ]', 'wf_customer_import_export'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="usr_auto_import_interval" id="usr_auto_export_interval"  value="<?php echo $usr_auto_import_interval; ?>"  />
                    </td>
                </tr>



                <tr>
                    <th>
                        <label for="usr_auto_import_merge"><?php _e('Update User if exist', 'wf_customer_import_export'); ?></label>
                    </th>
                    <td>
                        <input type="checkbox" name="usr_auto_import_merge" id="usr_auto_import_merge"  class="checkbox" <?php checked($usr_auto_import_merge, 1); ?> />
                    </td>
                </tr>

                <?php
                $usr_mapping_from_db = get_option('wf_user_csv_imp_exp_mapping');
                if (!empty($usr_mapping_from_db)) {
                    ?>
                    <tr>
                        <th>
                            <label for="usr_auto_import_profile"><?php _e('Select a mapping file.','wf_customer_import_export'); ?></label>
                        </th>
                        <td>
                            <select name="usr_auto_import_profile">
                                <option value="">--Select--</option>
                                <?php foreach ($usr_mapping_from_db as $key => $value) { ?>
                                    <option value="<?php echo $key; ?>" <?php selected($key, $usr_auto_import_profile); ?>><?php echo $key; ?></option>

                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
                        
                        
                        
                        
                        
                        
                        </table>  
		</table>

		<p class="submit"><input type="submit" class="button button-primary" value="<?php _e('Save Settings', 'wf_customer_import_export'); ?>" /></p>

	</form>
</div>