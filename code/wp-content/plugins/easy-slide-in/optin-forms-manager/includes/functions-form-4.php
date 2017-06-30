<?php

// Set global variables
	$esi_optinforms_form4_background = get_option('esi_optinforms_form4_background');
	$esi_optinforms_form4_border = get_option('esi_optinforms_form4_border');
	$esi_optinforms_form4_title = get_option('esi_optinforms_form4_title');
	$esi_optinforms_form4_title_font = get_option('esi_optinforms_form4_title_font');
	$esi_optinforms_form4_title_size = get_option('esi_optinforms_form4_title_size');
	$esi_optinforms_form4_title_color = get_option('esi_optinforms_form4_title_color');
	$esi_optinforms_form4_subtitle = get_option('esi_optinforms_form4_subtitle');
	$esi_optinforms_form4_subtitle_font = get_option('esi_optinforms_form4_subtitle_font');
	$esi_optinforms_form4_subtitle_size = get_option('esi_optinforms_form4_subtitle_size');
	$esi_optinforms_form4_subtitle_color = get_option('esi_optinforms_form4_subtitle_color');
	$esi_optinforms_form4_email_field = get_option('esi_optinforms_form4_email_field');
	$esi_optinforms_form4_fields_font = get_option('esi_optinforms_form4_fields_font');
	$esi_optinforms_form4_fields_size = get_option('esi_optinforms_form4_fields_size');
	$esi_optinforms_form4_fields_color = get_option('esi_optinforms_form4_fields_color');
	$esi_optinforms_form4_button_text = get_option('esi_optinforms_form4_button_text');
	$esi_optinforms_form4_button_text_font = get_option('esi_optinforms_form4_button_text_font');
	$esi_optinforms_form4_button_text_size = get_option('esi_optinforms_form4_button_text_size');
	$esi_optinforms_form4_button_text_color = get_option('esi_optinforms_form4_button_text_color');
	$esi_optinforms_form4_button_background = get_option('esi_optinforms_form4_button_background');
	$esi_optinforms_form4_disclaimer = get_option('esi_optinforms_form4_disclaimer');
	$esi_optinforms_form4_disclaimer_font = get_option('esi_optinforms_form4_disclaimer_font');
	$esi_optinforms_form4_disclaimer_size = get_option('esi_optinforms_form4_disclaimer_size');
	$esi_optinforms_form4_disclaimer_color = get_option('esi_optinforms_form4_disclaimer_color');
	$esi_optinforms_form4_width = get_option('esi_optinforms_form4_width');
	$esi_optinforms_form4_width_pixels = get_option('esi_optinforms_form4_width_pixels');
	$esi_optinforms_form4_hide_title = get_option('esi_optinforms_form4_hide_title');
	$esi_optinforms_form4_hide_subtitle = get_option('esi_optinforms_form4_hide_subtitle');
	$esi_optinforms_form4_hide_disclaimer = get_option('esi_optinforms_form4_hide_disclaimer');
	$esi_optinforms_form4_css = get_option('esi_optinforms_form4_css');


// FORM4: default background color
function esi_optinforms_form4_default_background() {
	global $esi_optinforms_form4_background;
	if(empty($esi_optinforms_form4_background)) {
		$esi_optinforms_form4_background = "#FCFCFC";
	}
	return $esi_optinforms_form4_background;
}

// FORM4: default border color
function esi_optinforms_form4_default_border() {
	global $esi_optinforms_form4_border;
	if(empty($esi_optinforms_form4_border)) {
		$esi_optinforms_form4_border = "#ECEAED";
	}
	return $esi_optinforms_form4_border;
}

// FORM4: default title
function esi_optinforms_form4_default_title() {
	global $esi_optinforms_form4_title;
	if(empty($esi_optinforms_form4_title)) {
		$esi_optinforms_form4_title = __('Get the FREE eBook...', 'esi');
	}
	return $esi_optinforms_form4_title;
}

// FORM4: default title font
function esi_optinforms_form4_default_title_font() {
	global $esi_optinforms_form4_title_font;
	if(empty($esi_optinforms_form4_title_font)) {
		$esi_optinforms_form4_title_font = "Arial";
	}
	return $esi_optinforms_form4_title_font;
}

// FORM4: title font options
function esi_optinforms_get_form4_title_font_options() {
	global $esi_optinforms_form4_title_font;
	global $esi_optinforms_included_fonts;
	foreach ($esi_optinforms_included_fonts as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form4_title_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM4: default title font size
function esi_optinforms_form4_default_title_size() {
	global $esi_optinforms_form4_title_size;
	if(empty($esi_optinforms_form4_title_size)) {
		$esi_optinforms_form4_title_size = "24px";
	}
	return $esi_optinforms_form4_title_size;
}

// FORM4: title font size options
function esi_optinforms_get_form4_title_size_options() {
	global $esi_optinforms_form4_title_size;
	foreach (range(10, 72) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form4_title_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM4: default title color
function esi_optinforms_form4_default_title_color() {
	global $esi_optinforms_form4_title_color;
	if(empty($esi_optinforms_form4_title_color)) {
		$esi_optinforms_form4_title_color = "#505050";
	}
	return $esi_optinforms_form4_title_color;
}

// FORM4: default subtitle
function esi_optinforms_form4_default_subtitle() {
	global $esi_optinforms_form4_subtitle;
	if(empty($esi_optinforms_form4_subtitle)) {
		$esi_optinforms_form4_subtitle = __('Enter your email address and click on the Get Instant Access button.', 'esi');
	}
	return $esi_optinforms_form4_subtitle;
}

// FORM4: default subtitle font
function esi_optinforms_form4_default_subtitle_font() {
	global $esi_optinforms_form4_subtitle_font;
	if(empty($esi_optinforms_form4_subtitle_font)) {
		$esi_optinforms_form4_subtitle_font = "Arial";
	}
	return $esi_optinforms_form4_subtitle_font;
}

// FORM4: subtitle font options
function esi_optinforms_get_form4_subtitle_font_options() {
	global $esi_optinforms_form4_subtitle_font;
	global $esi_optinforms_included_fonts;
	foreach ($esi_optinforms_included_fonts as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form4_subtitle_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM4: default subtitle font size
function esi_optinforms_form4_default_subtitle_size() {
	global $esi_optinforms_form4_subtitle_size;
	if(empty($esi_optinforms_form4_subtitle_size)) {
		$esi_optinforms_form4_subtitle_size = "16px";
	}
	return $esi_optinforms_form4_subtitle_size;
}

// FORM4: subtitle font size options
function esi_optinforms_get_form4_subtitle_size_options() {
	global $esi_optinforms_form4_subtitle_size;
	foreach (range(10, 72) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form4_subtitle_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM4: default subtitle color
function esi_optinforms_form4_default_subtitle_color() {
	global $esi_optinforms_form4_subtitle_color;
	if(empty($esi_optinforms_form4_subtitle_color)) {
		$esi_optinforms_form4_subtitle_color = "#505050";
	}
	return $esi_optinforms_form4_subtitle_color;
}

// FORM4: default email field
function esi_optinforms_form4_default_email_field() {
	global $esi_optinforms_form4_email_field;
	if(empty($esi_optinforms_form4_email_field)) {
		$esi_optinforms_form4_email_field = __('Email Address', 'esi');
	}
	return $esi_optinforms_form4_email_field;
}

// FORM4: default email fields font
function esi_optinforms_form4_default_fields_font() {
	global $esi_optinforms_form4_fields_font;
	if(empty($esi_optinforms_form4_fields_font)) {
		$esi_optinforms_form4_fields_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form4_fields_font;
}

// FORM4: email fields font options
function esi_optinforms_get_form4_fields_font_options() {
	global $esi_optinforms_form4_fields_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form4_fields_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM4: email fields font size
function esi_optinforms_form4_default_fields_size() {
	global $esi_optinforms_form4_fields_size;
	if(empty($esi_optinforms_form4_fields_size)) {
		$esi_optinforms_form4_fields_size = "16px";
	}
	return $esi_optinforms_form4_fields_size;
}

// FORM4: email fields font size options
function esi_optinforms_get_form4_fields_size_options() {
	global $esi_optinforms_form4_fields_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form4_fields_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM4: default fields color
function esi_optinforms_form4_default_fields_color() {
	global $esi_optinforms_form4_fields_color;
	if(empty($esi_optinforms_form4_fields_color)) {
		$esi_optinforms_form4_fields_color = "#666666";
	}
	return $esi_optinforms_form4_fields_color;
}

// FORM4: default button text
function esi_optinforms_form4_default_button_text() {
	global $esi_optinforms_form4_button_text;
	if(empty($esi_optinforms_form4_button_text)) {
		$esi_optinforms_form4_button_text = __('Get Instant Access', 'esi');
	}
	return $esi_optinforms_form4_button_text;
}

// FORM4: default button text font
function esi_optinforms_form4_default_button_text_font() {
	global $esi_optinforms_form4_button_text_font;
	if(empty($esi_optinforms_form4_button_text_font)) {
		$esi_optinforms_form4_button_text_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form4_button_text_font;
}

// FORM4: button text font options
function esi_optinforms_get_form4_button_text_font_options() {
	global $esi_optinforms_form4_button_text_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form4_button_text_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM4: button text font size
function esi_optinforms_form4_default_button_text_size() {
	global $esi_optinforms_form4_button_text_size;
	if(empty($esi_optinforms_form4_button_text_size)) {
		$esi_optinforms_form4_button_text_size = "20px";
	}
	return $esi_optinforms_form4_button_text_size;
}

// FORM4: button text font size options
function esi_optinforms_get_form4_button_text_size_options() {
	global $esi_optinforms_form4_button_text_size;
	foreach (range(10, 30) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form4_button_text_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM4: default button text color
function esi_optinforms_form4_default_button_text_color() {
	global $esi_optinforms_form4_button_text_color;
	if(empty($esi_optinforms_form4_button_text_color)) {
		$esi_optinforms_form4_button_text_color = "#1d629b";
	}
	return $esi_optinforms_form4_button_text_color;
}

// FORM4: default button background color
function esi_optinforms_form4_default_button_background() {
	global $esi_optinforms_form4_button_background;
	if(empty($esi_optinforms_form4_button_background)) {
		$esi_optinforms_form4_button_background = "#faff5b";
	}
	return $esi_optinforms_form4_button_background;
}

// FORM4: default disclaimer
function esi_optinforms_form4_default_disclaimer() {
	global $esi_optinforms_form4_disclaimer;
	if(empty($esi_optinforms_form4_disclaimer)) {
		$esi_optinforms_form4_disclaimer = __('We respect your privacy', 'esi');
	}
	return $esi_optinforms_form4_disclaimer;
}

// FORM4: default disclaimer font
function esi_optinforms_form4_default_disclaimer_font() {
	global $esi_optinforms_form4_disclaimer_font;
	if(empty($esi_optinforms_form4_disclaimer_font)) {
		$esi_optinforms_form4_disclaimer_font = "Arial, Helvetica, sans-serif";
	}
	return $esi_optinforms_form4_disclaimer_font;
}

// FORM4: disclaimer font options
function esi_optinforms_get_form4_disclaimer_font_options() {
	global $esi_optinforms_form4_disclaimer_font;
	global $esi_optinforms_included_fonts_simple;
	foreach ($esi_optinforms_included_fonts_simple as $key) {
		echo "<option value=\"" . $key . "\"";
		if($esi_optinforms_form4_disclaimer_font == $key){
			echo "selected=selected";
		}
		echo ">" . $key . "</option>";
	}
}

// FORM4: disclaimer font size
function esi_optinforms_form4_default_disclaimer_size() {
	global $esi_optinforms_form4_disclaimer_size;
	if(empty($esi_optinforms_form4_disclaimer_size)) {
		$esi_optinforms_form4_disclaimer_size = "12px";
	}
	return $esi_optinforms_form4_disclaimer_size;
}

// FORM4: disclaimer font size options
function esi_optinforms_get_form4_disclaimer_size_options() {
	global $esi_optinforms_form4_disclaimer_size;
	foreach (range(10, 20) as $number) {
		echo "<option value=\"" . $number . "px\"";
		if($esi_optinforms_form4_disclaimer_size == $number . "px") {
			echo "selected=selected";
		}
		echo">" . $number . "px</option>";
	}
}

// FORM4: default disclaimer color
function esi_optinforms_form4_default_disclaimer_color() {
	global $esi_optinforms_form4_disclaimer_color;
	if(empty($esi_optinforms_form4_disclaimer_color)) {
		$esi_optinforms_form4_disclaimer_color = "#999999";
	}
	return $esi_optinforms_form4_disclaimer_color;
}

// FORM4: default width
function esi_optinforms_form4_default_width() {
	global $esi_optinforms_form4_width;
	if(empty($esi_optinforms_form4_width)) {
		$esi_optinforms_form4_width = 0;
	}
}

// FORM4: 100% width checked
function esi_optinforms_form4_checked_width_100() {
	global $esi_optinforms_form4_width;
	if($esi_optinforms_form4_width == 0) {
		echo "checked=\"checked\"";
	}
}

// FORM4: fixed width checked
function esi_optinforms_form4_checked_width_fixed() {
	global $esi_optinforms_form4_width;
	if($esi_optinforms_form4_width == 1) {
		echo "checked=\"checked\"";
	}
}

// FORM4: fixed width disabled if width is 100%
function esi_optinforms_form4_disabled_width_pixels() {
	global $esi_optinforms_form4_width;
	if($esi_optinforms_form4_width == 0) {
		echo "disabled=\"disabled\"";
	}
}

// FORM4: default width fixed
function esi_optinforms_form4_default_width_pixels() {
	global $esi_optinforms_form4_width_pixels;
	if(empty($esi_optinforms_form4_width_pixels)) {
		$esi_optinforms_form4_width_pixels = "700";
	}
	return $esi_optinforms_form4_width_pixels;
}

// FORM4: default width fixed
function esi_optinforms_form4_get_width() {
	global $esi_optinforms_form4_width;
	if($esi_optinforms_form4_width == 0) {
		// do nothing
	}
	elseif($esi_optinforms_form4_width == 1) {
		return "style=\"width:" . esi_optinforms_form4_default_width_pixels() . "px\"";
	}
}

// FORM4: hide the title
function esi_optinforms_form4_hide_title() {
	global $esi_optinforms_form4_hide_title;
	return $esi_optinforms_form4_hide_title;
}

// FORM4: hide the title - convert to CSS
function esi_optinforms_form4_hide_title_css() {
	global $esi_optinforms_form4_hide_title;
	if($esi_optinforms_form4_hide_title == 1) {
		return "#esi-optinforms-form4-title{display:none;}";
	}
}

// FORM4: hide the subtitle
function esi_optinforms_form4_hide_subtitle() {
	global $esi_optinforms_form4_hide_subtitle;
	return $esi_optinforms_form4_hide_subtitle;
}

// FORM4: hide the subtitle - convert to CSS
function esi_optinforms_form4_hide_subtitle_css() {
	global $esi_optinforms_form4_hide_subtitle;
	if($esi_optinforms_form4_hide_subtitle == 1) {
		return "#esi-optinforms-form4-subtitle{display:none;}";
	}
}

// FORM3: hide the disclaimer
function esi_optinforms_form4_hide_disclaimer() {
	global $esi_optinforms_form3_hide_disclaimer;
	return $esi_optinforms_form3_hide_disclaimer;
}

// FORM4: hide the name field - convert to CSS
function esi_optinforms_form4_hide_disclaimer_css() {
	global $esi_optinforms_form4_hide_disclaimer;
	if($esi_optinforms_form4_hide_disclaimer == 1) {
		return "#esi-optinforms-form4-disclaimer{display:none;}";
	}
}

// FORM4: get our custom CSS
function esi_optinforms_form4_css() {
	global $esi_optinforms_form4_css;
	return $esi_optinforms_form4_css;
}

// FORM4: advanced styling options
function esi_optinforms_form4_add_custom_css() {
	global $esi_optinforms_form4_css;
	return "<style type='text/css'>" . esi_optinforms_form4_hide_title_css() . esi_optinforms_form4_hide_subtitle_css() . esi_optinforms_form4_hide_disclaimer_css() . $esi_optinforms_form4_css . "</style>";
}	

?>