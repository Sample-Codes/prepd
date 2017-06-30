<?php
	global $wp;
	$url = (is_home() || is_front_page()) ? site_url() : get_permalink();
	$url = apply_filters('esi-url-current_url', ($url ? $url : site_url($wp->request))); // Fix for empty URLs
?>
<div class="esi-slide-control esi-slide-control-<?php echo $message->ID; ?>">
	<!-- div class="esi-slide-share esi-clearfix"></div> -->
	<div class="esi-slide-close"><a href="#"></a></div>
</div>