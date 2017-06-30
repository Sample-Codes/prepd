<?php
//$close_text, //$close_icon

$margin_class = ($close_text != '' && $close_icon != '') ? " esi-slide-reopen-fa-space" : "";

$avaliable_on_load = ($open_active == "yes") ? "esi-slide-reopen-active-load" : "";

?>

<div class="esi-slide-reopen esi-slide-reopen-<?php echo $message->ID; ?> esi-slide-<?php echo $position; ?> <?php echo $avaliable_on_load; ?>" data-id="<?php echo $message->ID; ?>">
	<div class="esi-slide-reopen-message">
	<?php 
	
	if ($close_icon != '') {
		echo '<div class="esi-slide-reopen-fa'.$margin_class.'"><i class="fa fa-lg '.$close_icon.'"></i></div>';
	}
	
	?>
	<div class="esi-slide-reopen-text"><?php echo $close_text; ?></div>
	</div>
</div>