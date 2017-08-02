<?php
/**
 * The template for displaying all single meals and attachments
 *
 * @package WordPress
 * @subpackage Myprepdmeals
 * @since Myprepdmeals 1.0
 */

get_header(); 
$current_post_id = $is_featured = "";
$current_post_id = get_the_ID();
?>

    <div class="full-menu-section">
    <?php  
    $is_featured = get_post_meta($current_post_id,'wpcf-make-featured',true);
    if ( !empty( $is_featured && $is_featured == 1) ) {
    ?>
          <div class="container">
          <?php while( have_posts() ) : the_post(); ?>
              <div class="row">
                <div class="col-sm-5">
                  <div class="object-img">
                  <?php 
                    if( has_post_thumbnail() ) {
                        the_post_thumbnail('meal-post-detail-image'); 
                    }else{
                        echo '<img width="450" height="450" src="'. get_template_directory_uri() .'/images/dummy-img-01.jpg" alt="">';
                    }
                  ?>
                  </div>
                </div>
                <div class="col-sm-7">
                  <div class="pro-info-sec">
                    <h3>Meal Description</h3>
                      <?php the_content(); ?>    
                  </div>
                
                </div>
              </div>
            <?php endwhile; ?>
            <div class="row related-menu-section">
              <div class="col-sm-12">
                  <h3>Related Featured Meals</h3>
              </div>

              <?php
              $meal_args = array();
                $meal_args = array('post_type'   => 'meal',
                           'meta_query'  => array(
                                                            array(
                                                                'key' => 'wpcf-make-featured',
                                                                'value' => 1
                                                            )
                                                        ),  
                                    'posts_per_page' => 4,
                                    'post_status'    => 'publish',
                                    'orderby'        => 'date',
                                    'order'          => 'DESC'
                                   );
                $meal_query = new WP_Query($meal_args);
                if( $meal_query->have_posts() ):
                    while( $meal_query->have_posts() ): $meal_query->the_post();
                ?>

                  <div class="col-sm-3">
                    <div class="related-pr">
                    <?php 
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail('meal-post-related-image'); 
                        }else{
                           echo '<img width="230" height="230" src="'.get_template_directory_uri().'/images/dummy-img-01.jpg" alt="">';
                        }
                    ?>
                    <a><?php the_title(); ?></a>
                    <div class="li-last2">*</div>
                       <?php echo custom_excerpt_related_meals(get_the_excerpt(), '30'); ?>
                    </div>
                  </div>

                <?php 
                    endwhile;
                endif;
              ?>
            </div>
          </div>
      <?php } else { ?>
           <div class="container">
            <?php while( have_posts() ) : the_post(); ?>
                <div class="row">
                  <div class="col-sm-5">
                    <div class="object-img">
                    <?php 
                      if( has_post_thumbnail() ) {
                          the_post_thumbnail('meal-post-detail-image'); 
                      }else{
                          echo '<img width="450" height="450" src="'.get_template_directory_uri().'/images/dummy-img-01.jpg" alt="">';
                      }
                    ?>
                    </div>
                  </div>
                  <div class="col-sm-7">
                    <div class="pro-info-sec">
                      <h3>Meal Description</h3>
                        <?php the_content(); ?>

                        <?php

                      $meals_id = get_the_id();
                      render_nutrition_table($meals_id);

                      ?>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
              <div class="row related-menu-section">
                <div class="col-sm-12">
                  <h3>Related Meals</h3>
                </div>

                <?php
                $meal_args = array();
                  $meal_args = array('post_type'   => 'meal', 
                                      'posts_per_page' => 4,
                                      'post_status'    => 'publish',
                                      'orderby'        => 'date',
                                      'order'          => 'DESC'
                                     );
                  $meal_query = new WP_Query($meal_args);
                  if( $meal_query->have_posts() ):
                      while( $meal_query->have_posts() ): $meal_query->the_post();
                  ?>

                    <div class="col-sm-3">
                      <div class="related-pr">
                      <?php 
                          if ( has_post_thumbnail() ) {
                              the_post_thumbnail('meal-post-related-image'); 
                          }else{
                             echo '<img width="230" height="230" src="'.get_template_directory_uri().'/images/dummy-img-01.jpg" alt="">';
                          }
                      ?>
                      <a><?php the_title(); ?></a>
                      <div class="li-last2">*</div>
                         <?php echo custom_excerpt_related_meals(get_the_excerpt(), '30'); ?>
                      </div>
                    </div>

                  <?php 
                      endwhile;
                  endif;
                ?>
              </div>
            </div>
      <?php } ?>
    </div>
<script type="text/javascript">
  jQuery( document ).ready(function() {
    jQuery('.attachment-meal-post-detail-image').removeAttr('width');
    jQuery('.attachment-meal-post-detail-image').removeAttr('height');
});
</script>
<?php get_footer(); ?>
