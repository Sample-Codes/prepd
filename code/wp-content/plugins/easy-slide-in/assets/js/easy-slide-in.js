(function ($) {

var Cookies = (function () {
	// Nabbed from MDN
	var MdnCookies = {
		getItem: function (sKey) {
			if (!sKey || !this.hasItem(sKey)) { return null; }
			return unescape(document.cookie.replace(new RegExp("(?:^|.*;\\s*)" + escape(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*((?:[^;](?!;))*[^;]?).*"), "$1"));
		},

		setItem: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
			if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return; }
			var sExpires = "";
			if (vEnd) {
				switch (vEnd.constructor) {
					case Number:
						sExpires = vEnd === Infinity ? "; expires=Tue, 19 Jan 2038 03:14:07 GMT" : "; max-age=" + vEnd;
						break;
					case String:
						sExpires = "; expires=" + vEnd;
						break;
					case Date:
						sExpires = "; expires=" + vEnd.toGMTString();
						break;
				}
			}
			document.cookie = escape(sKey) + "=" + escape(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
		},

		removeItem: function (sKey, sPath) {
			if (!sKey || !this.hasItem(sKey)) { return; }
			document.cookie = escape(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sPath ? "; path=" + sPath : "");
		},

		hasItem: function (sKey) {
			return (new RegExp("(?:^|;\\s*)" + escape(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
		},

		keys: function () {
			var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
			for (var nIdx = 0; nIdx < aKeys.length; nIdx++) { aKeys[nIdx] = unescape(aKeys[nIdx]); }
			return aKeys;
		}
	};

	return {
		get: function (key) {
			return MdnCookies.getItem(key);
		},
		set: function (key, value) {
			var reshow = parseInt(_esi_data.reshow.timeout, 10) || 0,
				timeout = new Date((new Date()).getTime() + (reshow * 1000)),
				path = _esi_data.reshow.path,
				cookie_name = this.create_page_key(key, value)

			;
			return MdnCookies.setItem(cookie_name, value, timeout, path);
		},
		remove: function (key) {
			return MdnCookies.removeItem(key);
		},
		has: function (key) {
			return MdnCookies.hasItem(key);
		},
		keys: function () {
			return MdnCookies.keys();
		},
		create_page_key: function (key, value) {
			hide_all = _esi_data.reshow.all;
			return hide_all
				? key
				: (key + value.replace(/[^-_a-z0-9]/ig, '_'))
			;
		}
	};
})();

function register_seen_uri () {
	var cookie_name = _esi_data.reshow.name,
		path = window.location.pathname
	;
	Cookies.set(cookie_name, path);
}

function cache_cookie_exists () {
	var cookie_name = _esi_data.reshow.name,
		path = window.location.pathname,
		cookie = false
	;
	if (_esi_data.reshow.all) { // Check all-cache
		cookie = Cookies.get(cookie_name);
	} else { // Check page chache
		cookie_name = Cookies.create_page_key(cookie_name, path);
		cookie = Cookies.get(cookie_name);
	}
	return cookie;
}


$(function () {

	// First, check if we got tricked by the cache
	if (!!cache_cookie_exists()) return false;

	// Next, if related posts content, fix the width
	var $root = $("#esi-slide_in"),
		$content = $root.find(".esi-slide-content"),
		$related = $root.find(".esi-slide-columns"),
		$wrap = $root.find(".esi-slide-wrap"),
		$posts = $related.length ? $related.find(".esi-slide-col") : []
	;
	if ($related.length && $posts.length) {
		var single_width = $posts.outerWidth(),
			count = $posts.length,
			window_width = $(window).width(),
			padding = (count+1.5) * ($posts.outerWidth() - $posts.width()),
			total_width = (single_width * count) + padding
		;
		if (total_width > window_width) {
			// We are bigger then the screen, ouch! Hide extra posts
			var delta = Math.ceil((total_width - window_width) / single_width),
				iter = 0
			;
			count -= delta;
			$($posts.get().reverse()).each(function () {
				// Hide extra posts
				if (iter >= delta) return false;
				$(this).hide();
				iter++;
			});
		} else {
			// We have less posts then we can - snap width
			$wrap.width(total_width);
		}
	}
	// Withs fixed, carry on

	var slidein_obj = [];
	var timedSlideIn_obj_shown = [];
	var legacy = false;
	var slidein_reopen = [];
	
	function css_support( property )
	{
		var div = document.createElement('div');
		var reg = new RegExp("(khtml|moz|ms|webkit|)"+property, "i");
		for ( var s in div.style ) {
			if ( s.match(reg) )
				return true;
		}
		return false;
	}

	function calculate_vertical_side( obj ){
		var h = $(obj).innerHeight();
		if ( $(obj).hasClass('esi-slide-top') ||  $(obj).hasClass('esi-slide-top_right') ||  $(obj).hasClass('esi-slide-top_left') )
			$(obj).css('top', h*-1).data('slidein-pos', h*-1);
		else if ( $(obj).hasClass('esi-slide-bottom') ||  $(obj).hasClass('esi-slide-bottom_right') ||  $(obj).hasClass('esi-slide-bottom_left') )
			$(obj).css('bottom', h*-1).data('slidein-pos', h*-1);
		
		if ($(obj).hasClass('esi-slide-bottom') || $(obj).hasClass('esi-slide-top')) {
			$(obj).css({	        
		        "left": ((($(window).width() - $(obj).outerWidth()) / 2) + $(window).scrollLeft() + "px")
		    });
		}
	}

	function calculate_center_side(obj) {
		$(obj).css({	        
	        //"top": ((($(window).height() - $(obj).outerHeight()) / 2) + $(window).scrollTop() + "px"),
	        "top": (( $(window).height() / 2) + "px"),
	        "left": ((($(window).width() - $(obj).outerWidth()) / 2) + $(window).scrollLeft() + "px")
	    });
	}
	
	function calculate_horizontal_side( obj ){
		var h = $(obj).innerHeight();
		$(obj).css('margin-top', Math.floor(h/2)*-1);
		var w = $(obj).innerWidth();
		if ( $(obj).hasClass('esi-slide-right') )
			$(obj).css('right', w*-1).data('slidein-pos', w*-1);
		else if ( $(obj).hasClass('esi-slide-left') )
			$(obj).css('left', w*-1).data('slidein-pos', w*-1);
	}

	function slidein_scroll(){
		if ( slidein_obj.length == 0 )
			return; // No slide in element exists
		var current_pos = $(window).scrollTop();
		var height = $(document).height()-$(window).height();
		var percentage = current_pos/height*100;
		for ( i = 0; i < slidein_obj.length; i++ ) {
			var obj = slidein_obj[i];
			var start = $(obj).data('slidein-start');
			var end = $(obj).data('slidein-end');
			var len = $(obj).data('slidein-for');
			var start_after = $(obj).data('slidein-after');
			var timeout = $(obj).data('slidein-timeout');
			
			var message_id = $(obj).data('slidein-id');
			
			var message_reopen_id = $(obj).data('slidein-reopen');
			
			if ( ! start )
				continue;
			var start_pos = 0;
			var end_pos = height;
			var start_at = 0;
			var end_at = 0;
			// Get start position
			if ( start.match(/^\d+%$/) )
				start_pos = Math.round( parseInt(start.replace(/%$/, ''), 10)/100*height );
			else if ( $(start).length > 0 )
				start_pos = $(start).offset().top-$(window).height();
			start_pos = ( start_pos < 0 ) ? 0 : start_pos;
			// Get end position
			if ( end ){
				if ( end.match(/^\d+%$/) )
					end_pos = Math.round( parseInt(end.replace(/%$/, ''), 10)/100*height );
				else if ( $(end).length > 0 )
					end_pos = $(end).offset().top+$(end).height();
			}
			else if ( len && len.match(/^\d+%$/) ){
				end_pos = Math.round( parseInt(len.replace(/%$/, ''), 10)/100*height + start_pos );
			}
			// Get start time
			if ( start_after ){
				if ( start_after.match(/^\d+s$/) )
					start_at = Math.round( parseInt(start_after.replace(/s$/, ''), 10) );
				else if ( start_after.match(/^\d+m$/) )
					start_at = Math.round( parseInt(start_after.replace(/m$/, ''), 10)*60 );
				else if ( start_after.match(/^\d+h$/) )
					start_at = Math.round( parseInt(start_after.replace(/h$/, ''), 10)*3600 );
			}
			// Get end time
			if ( timeout ){
				if ( timeout.match(/^\d+s$/) )
					end_at = Math.round( parseInt(timeout.replace(/s$/, ''), 10) );
				else if ( timeout.match(/^\d+m$/) )
					end_at = Math.round( parseInt(timeout.replace(/m$/, ''), 10)*60 );
				else if ( timeout.match(/^\d+h$/) )
					end_at = Math.round( parseInt(timeout.replace(/h$/, ''), 10)*3600 );
				end_at += start_at;
			}
			
			if (start_at > 0) { continue; }
			//console.log('current_pos: '+current_pos+', height: '+height+', start: '+start+', start_pos: '+start_pos+', for: '+len+', end: '+end+', end_pos:'+end_pos+', start_at: '+start_at+', end_at: '+end_at);
			if ( $(obj).hasClass('esi-slide-active') ) {
				// Check if the end position is reached
				if (
					(current_pos <= height /* <-- catch imbecile mac behavior */ && current_pos > end_pos)
					||
					(current_pos >= 0 /* <-- catch imbecile mac behavior */ && current_pos < start_pos)
				) {
					slidein_hide(obj);
					if (message_reopen_id != '') {
						//slidein_reopen_show(message_reopen_id);
					}
				}
			} else {
				// Check if it is on position to show
				if ( current_pos >= start_pos && current_pos <= end_pos ){
					if (start_at > 0) {
						if (timedSlideIn_obj_shown[message_id]) { continue; }
					}					
					
					slidein_show(obj, start_at);
					if (message_reopen_id != '') {
						//slidein_reopen_hide(message_reopen_id);
					}
					if ( end_at > start_at ) {
						slidein_hide(obj, end_at);
						if (message_reopen_id != '') {
							//slidein_reopen_show(message_reopen_id);
						}

					}
				}
			}
		}
	}
	
	function slidein_show_after_reopen($id) {
		for ( i = 0; i < slidein_obj.length; i++ ) {
			var obj = slidein_obj[i];
			var message_id = $(obj).data('slidein-id');
			
			if (message_id == $id) {
				slidein_reopen_message(obj);
			}
		}
	}
	
	function slidein_timed_object(){
		if ( slidein_obj.length == 0 )
			return; // No slide in element exists
		var current_pos = $(window).scrollTop();
		var height = $(document).height()-$(window).height();
		var percentage = current_pos/height*100;
		for ( i = 0; i < slidein_obj.length; i++ ) {
			var obj = slidein_obj[i];
			var start = $(obj).data('slidein-start');
			var end = $(obj).data('slidein-end');
			var len = $(obj).data('slidein-for');
			var start_after = $(obj).data('slidein-after');
			var timeout = $(obj).data('slidein-timeout');
			
			var message_id = $(obj).data('slidein-id');
			var message_reopen_id = $(obj).data('slidein-reopen');
			if ( ! start )
				continue;
			var start_pos = 0;
			var end_pos = height;
			var start_at = 0;
			var end_at = 0;
			// Get start position
			if ( start.match(/^\d+%$/) )
				start_pos = Math.round( parseInt(start.replace(/%$/, ''), 10)/100*height );
			else if ( $(start).length > 0 )
				start_pos = $(start).offset().top-$(window).height();
			start_pos = ( start_pos < 0 ) ? 0 : start_pos;
			// Get end position
			if ( end ){
				if ( end.match(/^\d+%$/) )
					end_pos = Math.round( parseInt(end.replace(/%$/, ''), 10)/100*height );
				else if ( $(end).length > 0 )
					end_pos = $(end).offset().top+$(end).height();
			}
			else if ( len && len.match(/^\d+%$/) ){
				end_pos = Math.round( parseInt(len.replace(/%$/, ''), 10)/100*height + start_pos );
			}
			// Get start time
			if ( start_after ){
				if ( start_after.match(/^\d+s$/) )
					start_at = Math.round( parseInt(start_after.replace(/s$/, ''), 10) );
				else if ( start_after.match(/^\d+m$/) )
					start_at = Math.round( parseInt(start_after.replace(/m$/, ''), 10)*60 );
				else if ( start_after.match(/^\d+h$/) )
					start_at = Math.round( parseInt(start_after.replace(/h$/, ''), 10)*3600 );
			}
			// Get end time
			if ( timeout ){
				if ( timeout.match(/^\d+s$/) )
					end_at = Math.round( parseInt(timeout.replace(/s$/, ''), 10) );
				else if ( timeout.match(/^\d+m$/) )
					end_at = Math.round( parseInt(timeout.replace(/m$/, ''), 10)*60 );
				else if ( timeout.match(/^\d+h$/) )
					end_at = Math.round( parseInt(timeout.replace(/h$/, ''), 10)*3600 );
				end_at += start_at;
			}
			
			if (start_at == 0) { continue; }
			
			//console.log('current_pos: '+current_pos+', height: '+height+', start: '+start+', start_pos: '+start_pos+', for: '+len+', end: '+end+', end_pos:'+end_pos+', start_at: '+start_at+', end_at: '+end_at);
			if ( $(obj).hasClass('esi-slide-active') ) {
				// Check if the end position is reached
				if (
					(current_pos <= height /* <-- catch imbecile mac behavior */ && current_pos > end_pos)
					||
					(current_pos >= 0 /* <-- catch imbecile mac behavior */ && current_pos < start_pos)
				)
					{
					slidein_hide(obj);
					if (message_reopen_id != '') {
						//slidein_reopen_show(message_reopen_id);
					}

					}
			} else {
				// Check if it is on position to show
				if ( current_pos >= start_pos && current_pos <= end_pos ){
					if (start_at > 0) {
						if (timedSlideIn_obj_shown[message_id]) { continue; }
					}					
					
					slidein_show(obj, start_at);
					if (message_reopen_id != '') {
						//slidein_reopen_hide(message_reopen_id);
					}

					if ( end_at > start_at ) {
						slidein_hide(obj, end_at);
						if (message_reopen_id != '') {
							//slidein_reopen_show(message_reopen_id);
						}

					}
				}
			}
		}
	}
	
	function slidein_reopen_message(obj, timeout) {
		var $obj = $(obj);
		if ( ! timeout )
			timeout = 0;
		clearTimeout($(obj).data('slidein-temp-time-show'));
		$obj.data('slidein-closed', '');
		$obj.data('slidein-after', '');
		$obj.data('slidein-start', '0%');
		$obj.data( 'slidein-temp-time-show', setTimeout(function(){
			if ( legacy && $obj.data('slidein-running') != '1' ){
				$obj.data('slidein-running', '1');
				$obj.css('visibility', 'visible');
				if ( $obj.hasClass('esi-slide-top') || $obj.hasClass('esi-slide-top_right') || $obj.hasClass('esi-slide-top_left') )
					$obj.stop(true).animate({top: 0}, 1000, legacy_show_after);
				else if ( $obj.hasClass('esi-slide-left'))
					$obj.stop(true).animate({left: 0}, 1000, legacy_show_after);
				else if ( $obj.hasClass('esi-slide-right')   )
					$obj.stop(true).animate({right: 0}, 1000, legacy_show_after);
				else if ( $obj.hasClass('esi-slide-bottom') || $obj.hasClass('esi-slide-bottom_left'))
					$obj.stop(true).animate({bottom: 0}, 1000, legacy_show_after);
				else if ( $obj.hasClass('esi-slide-bottom_right')) {
					$obj.stop(true).animate({bottom: 0}, 1000, legacy_show_after);
				}
				else if ($obj.hasClass('esi-slide-center')) {
					$obj.fadeIn("slow");
				}
				
			}
			else {
				$obj.addClass('esi-slide-active');
			}
			
			var message_id = $obj.data('slidein-id');
			var start_after = $obj.data('slidein-after');
			var start_at = 0;
			if ( start_after ){
				if ( start_after.match(/^\d+s$/) )
					start_at = Math.round( parseInt(start_after.replace(/s$/, ''), 10) );
				else if ( start_after.match(/^\d+m$/) )
					start_at = Math.round( parseInt(start_after.replace(/m$/, ''), 10)*60 );
				else if ( start_after.match(/^\d+h$/) )
					start_at = Math.round( parseInt(start_after.replace(/h$/, ''), 10)*3600 );
			}
			if (start_at > 0) {
				timedSlideIn_obj_shown[message_id] = message_id;
			}

		}, timeout*1000) );		
	}


	function slidein_hide(obj, timeout, closed) {
		var $obj = $(obj);
		if ( ! timeout ) timeout = 0;
		if ( closed ) {
			$obj.data('slidein-closed', '1');
		}
				
		clearTimeout($obj.data('slidein-temp-time-hide'));
		$obj.data( 'slidein-temp-time-hide', setTimeout(function(){
			if ( legacy && $obj.data('slidein-running') != '2' ){
				$obj.data('slidein-running', '2');
				$obj.removeClass('esi-slide-active');
				if ( $obj.hasClass('esi-slide-top') || $obj.hasClass('esi-slide-top_right') || $obj.hasClass('esi-slide-top_left') )
					$obj.stop(true).animate({top: $obj.data('slidein-pos')}, 1000, legacy_hide_after);
				else if ( $obj.hasClass('esi-slide-left') )
					$obj.stop(true).animate({left: $obj.data('slidein-pos')}, 1000, legacy_hide_after);
				else if ( $obj.hasClass('esi-slide-right') )
					$obj.stop(true).animate({right: $obj.data('slidein-pos')}, 1000, legacy_hide_after);
				else if ( $obj.hasClass('esi-slide-bottom') || $obj.hasClass('esi-slide-bottom_right') || $obj.hasClass('esi-slide-bottom_left'))
					$obj.stop(true).animate({bottom: $obj.data('slidein-pos')}, 1000, legacy_hide_after);
			}
			else {
				$obj.removeClass('esi-slide-active');
			}
		}, timeout*1000) );
	}

	function slidein_show(obj, timeout) {
		var $obj = $(obj);
		if ( $obj.data('slidein-closed') == '1' )
			return;
		if ( ! timeout )
			timeout = 0;
		clearTimeout($(obj).data('slidein-temp-time-show'));
		$obj.data( 'slidein-temp-time-show', setTimeout(function(){
			if ( legacy && $obj.data('slidein-running') != '1' ){
				$obj.data('slidein-running', '1');
				$obj.css('visibility', 'visible');
				if ( $obj.hasClass('esi-slide-top') || $obj.hasClass('esi-slide-top_right') || $obj.hasClass('esi-slide-top_left') )
					$obj.stop(true).animate({top: 0}, 1000, legacy_show_after);
				else if ( $obj.hasClass('esi-slide-left'))
					$obj.stop(true).animate({left: 0}, 1000, legacy_show_after);
				else if ( $obj.hasClass('esi-slide-right')   )
					$obj.stop(true).animate({right: 0}, 1000, legacy_show_after);
				else if ( $obj.hasClass('esi-slide-bottom') || $obj.hasClass('esi-slide-bottom_left'))
					$obj.stop(true).animate({bottom: 0}, 1000, legacy_show_after);
				else if ( $obj.hasClass('esi-slide-bottom_right')) {
					$obj.stop(true).animate({bottom: 0}, 1000, legacy_show_after);
				}
				else if ($obj.hasClass('esi-slide-center')) {
					$obj.fadeIn("slow");
				}
				
			}
			else {
				$obj.addClass('esi-slide-active');
			}
			
			var message_id = $obj.data('slidein-id');
			var start_after = $obj.data('slidein-after');
			var start_at = 0;
			if ( start_after ){
				if ( start_after.match(/^\d+s$/) )
					start_at = Math.round( parseInt(start_after.replace(/s$/, ''), 10) );
				else if ( start_after.match(/^\d+m$/) )
					start_at = Math.round( parseInt(start_after.replace(/m$/, ''), 10)*60 );
				else if ( start_after.match(/^\d+h$/) )
					start_at = Math.round( parseInt(start_after.replace(/h$/, ''), 10)*3600 );
			}
			if (start_at > 0) {
				timedSlideIn_obj_shown[message_id] = message_id;
			}

		}, timeout*1000) );
	}
	
	function slidein_reopen_show($id) {
		
		for ( i = 0; i < slidein_reopen.length; i++ ) {
			var obj = slidein_reopen[i];
			var id = $(obj).data('id');

			if (id == $id) {
				$(obj).addClass('esi-slide-reopen-active');
			}
		}
	}
	
	function slidein_reopen_hide($id) {
		for ( i = 0; i < slidein_reopen.length; i++ ) {
			var obj = slidein_reopen[i];
			var id = $(obj).data('id');

			if (id == $id) {
				$(obj).removeClass('esi-slide-reopen-active');
			}
		}
	}

	function legacy_hide_after() {
		$(this).css('visibility', 'hidden');
		$(this).data('slidein-running', '0');
	}

	function legacy_show_after() {
		$(this).addClass('esi-slide-active');
		$(this).data('slidein-running', '0');
	}

	// if width defined in pixels on front-end, reset it when widnow width < slider and rely on 100%
	function responsify( obj ) {
		var $wrap = obj.find('.esi-slide-wrap');
		if ( $wrap.length && $wrap.attr('style') && $wrap.attr('style').indexOf('width') >= 0 ) {
			var slidewidth = parseInt( $wrap.attr('style').replace(/\D/g,''), 10 ),
				winwidth = $(window).width()
			;

			if ( winwidth <= slidewidth ) {
				$wrap.removeAttr('style');
			}
			$(window).resize(function() {
				if ( $(window).width() <= slidewidth ) {
					$wrap.removeAttr('style');
				} else if (!$wrap.attr('style')) {
					$wrap.width( slidewidth );
				}
			});
		}
	}
	

	$(window).load(function(){
		// Initiate
		$('.esi-slide').each(function(){
			var $me = $(this);
			$me.css("display", '');
			if ( $me.is('.esi-slide-top, .esi-slide-bottom, .esi-slide-bottom_right, .esi-slide-bottom_left, .esi-slide-top_right, .esi-slide-top_left,  .esi-slide-center') ) {
				calculate_vertical_side(this);
			}
			if ( $me.is('.esi-slide-right, .esi-slide-left, .esi-slide-center') ) {
				calculate_horizontal_side(this);
			}
			if ( $me.is('.esi-slide-center') ) {
				calculate_center_side(this);
			}
			$me.data('slidein-running', '0');
			slidein_obj.push(this);
			responsify( $me );
		});

		$('.esi-slide-reopen').each(function(){
			var $me = $(this);
			$me.css("display", '');
			if ( $me.is('.esi-slide-top, .esi-slide-bottom, .esi-slide-bottom_right, .esi-slide-bottom_left, .esi-slide-top_right, .esi-slide-top_left,  .esi-slide-center') ) {
				calculate_vertical_side(this);
			}
			if ( $me.is('.esi-slide-right, .esi-slide-left, .esi-slide-center') ) {
				calculate_horizontal_side(this);
			}
			if ( $me.is('.esi-slide-center') ) {
				calculate_center_side(this);
			}
			
			slidein_reopen.push(this);
			
			$me.on('click', function(e) {
				var obj = $(this);
				var id = obj.data('id');
				
				slidein_reopen_hide(id);
				slidein_show_after_reopen(id);
			});
			
			if ($me.is('.esi-slide-reopen-active-load')) {
				$me.addClass('esi-slide-reopen-active');
			}
		});
		
		//var is_timed = $("#esi-slide_in").length
		//	? !!parseInt($("#esi-slide_in").attr("data-slidein-after"), 10)
		//	: false
		//;
		var is_timed = false;
		if ( ! css_support('transition') )
			legacy = true;
		if (!is_timed) $(window).scroll(slidein_scroll);
		// Call the slidein_scroll first here, so we don't need to wait for scroll event before it show the slide in :))
		slidein_scroll();
		slidein_timed_object();
	});

	$('.esi-slide').on('click', '.esi-slide-close a', function(e){
		e.preventDefault();
		var obj = $(this).closest('.esi-slide');
		slidein_hide(obj, 0, true);
		var message_reopen_id = $(obj).data('slidein-reopen');
		if (message_reopen_id != '') {
			slidein_reopen_show(message_reopen_id);
		}

		register_seen_uri();
	});

	$('.esi-slide').on('click', '.easy-slide-close', function(e){
		e.preventDefault();
		var obj = $(this).closest('.esi-slide');
		slidein_hide(obj, 0, true);
		var message_reopen_id = $(obj).data('slidein-reopen');
		if (message_reopen_id != '') {
			slidein_reopen_show(message_reopen_id);
		}

		register_seen_uri();
	});
});
})(jQuery);

