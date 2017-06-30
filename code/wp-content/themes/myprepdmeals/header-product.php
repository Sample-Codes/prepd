<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<!-- js files -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>

  <link rel="shortcut icon" href="https://www.myprepdmeals.com/favicon.ico" type="image/x-icon" />

  <!-- css files -->
  <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootsnav.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/custom.css">
    
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
 <!-- ======================= Nav Section ===================== -->

   <nav class="navbar navbar-default navbar-fixed white no-full bootsnav">


      <div class="container">        
          <!-- Start Header Navigation -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                  <i class="fa fa-bars"></i>
              </button>

              <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/logo-small.png" class="logo logo-scrolled" alt="" style="display: block;">
              </a>
          </div>
          <!-- End Header Navigation -->

          <!-- Start Header Navigation -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                  <i class="fa fa-bars"></i>
              </button>
              <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" class="logo logo-display" alt="">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/logo-small.png" class="logo logo-scrolled" alt="">
              </a>
          </div>
          <!-- End Header Navigation -->

          <?php
          if(function_exists('wp_nav_menu')) {
           wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class' => 'nav navbar-nav navbar-right',
            'container' => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'navbar-menu',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker()
           )); 
          }
         ?>
      </div>  
    </nav>
    <!-- End Navigation -->