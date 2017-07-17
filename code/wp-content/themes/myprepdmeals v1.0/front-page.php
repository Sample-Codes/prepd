<?php
/**
 * Front Page Template
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 */

get_header(); 

$id = get_the_ID();
$top_banner = get_field('top_banner');
$banner_link = get_field('top_banner_link');

// Content Section One
$content_section_one =  get_field('content_section_one');

// Featured Meals
$meals_header = get_field('meals_section_header');
$feature_meals = get_field('featured_meals');

echo '<main role="main">';

  echo '<div class="slide-image-section">';
  echo '<div class="container-fluid">';
  echo '<div class="row no-gutter">';
  echo $banner_link ? '<a href="' . $banner_link . '">' : '';
  echo '<img src="' . $top_banner . '">';
  echo $banner_link ? '</a>' : '';
  echo '</div>';
  echo '</div>';
  echo '</div>';

  // content section one
  echo '<div class="philosophy-section">';
  echo '<div class="container">';
  echo '<div class="row">';       
  echo '<div class="col-sm-12">';
  echo $content_section_one;              
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';

  // featured meals & snacks
  if( $feature_meals ):
    echo '<div class="featured-meals">';
    echo '<div class="container">';
    echo '<h2 class="text-title-2">' . $meals_header . '</h2>';
    echo '<div class="row">';

    foreach( $feature_meals as $post): 
      setup_postdata($post);

        $link = get_permalink();
        $title = get_the_title();
        $excerpt = custom_featured_excerpt(get_the_excerpt());
        
        echo '<div class="col-sm-4 meals">';
        echo '<div class="middle-img">';
        echo '<a href="' . $link . '">';           
        echo has_post_thumbnail( get_the_ID() ) ? the_post_thumbnail('meal-post-front-image') : '<img width="280" height="190" src="'. get_template_directory_uri() .'/images/dummy-img-01.jpg" alt="' . the_title() . '">';
        echo '</a>';                        
        echo '<span class="caption-link">';
        echo '<a href="' . $link . '"><i class="fa fa-link"></i></a>';
        echo '</span>';
        echo '</div>';
        echo '<a href="' . $link . '"><h3 class="text-title-3">' . $title . '</h3></a>';
        echo '<p><img src="' . get_template_directory_uri() . '/images/green-icon-02.png" alt="prepd leaf" class="leaf-icon">' . $excerpt . '</p>';
        echo '</div>';       
    
    endforeach;                   

  echo '</div>';   
  echo '<div class="row">';
  echo '<p class="feature-meals-btn"><a href="' . site_url() . '/menu-2" class="btn btn-view">View More</a></p>';
  echo '</div>';                  
  echo '</div>'; 
  echo '</div>'; 

    wp_reset_postdata(); 
  
  endif;

  // most recent blog posts
  $background_img = get_field('blog_background');
  $blog_section_desc = get_field('blog_section_description');

  echo '<div class="home-blog parallax-1" style="background-image: url(\'' . $background_img . '">';
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col-sm-12">';
  echo $blog_section_desc;      
  echo '</div>';           
    
    $blog_args = array();
    $blog_args = array('post_type' => 'post', 
                       'posts_per_page' => 3,
                       'post_status'    => 'publish',
                       'orderby'        => 'date',
                       'order'          => 'DESC'
                        );

    $blog_query = new WP_Query($blog_args);
      if( $blog_query -> have_posts() ):
        while( $blog_query -> have_posts() ): $blog_query -> the_post();

        $author = get_the_author();
        $blog_link = get_permalink();
        $blog_title = get_the_title();
        $date = get_the_time('M d Y');
        $blog_excerpt = custom_excerpt(get_the_excerpt(), 30); 

          echo '<div class="col-sm-4 first-blog">'; 
          echo '<div class="middle-img">';             
          echo '<a href="' . $blog_link . '">';
          echo has_post_thumbnail( get_the_ID() ) ? the_post_thumbnail('blog-post-front-image') : '<img width="360" height="128" src="'. get_template_directory_uri() .'/images/dummy-img-01.jpg" alt="' . $blog_title . '">';
          echo '</a>';                    
          echo '</div>';
          echo '<div class="date-dv">';
          echo '<div class="row">';
          echo '<div class="col-sm-5"><i class="fa fa-clock-o"></i>';
          echo $date;
          echo '</div>';
          echo '<div class="col-sm-5"><i class="fa fa-user" aria-hidden="true"></i>';
          echo $author;                          
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '<div class="blog-sec">';                     
          echo '<h3 class="text-title-3"><a href="' . $blog_link . '">' . $blog_title . '</a></h3>';                 
          echo '<p>' . $blog_excerpt . '</p>';
          echo '</div>';
          echo '<div class="read-more-dv">';
          echo '<a href="' . $blog_link . '">Read More</a>';               
          echo '</div>';                    
          echo '</div>';
        
        endwhile;

      echo '<div class="col-sm-12 meals">';
      echo '<a href="' . site_url() . '/prepd-blog" class="btn btn-view">View More</a>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';

      endif; 
                      
      wp_reset_postdata();            
                
echo '</main>';
    
get_footer(); ?>
