<?php

// Set global variables
	$esi_optinforms_form1_background = get_option('esi_optinforms_form1_background');
	$esi_optinforms_form1_border = get_option('esi_optinforms_form1_border');
	$esi_optinforms_form1_title = get_option('esi_optinforms_form1_title');
	$esi_optinforms_form1_title_font = get_option('esi_optinforms_form1_title_font');
	$esi_optinforms_form1_title_size = get_option('esi_optinforms_form1_title_size');
	$esi_optinforms_form1_title_color = get_option('esi_optinforms_form1_title_color');
	$esi_optinforms_form1_subtitle = get_option('esi_optinforms_form1_subtitle');
	$esi_optinforms_form1_subtitle_font = get_option('esi_optinforms_form1_subtitle_font');
	$esi_optinforms_form1_subtitle_size = get_option('esi_optinforms_form1_subtitle_size');
	$esi_optinforms_form1_subtitle_color = get_option('esi_optinforms_form1_subtitle_color');
	$esi_optinforms_form1_name_field = get_option('esi_optinforms_form1_name_field');
	$esi_optinforms_form1_email_field = get_option('esi_optinforms_form1_email_field');
	$esi_optinforms_form1_fields_font = get_option('esi_optinforms_form1_fields_font');
	$esi_optinforms_form1_fields_size = get_option('esi_optinforms_form1_fields_size');
	$esi_optinforms_form1_fields_color = get_option('esi_optinforms_form1_fields_color');
	$esi_optinforms_form1_button_text = get_option('esi_optinforms_form1_button_text');
	$esi_optinforms_form1_button_text_font = get_option('esi_optinforms_form1_button_text_font');
	$esi_optinforms_form1_button_text_size = get_option('esi_optinforms_form1_button_text_size');
	$esi_optinforms_form1_button_text_color = get_option('esi_optinforms_form1_button_text_color');
	$esi_optinforms_form1_button_background = get_option('esi_optinforms_form1_button_background');
	$esi_optinforms_form1_disclaimer = get_option('esi_optinforms_form1_disclaimer');
	$esi_optinforms_form1_disclaimer_font = get_option('esi_optinforms_form1_disclaimer_font');
	$esi_optinforms_form1_disclaimer_size = get_option('esi_optinforms_form1_disclaimer_size');
	$esi_optinforms_form1_disclaimer_color = get_option('esi_optinforms_form1_disclaimer_color');
	$esi_optinforms_form1_width = get_option('esi_optinforms_form1_width');
	$esi_optinforms_form1_width_pixels = get_option('esi_optinforms_form1_width_pixels');
	$esi_optinforms_form1_hide_title = get_option('esi_optinforms_form1_hide_title');
	$esi_optinforms_form1_hide_subtitle = get_option('esi_optinforms_form1_hide_subtitle');
	$esi_optinforms_form1_hide_name_field = get_option('esi_optinforms_form1_hide_name_field');
	$esi_optinforms_form1_hide_disclaimer = get_option('esi_optinforms_form1_hide_disclaimer');
	$esi_optinforms_form1_css = get_option('esi_optinforms_form1_css');


// FORM1: default background color
function esi_optinforms_form1_default_background() {
	global $esi_optinforms_form1_background;
	if(empty($esi_optinforms_form1_background)) {
		$esi_optinforms_form1_background = "#FFFFFF";
	}
	return $esi_optinforms_form1_background;
}

// FORM1: default border color
function esi_optinforms_form1_default_border() {
	global $esi_optinforms_form1_border;
	if(empty($esi_optinforms_form1_border)) {
		$esi_optinforms_form1_border = "#E0E0E0";
	}
	return $esi_optinforms_form1_border;
}

// FORM1: default title
function esi_optinforms_form1_default_title() {
	global $esi_optinforms_form1_title;
	if(empty($esi_optinforms_form1_title)) {
		$esi_optinforms_form1_title = __('Get Free Email Updates!', 'esi');
	}
	return $esi_optinforms_form1_title;
}

// FORM1: default title font
function esi_optinforms_form1_default_title_font() {
	global $esi_optinforms_form1_title_font;
	if(empty($esi_optinforms_form1_title_font)) {
		$esi_optinforms_form1_title_font = "Damion";
	}
	return $esi_optinforms_form1_title_font;
}

// FORM1: title font options
function esi_optinforms_get_form1_title_font_options() {
	global $esi_optinforms_form1_title_font;
	global $esi_optinforms_included_fonts;
	foreach ($esi_optinforms_included_fonts as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form1_title_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM1: default title font size
function esi_optinforms_form1_default_title_size() {
	global $esi_optinforms_form1_title_size;
	if(empty($esi_optinforms_form1_title_size)) {
		$esi_optinforms_form1_title_size = "36px";
	}
	return $esi_optinforms_form1_title_size;
}

// FORM1: title font size options
function esi_optinforms_get_form1_title_size_options() {
	global $esi_optinforms_form1_title_size;
	foreach (range(10, 72) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form1_title_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM1: default title color
function esi_optinforms_form1_default_title_color() {
	global $esi_optinforms_form1_title_color;
	if(empty($esi_optinforms_form1_title_color)) {
		$esi_optinforms_form1_title_color = "#eb432c";
	}
	return $esi_optinforms_form1_title_color;
}

// FORM1: default subtitle
function esi_optinforms_form1_default_subtitle() {
	global $esi_optinforms_form1_subtitle;
	if(empty($esi_optinforms_form1_subtitle)) {
		$esi_optinforms_form1_subtitle = __('Signup now and receive an email once I publish new content.', 'esi');
	}
	return $esi_optinforms_form1_subtitle;
}

// FORM1: default subtitle font
function esi_optinforms_form1_default_subtitle_font() {
	global $esi_optinforms_form1_subtitle_font;
	if(empty($esi_optinforms_form1_subtitle_font)) {
		$esi_optinforms_form1_subtitle_font = "Arial";
	}
	return $esi_optinforms_form1_subtitle_font;
}

// FORM1: subtitle font options
function esi_optinforms_get_form1_subtitle_font_options() {
	global $esi_optinforms_form1_subtitle_font;
	global $esi_optinforms_included_fonts;
	foreach ($esi_optinforms_included_fonts as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form1_subtitle_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM1: default subtitle font size
function esi_optinforms_form1_default_subtitle_size() {
	global $esi_optinforms_form1_subtitle_size;
	if(empty($esi_optinforms_form1_subtitle_size)) {
		$esi_optinforms_form1_subtitle_size = "16px";
	}
	return $esi_optinforms_form1_subtitle_size;
}

// FORM1: subtitle font size options
function esi_optinforms_get_form1_subtitle_size_options() {
	global $esi_optinforms_form1_subtitle_size;
	foreach (range(10, 72) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form1_subtitle_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM1: default subtitle color
function esi_optinforms_form1_default_subtitle_color() {
	global $esi_optinforms_form1_subtitle_color;
	if(empty($esi_optinforms_form1_subtitle_color)) {
		$esi_optinforms_form1_subtitle_color = "#000000";
	}
	return $esi_optinforms_form1_subtitle_color;
}

// FORM1: default name field
function esi_optinforms_form1_default_name_field() {
	global $esi_optinforms_form1_name_field;
	if(empty($esi_optinforms_form1_name_field)) {
		$esi_optinforms_form1_name_field = __('Enter Your Name', 'esi');
	}
	return $esi_optinforms_form1_name_field;
}

// FORM1: default email field
function esi_optinforms_form1_default_email_field() {
	global $esi_optinforms_form1_email_field;
	if(empty($esi_optinforms_form1_email_field)) {
		$esi_optinforms_form1_email_field = __('Enter Your Email Address', 'esi');
	}
	return $esi_optinforms_form1_email_field;
}

// FORM1: default email fields font
function esi_optinforms_form1_default_fields_font() {
	global $esi_optinforms_form1_fields_font;
	if(empty($esi_optinforms_form1_fields_font)) {
		$esi_optinforms_form1_fields_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form1_fields_font;
}

// FORM1: email fields font options
function esi_optinforms_get_form1_fields_font_options() {
	global $esi_optinforms_form1_fields_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form1_fields_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM1: email fields font size
function esi_optinforms_form1_default_fields_size() {
	global $esi_optinforms_form1_fields_size;
	if(empty($esi_optinforms_form1_fields_size)) {
		$esi_optinforms_form1_fields_size = "12px";
	}
	return $esi_optinforms_form1_fields_size;
}

// FORM1: email fields font size options
function esi_optinforms_get_form1_fields_size_options() {
	global $esi_optinforms_form1_fields_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form1_fields_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM1: default fields color
function esi_optinforms_form1_default_fields_color() {
	global $esi_optinforms_form1_fields_color;
	if(empty($esi_optinforms_form1_fields_color)) {
		$esi_optinforms_form1_fields_color = "#666666";
	}
	return $esi_optinforms_form1_fields_color;
}

// FORM1: default button text
function esi_optinforms_form1_default_button_text() {
	global $esi_optinforms_form1_button_text;
	if(empty($esi_optinforms_form1_button_text)) {
		$esi_optinforms_form1_button_text = __('SIGN UP', 'esi');
	}
	return $esi_optinforms_form1_button_text;
}

// FORM1: default button text font
function esi_optinforms_form1_default_button_text_font() {
	global $esi_optinforms_form1_button_text_font;
	if(empty($esi_optinforms_form1_button_text_font)) {
		$esi_optinforms_form1_button_text_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form1_button_text_font;
}

// FORM1: button text font options
function esi_optinforms_get_form1_button_text_font_options() {
	global $esi_optinforms_form1_button_text_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form1_button_text_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM1: button text font size
function esi_optinforms_form1_default_button_text_size() {
	global $esi_optinforms_form1_button_text_size;
	if(empty($esi_optinforms_form1_button_text_size)) {
		$esi_optinforms_form1_button_text_size = "14px";
	}
	return $esi_optinforms_form1_button_text_size;
}

// FORM1: button text font size options
function esi_optinforms_get_form1_button_text_size_options() {
	global $esi_optinforms_form1_button_text_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form1_button_text_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM1: default button text color
function esi_optinforms_form1_default_button_text_color() {
	global $esi_optinforms_form1_button_text_color;
	if(empty($esi_optinforms_form1_button_text_color)) {
		$esi_optinforms_form1_button_text_color = "#FFFFFF";
	}
	return $esi_optinforms_form1_button_text_color;
}

// FORM1: default button background color
function esi_optinforms_form1_default_button_background() {
	global $esi_optinforms_form1_button_background;
	if(empty($esi_optinforms_form1_button_background)) {
		$esi_optinforms_form1_button_background = "#20A64C";
	}
	return $esi_optinforms_form1_button_background;
}

// FORM1: default disclaimer
function esi_optinforms_form1_default_disclaimer() {
	global $esi_optinforms_form1_disclaimer;
	if(empty($esi_optinforms_form1_disclaimer)) {
		$esi_optinforms_form1_disclaimer = __('I will never give away, trade or sell your email address. You can unsubscribe at any time.', 'esi');
	}
	return $esi_optinforms_form1_disclaimer;
}

// FORM1: default disclaimer font
function esi_optinforms_form1_default_disclaimer_font() {
	global $esi_optinforms_form1_disclaimer_font;
	if(empty($esi_optinforms_form1_disclaimer_font)) {
		$esi_optinforms_form1_disclaimer_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form1_disclaimer_font;
}

// FORM1: disclaimer font options
function esi_optinforms_get_form1_disclaimer_font_options() {
	global $esi_optinforms_form1_disclaimer_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form1_disclaimer_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM1: disclaimer font size
function esi_optinforms_form1_default_disclaimer_size() {
	global $esi_optinforms_form1_disclaimer_size;
	if(empty($esi_optinforms_form1_disclaimer_size)) {
		$esi_optinforms_form1_disclaimer_size = "12px";
	}
	return $esi_optinforms_form1_disclaimer_size;
}

// FORM1: disclaimer font size options
function esi_optinforms_get_form1_disclaimer_size_options() {
	global $esi_optinforms_form1_disclaimer_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form1_disclaimer_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM1: default disclaimer color
function esi_optinforms_form1_default_disclaimer_color() {
	global $esi_optinforms_form1_disclaimer_color;
	if(empty($esi_optinforms_form1_disclaimer_color)) {
		$esi_optinforms_form1_disclaimer_color = "#666666";
	}
	return $esi_optinforms_form1_disclaimer_color;
}

// FORM1: default width
function esi_optinforms_form1_default_width() {
	global $esi_optinforms_form1_width;
	if(empty($esi_optinforms_form1_width)) {
		$esi_optinforms_form1_width = 0;
	}
}

// FORM1: 100% width checked
function esi_optinforms_form1_checked_width_100() {
	global $esi_optinforms_form1_width;
	if($esi_optinforms_form1_width == 0) {
		echo "checked=\"checked\"";
	}
}

// FORM1: fixed width checked
function esi_optinforms_form1_checked_width_fixed() {
	global $esi_optinforms_form1_width;
	if($esi_optinforms_form1_width == 1) {
		echo "checked=\"checked\"";
	}
}

// FORM1: fixed width disabled if width is 100%
function esi_optinforms_form1_disabled_width_pixels() {
	global $esi_optinforms_form1_width;
	if($esi_optinforms_form1_width == 0) {
		echo "disabled=\"disabled\"";
	}
}

// FORM1: default width fixed
function esi_optinforms_form1_default_width_pixels() {
	global $esi_optinforms_form1_width_pixels;
	if(empty($esi_optinforms_form1_width_pixels)) {
		$esi_optinforms_form1_width_pixels = "700";
	}
	return $esi_optinforms_form1_width_pixels;
}

// FORM1: default width fixed
function esi_optinforms_form1_get_width() {
	global $esi_optinforms_form1_width;
	if($esi_optinforms_form1_width == 0) {
		// do nothing
	}
	elseif($esi_optinforms_form1_width == 1) {
		return "style=\"width:" . esi_optinforms_form1_default_width_pixels() . "px\"";
	}
}

// FORM1: hide the title
function esi_optinforms_form1_hide_title() {
	global $esi_optinforms_form1_hide_title;
	return $esi_optinforms_form1_hide_title;
}

// FORM1: hide the title - convert to CSS
function esi_optinforms_form1_hide_title_css() {
	global $esi_optinforms_form1_hide_title;
	if($esi_optinforms_form1_hide_title == 1) {
		return "#esi-optinforms-form1-title{display:none;}";
	}
}

// FORM1: hide the subtitle
function esi_optinforms_form1_hide_subtitle() {
	global $esi_optinforms_form1_hide_subtitle;
	return $esi_optinforms_form1_hide_subtitle;
}

// FORM1: hide the subtitle - convert to CSS
function esi_optinforms_form1_hide_subtitle_css() {
	global $esi_optinforms_form1_hide_subtitle;
	if($esi_optinforms_form1_hide_subtitle == 1) {
		return "#esi-optinforms-form1-subtitle{display:none;}";
	}
}

// FORM1: hide the name field
function esi_optinforms_form1_hide_name_field() {
	global $esi_optinforms_form1_hide_name_field;
	return $esi_optinforms_form1_hide_name_field;
}

// FORM1: hide the name field - convert to CSS
function esi_optinforms_form1_hide_name_field_css() {
	global $esi_optinforms_form1_hide_name_field;
	if($esi_optinforms_form1_hide_name_field == 1) {
		return "#esi-optinforms-form1-name-field-container{display:none;}#esi-optinforms-form1-email-field-container{width:78%;}";
	}
}

// FORM1: hide the disclaimer
function esi_optinforms_form1_hide_disclaimer() {
	global $esi_optinforms_form1_hide_disclaimer;
	return $esi_optinforms_form1_hide_disclaimer;
}

// FORM1: hide the disclaimer - convert to CSS
function esi_optinforms_form1_hide_disclaimer_css() {
	global $esi_optinforms_form1_hide_disclaimer;
	if($esi_optinforms_form1_hide_disclaimer == 1) {
		return "#esi-optinforms-form1-disclaimer{display:none;}";
	}
}

// FORM1: get our custom CSS
function esi_optinforms_form1_css() {
	global $esi_optinforms_form1_css;
	return $esi_optinforms_form1_css;
}

// FORM1: advanced styling options
function esi_optinforms_form1_add_custom_css() {
	global $esi_optinforms_form1_css;
	return "<style type='text/css'>" . esi_optinforms_form1_hide_title_css() . esi_optinforms_form1_hide_subtitle_css() . esi_optinforms_form1_hide_name_field_css() . esi_optinforms_form1_hide_disclaimer_css() . $esi_optinforms_form1_css . "</style>";
}

?>