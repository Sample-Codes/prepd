<?php

// Set global variables
	$esi_optinforms_email_solution = get_option('esi_optinforms_email_solution');
	
	$esi_optinforms_form_action_mailchimp = get_option('esi_optinforms_form_action_mailchimp');
	$esi_optinforms_form_action_madmimi = get_option('esi_optinforms_form_action_madmimi');
	$esi_optinforms_form_action_interspire = get_option('esi_optinforms_form_action_interspire');
	
	$esi_optinforms_form_list_name_aweber = get_option('esi_optinforms_form_list_name_aweber');
	$esi_optinforms_form_redirect_aweber = get_option('esi_optinforms_form_redirect_aweber');
	$esi_optinforms_form_listid_icontact = get_option('esi_optinforms_form_listid_icontact');
	$esi_optinforms_form_specialid_icontact = get_option('esi_optinforms_form_specialid_icontact');
	$esi_optinforms_form_clientid_icontact = get_option('esi_optinforms_form_clientid_icontact');
	$esi_optinforms_form_redirect_icontact = get_option('esi_optinforms_form_redirect_icontact');
	$esi_optinforms_form_error_icontact = get_option('esi_optinforms_form_error_icontact');
	$esi_optinforms_form_webformid_getresponse = get_option('esi_optinforms_form_webformid_getresponse');
	$esi_optinforms_form_name_field_interspire = get_option('esi_optinforms_form_name_field_interspire');
	
	$esi_optinforms_included_fonts = array ("Arial", "Baumans", "Belgrano", "Chewy", "Cinzel Decorative", "Coming Soon", "Contrail One", "Damion", "Dancing Script", "Droid Sans", "Droid Serif", "Englebert", "Fenix", "Flavors", "Fredoka One", "Georgia", "Gloria Hallelujah", "Gochi Hand", "Grand Hotel", "Helvetica", "Lobster", "Luckiest Guy", "Marcellus SC", "News Cycle", "Nixie One", "Oleo Script", "Open Sans", "Oswald", "Overlock SC", "Pacifico", "Parisienne", "Quicksand", "Racing Sans One", "Roboto Condensed", "Russo One", "Sanchez", "Shadows Into Light", "Share Tech", "Signika Negative", "Tahoma", "Times New Roman", "Titan One", "Unkempt", "Verdana", "Viga");
	$esi_optinforms_included_fonts_simple = array ("Arial, Helvetica, sans-serif", "Times New Roman, Times, serif", "Tahoma, Geneva, sans-serif", "Courier New, Courier, monospace", "Georgia, Times New Roman, Times, serif", "Trebuchet MS, Arial, sans-serif", "Verdana, Geneva, sans-serif", "Palatino Linotype, Book Antiqua, serif");
	
	$esi_optinforms_form_design = get_option('esi_optinforms_form_design');
	$esi_optinforms_form_placement_post = get_option('esi_optinforms_form_placement_post');
	$esi_optinforms_form_placement_page = get_option('esi_optinforms_form_placement_page');
	$esi_optinforms_form_placement_popup = get_option('esi_optinforms_form_placement_popup');
	$esi_optinforms_form_placement_box = get_option('esi_optinforms_form_placement_box');
	$esi_optinforms_form_placement_bar = get_option('esi_optinforms_form_placement_bar');
	$esi_optinforms_form_exclude_posts = get_option('esi_optinforms_form_exclude_posts');
	$esi_optinforms_form_exclude_pages = get_option('esi_optinforms_form_exclude_pages');
	$esi_optinforms_powered_by = get_option('esi_optinforms_powered_by');
	$esi_optinforms_form_target = get_option('esi_optinforms_form_target');


// Add tabs for main page
function esi_optinforms_menu_tabs() {
	echo "<ul id=\"esi-optinforms-menu-tabs\" class=\"shadetabs\">
			<li><a href=\"#\" rel=\"esi-optinforms-email-solution-tab\" class=\"selected\">" . __('Email Solution', 'esi') . "</a></li>
			<li><a href=\"#\" rel=\"esi-optinforms-posts-tab\">" . __('Form', 'esi') . "</a></li>
		</ul>
		<div class=\"clear\"></div>";
}

// Define an email solution
function esi_optinforms_get_email_solution() {
	global $esi_optinforms_email_solution;
	if(empty($esi_optinforms_email_solution)) {
		$esi_optinforms_email_solution = "esi_optinforms_email_solution_option1";
	}
	return $esi_optinforms_email_solution;
}

// Add our form action
function esi_optinforms_get_form_action() {
	global $esi_optinforms_email_solution;
	if(empty($esi_optinforms_email_solution)) {
		// do nothing
	}
	// add Aweber form action
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option1') {
		return "http://www.aweber.com/scripts/addlead.pl";
	}
	
	// add iContact form action
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option2') {
		return "https://app.icontact.com/icp/signup.php";
	}
	// add Mailchimp form action
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option3') {
		return esi_optinforms_form_action_mailchimp();
	}
	// add GetResponse form action
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option4') {
		return "https://app.getresponse.com/add_contact_webform.html";
	}
	// add Mad Mimi form action
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option5') {
		return esi_optinforms_form_action_madmimi();
	}
	// add Interspire form action
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option6') {
		return esi_optinforms_form_action_interspire();
	}
}

// MailChimp form action
function esi_optinforms_form_action_mailchimp() {
	global $esi_optinforms_form_action_mailchimp;
	if(empty($esi_optinforms_form_action_mailchimp)) {
		$esi_optinforms_form_action_mailchimp = "";
	}
	return $esi_optinforms_form_action_mailchimp;
}

// Mad Mimi form action
function esi_optinforms_form_action_madmimi() {
	global $esi_optinforms_form_action_madmimi;
	if(empty($esi_optinforms_form_action_madmimi)) {
		$esi_optinforms_form_action_madmimi = "";
	}
	return $esi_optinforms_form_action_madmimi;
}

// Interspire form action
function esi_optinforms_form_action_interspire() {
	global $esi_optinforms_form_action_interspire;
	if(empty($esi_optinforms_form_action_interspire)) {
		$esi_optinforms_form_action_interspire = "";
	}
	return $esi_optinforms_form_action_interspire;
}

// Aweber list name
function esi_optinforms_form_list_name_aweber() {
	global $esi_optinforms_form_list_name_aweber;
	if(empty($esi_optinforms_form_list_name_aweber)) {
		$esi_optinforms_form_list_name_aweber = "";
	}
	return $esi_optinforms_form_list_name_aweber;
}

// Aweber redirect URL
function esi_optinforms_form_redirect_aweber() {
	global $esi_optinforms_form_redirect_aweber;
	if(empty($esi_optinforms_form_redirect_aweber)) {
		$esi_optinforms_form_redirect_aweber = "";
	}
	return $esi_optinforms_form_redirect_aweber;
}

// iContact list ID
function esi_optinforms_form_listid_icontact() {
	global $esi_optinforms_form_listid_icontact;
	if(empty($esi_optinforms_form_listid_icontact)) {
		$esi_optinforms_form_listid_icontact = "";
	}
	return $esi_optinforms_form_listid_icontact;
}

// iContact special ID
function esi_optinforms_form_specialid_icontact() {
	global $esi_optinforms_form_specialid_icontact;
	if(empty($esi_optinforms_form_specialid_icontact)) {
		$esi_optinforms_form_specialid_icontact = "";
	}
	return $esi_optinforms_form_specialid_icontact;
}

// iContact client ID
function esi_optinforms_form_clientid_icontact() {
	global $esi_optinforms_form_clientid_icontact;
	if(empty($esi_optinforms_form_clientid_icontact)) {
		$esi_optinforms_form_clientid_icontact = "";
	}
	return $esi_optinforms_form_clientid_icontact;
}

// iContact redirect URL
function esi_optinforms_form_redirect_icontact() {
	global $esi_optinforms_form_redirect_icontact;
	if(empty($esi_optinforms_form_redirect_icontact)) {
		$esi_optinforms_form_redirect_icontact = "";
	}
	return $esi_optinforms_form_redirect_icontact;
}

// iContact error URL
function esi_optinforms_form_error_icontact() {
	global $esi_optinforms_form_error_icontact;
	if(empty($esi_optinforms_form_error_icontact)) {
		$esi_optinforms_form_error_icontact = "";
	}
	return $esi_optinforms_form_error_icontact;
}

// GetResponse webform ID
function esi_optinforms_form_webformid_getresponse() {
	global $esi_optinforms_form_webformid_getresponse;
	if(empty($esi_optinforms_form_webformid_getresponse)) {
		$esi_optinforms_form_webformid_getresponse = "";
	}
	return $esi_optinforms_form_webformid_getresponse;
}

// Interspire name ID
function esi_optinforms_form_name_field_interspire() {
	global $esi_optinforms_form_name_field_interspire;
	if(empty($esi_optinforms_form_name_field_interspire)) {
		$esi_optinforms_form_name_field_interspire = "";
	}
	return $esi_optinforms_form_name_field_interspire;
}

// Open our form in a new window?
function esi_optinforms_form_target_blank() {
	global $esi_optinforms_form_target;
	//if($esi_optinforms_form_target == 1) {
		return "target=\"_blank\"";
	//} else {
		//do nothing
	//}
}

// Add our identifiers to the form
function esi_optinforms_get_form_identifiers() {
	global $esi_optinforms_email_solution;
	if(empty($esi_optinforms_email_solution)) {
		// do nothing
	}
	// add Aweber identifiers
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option1') {
		return "<input type=\"hidden\" name=\"listname\" value=\"" . esi_optinforms_form_list_name_aweber() . "\" /><input type=\"hidden\" name=\"redirect\" value=\"" . esi_optinforms_form_redirect_aweber() . "\" /><input type=\"hidden\" name=\"meta_message\" value=\"1\" />";
	}
	// add iContact identifiers
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option2') {
		return "<input type=\"hidden\" name=\"listid\" value=\"" . esi_optinforms_form_listid_icontact() . "\"><input type=\"hidden\" name=\"specialid:" . esi_optinforms_form_listid_icontact() . "\" value=\"" . esi_optinforms_form_specialid_icontact() . "\"><input type=\"hidden\" name=\"clientid\" value=\"" . esi_optinforms_form_clientid_icontact() . "\"><input type=\"hidden\" name=\"redirect\" value=\"" . esi_optinforms_form_redirect_icontact() . "\"><input type=\"hidden\" name=\"errorredirect\" value=\"" . esi_optinforms_form_error_icontact() . "\">";
	}
	// add Mailchimp identifiers
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option3') {
		// do nothing
	}
	// add GetResponse identifiers
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option4') {
		return "<input type=\"hidden\" name=\"webform_id\" value=\"" . esi_optinforms_form_webformid_getresponse() . "\" />";
	}
	// add Mad Mimi identifiers
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option5') {
		// do nothing
	}
	// add Interspire identifiers
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option6') {
		// do nothing
	}
}

// Define our name field
function esi_optinforms_get_name_field() {
	global $esi_optinforms_email_solution;
	if(empty($esi_optinforms_email_solution)) {
		return "name";
	}
	// define Aweber name field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option1') {
		return "name";
	}
	// define iContact name field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option2') {
		return "fields_fname";
	}
	// define Mailchimp name field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option3') {
		return "FNAME";
	}
	// define GetResponse name field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option4') {
		return "name";
	}
	// define Mad Mimi name field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option5') {
		return "signup[name]";
	}
	// define Interspire name field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option6') {
		return "CustomFields[" . esi_optinforms_form_name_field_interspire() . "]";
	}
}

// Define our email field
function esi_optinforms_get_email_field() {
	global $esi_optinforms_email_solution;
	if(empty($esi_optinforms_email_solution)) {
		return "email";
	}
	// define Aweber email field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option1') {
		return "email";
	}
	// define iContact email field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option2') {
		return "fields_email";
	}
	// define Mailchimp email field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option3') {
		return "EMAIL";
	}
	// define GetResponse email field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option4') {
		return "email";
	}
	// define Mad Mimi email field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option5') {
		return "signup[email]";
	}
	// define Interspire email field
	elseif($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option6') {
		return "email";
	}
}

// Define a form design
function esi_optinforms_get_form_design() {
	global $esi_optinforms_form_design;
	if(empty($esi_optinforms_form_design)) {
		$esi_optinforms_form_design = 01;
	}
	return $esi_optinforms_form_design;
}

// Get excluded posts for In Content forms
function esi_optinforms_form_exclude_posts() {
	global $esi_optinforms_form_exclude_posts;
	return $esi_optinforms_form_exclude_posts;
}

// Get excluded pages for In Content forms
function esi_optinforms_form_exclude_pages() {
	global $esi_optinforms_form_exclude_pages;
	return $esi_optinforms_form_exclude_pages;
}

// Decide when our admin notices are loaded
function esi_optinforms_configuration() {
	global $esi_optinforms_email_solution, $esi_optinforms_form_list_name_aweber, $esi_optinforms_form_listid_icontact, $esi_optinforms_form_specialid_icontact, $esi_optinforms_form_clientid_icontact, $esi_optinforms_form_action_mailchimp, $esi_optinforms_form_webformid_getresponse, $esi_optinforms_form_action_madmimi, $esi_optinforms_form_action_interspire;
	if(($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option1') && (empty($esi_optinforms_form_list_name_aweber))) {
		echo esi_optinforms_configuration_message();
	}
	elseif(($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option2') && (empty($esi_optinforms_form_listid_icontact) || empty($esi_optinforms_form_specialid_icontact) || empty($esi_optinforms_form_clientid_icontact))) {
		echo esi_optinforms_configuration_message();
	}
	elseif (($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option3') && (empty($esi_optinforms_form_action_mailchimp))) {
		echo esi_optinforms_configuration_message();
	}
	elseif (($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option4') && (empty($esi_optinforms_form_webformid_getresponse))) {
		echo esi_optinforms_configuration_message();
	}
	elseif (($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option5') && (empty($esi_optinforms_form_action_madmimi))) {
		echo esi_optinforms_configuration_message();
	}
	elseif (($esi_optinforms_email_solution == 'esi_optinforms_email_solution_option6') && (empty($esi_optinforms_form_action_interspire))) {
		echo esi_optinforms_configuration_message();
	}
}

// Create our admin notice - user needs to configure the plugin
function esi_optinforms_configuration_message() {
	global $current_user;
	$userid = $current_user->ID;
	if ( !get_user_meta( $userid, 'dismiss_email_configuration' ) ) {
	echo "<div id=\"message\" class=\"error\">
        		<p>" . __('Your email solution is not configured yet. Your form will not work properly until you configure the settings.', 'esi') . " <a href=\"edit.php?post_type=easy_slide_in&page=esi-optin&dismiss_ec=yes\">" . __('I know, don\'t bug me', 'esi') . "</a></p>
    		</div>";
	}
}

// Add user meta value when dismiss link is clicked
function esi_optinforms_dismiss_admin_notice() {
	global $current_user;
	$userid = $current_user->ID;
	
	// If "Dismiss" link has been clicked, user meta field is added
	if ( isset( $_GET['dismiss_ec'] ) && 'yes' == $_GET['dismiss_ec'] ) {
		add_user_meta( $userid, 'dismiss_email_configuration', 'yes', true );
	}
}
add_action( 'admin_init', 'esi_optinforms_dismiss_admin_notice' );

// Show us some love :)
function esi_optinforms_powered_by() {
	global $esi_optinforms_powered_by;
	if($esi_optinforms_powered_by == 0) {
		// do nothing
	}
	elseif($esi_optinforms_powered_by == 1) {	}
}

// Check radiobutton show Powered By link
function esi_optinforms_powered_by_show() {
	global $esi_optinforms_powered_by;
	if($esi_optinforms_powered_by == 1) {
		echo "checked=\"checked\"";
	}
}

// Check radiobutton hide Powered By link
function esi_optinforms_powered_by_hide() {
	global $esi_optinforms_powered_by;
	if($esi_optinforms_powered_by == 0) {
		echo "checked=\"checked\"";
	}
}

// Get the fonts which are used on the selected form
function esi_optinforms_get_used_fonts() {
	global $esi_optinforms_form_design;
	if($esi_optinforms_form_design == 'esi_optinforms_form_design_option1' || empty($esi_optinforms_form_design)) {
		global $esi_optinforms_form1_title_font, $esi_optinforms_form1_subtitle_font;
		return esi_optinforms_form1_default_title_font() . "|" .esi_optinforms_form1_default_subtitle_font();
	}
	elseif($esi_optinforms_form_design == 'esi_optinforms_form_design_option2') {
		global $esi_optinforms_form2_title_font;
		return esi_optinforms_form2_default_title_font();
	}
	elseif($esi_optinforms_form_design == 'esi_optinforms_form_design_option3') {
		global $esi_optinforms_form3_title_font, $esi_optinforms_form3_subtitle_font;
		return esi_optinforms_form3_default_title_font() . "|" .esi_optinforms_form3_default_subtitle_font();
	}
	elseif($esi_optinforms_form_design == 'esi_optinforms_form_design_option4') {
		global $esi_optinforms_form4_title_font, $esi_optinforms_form4_subtitle_font;
		return esi_optinforms_form4_default_title_font() . "|" .esi_optinforms_form4_default_subtitle_font();
	}
	elseif($esi_optinforms_form_design == 'esi_optinforms_form_design_option5') {
		global $esi_optinforms_form5_title_font, $esi_optinforms_form5_subtitle_font;
		return esi_optinforms_form5_default_title_font() . "|" .esi_optinforms_form5_default_subtitle_font();
	}
}

// Now include only these fonts to optimize load time
function esi_optinforms_used_fonts() {
	$esi_optinforms_google_url = "http://fonts.googleapis.com/css?family=";
	return $esi_optinforms_google_url.esi_optinforms_get_used_fonts();

}

?>