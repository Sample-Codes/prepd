<?php
/**
 * Handles public functionality.
 */
class ESI_PublicPages {

	const COOKIE_HIDE_CONDITION = 'esi-on_hide';

	private $_data;
	private $_esi;

	private function __construct () {
		$this->_esi = Easy_SlideIn::get_instance();
		$this->_data = new ESI_Options;
	}

	/**
	 * Main entry point.
	 *
	 * @static
	 */
	public static function serve () {
		$me = new ESI_PublicPages;
		$me->add_hooks();
	}

	function add_hooks () {
		add_action('init', array($this, 'init_cookies'));

		add_action('wp_enqueue_scripts', array($this, 'css_load_styles'));
		add_action('wp_enqueue_scripts', array($this, 'js_load_scripts'));

		$hook = trim($this->_data->get_option('custom_injection_hook'));
		$hook = "wp_footer";
		$hook = $hook ? $hook : Easy_SlideIn::get_default_injection_hook();
		add_action($hook, array($this, 'add_message'));

		// @since 1.1 - if activated hide for mobile devices
		$mobile_detect = new EasySlideIn_Mobile_Detect();
		if ( $mobile_detect->isMobile() && !$mobile_detect->isTablet()) {
			$hide_mobile = trim($this->_data->get_option('hide_mobile'));
			
			if ($hide_mobile == "true") {
				remove_action($hook, array($this, 'add_message'));
			}
		}
		
		add_filter('esi_content', 'wpautop');
		if ($this->_data->get_option('allow_shortcodes')) {
			add_filter('esi_content', 'do_shortcode');
		}

		add_action('wp_head', array($this, 'compile_custom_css'));
		
	}

	function init_cookies () {
		$on_hide = $this->_data->get_option('on_hide');
		$cookie_name = $this->_get_cookie_name();
		$request = preg_replace('/[^-_a-z0-9]/i', '_', $_SERVER['REQUEST_URI']);

		if (empty($on_hide)) {
			// First off, clear hiding cookie if needs be
			$_COOKIE[$cookie_name] = false;
			unset($_COOKIE[$cookie_name]);
			setcookie($cookie_name, '', time() - 86400, COOKIEPATH);

		} else if ('all' == $on_hide && !empty($_COOKIE[$cookie_name])) {
			// Next up, check sitewide policy
			define('ESI_BOX_RENDERED', true, true); // Skip rendering

		} else if ('page' == $on_hide && !empty($_COOKIE["{$cookie_name}{$request}"])) {
			// Lastly, check individual URI path fragments
			define('ESI_BOX_RENDERED', true, true); // Skip rendering
		}

		/*} else if ('page' == $on_hide && !empty($_COOKIE[$cookie_name])) {
			// Lastly, check individual URI path fragments
			$seen = json_decode(stripslashes($_COOKIE[$cookie_name]), true);
			if (is_array($seen) && in_array($_SERVER['REQUEST_URI'], $seen)) {
				define('ESI_BOX_RENDERED', true, true); // Skip rendering
			}
		}*/
	}

	function js_load_scripts () {
		wp_enqueue_script('jquery');
		wp_enqueue_script('esi', ESI_PLUGIN_URL . '/assets/js/easy-slide-in.js', array('jquery'), ESI_VERSION);

		$on_hide = $this->_data->get_option('on_hide');
		$cookie_name = $this->_get_cookie_name();

		$valid_units = array('hours', 'days', 'weeks');
		$timeout_time = $this->_data->get_option('reshow_after-time');
		$timeout_units = $this->_data->get_option('reshow_after-units');
		if (empty($timeout_units) || !in_array($timeout_units, $valid_units)) $timeout_units = 'days';
		if (!empty($timeout_time)) {
			$now = time();
			$timeout_time = strtotime(sprintf("+%d %s", $timeout_time, $timeout_units), $now) - $now;
		}

		wp_localize_script('esi', '_esi_data', array(
			'reshow' => array(
				'timeout' => (int)$timeout_time,
				'name' => $cookie_name,
				'path' => COOKIEPATH,
				'all' => ('all' == $on_hide),
			),
		));
	}

	private function _get_cookie_name () {
		$hash = md5(
			$this->_data->get_option('on_hide') .
			$this->_data->get_option('reshow_after-time') .
			$this->_data->get_option('reshow_after-units')
		);
		return self::COOKIE_HIDE_CONDITION . $hash;
	}

	function css_load_styles () {
		if (!current_theme_supports('esi')) {
			wp_enqueue_style('easy-slide-in', ESI_PLUGIN_URL . '/assets/css/easy-slide-in.css', array(), ESI_VERSION);
			wp_enqueue_style('easy-slide-in-fa', ESI_PLUGIN_URL . '/assets/css/font-awesome.min.css', array(), ESI_VERSION);
		}
		$opts = get_option('esi');
		if (empty($opts['css-custom_styles'])) return false;
		$style = wp_strip_all_tags($opts['css-custom_styles']);
		echo "<style type='text/css'>{$style}</style>";
	}

	private function _is_wrong_place () {
		global $wp_current_filter;

		if (is_feed()) return true; // Don't do this for feeds

		$is_excerpt = array_reduce($wp_current_filter, create_function('$ret,$val', 'return $ret ? true : preg_match("/excerpt/", $val);'), false);
		$is_head = array_reduce($wp_current_filter, create_function('$ret,$val', 'return $ret ? true : preg_match("/head\b|head[^w]/", $val);'), false);
		$is_title = array_reduce($wp_current_filter, create_function('$ret,$val', 'return $ret ? true : preg_match("/title/", $val);'), false);
		if ($is_excerpt || $is_head || $is_title) return true;

		// MarketPress virtual subpages
		if (class_exists('MarketPress') && !$this->_data->get_option('show_on_marketpress_pages')) {
			global $mp;
			if ($mp->is_shop_page && !is_singular('product')) return true;
		}

		return false;
	}

	function add_message ($content) {
		if (defined('ESI_BOX_RENDERED')) return false;
		if ($this->_is_wrong_place()) return false;

		global $post, $current_user;

		$hook = trim($this->_data->get_option('custom_injection_hook'));
		$hook = "wp_footer";
		$hook = $hook ? $hook : Easy_SlideIn::get_default_injection_hook();
		
		// if is selected as no show, also return false
		if (!empty($post->ID)) {
			$do_not_show = get_post_meta($post->ID, 'esi_do_not_show', true);
			if ($do_not_show) return false;
		}
		$opts = get_option('esi');

		$messages = $this->_esi->get_message_data($post);
		if (!$messages) return false;
		
		// @since 1.1 - multiple images same time
		$injectCode = "";
		foreach ($messages as $message) {
			
			$msg = get_post_meta($message->ID, 'esi', true);
			$type = get_post_meta($message->ID, 'esi-type', true);
	
			$skip_script = esi_getval($opts, 'skip_script');
			$skip_script = is_array($skip_script) ? $skip_script : array();
	
			$no_count = esi_getval($opts, 'no_count');
			$no_count = is_array($no_count) ? $no_count : array();
	
			$content_type = esi_getval($type, 'content_type', 'text');
			if ('widgets' == $content_type && !$this->_data->get_option('allow_widgets')) return false; // Break on this
	
			$related_posts_count = esi_getval($type, 'related-posts_count', 3);
			$related_taxonomy = esi_getval($type, 'related-taxonomy', 'post_tag');
			$related_has_thumbnails = esi_getval($type, 'related-has_thumbnails');
	
			$sidebar_id = esi_getval($type, 'sidebar-id', 1);
			$optin_id = esi_getval($type, 'optin-id', 1);
				
			$mailchimp_placeholder = esi_getval($type, 'mailchimp-placeholder', 'you@yourdomain.com');
			$mailchimp_position = esi_getval($type, 'mailchimp-position', 'after');
	
			$position = esi_getval($msg, 'position') ? $msg['position'] : esi_getval($opts, 'position');
			$position = $position ? $position : 'left';
	
			$percentage = $selector = $timeout = false;
			$condition =  esi_getval($msg, 'show_after-condition') ? $msg['show_after-condition'] :esi_getval($opts, 'show_after-condition');
			$value = esi_getval($msg, 'show_after-rule') ? $msg['show_after-rule'] : esi_getval($opts, 'show_after-rule');
			switch ($condition) {
				case "selector":
					$selector = "#{$value}";
					$percentage = '0%';
					$timeout = '0s';
					break;
				case "timeout":
					$selector = false;
					$percentage = '0%';
					$timeout = sprintf('%ds', (int)$value);
					break;
				case "percentage":
				default:
					$selector = false;
					$percentage = sprintf('%d%%', (int)$value);
					$timeout = '0s';
					break;
			}
	
			$_theme = "minimal";
			$theme = $_theme && in_array($_theme, array_keys(Easy_SlideIn::get_appearance_themes())) ? $_theme : 'minimal';
	
			$expire_after = esi_getval($msg, 'show_for-time') ? $msg['show_for-time'] : esi_getval($opts, 'show_for-time');
			$expire_after = $expire_after ? $expire_after : 10;
			$expire_unit = esi_getval($msg, 'show_for-unit') ? $msg['show_for-unit'] : esi_getval($opts, 'show_for-unit');
			$expire_unit = $expire_unit ? $expire_unit : 's';
			$expire_timeout = sprintf("%d%s", $expire_after, $expire_unit);
	
			$user_vertical_cols = esi_getval($msg, 'vetical_cols') ? $msg['vetical_cols'] : esi_getval($opts, 'vetical_cols');		
			$is_vertical = false;
			if ($user_vertical_cols == 'yes') {$is_vertical = true; }
			
			$full_width = $width = false;
			$_width = esi_getval($msg, 'width') ? $msg['width'] : esi_getval($opts, 'width');
			if (!(int)$_width || 'full' == $width) {
				$full_width = 'slidein-full';
			} else {
				$width = 'style="width:' . (int)$_width . 'px;"';
			}
			
			$full_height = esi_getval($msg, 'fullheight') ? $msg['fullheight']  : '';
			if ($full_height != '') {
				$full_height = 'slidein-fullheight';
			}
			$user_optinform = esi_getval($type, 'text-formcode') ? $type['text-formcode'] : '';
			//$user_optinform = esc_textarea($user_optinform);
			ob_start();
			
			$close_active = esi_getval($msg, 'close_active') ? $msg['close_active'] : '';
			$close_text = esi_getval($msg, 'close_text') ? $msg['close_text'] : '';
			$close_icon = esi_getval($msg, 'close_icon') ? $msg['close_icon'] : '';
			$open_active = esi_getval($msg, 'open_active') ? $msg['open_active'] : '';

			$closehide = esi_getval($msg, 'closehide') ? $msg['closehide'] : '';
			
			if ($close_active == "yes" || $open_active == "yes") {
				require(ESI_PLUGIN_BASE_DIR . '/lib/slide-in/box_output-reopen.php');
			}
				
			require(ESI_PLUGIN_BASE_DIR . '/lib/slide-in/box_output.php');
			//$this->_js_set_up_globals($message->ID);
			
			
			//$injectCode .= ob_get_contents();
			$user_code = ob_get_contents();
			$injectCode .= $user_code;
			
			
			$injectCode = str_replace('%%form%%', $user_optinform, $injectCode);
			
			ob_end_clean();							
				
		}
		
		if (!defined('ESI_BOX_RENDERED')) {
			define ('ESI_BOX_RENDERED', true);
		}
		
		if ($hook == "the_content") {
			return $content.$injectCode;
		}
		else {
			echo $injectCode;
		}
	}
	
	function compile_custom_css() {
		global $post;
		
		$opts = get_option('esi');		
		$messages = $this->_esi->get_message_data($post);
		if (!$messages) return false;
		
		$message = $messages[0];
		
		$msg = get_post_meta($message->ID, 'esi', true);
		
		$post_id = $message->ID;
		
		$user_bgcolor = esi_getval($msg, 'bgcolor') ? $msg['bgcolor'] : esi_getval($opts, 'bgcolor');
		$user_textcolor = esi_getval($msg, 'textcolor') ? $msg['textcolor'] : esi_getval($opts, 'textcolor');
		$user_accentcolor = esi_getval($msg, 'accentcolor') ? $msg['accentcolor'] : esi_getval($opts, 'accentcolor');
		$user_vertical_cols = esi_getval($msg, 'vetical_cols') ? $msg['vetical_cols'] : esi_getval($opts, 'vetical_cols');					
		//$user_vertical_cols = '';
		$user_bgcoloropacity = esi_getval($msg, 'bgcoloropacity') ? $msg['bgcoloropacity'] : '';
		
		if ($user_bgcoloropacity != '') {
			$user_bgcolor = $this->hex2rgba($user_bgcolor, $user_bgcoloropacity);
		}
		
		$user_nobackground = esi_getval($msg, 'nobackground') ? $msg['nobackground'] : '';
		$user_closecolor = esi_getval($msg, 'closecolor') ? $msg['closecolor'] : '';
		$user_backgroundimage = esi_getval($msg, 'backgroundimage') ? $msg['backgroundimage'] : '';
		$user_custom_css = esi_getval($msg, 'custom-slide-css') ? $msg['custom-slide-css'] : '';
		
		$user_padding = esi_getval($msg, 'padding') ? $msg['padding'] : '';
		
		$close_bgcolor = esi_getval($msg, 'close_bgcolor') ? $msg['close_bgcolor'] : '';
		$close_color = esi_getval($msg, 'close_color') ? $msg['close_color'] : '';
		
		// close button additional
		$closebgcolor =esi_getval($msg, 'closebgcolor') ? $msg['closebgcolor'] : '';
		$closetop =esi_getval($msg, 'closetop') ? $msg['closetop'] : '';
		$closeright = esi_getval($msg, 'closeright') ? $msg['closeright'] : '';
		$closepadding = esi_getval($msg, 'closepadding') ? $msg['closepadding'] : '';	
		$closedesign = esi_getval($msg, 'closedesign') ? $msg['closedesign'] : '';	
		
		if ($user_bgcolor != '' || $user_textcolor != '' || $user_accentcolor != '' || $user_vertical_cols != '' || $user_nobackground != '' || $user_closecolor != '' 
				|| $user_backgroundimage != '' || $user_custom_css != '' || $user_padding != '' || $close_bgcolor != '' || $close_color != '' || $closebgcolor != '' ||
				$closetop != '' || $closeright != '' || $closepadding != '' || $closedesign != '') {
			echo '<style type="text/css">';
			
			if ($user_custom_css != '') {
				echo $user_custom_css;
			}

			if ($close_bgcolor != '') {
				echo '.esi-slide-reopen-'.$post_id.' { background-color: '.$close_bgcolor.' !important;}';
			}
				
			if ($close_color != '') {
				echo '.esi-slide-reopen-'.$post_id.' { color: '.$close_color.' !important;}';
			}

			
			if ($user_padding != '') {
				echo '.esi-slide-wrap-'.$post_id.' .esi-slide-content { padding: '.$user_padding.'}';
				
			}

			if ($user_nobackground != '') {
				echo '.esi-slide-wrap-'.$post_id.' { background: none !important; -webkit-box-shadow: none !important; -moz-box-shadow: none !important; -ms-box-shadow: none !important; -o-box-shadow:none !important;box-shadow:none !important;}';				
			}

			if ($user_backgroundimage != '') {
				echo '.esi-slide-wrap-'.$post_id.' { background: url("'.$user_backgroundimage.'") repeat top left !important;}';
			}
				
			if ($user_bgcolor != '' && $user_nobackground == '') {
				echo '.esi-slide-wrap-'.$post_id.' { background-color: '.$user_bgcolor.' !important;}';
			}
			if ($user_textcolor != '') {
				echo '.esi-slide-wrap-'.$post_id.' { color: '.$user_textcolor.' !important;}';
			}
			if ($user_accentcolor != '') {
				echo '.esi-slide-wrap-'.$post_id.' { border-top-color:'.$user_accentcolor.'!important;}';
				echo '.esi-slide-wrap-'.$post_id.' .esi-slide-thumb { border-color:'.$user_accentcolor.'!important;}';
				echo '.esi-slide-wrap-'.$post_id.' a, .esi-slide-wrap-'.$post_id.' a:visited, .esi-slide-wrap-'.$post_id.' a:hover { color:'.$user_accentcolor.'!important;}';
				echo '.esi-slide-wrap-'.$post_id.' .esi-mailchimp-email, .esi-mailchimp-email:focus { border-color:'.$user_accentcolor.'!important;}';
				echo '.esi-slide-wrap-'.$post_id.' .esi-mailchimp-subscribe, { color:'.$user_accentcolor.'!important;}';
				echo '.esi-slide-wrap-'.$post_id.' .esi-mailchimp-subscribe:hover, { border-color:'.$user_accentcolor.'!important;}';
			}
			
			if ($user_vertical_cols == "yes") {
				echo '.esi-slide-wrap-'.$post_id.' .esi-slide-col { width: 100% !important; margin-bottom: 10px !important; }';
			
			}
			
		// close button
			if ($user_closecolor != '') {
				echo '.esi-slide-control-'.$post_id.' a { color: '.$user_closecolor.' !important;}';
			}
			if ($closebgcolor != '') {
				echo '.esi-slide-control-'.$post_id.' a { background-color: '.$closebgcolor.' !important;}';
			}
			if ($closetop != '') {
				echo '.esi-slide-control-'.$post_id.' .esi-slide-close { top: '.$closetop.' !important;}';
			}
			if ($closeright != '') {
				echo '.esi-slide-control-'.$post_id.' .esi-slide-close { right: '.$closeright.' !important;}';
				echo '.esi-slide-right .esi-slide-control-'.$post_id.' .esi-slide-close { left: '.$closeright.' !important;}';
			}
			if ($closepadding != '') {
				echo '.esi-slide-control-'.$post_id.' a { padding: '.$closepadding.' !important;}';
			}
				
			if ($closedesign == 'round') {
				echo '.esi-slide-control-'.$post_id.' a { -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;}';
			}

			echo '</style>';
		
		}
		
		// @since 1.1 hide on specific resolution only
		$hide_mobile_condition = esi_getval($opts, 'hide_condition_mobile');
		$hide_condition_mobile_resolution = esi_getval($opts, 'hide_condition_mobile_resolution');
		
		if ($hide_mobile_condition == 'true' && $hide_condition_mobile_resolution != '0') {
			//		echo '@media only screen and (max-width: 767px) { .essb_fixed { left: 5px !important; } }';
			//esi-slide
			echo '<style type="text/css">';
			echo '@media only screen and (max-width: '.$hide_condition_mobile_resolution.'px) { .esi-slide { display: none !important; visiblity: hidden !important; } }';
			echo '</style>';
		}
	}
	
	function hex2rgba($color, $opacity = false) {
	
		$default = 'rgb(0,0,0)';
	
		//Return default if no color provided
		if(empty($color))
			return $default;
	
		//Sanitize $color if "#" is provided
		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}
	
		//Check if color has 6 or 3 characters and get values
		if (strlen($color) == 6) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}
	
		//Convert hexadec to rgb
		$rgb =  array_map('hexdec', $hex);
	
		//Check if opacity is set(rgba or rgb)
		if($opacity){
			if(abs($opacity) > 1)
				$opacity = 1.0;
			$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		} else {
			$output = 'rgb('.implode(",",$rgb).')';
		}
	
		//Return rgb(a) color string
		return $output;
	}
}