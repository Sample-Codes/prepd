<?php

class Easy_SlideIn {

	private static $_instance;

	const NOT_IN_POOL_STATUS = 'esi_not_in_pool';
	const POST_TYPE = 'easy_slide_in';

	private function __construct () {}

	/**
	 * Glues everything together and initialize singleton.
	 */
	public static function init () {
		if (!isset(self::$_instance)) self::$_instance = new self;

		add_action('init', array(self::$_instance, 'register_post_type'));
		add_action('widgets_init', array(self::$_instance, 'register_sidebar'));
		add_action('admin_init', array(self::$_instance, 'add_meta_boxes'));
		add_action('save_post', array(self::$_instance, 'save_meta'), 9); // Bind it a bit earlier, so we can kill Post Indexer actions.
		add_action('wp_insert_post_data', array(self::$_instance, 'set_up_post_status'));

		add_filter("manage_edit-" . self::POST_TYPE . "_columns", array(self::$_instance, "add_custom_columns"));
		add_action("manage_posts_custom_column",  array(self::$_instance, "fill_custom_columns"));
		
		add_image_size( 'easy-slide-in-related', '300', '100' );
		add_image_size( 'easy-slide-in-related-50', '50', '50' );
		add_image_size( 'easy-slide-in-related-75', '75', '75' );
	}

	/**
	 * Prepared singleton object getting routine.
	 */
	public static function get_instance () {
		return self::$_instance;
	}


/* ----- Static info getters ----- */

	/**
	 * Get known themes.
	 */
	public static function get_appearance_themes () {
		return array(
			'minimal' => __('Minimal', 'esi')
		);
	}


	public static function get_default_injection_hook () {
		$hook = defined('ESI_INJECTION_HOOK') ? ESI_INJECTION_HOOK : 'wp_footer';
		$hook = 'wp_footer';
		return apply_filters('esi-core-injection_hook', $hook);
	}


/* ----- Handlers ----- */

	function register_sidebar () {
		$data = new ESI_Options;
		if (!$data->get_option('allow_widgets')) return false;
		
		$widget_count = $data->get_option('allow_widgets_count');
		if (!$widget_count) { $widget_count = '1'; }
		
		$widget_count = intval($widget_count);
		
		for ($i=1;$i<=$widget_count;$i++) {
		register_sidebar(array(
			'name' => __('Easy Slide-In '.$i, 'esi'),
			'id' => 'easy-slide-in-'.$i,
			'description' => __('This sidebar can be used as a Easy Slide-In message content.', 'esi'),
			'class' => '',
			'before_widget' => '<aside id="%1$s" class="esi-widget esi-slide-col %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="esi-widget_title">',
			'after_title' => '</h3>'
		));

		}
	}

	function register_post_type () {
		$supports = apply_filters(
			'esi-slide_in-post_type-supports',
			array('title', 'editor')
		);
		// Force required support
		if (!in_array('title', $supports)) $supports[] = 'title';
		if (!in_array('editor', $supports)) $supports[] = 'editor';

		register_post_type(self::POST_TYPE, array(
			'labels' => array(
				'name' => __('Easy Slide-In', 'esi'),
				'singular_name' => __('Easy Slide-In Message', 'esi'),
				'add_new_item' => __('Add new Easy Slide-In Message', 'esi'),
				'edit_item' => __('Edit Easy Slide-In Message', 'esi'),
			),
			'menu_icon' => ESI_PLUGIN_URL . '/assets/images/admin-menu-icon.png',
			'public' => true,
			'show_ui' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'supports' => $supports,
		));
		//register_post_status(self::NOT_IN_POOL_STATUS, array('protected' => true));
		register_post_status(self::NOT_IN_POOL_STATUS, array('protected' => true));
	}

	function add_meta_boxes () {
		add_meta_box(
			'esi_conditions',
			__('Conditions', 'esi'),
			array($this, 'render_conditions_box'),
			self::POST_TYPE,
			'side',
			'high'
		);
		add_meta_box(
			'esi_type',
			__('Easy Slide-In Type', 'esi'),
			array($this, 'render_content_type'),
			self::POST_TYPE,
			'normal',
			'high'
		);
		add_meta_box(
			'esi_show_override',
			__('Easy Slide-In Display Settings', 'esi'),
			array($this, 'render_show_after_box'),
			self::POST_TYPE,
			'normal',
			'high'
		);
	}

	function render_conditions_box () {
		global $post;
		$show_options = get_post_meta($post->ID, 'esi_show_if', true);

		echo '<div class="esiui-ui">' .
			'<input type="checkbox" name="not_in_the_pool" id="esi-not_in_the_pool" value="1" ' .
				($post->post_status == self::NOT_IN_POOL_STATUS ? 'checked="checked"' : '') .
			' />' .
			'&nbsp;' .
			'<label for="esi-not_in_the_pool">' . __('Manual Display', 'esi') . '</label>' .
			$this->_create_hint(__('Easy Slide-In posts maked as manual display can be assigned to your individual posts, overriding the defaults that render automatically.', 'esi')) .
		//'</div>';
		
		
		$fhour = (isset($show_options['hfrom']) ? $show_options['hfrom'] : '');
		$thour = (isset($show_options['hto']) ? $show_options['hto'] : '');
		//print_r($show_options);
		$hour_select_values = "";
		$thour_select_values = "";
		$hour_select_values .= '<option value="">Any time</option>';
		$thour_select_values .= '<option value="">Any time</option>';
		for ( $i=0;$i<24;$i++) {
			$hour_select_values .= '<option value="'.$i.'" '.(($fhour == $i && $fhour != '')? 'selected="selected"' : '').'>'.$i.'</option>';
			$thour_select_values .= '<option value="'.$i.'"'.(($thour == $i && $thour != '') ? 'selected="selected"' : '').'>'.$i.'</option>';
		}
		
		
		echo '<div class="esi-dashboard-panel-small">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'Date & Time Rules</div>';
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%">';
		echo '<col width="40%"/><col width="60%"/>';
		echo '<tr>';
		echo '<td>From date:</td>';
		echo '<td><input type="text" class="wide" name="show_if[from]" id="esi-datefrom" value="'.(isset($show_options['from']) ? $show_options['from'] : '').'"/></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>To date:</td>';
		echo '<td><input type="text" class="wide" name="show_if[to]" id="esi-dateto" value="'.(isset($show_options['to']) ? $show_options['to'] : '').'"/></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>From hour:</td>';
		echo '<td><select class="wide" name="show_if[hfrom]" id="esi-hourfrom">'.$hour_select_values.'</select></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>To hour:</td>';
		echo '<td><select class="wide" name="show_if[hto]" id="esi-hourto">'.$hour_select_values.'</select></td>';
		echo '</tr>';
		echo '</table>';
		
		echo '<p class="info">You can limit message for date range, hour range or both (date an hours). Leave fields blank if you do not wish to set any limitation. Please note that setting time limitation will make message to appear only between hours provided in fields for each date.</p>';
		
		echo '</div></div>';
		
		echo '<script type="text/javascript">
		jQuery(document).ready(function($){
		var pickerFrom = new Pikaday({ field: $(\'#esi-datefrom\')[0], format: "YYYY-MM-DD" });
		var pickerTo = new Pikaday({ field: $(\'#esi-dateto\')[0], format: "YYYY-MM-DD" });
		});
		
		</script>';
		echo '<div id="esi-conditions-container" class="esiui-ui" style="display:none">';

		//echo '<div class="title-div">' . __('Show message if:', 'esi') . '</div>';
		echo '<div class="esi-dashboard-panel-small">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'User rules</div>';
		
		$show_if = esi_getval($show_options, 'user');
		echo '<fieldset id="esi-user_rules"><legend>' . __('User rules', 'esi') . '</legend>';
		echo '' .
			'<input type="radio" name="show_if[user]" value="show_if_logged_in" id="show_if_logged_in-yes" ' .
				('show_if_logged_in' == $show_if ? 'checked="checked"' : '') .
			'/ >' .
			' <label for="show_if_logged_in-yes">' . __('the user is logged in', 'esi') . '</label>' .
		'<br />';
		echo '' .
			'<input type="radio" name="show_if[user]" value="show_if_not_logged_in" id="show_if_not_logged_in-yes" ' .
				('show_if_not_logged_in' == $show_if ? 'checked="checked"' : '') .
			'/ >' .
			' <label for="show_if_not_logged_in-yes">' . __('the user is <b>NOT</b> logged in', 'esi') . '</label> ' .
		'<br />';
		echo '' .
			'<input type="radio" name="show_if[user]" value="show_if_never_commented" id="show_if_never_commented-yes" ' .
				('show_if_never_commented' == $show_if ? 'checked="checked"' : '') .
			'/ >' .
			' <label for="show_if_never_commented-yes">' . __('the user never commented on your site before', 'esi') . '</label> ' .
		'<br />';
		echo '</fieldset>';
		echo '</div>';

		echo '<div class="esi-dashboard-panel-small">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'Show on selected post types</div>';
		//echo '<div class="title-div">' . __('Show message on:', 'esi') . '</div>';

		$show_if = esi_getval($show_options, 'page');
		echo '<fieldset id="esi-page_rules"><legend>' . __('Page rules', 'esi') . '</legend>';
		echo '' .
			'<input type="radio" name="show_if[page]" value="show_if_singular" id="show_if_singular-yes" ' .
				('show_if_singular' == $show_if ? 'checked="checked"' : '') .
			'/ >' .
			' <label for="show_if_singular-yes">' . __('any of my singular pages', 'esi') . '</label>' .
		'<br />';
		echo '' .
			'<input type="radio" name="show_if[page]" value="show_if_not_singular" id="show_if_not_singular-yes" ' .
				('show_if_not_singular' == $show_if ? 'checked="checked"' : '') .
			'/ >' .
			' <label for="show_if_not_singular-yes">' . __('any of my archive pages', 'esi') . '</label>' .
		'<br />';
		echo '' .
			'<input type="radio" name="show_if[page]" value="show_if_query" id="show_if_query-yes" ' .
				('show_if_query' == $show_if ? 'checked="checked"' : '') .
			'/ >' .
			' <label for="show_if_query-yes">' . __('any pages with query string', 'esi') . '</label>' .
		'<br />';
		echo '' .
			'<input type="radio" name="show_if[page]" value="show_if_home" id="show_if_home-yes" ' .
				('show_if_home' == $show_if ? 'checked="checked"' : '') .
			'/ >' .
			' <label for="show_if_home-yes">' . __('home page', 'esi') . '</label>' .
		'<br />';
		$types = get_post_types(array('public' => true), 'objects');
		foreach ($types as $type => $obj) {
			if ('attachment' == $type) continue;
			$name = "show_if_{$type}";
			echo '' .
				'<input type="radio" name="show_if[page]" value="' . $name . '" id="' . $name . '-yes" ' .
					($name == $show_if ? 'checked="checked"' : '') .
				'/ >' .
				' <label for="' . $name . '-yes">' . sprintf(__('&quot;%s&quot; post pages', 'esi'), $obj->label) . '</label>' .
			'<br />';
		}

		echo '</fieldset>';
		echo '</div>';

		echo '</div>';
	
		
	}

	function render_content_type () {
		global $post;
		$opts = get_post_meta($post->ID, 'esi-type', true);
		$type = esi_getval($opts, 'content_type', 'text');

		echo '<div class="esiui-ui esiui-meta">';

		echo '' .
			'<input type="radio" name="esi-type[content_type]" id="esi-content_type-text" value="text" ' . ('text' == $type ? 'checked="checked"' : '') . ' />' .
			'&nbsp;' .
			'<label for="esi-content_type-text">' . __('Free text/html message', 'esi') . '</label>' .
		'<br />';
		echo '' .
				'<input type="radio" name="esi-type[content_type]" id="esi-content_type-optin" value="optin" ' . ('optin' == $type ? 'checked="checked"' : '') . ' />' .
				'&nbsp;' .
				'<label for="esi-content_type-optin">' . __('Optin form', 'esi') . '</label>' .
				'<br />';
		echo '' .
			'<input type="radio" name="esi-type[content_type]" id="esi-content_type-mailchimp" value="mailchimp" ' . ('mailchimp' == $type ? 'checked="checked"' : '') . ' />' .
			'&nbsp;' .
			'<label for="esi-content_type-mailchimp">' . __('MailChimp subscription form', 'esi') . '</label>' .
		'<br />';
		echo '' .
			'<input type="radio" name="esi-type[content_type]" id="esi-content_type-related" value="related" ' . ('related' == $type ? 'checked="checked"' : '') . ' />' .
			'&nbsp;' .
			'<label for="esi-content_type-related">' . __('Related posts', 'esi') . '</label>' .
		'<br />';
		$data = new ESI_Options;
		if ($data->get_option('allow_widgets')) {
			echo '' .
				'<input type="radio" name="esi-type[content_type]" id="esi-content_type-widgets" value="widgets" ' . ('widgets' == $type ? 'checked="checked"' : '') . ' />' .
				'&nbsp;' .
				'<label for="esi-content_type-widgets">' . __('Sidebar widgets', 'esi') . '</label>' .
			'<br />';
		}

		// --- Message
		echo '<div id="esi-content_type-options-text" class="esi-content_type" style="display:none">';
		echo '<div class="esi-dashboard-panel">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'Optin form code</div>';
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" class="esiui-table">';
		echo '<col width="25%"/><col width="75%"/>';
		echo '<tr class="even">';
		$fromcode = esi_getval($opts, 'text-formcode');
		echo '<td class="param"><label for="esi-text-formcode">' . __('Put external optin form code:<br/><span class="esi-info-label">To use in message editor insert code <b>%%form%%</b> where you wish form to appear.</span>') . '</label></td>' .
				'<td><textarea class="" name="esi-type[text-formcode]" id="esi-text-formcode" style="width: 80%;" rows="10">'.esc_textarea($fromcode).'</textarea></td>' .
				'</tr>';
		echo '</table>';
		echo '</div>';
		echo '</div>';

		// --- MailChimp
		echo '<div id="esi-content_type-options-mailchimp" class="esi-content_type" style="display:none">';
		echo '<div class="esi-dashboard-panel">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'MailChimp options</div>';
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" class="esiui-table">';
		echo '<col width="25%"/><col width="75%"/>';
		echo '<tr class="even">';
		$defaults = get_option('esi');
		$api_key = esi_getval($opts, 'mailchimp-api_key', esi_getval($defaults, 'mailchimp-api_key'));
		echo '<td class="param"><label for="esi-mailchimp-api_key">' . __('MailChimp API key:') . '</label></td>' .
			'<td><input type="text" class="long" name="esi-type[mailchimp-api_key]" id="esi-mailchimp-api_key" value="' . esc_attr($api_key) . '" /></td>' .
		'</tr>';
		if (!$api_key) {
			echo '<tr><td></td><td>';
			echo $this->_create_hint(__('Enter your API key here, then save the post to continue', 'esi'));
			echo '</td></tr>';
		} else {
			$mailchimp = new ESI_Mailchimp($api_key);

			$lists = $mailchimp->get_lists();
			$current = esi_getval($opts, 'mailchimp-default_list', esi_getval($defaults, 'mailchimp-default_list'));
			echo '<tr class="odd">';
			echo '<td class="param"><label>' . __('Default subscription list:', 'esi') . ' </label></td>';
			echo '<td><div class="esiui-ui-select"><select name="esi-type[mailchimp-default_list]">';
			echo '<option></option>';
			foreach ($lists as $list) {
				$selected = $list['id'] == $current ? 'selected="selected"' : '';
				echo '<option value="' . esc_attr($list['id']) . '" ' . $selected . '>' . $list['name'] . '</option>';
			}
			echo '</select></div></td>';
			echo '</tr>';
			// We got this far, we have the API key
			//echo '&nbsp;<a href="#mcls-refresh" id="esi-mcls-refresh">' . __('Refresh', 'esi') . '</a>';
			//echo $this->_create_hint(__('Select a default list you wish to subscribe your visitors to.', 'esi'));

			$placeholder = esi_getval($opts, 'mailchimp-placeholder', 'you@yourdomain.com');
			echo '<tr class="even">';
			echo '<td class="param"><label for="esi-mailchimp-placeholder">' . __('Placeholder text:', 'esi') . '</label></td>' .
				'<td><input type="text" class="long" name="esi-type[mailchimp-placeholder]" id="esi-mailchimp-placeholder" value="' . esc_attr($placeholder) . '" />' .
			'</td>';
			echo '</tr>';
			$position = esi_getval($opts, 'mailchimp-position', 'after');
			echo '<tr class="odd">';
			echo '<td class="param"><label for="esi-mailchimp-position-after">' . __('Show my form:', 'esi') . '</label></td>';
			echo '<td class="esi-mailchimp-position">' .
				'<input type="radio" name="esi-type[mailchimp-position]" id="esi-mailchimp-position-after" value="after" ' . checked('after', $position, false) . ' />' .
				'<label for="esi-mailchimp-position-after">' . __('After the message text', 'esi') . '</label>' .
			'<br />';
			echo '' .
				'<input type="radio" name="esi-type[mailchimp-position]" id="esi-mailchimp-position-before" value="before" ' . checked('before', $position, false) . ' />' .
				'<label for="esi-mailchimp-position-before">' . __('Before the message text', 'esi') . '</label>' .
			'</td>';
			echo '</tr>';

			$subscription_message = esi_getval($opts, 'mailchimp-subscription_message', esi_getval($defaults, 'mailchimp-subscription_message'));
			$subscription_message = $subscription_message ? $subscription_message : __('All good, thank you!', 'esi');
			$subscription_message = wp_strip_all_tags($subscription_message);
			echo '<tr class="even">';
			echo '<td class="param">' .
				'<label for="esi-mailchimp-subscription_message">' . __('Successful subscription message:', 'esi') . '</label></td>' .
				'<td><input type="text" class="long" name="esi-type[mailchimp-subscription_message]" id="esi-mailchimp-subscription_message" value="' . esc_attr($subscription_message) . '" /></td>' .
			'</tr>';
		}
		echo '</table>';
		echo '</div>';
		echo '</div>';

		// --- Related posts
		echo '<div id="esi-content_type-options-related" class="esi-content_type" style="display:none">';
		echo '<div class="esi-dashboard-panel">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'Related Posts</div>';
		
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" class="esiui-table">';
		echo '<col width="25%"/><col width="75%"/>';
		$count = esi_getval($opts, 'related-posts_count', 3);
		echo '<tr class="even">';
		echo '<td class="param"><label>' . __('Show this many related posts:', 'esi') . ' </label></td>';
		echo '<td><div class="esiui-ui-select1"><select name="esi-type[related-posts_count]">';
		foreach (range(1, 10) as $item) {
			$selected = $item == $count ? 'selected="selected"' : '';
			echo '<option value="' . esc_attr($item) . '" ' . $selected . '>' . $item . '</option>';
		}
		echo '</select></div></td>';
		echo '</tr>';

		$taxonomies = get_taxonomies(array(
			'public' => true,
		), 'objects');
		
		$nextPostObject = new StdClass;
		$nextPostObject->label = 'Next post (display only 1)';
		
		$taxonomies['esinextpost'] = $nextPostObject;
		$related_tax = esi_getval($opts, 'related-taxonomy', 'post_tag');
		
		echo '<tr class="odd">';
		echo '<td class="param"><label>' . __('Related taxonomy:', 'esi') . ' </label></td>';
		echo '<td><div class="esiui-ui-select"><select name="esi-type[related-taxonomy]">';
		foreach ($taxonomies as $tax => $item) {
			$selected = $tax == $related_tax ? 'selected="selected"' : '';
			echo '<option value="' . esc_attr($tax) . '" ' . $selected . '>' . $item->label . '</option>';
		}
		echo '</select></div></td>';
		echo '</tr>';
		
		echo '<tr class="even">';
		$display_title = esi_getval($opts, 'related-display_title');
		echo '<td class="param">' . '<label for="esi-display_title">' . __('Display following title above list', 'esi') . '</label></td>' .
				'<td>' .
				'<input type="text" id="esi-display_title" name="esi-type[related-display_title]" value="'.$display_title.'" class="wide" />' .
				'</td></tr>';
		
		
		$show_title = esi_getval($opts, 'related-show_title');
		echo '<tr class="odd">';		
		echo '<td class="param">' . '<label for="esi-show_title">' . __('Show title?', 'esi') . '</label></td>' .
				'<td><input type="hidden" name="esi-type[related-show_title]" value="" />' .
				'<input type="checkbox" id="esi-show_title" name="esi-type[related-show_title]" value="1" ' . ($show_title ? 'checked="checked"' : '') . ' />' .
				'</td></tr>';
		$show_date = esi_getval($opts, 'related-show_date');
		echo '<tr class="even">';
		echo '<td class="param">' . '<label for="esi-show_date">' . __('Show date?', 'esi') . '</label></td>' .
				'<td><input type="hidden" name="esi-type[related-show_date]" value="" />' .
				'<input type="checkbox" id="esi-show_date" name="esi-type[related-show_date]" value="1" ' . ($show_date ? 'checked="checked"' : '') . ' />' .
				'</td></tr>';
		
		$show_author = esi_getval($opts, 'related-show_author');
		echo '<tr class="odd">';
		echo '<td class="param">' . '<label for="esi-show_author">' . __('Show author?', 'esi') . '</label></td>' .
				'<td><input type="hidden" name="esi-type[related-show_author]" value="" />' .
				'<input type="checkbox" id="esi-show_author" name="esi-type[related-show_author]" value="1" ' . ($show_author ? 'checked="checked"' : '') . ' />' .
				'</td></tr>';
		$show_comments = esi_getval($opts, 'related-show_comments');
		echo '<tr class="even">';
		echo '<td class="param">' . '<label for="esi-show_comments">' . __('Show comments count?', 'esi') . '</label></td>' .
				'<td><input type="hidden" name="esi-type[related-show_comments]" value="" />' .
				'<input type="checkbox" id="esi-show_comments" name="esi-type[related-show_comments]" value="1" ' . ($show_comments ? 'checked="checked"' : '') . ' />' .
				'</td></tr>';
		
		echo '<tr class="odd">';
		$show_excerpt = esi_getval($opts, 'related-show_excerpt');
		echo '<td class="param">' . '<label for="esi-show_excerpt">' . __('Show excerpt?', 'esi') . '</label></td>' .
				'<td><input type="hidden" name="esi-type[related-show_excerpt]" value="" />' .
				'<input type="checkbox" id="esi-show_excerpt" name="esi-type[related-show_excerpt]" value="1" ' . ($show_excerpt ? 'checked="checked"' : '') . ' />' .
				'</td></tr>';
		
		
		$show_content = esi_getval($opts, 'related-show_content');
		echo '<tr class="even">';
		echo '<td class="param">' . '<label for="esi-show_content">' . __('Show content?', 'esi') . '</label></td>' .
				'<td><input type="hidden" name="esi-type[related-show_content]" value="" />' .
				'<input type="checkbox" id="esi-show_content" name="esi-type[related-show_content]" value="1" ' . ($show_content ? 'checked="checked"' : '') . ' />' .
				'</td></tr>';

		$show_cats = esi_getval($opts, 'related-show_cats');
		echo '<tr class="odd">';
		echo '<td class="param">' . '<label for="esi-show_cats">' . __('Show categories?', 'esi') . '</label></td>' .
				'<td><input type="hidden" name="esi-type[related-show_cats]" value="" />' .
				'<input type="checkbox" id="esi-show_cats" name="esi-type[related-show_cats]" value="1" ' . ($show_cats ? 'checked="checked"' : '') . ' />' .
				'</td></tr>';
		
		$show_tags = esi_getval($opts, 'related-show_tags');
		echo '<tr class="even">';
		echo '<td class="param">' . '<label for="esi-show_tags">' . __('Show tags?', 'esi') . '</label></td>' .
				'<td><input type="hidden" name="esi-type[related-show_tags]" value="" />' .
				'<input type="checkbox" id="esi-show_tags" name="esi-type[related-show_tags]" value="1" ' . ($show_tags ? 'checked="checked"' : '') . ' />' .
				'</td></tr>';
		
		echo '<tr class="odd">';
		$show_readmore = esi_getval($opts, 'related-show_readmore');
		echo '<td class="param">' . '<label for="esi-show_readmore">' . __('Show read more?', 'esi') . '</label></td>' .
				'<td><input type="hidden" name="esi-type[related-show_readmore]" value="" />' .
				'<input type="checkbox" id="esi-show_readmore" name="esi-type[related-show_readmore]" value="1" ' . ($show_readmore ? 'checked="checked"' : '') . ' />' .
				'</td></tr>';
		
		echo '<tr class="even">';
		$excerpt_readmore = esi_getval($opts, 'related-excerpt_readmore');
		echo '<td class="param">' . '<label for="esi-excerpt_readmore">' . __('Read more text', 'esi') . '</label></td>' .
				'<td>' .
				'<input type="text" id="esi-excerpt_readmore" name="esi-type[related-excerpt_readmore]" value="'.$excerpt_readmore.'" class="long" />' .
				'</td></tr>';
		
		
		echo '<tr class="odd">';
		$show_thumbnail = esi_getval($opts, 'related-show_thumbnail');
		echo '<td class="param">' . '<label for="esi-show_thumbnail">' . __('Show thumbnail?', 'esi') . '</label></td>' .
			'<td><input type="hidden" name="esi-type[related-show_thumbnail]" value="" />' .
			'<input type="checkbox" id="esi-show_thumbnail" name="esi-type[related-show_thumbnail]" value="1" ' . ($show_thumbnail ? 'checked="checked"' : '') . ' />' .
			'</td></tr>';
		
		if ( function_exists('the_post_thumbnail') && current_theme_supports( 'post-thumbnails' ) ) {
			$sizes = get_intermediate_image_sizes();
			$thumb_size = esi_getval($opts, 'related-thumb_size');
			echo '<tr class="even">';
			echo '<td class="param">' . '<label for="esi-thumb_size">' . __('Thumbnail Size:', 'esi') . '</label></td>' .
			'<td><select name="esi-type[related-thumb_size]">';
			
			foreach ($sizes as $size) :
			                echo '<option value="'.$size.'"'.(($thumb_size == $size) ? ' selected' : '').'>'.$size.'</option>';
			            endforeach;
			            echo '<option value="full"'.(($thumb_size == 'full') ? ' selected' : '').'>full</option>';
			             
			echo '</select></td></tr>';

			$positions = array("after" => "After post title", "before" => "Before post title", "left" => "Left from content");
			$thumb_pos = esi_getval($opts, 'related-thumb_pos');
			echo '<tr class="odd">';
			echo '<td class="param">' . '<label for="esi-thumb_pos">' . __('Thumbnail Position:', 'esi') . '</label></td>' .
			'<td><select name="esi-type[related-thumb_pos]">';
			
			foreach ($positions as $pos => $text) :
			                echo '<option value="'.$pos.'"'.(($thumb_pos == $pos) ? ' selected' : '').'>'.$text.'</option>';
			            endforeach;
			            
			             
			echo '</select></td></tr>';
		}
		
		echo '</table>';
		echo '</div>';
		echo '</div>';

		// --- Widgets
		if ($data->get_option('allow_widgets')) {
			
			$widget_count = $data->get_option('allow_widgets_count');
			if (!$widget_count) { $widget_count = '1'; }
			$widget_count = intval($widget_count);
			
			echo '<div id="esi-content_type-options-widgets" class="esi-content_type" style="display:none">';
			echo '<div class="esi-dashboard-panel">';
			echo '<div class="esi-dashboard-panel-title">';
			echo 'Choose sidebar</div>';
			
			echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" class="esiui-table">';
			echo '<col width="25%"/><col width="75%"/>';
			$count = esi_getval($opts, 'sidebar-id', 1);
			echo '<tr class="even">';
			echo '<td class="param"><label>' . __('Choose ID of sidebar you wish to use:', 'esi') . ' </label></td>';
			echo '<td><div class="esiui-ui-select1"><select name="esi-type[sidebar-id]">';
			foreach (range(1, $widget_count) as $item) {
				$selected = $item == $count ? 'selected="selected"' : '';
				echo '<option value="' . esc_attr($item) . '" ' . $selected . '>' . $item . '</option>';
			}
			echo '</select></div></td>';
			echo '</tr>';
			echo '</table>';
			echo '</div>';
			
			echo '</div>';
		}

		echo '<div id="esi-content_type-options-optin" class="esi-content_type" style="display:none">';
		echo '<div class="esi-dashboard-panel">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'Optin form</div>';
			
		$widget_count = 5;
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" class="esiui-table">';
		echo '<col width="25%"/><col width="75%"/>';
		$count = esi_getval($opts, 'optin-id', 1);
		echo '<tr class="even">';
		echo '<td class="param"><label>' . __('Choose style of option form:', 'esi') . ' </label><br/><span class="esi-info-label">You can configure and preview styles in Optin Forms menu</span></td>';
		echo '<td><div class="esiui-ui-select1"><select name="esi-type[optin-id]">';
		foreach (range(1, $widget_count) as $item) {
			$selected = $item == $count ? 'selected="selected"' : '';
			echo '<option value="' . esc_attr($item) . '" ' . $selected . '>' . $item . '</option>';
		}
		echo '</select></div></td>';
		echo '</tr>';
		echo '</table>';
		echo '</div>';
			
		echo '</div>';		
		
		echo '</div>';
	}

	function render_show_after_box () {
		global $post;
		$opts = get_post_meta($post->ID, 'esi', true);
		$condition = esi_getval($opts, 'show_after-condition');
		$value = esi_getval($opts, 'show_after-rule');
		$selector = "";
		$timeout = "";
		$percentage = "";
		
		switch ($condition) {
			case "selector":
				$selector = 'checked="checked"';
				break;
			case "timeout":
				$timeout = 'checked="checked"';
				$value = (int)$value;
				break;
			case "percentage":
				$percentage = 'checked="checked"';
				$value = (int)$value;
				break;
		}

		$pos = esi_getval($opts, 'position');
		$width = esi_getval($opts, 'width');
		$fullheight = esi_getval($opts, 'fullheight');
		
		$appearance_override = esi_getval($opts, 'appearance_override');		
		
		$override_checked = ($appearance_override == '1') ? 'checked="checked"' : '';
		// legacy 1.x version check for option activate
		if ($override_checked == '') {
			$override_checked = ($percentage || $timeout || $selector || $pos || $width) ? 'checked="checked"' : '';
		}
		echo '<div class="esi-override-display">';
		echo '<p class="esiui-ui">' .
			'<input type="checkbox" id="esi-override_show_if" name="esi[appearance_override]" value="1" ' . $override_checked . ' /> ' .
			'<label for="esi-override_show_if">' . __('Override Global Settings', 'esi') . '</label>' .
		'</p>';
		
		echo '<p class="esi-info">Do not forget to activate override option if you personalize slide-in settings.</p>';

		echo '<div id="esi-show_after_overrides-container" class="esiui-ui">';
		echo '<div class="esi-dashboard-panel">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'Show Easy Slide-In Message After</div>';
		
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" class="esiui-table">';
		echo '<col width="25%"/><col width="75%"/>';
		
		//echo '<div class="title-div">Activate display settings</div>';
		// Initial condition
		//echo '<fieldset id="esi-show_after"><legend>' . __('Show after', 'esi') . '</legend>';

		$percentage_select = '<select name="esi[show_after-rule]" ' . ($percentage ? '' : 'disabled="disabled"') . '>';
		for ($i=1; $i<100; $i++) {
			$selected = ($i == $value) ? 'selected="selected"' : '';
			$percentage_select .= "<option value='{$i}' {$selected}>{$i}&nbsp;</option>";
		}
		$percentage_select .= '</select>%';
		echo '<tr class="odd"><td colspan="2">' .
			'<input type="radio" name="esi[show_after-condition]" value="percentage" id="esi-show_after-percentage" ' . $percentage . ' /> ' .
			'<label for="esi-show_after-percentage">' .
				__('Show message after this much of my page has been viewed', 'esi') .
				': ' .
			'</label>' .
			$percentage_select .
		'</td></tr>';

		echo '<tr class="even"><td colspan="2">' .
			'<input type="radio" name="esi[show_after-condition]" value="selector" id="esi-show_after-selector" ' . $selector . ' /> ' .
			'<label for="esi-show_after-selector">' .
				__('Show message after scrolling past element with this ID', 'esi') .
				': #' .
			'</label>' .
			'<input type="text" size="8" name="esi[show_after-rule]" id="" value="' . ($selector ? esc_attr($value) : '') . '" ' . ($selector ? '' : 'disabled="disabled"') . ' />' .
		'</td></tr>';

		echo '<tr class="odd"><td colspan="2">' .
			'<input type="radio" name="esi[show_after-condition]" value="timeout" id="esi-show_after-timeout" ' . $timeout . ' /> ' .
			'<label for="esi-show_after-timeout">' .
				__('Show message after this many seconds', 'esi') .
				': ' .
			'</label>' .
			'<input type="text" size="2" name="esi[show_after-rule]" id="" value="' . ($timeout ? esc_attr($value) : '') . '" ' . ($timeout ? '' : 'disabled="disabled"') . ' />' .
		'</td></tr>';
		//echo '</fieldset>';
		echo '</table>';
		echo '</div>';

		// Timeout
		echo '<div id="esi-show_after_overrides-container" class="esiui-ui">';
		echo '<div class="esi-dashboard-panel">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'Close Easy Slide-In Message After</div>';
		
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" class="esiui-table">';
		echo '<col width="25%"/><col width="75%"/>';
		//echo '<fieldset id="esi-show_for"><legend>' . __('Show for', 'esi') . '</legend>';
		$time = esi_getval($opts, 'show_for-time');
		$unit = esi_getval($opts, 'show_for-unit');

		$_times = array_combine(range(1,59), range(1,59));
		$_units = array(
			's' => __('Seconds', 'esi'),
			'm' => __('Minutes', 'esi'),
			'h' => __('Hours', 'esi'),
		);

		echo '<tr class="even"><td class="param">Choose the time that message will remain on screen<br/><span class="esi-info-label">Set timer when message will close automatically. To avoid automated close please select higher value in hours - for example 24 hours.</span></td>';
		echo "<td><select name='esi[show_for-time]'>";
		foreach ($_times as $_time) {
			$selected = $_time == $time ? 'selected="selected"' : '';
			echo "<option value='{$_time}' {$selected}>{$_time}</option>";
		}
		echo "</select>";

		echo "<select name='esi[show_for-unit]'>";
		foreach ($_units as $key => $_unit) {
			$selected = $key == $unit ? 'selected="selected"' : '';
			echo "<option value='{$key}' {$selected}>{$_unit}</option>";
		}
		echo "</select><br/><span id=\"esi-stay-onscreen\" class=\"esi-stay-onscree button esi-small-button\">Make my message to stay on screen and does not close automatically during user session</span></td></tr>";
		//echo '</fieldset>';
		echo '</table></div>';
		
		//echo '<div class="title-div">Position settings</div>';
		echo '<div id="esi-show_after_overrides-container" class="esiui-ui">';
		echo '<div class="esi-dashboard-panel">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'Position and type of Easy Slide-In Message</div>';
		
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" class="esiui-table">';
		echo '<col width="25%"/><col width="75%"/>';
		
		echo '<tr class="odd">';
		echo '<td class="param">Quick message type settings apply</td>';
		echo '<td>';
		echo '<select id="esi-quick-style-apply" class="esi-quick-style-apply">';
		echo '<option value="">--- choose message type ---</option>';
		echo '<option value="1">Regular slide-in message from selected position</option>';
		echo '<option value="2">Bottom bar slide-in message</option>';
		echo '<option value="3">Top bar slide-in message</option>';
		echo '<option value="4">Left screen sidebar slide-in message</option>';
		echo '<option value="5">Right screen sidebar slide-in message</option>';
		echo '<option value="6">Full screen slide-in message</option>';
		echo '</select>';
		echo '</td>';
		echo '</tr>';
		
		// Position
		//echo '<fieldset id="esi-position"><legend>' . __('Position', 'esi') . '</legend>';
		echo '<tr class="even"><td class="param">Position:<br/><span class="esi-info-label">Choose position where message will appear.</span></td>';
		echo '<td><div  class="esiui-ui-element_container">';
		echo '<div class="position-control">' .
			$this->_create_radiobox('position', 'left', $pos) .
			$this->_create_radiobox('position', 'top', $pos) .
			$this->_create_radiobox('position', 'right', $pos) .
			$this->_create_radiobox('position', 'bottom', $pos) .
			$this->_create_radiobox('position', 'bottom_left', $pos) .
			$this->_create_radiobox('position', 'bottom_right', $pos) .
			$this->_create_radiobox('position', 'top_left', $pos) .
			$this->_create_radiobox('position', 'top_right', $pos) .
			$this->_create_radiobox('position', 'center', $pos) .
			'</div>';
		echo '</div></td><//tr>';
		
		//echo '<tr class="odd">';
		//echo '<td class="param">Apply Setting Values For:</td>';
		//echo '<td>';
		//echo '<select class="esi-predefined" id="esi-repdefined">'.
		//		'<option value="">--- choose ---</option>'.
		//		'<option value="slide">Default Slide In Options (display as slide from any of available locations)</option>'.
		//		'<option value="bar">Top, Bottom or Middle (Bar at the full width of screen) Bar</option>'.
		//		'<option value="side">Left, Right (Bar at the full height of screen) Bar</option>'.
		//		'<option value="full">Screen overlay (entire screen hidden with slide)</option>'.
		//		'</select>';
		
		//echo '</td></tr>';
		
		//echo '</fieldset>';
		//echo '<div class="title-div">Width settings</div>';
		//echo '<fieldset id="esi-widthsettings"><legend>' . __('Width', 'esi') . '</legend>';
		echo '<tr class="odd"><td class="param">Full width message:<br/><span class="esi-info-label">Activate this option to allow message to take the full width of browser screen</span></td>';
		echo '<td>';
		$checked = (!(int)$width || 'full' == 'width') ? 'checked="checked"' : '';
		
		$hchecked = ('full' == $fullheight) ? 'checked="checked"' : '';
		echo '' .
			'<input type="checkbox" name="esi[width]" value="full" id="esi-full_width" ' . $checked . ' autocomplete="off" />' .
			'&nbsp;' .
			'<label for="esi-full_width"></label>' .
		'';
		$display = $checked ? 'style="display:none"' : '';
		//echo '<div id="esi-custom_width" ' . $display . '>';
		$disabled = $checked ? 'disabled="disabled"' : '';
		echo '</td></tr><tr class="even"><td class="param">' . __('Custom Message width:', 'esi') .'<br/><span class="esi-info-label">Set custom message width in pixels (top, bottom bar or full screen message).</span></td><td id="esi-custom_width">';

			echo '<input type="text" size="8" class="medium" name="esi[width]" id="esi-width" value="' . (int)$width . '" ' . $disabled . ' />px' .
		'';
		//echo '</div>';
		
		echo '</td></tr>';
		
		echo '<tr class="odd">';
		echo '<td class="param">Full height message:<br/><span class="esi-info-label">This will make message to fit in browser height from top to bottom (sidebar or full screeen message).</span></td>';
		echo '<td>';
		echo '' .
				'<input type="checkbox" name="esi[fullheight]" value="full" id="esi-full_heightwidth" ' . $hchecked . ' autocomplete="off" />' .
				'&nbsp;' .
				'<label for="esi-full_heightwidth"></label>' .
				'';
		echo '</td></tr>';
		
		
		echo '<tr class="even"><td class="param">'.__('Display content vertically', 'esi').'<br/><span class="esi-info-label">This option makes releated posts message type to display content vertically (when you use sidebar).</span></td><td>';
		$vetical_cols = esi_getval($opts, 'vetical_cols');
		$checked = ($vetical_cols == "yes") ? 'checked="checked"' : '';
		echo '' .
				'<input type="checkbox" name="esi[vetical_cols]" value="yes" id="esi-vetical_cols" ' . $checked . ' autocomplete="off" />' .
				
				'';
		
		//echo '</fieldset>';
		echo '</td></tr>';
		echo '</table></div>';

		//echo '<div class="title-div">Style settings</div>';
		//echo '<fieldset id="esi-widthsettings"><legend>' . __('Colors', 'esi') . '</legend>';
		//echo '<div id="esi-show_after_overrides-container" class="esiui-ui">';
		echo '<div class="esi-dashboard-panel">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'Style Settings</div>';
		
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" class="esiui-table">';
		echo '<col width="25%"/><col width="75%"/>';
		
		$bgcolor = esi_getval($opts, 'bgcolor');
		$textcolor =esi_getval($opts, 'textcolor'); 
		$accentcolor =esi_getval($opts, 'accentcolor'); 
		$nobackground = esi_getval($opts, 'nobackground');
		$backgroundimage = esi_getval($opts, 'backgroundimage');
		$bgcoloropacity = esi_getval($opts, 'bgcoloropacity');
		$slide_padding = esi_getval($opts, 'padding');
		
		if ($nobackground == '1') {
			$nobackground = ' checked="checked"';
		}
		else {
			$nobackground ='';
		}
		
		$post_id = isset($post) ? $post->ID : '';
		
		//echo '<table border="0" celpadding="5" cellspacing="0" width="100%"><col width="15%"/><col width="85%"/><tr><td colspan="2">' .
				//$this->_create_hint(__('Customize default main colors of slide in panel. More detailed customization can be done with additional CSS field', 'esi')). '';
		echo '<tr class="even"><td  class="param"><span for="esi-bgcolor">' . __('Background color:') . '</span><br/><span class="esi-info-label">Set custom background color.</span></td>' .
				'<td><input type="text" class="short" name="esi[bgcolor]" id="esi-bgcolor" value="' . esc_attr($bgcolor) . '" />' .
				'</td></tr>';
		echo '<tr class="odd"><td  class="param"><span for="esi-bgcoloropacity">' . __('Background color opacity:') . '</span><br/><span class="esi-info-label">Set background color opacity. Value can be between 0 and 1 (0 - fully transparent, 1 - full color).</span></td>' .
				'<td><input type="text" class="short" name="esi[bgcoloropacity]" id="esi-bgcoloropacity" value="' . esc_attr($bgcoloropacity) . '" />' .
				'</td></tr>';
		echo '<tr class="even"><td  class="param"><span for="esi-textcolor">' . __('Text color:') . '</span><br/><span class="esi-info-label">Set custom text color</span></td>' .
				'<td><input type="text" class="short" name="esi[textcolor]" id="esi-textcolor" value="' . esc_attr($textcolor) . '" />' .
				'</td></tr>';
		echo '<tr class="odd"><td class="param"><span for="esi-accentcolor">' . __('Highlight color:') . '</span><br/><span class="esi-info-label">Set custom highlight color which is used when links or buttons are displayed.</span></td>' .
				'<td><input type="text" class="short" name="esi[accentcolor]" id="esi-accentcolor" value="' . esc_attr($accentcolor) . '" />' .
				'</td></tr>';
		echo '<tr class="even"><td class="param"><span for="esi-nobackground">' . __('No background color:') . '</span><br/><span class="esi-info-label">This will remove background color and shadow that is rendered with slide.</span></td>' .
				'<td><input type="checkbox" name="esi[nobackground]" id="esi-nobackground" value="1" '.$nobackground.' />' .
				'</td></tr>';
		echo '<tr class="odd"><td class="param"><span for="esi-backgroundimage">' . __('Background image:') . '</span><br/><span class="esi-info-label">Set slide-in message background image (this option can be combined with background color too).</span></td>' .
				'<td><input type="text" class="wide" name="esi[backgroundimage]" id="esi-backgroundimage" value="' . esc_attr($backgroundimage) . '" />' .
				'<button id="esi-button-backgroundimage" value="Select" class="button">Select</button></td></tr>';
		echo '<tr class="even"><td class="param"><span for="esi-padding">' . __('Padding:') . '</span><br/><span class="esi-info-label">The padding property can have from one to four values: 20px (all four paddings are 20px), 10px 20px (top and bottom are 10px, left and right 20px), 10px 20px 30px 40px (top is 10px, right is 20px, bottom is 30px, left is 40px)</span></td>' .
				'<td><input type="text" class="large" name="esi[padding]" id="esi-padding" value="' . esc_attr($slide_padding) . '" />' .
				'</td></tr>';
		echo '<tr class="odd">';
		$fromcode = esi_getval($opts, 'custom-slide-css');
		echo '<td class="param"><label for="esi-custom-slide-css">' . __('Custom CSS Code.') . '</label><br/><span class="esi-info-label">Set custom CSS code that will be included when this slide is rendered</span></td>' .
				'<td><textarea class="" name="esi[custom-slide-css]" id="esi-custom-slide-css" style="width: 80%;" rows="10">'.esc_textarea($fromcode).'</textarea></td>' .
				'</tr>';
		
		if ($post_id != '') {
			echo '<tr class="odd"><td class="param"><span for="esi-padding"></span></td>' .
					'<td>Current post root CSS selector is: <b>.esi-slide-wrap-'.$post_id.'</b>, re open button selector is <b>.esi-slide-reopen-'.$post_id.'</b>. For example to change font size of slide in message you can use following CSS code: .esi-slide-wrap-'.$post_id.' .esi-slide-content { font-size: 12px; }' .
					'</td></tr>';
		}
		
		echo '</table>';
		
		echo '</div>';
		$closecolor =esi_getval($opts, 'closecolor');
		$closebgcolor =esi_getval($opts, 'closebgcolor');
		$closetop =esi_getval($opts, 'closetop');
		$closeright = esi_getval($opts, 'closeright');
		$closepadding = esi_getval($opts, 'closepadding');
		$closedesign = esi_getval($opts, 'closedesign');
		
		$_closedesign = array(
				'square' => __('Square', 'esi'),
				'round' => __('Circle', 'esi')
		);
		
		echo '<div class="esi-dashboard-panel">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'Close button style settings</div>';
		
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" class="esiui-table">';
		echo '<col width="25%"/><col width="75%"/>';
		echo '<tr class="even"><td class="param"><span for="esi-closecolor">' . __('Close button color:') . '</span><br/><span class="esi-info-label">Set custom close button color. If nothing is provided the highlight color is used.</span></td>' .
				'<td><input type="text" class="short" name="esi[closecolor]" id="esi-closecolor" value="' . esc_attr($closecolor) . '" />' .
				'</td></tr>';
		echo '<tr class="odd"><td class="param"><span for="esi-closebgcolor">' . __('Close button background color:') . '</span><br/><span class="esi-info-label">Set custom close button background color</span></td>' .
				'<td><input type="text" class="short" name="esi[closebgcolor]" id="esi-closebgcolor" value="' . esc_attr($closebgcolor) . '" />' .
				'</td></tr>';
		echo '<tr class="even"><td  class="param"><span for="esi-closetop">' . __('Customize top position of close button:') . '</span><br/><span class="esi-info-label">Set custom top position of close button in px(default is 0px). To move button top provide negative value (example: -10px).</span></td>' .
				'<td><input type="text" class="large" name="esi[closetop]" id="esi-closetop" value="' . esc_attr($closetop) . '" />' .
				'</td></tr>';
		echo '<tr class="odd"><td  class="param"><span for="esi-closeright">' . __('Customize left/right position of close button:') . '</span><br/><span class="esi-info-label">Set custom left/right position of close button in px (default is 0px). To move button left/right provide negative value (example: -10px).</span></td>' .
				'<td><input type="text" class="large" name="esi[closeright]" id="esi-closeright" value="' . esc_attr($closeright) . '" />' .
				'</td></tr>';
		echo '<tr class="even"><td class="param"><span for="esi-closepadding">' . __('Padding:') . '</span><br/><span class="esi-info-label">The padding property can have from one to four values: 20px (all four paddings are 20px), 10px 20px (top and bottom are 10px, left and right 20px), 10px 20px 30px 40px (top is 10px, right is 20px, bottom is 30px, left is 40px)</span></td>' .
				'<td><input type="text" class="large" name="esi[closepadding]" id="esi-closepadding" value="' . esc_attr($closepadding) . '" />' .
				'</td></tr>';

		echo '<tr class="odd"><td class="param"><span for="esi-closedesign">' . __('Close button style:') . '</span><br/><span class="esi-info-label">Choose the style of close button - square or circle</span></td>' .
				'<td>';
			echo "<select name='esi[closedesign]'>";
		foreach ($_closedesign as $key => $_design) {
			$selected = $key == $closedesign ? 'selected="selected"' : '';
			echo "<option value='{$key}' {$selected}>{$_design}</option>";
		}
		echo		'</td></tr>';
		echo '<tr class="even"><td class="param">'.__('Hide close button', 'esi').'<br/><span class="esi-info-label">This option will hide the close button. In this case slide in will clsoe when automatic close event is passed. If you wish to create manual close button you can use any html element where you need to add this class <strong>easy-slide-close</strong> to make it work as close button.</span></td><td>';
		$closehide = esi_getval($opts, 'closehide');
		$checked = ($closehide == "yes") ? 'checked="checked"' : '';
		echo '' .
				'<input type="checkbox" name="esi[closehide]" value="yes" id="esi-closehide" ' . $checked . ' autocomplete="off" />' .
		
				'';
		
		//echo '</fieldset>';
		echo '</td></tr>';
		echo '</table>';
		
		echo '</div>';
		
		echo '<div class="esi-dashboard-panel">';
		echo '<div class="esi-dashboard-panel-title">';
		echo 'Activate message open/re-open button</div>';
		
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" class="esiui-table">';
		echo '<col width="25%"/><col width="75%"/>';
		
		$close_bgcolor = esi_getval($opts, 'close_bgcolor');
		$close_color = esi_getval($opts, 'close_color');
		$close_active = esi_getval($opts, 'close_active');
		$close_text = esi_getval($opts, 'close_text');
		$close_icon = esi_getval($opts, 'close_icon');
		$open_active = esi_getval($opts, 'open_active');
		
		if ($close_active == "yes") {
			$close_active = ' checked="checked"';
		}
		else {
			$close_active = "";
		}
		if ($open_active == "yes") {
			$open_active = ' checked="checked"';
		} 
 
		echo '<tr class="even"><td colspan="2">'.$this->_create_hint(__('Re open button is function that allows user to open again message when the close button is pressed (it will not appear on automated close event based on time or position).<br/>After load open button is another function that allows you to display button immeditaly after page is loaded and will allow user to display slide-in message before open event is applied. <br/>This options are individual set for each slide where you wish button to appear.', 'esi')).'</td></tr>';
		echo '<tr class="even"><td  class="param"><span for="esi-close_active">' . __('Activate after close re-open button:') . '</span><br/><span class="esi-info-label">You need to set this option on to allow re open button to appear after user closes the slide message.</span></td>' .
				'<td><input type="checkbox" name="esi[close_active]" id="esi-close_active" value="yes" '.$close_active.' />' .
				'</td></tr>';
		echo '<tr class="odd"><td  class="param"><span for="esi-open_active">' . __('Activate after load open button:') . '</span><br/><span class="esi-info-label">This option will activate message open button which will be displayed immediatetly after load and will allow user to open message before event for automated opening is reached.</span></td>' .
				'<td><input type="checkbox" name="esi[open_active]" id="esi-open_active" value="yes" '.$open_active.' />' .
				'</td></tr>';
		echo '<tr class="even"><td class="param"><span for="esi-close_text">' . __('Text message:') . '</span><br/><span class="esi-info-label">Set custom text message that will appear on button. You can use any combination: text message and icon, icon only, text message only.</span></td>' .
				'<td><input type="text" class="wide" name="esi[close_text]" id="esi-close_text" value="' . esc_attr($close_text) . '" />' .
				'</td></tr>';		
		echo '<tr class="odd"><td  class="param"><span for="esi-close_icon">' . __('Icon:') . '</span><br/><span class="esi-info-label">If you wish to use icon put FontAwsome icon code here</span></td>' .
				'<td><input type="text" class="large" name="esi[close_icon]" id="esi-close_icon" value="' . esc_attr($close_icon) . '" />' .
				'</td></tr>';
		
		echo '<tr class="even"><td  class="param"><span for="esi-close_color">' . __('Element color:') . '</span><br/><span class="esi-info-label">Set icon and text color</span></td>' .
				'<td><input type="text" class="short" name="esi[close_color]" id="esi-close_color" value="' . esc_attr($close_color) . '" />' .
				'</td></tr>';
		echo '<tr class="odd"><td  class="param"><span for="esi-close_bgcolor">' . __('Background color:') . '</span><br/><span class="esi-info-label">Set background color for re open button</span></td>' .
				'<td><input type="text" class="short" name="esi[close_bgcolor]" id="esi-close_bgcolor" value="' . esc_attr($close_bgcolor) . '" />' .
				'</td></tr>';
		echo '</table></div>';
		
		echo '</div></div></div>';
		
		echo '
<script type="text/javascript">


jQuery(document).ready(function($){
    $(\'#esi-bgcolor\').wpColorPicker();
    $(\'#esi-textcolor\').wpColorPicker();
    $(\'#esi-accentcolor\').wpColorPicker();
    $(\'#esi-closecolor\').wpColorPicker();
    $(\'#esi-closebgcolor\').wpColorPicker();
    $(\'#esi-close_bgcolor\').wpColorPicker();
	$(\'#esi-close_color\').wpColorPicker();
});

</script>';
	}


	/**
	 * Saves metabox data.
	 */
	function save_meta () {
		global $post;
		if ($post && self::POST_TYPE != $post->post_type) return false;
		if (!isset($post)) { return false; }
		if (esi_getval($_POST, 'show_if')) {
			update_post_meta($post->ID, "esi_show_if", esi_getval($_POST, "show_if"));
		}
		else {
			update_post_meta($post->ID, "esi_show_if", false);
		}

		if (esi_getval($_POST, 'esi')) {
			// If we have Post Indexer present, remove the post save action for the moment.

			$esi_settings_container = esi_getval($_POST, 'esi');
			$appearance_override = esi_getval($esi_settings_container, 'appearance_override');
			
			if (!empty($appearance_override)) update_post_meta($post->ID, "esi", esi_getval($_POST, "esi"));
			else update_post_meta($post->ID, "esi", false);

		}
		if (!empty($_POST['esi-type']['content_type'])) update_post_meta($post->ID, "esi-type", esi_getval($_POST, "esi-type"));
	}

	/**
	 * Updates pool status.
	 */
	function set_up_post_status ($data) {
		if (self::POST_TYPE != $data['post_type']) return $data;
		if (esi_getval($_POST, 'not_in_the_pool')) {
			$data['post_status'] = self::NOT_IN_POOL_STATUS;
		}
		return $data;
	}

	function add_custom_columns ($cols) {
		return array_merge($cols, array(
			'esi_type' => __('Content Type', 'esi'),
			'esi_pool' => __('Status', 'esi'),
			'esi_conditions' => __('Conditions', 'esi'),
		));
	}

	function fill_custom_columns ($col) {
		global $post;
		if ('esi_pool' != $col && 'esi_conditions' != $col && 'esi_type' != $col) return $col;

		switch ($col) {
			case 'esi_pool':
				echo ('publish' == $post->post_status ? __('Automatic Display', 'esi') : __('Manual Display', 'esi'));
				break;
			case 'esi_type':
				$all_content_types = array(
					'text' => __('Free text/html message', 'esi'),
					'optin' => __('Optin Form', 'esi'),
					'mailchimp' => __('MailChimp subscription form', 'esi'),
					'related' => __('Related posts', 'esi'),
					'widgets' => __('Sidebar widgets', 'esi'),
				);
				$type = get_post_meta($post->ID, 'esi-type', true);
				$content_type = esi_getval($type, 'content_type', 'text');
				if (!empty($all_content_types[$content_type])) echo $all_content_types[$content_type];
				break;
			case 'esi_conditions':
				if (self::NOT_IN_POOL_STATUS == $post->post_status) {
					$post_links = array();
					global $wpdb;
					$appears_on = $wpdb->get_col($wpdb->prepare("SELECT post_id FROM {$wpdb->postmeta} WHERE (meta_key='esi_message_id' OR meta_key='esi_message_id2' OR meta_key='esi_message_id3' OR meta_key='esi_message_id4' OR meta_key='esi_message_id5') AND meta_value=%d", $post->ID));
					if (empty($appears_on)) {
						_e("Not applicable", 'esi');
						break;
					} else foreach ($appears_on as $target_id) {
						$post_links[] = '<a href="' . admin_url('post.php?action=edit&post=' . $target_id) . '">' . get_the_title($target_id) . '</a>';
					}
					printf(__('Appears on %s', 'esi'), join('<br />', $post_links));
					break;
				}
				$show = get_post_meta($post->ID, 'esi_show_if', true);
				switch (esi_getval($show, 'user')) {
					case "show_if_logged_in":
						_e("Shown for logged in users", 'esi');
						break;
					case "show_if_not_logged_in":
						_e("Shown for visitors", 'esi');
						break;
					case "show_if_never_commented":
						_e("Shown for non-commenters", 'esi');
						break;
					default:
						_e("Can appear for all users", 'esi');
				}
				echo '<br />';
				$types = get_post_types(array('public' => true), 'objects');
				$show_page = esi_getval($show, 'page');
				switch ($show_page) {
					case "show_if_singular":
						_e("Shown on singular pages", 'esi');
						break;
					case "show_if_not_singular":
						_e("Shown on archive pages", 'esi');
						break;
					case "show_if_home":
						_e("Shown on home page", 'esi');
						break;
					default:
						$shown_for_types = array();
						foreach ($types as $type => $obj) {
							if ("show_if_{$type}" == $show_page) $shown_for_types[] = sprintf(__('Shown on %s pages', 'esi'), $obj->labels->name);
						}
						if ($shown_for_types) {
							echo join('<br />', $shown_for_types);
						} else {
							_e("Can appear on all pages", 'esi');
						}
						break;
				}
				$show_fromdate = esi_getval($show, 'from');
				$show_todate = esi_getval($show, 'to');
				$show_fromhour = esi_getval($show, 'hfrom');
				$show_tohour = esi_getval($show, 'hto');
				
				if ($show_fromdate != '' && $show_todate != '') {
					echo '<br/>';
					_e("Show on date range: ", 'esi');
					echo '<br/><b>'.$show_fromdate . ' - '.$show_todate.'</b>';
				}

				if ($show_fromhour != '' && $show_tohour != '') {
					echo '<br/>';
					_e("Show on timeframe: ", 'esi');
					echo '<br/><b>'.$show_fromhour . ' - '.$show_tohour.'</b>';
				}
				break;
				
				
		}
	}


/* ----- Model procedures: message ----- */


	public function get_message_data ($post) {
		$post_id = (is_object($post) && isset($post->ID)) ? $post->ID : (int)$post_id;

		// ...

		//$post_id = 2852;
		$pool = $this->_get_active_messages_pool($post_id);
		
		$display_all_manual = get_post_meta($post_id, 'esi_display_all', true);
		if ($display_all_manual) {
			return $pool ? $pool : false;
		}
		else {
			// check and return if multiple messages are selected for view
			$data = new ESI_Options;
			$message_count = 1;
			if ($data->get_option('allow_multiple')) {
			
				$message_count = $data->get_option('allow_multiple_count');
				if (!$message_count) {
					$message_count = '1';
				}
			
				$message_count = intval($message_count);
			}
			
			if ($message_count > 1) {
				if ($pool) {
					$newPool = array();
					$cnt = 1;
					foreach ($pool as $oneMessage) {
						if ($cnt > $message_count) {
							break;
						}
						
						$newPool[] = $oneMessage;
						$cnt++;
					}
					
					return $newPool;
				}
				else {
					return false;
				}
			}
			else {
				return $pool ? array($pool[0]) : false;
			}
		}
	}


/* ----- Model procedures: pool ----- */


	/**
	 * Fetching out all the currently active messages.
	 */
	private function _get_active_messages_pool ($specific_post_id=false) {
		$pool = array();
		$query = new WP_Query(array(
			'post_type' => self::POST_TYPE,
			'posts_per_page' => -1,
		));
		$pool = $query->posts ? $query->posts : array();

		if ($specific_post_id) {
			$msg_id = get_post_meta($specific_post_id, 'esi_message_id', true);
			if ($msg_id) $pool = array(get_post($msg_id));

			$msg_id2 = get_post_meta($specific_post_id, 'esi_message_id2', true);
			if ($msg_id2) $pool[] = (get_post($msg_id2));

			$msg_id3 = get_post_meta($specific_post_id, 'esi_message_id3', true);
			if ($msg_id3) $pool[] = (get_post($msg_id3));

			$msg_id4 = get_post_meta($specific_post_id, 'esi_message_id4', true);
			if ($msg_id4) $pool[] = (get_post($msg_id4));

			$msg_id5 = get_post_meta($specific_post_id, 'esi_message_id5', true);
			if ($msg_id5) $pool[] = (get_post($msg_id5));
				
		}
		$pool = array_filter($pool, array($this, '_filter_active_messages_pool'));
		
		// apply date filters
		$newPool = array();
		foreach ($pool as $one) {
			$show = get_post_meta($one->ID, 'esi_show_if', true);
			$use = true;
			$show_fromdate = esi_getval($show, 'from');
			$show_todate = esi_getval($show, 'to');
			$show_fromhour = esi_getval($show, 'hfrom');
			$show_tohour = esi_getval($show, 'hto');
			
			$date_filter_active = false;
			
			if ($show_fromdate != '' || $show_todate != '' && $use) {
				$today = date("Ymd");
					
				$date_filter_active = true;
					
				$show_fromdate = str_replace('-', '' , $show_fromdate);
				$show_todate = str_replace('-', '' , $show_todate);
					
				if (intval($today) <= intval($show_todate) && intval($today) >= intval($show_fromdate)) {
					$use = true;
				}
				else {
					$use = false;
				}
			}
			
			if ($show_fromhour != '' && $show_tohour != '' && $use) {
				$should_apply_hour_filter = false;
					
				if ($date_filter_active && $use) {
					$should_apply_hour_filter = true;
				}
					
				if (!$date_filter_active && $use) {
					$should_apply_hour_filter = true;
				}
					
				if ($should_apply_hour_filter) {
					$thishour = date("H");
			
					if (intval($thishour) <= intval($show_tohour) && intval($thishour) >= intval($show_fromhour)) {
						$use = true;
					}
					else {
						$use = false;
					}
				}
			}
			
			if ($use) {
				$newPool[] = $one;
			}
		}
		
		$pool = $newPool;
		
		shuffle($pool);

		return $pool;
	}

	/**
	 * Filters messages in pool to active ones.
	 * `array_filter` callback.
	 */
	function _filter_active_messages_pool ($msg) {
		$use = true;
		$show = get_post_meta($msg->ID, 'esi_show_if', true);
		switch (esi_getval($show, 'user')) {
			case "show_if_logged_in":
				$use = is_user_logged_in(); break;
			case "show_if_not_logged_in":
				$use = !(is_user_logged_in()); break;
			case "show_if_never_commented":
				$use = isset($_COOKIE['comment_author_'.COOKIEHASH]); break;
		}
		if (!$use) return $use;

		$page_condition = esi_getval($show, 'page');
		if (empty($page_condition)) return true;

		switch ($page_condition) {
			case "show_if_singular":
				$use = is_singular(); break;
			case "show_if_not_singular":
				$use = !(is_singular()); break;
			case "show_if_home":
				$use = is_front_page(); break;
			case "show_if_query":
				$use = $this->existQueryString();
				break;
		}
		if (!$use) return $use;
		$types = get_post_types(array('public' => true), 'objects');
		foreach ($types as $type => $obj) {
			$name = "show_if_{$type}";
			if ($name == $page_condition) $use = is_singular($type);
		}
		
		
		
		// todo add date time filter
		return $use; // In the pool, by default
	}
	
	function existQueryString() {
		$exist = false;
	
		if (!empty($_SERVER['QUERY_STRING'])) {
	
			$exist = true;
		}
	
		return $exist;
	}

	function _create_radiobox ($name, $value, $option) {
		$checked = (@$option == $value) ? true : false;
		$class = $value ? "class='{$value}'" : '';
		return "<input type='radio' name='esi[{$name}]' {$class} id='{$name}-{$value}' value='{$value}' " . ($checked ? 'checked="checked" ' : '') . " /> ";
	}

	function _create_color_radiobox ($name, $value, $label, $option) {
		$color = esc_attr($value);
		$label= esc_attr($label);
		return "<label class='esi-color-container' for='{$name}-{$value}'>" .
			$this->_create_radiobox($name, $value, $option) .
			"<div class='esi-color esi-{$color}' title='{$label}'></div>" .
		'</label>';
	}

	function _create_hint ($text) {
		return "<div class='info-message'><span class='info'></span>{$text}</div>";
	}
}