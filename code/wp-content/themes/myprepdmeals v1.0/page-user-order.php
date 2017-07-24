<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
$postid = get_the_ID();
if(in_array($postid,array(6,7))){
	get_header('plans');
} else {
	get_header();
}

 ?>

<?php acf_form_head(); ?>
<?php get_header(); ?>

<div id="primary" class="content-area content-all-page">

	<div class="container">
	<div class="row">
	<div class="col-sm-12">
	<main id="main" class="site-main" role="main">

	<?php
    $current_user = wp_get_current_user();
    /**
     * @example Safe usage: $current_user = wp_get_current_user();
     * if ( !($current_user instanceof WP_User) )
     *     return;
     */
    echo 'Username: ' . $current_user->user_login . '<br />';
    echo 'User email: ' . $current_user->user_email . '<br />';
    echo 'User first name: ' . $current_user->user_firstname . '<br />';
    echo 'User last name: ' . $current_user->user_lastname . '<br />';
    echo 'User display name: ' . $current_user->display_name . '<br />';
    echo 'User ID: ' . $current_user->ID . '<br />';

    echo do_shortcode('[ninja_form id=13]');

    $key = 'pet_name';
    $pet_name = get_user_meta( $current_user->ID, $key, $single );

    echo $pet_name;


	?>




	</main><!-- .site-main -->

	</div>
	</div>
	</div>

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
