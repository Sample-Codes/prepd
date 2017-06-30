<?php
/**
 * Template Name: Weekly Menu Week 1
 *
 */
get_header('banner');
?>
    <!-- =============== How it Work image section =============== -->
    




    <div class="full-menu-section">
      <div class="container">
        <div class="row">
        <div class="menudate">
        <?php
    
    // Start the loop.
    while ( have_posts() ) : the_post();

      // Include the page content template.
      get_template_part( 'template-parts/content', 'page' );
      // End of the loop.
    endwhile;
    ?>
      </div>
      </div>
        <div class="row">
          <div class="col-sm-12 custom-tab">
            <!-- <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a data-target="#meals-tab" data-toggle="tab">Meals</a></li>
              <li><a data-target="#snacks-tab" data-toggle="tab">Snacks</a></li>
            </ul> -->
                  <!-- Start Filter -->
                  <!-- This is where my code starts -->
        <div class="row">
          <div class="col-sm-12">
            <div class="row leaf-column">
              <div class="col-sm-6">
                <div class="square-box">
                  <div class="circle-leaf"><i class="fa fa-cutlery" aria-hidden="true"></i></div>
                  <div class="week-sch-menu">
                  <h4>This Week's Meals</h4>
                    <?php
                      $meals = new WP_Query( array( 'post_type' => 'meal', 'posts_per_page' => -1, 'post_status' => 'publish', 'meal-category' => 'week one' ) );
                      if ( $meals->have_posts() ) :
                        while ( $meals->have_posts() ) : $meals->the_post(); 
                     ?>

                     <div>
                        <ul class="mn-list">
                        <li><a href="<?php the_permalink(); ?>" class="name"><?php the_title(); ?></a></li>
                        </ul>
                        </div>

                        <?php 
                      endwhile;
                        endif;
                      wp_reset_postdata();
                    ?>

                  </div>
                </div>
              </div>
            <div class="col-sm-6">
                <div class="square-box">
                  <div class="circle-leaf"><i class="fa fa-leaf" aria-hidden="true"></i></div>
                  <div class="week-sch-menu">
                  <h4>This Week's Snacks</h4>
                     <?php
                      $meals = new WP_Query( array( 'post_type' => 'snack', 'posts_per_page' => -1, 'post_status' => 'publish', 'meal-category' => 'week one' ) );
                      if ( $meals->have_posts() ) :
                        while ( $meals->have_posts() ) : $meals->the_post(); 
                     ?>

                     <div>
                        <ul class="mn-list">
                        <li><a href="<?php the_permalink(); ?>" class="name"><?php the_title(); ?></a></li>
                        </ul>
                        </div>

                        <?php 
                      endwhile;
                        endif;
                      wp_reset_postdata();
                    ?>
                </div>
              </div>
            </div>

            </div>
            </div>
            </div>


           


            <div class="row ">
          <div class="col-sm-12 weekly-slide-sec mid-content">
            <h4>Ready to place your order and make your selections for next week?</h4>
            <a href="http://www.myprepdmeals.com/meal-plans/" class="btn btn-view">Get Started</a>
          </div>
        </div>

<hr>
        <div>
            <p style="text-align: center;"><strong>Below are images of what’s on the menu this week! Click each image for details, including ingredient lists and nutrition facts.</strong></p>
          </div>
                  <!-- this is where it ends -->

                  <div class="row">
                  <div class="col-sm-12">
                    <h2>Meals</h2>
                  </div>

                  
                  <div class="col-sm-12">
                    <div class="row meal-filter" id="">
                       <?php
                      $meals = new WP_Query( array( 'post_type' => 'meal', 'posts_per_page' => -1, 'post_status' => 'publish', 'meal-category' => 'week one' ) );
                      if ( $meals->have_posts() ) :
                        while ( $meals->have_posts() ) : $meals->the_post(); 
                     ?>
                      <div class="col-sm-3 col-xs-6 portfolio all <?php echo get_menu_term_slug_by_post_id(get_the_ID(), 'meal-category' ); ?>" data-cat="<?php echo get_menu_term_slug_by_post_id(get_the_ID(), 'meal-category' ); ?>">
                        <div class="middle-img">
                          <a href="<?php the_permalink(); ?>"><?php
                              if ( has_post_thumbnail() ) {
                                  the_post_thumbnail('meal-image');
                              }
                              else {
                                  echo '<img width="286px" height="191px" src="' . get_bloginfo( 'stylesheet_directory' ) 
                                      . '/images/dummy-img-01.jpg" />';
                              }
                              ?>
                          </a>
                          <span class="caption-link">
                              <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                          </span>
                        </div>
                        <div class="full-menu-nm">
                        <a href="<?php the_permalink(); ?>" class="strongtext name"><?php the_title(); ?></a>
                        </div>
                      </div>
                      <?php 
                      endwhile;
                        endif;
                      wp_reset_postdata();
                    ?>
                      
                    </div>
                  </div>
                </div>
              <!-- Meals Tab End -->

              
                <div class="row">
                  <div class="col-sm-12">
                    <h2>Snacks</h2>
                  </div>
                  <!-- Start Filter -->
                  
                  <div class="col-sm-12">
                    <div class="row meal-filter" id="">
                         <?php
                      $meals = new WP_Query( array( 'post_type' => 'snack', 'posts_per_page' => -1, 'post_status' => 'publish', 'meal-category' => 'week one' ) );
                      if ( $meals->have_posts() ) :
                        while ( $meals->have_posts() ) : $meals->the_post(); 
                     ?>
                      <div class="col-sm-3 col-xs-6 portfolio all <?php echo get_menu_term_slug_by_post_id(get_the_ID(), 'meal-category' ); ?>" data-cat="<?php echo get_menu_term_slug_by_post_id(get_the_ID(), 'meal-category' ); ?>">
                        <div class="middle-img">
                          <a href="<?php the_permalink(); ?>"><?php
                              if ( has_post_thumbnail() ) {
                                  the_post_thumbnail('meal-image');
                              }
                              else {
                                  echo '<img width="286px" height="191px" src="' . get_bloginfo( 'stylesheet_directory' ) 
                                      . '/images/dummy-img-01.jpg" />';
                              }
                              ?>
                          </a>   
                          <span class="caption-link">
                              <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                          </span>
                        </div>
                        <div class="full-menu-nm">
                        <a href="<?php the_permalink(); ?>" class="strongtext name"><?php the_title(); ?></a>
                        
                        </div>
                      </div>
                      <?php 
                      endwhile;
                        endif;
                      wp_reset_postdata();
                    ?>

                    </div>
                  </div>

                  <div class="col-sm-12">
                    <?php echo wpautop(get_post_meta(get_the_ID(),'wpcf-full-menu-page-footer-description',true)); ?>
                  </div>

                  <!-- <div class="col-sm-12">
                    <ul class="pagination pull-right">
                        <li><a href="#">&laquo; Previous</a></li>
                        <li><a href="#" class="active">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">Next &raquo;</a></li>
                    </ul>
                  </div> -->

                </div>
              <!-- Snacks tab end -->
            </div>
          </div>

        </div>

          
      </div>
    </div>

    <!-- =============== Our Philosophy =============== -->
<?php get_footer(); ?>