<?php
/**
 * Admin pages handler.
 */
class ESI_AdminPages {
	private $_data;
	
	private $_esi;
	
	private function __construct() {
		$this->_esi = Easy_SlideIn::get_instance ();
		$this->_data = new ESI_Options ();
	}
	
	public static function serve() {
		$me = new ESI_AdminPages ();
		$me->_add_hooks ();
	}
	
	private function _add_hooks() {
		add_action ( 'admin_init', array ($this, 'register_settings' ) );
		$hook = (defined ( 'WP_NETWORK_ADMIN' ) && WP_NETWORK_ADMIN) ? 'network_admin_menu' : 'admin_menu';
		add_action ( $hook, array ($this, 'create_admin_menu_entry' ) );
		
		// Post meta boxes
		add_action ( 'admin_init', array ($this, 'add_meta_boxes' ) );
		add_action ( 'save_post', array ($this, 'save_meta' ) );
		
		add_action ( 'admin_print_scripts', array ($this, 'js_print_scripts' ) );
		add_action ( 'admin_print_styles', array ($this, 'css_print_styles' ) );
		
		// AJAX actions
		add_action ( 'wp_ajax_esi_mailchimp_subscribe', array ($this, 'json_mailchimp_subscribe' ) );
		add_action ( 'wp_ajax_nopriv_esi_mailchimp_subscribe', array ($this, 'json_mailchimp_subscribe' ) );
	}
	
	function json_mailchimp_subscribe() {
		$is_error = 1;
		
		$post_id = ! empty ( $_POST ['post_id'] ) ? $_POST ['post_id'] : false;
		$opts = get_post_meta ( $post_id, 'esi-type', true );
		
		$default_api_key = $this->_data->get_option ( 'mailchimp-api_key' );
		$api_key = esi_getval ( $opts, 'mailchimp-api_key', $default_api_key );
		if (! $api_key)
			die ( json_encode ( array ('is_error' => $is_error, 'message' => __ ( 'MailChimp not configured', 'esi' ) ) ) );
		
		$default_list = $this->_data->get_option ( 'mailchimp-default_list' );
		$list = esi_getval ( $opts, 'mailchimp-default_list', $default_list );
		if (! $list)
			die ( json_encode ( array ('is_error' => $is_error, 'message' => __ ( 'Unknown list', 'esi' ) ) ) );
		
		$email = esi_getval ( $_POST, 'email' );
		if (! is_email ( $email ))
			die ( json_encode ( array ('is_error' => $is_error, 'message' => __ ( 'Invalid email', 'esi' ) ) ) );
		
		$mailchimp = new ESI_Mailchimp ( $api_key );
		$result = $mailchimp->subscribe_to ( $list, $email );
		
		if (true === $result) {
			$global_message = $this->_data->get_option ( 'mailchimp-subscription_message' );
			$subscription_message = esi_getval ( $opts, 'mailchimp-subscription_message', $global_message );
			$subscription_message = $subscription_message ? $subscription_message : __ ( 'All good, thank you!', 'esi' );
			$subscription_message = wp_strip_all_tags ( $subscription_message );
			die ( json_encode ( array ('is_error' => 0, 'message' => $subscription_message ) ) );
		} else if (is_array ( $result ) && isset ( $result ['error'] )) {
			die ( json_encode ( array ('is_error' => $is_error, 'message' => $result ['error'] ) ) );
		} else if (is_string ( $result )) {
			die ( json_encode ( array ('is_error' => $is_error, 'message' => $result ) ) );
		} else
			die ( json_encode ( array ('is_error' => $is_error, 'message' => __ ( 'Error', 'esi' ) ) ) );
		die ();
	}
	
	function add_meta_boxes() {
		$types = get_post_types ( array ('public' => true ) );
		foreach ( $types as $type ) {
			add_meta_box ( 'esi_message_override', __ ( 'Easy Slide-In Message Override', 'esi' ), array ($this, 'render_message_override_box' ), $type, 'side', 'low' );
		}
	}
	
	function render_message_override_box() {
		global $post;
		$msg_id = get_post_meta ( $post->ID, 'esi_message_id', true );
		$msg_id2 = get_post_meta ( $post->ID, 'esi_message_id2', true );
		$msg_id3 = get_post_meta ( $post->ID, 'esi_message_id3', true );
		$msg_id4 = get_post_meta ( $post->ID, 'esi_message_id4', true );
		$msg_id5 = get_post_meta ( $post->ID, 'esi_message_id5', true );
		
		$do_not_show = get_post_meta ( $post->ID, 'esi_do_not_show', true );
		$display_all = get_post_meta ( $post->ID, 'esi_display_all', true );
		
		$query = new WP_Query ( array ('post_type' => Easy_SlideIn::POST_TYPE, 'post_status' => Easy_SlideIn::NOT_IN_POOL_STATUS, 'posts_per_page' => '-1' ) );
		$messages = $query->posts;
		
		_e ( 'This post will not get an easy slide-in message from the automatic display list - it will always use this message', 'esi' );
		echo '<br/><select name="esi-message_override">';
		echo '<option value=""></option>';
		foreach ( $messages as $message ) {
			$selected = ($message->ID == $msg_id) ? 'selected="selected"' : '';
			echo "<option value='{$message->ID}' {$selected}>{$message->post_title}</option>";
		}
		echo '</select>';
		echo '<select name="esi-message_override2">';
		echo '<option value=""></option>';
		foreach ( $messages as $message ) {
			$selected = ($message->ID == $msg_id2) ? 'selected="selected"' : '';
			echo "<option value='{$message->ID}' {$selected}>{$message->post_title}</option>";
		}
		echo '</select>';
		echo '<select name="esi-message_override3">';
		echo '<option value=""></option>';
		foreach ( $messages as $message ) {
			$selected = ($message->ID == $msg_id3) ? 'selected="selected"' : '';
			echo "<option value='{$message->ID}' {$selected}>{$message->post_title}</option>";
		}
		echo '</select>';
		echo '<select name="esi-message_override4">';
		echo '<option value=""></option>';
		foreach ( $messages as $message ) {
			$selected = ($message->ID == $msg_id4) ? 'selected="selected"' : '';
			echo "<option value='{$message->ID}' {$selected}>{$message->post_title}</option>";
		}
		echo '</select>';
		echo '<select name="esi-message_override5">';
		echo '<option value=""></option>';
		foreach ( $messages as $message ) {
			$selected = ($message->ID == $msg_id5) ? 'selected="selected"' : '';
			echo "<option value='{$message->ID}' {$selected}>{$message->post_title}</option>";
		}
		echo '</select>';
		
		echo '<br />';
		echo '' . '<input type="hidden" name="esi-display_all_manaul" value="" />' . '<input type="checkbox" name="esi-display_all_manaul" id="esi-display_all_manaul" value="1"' . checked ( $display_all, true, false ) . ' />' . '&nbsp;' . '<label for="esi-display_all_manaul">' . __ ( 'Display all manual assigned messages', 'esi' ) . '</label>' . '<br />';
		// echo '<br />';
		echo '' . '<input type="hidden" name="esi-do_not_show" value="" />' . '<input type="checkbox" name="esi-do_not_show" id="esi-do_not_show" value="1"' . checked ( $do_not_show, true, false ) . ' />' . '&nbsp;' . '<label for="esi-do_not_show">' . __ ( 'Do not show an easy slide-in on this page', 'esi' ) . '</label>' . '<br />';
	}
	
	function save_meta() {
		global $post;
		
		if (!isset($post)) { return false; }
		
		// if ('post' != $post->post_type) return false; // Deprecated
		if (isset ( $_POST ['esi-message_override'] )) {
			if ($_POST ['esi-message_override'] != '') {
				if ($_POST ['esi-message_override'])
					update_post_meta ( $post->ID, 'esi_message_id', $_POST ['esi-message_override'] );
			} else {
				delete_post_meta ( $post->ID, 'esi_message_id' );
			}
		}
		
		if (isset ( $_POST ['esi-message_override2'] )) {
			if ($_POST ['esi-message_override2'] != '') {
				if ($_POST ['esi-message_override2'])
					update_post_meta ( $post->ID, 'esi_message_id2', $_POST ['esi-message_override2'] );
			} else {
				delete_post_meta ( $post->ID, 'esi_message_id2' );
			}
		}
		
		if (isset ( $_POST ['esi-message_override3'] )) {
			if ($_POST ['esi-message_override3'] != '') {
				if ($_POST ['esi-message_override3'])
					update_post_meta ( $post->ID, 'esi_message_id3', $_POST ['esi-message_override3'] );
			} else {
				delete_post_meta ( $post->ID, 'esi_message_id3' );
			}
		}
		
		if (isset ( $_POST ['esi-message_override4'] )) {
			if ($_POST ['esi-message_override4'] != '') {
				if ($_POST ['esi-message_override4'])
					update_post_meta ( $post->ID, 'esi_message_id4', $_POST ['esi-message_override4'] );
			} else {
				delete_post_meta ( $post->ID, 'esi_message_id4' );
			}
		}
		if (isset ( $_POST ['esi-message_override5'] )) {
			if ($_POST ['esi-message_override5'] != '') {
				if ($_POST ['esi-message_override5'])
					update_post_meta ( $post->ID, 'esi_message_id5', $_POST ['esi-message_override5'] );
			} else {
				delete_post_meta ( $post->ID, 'esi_message_id5' );
			}
		}
		
		if (isset ( $_POST ['esi-display_all_manaul'] )) {
			$display_all_manaul = ! empty ( $_POST ['esi-display_all_manaul'] );
			update_post_meta ( $post->ID, 'esi_display_all', $display_all_manaul );
		} else {
			delete_post_meta ( $post->ID, 'esi_display_all' );
		}
		
		if (isset ( $_POST ['esi-do_not_show'] )) {
			$do_not_show = ! empty ( $_POST ['esi-do_not_show'] );
			update_post_meta ( $post->ID, 'esi_do_not_show', $do_not_show );
		} else {
			delete_post_meta ( $post->ID, 'esi_do_not_show' );
		}
	}
	
	function register_settings() {
		$form = new ESI_AdminFormRenderer ();
		
		register_setting ( 'esi', 'esi' );
		
		add_settings_section ( 'esi_behavior', __ ( 'Message Display', 'esi' ), create_function ( '', '' ), 'esi_options_page' );
		add_settings_field ( 'esi_show_after', __ ( 'Display message after', 'esi' ), array ($form, 'create_show_after_box' ), 'esi_options_page', 'esi_behavior' );
		add_settings_field ( 'esi_show_for', __ ( 'Automatically hide message after', 'esi' ), array ($form, 'create_show_for_box' ), 'esi_options_page', 'esi_behavior' );
		add_settings_field ( 'esi_closing', __ ( 'After closing the message action', 'esi' ), array ($form, 'create_closing_box' ), 'esi_options_page', 'esi_behavior' );
		
		add_settings_section ( 'esi_appearance', __ ( 'Display settings', 'esi' ), create_function ( '', '' ), 'esi_options_page' );
		add_settings_field ( 'esi_position', __ ( 'Message position', 'esi' ), array ($form, 'create_position_box' ), 'esi_options_page', 'esi_appearance' );
		add_settings_field ( 'esi_width', __ ( 'Message width', 'esi' ), array ($form, 'create_msg_width_box' ), 'esi_options_page', 'esi_appearance' );
		add_settings_field ( 'esi_colors', __ ( 'Customize main colors', 'esi' ), array ($form, 'create_color_options' ), 'esi_options_page', 'esi_appearance' );
		
		add_settings_field ( 'esi_mailchimp', __ ( 'MailChimp subscriptions', 'esi' ), array ($form, 'create_mailchimp_box' ), 'esi_options_page', 'esi_appearance' );
		
		add_settings_field ( 'esi_css', __ ( 'Custom CSS', 'esi' ), array ($form, 'create_custom_css_box' ), 'esi_options_page', 'esi_appearance' );
		
		add_settings_field ( 'esi_advanced', __ ( 'Advanced', 'esi' ), array ($form, 'create_advanced_box' ), 'esi_options_page', 'esi_appearance' );
		add_settings_field ( 'esi_mobile', __ ( 'Mobile', 'esi' ), array ($form, 'create_mobile_box' ), 'esi_options_page', 'esi_appearance' );
	}
	
	function create_admin_menu_entry() {
		if (@$_POST && isset ( $_POST ['option_page'] )) {
			$changed = false;
			if ('esi_options_page' == esi_getval ( $_POST, 'option_page' )) {
				update_option ( 'esi', $_POST ['esi'] );
				$changed = true;
			}
			
			if ($changed) {
				$goback = add_query_arg ( 'settings-updated', 'true', wp_get_referer () );
				wp_redirect ( $goback );
				die ();
			}
		}
		$page = "edit.php?post_type=" . Easy_SlideIn::POST_TYPE;
		$perms = is_multisite () ? 'manage_network_options' : 'manage_options';
		add_submenu_page ( $page, __ ( 'Settings', 'esi' ), __ ( 'Settings', 'esi' ), $perms, 'esi', array ($this, 'create_admin_page' ) );
	}
	
	function create_admin_page() {
		include (ESI_PLUGIN_BASE_DIR . '/lib/forms/plugin_settings.php');
	}
	
	function js_print_scripts() {
		global $post;
		if ((isset ( $_GET ['page'] ) && 'esi' == $_GET ['page']) || (is_object ( $post ) && isset ( $post->post_type ) && Easy_SlideIn::POST_TYPE == $post->post_type)) {
			wp_enqueue_script ( array ("jquery", "jquery-ui-core", "jquery-ui-sortable", 'jquery-ui-dialog' ) );
			wp_enqueue_script ( 'esi-admin', ESI_PLUGIN_URL . '/assets/js/esi-admin.js', array ("jquery", "jquery-ui-core", "jquery-ui-sortable", 'jquery-ui-dialog' ) );
			wp_enqueue_style ( 'wp-color-picker' );
			wp_enqueue_script ( 'wp-color-picker' );
			wp_enqueue_script ( 'esi-admin-calendar-moment', ESI_PLUGIN_URL . '/assets/js/moment.js', array ("jquery", "jquery-ui-core", "jquery-ui-sortable", 'jquery-ui-dialog' ) );
			wp_enqueue_script ( 'esi-admin-calendar', ESI_PLUGIN_URL . '/assets/js/pikaday.js', array ("jquery", "jquery-ui-core", "jquery-ui-sortable", 'jquery-ui-dialog' ) );
				
			wp_localize_script ( 'esi-admin', 'l10nesi', array ('clear_set' => __ ( '<strong>&times;</strong> clear this set', 'esi' ) ) );

			// fa icon picker
			//wp_enqueue_style ( 'esi-fapicker', ESI_PLUGIN_URL . '/assets/css/bootstrap-iconpicker.min.css' );
			//wp_enqueue_style ( 'esi-fa', ESI_PLUGIN_URL . '/assets/css/font-awesome.min.css' );
			//wp_enqueue_style ( 'esi-fapicker-bootstrap', ESI_PLUGIN_URL . '/assets/css/bootstrap.min.css' );
			//wp_enqueue_script ( 'esi-fapicker-bootstrap', ESI_PLUGIN_URL . '/assets/js/bootstrap.min.js', array ("jquery") );
			//wp_enqueue_script ( 'esi-fapicker', ESI_PLUGIN_URL . '/assets/js/bootstrap-iconpicker.js', array ("jquery") );
				
		}
	}
	
	function css_print_styles() {
		// Menu icon hack goes into all admin pages, so add it inline instead of
		// queueing up yet another stylehseet just for this
		$base_url = ESI_PLUGIN_URL;
		echo <<<EoESIAdminCss
<style type="text/css">
li.menu-icon-slide_in div.wp-menu-image { background: url({$base_url}/assets/images/admin-menu-icon.png) no-repeat bottom; }
li.menu-icon-slide_in:hover div.wp-menu-image,
li.menu-icon-slide_in.wp-has-current-submenu div.wp-menu-image
{ background-position: top; }
li.menu-icon-slide_in div.wp-menu-image img { display: none; }
</style>
EoESIAdminCss;
		// The rest is slide in specific, enqueue only when needed
		if (isset ( $_GET ['page'] ) && 'esi' == $_GET ['page']) {
			wp_enqueue_style ( 'esi-admin', ESI_PLUGIN_URL . '/assets/css/esi-admin.css' );
			wp_enqueue_style ( 'esi-admin', ESI_PLUGIN_URL . '/assets/css/pikaday.css' );
		}
		global $post;
		if (is_object ( $post ) && isset ( $post->post_type ) && Easy_SlideIn::POST_TYPE == $post->post_type) {
			wp_enqueue_style ( 'esi-admin', ESI_PLUGIN_URL . '/assets/css/esi-admin.css' );
			wp_enqueue_style ( 'esi-admin-calendar', ESI_PLUGIN_URL . '/assets/css/pikaday.css' );
		}
		// wp_enqueue_style('jquery-ui-dialog',
	// 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	}

}