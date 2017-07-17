<?php

get_header('banner');

$intro_content = get_the_content();

echo '<div id="primary" class="content-area content-all-page">';
echo '<main id="main" class="site-main" role="main">';

echo '<div class="container">';
echo $intro_content;

	if( have_rows('testimonials') ):

		echo '<div class="row">';
		
			while( have_rows('testimonials') ): the_row();

				// vars
				$test_name = get_sub_field('testimonial_name');
				$testimonial = get_sub_field('testimonial');

				echo '<div class="test-container col-sm-6">';
				echo '<div class="testimonial-sec">';
				echo '<p>"' . $testimonial . '"</p>';
				echo '</div>';
				echo '<div class="clearfix"></div>';
				echo '<p class="testimonial-name"><i class="fa fa-leaf" aria-hidden="true"></i>' . $test_name . '</p>';
				echo '</div>';
			
			endwhile;	
	
		echo '</div>';

	endif;

echo '</div>'; // container

echo '</main>'; // main
echo '</div>'; // primary

get_footer('plans'); ?>