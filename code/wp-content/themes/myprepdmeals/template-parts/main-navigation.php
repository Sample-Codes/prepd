<?php

/**
 * Main Navigation
 **/

?>

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

    <?php
      if(function_exists('wp_nav_menu')) {
        wp_nav_menu(array(
          'theme_location'  => 'primary',
          'menu_class'      => 'nav navbar-nav navbar-right',
          'container'       => 'div',
          'container_class' => 'collapse navbar-collapse',
          'container_id'    => 'navbar-menu',
          'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
          'walker'          => new wp_bootstrap_navwalker()
          
           )); 
          }
         ?>
  </div>  
</nav>