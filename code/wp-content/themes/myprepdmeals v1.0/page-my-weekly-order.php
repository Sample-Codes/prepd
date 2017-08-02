<?php
/**
 * The template for My Weekly Order page
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
$postid = get_the_ID();

get_header();

?>

<div id="primary" class="content-area content-all-page">

	<div class="container">
	<div class="row">
	<div class="col-sm-12">
	<main id="main" class="site-main" role="main">
		<?php
		
		// Start the loop.
		while ( have_posts() ) : the_post();

		// woocommerce account menu

		$checkout_meals = get_field('checkout_meals', 'option');
		$current_week = get_field('current_week', 'option');

   		echo '<h3>Your Order For ' . $current_week . '</h3>';
   		echo '<div class="meals-order-table col-md-6">';
   		echo '<h4>Meals</h4>';
    
	    if( $checkout_meals ) :
	    echo '<table class="order-confirmation">';
			foreach( $checkout_meals as $checkout_meal ):

		        $meal_id = $checkout_meal->ID;
		    	$meals_id = $checkout_meal->ID;
		        $meal_title = $checkout_meal->post_title;
		        $meal_label = $checkout_meal->post_name;

		        $user_id = get_current_user_id();
		  		$key = $meal_label;
		  		$single = true;
		  		$user_order = get_user_meta( $user_id, $key, $single );
		  		$order_num = (int)$user_order;
		  		
		  		if( $order_num > 0 ) {
		  			echo '<tr>';
		  			echo '<td>' . $meal_title . '</td>';
		  			echo '<td>' . $order_num . '</td>';
		  			echo '</tr>';
		  		}

       		endforeach;
        
        echo '</table>';
        echo '<p class="edit-order-btn"><a href="http://localhost/prep/code/testing/">Edit Meals</a></p>';
        $user_id = get_current_user_id();
        $date_submitted = get_user_meta( $user_id, 'date_submitted', true );
        echo $date_submitted;

        endif;

        echo '</div>';

        // snacks
        $checkout_snacks = get_field('checkout_snacks', 'option');

   		echo '<div class="meals-order-table col-md-6">';
   		echo '<h4>Snacks</h4>';
    
	    if( $checkout_snacks ) :
	    echo '<table class="order-confirmation">';
			foreach( $checkout_snacks as $checkout_snack ):

		        $snack_id = $checkout_snack->ID;
		    	$snacks_id = $checkout_snack->ID;
		        $snack_title = $checkout_snack->post_title;
		        $snack_label = $checkout_snack->post_name;

		        $user_id = get_current_user_id();
		  		$key = $snack_label;
		  		$single = true;
		  		$user_order = get_user_meta( $user_id, $key, $single );
		  		$order_num = (int)$user_order;
		  		
		  		if( $order_num > 0 ) {
		  			echo '<tr>';
		  			echo '<td>' . $snack_title . '</td>';
		  			echo '<td>' . $order_num . '</td>';
		  			echo '</tr>';
		  		}

       		endforeach;
        
        echo '</table>';
        echo '<p class="edit-order-btn"><a href="http://localhost/prep/code/testing/#order-snacks">Edit Snacks</a></p>';
        endif;
        echo '</div>';

		// End of the loop.
		endwhile;


		?>

	</main><!-- .site-main -->

	</div>
	</div>
	</div>

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>