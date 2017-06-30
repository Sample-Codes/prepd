<?php

$updated_settings = isset($_REQUEST['settings-updated']) ? $_REQUEST['settings-updated'] : '';

$esi_admin = new ESI_AdminFormRenderer ();

?>

<div class="wrap">

	<?php
	
	if ($updated_settings == "true") {
		echo '<div class="updated" style="padding: 10px;">Settings are saved!</div>';
	}
	
	?>

	<form action="" method="post" class="esiui-ui">
		<div class="esi-options">
			<div class="esi-options-header" id="esi-options-header">
				<div class="esi-options-title">
					<?php _e('Easy Slind-In Settings', 'esi'); ?><br /> <span
						class="label" style="font-weight: 400;"><a
						href="http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476?ref=appscreo"
						target="_blank" style="text-decoration: none;">Easy Slide-In for WordPress version <?php echo ESI_VERSION; ?></a></span>
				</div>
				<button name="Submit" type="submit" class="button-primary"><?php esc_attr_e('Save Changes'); ?></button>

			</div>
			<div class="esi-options-container" style="min-height: 450px;">
				<?php settings_fields('esi_options_page'); ?>
				<div class="esi-dashboard-panel">
					<div class="esi-dashboard-panel-title">Easy Slide-In Message
						Display</div>

					<table border="0" cellpadding="2" cellspacing="0" width="100%"
						class="esiui-table">

						<col width="20%" />
						<col width="80%" />

						<tr class="even">
							<td class="param">Display message after:<br /> <span
								class="esi-info-label">Choose default message open event. This
									event can be customized for each message.</span></td>
							<td>
							
							<?php
							$percentage = $selector = $timeout = false;
							$condition = $esi_admin->_get_option ( 'show_after-condition' );
							$value = $esi_admin->_get_option ( 'show_after-rule' );
							
							switch ($condition) {
								case "selector" :
									$selector = 'checked="checked"';
									break;
								case "timeout" :
									$timeout = 'checked="checked"';
									$value = ( int ) $value;
									break;
								case "percentage" :
								default :
									$percentage = 'checked="checked"';
									$value = ( int ) $value;
									break;
							}
							
							$percentage_select = '<div class="esiui-ui-select1"><select name="esi[show_after-rule]" ' . ($percentage ? '' : 'disabled="disabled"') . '>';
							for($i = 1; $i < 100; $i ++) {
								$selected = ($i == $value) ? 'selected="selected"' : '';
								$percentage_select .= "<option value='{$i}' {$selected}>{$i}&nbsp;</option>";
							}
							$percentage_select .= '</select></div>&nbsp;%';
							echo '<div style="margin-bottom: 10px;">' . '<input type="radio" name="esi[show_after-condition]" value="percentage" id="esi-show_after-percentage" ' . $percentage . ' /> ' . '<label for="esi-show_after-percentage">' . __ ( 'Display message after this much of my page has been viewed', 'esi' ) . ': ' . '</label>&nbsp;' . $percentage_select . '</div>';
							
							echo '<div style="margin-bottom: 10px;">' . '<input type="radio" name="esi[show_after-condition]" value="selector" id="esi-show_after-selector" ' . $selector . ' /> ' . '<label for="esi-show_after-selector">' . __ ( 'Display message after scrolling past element with this ID', 'esi' ) . ': #' . '</label>&nbsp;' . '<input type="text" size="8" class="long" name="esi[show_after-rule]" id="" value="' . ($selector ? esc_attr ( $value ) : '') . '" ' . ($selector ? '' : 'disabled="disabled"') . ' />' . '</div>';
							
							echo '<div style="margin-bottom: 10px;">' . '<input type="radio" name="esi[show_after-condition]" value="timeout" id="esi-show_after-timeout" ' . $timeout . ' /> ' . '<label for="esi-show_after-timeout">' . __ ( 'Display message after this many seconds', 'esi' ) . ': ' . '</label>' . '<input type="text" size="2" class="short" name="esi[show_after-rule]" id="" value="' . ($timeout ? esc_attr ( $value ) : '') . '" ' . ($timeout ? '' : 'disabled="disabled"') . ' />' . '</div>';
							
							?>
							
							</td>
						</tr>
						<tr class="odd">
							<td class="param">Automatically hide message after:<br /> <span
								class="esi-info-label">Set automatically close time. If you wish
									slide-in message to stay on screen just select bigger value
									(for example 24 hours). This time can be customized for each
									slide in message.</span></td>
							<td>
						  
						  <?php
								
								$time = $esi_admin->_get_option ( 'show_for-time' );
								$unit = $esi_admin->_get_option ( 'show_for-unit' );
								
								$_times = array_combine ( range ( 1, 59 ), range ( 1, 59 ) );
								$_units = array ('s' => __ ( 'Seconds', 'esi' ), 'm' => __ ( 'Minutes', 'esi' ), 'h' => __ ( 'Hours', 'esi' ) );
								
								// Time
								echo "<div class='esiui-ui-select1'><select name='esi[show_for-time]'>";
								foreach ( $_times as $_time ) {
									$selected = $_time == $time ? 'selected="selected"' : '';
									echo "<option value='{$_time}' {$selected}>{$_time}</option>";
								}
								echo "</select></div>";
								
								// Unit
								echo "<div class='esiui-ui-select1'><select name='esi[show_for-unit]'>";
								foreach ( $_units as $key => $_unit ) {
									$selected = $key == $unit ? 'selected="selected"' : '';
									echo "<option value='{$key}' {$selected}>{$_unit}</option>";
								}
								echo "</select></div>";
								
								?>
						  
						  </td>
						</tr>

						<tr class="even">
							<td class="param">After closing the message action:<br /> <span
								class="esi-info-label">Choose will or not display slide-in
									message for this visitor if he closes the message via button.
									This option is global and cannot be personalized for each
									slide.</span></td>
							<td>
						  <?php
								echo '<div class="esi-on_hide-condition" style="margin-bottom: 10px;">' . $esi_admin->_create_radiobox ( 'on_hide', '', true ) . '<label for="on_hide-">' . __ ( 'Keep showing messages to the visitor', 'esi' ) . '</label>' . '</div>';
								echo '<div class="esi-on_hide-condition" style="margin-bottom: 10px;">' . $esi_admin->_create_radiobox ( 'on_hide', 'page', true ) . '<label for="on_hide-page">' . __ ( 'Hide messages on that page for the visitor', 'esi' ) . '</label>' . '</div>';
								echo '<div class="esi-on_hide-condition" style="margin-bottom: 10px;">' . $esi_admin->_create_radiobox ( 'on_hide', 'all', true ) . '<label for="on_hide-all">' . __ ( 'Hide all messages for the visitor', 'esi' ) . '</label>' . '</div>';
								
								$_times = array_combine ( range ( 1, 31 ), range ( 1, 31 ) );
								$_units = array ('hours' => __ ( 'Hours', 'esi' ), 'days' => __ ( 'Days', 'esi' ), 'weeks' => __ ( 'Weeks', 'esi' ) );
								$on_hide = $esi_admin->_get_option ( 'on_hide' );
								$enabled = ! empty ( $on_hide );
								$reshow_after_time = $enabled ? $esi_admin->_get_option ( 'reshow_after-time' ) : false;
								$reshow_after_units = $enabled ? $esi_admin->_get_option ( 'reshow_after-units' ) : false;
								
								$time_box = "<div class='esiui-ui-select1'><select name='esi[reshow_after-time]'><option value=''></option>";
								foreach ( $_times as $_time ) {
									$selected = $_time == $reshow_after_time ? 'selected="selected"' : '';
									$time_box .= "<option value='{$_time}' {$selected}>{$_time}</option>";
								}
								$time_box .= "</select></div>";
								
								$unit_box = "<div class='esiui-ui-select1'><select name='esi[reshow_after-units]'><option value=''></option>";
								foreach ( $_units as $key => $_unit ) {
									$selected = $key == $reshow_after_units ? 'selected="selected"' : '';
									$unit_box .= "<option value='{$key}' {$selected}>{$_unit}</option>";
								}
								$unit_box .= "</select></div>";
								
								echo '<div class="esi-reshow_after" ' . ($enabled ? '' : 'style="display:none"') . ' >' . '<label for=""><b>' . __ ( 'Show the messages again after:', 'esi' ) . '</b></label><br />' . "{$time_box} {$unit_box}" . '</div>';
								
								?>
						  </td>
						</tr>
					</table>
				</div>

				<div class="esi-dashboard-panel">
					<div class="esi-dashboard-panel-title">Easy Slide-In Message Style
						and Postion</div>

					<table border="0" cellpadding="2" cellspacing="0" width="100%"
						class="esiui-table">

						<col width="20%" />
						<col width="80%" />

						<tr class="even">
							<td class="param">Message position<br /> <span
								class="esi-info-label">Choose the default slide-in position. You
									can set custom position for each slide in message.</span></td>
							<td style="min-height: 80px; height: 80px;">
							
							<?php
							echo '<div class="position-control">' . $esi_admin->_create_radiobox ( 'position', 'left', true ) . $esi_admin->_create_radiobox ( 'position', 'top', true ) . $esi_admin->_create_radiobox ( 'position', 'right', true ) . $esi_admin->_create_radiobox ( 'position', 'bottom', true ) . $esi_admin->_create_radiobox ( 'position', 'bottom_left', true ) . $esi_admin->_create_radiobox ( 'position', 'bottom_right', true ) . $esi_admin->_create_radiobox ( 'position', 'top_left', true ) . $esi_admin->_create_radiobox ( 'position', 'top_right', true ) . $esi_admin->_create_radiobox ( 'position', 'center', true ) . '</div>';
							
							?>
							
							</td>
						</tr>

						<tr class="odd">
							<td class="param">Default message width<br /> <span
								class="esi-info-label">These are default settings for slide in.
									You can personalize and extend them in each slide in options.</span></span>
							
							<td>
							<?php
							
							$width = $esi_admin->_get_option ( 'width' );
							$checked = (! ( int ) $width || 'full' == 'width') ? 'checked="checked"' : '';
							
							echo '' . '<input type="checkbox" name="esi[width]" value="full" id="esi-full_width" ' . $checked . ' autocomplete="off" />' . '&nbsp;' . '<label for="esi-full_width">' . __ ( 'Full width', 'esi' ) . '</label>' . '';
							$display = $checked ? '' : '';
							echo '<div id="esi-custom_width" ' . $display . '>';
							$disabled = $checked ? 'disabled="disabled"' : '';
							echo '' . '<label for="esi-width">' . __ ( 'Message width', 'esi' ) . '</label>' . '&nbsp;' . '<input type="text" size="8" class="medium" name="esi[width]" id="esi-width" value="' . ( int ) $width . '" ' . $disabled . ' />px' . '';
							echo '</div>';
							echo '<br />';
							$vetical_cols = $esi_admin->_get_option ( 'vetical_cols' );
							$checked = ($vetical_cols == "yes") ? 'checked="checked"' : '';
							echo '' . '<input type="checkbox" name="esi[vetical_cols]" value="yes" id="esi-vetical_cols" ' . $checked . ' autocomplete="off" />' . '&nbsp;' . '<label for="esi-vetical_cols">' . __ ( 'Display content vertically', 'esi' ) . '</label>' . '';
							?>
							</td>
						</tr>
						<tr class="even">
							<td class="param">Customize main colors:<br /> <span
								class="esi-info-label">Change default slide in colors. You can
									also set personalized settings for each slide where you have
									access to additional options.</span>
							
							<td>
							
							<?php
							
							$bgcolor = $esi_admin->_get_option ( 'bgcolor' );
							$textcolor = $esi_admin->_get_option ( 'textcolor' );
							$accentcolor = $esi_admin->_get_option ( 'accentcolor' );
							
							echo '<table border="0" celpadding="5" cellspacing="0" width="100%"><col width="15%"/><col width="85%"/><tr><td><span for="esi-bgcolor">' . __ ( 'Background color:' ) . '</span></td>' . '<td><input type="text" class="long" name="esi[bgcolor]" id="esi-bgcolor" value="' . esc_attr ( $bgcolor ) . '" />' . '</td></tr>';
							echo '<tr><td><span for="esi-textcolor">' . __ ( 'Text color:' ) . '</span></td>' . '<td><input type="text" class="long" name="esi[textcolor]" id="esi-textcolor" value="' . esc_attr ( $textcolor ) . '" />' . '</td></tr>';
							echo '<tr><td><span for="esi-accentcolor">' . __ ( 'Other color:' ) . '</span></td>' . '<td><input type="text" class="long" name="esi[accentcolor]" id="esi-accentcolor" value="' . esc_attr ( $accentcolor ) . '" />' . '</td></tr></table>';
							
							?>
							</td>
						</tr>
						<tr class="odd">
							<td class="param">Custom CSS:</td>
							<td>
							
							<?php
							
							$css = esc_textarea ( wp_strip_all_tags ( $esi_admin->_get_option ( 'css-custom_styles' ) ) );
							$placeholder = esc_attr ( __ ( 'Additional CSS styles', 'esi' ) );
							
							echo "<textarea class='widefat' rows='8' name='esi[css-custom_styles]' placeholder='{$placeholder}'>{$css}</textarea>";
							
							?>
							
							</td>
						</tr>
					</table>
				</div>

				<div class="esi-dashboard-panel">
					<div class="esi-dashboard-panel-title">MailChimp subscriptions</div>

					<table border="0" cellpadding="2" cellspacing="0" width="100%"
						class="esiui-table">

						<col width="20%" />
						<col width="80%" />
						
						<?php
						
						$api_key = $esi_admin->_get_option ( 'mailchimp-api_key' );
						echo '<tr class="even"><td class="param">';
						echo '<label for="esi-mailchimp-api_key">' . __ ( 'MailChimp API key:' ) . '</label></td><td>' . '<input type="text" class="long" name="esi[mailchimp-api_key]" id="esi-mailchimp-api_key" value="' . esc_attr ( $api_key ) . '" />' . '</td></tr>';
						if (! $api_key) {
							echo '<tr class="even"><td></td><td>' . $esi_admin->_create_hint ( __ ( 'Enter your API key here, then save the settings to continue', 'esi' ) ) . '</td></tr>';
						
						} else {
							$mailchimp = new ESI_Mailchimp ( $api_key );
							
							$lists = $mailchimp->get_lists ();
							$current = $esi_admin->_get_option ( 'mailchimp-default_list' );
							
							echo '<tr class="odd"><td class="param"><label>' . __ ( 'Default subscription list:', 'esi' ) . ' </label><br/><span class="esi-info-label">Select a default list you wish to subscribe your visitors to.</span></td>';
							echo '<td><div class="esiui-ui-select1"><select name="esi[mailchimp-default_list]">';
							echo '<option></option>';
							foreach ( $lists as $list ) {
								$selected = $list ['id'] == $current ? 'selected="selected"' : '';
								echo '<option value="' . esc_attr ( $list ['id'] ) . '" ' . $selected . '>' . $list ['name'] . '</option>';
							}
							echo '</select></div>';
							
							// We got this far, we have the API key
							echo '&nbsp;<a href="#mcls-refresh" id="esi-mcls-refresh">' . __ ( 'Refresh', 'esi' ) . '</a></td></tr>';
							
							$subscription_message = $esi_admin->_get_option ( 'mailchimp-subscription_message' );
							$subscription_message = $subscription_message ? $subscription_message : __ ( 'All good, thank you!', 'esi' );
							$subscription_message = wp_strip_all_tags ( $subscription_message );
							echo '<tr class="even"><td class="param">' . '<label for="esi-mailchimp-subscription_message">' . __ ( 'Successful subscription message:', 'esi' ) . '</label></td><td>' . '<input type="text" class="long" name="esi[mailchimp-subscription_message]" id="esi-mailchimp-subscription_message" value="' . esc_attr ( $subscription_message ) . '" /></td></tr>' . '';
						}
						
						?>
					</table>
				</div>

				<div class="esi-dashboard-panel">
					<div class="esi-dashboard-panel-title">Advanced Options</div>

					<table border="0" cellpadding="2" cellspacing="0" width="100%"
						class="esiui-table">

						<col width="20%" />
						<col width="80%" />
						
						<tr class="even">
							<td class="param">Allow multiple displayed messages in automatically display mode:<br/><span class="esi-info-label">Enabling this option will allow you to display more then one message in automatically display mode.</span></td>
							<td>
							
							<?php 
							echo '' .
									'<input type="hidden" name="esi[allow_multiple]" value="" />' .
									'<input type="checkbox" name="esi[allow_multiple]" id="esi-allow_widgets" value="1" ' . ($esi_admin->_get_option('allow_multiple') ? 'checked="checked"' : '') . ' />' .									
									'';
							?>
							
							</td>
						</tr>
						<?php 
						$value = ($esi_admin->_get_option('allow_multiple_count') ? $esi_admin->_get_option('allow_multiple_count') : '1');
						$widget_select = '<div class="esiui-ui-select1"><select name="esi[allow_multiple_count]">';
						for($i = 1; $i < 11; $i ++) {
							$selected = ($i == $value) ? 'selected="selected"' : '';
							$widget_select .= "<option value='{$i}' {$selected}>{$i}&nbsp;</option>";
						}
						$widget_select .= '</select></div>';
						
						?>
						<tr class="odd">
							<td class="param">Number of displayed messages:<br/><span class="esi-info-label">If you enable multiple displayed messages in automatically display mode here you can select the maximum number of display messages according to display condition rules.</span></td>
							<td>
							
							<?php 
							echo $widget_select;
							?>
							
							</td>
						</tr>
						
						
						
						<tr class="even">
							<td class="param">Allow shortcodes:<br/><span class="esi-info-label">Activate this option if you plan to use shortcodes within slide-in message.</span></td>
							<td>
							
							<?php 
							echo '' .
									'<input type="hidden" name="esi[allow_shortcodes]" value="" />' .
									'<input type="checkbox" name="esi[allow_shortcodes]" id="esi-allow_shortcodes" value="1" ' . ($esi_admin->_get_option('allow_shortcodes') ? 'checked="checked"' : '') . ' />' .
									'';
								
							?>
							
							</td>
						</tr>
						<tr class="odd">
							<td class="param">Allow widgets:<br/><span class="esi-info-label">Enabling this option will add a new sidebar that you can populate with widgets in Appearance > Widgets.</span></td>
							<td>
							
							<?php 
							echo '' .
									'<input type="hidden" name="esi[allow_widgets]" value="" />' .
									'<input type="checkbox" name="esi[allow_widgets]" id="esi-allow_widgets" value="1" ' . ($esi_admin->_get_option('allow_widgets') ? 'checked="checked"' : '') . ' />' .									
									'';
							?>
							
							</td>
						</tr>
						<?php 
						$value = ($esi_admin->_get_option('allow_widgets_count') ? $esi_admin->_get_option('allow_widgets_count') : '1');
						$widget_select = '<div class="esiui-ui-select1"><select name="esi[allow_widgets_count]">';
						for($i = 1; $i < 11; $i ++) {
							$selected = ($i == $value) ? 'selected="selected"' : '';
							$widget_select .= "<option value='{$i}' {$selected}>{$i}&nbsp;</option>";
						}
						$widget_select .= '</select></div>';
						
						?>
						<tr class="even">
							<td class="param">Number of widget areas:<br/><span class="esi-info-label">If you enable allow widgets option here you can select number of widgets that plugin can use.</span></td>
							<td>
							
							<?php 
							echo $widget_select;
							?>
							
							</td>
						</tr>
						
						<tr class="odd">
							<td class="param">Hide on mobile:<br/><span class="esi-info-label">Activate message not display for mobile devices (tablets are excluded from these options).</span></td>
							<td>
							
							<?php 
							
							
							$hide_for_all_mobile = $esi_admin->_get_option('hide_mobile');
							$checked = ($hide_for_all_mobile == 'true') ? 'checked="checked"' : '';
							
							echo '' .
									'<input type="checkbox" name="esi[hide_mobile]" value="true" id="esi-hide_mobile" ' . $checked . ' autocomplete="off" />' .
									'&nbsp;' .
									'<label for="esi-hide_mobile">' . __('Hide on all mobile devices', 'esi') . '</label>' .
									'';
							
							$hide_condition_mobile = $esi_admin->_get_option('hide_condition_mobile');
							$hide_condition_mobile_resolution = $esi_admin->_get_option('hide_condition_mobile_resolution');
							$checked = ($hide_condition_mobile == 'true') ? 'checked="checked"' : '';
							
							echo '<br/>' .
									'<input type="checkbox" name="esi[hide_condition_mobile]" value="true" id="esi-hide_condition_mobile" ' . $checked . ' autocomplete="off" />' .
									'&nbsp;' .
									'<label for="esi-hide_condition_mobile">' . __('Hide on mobile devices with resolution lower than', 'esi') . '</label>' .
									'&nbsp;' .
									'<input type="text" size="8" class="medium" name="esi[hide_condition_mobile_resolution]" id="esi-hide_condition_mobile_resolution" value="' . (int)$hide_condition_mobile_resolution . '"  />px' .
									'';
							
							?>
							
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

	</form>
</div>

<script type="text/javascript">


jQuery(document).ready(function($){
    $('#esi-bgcolor').wpColorPicker();
    $('#esi-textcolor').wpColorPicker();
    $('#esi-accentcolor').wpColorPicker();
    
});

</script>