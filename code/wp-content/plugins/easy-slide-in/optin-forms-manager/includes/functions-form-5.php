<?php

// Set global variables
	$esi_optinforms_form5_background = get_option('esi_optinforms_form5_background');
	$esi_optinforms_form5_title = get_option('esi_optinforms_form5_title');
	$esi_optinforms_form5_title_font = get_option('esi_optinforms_form5_title_font');
	$esi_optinforms_form5_title_size = get_option('esi_optinforms_form5_title_size');
	$esi_optinforms_form5_title_color = get_option('esi_optinforms_form5_title_color');
	$esi_optinforms_form5_subtitle = get_option('esi_optinforms_form5_subtitle');
	$esi_optinforms_form5_subtitle_font = get_option('esi_optinforms_form5_subtitle_font');
	$esi_optinforms_form5_subtitle_size = get_option('esi_optinforms_form5_subtitle_size');
	$esi_optinforms_form5_subtitle_color = get_option('esi_optinforms_form5_subtitle_color');
	$esi_optinforms_form5_name_field = get_option('esi_optinforms_form5_name_field');
	$esi_optinforms_form5_email_field = get_option('esi_optinforms_form5_email_field');
	$esi_optinforms_form5_fields_font = get_option('esi_optinforms_form5_fields_font');
	$esi_optinforms_form5_fields_size = get_option('esi_optinforms_form5_fields_size');
	$esi_optinforms_form5_fields_color = get_option('esi_optinforms_form5_fields_color');
	$esi_optinforms_form5_button_text = get_option('esi_optinforms_form5_button_text');
	$esi_optinforms_form5_button_text_font = get_option('esi_optinforms_form5_button_text_font');
	$esi_optinforms_form5_button_text_size = get_option('esi_optinforms_form5_button_text_size');
	$esi_optinforms_form5_button_text_color = get_option('esi_optinforms_form5_button_text_color');
	$esi_optinforms_form5_button_background = get_option('esi_optinforms_form5_button_background');
	$esi_optinforms_form5_disclaimer = get_option('esi_optinforms_form5_disclaimer');
	$esi_optinforms_form5_disclaimer_font = get_option('esi_optinforms_form5_disclaimer_font');
	$esi_optinforms_form5_disclaimer_size = get_option('esi_optinforms_form5_disclaimer_size');
	$esi_optinforms_form5_disclaimer_color = get_option('esi_optinforms_form5_disclaimer_color');
	$esi_optinforms_form5_width = get_option('esi_optinforms_form5_width');
	$esi_optinforms_form5_width_pixels = get_option('esi_optinforms_form5_width_pixels');
	$esi_optinforms_form5_hide_title = get_option('esi_optinforms_form5_hide_title');
	$esi_optinforms_form5_hide_subtitle = get_option('esi_optinforms_form5_hide_subtitle');
	$esi_optinforms_form5_hide_name_field = get_option('esi_optinforms_form5_hide_name_field');
	$esi_optinforms_form5_hide_disclaimer = get_option('esi_optinforms_form5_hide_disclaimer');
	$esi_optinforms_form5_css = get_option('esi_optinforms_form5_css');


// FORM5: default background color
function esi_optinforms_form5_default_background() {
	global $esi_optinforms_form5_background;
	if(empty($esi_optinforms_form5_background)) {
		$esi_optinforms_form5_background = "#333333";
	}
	return $esi_optinforms_form5_background;
}

// FORM5: default title
function esi_optinforms_form5_default_title() {
	global $esi_optinforms_form5_title;
	if(empty($esi_optinforms_form5_title)) {
		$esi_optinforms_form5_title = __('JOIN OUR NEWSLETTER', 'esi');
	}
	return $esi_optinforms_form5_title;
}

// FORM5: default title font
function esi_optinforms_form5_default_title_font() {
	global $esi_optinforms_form5_title_font;
	if(empty($esi_optinforms_form5_title_font)) {
		$esi_optinforms_form5_title_font = "News Cycle";
	}
	return $esi_optinforms_form5_title_font;
}

// FORM5: title font options
function esi_optinforms_get_form5_title_font_options() {
	global $esi_optinforms_form5_title_font;
	global $esi_optinforms_included_fonts;
	foreach ($esi_optinforms_included_fonts as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form5_title_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM5: default title font size
function esi_optinforms_form5_default_title_size() {
	global $esi_optinforms_form5_title_size;
	if(empty($esi_optinforms_form5_title_size)) {
		$esi_optinforms_form5_title_size = "24px";
	}
	return $esi_optinforms_form5_title_size;
}

// FORM5: title font size options
function esi_optinforms_get_form5_title_size_options() {
	global $esi_optinforms_form5_title_size;
	foreach (range(10, 72) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form5_title_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM5: default title color
function esi_optinforms_form5_default_title_color() {
	global $esi_optinforms_form5_title_color;
	if(empty($esi_optinforms_form5_title_color)) {
		$esi_optinforms_form5_title_color = "#fb6a13";
	}
	return $esi_optinforms_form5_title_color;
}

// FORM5: default subtitle
function esi_optinforms_form5_default_subtitle() {
	global $esi_optinforms_form5_subtitle;
	if(empty($esi_optinforms_form5_subtitle)) {
		$esi_optinforms_form5_subtitle = __('Join over 3.000 visitors who are receiving our newsletter and learn how to optimize your blog for search engines, find free traffic, and monetize your website.', 'esi');
	}
	return $esi_optinforms_form5_subtitle;
}

// FORM5: default subtitle font
function esi_optinforms_form5_default_subtitle_font() {
	global $esi_optinforms_form5_subtitle_font;
	if(empty($esi_optinforms_form5_subtitle_font)) {
		$esi_optinforms_form5_subtitle_font = "Georgia";
	}
	return $esi_optinforms_form5_subtitle_font;
}

// FORM5: subtitle font options
function esi_optinforms_get_form5_subtitle_font_options() {
	global $esi_optinforms_form5_subtitle_font;
	global $esi_optinforms_included_fonts;
	foreach ($esi_optinforms_included_fonts as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form5_subtitle_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM5: default subtitle font size
function esi_optinforms_form5_default_subtitle_size() {
	global $esi_optinforms_form5_subtitle_size;
	if(empty($esi_optinforms_form5_subtitle_size)) {
		$esi_optinforms_form5_subtitle_size = "16px";
	}
	return $esi_optinforms_form5_subtitle_size;
}

// FORM5: subtitle font size options
function esi_optinforms_get_form5_subtitle_size_options() {
	global $esi_optinforms_form5_subtitle_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form5_subtitle_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM5: default subtitle color
function esi_optinforms_form5_default_subtitle_color() {
	global $esi_optinforms_form5_subtitle_color;
	if(empty($esi_optinforms_form5_subtitle_color)) {
		$esi_optinforms_form5_subtitle_color = "#cccccc";
	}
	return $esi_optinforms_form5_subtitle_color;
}

// FORM5: default name field
function esi_optinforms_form5_default_name_field() {

	global $esi_optinforms_form5_name_field;
	if(empty($esi_optinforms_form5_name_field)) {
		$esi_optinforms_form5_name_field = __('Enter Your Name', 'esi');
	}
	return $esi_optinforms_form5_name_field;
}

// FORM5: default email field
function esi_optinforms_form5_default_email_field() {
	global $esi_optinforms_form5_email_field;
	if(empty($esi_optinforms_form5_email_field)) {
		$esi_optinforms_form5_email_field = __('Enter Your Email', 'esi');
	}
	return $esi_optinforms_form5_email_field;
}

// FORM5: default email fields font
function esi_optinforms_form5_default_fields_font() {
	global $esi_optinforms_form5_fields_font;
	if(empty($esi_optinforms_form5_fields_font)) {
		$esi_optinforms_form5_fields_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form5_fields_font;
}

// FORM5: email fields font options
function esi_optinforms_get_form5_fields_font_options() {
	global $esi_optinforms_form5_fields_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form5_fields_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM5: email fields font size
function esi_optinforms_form5_default_fields_size() {
	global $esi_optinforms_form5_fields_size;
	if(empty($esi_optinforms_form5_fields_size)) {
		$esi_optinforms_form5_fields_size = "12px";
	}
	return $esi_optinforms_form5_fields_size;
}

// FORM5: email fields font size options
function esi_optinforms_get_form5_fields_size_options() {
	global $esi_optinforms_form5_fields_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form5_fields_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM5: default fields color
function esi_optinforms_form5_default_fields_color() {
	global $esi_optinforms_form5_fields_color;
	if(empty($esi_optinforms_form5_fields_color)) {
		$esi_optinforms_form5_fields_color = "#000000";
	}
	return $esi_optinforms_form5_fields_color;
}

// FORM5: default button text
function esi_optinforms_form5_default_button_text() {
	global $esi_optinforms_form5_button_text;
	if(empty($esi_optinforms_form5_button_text)) {
		$esi_optinforms_form5_button_text = __('SUBSCRIBE FOR FREE', 'esi');
	}
	return $esi_optinforms_form5_button_text;
}

// FORM5: default button text font
function esi_optinforms_form5_default_button_text_font() {
	global $esi_optinforms_form5_button_text_font;
	if(empty($esi_optinforms_form5_button_text_font)) {
		$esi_optinforms_form5_button_text_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form5_button_text_font;
}

// FORM5: button text font options
function esi_optinforms_get_form5_button_text_font_options() {
	global $esi_optinforms_form5_button_text_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form5_button_text_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM5: button text font size
function esi_optinforms_form5_default_button_text_size() {
	global $esi_optinforms_form5_button_text_size;
	if(empty($esi_optinforms_form5_button_text_size)) {
		$esi_optinforms_form5_button_text_size = "16px";
	}
	return $esi_optinforms_form5_button_text_size;
}

// FORM5: button text font size options
function esi_optinforms_get_form5_button_text_size_options() {
	global $esi_optinforms_form5_button_text_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form5_button_text_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM5: default button text color
function esi_optinforms_form5_default_button_text_color() {
	global $esi_optinforms_form5_button_text_color;
	if(empty($esi_optinforms_form5_button_text_color)) {
		$esi_optinforms_form5_button_text_color = "#FFFFFF";
	}
	return $esi_optinforms_form5_button_text_color;
}

// FORM5: default button background color
function esi_optinforms_form5_default_button_background() {
	global $esi_optinforms_form5_button_background;
	if(empty($esi_optinforms_form5_button_background)) {
		$esi_optinforms_form5_button_background = "#fb6a13";
	}
	return $esi_optinforms_form5_button_background;
}

// FORM5: default disclaimer
function esi_optinforms_form5_default_disclaimer() {
	global $esi_optinforms_form5_disclaimer;
	if(empty($esi_optinforms_form5_disclaimer)) {
		$esi_optinforms_form5_disclaimer = __('We hate spam. Your email address will not be sold or shared with anyone else.', 'esi');
	}
	return $esi_optinforms_form5_disclaimer;
}

// FORM5: default disclaimer font
function esi_optinforms_form5_default_disclaimer_font() {
	global $esi_optinforms_form5_disclaimer_font;
	if(empty($esi_optinforms_form5_disclaimer_font)) {
		$esi_optinforms_form5_disclaimer_font = "Georgia, Times New Roman, Times, serif";
	}
	return $esi_optinforms_form5_disclaimer_font;
}

// FORM5: disclaimer font options
function esi_optinforms_get_form5_disclaimer_font_options() {
	global $esi_optinforms_form5_disclaimer_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form5_disclaimer_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM5: disclaimer font size
function esi_optinforms_form5_default_disclaimer_size() {
	global $esi_optinforms_form5_disclaimer_size;
	if(empty($esi_optinforms_form5_disclaimer_size)) {
		$esi_optinforms_form5_disclaimer_size = "14px";
	}
	return $esi_optinforms_form5_disclaimer_size;
}

// FORM5: disclaimer font size options
function esi_optinforms_get_form5_disclaimer_size_options() {
	global $esi_optinforms_form5_disclaimer_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form5_disclaimer_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM5: default disclaimer color
function esi_optinforms_form5_default_disclaimer_color() {
	global $esi_optinforms_form5_disclaimer_color;
	if(empty($esi_optinforms_form5_disclaimer_color)) {
		$esi_optinforms_form5_disclaimer_color = "#727272";
	}
	return $esi_optinforms_form5_disclaimer_color;
}

// FORM5: default width
function esi_optinforms_form5_default_width() {
	global $esi_optinforms_form5_width;
	if(empty($esi_optinforms_form5_width)) {
		$esi_optinforms_form5_width = 0;
	}
}

// FORM5: 100% width checked
function esi_optinforms_form5_checked_width_100() {
	global $esi_optinforms_form5_width;
	if($esi_optinforms_form5_width == 0) {
		echo "checked=\"checked\"";
	}
}

// FORM5: fixed width checked
function esi_optinforms_form5_checked_width_fixed() {
	global $esi_optinforms_form5_width;
	if($esi_optinforms_form5_width == 1) {
		echo "checked=\"checked\"";
	}
}

// FORM5: fixed width disabled if width is 100%
function esi_optinforms_form5_disabled_width_pixels() {
	global $esi_optinforms_form5_width;
	if($esi_optinforms_form5_width == 0) {
		echo "disabled=\"disabled\"";
	}
}

// FORM5: default width fixed
function esi_optinforms_form5_default_width_pixels() {
	global $esi_optinforms_form5_width_pixels;
	if(empty($esi_optinforms_form5_width_pixels)) {
		$esi_optinforms_form5_width_pixels = "700";
	}
	return $esi_optinforms_form5_width_pixels;
}

// FORM5: default width fixed
function esi_optinforms_form5_get_width() {
	global $esi_optinforms_form5_width;
	if($esi_optinforms_form5_width == 0) {
		// do nothing
	}
	elseif($esi_optinforms_form5_width == 1) {
		return "style=\"width:" . esi_optinforms_form5_default_width_pixels() . "px\"";
	}
}

// FORM5: hide the title
function esi_optinforms_form5_hide_title() {
	global $esi_optinforms_form5_hide_title;
	return $esi_optinforms_form5_hide_title;
}

// FORM5: hide the title - convert to CSS
function esi_optinforms_form5_hide_title_css() {
	global $esi_optinforms_form5_hide_title;
	if($esi_optinforms_form5_hide_title == 1) {
		return "#esi-optinforms-form5-title{display:none;}";
	}
}

// FORM5: hide the subtitle
function esi_optinforms_form5_hide_subtitle() {
	global $esi_optinforms_form5_hide_subtitle;
	return $esi_optinforms_form5_hide_subtitle;
}

// FORM5: hide the subtitle - convert to CSS
function esi_optinforms_form5_hide_subtitle_css() {
	global $esi_optinforms_form5_hide_subtitle;
	if($esi_optinforms_form5_hide_subtitle == 1) {
		return "#esi-optinforms-form5-subtitle{display:none;}#esi-optinforms-form5-disclaimer{margin:0 20px;}";
	}
}

// FORM5: hide the name field
function esi_optinforms_form5_hide_name_field() {
	global $esi_optinforms_form5_hide_name_field;
	return $esi_optinforms_form5_hide_name_field;
}

// FORM5: hide the name field - convert to CSS
function esi_optinforms_form5_hide_name_field_css() {
	global $esi_optinforms_form5_hide_name_field;
	if($esi_optinforms_form5_hide_name_field == 1) {
		return "#esi-optinforms-form5-name-field{display:none;}";
	}
}

// FORM5: hide the disclaimer
function esi_optinforms_form5_hide_disclaimer() {
	global $esi_optinforms_form5_hide_disclaimer;
	return $esi_optinforms_form5_hide_disclaimer;
}

// FORM5: hide the disclaimer - convert to CSS
function esi_optinforms_form5_hide_disclaimer_css() {
	global $esi_optinforms_form5_hide_disclaimer;
	if($esi_optinforms_form5_hide_disclaimer == 1) {
		return "#esi-optinforms-form5-disclaimer{display:none;}";
	}
}

// FORM5: if both subtitle and disclaimer are hidden, hide the right container
function esi_optinforms_form5_hide_subtitle_disclaimer_css() {
	global $esi_optinforms_form5_hide_subtitle, $esi_optinforms_form5_hide_disclaimer;
	if(($esi_optinforms_form5_hide_subtitle == 1) && ($esi_optinforms_form5_hide_disclaimer == 1)) {
		return "#esi-optinforms-form5-container-right{display:none;}#esi-optinforms-form5-container-left{margin:10px 0;width:100%;}";
	}
}

// FORM5: get our custom CSS
function esi_optinforms_form5_css() {
	global $esi_optinforms_form5_css;
	return $esi_optinforms_form5_css;
}

// FORM5: advanced styling options
function esi_optinforms_form5_add_custom_css() {
	global $esi_optinforms_form5_css;
	return "<style type='text/css'>" . esi_optinforms_form5_hide_title_css() . esi_optinforms_form5_hide_subtitle_css() . esi_optinforms_form5_hide_name_field_css() . esi_optinforms_form5_hide_disclaimer_css() . esi_optinforms_form5_hide_subtitle_disclaimer_css() . $esi_optinforms_form5_css . "</style>";
}		

?>