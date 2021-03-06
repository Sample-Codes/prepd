<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 */

get_header(); ?>

<?php 

$id = get_the_ID();
$top_banner = get_field("top_banner", $id);
$banner_link = get_field('top_banner_link');

var_dump($top_banner);
var_dump($banner_link);
var_dump($id);

echo '<div class="slide-image-section">';
echo $banner_link ? '<a href="' . $banner_link . '">' : '';
echo '<img src="' . $top_banner['url'] . '">';
echo $banner_link ? '</a>' : '';
echo '</div>';

?>

    <div class="clear"></div>

    <!-- =============== Start Our Philosophy =============== -->
    <div class="philosophy-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
              <h2>Our Philosophy</h2>
              <p>Your busy life demands a lot from you. You’re a 9-to-5 warrior and a 5-to-9 mom of the year; a dedicated small business owner and an outdoor adventure-seeker; a stay-at-home dad and a CrossFit stud. You play many roles, and you play them well. Prep’d believes that those busy, stressful, exciting and fulfilling lives deserve food that’s equally fulfilling – in flavor, nutrition and convenience. It’s time to give yourself the nutrition you deserve to keep fueling your busy life.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- =============== End Our Philosophy =============== -->

    <!-- =============== Start Meals and Snacks =============== -->
    <div class="featured-meals">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="text-title-2 featured-heading">Featured Meals</h2>
          </div>
             <?php 
                $meal_args = array();
                $meal_args = array('post_type'      => array('meal','snack'),
                                    'meta_query'  => array(
                                                          array(
                                                              'key' => 'wpcf-make-featured',
                                                              'value' => 1
                                                          )
                                                      ), 
                                   'posts_per_page' => 3,
                                   'post_status'    => array('publish','draft'),
                                   'orderby'        => 'date',
                                   'order'          => 'DESC'
                                  );
                $meal_query = new WP_Query($meal_args);
                if( $meal_query->have_posts() ):
                  while( $meal_query->have_posts() ): $meal_query->the_post();
                    ?>
                    <div class="col-sm-4 meals">
                      <div class="middle-img">
                        <a href="<?php the_permalink(); ?>">
                          <?php 
                              if ( has_post_thumbnail(get_the_ID()) ) {
                                the_post_thumbnail('meal-post-front-image'); 
                              }else{
                                echo '<img width="280" height="190" src="'.get_template_directory_uri().'/images/dummy-img-01.jpg" alt="<?php the_title(); ?>">';
                              }
                          ?>
                        </a>
                        <span class="caption-link">
                            <a target="_blank" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                        </span>
                      </div>
                      
                      <h3 class="text-title-3"><a target="_blank" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                      <img src="<?php echo get_template_directory_uri(); ?>/images/green-icon-02.png" alt="" class="leaf-icon">
                      <?php echo custom_featured_excerpt(get_the_excerpt()); 
                      ?>
                    </div>
             <?php
                  endwhile;
              endif;
            wp_reset_postdata();
            ?>
          <div class="col-sm-12 meals">
            <a href="<?php echo site_url()."/menu-2"; ?>" class="btn btn-view">View More</a>
          </div>
        </div>
      </div>
    </div>
  <!-- =============== End Meals and Snacks =============== -->

   <!-- =============== Start Prep'd Blog =============== -->
    <div class="home-blog parallax-1">
      <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <h2 class="text-title-2">Prep'd Blog</h2>
                <p>Our <a href="" class="bl-link">meal delivery</a> service will get your body #PrepdForSuccess. Our blog will help with the rest. Get nutrition tips, life prep, and all the ingredients you need to succeed in your busy life.</p>
              </div>
              <div class="clearfix"></div>
              <?php 
                  $blog_args = array();
                  $blog_args = array('post_type'      => 'post', 
                                     'posts_per_page' => 3,
                                     'post_status'    => 'publish',
                                     'orderby'        => 'date',
                                     'order'          => 'DESC'
                                     );
                  $blog_query = new WP_Query($blog_args);
                  if( $blog_query->have_posts() ):
                      while( $blog_query->have_posts() ): $blog_query->the_post();
                        ?>
                          <div class="col-sm-4 first-blog">
                            <div class="middle-img">
                              <a target="_blank" href="<?php the_permalink(); ?>">
                                <?php 

                                  if ( has_post_thumbnail(get_the_ID()) ) {
                                    the_post_thumbnail('blog-post-front-image'); 
                                  }else{
                                    echo '<img width="360" height="128" src="'.get_template_directory_uri().'/images/dummy-img-01.jpg" alt="">';
                                  }
                                ?>
                              </a>
                            </div>
                            <div class="date-dv">
                              <div class="row">
                                <div class="col-sm-5"><i class="fa fa-clock-o"></i> 
                                  <?php 
                                    the_time('d M Y'); 
                                  ?>
                                </div>
                                <div class="col-sm-5"><i class="fa fa-user" aria-hidden="true"></i>
                                  <?php 
                                      $author = get_the_author(); 
                                      echo $author;
                                  ?>
                                </div>
                              </div>
                            </div>
                            <div class="blog-sec" style="background:#ffffff;">
                            <h3 class="text-title-3"><a target="_blank" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                              <?php echo custom_excerpt(get_the_excerpt(), '30'); ?>
                            </div>
                            <div class="read-more-dv">
                              <a target="_blank" href="<?php the_permalink(); ?>">Read More</a>
                            </div>
                        </div>
                        <?php
                      endwhile;
                  endif;
                  wp_reset_postdata();
              ?>
            <div class="col-sm-12 meals">
              <a href="<?php echo site_url()."/prepd-blog"; ?>" class="btn btn-view">View More</a>
            </div>
            </div>
      </div>
      
    </div>
    <!-- =============== End Prep'd Blog =============== -->
    
 <script type="text/javascript">

  jQuery(document).ready(function() {
    var plan_url=email=zipcode= "";

    /* START : validate startup form */
     $("#startUpPlan").validate({
      errorElement: "div",
        errorClass: "error",
        errorPlacement: function(error, element) {
            if(element.parent('.TextError').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        onkeyup: function(element) { 
          if ($(element).valid()) { // checks form for validity
            $('#btn-plans').removeAttr('disabled');        // enables button
        } else {
            $('#btn-plans').attr('disabled', 'disabled');   // disables button
        }
         },
        rules: {
          email: {
            required: true,
            customemail: true
          },
          zipcode: {
            required: true,
            minlength: 5,
            remote: {
              url: "<?php echo get_template_directory_uri(); ?>/ajax-files/zipcode-exist.php",
              type: "post",
              data: {
                username: function() {
                var zipcode = jQuery('#zipcode').val();
                return zipcode;
                }
              }
            }
          }
        },
        messages: {
          email: {
           required: "Please enter email address",
           customemail: "Please enter valid email address"
          },
          zipcode: {
            required: "Please enter zipcode",
            minlength: "Your zip code must be at least 5 digit long",
            remote: "We can't deliver meals to your area",
          }
        },
      submitHandler: function(form) {
        jQuery("#front-loader").css('display','block');
        email = jQuery('#email').val().trim();
        zipcode = jQuery('#zipcode').val().trim();
        plan_url = "<?php echo site_url(); ?>/meal-plans/?email="+email+"&zipcode="+zipcode;
        window.location.href = plan_url;
      }
      });
  //});
    /*END : validate startup form */

    /*START : custom email validation rule*/
    $.validator.addMethod("customemail", function(value, element) {
    email_regex = new RegExp(/([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/);
        return email_regex.test(value);
    }, 'Please enter a valid email address.');
    /*END : custom email validation rule*/
  });
</script>   

<?php get_footer(); ?>
