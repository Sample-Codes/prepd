<?php

// Set global variables
	$esi_optinforms_form3_background = get_option('esi_optinforms_form3_background');
	$esi_optinforms_form3_title = get_option('esi_optinforms_form3_title');
	$esi_optinforms_form3_title_font = get_option('esi_optinforms_form3_title_font');
	$esi_optinforms_form3_title_size = get_option('esi_optinforms_form3_title_size');
	$esi_optinforms_form3_title_color = get_option('esi_optinforms_form3_title_color');
	$esi_optinforms_form3_subtitle = get_option('esi_optinforms_form3_subtitle');
	$esi_optinforms_form3_subtitle_font = get_option('esi_optinforms_form3_subtitle_font');
	$esi_optinforms_form3_subtitle_size = get_option('esi_optinforms_form3_subtitle_size');
	$esi_optinforms_form3_subtitle_color = get_option('esi_optinforms_form3_subtitle_color');
	$esi_optinforms_form3_name_field = get_option('esi_optinforms_form3_name_field');
	$esi_optinforms_form3_email_field = get_option('esi_optinforms_form3_email_field');
	$esi_optinforms_form3_fields_font = get_option('esi_optinforms_form3_fields_font');
	$esi_optinforms_form3_fields_size = get_option('esi_optinforms_form3_fields_size');
	$esi_optinforms_form3_fields_color = get_option('esi_optinforms_form3_fields_color');
	$esi_optinforms_form3_button_text = get_option('esi_optinforms_form3_button_text');
	$esi_optinforms_form3_button_text_font = get_option('esi_optinforms_form3_button_text_font');
	$esi_optinforms_form3_button_text_size = get_option('esi_optinforms_form3_button_text_size');
	$esi_optinforms_form3_button_text_color = get_option('esi_optinforms_form3_button_text_color');
	$esi_optinforms_form3_button_background = get_option('esi_optinforms_form3_button_background');
	$esi_optinforms_form3_width = get_option('esi_optinforms_form3_width');
	$esi_optinforms_form3_width_pixels = get_option('esi_optinforms_form3_width_pixels');
	$esi_optinforms_form3_hide_title = get_option('esi_optinforms_form3_hide_title');
	$esi_optinforms_form3_hide_subtitle = get_option('esi_optinforms_form3_hide_subtitle');
	$esi_optinforms_form3_hide_name_field = get_option('esi_optinforms_form3_hide_name_field');
	$esi_optinforms_form3_css = get_option('esi_optinforms_form3_css');


// FORM3: default background color
function esi_optinforms_form3_default_background() {
	global $esi_optinforms_form3_background;
	if(empty($esi_optinforms_form3_background)) {
		$esi_optinforms_form3_background = "#FFFFFF";
	}
	return $esi_optinforms_form3_background;
}

// FORM3: default title
function esi_optinforms_form3_default_title() {
	global $esi_optinforms_form3_title;
	if(empty($esi_optinforms_form3_title)) {
		$esi_optinforms_form3_title = __('Did you enjoy this article?', 'esi');
	}
	return $esi_optinforms_form3_title;
}

// FORM3: default title font
function esi_optinforms_form3_default_title_font() {
	global $esi_optinforms_form3_title_font;
	if(empty($esi_optinforms_form3_title_font)) {
		$esi_optinforms_form3_title_font = "Droid Serif";
	}
	return $esi_optinforms_form3_title_font;
}

// FORM3: title font options
function esi_optinforms_get_form3_title_font_options() {
	global $esi_optinforms_form3_title_font;
	global $esi_optinforms_included_fonts;
	foreach ($esi_optinforms_included_fonts as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form3_title_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM3: default title font size
function esi_optinforms_form3_default_title_size() {
	global $esi_optinforms_form3_title_size;
	if(empty($esi_optinforms_form3_title_size)) {
		$esi_optinforms_form3_title_size = "28px";
	}
	return $esi_optinforms_form3_title_size;
}

// FORM3: title font size options
function esi_optinforms_get_form3_title_size_options() {
	global $esi_optinforms_form3_title_size;
	foreach (range(10, 72) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form3_title_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM3: default title color
function esi_optinforms_form3_default_title_color() {
	global $esi_optinforms_form3_title_color;
	if(empty($esi_optinforms_form3_title_color)) {
		$esi_optinforms_form3_title_color = "#505050";
	}
	return $esi_optinforms_form3_title_color;
}

// FORM3: default subtitle
function esi_optinforms_form3_default_subtitle() {
	global $esi_optinforms_form3_subtitle;
	if(empty($esi_optinforms_form3_subtitle)) {
		$esi_optinforms_form3_subtitle = __('Signup today and receive free updates straight in your inbox. We will never share or sell your email address.', 'esi');
	}
	return $esi_optinforms_form3_subtitle;
}

// FORM3: default subtitle font
function esi_optinforms_form3_default_subtitle_font() {
	global $esi_optinforms_form3_subtitle_font;
	if(empty($esi_optinforms_form3_subtitle_font)) {
		$esi_optinforms_form3_subtitle_font = "Arial";
	}
	return $esi_optinforms_form3_subtitle_font;
}

// FORM3: subtitle font options
function esi_optinforms_get_form3_subtitle_font_options() {
	global $esi_optinforms_form3_subtitle_font;
	global $esi_optinforms_included_fonts;
	foreach ($esi_optinforms_included_fonts as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form3_subtitle_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM3: default subtitle font size
function esi_optinforms_form3_default_subtitle_size() {
	global $esi_optinforms_form3_subtitle_size;
	if(empty($esi_optinforms_form3_subtitle_size)) {
		$esi_optinforms_form3_subtitle_size = "16px";
	}
	return $esi_optinforms_form3_subtitle_size;
}

// FORM3: subtitle font size options
function esi_optinforms_get_form3_subtitle_size_options() {
	global $esi_optinforms_form3_subtitle_size;
	foreach (range(10, 24) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form3_subtitle_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM3: default subtitle color
function esi_optinforms_form3_default_subtitle_color() {
	global $esi_optinforms_form3_subtitle_color;
	if(empty($esi_optinforms_form3_subtitle_color)) {
		$esi_optinforms_form3_subtitle_color = "#000000";
	}
	return $esi_optinforms_form3_subtitle_color;
}

// FORM3: default name field
function esi_optinforms_form3_default_name_field() {
	global $esi_optinforms_form3_name_field;
	if(empty($esi_optinforms_form3_name_field)) {
		$esi_optinforms_form3_name_field = __('Your Name', 'esi');
	}
	return $esi_optinforms_form3_name_field;
}

// FORM3: default email field
function esi_optinforms_form3_default_email_field() {
	global $esi_optinforms_form3_email_field;
	if(empty($esi_optinforms_form3_email_field)) {
		$esi_optinforms_form3_email_field = __('Your Email Address', 'esi');
	}
	return $esi_optinforms_form3_email_field;
}

// FORM3: default email fields font
function esi_optinforms_form3_default_fields_font() {
	global $esi_optinforms_form3_fields_font;
	if(empty($esi_optinforms_form3_fields_font)) {
		$esi_optinforms_form3_fields_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form3_fields_font;
}

// FORM3: email fields font options
function esi_optinforms_get_form3_fields_font_options() {
	global $esi_optinforms_form3_fields_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form3_fields_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM3: email fields font size
function esi_optinforms_form3_default_fields_size() {
	global $esi_optinforms_form3_fields_size;
	if(empty($esi_optinforms_form3_fields_size)) {
		$esi_optinforms_form3_fields_size = "12px";
	}
	return $esi_optinforms_form3_fields_size;
}

// FORM3: email fields font size options
function esi_optinforms_get_form3_fields_size_options() {
	global $esi_optinforms_form3_fields_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form3_fields_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM3: default fields color
function esi_optinforms_form3_default_fields_color() {
	global $esi_optinforms_form3_fields_color;
	if(empty($esi_optinforms_form3_fields_color)) {
		$esi_optinforms_form3_fields_color = "#666666";
	}
	return $esi_optinforms_form3_fields_color;
}

// FORM3: default button text
function esi_optinforms_form3_default_button_text() {
	global $esi_optinforms_form3_button_text;
	if(empty($esi_optinforms_form3_button_text)) {
		$esi_optinforms_form3_button_text = __('Sign Up Today!', 'esi');
	}
	return $esi_optinforms_form3_button_text;
}

// FORM3: default button text font
function esi_optinforms_form3_default_button_text_font() {
	global $esi_optinforms_form3_button_text_font;
	if(empty($esi_optinforms_form3_button_text_font)) {
		$esi_optinforms_form3_button_text_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form3_button_text_font;
}

// FORM3: button text font options
function esi_optinforms_get_form3_button_text_font_options() {
	global $esi_optinforms_form3_button_text_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form3_button_text_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM3: button text font size
function esi_optinforms_form3_default_button_text_size() {
	global $esi_optinforms_form3_button_text_size;
	if(empty($esi_optinforms_form3_button_text_size)) {
		$esi_optinforms_form3_button_text_size = "18px";
	}
	return $esi_optinforms_form3_button_text_size;
}

// FORM3: button text font size options
function esi_optinforms_get_form3_button_text_size_options() {
	global $esi_optinforms_form3_button_text_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form3_button_text_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM3: default button text color
function esi_optinforms_form3_default_button_text_color() {
	global $esi_optinforms_form3_button_text_color;
	if(empty($esi_optinforms_form3_button_text_color)) {
		$esi_optinforms_form3_button_text_color = "#FFFFFF";
	}
	return $esi_optinforms_form3_button_text_color;
}

// FORM3: default button background color
function esi_optinforms_form3_default_button_background() {
	global $esi_optinforms_form3_button_background;
	if(empty($esi_optinforms_form3_button_background)) {
		$esi_optinforms_form3_button_background = "#49A3FE";
	}
	return $esi_optinforms_form3_button_background;
}

// FORM3: default width
function esi_optinforms_form3_default_width() {
	global $esi_optinforms_form3_width;
	if(empty($esi_optinforms_form3_width)) {
		$esi_optinforms_form3_width = 0;
	}
}

// FORM3: 100% width checked
function esi_optinforms_form3_checked_width_100() {
	global $esi_optinforms_form3_width;
	if($esi_optinforms_form3_width == 0) {
		echo "checked=\"checked\"";
	}
}

// FORM3: fixed width checked
function esi_optinforms_form3_checked_width_fixed() {
	global $esi_optinforms_form3_width;
	if($esi_optinforms_form3_width == 1) {
		echo "checked=\"checked\"";
	}
}

// FORM3: fixed width disabled if width is 100%
function esi_optinforms_form3_disabled_width_pixels() {
	global $esi_optinforms_form3_width;
	if($esi_optinforms_form3_width == 0) {
		echo "disabled=\"disabled\"";
	}
}

// FORM3: default width fixed
function esi_optinforms_form3_default_width_pixels() {
	global $esi_optinforms_form3_width_pixels;
	if(empty($esi_optinforms_form3_width_pixels)) {
		$esi_optinforms_form3_width_pixels = "700";
	}
	return $esi_optinforms_form3_width_pixels;
}

// FORM3: default width fixed
function esi_optinforms_form3_get_width() {
	global $esi_optinforms_form3_width;
	if($esi_optinforms_form3_width == 0) {
		// do nothing
	}
	elseif($esi_optinforms_form3_width == 1) {
		return "style=\"width:" . esi_optinforms_form3_default_width_pixels() . "px\"";
	}
}

// FORM3: hide the title
function esi_optinforms_form3_hide_title() {
	global $esi_optinforms_form3_hide_title;
	return $esi_optinforms_form3_hide_title;
}

// FORM1: hide the title - convert to CSS
function esi_optinforms_form3_hide_title_css() {
	global $esi_optinforms_form3_hide_title;
	if($esi_optinforms_form3_hide_title == 1) {
		return "#esi-optinforms-form3-title{display:none;}";
	}
}

// FORM3: hide the subtitle
function esi_optinforms_form3_hide_subtitle() {
	global $esi_optinforms_form3_hide_subtitle;
	return $esi_optinforms_form3_hide_subtitle;
}

// FORM3: hide the subtitle - convert to CSS
function esi_optinforms_form3_hide_subtitle_css() {
	global $esi_optinforms_form3_hide_subtitle;
	if($esi_optinforms_form3_hide_subtitle == 1) {
		return "#esi-optinforms-form3-subtitle{display:none;}";
	}
}

// FORM3: if both title and subtitle are hidden, hide the left container
function esi_optinforms_form3_hide_title_subtitle_css() {
	global $esi_optinforms_form3_hide_title, $esi_optinforms_form3_hide_subtitle;
	if(($esi_optinforms_form3_hide_title == 1) && ($esi_optinforms_form3_hide_subtitle == 1)) {
		return "#esi-optinforms-form3-container-left{display:none;}#esi-optinforms-form3-container-right{margin:10px 0 0 0;width:100%;}";
	}
}

// FORM3: hide the name field
function esi_optinforms_form3_hide_name_field() {
	global $esi_optinforms_form3_hide_name_field;
	return $esi_optinforms_form3_hide_name_field;
}

// FORM3: hide the name field - convert to CSS
function esi_optinforms_form3_hide_name_field_css() {
	global $esi_optinforms_form3_hide_name_field;
	if($esi_optinforms_form3_hide_name_field == 1) {
		return "#esi-optinforms-form3-name-field{display:none;}";
	}
}

// FORM3: get our custom CSS
function esi_optinforms_form3_css() {
	global $esi_optinforms_form3_css;
	return $esi_optinforms_form3_css;
}

// FORM3: advanced styling options
function esi_optinforms_form3_add_custom_css() {
	global $esi_optinforms_form3_css;
	return "<style type='text/css'>" . esi_optinforms_form3_hide_title_css() . esi_optinforms_form3_hide_subtitle_css() . esi_optinforms_form3_hide_title_subtitle_css() . esi_optinforms_form3_hide_name_field_css() . $esi_optinforms_form3_css . "</style>";
}

?>