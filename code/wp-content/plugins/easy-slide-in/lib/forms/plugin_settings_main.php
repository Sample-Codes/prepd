<div class="wrap">
	<form action="" method="post" class="esiui-ui">
		<div class="esi-options">
			<div class="esi-options-header" id="esi-options-header">
				<div class="esi-options-title">
					<?php _e('Easy Slind-In Settings', 'esi'); ?><br /> <span class="label"
						style="font-weight: 400;"><a
						href="http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476?ref=appscreo"
						target="_blank" style="text-decoration: none;">Easy Slide-In for WordPress version <?php echo ESI_VERSION; ?></a></span>
				</div>
				<button name="Submit" type="submit" class="button-primary"><?php esc_attr_e('Save Changes'); ?></button>

			</div>
			<div class="esi-options-container" style="min-height: 450px;">

		<?php settings_fields('esi_options_page'); ?>
		<?php do_settings_sections('esi_options_page'); ?>
</div>
		</div>

	</form>
</div>

<script type="text/javascript">


jQuery(document).ready(function($){
    $('#esi-bgcolor').wpColorPicker();
    $('#esi-textcolor').wpColorPicker();
    $('#esi-accentcolor').wpColorPicker();
    
});

</script>