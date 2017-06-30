<?php
/**
 * Template Name: New Weekly Menu
 *
 */
//get_header(''); 

$current_page_id=$weekly_meal_titles=$weekly_snack_titles=$weekly_meal_images=$weekly_snack_images= "";
$current_page_id = get_the_ID();
$weekly_meals_titles = get_post_meta($current_page_id,'wpcf-weekly-meal',false);
$weekly_meal_images  = get_post_meta($current_page_id,'wpcf-meal-image',false);
$weekly_snack_titles = get_post_meta($current_page_id,'wpcf-new-weekly-snack',false);
$weekly_snack_images = get_post_meta($current_page_id,'wpcf-snack-image',false);  

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="shortcut icon" href="http://myprepdmeals.dev/wp-content/uploads/2016/09/fav.png" type="image/x-icon" />
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

    <!-- ============= Banner Section ============= -->
    <!-- ============= Slider Section ============= -->
    <?php
      $banner_url=$banner_page_id=$banner_custom_template= "";
      $banner_page_id =  get_the_ID();
      $banner_custom_template = get_page_template_slug(get_the_ID());

      if($banner_page_id == 113){
        $banner_url     =  get_template_directory_uri().'/images/meat-our-team.jpg';
      }else if($banner_page_id == 120){
        $banner_url     =  get_template_directory_uri().'/images/blog.jpg';
      }else if($banner_page_id == 88){
        $banner_url     =  get_template_directory_uri().'/images/contact-us.jpg';
      }else if($banner_page_id == 355){
        $banner_url     =  get_template_directory_uri().'/images/contact-us.jpg';
      }else if($banner_page_id == 362){
        $banner_url     =  get_template_directory_uri().'/images/contact-us.jpg';
      }else if($banner_page_id == 359){
        $banner_url     =  get_template_directory_uri().'/images/contact-us.jpg';
      }else if($banner_page_id == 86){
        $banner_url     =  get_template_directory_uri().'/images/core-values.jpg';
      }else if($banner_page_id == 119){
        $banner_url     =  get_template_directory_uri().'/images/faq.jpg';
      }else if($banner_page_id == 123){
        $banner_url     =  get_template_directory_uri().'/images/home-delivery-info.jpg';
      }else if($banner_page_id == 82){
        $banner_url     =  get_template_directory_uri().'/images/how-it-works.jpg';
      }else if($banner_page_id == 109){
        $banner_url     =  get_template_directory_uri().'/images/nutrition-philosophy.jpg';
      }else if($banner_page_id == 93){
        $banner_url     =  get_template_directory_uri().'/images/our-food.jpg';
      }else if($banner_page_id == 108){
        $banner_url     =  get_template_directory_uri().'/images/our-full-menu.jpg';
      }else if($banner_page_id == 16){
        $banner_url     =  get_template_directory_uri().'/images/pricing.jpg';
      }else if($banner_page_id == 92){
        $banner_url     =  get_template_directory_uri().'/images/pricing.jpg';
      }else if($banner_page_id == 366){
        $banner_url     =  get_template_directory_uri().'/images/pricing.jpg';
      }else if($banner_page_id == 114){
        $banner_url     =  get_template_directory_uri().'/images/testimonials.jpg';
      }else if($banner_page_id == 84){
        $banner_url     =  get_template_directory_uri().'/images/why-us.jpg';
      }else if($banner_page_id == 107){
        $banner_url     =  get_template_directory_uri().'/images/weekly-menu.jpg';
      }else if (is_singular('post')) {
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if (is_singular('meal')) {
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if (is_singular('snack')) {
        $banner_url     =  get_template_directory_uri().'/images/blog-2.jpg';
      }else if($banner_custom_template == 'custom-templates/new-weekly-menu.php'){
        $banner_url     =  get_template_directory_uri().'/images/weekly-menu-2.jpg';
      }else if($banner_page_id == 340){
        $banner_url     =  get_template_directory_uri().'/images/how-it-works.jpg';
      }
    ?>
    <div style="padding: 190px 0px 80px;position: relative;text-align: center;line-height: 1;background-image: url(<?php echo $banner_url; ?>);background-repeat: repeat;background-position: center;">
    <h1 class="text-title-1"><?php the_title(); ?></h1>
    </div>

    <!-- =============== How it Work image section =============== -->
    <div class="full-menu-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="row leaf-column">
              <div class="col-sm-6">
                <div class="square-box">
                  <div class="circle-leaf"><i class="fa fa-cutlery" aria-hidden="true"></i></div>
                  <div class="week-sch-menu">
                  <h4>This Week's Meals</h4>

                  <div class="row">
                  <?php 
                  if(!empty($weekly_meals_titles)){ ?>
                    <div class="col-sm-6">
                      <ul class="mn-list">
                      <?php 
                      $meal_cnt = 0;
                      $half_meals_count = round(count($weekly_meals_titles)/2);
                      foreach ($weekly_meals_titles as $weekly_meals_title) {
                        echo '<li>'.$weekly_meals_title.'</li>';
                        if($meal_cnt == $half_meals_count){
                          echo '</ul></div><div class="col-sm-6"><ul class="mn-list">';
                          echo '<li>'.$weekly_meals_title.'</li>';
                        }
                        $meal_cnt++;
                      }
                      ?>
                      </ul>
                    </div>
                    <?php }else{ ?>  
                       <div class="col-sm-6">
                          <ul class="mn-list">
                            <li>No weekly meals menu is available.</li>
                          </ul>
                      </div>
                  <?php } ?>  

                  </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="square-box">
                  <div class="circle-leaf"><i class="fa fa-leaf" aria-hidden="true"></i></div>
                  <div class="week-sch-menu">
                  <h4>This Week's Snacks</h4>

                  <div class="row">
                  <?php if(!empty($weekly_snack_titles)){ ?>
                        <div class="col-sm-6">
                          <ul class="mn-list">
                          <?php 
                          $snack_cnt = 0;
                          $half_snacks_count = round(count($weekly_snack_titles)/2);
                          foreach ($weekly_snack_titles as $weekly_snack_title) {
                            echo '<li>'.$weekly_snack_title.'</li>';
                            if($snack_cnt == $half_snacks_count){
                              echo '</ul></div><div class="col-sm-6"><ul class="mn-list">';
                              echo '<li>'.$weekly_snack_title.'</li>';
                            }
                            $snack_cnt++;
                          }
                          ?>
                          </ul>
                        </div>
                  <?php }else{ ?>  
                       <div class="col-sm-6">
                          <ul class="mn-list">
                            <li>No weekly snacks menu is available.</li>
                          </ul>
                      </div>
                  <?php } ?>  
                  </div>

                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <div class="row ">
          <div class="col-sm-12 weekly-slide-sec mid-content">
            <h4>Ready to place your order and make your selections for next week?</h4>
            <a href="#" class="btn btn-view">Get Started</a>
          </div>
        </div>

        <hr>

        <div class="row weekly-slide-sec mid-content">
          <div>
            <p><strong>Below are images of what’s on the menu this week! Click each image for details, including ingredient lists and nutrition facts.</strong></p>
          </div>
          
          <div class="col-sm-12 scroller-meals">
          <!-- owl.carousel -->
          <div class="owl-carousel owl-theme" id="meals-carousel">
            <?php foreach ($weekly_meal_images as $weekly_meal_image) { 
              ?>
                <div class="items">
                  <a href="#"><img width="198" height="198" src="<?php echo $weekly_meal_image; ?>" alt=""></a>
                </div>
            <?php } ?>
          </div>
          <!-- end owl.carousel -->
          </div>

          <div class="col-sm-12 scroller-meals">
          <!-- owl.carousel -->
          <div class="owl-carousel owl-theme" id="snacks-carousel">
              <?php foreach ($weekly_snack_images as $weekly_snack_image) { 
              ?>
                <div class="items">
                  <a href="#"><img width="198" height="198" src="<?php echo $weekly_snack_image; ?>" alt=""></a>
                </div>
              <?php } ?>
          </div>
          <!-- end owl.carousel -->
          </div>

        </div>


        
      </div>
    </div>

    <!-- =============== Our Philosophy =============== -->
    


    
    <!-- =============== Footer Section =============== -->
    <div class="footer-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
          <div class="footer-links">
          <a href="">Contact Us</a> | 
          <a href="">Privacy Policy</a> | 
          <a href="">Return Policy</a> | 
          <a href="">Terms of Service</a>
          </div>
          <div class="get-btn-dv">
          <a href="" class="btn btn-get">Get Prep'd</a>
          </div>
          </div>
          <div class="col-sm-4">
            <div class="footer-search"> 
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control"  placeholder="Type keyword" >
                    <span class="input-group-addon">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>  
                    </span>
                </div>
            </div>
            <div class="footer-social-icons">
              <a href="#" class="fa-in"><i class="fa fa-instagram"></i></a>
              <a href="#" class="fa-fb"><i class="fa fa-facebook"></i></a>
              <a href="#" class="fa-tw"><i class="fa fa-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/wow.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootsnav.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/owl.carousel/owl.carousel.js"></script>
    
    <script type="text/javascript">   
      jQuery(document).ready(function() {
        //new WOW().init();
        jQuery("#sidebtn").click(function(){    
        jQuery("#sidenav").toggle();
        return false;
         });

        jQuery('#meals-carousel').owlCarousel({
          lazyLoad: true,
          nav: true,
          loop: true,
          dots: false,
          mouseDrag: false, 
          autoplay:true,
          autoplayTimeout:6000,
          autoplayHoverPause:true,
          //items: 3,
          responsiveClass:true,
          navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
          responsive:{
            0:{
                items:1,
                nav:true
            },
            768:{
                items:5,
                nav:true
            }
          }
        });
        jQuery('#snacks-carousel').owlCarousel({
          lazyLoad: true,
          nav: true,
          loop: true,
          dots: false,
          mouseDrag: false, 
          autoplay:true,
          autoplayTimeout:7000,
          autoplayHoverPause:true,
          //items: 3,
          responsiveClass:true,
          navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
          responsive:{
            0:{
                items:1,
                nav:true
            },
            768:{
                items:5,
                nav:true
            }
          }
        });
        });
    </script>
  </body>
</html>
