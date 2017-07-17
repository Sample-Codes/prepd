<?php
/**
 * Template Name: Prepd Blog
 *
 */

get_header('banner'); ?>

<!--mainstreetinvestments section start here-->

    <div class="masonary-blog">
      <div class="container">
        <!-- Top Navigation -->
        
        <ul class="grid effect-2" id="grid">
           <?php 
              $blog_args = array();
              $blog_args = array('post_type'      => 'post', 
                                 'posts_per_page' => -1,
                                 'post_status'    => 'publish',
                                 'orderby'        => 'date',
                                 'order'          => 'DESC'
                                );
              $blog_query = new WP_Query($blog_args);
                  if( $blog_query->have_posts() ):
                      while( $blog_query->have_posts() ): $blog_query->the_post();
          ?>
            <li class="grid-item wow fadeIn">
              <div class="blog-dv">
              <div class="blog-img-thm">
                <a href="<?php the_permalink(); ?>">
                  <?php 
                      if ( has_post_thumbnail() ) {
                        the_post_thumbnail('blog-post-front-image'); 
                      }else{
                         echo '<img width="360" height="128" src="'.get_template_directory_uri().'/images/dummy-img-01.jpg" alt="">';
                      }
                  ?>
                </a>
              </div>
              <div class="blog-date-nm">
                <div class="row">
                  <div class="col-sm-4"><i class="fa fa-clock-o"></i>
                    <?php 
                        the_time('d M Y'); 
                    ?>
                  </div>
                  <div class="col-sm-8"><i class="fa fa-user"></i>
                     <?php 
                          $author = get_the_author(); 
                          echo $author;
                      ?>
                   </div>
                </div>
              </div>
              <div class="blog-desc">
                <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                  <?php echo custom_excerpt(get_the_excerpt(), '50'); ?>
              </div>
              <div class="blog-remore">
                <a href="<?php the_permalink(); ?>">Read More</a>
              </div>
              </div>
              <div class="clearfix"></div>
            </li>
          <?php
              endwhile;
            endif;
          wp_reset_postdata();
          ?>
        </ul>
      </div>
    </div>

<!-- Masonary -->
<!-- <script src="https://unpkg.com/masonry-layout@4.1/dist/masonry.pkgd.min.js"></script> -->
<script src="<?php echo get_template_directory_uri(); ?>/js/masonry.pkgd.min.js"></script>
<script type="text/javascript">
  jQuery('#grid').masonry({
  // options
  itemSelector: '.grid-item'
});
</script>
<!-- Masonary -->

<?php get_footer(); ?>