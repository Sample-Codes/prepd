<?php
/**
 * Template Name: Our Full Menu
 *
 */
get_header('banner');

$meals_content = get_field('meals_content');
$snacks_content = get_field('snacks_content');
$meal_taxonomy = 'meal-category';
$meal_terms = get_terms( $meal_taxonomy,array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false )); 

  // meals
  echo '<div class="full-menu-section">';
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col-sm-12 custom-tab">';
  echo '<div class="" id="portfoliolist">';
  echo '<div class="row">';
  echo '<div class="col-sm-12">';
  echo $meals_content;
  echo '</div>';
  
  // filter
  echo '<div class="filter-menu">';
  echo '<div class="col-sm-12">';
  echo '<ul id="" class="filters-menu">';
  echo '<li><span class="filter active" data-filter=".all">All</span></li>';

  foreach($meal_terms as $meal_term) {  
      echo '<li class="'.$meal_term->slug.'"><span class="filter" data-filter=".'. $meal_term->slug . '">' . $meal_term->slug . '</span></li>';
    } 

  echo '</ul>';
  echo '</div>';
  echo '</div>';
  echo '<div class="col-sm-12">';
  echo '<div class="row meal-filter" id="">';

  $meals = new WP_Query( array( 'post_type' => 'meal', 'posts_per_page' => -1, 'post_status' => array( 'publish', 'draft' )) );
    if ( $meals->have_posts() ) :
      while ( $meals->have_posts() ) : $meals->the_post();

        $link = get_permalink(); 
        $title = get_the_title();

        echo '<div class="portfolio col-sm-3 col-xs-6 all ' . get_menu_term_slug_by_post_id(get_the_ID(), 'meal-category' ) . '" data-cat="' . get_menu_term_slug_by_post_id(get_the_ID(), 'meal-category' ) . '">';
        echo '<div class="middle-img">';
        echo '<a href="' . $link . '">';
        echo get_the_post_thumbnail() ? the_post_thumbnail('meal-image') : '<div class="placeholder-img"><img width="286px" height="191px" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/dummy-img-01.jpg" /></div>';
        echo '</a>'; 
        echo '<span class="caption-link">';
        echo '<a href="' . $link . '"><i class="fa fa-link"></i></a>';                  
        echo '</span>';
        echo '</div>';
        echo '<div class="full-menu-nm">';
        echo '<a href="' . $link . '" class="strongtext name">' . $title . '</a>';
        echo '<div class="li-last">*</div>';
        echo '</div>';
        echo '</div>';
      
      endwhile;
    endif;
    
    wp_reset_postdata();

    echo '</div>';
    echo '</div>';
    echo '</div>';
    
  // snacks
  echo '<div class="row">';
  echo '<div class="col-sm-12">';
  echo $snacks_content;
  echo '</div>';
              
  // filter              
  echo '<div class="col-sm-12">';
  echo '<div class="row meal-filter" id="">';
  
  $meals = new WP_Query( array( 'post_type' => 'snack', 'posts_per_page' => -1, 'post_status' => 'publish') );
    if ( $meals->have_posts() ) :
      while ( $meals->have_posts() ) : $meals->the_post();

        $link = get_permalink();
        $title = get_the_title();
        // $image = get_the_post_thumbnail() ? the_post_thumbnail('meal-image') : '<div class="placeholder-img"><img width="286px" height="191px" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/dummy-img-01.jpg" /></div>';
        
        echo '<div class="col-sm-3 col-xs-6 portfolio all ' . get_menu_term_slug_by_post_id(get_the_ID(), 'meal-category' ) . '" data-cat="' . get_menu_term_slug_by_post_id(get_the_ID(), 'meal-category' ) . '">';
        echo '<div class="middle-img">';
        echo '<a href="' . $link . '">';
        echo get_the_post_thumbnail() ? the_post_thumbnail('meal-image') : '<div class="placeholder-img"><img width="286px" height="191px" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/dummy-img-01.jpg" /></div>';
        echo '</a>';
        echo '<span class="caption-link">';
        echo '<a href="' . $link . '"><i class="fa fa-link"></i></a>';
        echo '</span>';
        echo '</div>';
        echo '<div class="full-menu-nm">';
        echo '<a href="' . $link . '" class="strongtext name">' . $title . '</a>';
        echo '<div class="li-last">*</div>';
        echo '</div>';
        echo '</div>';
      
      endwhile;
    endif; 
    wp_reset_postdata();  
                             
    echo '</div>';
    echo '</div>';

    echo '<div class="col-sm-12">';
    echo wpautop(get_post_meta(get_the_ID(),'wpcf-full-menu-page-footer-description',true));
    echo '</div>';
    
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
                              
get_footer('banner'); ?>