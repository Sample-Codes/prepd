<?php
if (is_active_sidebar('easy-slide-in-'.$sidebar_id)) {
	echo '<div class="esi-slide-widget">';
	dynamic_sidebar('easy-slide-in-'.$sidebar_id);
	echo '</div>';
} else {
	$content = apply_filters('esi-sidebar-empty_sidebar_text', __('Please, add some widgets to your sidebar.', 'esi'));
	if ($content) echo $content;
}