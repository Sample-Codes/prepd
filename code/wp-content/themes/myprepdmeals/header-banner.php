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
  <link rel="shortcut icon" href="https://www.myprepdmeals.com/favicon.ico" type="image/x-icon" />
  <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php endif; ?>

  <!-- js files -->
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate.js"></script>

  <!-- css files -->
  <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootsnav.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/custom.css">
  <link href="<?php echo get_template_directory_uri(); ?>/owl.carousel/owl.carousel.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/owl.carousel/owl.theme.default.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <?php wp_head(); ?>
</head>

<body <?php body_class('sub-banner-pages'); ?>>
 <!-- ======================= Nav Section ===================== -->
    <nav class="navbar navbar-default navbar-fixed white no-background bootsnav">

      <div class="container">        
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

    <!-- ============= Slider Section ============= -->
    <?php
      $banner_url=$banner_page_id=$banner_custom_template= "";
      $banner_page_id =  get_the_ID();
      $banner_custom_template = get_page_template_slug(get_the_ID());
      $upload_image = get_field('upload_banner_image');

      if($upload_image) {
        $banner_url = $upload_image;
      } else {

      if($banner_page_id == 40){
        $banner_url     =  get_template_directory_uri().'/images/meat-our-team.jpg';
      }else if($banner_page_id == 48){
        $banner_url     =  get_template_directory_uri().'/images/blog.jpg';
      }else if($banner_page_id == 54){
        $banner_url     =  get_template_directory_uri().'/images/contact-us.jpg';
      }else if($banner_page_id == 355){
        $banner_url     =  get_template_directory_uri().'/images/contact-us.jpg';
      }else if($banner_page_id == 362){
        $banner_url     =  get_template_directory_uri().'/images/contact-us.jpg';
      }else if($banner_page_id == 359){
        $banner_url     =  get_template_directory_uri().'/images/contact-us.jpg';
      }else if($banner_page_id == 38){
        $banner_url     =  get_template_directory_uri().'/images/core-values.jpg';
      }else if($banner_page_id == 119){
        $banner_url     =  get_template_directory_uri().'/images/faq.jpg';
      }else if($banner_page_id == 52){
        $banner_url     =  get_template_directory_uri().'/images/home-delivery-info.jpg';
      }else if($banner_page_id == 11){
        $banner_url     =  get_template_directory_uri().'/images/how-it-works.jpg';
      }else if($banner_page_id == 26){
        $banner_url     =  get_template_directory_uri().'/images/nutrition-philosophy.jpg';
      }else if($banner_page_id == 22){
        $banner_url     =  get_template_directory_uri().'/images/our-food.jpg';
      }else if($banner_page_id == 280){
        $banner_url     =  get_template_directory_uri().'/images/our-full-menu.jpg';
      }else if($banner_page_id == 9869){
        $banner_url     =  get_template_directory_uri().'/images/pricing.jpg';
      }else if($banner_page_id == 3983){
        $banner_url     =  get_template_directory_uri().'/images/pricing.jpg';
      }else if($banner_page_id == 366){
        $banner_url     =  get_template_directory_uri().'/images/pricing.jpg';
      }else if($banner_page_id == 44){
        $banner_url     =  get_template_directory_uri().'/images/testimonials.jpg';
      }else if($banner_page_id == 35){
        $banner_url     =  get_template_directory_uri().'/images/why-us.jpg';
      }else if($banner_page_id == 1220){
        $banner_url     =  get_template_directory_uri().'/images/weekly-menu.jpg';
      }else if (is_singular('post')) {
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if (is_singular('meal')) {
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if (is_singular('snack')) {
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if($banner_custom_template == 'custom-templates/new-weekly-menu.php'){
        $banner_url     =  get_template_directory_uri().'/images/weekly-menu-2.jpg';
      }else if($banner_page_id == 1130){
        $banner_url     =  get_template_directory_uri().'/images/how-it-works.jpg';
      }else if($banner_page_id == 1948){
        $banner_url     =  get_template_directory_uri().'/images/manhattan-beach.jpg';
      }else if($banner_page_id == 1985){
        $banner_url     =  get_template_directory_uri().'/images/hermosa-beach-volleyball.jpg';
      }else if($banner_page_id == 1965){
        $banner_url     =  get_template_directory_uri().'/images/Redondo-Beach.jpg';
      }else if($banner_page_id == 1971){
        $banner_url     =  get_template_directory_uri().'/images/torrance.jpg';
      }else if($banner_page_id == 1990){
        $banner_url     =  get_template_directory_uri().'/images/el-segundo-lifeguard-tower.jpg';
      }else if($banner_page_id == 1994){
        $banner_url     =  get_template_directory_uri().'/images/torrance.jpg';
      }else if($banner_page_id == 1978){
        $banner_url     =  get_template_directory_uri().'/images/torrance.jpg';
      }else if($banner_page_id == 664){
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if($banner_page_id == 661){
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if($banner_page_id == 656){
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if($banner_page_id == 6083){
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if($banner_page_id == 10319){
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if($banner_page_id == 10322){
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if($banner_page_id == 10327){
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if($banner_page_id == 963){
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      } else if ($banner_page_id == 10980) {
	     $banner_url     =  get_template_directory_uri().'/images/testimonials.jpg';
	   } else {
      $banner_url     =  get_template_directory_uri().'/images/testimonials.jpg';
     }
}

      

    ?>
    <div style="background-size: cover; padding: 190px 0px 80px;position: relative;text-align: center;line-height: 1;background-image: url(<?php echo $banner_url; ?>);background-repeat: repeat;background-position: center;">
    <h1 class="text-title-1"><?php the_title(); ?></h1>
    </div>

