<div id="esi-slide_in" style="display: none;"
	class="esi-slide <?php echo $full_width; ?> <?php echo $full_height; ?> esi-slide-<?php echo $position; ?> esi-slide-<?php echo $theme; ?> esi-slide-id-<?php echo $message->ID; ?>"
	data-slidein-start="<?php echo $selector ? $selector : $percentage; ?>"
	data-slidein-end="100%" data-slidein-after="<?php echo $timeout; ?>"
	data-slidein-timeout="<?php echo $expire_timeout; ?>"
	data-slidein-id="<?php echo $message->ID; ?>"
	data-slidein-reopen="<?php echo ($close_active == "yes" ? $message->ID : ''); ?>">

	<div class="esi-slide-wrap esi-slide-wrap-<?php echo $message->ID; ?>" <?php echo $width; ?>>
	
		<?php if ($closehide != 'yes') { include dirname(__FILE__) . '/box_output-services.php'; } ?>
	<div class="esi-slide-content">			
			<?php
			if ('related' == $content_type) {
				include dirname ( __FILE__ ) . '/box_output-content-related.php';
			} else if ('mailchimp' == $content_type) {
				include dirname ( __FILE__ ) . '/box_output-content-mailchimp.php';
			} else if ('widgets' == $content_type) {
				include dirname ( __FILE__ ) . '/box_output-content-widgets.php';
			} 
			else if ('optin' == $content_type) {				
				echo do_shortcode('[esi-optinform style="'.$optin_id.'"]');
			}
			else {
				echo apply_filters ( 'esi_content', $message->post_content );
			}
			?>
		</div>
	</div>
</div>