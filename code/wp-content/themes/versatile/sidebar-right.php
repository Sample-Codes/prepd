<?php
/**
 * A template for calling the right sidebar in everypage
 */
 
	global $gdlr_sidebar;
?>

<?php if( $gdlr_sidebar['type'] == 'right-sidebar' || $gdlr_sidebar['type'] == 'both-sidebar' ){ ?>
<div class="gdlr-sidebar gdlr-right-sidebar <?php echo esc_attr($gdlr_sidebar['right']); ?> columns">
	<div class="gdlr-item-start-content sidebar-right-item" >
	<?php 
		$sidebar_id = gdlr_get_sidebar_id($gdlr_sidebar['right-sidebar']);
		if( is_active_sidebar($sidebar_id) ){ 
			dynamic_sidebar($sidebar_id); 
		}
	?>
	</div>
</div>
<?php } ?>