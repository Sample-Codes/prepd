<?php
/**
 * Template Name: Meal Plan Order Form
 *
 */
get_header('banner'); ?>
<div id="primary" class="content-area content-all-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<main id="main" class="site-main" role="main">
					<?php 
					    $meal_plan_order_form_page_id = 340;//This is page id or post id
					    $content_post    = get_post($meal_plan_order_form_page_id);
					    $content         = $content_post->post_content;
					    $content         = apply_filters('the_content', $content);
					    $content         = str_replace(']]>', ']]&gt;', $content);
					    echo $content;
					?>
				</main>
			</div>
		</div>
	</div>
</div>
<?php get_footer('banner'); ?>