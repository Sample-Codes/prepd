<?php
/*
Template Name: Get Toolkit
*/
?>
<?php get_header(); ?>
<?php 
  global $post;
  $PostID = $post->ID;
  if($PostID == 3545){
?>
<script type="text/javascript">
  jQuery( document ).ready(function() {

      //code for facebook
      jQuery('.st_facebook_hcount').attr('st_title','Create a Culture of Innovation with the Free Invisible Advantage Toolkit');
      jQuery('.st_facebook_hcount').attr('st_url','<?php echo site_url(); ?>/innovation-book-culture-toolkit/');

      //code for twitter
      jQuery('.st_twitter_hcount').attr('st_title','Create a Culture of Innovation with the Free Invisible Advantage Toolkit');
      jQuery('.st_twitter_hcount').attr('st_url','<?php echo site_url(); ?>/innovation-book-culture-toolkit/');

      //code for googleplus
      jQuery('.st_plusone_hcount').attr('st_title','Create a Culture of Innovation with the Free Invisible Advantage Toolkit');
      jQuery('.st_plusone_hcount').attr('st_url','<?php echo site_url(); ?>/innovation-book-culture-toolkit/');

      //code for linkedin
      jQuery('.st_linkedin_hcount').attr('st_title','Create a Culture of Innovation with the Free Invisible Advantage Toolkit');
      jQuery('.st_linkedin_hcount').attr('st_url','<?php echo site_url(); ?>/innovation-book-culture-toolkit/');


  });
</script>
<?php 
}
?>  
	<section class="main-contect">
    <div class="row">
      <div class="col-sm-offset-2 col-sm-8 col-xs-12 media-page get-toolkit">
        <div class="social-top text-center">
           <?php echo do_shortcode('[sharethis]'); ?>
          <!--<a href="https://twitter.com/sorenkaplan" target="_blank">
            <i class="fa fa-twitter" aria-hidden="true"></i>
          </a>
          <a href="https://www.linkedin.com/in/sorenkaplan" target="_blank">
            <i class="fa fa-linkedin" aria-hidden="true"></i>
          </a>-->
        </div>

        <div id="get-toolkit-desc">
          <?php 
            $id=3545; 
            $post = get_post($id); 
            $content = apply_filters('the_content', $post->post_content); 
            echo $content;
          ?>
        </div>

        <div id="password-div">
          <form id="password-form">
            <div class="input-group">
              <input id="password" name="password" class="form-control" type="password" placeholder="Enter the password" />
              <span class="input-group-btn">
                <button id="password-check-button" class="btn btn-success" type="button">Submit</button>
              </span>
            </div>    
            <div id="password-error" style="display: none;" class="alert alert-danger"> Please enter correct password </div>
            
          </form>
        </div>

        <div id="download-pdfs" >
        <ul class="list">
          <?php
            $title_arr = array();
            $title_one=$title_two=$article_destination_link=$article_destination_url=$extratitle= "";
            $images = get_field('get_toolkit_gallery');
            if(count($images) > 0){
              if( $images ){
                $i = 0;
          ?>

          <?php foreach( $images as $image ){ ?>
            <?php 
              //echo "<pre>"; print_r($image); echo "</pre>";
              $article_destination_link = get_post_meta($image['id'],'article_destination_url',true);
              $title = $image['title'];
            ?>
          <li>
            <div class="row">
              <div class="col-sm-4 col-xs-4 custom-width text-center">
                  <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
              </div>
              <div class="col-sm-8 col-xs-8 custom-width text-align-custom">
				<div class="text-vertical2">
                <?php 
                  if(!empty($article_destination_link)){ 
                    $article_destination_url  = $article_destination_link;
                  }else{
                     $article_destination_url = "#";
                  }

                  if($image['id'] == 3612){
                     $extratitle = '<br/>open file and enter the passcode “InnovationCulture” to view'; 
                  }else{
                     $extratitle = ''; 
                  }
                ?>
                <a target="_blank" href="<?php echo $article_destination_url; ?>"><?php echo $title; ?></a>
                <?php echo $extratitle; ?>
				</div>
              </div>
            </div>
          </li>
          <?php } ?>
          <?php } 
          }
          ?>
        </ul>

        <div class="social-top text-center">
           <?php echo do_shortcode('[sharethis]'); ?>
          <!--<a href="https://twitter.com/sorenkaplan" target="_blank">
            <i class="fa fa-twitter" aria-hidden="true"></i>
          </a>
          <a href="https://www.linkedin.com/in/sorenkaplan" target="_blank">
            <i class="fa fa-linkedin" aria-hidden="true"></i>
          </a>-->
        </div>
        </div>
      </div>
    </div>

  			<!--<div class="row">
  				<div class="col-sm-4 col-xs-12">
  					<div class="leftbar">
  						<?php dynamic_sidebar('Sidebar One'); ?> 
  					</div>
  				</div>
  				<div class="col-sm-8 col-xs-12">
  					<div class="inner-content">
                <h1><?php echo get_the_title(get_the_ID()); ?></h1>
                <div id="download-pdfs" >
                  <?php 
                      $id=3545; 
                      $post = get_post($id); 
                      $content = apply_filters('the_content', $post->post_content);

                      if(!empty($content)){
                        echo $content;
                      }
                  
                      $title_arr = array();
                      $title_one=$title_two=$article_destination_link=$article_destination_url= "";
                      $images = get_field('get_toolkit_gallery');
                      if(count($images) > 0){
                        if( $images ){
                          $i = 0;
                         ?>
                            <div class="row">
                                <?php foreach( $images as $image ){ ?>
                                    <?php 
                                      $article_destination_link = get_post_meta($image['id'],'article_destination_url',true);
                                      $title = $image['title']; 
                                    ?>
                                    <div class="col-sm-8">
                                          <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
                                        <p>
                                          <?php 
                                            if(!empty($article_destination_link)){ 
                                              $article_destination_url  = $article_destination_link;
                                            }else{
                                               $article_destination_url = "#";
                                            }
                                          ?>
                                            <a target="_blank" href="<?php echo $article_destination_url; ?>"><b class="title-color"><?php echo $title; ?></b></a>
                                          
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                      <?php } 
                      }
                      ?>
                  </div>
                </div>
  					</div>


  			</div> -->
  	</section>


<!-- WordPress Hook -->
<?php get_footer(); ?>