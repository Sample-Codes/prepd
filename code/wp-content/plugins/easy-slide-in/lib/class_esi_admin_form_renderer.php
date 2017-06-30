<?php
class ESI_AdminFormRenderer {

	function _get_option ($key=false, $pfx='esi') {
		$opts = get_option($pfx);
		if (!$key) return $opts;
		return @$opts[$key];
	}

	function _create_checkbox ($name, $pfx='esi') {
		$opt = $this->_get_option($name, $pfx);
		$value = @$opt[$name];
		return
			"<input type='radio' name='{$pfx}[{$name}]' id='{$name}-yes' value='1' " . ((int)$value ? 'checked="checked" ' : '') . " /> " .
				"<label for='{$name}-yes'>" . __('Yes', 'esi') . "</label>" .
			'&nbsp;' .
			"<input type='radio' name='{$pfx}[{$name}]' id='{$name}-no' value='0' " . (!(int)$value ? 'checked="checked" ' : '') . " /> " .
				"<label for='{$name}-no'>" . __('No', 'esi') . "</label>" .
		"";
	}

	function _create_hint ($text) {
		return "<div class='info-message'><span class='info'></span>{$text}</div>";
	}

	function _create_radiobox ($name, $value, $value_as_class=false) {
		$opt = $this->_get_option($name);
		$checked = (@$opt == $value) ? true : false;
		$name = esc_attr($name);
		$class = $value_as_class ? "class='{$name} {$value}'" : '';
		return "<input type='radio' name='esi[{$name}]' {$class} id='{$name}-{$value}' value='{$value}' " . ($checked ? 'checked="checked" ' : '') . " /> ";
	}

	function _create_color_radiobox ($name, $value, $label) {
		$color = esc_attr($value);
		$label= esc_attr($label);
		return "<label class='esi-color-container' for='{$name}-{$value}'>" .
			$this->_create_radiobox($name, $value) .
			"<div class='esi-color esi-{$color}' title='{$label}'></div>" .
		'</label>';
	}

	function create_show_after_box () {
		$percentage = $selector = $timeout = false;
		$condition = $this->_get_option('show_after-condition');
		$value = $this->_get_option('show_after-rule');

		switch ($condition) {
			case "selector":
				$selector = 'checked="checked"';
				break;
			case "timeout":
				$timeout = 'checked="checked"';
				$value = (int)$value;
				break;
			case "percentage":
			default:
				$percentage = 'checked="checked"';
				$value = (int)$value;
				break;
		}
		echo $this->_create_hint(__('Choose when you wish message to be displayed', 'esi'));
		
		$percentage_select = '<div class="esiui-ui-select1"><select name="esi[show_after-rule]" ' . ($percentage ? '' : 'disabled="disabled"') . '>';
		for ($i=1; $i<100; $i++) {
			$selected = ($i == $value) ? 'selected="selected"' : '';
			$percentage_select .= "<option value='{$i}' {$selected}>{$i}&nbsp;</option>";
		}
		$percentage_select .= '</select></div>%';
		echo '<div>' .
			'<input type="radio" name="esi[show_after-condition]" value="percentage" id="esi-show_after-percentage" ' . $percentage . ' /> ' .
			'<label for="esi-show_after-percentage">' .
				__('Display message after this much of my page has been viewed', 'esi') .
				': ' .
			'</label>' .
			$percentage_select .
		'</div>';

		echo '<div>' .
			'<input type="radio" name="esi[show_after-condition]" value="selector" id="esi-show_after-selector" ' . $selector . ' /> ' .
			'<label for="esi-show_after-selector">' .
				__('Display message after scrolling past element with this ID', 'esi') .
				': #' .
			'</label>' .
			'<input type="text" size="8" class="medium" name="esi[show_after-rule]" id="" value="' . ($selector ? esc_attr($value) : '') . '" ' . ($selector ? '' : 'disabled="disabled"') . ' />' .
		'</div>';

		echo '<div>' .
			'<input type="radio" name="esi[show_after-condition]" value="timeout" id="esi-show_after-timeout" ' . $timeout . ' /> ' .
			'<label for="esi-show_after-timeout">' .
				__('Display message after this many seconds', 'esi') .
				': ' .
			'</label>' .
			'<input type="text" size="2" class="short" name="esi[show_after-rule]" id="" value="' . ($timeout ? esc_attr($value) : '') . '" ' . ($timeout ? '' : 'disabled="disabled"') . ' />' .
		'</div>';
	}

	function create_show_for_box () {
		$time = $this->_get_option('show_for-time');
		$unit = $this->_get_option('show_for-unit');

		$_times = array_combine(range(1,59), range(1,59));
		$_units = array(
			's' => __('Seconds', 'esi'),
			'm' => __('Minutes', 'esi'),
			'h' => __('Hours', 'esi'),
		);

		// Time
		echo $this->_create_hint(__('Choose when automatically message will be hidden for user', 'esi'));
		echo "<div class='esiui-ui-select1'><select name='esi[show_for-time]'>";
		foreach ($_times as $_time) {
			$selected = $_time == $time ? 'selected="selected"' : '';
			echo "<option value='{$_time}' {$selected}>{$_time}</option>";
		}
		echo "</select></div>";

		// Unit
		echo "<div class='esiui-ui-select1'><select name='esi[show_for-unit]'>";
		foreach ($_units as $key => $_unit) {
			$selected = $key == $unit ? 'selected="selected"' : '';
			echo "<option value='{$key}' {$selected}>{$_unit}</option>";
		}
		echo "</select></div>";
	}

	function create_closing_box () {
		echo $this->_create_hint(__('When a visitor closes a slide-in message, I want to', 'esi'));
		echo '<div class="esi-on_hide-condition">' .
			$this->_create_radiobox('on_hide', '', true) .
			'<label for="on_hide-">' . __('Keep showing messages to the visitor', 'esi') . '</label>' .
		'</div>';
		echo '<div class="esi-on_hide-condition">' .
			$this->_create_radiobox('on_hide', 'page', true) .
			'<label for="on_hide-page">' . __('Hide messages on that page for the visitor', 'esi') . '</label>' .
		'</div>';
		echo '<div class="esi-on_hide-condition">' .
			$this->_create_radiobox('on_hide', 'all', true) .
			'<label for="on_hide-all">' . __('Hide all messages for the visitor', 'esi') . '</label>' .
		'</div>';

		$_times = array_combine(range(1,31), range(1,31));
		$_units = array(
			'hours' => __('Hours', 'esi'),
			'days' => __('Days', 'esi'),
			'weeks' => __('Weeks', 'esi'),
		);
		$on_hide = $this->_get_option('on_hide');
		$enabled = !empty($on_hide);
		$reshow_after_time = $enabled ? $this->_get_option('reshow_after-time') : false;
		$reshow_after_units = $enabled ? $this->_get_option('reshow_after-units') : false;

		$time_box = "<div class='esiui-ui-select1'><select name='esi[reshow_after-time]'><option value=''></option>";
		foreach ($_times as $_time) {
			$selected = $_time == $reshow_after_time ? 'selected="selected"' : '';
			$time_box .= "<option value='{$_time}' {$selected}>{$_time}</option>";
		}
		$time_box .= "</select></div>";

		$unit_box = "<div class='esiui-ui-select1'><select name='esi[reshow_after-units]'><option value=''></option>";
		foreach ($_units as $key => $_unit) {
			$selected = $key == $reshow_after_units ? 'selected="selected"' : '';
			$unit_box .= "<option value='{$key}' {$selected}>{$_unit}</option>";
		}
		$unit_box .= "</select></div>";

		echo '<div class="esi-reshow_after" ' . ($enabled ? '' : 'style="display:none"') . ' >' .
			'<label for="">' . __('Show the messages again after:', 'esi') . '</label><br />' .
			"{$time_box} {$unit_box}" .
		'</div>';
	}

	function create_position_box () {

		echo '' .
			$this->_create_hint(__('This is where your message will appear.', 'esi')). '<br/>';
		echo '<div class="position-control">' .
			$this->_create_radiobox('position', 'left', true) .
			$this->_create_radiobox('position', 'top', true) .
			$this->_create_radiobox('position', 'right', true) .
			$this->_create_radiobox('position', 'bottom', true) .
			$this->_create_radiobox('position', 'bottom_left', true) .
			$this->_create_radiobox('position', 'bottom_right', true) .
			$this->_create_radiobox('position', 'top_left', true) .
			$this->_create_radiobox('position', 'top_right', true) .
			$this->_create_radiobox('position', 'center', true) .
			'</div>';
		;
	}
	
	function create_color_options() {
		$bgcolor = $this->_get_option('bgcolor');
		$textcolor = $this->_get_option('textcolor');
		$accentcolor = $this->_get_option('accentcolor');
		
		echo '<table border="0" celpadding="5" cellspacing="0" width="100%"><col width="15%"/><col width="85%"/><tr><td colspan="2">' .
				$this->_create_hint(__('Customize default main colors of slide in panel. More detailed customization can be done with additional CSS field', 'esi')). '';
		echo '</td></tr><tr><td><span for="esi-bgcolor">' . __('Background color:') . '</span></td>' .
				'<td><input type="text" class="long" name="esi[bgcolor]" id="esi-bgcolor" value="' . esc_attr($bgcolor) . '" />' .
				'</td></tr>';
		echo '<tr><td><span for="esi-textcolor">' . __('Text color:') . '</span></td>' .
				'<td><input type="text" class="long" name="esi[textcolor]" id="esi-textcolor" value="' . esc_attr($textcolor) . '" />' .
				'</td></tr>';
			echo '<tr><td><span for="esi-accentcolor">' . __('Other color:') . '</span></td>' .
				'<td><input type="text" class="long" name="esi[accentcolor]" id="esi-accentcolor" value="' . esc_attr($accentcolor) . '" />' .
				'</td></tr></table>';
	}

	function create_msg_width_box () {
		$width = $this->_get_option('width');
		$checked = (!(int)$width || 'full' == 'width') ? 'checked="checked"' : '';
		echo '' .
				$this->_create_hint(__('Set width of message panel.', 'esi')). '';
		
		echo '' .
			'<input type="checkbox" name="esi[width]" value="full" id="esi-full_width" ' . $checked . ' autocomplete="off" />' .
			'&nbsp;' .
			'<label for="esi-full_width">' . __('Full width', 'esi') . '</label>' .
		'';
		$display = $checked ? 'style="display:none"' : '';
		echo '<div id="esi-custom_width" ' . $display . '>';
		$disabled = $checked ? 'disabled="disabled"' : '';
		echo '' .
			'<label for="esi-width">' . __('Message width', 'esi') . '</label>' .
			'&nbsp;' .
			'<input type="text" size="8" class="medium" name="esi[width]" id="esi-width" value="' . (int)$width . '" ' . $disabled . ' />px' .
		'';
		echo '</div>';
		echo '<br />';
		$vetical_cols = $this->_get_option('vetical_cols');
		$checked = ($vetical_cols == "yes") ? 'checked="checked"' : '';
		echo '' .
				'<input type="checkbox" name="esi[vetical_cols]" value="yes" id="esi-vetical_cols" ' . $checked . ' autocomplete="off" />' .
				'&nbsp;' .
				'<label for="esi-vetical_cols">' . __('Display content vertically', 'esi') . '</label>' .
				'';
	}
	

	function create_mailchimp_box () {
		/*
		echo '<label for="mailchimp-enabled-yes">' . __('Enable MailChimp integration:', 'esi') . ' </label>' .
			$this->_create_checkbox('mailchimp-enabled') .
		'<br />';
		*/
		$api_key = $this->_get_option('mailchimp-api_key');
		echo '<label for="esi-mailchimp-api_key">' . __('MailChimp API key:') . '</label>' .
			'<input type="text" class="long" name="esi[mailchimp-api_key]" id="esi-mailchimp-api_key" value="' . esc_attr($api_key) . '" />' .
		'<br />';
		if (!$api_key) {
			echo $this->_create_hint(__('Enter your API key here, then save the settings to continue', 'esi'));
			return false;
		}

		$mailchimp = new ESI_Mailchimp($api_key);

		$lists = $mailchimp->get_lists();
		$current = $this->_get_option('mailchimp-default_list');

		echo '<label>' . __('Default subscription list:', 'esi') . ' </label>';
		echo '<div class="esiui-ui-select1"><select name="esi[mailchimp-default_list]">';
		echo '<option></option>';
		foreach ($lists as $list) {
			$selected = $list['id'] == $current ? 'selected="selected"' : '';
			echo '<option value="' . esc_attr($list['id']) . '" ' . $selected . '>' . $list['name'] . '</option>';
		}
		echo '</select></div>';

		// We got this far, we have the API key
		echo '&nbsp;<a href="#mcls-refresh" id="esi-mcls-refresh">' . __('Refresh', 'esi') . '</a>';
		echo $this->_create_hint(__('Select a default list you wish to subscribe your visitors to.', 'esi'));

		$subscription_message = $this->_get_option('mailchimp-subscription_message');
		$subscription_message = $subscription_message ? $subscription_message : __('All good, thank you!', 'esi');
		$subscription_message = wp_strip_all_tags($subscription_message);
		echo '<br />' .
			'<label for="esi-mailchimp-subscription_message">' . __('Successful subscription message:', 'esi') . '</label>&nbsp;' .
			'<input type="text" class="long" name="esi[mailchimp-subscription_message]" id="esi-mailchimp-subscription_message" value="' . esc_attr($subscription_message) . '" />' .
		'';
	}

	function create_custom_css_box () {
		$css = esc_textarea(wp_strip_all_tags($this->_get_option('css-custom_styles')));
		$placeholder = esc_attr(__('Additional CSS styles', 'esi'));
		echo $this->_create_hint(__('Add the additional CSS rules you wish to include', 'esi'));
		echo "<textarea class='widefat' rows='8' name='esi[css-custom_styles]' placeholder='{$placeholder}'>{$css}</textarea>";
	}

	function create_mobile_box() {
		echo $this->_create_hint(__('Activate specific options related to mobile devices.', 'esi'));
		$hide_for_all_mobile = $this->_get_option('hide_mobile');
		$checked = ($hide_for_all_mobile == 'true') ? 'checked="checked"' : '';
		
		echo '' .
				'<input type="checkbox" name="esi[hide_mobile]" value="true" id="esi-hide_mobile" ' . $checked . ' autocomplete="off" />' .
				'&nbsp;' .
				'<label for="esi-hide_mobile">' . __('Hide on all mobile devices', 'esi') . '</label>' .
				'';
		
		$hide_condition_mobile = $this->_get_option('hide_condition_mobile');
		$hide_condition_mobile_resolution = $this->_get_option('hide_condition_mobile_resolution');
		$checked = ($hide_condition_mobile == 'true') ? 'checked="checked"' : '';
		
		echo '<br/>' .
				'<input type="checkbox" name="esi[hide_condition_mobile]" value="true" id="esi-hide_condition_mobile" ' . $checked . ' autocomplete="off" />' .
				'&nbsp;' .
				'<label for="esi-hide_condition_mobile">' . __('Hide on mobile devices with resolution lower than', 'esi') . '</label>' .
				'&nbsp;' .
				'<input type="text" size="8" class="medium" name="esi[hide_condition_mobile_resolution]" id="esi-hide_condition_mobile_resolution" value="' . (int)$hide_condition_mobile_resolution . '"  />px' .
				'';
	}
	
	function create_advanced_box () {
		echo $this->_create_hint(__('Enabling this option will allow processing shortcodes in your slide-in messages.', 'esi'));
		echo '' .
			'<input type="hidden" name="esi[allow_shortcodes]" value="" />' .
			'<input type="checkbox" name="esi[allow_shortcodes]" id="esi-allow_shortcodes" value="1" ' . ($this->_get_option('allow_shortcodes') ? 'checked="checked"' : '') . ' />' .
			'&nbsp;' .
			'<label for="esi-allow_shortcodes">' . __('Allow shortcodes', 'esi') . '</label>' 
			 .
		'';
		
		echo $this->_create_hint(__('Enabling this option will add a new sidebar that you can populate with widgets in Appearance &gt; Widgets.', 'esi'));
		
		echo '' .
			'<input type="hidden" name="esi[allow_widgets]" value="" />' .
			'<input type="checkbox" name="esi[allow_widgets]" id="esi-allow_widgets" value="1" ' . ($this->_get_option('allow_widgets') ? 'checked="checked"' : '') . ' />' .
			'&nbsp;' .
			'<label for="esi-allow_widgets">' . __('Allow widgets', 'esi') . '</label>' .
			
		'';



		$hook = $this->_get_option('custom_injection_hook');

		$hook = $hook ? $hook : Easy_SlideIn::get_default_injection_hook();
		echo $this->_create_hint(__('Select one of predefined injecttion hooks to render content.', 'esi'));
		echo '' .
			'<label for="esi-custom_injection_hook">' . __('Custom injection hook', 'esi') . '</label>' .
			'&nbsp;' .
					'';
		$injection_hooks = array("loop_end", "the_content", "wp_footer");
		
		$select_hooks = '<div class="esiui-ui-select1"><select name="esi[custom_injection_hook]">';
		foreach($injection_hooks as $singleHook) {
			$selected = ($singleHook == $hook) ? 'selected="selected"' : '';
			$select_hooks .= "<option value='{$singleHook}' {$selected}>{$singleHook}</option>";
		}
		$select_hooks .= '</select></div>';
		echo $select_hooks;
	}
}