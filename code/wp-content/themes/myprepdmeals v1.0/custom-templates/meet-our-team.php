<?php
/**
 * Template Name: Meet Our Team
 *
 */

get_header('banner'); ?>
<div id="primary" class="content-area">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <main id="main" class="site-main" role="main">
            <div class="core-values">
                <div class="container">

                  <?php 
                      $custom_taxonomy='team-member-category';  
                      $custom_terms = get_terms($custom_taxonomy,array('orderby' => 'id', 'order' => 'DESC',)); 
                      foreach($custom_terms as $custom_term) {  
                          wp_reset_query();
                          $args = array(
                              'post_type' => 'team-member',
                              'orderby'        => 'date',
                              'order'          => 'ASC',
                              'tax_query' => array(  
                                  'orderby'        => 'name',
                                  'order'          => 'ASC',             
                                  array(
                                      'taxonomy' => $custom_taxonomy,
                                      'field' => 'slug',
                                      'terms' => $custom_term->slug,
                                  ),
                              ),
                          );  

                          $loop = new WP_Query($args);
                          
                          $term_name = $custom_term->name; 

                          if($term_name == 'Management'){
                            while($loop->have_posts()) : $loop->the_post(); 
                                if(($cnt%2) == 0){
                                ?>
                                  <div class="row team-row">
                                      <div class="col-sm-4">
                                        <?php 
                                            if ( has_post_thumbnail() ) {
                                              the_post_thumbnail('team-membert-image'); 
                                            }else{
                                               echo '<img width="360" height="360" src="'.get_template_directory_uri().'/images/dummy-img-01.jpg" alt="">';
                                            }
                                        ?>
                                      </div>
                                      <div class="col-sm-8">
                                          <h2><?php the_title(); ?></h2>
                                           <?php the_content(); ?>
                                      </div>
                                  </div>
                                <?php
                              }else{
                                ?>
                                <div class="row team-row">
                                      <div class="col-sm-8">
                                          <h2><?php the_title(); ?></h2>
                                           <?php the_content(); ?>
                                      </div>
                                      <div class="col-sm-4">
                                        <?php 
                                            if ( has_post_thumbnail() ) {
                                              the_post_thumbnail('team-management-members-image'); 
                                            }else{
                                               echo '<img width="360" height="360" src="'.get_template_directory_uri().'/images/dummy-img-01.jpg" alt="">';
                                            }
                                        ?>
                                      </div>
                                  </div>
                                <?php
                              }
                              $cnt++;
                            endwhile;

                           echo '<hr/>';
                          }
                         
                         if($term_name == 'Cook'){
                          $cnt = 0; 
                          echo ' <div class="row">';
                           while($loop->have_posts()) : $loop->the_post(); 
                              ?>
                               <div class="col-sm-4">
                                  <div class="team-members">
                                    <?php 
                                        if ( has_post_thumbnail() ) {
                                          the_post_thumbnail('team-cook-members-image'); 
                                        }else{
                                           echo '<img width="360" height="360" src="'.get_template_directory_uri().'/images/dummy-img-01.jpg" alt="">';
                                        }
                                    ?>
                                    <h4><?php the_title(); ?></h4>
                                     <?php the_content(); ?>
                                    <div class="clearfix"></div>
                                  </div>
                              </div>
                              <?php
                           
                            endwhile;
                           echo '</div>';
                          } 
                      }
                   ?>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>