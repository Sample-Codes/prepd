<?php

// Set global variables
	$esi_optinforms_form2_background = get_option('esi_optinforms_form2_background');
	$esi_optinforms_form2_title = get_option('esi_optinforms_form2_title');
	$esi_optinforms_form2_title_font = get_option('esi_optinforms_form2_title_font');
	$esi_optinforms_form2_title_size = get_option('esi_optinforms_form2_title_size');
	$esi_optinforms_form2_title_color = get_option('esi_optinforms_form2_title_color');
	$esi_optinforms_form2_email_field = get_option('esi_optinforms_form2_email_field');
	$esi_optinforms_form2_fields_font = get_option('esi_optinforms_form2_fields_font');
	$esi_optinforms_form2_fields_size = get_option('esi_optinforms_form2_fields_size');
	$esi_optinforms_form2_fields_color = get_option('esi_optinforms_form2_fields_color');
	$esi_optinforms_form2_button_text = get_option('esi_optinforms_form2_button_text');
	$esi_optinforms_form2_button_text_font = get_option('esi_optinforms_form2_button_text_font');
	$esi_optinforms_form2_button_text_size = get_option('esi_optinforms_form2_button_text_size');
	$esi_optinforms_form2_button_text_color = get_option('esi_optinforms_form2_button_text_color');
	$esi_optinforms_form2_button_background = get_option('esi_optinforms_form2_button_background');
	$esi_optinforms_form2_disclaimer = get_option('esi_optinforms_form2_disclaimer');
	$esi_optinforms_form2_disclaimer_font = get_option('esi_optinforms_form2_disclaimer_font');
	$esi_optinforms_form2_disclaimer_size = get_option('esi_optinforms_form2_disclaimer_size');
	$esi_optinforms_form2_disclaimer_color = get_option('esi_optinforms_form2_disclaimer_color');
	$esi_optinforms_form2_width = get_option('esi_optinforms_form2_width');
	$esi_optinforms_form2_width_pixels = get_option('esi_optinforms_form2_width_pixels');
	$esi_optinforms_form2_hide_title = get_option('esi_optinforms_form2_hide_title');
	$esi_optinforms_form2_hide_disclaimer = get_option('esi_optinforms_form2_hide_disclaimer');
	$esi_optinforms_form2_css = get_option('esi_optinforms_form2_css');


// FORM2: default background color
function esi_optinforms_form2_default_background() {
	global $esi_optinforms_form2_background;
	if(empty($esi_optinforms_form2_background)) {
		$esi_optinforms_form2_background = "#266d7c";
	}
	return $esi_optinforms_form2_background;
}

// FORM2: default title
function esi_optinforms_form2_default_title() {
	global $esi_optinforms_form2_title;
	if(empty($esi_optinforms_form2_title)) {
		$esi_optinforms_form2_title = __('Receive Updates', 'esi');
	}
	return $esi_optinforms_form2_title;
}

// FORM2: default title font
function esi_optinforms_form2_default_title_font() {
	global $esi_optinforms_form2_title_font;
	if(empty($esi_optinforms_form2_title_font)) {
		$esi_optinforms_form2_title_font = "Pacifico";
	}
	return $esi_optinforms_form2_title_font;
}

// FORM2: title font options
function esi_optinforms_get_form2_title_font_options() {
	global $esi_optinforms_form2_title_font;
	global $esi_optinforms_included_fonts;
	foreach ($esi_optinforms_included_fonts as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form2_title_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM2: default title font size
function esi_optinforms_form2_default_title_size() {
	global $esi_optinforms_form2_title_size;
	if(empty($esi_optinforms_form2_title_size)) {
		$esi_optinforms_form2_title_size = "28px";
	}
	return $esi_optinforms_form2_title_size;
}

// FORM2: title font size options
function esi_optinforms_get_form2_title_size_options() {
	global $esi_optinforms_form2_title_size;
	foreach (range(10, 72) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form2_title_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM2: default title color
function esi_optinforms_form2_default_title_color() {
	global $esi_optinforms_form2_title_color;
	if(empty($esi_optinforms_form2_title_color)) {
		$esi_optinforms_form2_title_color = "#ffffff";
	}
	return $esi_optinforms_form2_title_color;
}

// FORM2: default email field
function esi_optinforms_form2_default_email_field() {
	global $esi_optinforms_form2_email_field;
	if(empty($esi_optinforms_form2_email_field)) {
		$esi_optinforms_form2_email_field = __('Enter Your Email Address', 'esi');
	}
	return $esi_optinforms_form2_email_field;
}

// FORM2: default email fields font
function esi_optinforms_form2_default_fields_font() {
	global $esi_optinforms_form2_fields_font;
	if(empty($esi_optinforms_form2_fields_font)) {
		$esi_optinforms_form2_fields_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form2_fields_font;
}

// FORM2: email fields font options
function esi_optinforms_get_form2_fields_font_options() {
	global $esi_optinforms_form2_fields_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form2_fields_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM2: email fields font size
function esi_optinforms_form2_default_fields_size() {
	global $esi_optinforms_form2_fields_size;
	if(empty($esi_optinforms_form2_fields_size)) {
		$esi_optinforms_form2_fields_size = "12px";
	}
	return $esi_optinforms_form2_fields_size;
}

// FORM2: email fields font size options
function esi_optinforms_get_form2_fields_size_options() {
	global $esi_optinforms_form2_fields_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form2_fields_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM2: email fields color
function esi_optinforms_form2_default_fields_color() {
	global $esi_optinforms_form2_fields_color;
	if(empty($esi_optinforms_form2_fields_color)) {
		$esi_optinforms_form2_fields_color = "#000000";
	}
	return $esi_optinforms_form2_fields_color;
}

// FORM2: default button text
function esi_optinforms_form2_default_button_text() {
	global $esi_optinforms_form2_button_text;
	if(empty($esi_optinforms_form2_button_text)) {
		$esi_optinforms_form2_button_text = __('Sign Up', 'esi');
	}
	return $esi_optinforms_form2_button_text;
}

// FORM2: default button text font
function esi_optinforms_form2_default_button_text_font() {
	global $esi_optinforms_form2_button_text_font;
	if(empty($esi_optinforms_form2_button_text_font)) {
		$esi_optinforms_form2_button_text_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form2_button_text_font;
}

// FORM2: button text font options
function esi_optinforms_get_form2_button_text_font_options() {
	global $esi_optinforms_form2_button_text_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form2_button_text_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM2: button text font size
function esi_optinforms_form2_default_button_text_size() {
	global $esi_optinforms_form2_button_text_size;
	if(empty($esi_optinforms_form2_button_text_size)) {
		$esi_optinforms_form2_button_text_size = "14px";
	}
	return $esi_optinforms_form2_button_text_size;
}

// FORM2: button text font size options
function esi_optinforms_get_form2_button_text_size_options() {
	global $esi_optinforms_form2_button_text_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form2_button_text_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM2: default button text color
function esi_optinforms_form2_default_button_text_color() {
	global $esi_optinforms_form2_button_text_color;
	if(empty($esi_optinforms_form2_button_text_color)) {
		$esi_optinforms_form2_button_text_color = "#FFFFFF";
	}
	return $esi_optinforms_form2_button_text_color;
}

// FORM2: default button background color
function esi_optinforms_form2_default_button_background() {
	global $esi_optinforms_form2_button_background;
	if(empty($esi_optinforms_form2_button_background)) {
		$esi_optinforms_form2_button_background = "#49A3FE";
	}
	return $esi_optinforms_form2_button_background;
}

// FORM2: default disclaimer
function esi_optinforms_form2_default_disclaimer() {
	global $esi_optinforms_form2_disclaimer;
	if(empty($esi_optinforms_form2_disclaimer)) {
		$esi_optinforms_form2_disclaimer = __('No spam guarantee.', 'esi');
	}
	return $esi_optinforms_form2_disclaimer;
}

// FORM2: default disclaimer font
function esi_optinforms_form2_default_disclaimer_font() {
	global $esi_optinforms_form2_disclaimer_font;
	if(empty($esi_optinforms_form2_disclaimer_font)) {
		$esi_optinforms_form2_disclaimer_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form2_disclaimer_font;
}

// FORM2: disclaimer font options
function esi_optinforms_get_form2_disclaimer_font_options() {
	global $esi_optinforms_form2_disclaimer_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form2_disclaimer_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM2: disclaimer font size
function esi_optinforms_form2_default_disclaimer_size() {
	global $esi_optinforms_form2_disclaimer_size;
	if(empty($esi_optinforms_form2_disclaimer_size)) {
		$esi_optinforms_form2_disclaimer_size = "11px";
	}
	return $esi_optinforms_form2_disclaimer_size;
}

// FORM2: disclaimer font size options
function esi_optinforms_get_form2_disclaimer_size_options() {
	global $esi_optinforms_form2_disclaimer_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form2_disclaimer_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM2: default disclaimer color
function esi_optinforms_form2_default_disclaimer_color() {
	global $esi_optinforms_form2_disclaimer_color;
	if(empty($esi_optinforms_form2_disclaimer_color)) {
		$esi_optinforms_form2_disclaimer_color = "#ffffff";
	}
	return $esi_optinforms_form2_disclaimer_color;
}

// FORM2: default width
function esi_optinforms_form2_default_width() {
	global $esi_optinforms_form2_width;
	if(empty($esi_optinforms_form2_width)) {
		$esi_optinforms_form2_width = 0;
	}
}

// FORM2: 100% width checked
function esi_optinforms_form2_checked_width_100() {
	global $esi_optinforms_form2_width;
	if($esi_optinforms_form2_width == 0) {
		echo "checked=\"checked\"";
	}
}

// FORM2: fixed width checked
function esi_optinforms_form2_checked_width_fixed() {
	global $esi_optinforms_form2_width;
	if($esi_optinforms_form2_width == 1) {
		echo "checked=\"checked\"";
	}
}

// FORM2: fixed width disabled if width is 100%
function esi_optinforms_form2_disabled_width_pixels() {
	global $esi_optinforms_form2_width;
	if($esi_optinforms_form2_width == 0) {
		echo "disabled=\"disabled\"";
	}
}

// FORM2: default width fixed
function esi_optinforms_form2_default_width_pixels() {
	global $esi_optinforms_form2_width_pixels;
	if(empty($esi_optinforms_form2_width_pixels)) {
		$esi_optinforms_form2_width_pixels = "700";
	}
	return $esi_optinforms_form2_width_pixels;
}

// FORM2: default width fixed
function esi_optinforms_form2_get_width() {
	global $esi_optinforms_form2_width;
	if($esi_optinforms_form2_width == 0) {
		// do nothing
	}
	elseif($esi_optinforms_form2_width == 1) {
		return "style=\"width:" . esi_optinforms_form2_default_width_pixels() . "px\"";
	}
}

// FORM2: hide the title
function esi_optinforms_form2_hide_title() {
	global $esi_optinforms_form2_hide_title;
	return $esi_optinforms_form2_hide_title;
}

// FORM2: hide the title - convert to CSS
function esi_optinforms_form2_hide_title_css() {
	global $esi_optinforms_form2_hide_title;
	if($esi_optinforms_form2_hide_title == 1) {
		return "#esi-optinforms-form2-title-container{display:none;}";
	}
}

// FORM2: hide the disclaimer
function esi_optinforms_form2_hide_disclaimer() {
	global $esi_optinforms_form2_hide_disclaimer;
	return $esi_optinforms_form2_hide_disclaimer;
}

// FORM2: hide the disclaimer - convert to CSS
function esi_optinforms_form2_hide_disclaimer_css() {
	global $esi_optinforms_form2_hide_disclaimer;
	if($esi_optinforms_form2_hide_disclaimer == 1) {
		return "#esi-optinforms-form2-disclaimer-container{display:none;}";
	}
}

// FORM2: if both title and disclaimer are hidden, make our email field wider
function esi_optinforms_form2_hide_title_disclaimer_css() {
	global $esi_optinforms_form2_hide_title, $esi_optinforms_form2_hide_disclaimer;
	if(($esi_optinforms_form2_hide_title == 1) && ($esi_optinforms_form2_hide_disclaimer == 1)) {
		return "#esi-optinforms-form2-email-field-container{width:80%;}";
	}
	else if(($esi_optinforms_form2_hide_title == 1)) {
		return "#esi-optinforms-form2-email-field-container{width:62%;}";
	}
	else if(($esi_optinforms_form2_hide_disclaimer == 1)) {
		return "#esi-optinforms-form2-email-field-container{width:48%;}";
	}
}

// FORM2: get our custom CSS
function esi_optinforms_form2_css() {
	global $esi_optinforms_form2_css;
	return $esi_optinforms_form2_css;
}

// FORM2: advanced styling options
function esi_optinforms_form2_add_custom_css() {
	global $esi_optinforms_form2_css;
	return "<style type='text/css'>" . esi_optinforms_form2_hide_title_css() . esi_optinforms_form2_hide_disclaimer_css() . esi_optinforms_form2_hide_title_disclaimer_css() . $esi_optinforms_form2_css . "</style>";
}

?>