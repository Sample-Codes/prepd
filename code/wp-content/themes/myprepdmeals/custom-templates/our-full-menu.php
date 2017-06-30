<?php
/**
 * Template Name: Our Full Menu
 *
 */
get_header('banner');
?>
    <!-- =============== How it Work image section =============== -->
    <div class="full-menu-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 custom-tab">
            <!-- <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a data-target="#meals-tab" data-toggle="tab">Meals</a></li>
              <li><a data-target="#snacks-tab" data-toggle="tab">Snacks</a></li>
            </ul> -->

            <div class="" id="portfoliolist">
                <div class="row">
                  <div class="col-sm-12">
                    <h2>Meals</h2>
                     <p>Each week, you’ll get to select your meals and snacks from a rotating menu. This gives you control of your meal plan, while letting us plan ahead and continue to test and add new recipes to our repertoire. Our entire selection is listed below. Keep in mind, while a majority of our meals are available all year long and will frequently appear in the rotation, others are seasonal based on availability of key ingredients from our trusted suppliers.</p>

<p>NOTE: Our breakfast menu will be available to view here soon, so stay tuned!</p>
                  </div>
                  <!-- Start Filter -->
                  
                  <div class="filter-menu">
                    <div class="col-sm-12">
                    <ul id="" class="filters-menu">
                      <li><span class="filter active" data-filter=".all">All</span></li> 
                      <?php 
                        $meal_taxonomy='meal-category';  
                        $meal_terms = get_terms($meal_taxonomy,array('orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false)); 
                        foreach($meal_terms as $meal_term) {  
                          echo '<li class="'.$meal_term->slug.'"><span class="filter" data-filter=".'.$meal_term->slug.'">'.$meal_term->slug.'</span></li>';
                         } 
                        ?>
                      <div class="clearfix"></div>
                    </ul> 
                    </div> 
                  </div>
                  <div class="col-sm-12">
                    <div class="row meal-filter" id="">
                       <?php
                      $meals = new WP_Query( array( 'post_type' => 'meal', 'posts_per_page' => -1, 'post_status' => array( 'publish', 'draft' )) );
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
                        <div class="li-last">*</div>
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
                     <p>Each week, you’ll get to select your meals and snacks from a rotating menu. This gives you control of your meal plan, while letting us plan ahead and continue to test and add new recipes to our repertoire. Our entire selection is listed below. Keep in mind, while a majority of our meals are available all year long and will frequently appear in the rotation, others are seasonal based on availability of key ingredients from our trusted suppliers.</p>

<p>NOTE: Our breakfast menu will be available to view here soon, so stay tuned!</p>
                  </div>
                  <!-- Start Filter -->
                  
                  <div class="col-sm-12">
                    <div class="row meal-filter" id="">
                         <?php
                      $meals = new WP_Query( array( 'post_type' => 'snack', 'posts_per_page' => -1, 'post_status' => 'publish') );
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
                        <div class="li-last">*</div>
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
<?php get_footer('banner'); ?>