<?php
/**
 * Template Name: Weekly Menu List
 *
 */
get_header('banner'); 

$intro_content = get_the_content();
$weekly_meals = get_field('weekly_meals');
$weekly_snacks = get_field('weekly_snacks');

  echo '<main id="main" class="site-main" role="main">';
  echo '<div class="container">';

  echo '<div class="row leaf-column">';

  //this week's meals
  if( $weekly_meals ):

    echo '<div class="col-sm-6">';
    echo '<div class="square-box">';
    echo '<div class="circle-leaf"><i class="fa fa-cutlery" aria-hidden="true"></i></div>';
    echo '<div class="week-sch-menu">';
    echo '<h4>This Week\'s Meals</h4>';
      
    echo '<div>';
    echo '<ul class="mn-list">';

    foreach( $weekly_meals as $post):
      setup_postdata($post);

        $link = get_permalink();
        $title = get_the_title();

        echo '<li><a href="' . $link . '" class="name">' . $title . '</a></li>';
    
    endforeach;

    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';                            

    wp_reset_postdata();

  endif;

  //this week's snacks
  if( $weekly_snacks ):

    echo '<div class="col-sm-6">';
    echo '<div class="square-box">';
    echo '<div class="circle-leaf"><i class="fa fa-cutlery" aria-hidden="true"></i></div>';
    echo '<div class="week-sch-menu">';
    echo '<h4>This Week\'s Snacks</h4>';
      
    echo '<div>';
    echo '<ul class="mn-list">';

    foreach( $weekly_snacks as $post):
      setup_postdata($post);

        $link = get_permalink();
        $title = get_the_title();

        echo '<li><a href="' . $link . '" class="name">' . $title . '</a></li>';
    
    endforeach;

    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';                            

    wp_reset_postdata();

  endif; 

  echo '</div>';

  // content section
  echo '<div class="row">';
  echo '<div class="col-sm-12 txt-aligncenter">';
  echo $intro_content;
  echo '</div>';
  echo '</div>';
  echo '<hr>';
  echo '<p class="txt-aligncenter">Below are images of what’s on the menu this week! Click each image for details, including ingredient lists and nutrition facts.</p>';

  // meal images
  echo '<div class="row">';
  echo '<div class="col-sm-12">';
  echo '<h2>Meals</h2>';
  echo '</div>';
  
  if( $weekly_meals ):

    foreach( $weekly_meals as $post):
      setup_postdata($post);

      $link = get_permalink();
      $title = get_the_title();
  
      echo '<div class="col-sm-3 col-xs-6 portfolio">';
      echo '<div class="middle-img">';
      echo '<a href="' . $link . '">';

      if ( has_post_thumbnail() ) {
          the_post_thumbnail('meal-image');
        } else {
          echo '<img width="286px" height="191px" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/dummy-img-01.jpg" />';
        }

      echo '</a>';
      echo '<span class="caption-link">';
      echo '<a href="' . $link . '"><i class="fa fa-link"></i></a>';
      echo '</span>';
      echo '</div>';
      echo '<div class="full-menu-nm">';
      echo '<a href="' . $link . '" class="strongtext name">' . $title . '</a>';
      echo '</div>';
      echo '</div>';

    endforeach;
  
  endif;                
                    
  wp_reset_postdata();

  echo '</div>';

  // snack images
  echo '<div class="row">';
  echo '<div class="col-sm-12">';
  echo '<h2>Snacks</h2>';
  echo '</div>';
  
  if( $weekly_snacks ):

    foreach( $weekly_snacks as $post):
      setup_postdata($post);

      $link = get_permalink();
      $title = get_the_title();
  
      echo '<div class="col-sm-3 col-xs-6 portfolio">';
      echo '<div class="middle-img">';
      echo '<a href="' . $link . '">';

      if ( has_post_thumbnail() ) {
          the_post_thumbnail('meal-image');
        } else {
          echo '<img width="286px" height="191px" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/dummy-img-01.jpg" />';
        }

      echo '</a>';
      echo '<span class="caption-link">';
      echo '<a href="' . $link . '"><i class="fa fa-link"></i></a>';
      echo '</span>';
      echo '</div>';
      echo '<div class="full-menu-nm">';
      echo '<a href="' . $link . '" class="strongtext name">' . $title . '</a>';
      echo '</div>';
      echo '</div>';

    endforeach;
  
  endif;                
                    
  wp_reset_postdata();

  echo '</div>';

echo '</div>';          
echo '</main>';

get_footer('plans'); ?>