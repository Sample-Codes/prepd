<?php
$current_tab = (empty ( $_GET ['tab'] )) ? 'esiopts' : sanitize_text_field ( urldecode ( $_GET ['tab'] ) );

//$tabs = array ('main' => __ ( 'Settings', 'esi' ), 'esiopts' => 'New Settings' );
$tabs = array ('esiopts' => 'New Settings' );

?>
<div class="wrap">
<?php if (count($tabs) > 1) { ?>

<div class="icon32">
	</div>
	<h2 class="nav-tab-wrapper">
<?php

foreach ( $tabs as $name => $label ) {
	echo '<a href="' . admin_url ( 'edit.php?post_type=easy_slide_in&page=esi&tab=' . $name ) . '" class="nav-tab ';
	if ($current_tab == $name)
		echo 'nav-tab-active';
	echo '">' . $label . '</a>';
}
?>
</h2>

<?php
}
?>

<div class="esi-settings-form">
<?php

switch ($current_tab) :
	case "main" :
		include (ESI_PLUGIN_BASE_DIR . '/lib/forms/plugin_settings_main.php');
		
		break;
		case "esiopts" :
			include (ESI_PLUGIN_BASE_DIR . '/lib/forms/plugin_settings_new.php');
		
			break;		
endswitch
;

?>
</div>
</div>