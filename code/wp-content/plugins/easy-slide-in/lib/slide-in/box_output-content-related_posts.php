<?php
$post_id = is_singular() ? get_the_ID() : false;
$posts = esi_get_related_posts($post_id, $related_taxonomy, $related_posts_count);	 	 		      			 	 	 
$show = apply_filters('esi-services-related_posts', !empty($posts), $post_id);
if ($show) {
	$out = '';
	foreach ($posts as $related) {
		$image = $related_has_thumbnails
			? esi_get_related_post_thumbnail($related->ID)
			: false
		;
		$out .= '<div class="esi-slide-col ' . ($related_has_thumbnails ? 'esi-slide-col-thumb' : '') . ($is_vertical ? ' esi-slide-col-vert' : ''). '">' .
			($related_has_thumbnails ? '<img class="esi-slide-thumb" src="' . $image . '" />' : '') .
			'<h2><a href="' . get_permalink($related->ID) . '">' . $related->post_title . '</a></h2>' .
			'<p>' . esi_get_related_post_excerpt($related) . '</p>' .
		'</div>';
	}
	echo '<div class="esi-slide-columns">' . $out . '</div>';
}