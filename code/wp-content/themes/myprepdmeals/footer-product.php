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
              <a href="#" class="fa-in"><i class="fa fa-instagram"></i></a>
              <a href="#" class="fa-fb"><i class="fa fa-facebook"></i></a>
              <a href="#" class="fa-tw"><i class="fa fa-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="meal-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            <h5 class="modal-title" id="meal-label">Three Bean Ancho Turkey Chili</h5>
            <a href="#" id="add-to-order" class="btn btn-popup pull-right">Add to order</a>
          </div>
          <div class="modal-body">
            <div class="modal-img" id="post-image"></div>
            <div id="post-desc">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
    <script type="text/javascript">
        jQuery('.view-meals').on('click', function(evt) {
          var post_title=post_desc=post_image=default_img_url=post_id= "";
          post_title  = jQuery(this).data('post-title');
          post_desc   = jQuery(this).data('desc');
          post_image  = jQuery(this).data('image');
          post_id     = jQuery(this).data('post-id');

          jQuery('#add-to-order').attr('onClick','add('+post_id+')');

          jQuery('#meal-label').text(post_title);

          var default_img_url = "<?php echo get_template_directory_uri(); ?>/images/dummy-img-01.jpg";

          if(post_image){
            jQuery('#post-image').html('<img src="'+post_image+'"/>');
          }else{
            jQuery('#post-image').html('<img width="568px" height="379px" src="'+default_img_url+'" />');
          }

          jQuery('#post-desc').html(post_desc);
        });
    </script>
 <?php wp_footer(); ?>
  </body>
</html>
