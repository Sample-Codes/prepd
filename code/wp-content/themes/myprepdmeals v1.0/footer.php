<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 */
?>
  <!-- =============== Footer Section =============== -->
    <div class="footer-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
          <div class="footer-links">
          <!-- <a href="">Contact Us</a> | 
              <a href="">Privacy Policy</a> | 
              <a href="">Return Policy</a> | 
              <a href="">Terms of Service</a> -->
              <?php
              if(function_exists('wp_nav_menu')) {
               wp_nav_menu(array(
                'theme_location' => 'footer',
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
          <!--
          <div class="get-btn-dv">
            <a href="" class="btn btn-get">Get Prep'd</a>
          </div>
          -->
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
              <a href="https://instagram.com/myprepdmeals/" target="_blank" class="fa-in"><i class="fa fa-instagram"></i></a>
              <a href="https://www.facebook.com/myprepdmeals?_rdr=p" target="_blank" class="fa-fb"><i class="fa fa-facebook"></i></a>
              <a href="https://twitter.com/myprepdmeals" target="_blank" class="fa-tw"><i class="fa fa-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/wow.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootsnav.js"></script>
    <script>
      new WOW().init();
    </script>

<?php wp_footer(); ?>
</body>
</html>
