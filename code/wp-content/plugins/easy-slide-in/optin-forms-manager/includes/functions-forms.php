<?php

// Get excluded posts and create an array
function esi_optinforms_get_excluded_posts() {
	global $esi_optinforms_form_exclude_posts;
	if(empty($esi_optinforms_form_exclude_posts)) {
		$esi_optinforms_get_excluded_posts = '0';
	}
	if(!is_string($esi_optinforms_form_exclude_posts)) {
		$esi_optinforms_get_excluded_posts = '0';
	}
	else {
	  $esi_optinforms_get_excluded_posts = explode(',', $esi_optinforms_form_exclude_posts);
	}
	return $esi_optinforms_get_excluded_posts;
}

// Get excluded pages and create an array
function esi_optinforms_get_excluded_pages() {
	global $esi_optinforms_form_exclude_pages;
	if(empty($esi_optinforms_form_exclude_pages)) {
		$esi_optinforms_get_excluded_pages = '0';
	}
	if(!is_string($esi_optinforms_form_exclude_pages)) {
		$esi_optinforms_get_excluded_pages = '0';
	}
	else {
	  $esi_optinforms_get_excluded_pages = explode(',', $esi_optinforms_form_exclude_pages);
	}
	return $esi_optinforms_get_excluded_pages;
}

// Insert form on post, after first paragraph
add_filter( "the_content", "esi_optinform_insert_form_first_paragraph_post" );

function esi_optinform_insert_form_first_paragraph_post($content) {
	global $esi_optinforms_form_placement_post, $esi_optinforms_form_exclude_posts;
	$esi_optinforms_get_excluded_posts = esi_optinforms_get_excluded_posts(); // THIS ONE IS NEW !!!
	if($esi_optinforms_form_placement_post == '1'){
		$ad_code = esi_optinforms_create_form();
		if(empty($esi_optinforms_form_exclude_posts) && is_single()) {
			return esi_optinform_insert_form_after_paragraph($ad_code, 1, $content);
		}
		elseif (!empty($esi_optinforms_form_exclude_posts) && is_single()) {
			if(is_single($esi_optinforms_get_excluded_posts)) {
				// do nothing
			}
			else {
				return esi_optinform_insert_form_after_paragraph($ad_code, 1, $content);
			}
		}
	}
	else {
		// do nothing
	}
	return $content;
}

// Insert form on page, after first paragraph
add_filter( "the_content", "esi_optinform_insert_form_first_paragraph_page" );

function esi_optinform_insert_form_first_paragraph_page($content) {
	global $esi_optinforms_form_placement_page;
	$esi_optinforms_get_excluded_pages = esi_optinforms_get_excluded_pages(); // THIS ONE IS NEW !!!
	if($esi_optinforms_form_placement_page == '1'){
		$ad_code = esi_optinforms_create_form();
		if(is_page()) {
			if(is_page($esi_optinforms_get_excluded_pages)) {
				// do nothing
			}
			else {
				return esi_optinform_insert_form_after_paragraph($ad_code, 1, $content);
			}
		}
	}
	else {
		// do nothing
	}
	return $content;
}

// Insert form on post, after second paragraph
add_filter( "the_content", "esi_optinform_insert_form_second_paragraph_post" );

function esi_optinform_insert_form_second_paragraph_post($content) {
	global $esi_optinforms_form_placement_post;
	$esi_optinforms_get_excluded_posts = esi_optinforms_get_excluded_posts(); // THIS ONE IS NEW !!!
	if($esi_optinforms_form_placement_post == '2'){
		$ad_code = esi_optinforms_create_form();
		if(is_single()) {
			if(is_single($esi_optinforms_get_excluded_posts)) {
				// do nothing
			}
			else {
				return esi_optinform_insert_form_after_paragraph($ad_code, 2, $content);
			}
		}
	}
	else {
		// do nothing
	}
	return $content;
}

// Insert form on page, after second paragraph
add_filter( "the_content", "esi_optinform_insert_form_second_paragraph_page" );

function esi_optinform_insert_form_second_paragraph_page($content) {
	global $esi_optinforms_form_placement_page;
	$esi_optinforms_get_excluded_pages = esi_optinforms_get_excluded_pages(); // THIS ONE IS NEW !!!
	if($esi_optinforms_form_placement_page == '2'){
		$ad_code = esi_optinforms_create_form();
		if(is_page()) {
			if(is_page($esi_optinforms_get_excluded_pages)) {
				// do nothing
			}
			else {
				return esi_optinform_insert_form_after_paragraph($ad_code, 2, $content);
			}
		}
	}
	else {
		// do nothing
	}
	return $content;
}
 
// Help us insert form in between paragraphs
function esi_optinform_insert_form_after_paragraph($insertion, $paragraph_id, $content) {
	$closing_p = '</p>';
	$paragraphs = explode($closing_p, $content);
	foreach ($paragraphs as $index => $paragraph) {
		if (trim($paragraph)) {
			$paragraphs[$index] .= $closing_p;
		}
		if ($paragraph_id == $index + 1) {
			$paragraphs[$index] .= $insertion;
		}
	}
	return implode('', $paragraphs);
}

// Insert form after post content
add_filter( "the_content", "esi_optinforms_insert_form_after_post" );

function esi_optinforms_insert_form_after_post($content) {
	global $esi_optinforms_form_placement_post, $esi_optinforms_form_exclude_posts;
	$esi_optinforms_get_excluded_posts = esi_optinforms_get_excluded_posts(); // THIS ONE IS NEW !!!
	if($esi_optinforms_form_placement_post == '3' || empty($esi_optinforms_form_placement_post)) {
		
		if(empty($esi_optinforms_form_exclude_posts) && is_single()) {
			$content .= esi_optinforms_create_form();
		}
		elseif (!empty($esi_optinforms_form_exclude_posts) && is_single()) {
			if(is_single($esi_optinforms_get_excluded_posts)) {
				// do nothing
			}
			else {
				$content .= esi_optinforms_create_form();
			}
		}

	}
	return $content;
}

// Insert form after page content
add_filter( "the_content", "esi_optinforms_insert_form_after_page" );

function esi_optinforms_insert_form_after_page($content) {
	global $esi_optinforms_form_placement_page, $esi_optinforms_form_exclude_pages;
	$esi_optinforms_get_excluded_pages = esi_optinforms_get_excluded_pages(); // THIS ONE IS NEW !!!
	if($esi_optinforms_form_placement_page == '3' || empty($esi_optinforms_form_placement_page)) {
		if(is_page()) {
			if(is_page($esi_optinforms_get_excluded_pages)) {
				// do nothing
			}
			else {
				$content .= esi_optinforms_create_form();
			}
		}
	}
	return $content;
}

// Create our shortcode for inclusion in sidebar
add_shortcode( 'esi-optinform', 'esi_optinforms_create_form' );

// Make sure our shortcode will work in widgets
add_filter('widget_text', 'do_shortcode');

// Code comment beginning
function esi_optinforms_code_comment(){
	//return "\n\n<!-- Form created by Optin Forms plugin by Codeleon: create beautiful optin forms with ease! -->\n<!-- http://www.codeleon.com/wordpress/plugins/optin-forms -->\n";
	return "";
}

// Code comment end
function esi_optinforms_code_comment_end(){
	//return "\n<!-- / Optin Forms -->\n\n";
	return "";
}

// Form 1
function esi_optinforms_create_form($atts = null) {
	global $esi_optinforms_form_design;
	
	$esi_current_user_style = $esi_optinforms_form_design;
	
	if (isset($atts)) {
		$options = shortcode_atts( array(
				'style' => ''				
		), $atts );
		
		$user_style = isset($options['style']) ? $options['style'] : '';
		if ($user_style != '') {
			$esi_current_user_style = 'esi_optinforms_form_design_option'.$user_style;
		}
	}
	
	if($esi_current_user_style == 'esi_optinforms_form_design_option1') {
		return "" . esi_optinforms_code_comment() . "<div id=\"esi-optinforms-form1-container\" " . esi_optinforms_form1_get_width() . "><form method=\"post\" " . esi_optinforms_form_target_blank() . " action=\"" . esi_optinforms_get_form_action() . "\">" . esi_optinforms_get_form_identifiers() . "<div id=\"esi-optinforms-form1\" style=\"background:" . esi_optinforms_form1_default_background() . "; border-color:" . esi_optinforms_form1_default_border() . "\"><p id=\"esi-optinforms-form1-title\" style=\"font-family:" . esi_optinforms_form1_default_title_font() . "; font-size:" . esi_optinforms_form1_default_title_size() . "; line-height:" . esi_optinforms_form1_default_title_size() . "; color:" . esi_optinforms_form1_default_title_color() . "\">" . esi_optinforms_form1_default_title() ."</p><p id=\"esi-optinforms-form1-subtitle\" style=\"font-family:" . esi_optinforms_form1_default_subtitle_font() . "; font-size:" . esi_optinforms_form1_default_subtitle_size() . "; line-height:" . esi_optinforms_form1_default_subtitle_size() . "; color:" . esi_optinforms_form1_default_subtitle_color() . "\">" . esi_optinforms_form1_default_subtitle() . "</p><div id=\"esi-optinforms-form1-name-field-container\"> <input type=\"text\" id=\"esi-optinforms-form1-name-field\" name=\"" . esi_optinforms_get_name_field() . "\" placeholder=\"" . esi_optinforms_form1_default_name_field() . "\" style=\"font-family:" . esi_optinforms_form1_default_fields_font() . "; font-size:" . esi_optinforms_form1_default_fields_size() . "; color:" . esi_optinforms_form1_default_fields_color() . "\" /></div><!--esi-optinforms-form1-name-field-container--><div id=\"esi-optinforms-form1-email-field-container\"><input type=\"text\" id=\"esi-optinforms-form1-email-field\" name=\"" . esi_optinforms_get_email_field() . "\" placeholder=\"" . esi_optinforms_form1_default_email_field() . "\" style=\"font-family:" . esi_optinforms_form1_default_fields_font() . "; font-size:" . esi_optinforms_form1_default_fields_size() . "; color:" . esi_optinforms_form1_default_fields_color() . "\" /></div><!--esi-optinforms-form1-email-field-container--><div id=\"esi-optinforms-form1-button-container\"><input type=\"submit\" name=\"submit\" id=\"esi-optinforms-form1-button\" value=\"" . esi_optinforms_form1_default_button_text() . "\" style=\"font-family:" . esi_optinforms_form1_default_button_text_font() . "; font-size:" . esi_optinforms_form1_default_button_text_size() . "; color:" . esi_optinforms_form1_default_button_text_color() . "; background-color:" . esi_optinforms_form1_default_button_background() . "\" /></div><!--esi-optinforms-form1-button-container--><div class=\"clear\"></div><p id=\"esi-optinforms-form1-disclaimer\" style=\"font-family:" . esi_optinforms_form1_default_disclaimer_font() . "; font-size:" . esi_optinforms_form1_default_disclaimer_size() . "; line-height:" . esi_optinforms_form1_default_disclaimer_size() . "; color:" . esi_optinforms_form1_default_disclaimer_color() . "\">" . esi_optinforms_form1_default_disclaimer() . "</p></div><!--esi-optinforms-form1--><div class=\"clear\"></div>" . esi_optinforms_powered_by() . "</form></div><!--esi-optinforms-form1-container--><div class=\"clear\"></div>" . esi_optinforms_code_comment_end() . esi_optinforms_form1_add_custom_css() . "";
	}
	elseif($esi_current_user_style == 'esi_optinforms_form_design_option2') {
		return "" . esi_optinforms_code_comment() . "<div id=\"esi-optinforms-form2-container\" " . esi_optinforms_form2_get_width() . "><form method=\"post\" " . esi_optinforms_form_target_blank() . " action=\"" . esi_optinforms_get_form_action() . "\">" . esi_optinforms_get_form_identifiers() . "<div id=\"esi-optinforms-form2\" style=\"background:" . esi_optinforms_form2_default_background() . "\"><div id=\"esi-optinforms-form2-title-container\"><div id=\"esi-optinforms-form2-title\" style=\"font-family:" . esi_optinforms_form2_default_title_font() . "; font-size:" . esi_optinforms_form2_default_title_size() . "; line-height:" . esi_optinforms_form2_default_title_size() . "; color:" . esi_optinforms_form2_default_title_color() . "\">" . esi_optinforms_form2_default_title() ."</div><!--esi-optinforms-form2-title--></div><!--esi-optinforms-form2-title-container--><div id=\"esi-optinforms-form2-email-field-container\"><input type=\"text\" id=\"esi-optinforms-form2-email-field\" name=\"" . esi_optinforms_get_email_field() . "\" placeholder=\"" . esi_optinforms_form2_default_email_field() . "\" style=\"font-family:" . esi_optinforms_form2_default_fields_font() . "; font-size:" . esi_optinforms_form2_default_fields_size() . "; color:" . esi_optinforms_form2_default_fields_color() . "\" /></div><!--esi-optinforms-form2-email-field-container--><div id=\"esi-optinforms-form2-button-container\"><input type=\"submit\" name=\"submit\" id=\"esi-optinforms-form2-button\" value=\"" . esi_optinforms_form2_default_button_text() . "\" style=\"font-family:" . esi_optinforms_form2_default_button_text_font() . "; font-size:" . esi_optinforms_form2_default_button_text_size() . "; color:" . esi_optinforms_form2_default_button_text_color() . "; background-color:" . esi_optinforms_form2_default_button_background() . "\" /></div><!--esi-optinforms-form2-button-container--><div id=\"esi-optinforms-form2-disclaimer-container\"><p id=\"esi-optinforms-form2-disclaimer\" style=\"font-family:" . esi_optinforms_form2_default_disclaimer_font() . "; font-size:" . esi_optinforms_form2_default_disclaimer_size() . "; line-height:" . esi_optinforms_form2_default_disclaimer_size() . "; color:" . esi_optinforms_form2_default_disclaimer_color() . "\">" . esi_optinforms_form2_default_disclaimer() . "</p></div><!--esi-optinforms-form2-disclaimer-container--><div class=\"clear\"></div></div><!--esi-optinforms-form2--><div class=\"clear\"></div>" . esi_optinforms_powered_by() . "</form></div><!--esi-optinforms-form2-container--><div class=\"clear\"></div>" . esi_optinforms_code_comment_end() . esi_optinforms_form2_add_custom_css() . "";
	}
	elseif($esi_current_user_style == 'esi_optinforms_form_design_option3') {
		return "" . esi_optinforms_code_comment() . "<div id=\"esi-optinforms-form3-container\" " . esi_optinforms_form3_get_width() . "><form method=\"post\" " . esi_optinforms_form_target_blank() . " action=\"" . esi_optinforms_get_form_action() . "\">" . esi_optinforms_get_form_identifiers() . "<div id=\"esi-optinforms-form3\"><div id=\"esi-optinforms-form3-inside\" style=\"background:" . esi_optinforms_form3_default_background() . "\"><div id=\"esi-optinforms-form3-container-left\"><div id=\"esi-optinforms-form3-title\" style=\"font-family:" . esi_optinforms_form3_default_title_font() . "; font-size:" . esi_optinforms_form3_default_title_size() . "; line-height:" . esi_optinforms_form3_default_title_size() . "; color:" . esi_optinforms_form3_default_title_color() . "\">" . esi_optinforms_form3_default_title() ."</div><!--esi-optinforms-form3-title--><div id=\"esi-optinforms-form3-subtitle\" style=\"font-family:" . esi_optinforms_form3_default_subtitle_font() . "; font-size:" . esi_optinforms_form3_default_subtitle_size() . "; color:" . esi_optinforms_form3_default_subtitle_color() . "\">" . esi_optinforms_form3_default_subtitle() . "</div><!--esi-optinforms-form3-subtitle--></div><!--esi-optinforms-form3-container-left--><div id=\"esi-optinforms-form3-container-right\"><input type=\"text\" id=\"esi-optinforms-form3-name-field\" name=\"" . esi_optinforms_get_name_field() . "\" placeholder=\"" . esi_optinforms_form3_default_name_field() . "\" style=\"font-family:" . esi_optinforms_form3_default_fields_font() . "; font-size:" . esi_optinforms_form3_default_fields_size() . "; color:" . esi_optinforms_form3_default_fields_color() . "\" /><input type=\"text\" id=\"esi-optinforms-form3-email-field\" name=\"" . esi_optinforms_get_email_field() . "\" placeholder=\"" . esi_optinforms_form3_default_email_field() . "\" style=\"font-family:" . esi_optinforms_form3_default_fields_font() . "; font-size:" . esi_optinforms_form3_default_fields_size() . "; color:" . esi_optinforms_form3_default_fields_color() . "\" /><input type=\"submit\" name=\"submit\" id=\"esi-optinforms-form3-button\" value=\"" . esi_optinforms_form3_default_button_text() . "\" style=\"font-family:" . esi_optinforms_form3_default_button_text_font() . "; font-size:" . esi_optinforms_form3_default_button_text_size() . "; color:" . esi_optinforms_form3_default_button_text_color() . "; background-color:" . esi_optinforms_form3_default_button_background() . "\" /></div><!--esi-optinforms-form3-container-right--><div class=\"clear\"></div></div><!--esi-optinforms-form3-inside--></div><!--esi-optinforms-form3--><div class=\"clear\"></div>" . esi_optinforms_powered_by() . "</form></div><!--esi-optinforms-form3-container--><div class=\"clear\"></div>" . esi_optinforms_code_comment_end() . esi_optinforms_form3_add_custom_css() . "";
	}
	elseif($esi_current_user_style == 'esi_optinforms_form_design_option4') {
		return "" . esi_optinforms_code_comment() . "<div id=\"esi-optinforms-form4-container\" " . esi_optinforms_form4_get_width() . "><form method=\"post\" " . esi_optinforms_form_target_blank() . " action=\"" . esi_optinforms_get_form_action() . "\">" . esi_optinforms_get_form_identifiers() . "<div id=\"esi-optinforms-form4\" style=\"background:" . esi_optinforms_form4_default_background() . "; border-color:" . esi_optinforms_form4_default_border() . "\"><div id=\"esi-optinforms-form4-title\" style=\"font-family:" . esi_optinforms_form4_default_title_font() . "; font-size:" . esi_optinforms_form4_default_title_size() . "; line-height:" . esi_optinforms_form4_default_title_size() . "; color:" . esi_optinforms_form4_default_title_color() . "\">" . esi_optinforms_form4_default_title() ."</div><!--esi-optinforms-form4-title--><div id=\"esi-optinforms-form4-subtitle\" style=\"font-family:" . esi_optinforms_form4_default_subtitle_font() . "; font-size:" . esi_optinforms_form4_default_subtitle_size() . "; line-height:" . esi_optinforms_form4_default_subtitle_size() . "; color:" . esi_optinforms_form4_default_subtitle_color() . "\">" . esi_optinforms_form4_default_subtitle() . "</div><!--esi-optinforms-form4-subtitle--><input type=\"text\" id=\"esi-optinforms-form4-email-field\" name=\"" . esi_optinforms_get_email_field() . "\" placeholder=\"" . esi_optinforms_form4_default_email_field() . "\" style=\"font-family:" . esi_optinforms_form4_default_fields_font() . "; font-size:" . esi_optinforms_form4_default_fields_size() . "; color:" . esi_optinforms_form4_default_fields_color() . "\" /><input type=\"submit\" name=\"submit\" id=\"esi-optinforms-form4-button\" value=\"" . esi_optinforms_form4_default_button_text() . "\" style=\"font-family:" . esi_optinforms_form4_default_button_text_font() . "; font-size:" . esi_optinforms_form4_default_button_text_size() . "; color:" . esi_optinforms_form4_default_button_text_color() . "; background-color:" . esi_optinforms_form4_default_button_background() . "\" /><div id=\"esi-optinforms-form4-disclaimer\" style=\"font-family:" . esi_optinforms_form4_default_disclaimer_font() . "; font-size:" . esi_optinforms_form4_default_disclaimer_size() . "; line-height:" . esi_optinforms_form4_default_disclaimer_size() . "; color:" . esi_optinforms_form4_default_disclaimer_color() . "\">" . esi_optinforms_form4_default_disclaimer() . "</div><!--esi-optinforms-form4-disclaimer--><div class=\"clear\"></div></div><!--esi-optinforms-form4--><div class=\"clear\"></div>" . esi_optinforms_powered_by() . "</form></div><!--esi-optinforms-form4-container--><div class=\"clear\"></div>" . esi_optinforms_code_comment_end() . esi_optinforms_form4_add_custom_css() . "";
	}
	elseif($esi_current_user_style == 'esi_optinforms_form_design_option5') {
		return "" . esi_optinforms_code_comment() . "<div id=\"esi-optinforms-form5-container\" " . esi_optinforms_form5_get_width() . "><form method=\"post\" " . esi_optinforms_form_target_blank() . " action=\"" . esi_optinforms_get_form_action() . "\">" . esi_optinforms_get_form_identifiers() . "<div id=\"esi-optinforms-form5\" style=\"background:" . esi_optinforms_form5_default_background() . ";\"><div id=\"esi-optinforms-form5-container-left\"><div id=\"esi-optinforms-form5-title\" style=\"font-family:" . esi_optinforms_form5_default_title_font() . "; font-size:" . esi_optinforms_form5_default_title_size() . "; line-height:" . esi_optinforms_form5_default_title_size() . "; color:" . esi_optinforms_form5_default_title_color() . "\">" . esi_optinforms_form5_default_title() ."</div><!--esi-optinforms-form5-title--><input type=\"text\" id=\"esi-optinforms-form5-name-field\" name=\"" . esi_optinforms_get_name_field() . "\" placeholder=\"" . esi_optinforms_form5_default_name_field() . "\" style=\"font-family:" . esi_optinforms_form5_default_fields_font() . "; font-size:" . esi_optinforms_form5_default_fields_size() . "; color:" . esi_optinforms_form5_default_fields_color() . "\" /><input type=\"text\" id=\"esi-optinforms-form5-email-field\" name=\"" . esi_optinforms_get_email_field() . "\" placeholder=\"" . esi_optinforms_form5_default_email_field() . "\" style=\"font-family:" . esi_optinforms_form5_default_fields_font() . "; font-size:" . esi_optinforms_form5_default_fields_size() . "; color:" . esi_optinforms_form5_default_fields_color() . "\" /><input type=\"submit\" name=\"submit\" id=\"esi-optinforms-form5-button\" value=\"" . esi_optinforms_form5_default_button_text() . "\" style=\"font-family:" . esi_optinforms_form5_default_button_text_font() . "; font-size:" . esi_optinforms_form5_default_button_text_size() . "; color:" . esi_optinforms_form5_default_button_text_color() . "; background-color:" . esi_optinforms_form5_default_button_background() . "\" /></div><!--esi-optinforms-form5-container-left--><div id=\"esi-optinforms-form5-container-right\"><div id=\"esi-optinforms-form5-subtitle\" style=\"font-family:" . esi_optinforms_form5_default_subtitle_font() . "; font-size:" . esi_optinforms_form5_default_subtitle_size() . "; color:" . esi_optinforms_form5_default_subtitle_color() . "\">" . esi_optinforms_form5_default_subtitle() . "</div><!--esi-optinforms-form5-subtitle--><div id=\"esi-optinforms-form5-disclaimer\" style=\"font-family:" . esi_optinforms_form5_default_disclaimer_font() . "; font-size:" . esi_optinforms_form5_default_disclaimer_size() . "; color:" . esi_optinforms_form5_default_disclaimer_color() . "\">" . esi_optinforms_form5_default_disclaimer() . "</div><!--esi-optinforms-form5-disclaimer--></div><!--esi-optinforms-form5-container-right--><div class=\"clear\"></div></div><!--esi-optinforms-form5--><div class=\"clear\"></div>" . esi_optinforms_powered_by() . "</form></div><!--esi-optinforms-form5-container--><div class=\"clear\"></div>" . esi_optinforms_code_comment_end() . esi_optinforms_form5_add_custom_css() . "";
	}
}

?>