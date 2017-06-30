<?php
/**
 * A template for calling the left sidebar on everypage
 */
 
	global $gdlr_sidebar;
?>

<?php if( $gdlr_sidebar['type'] == 'left-sidebar' || $gdlr_sidebar['type'] == 'both-sidebar' ){ ?>
<div class="gdlr-sidebar gdlr-left-sidebar <?php echo esc_attr($gdlr_sidebar['left']); ?> columns">
	<div class="gdlr-item-start-content sidebar-left-item" >
	<?php 
		$sidebar_id = gdlr_get_sidebar_id($gdlr_sidebar['left-sidebar']);
		if( is_active_sidebar($sidebar_id) ){ 
			dynamic_sidebar($sidebar_id); 
		}
	?>
	</div>
</div>
<?php } ?>