<?php
/**
 * Template Name: Weekly Menu
 *
 */
get_header('banner'); 

$intro_content = get_the_content();
$menu_deadline_one = get_field('menu_deadline_one');
$menu_deadline_two = get_field('menu_deadline_two');
$menu_deadline_three = get_field('menu_deadline_three');

  echo '<main id="main" class="site-main" role="main">';

  // content section
  echo '<div class="weekly-menus">';
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col-sm-12">';
  echo $intro_content;
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';

  echo '<div class="container">';
  echo '<div class="row leaf-column">';
  
  // column 1
  if( $menu_deadline_one ) :

    echo '<div class="col-sm-4">';
    echo '<div class="square-box">';
    echo '<div class="circle-leaf"><i class="fa fa-cutlery" aria-hidden="true"></i></div>';
    echo $menu_deadline_one;
    echo '</div>';
    echo '</div>';
  
  endif;    

  // column 2
  if( $menu_deadline_two ) :

    echo '<div class="col-sm-4">';
    echo '<div class="square-box">';
    echo '<div class="circle-leaf"><i class="fa fa-cutlery" aria-hidden="true"></i></div>';
    echo $menu_deadline_two;
    echo '</div>';
    echo '</div>';
  
  endif;  

  // column 3
  if( $menu_deadline_three ) :

    echo '<div class="col-sm-4">';
    echo '<div class="square-box">';
    echo '<div class="circle-leaf"><i class="fa fa-cutlery" aria-hidden="true"></i></div>';
    echo $menu_deadline_three;
    echo '</div>';
    echo '</div>';

  endif;   

  echo '</div>';
  echo '</div>';
          
echo '</main>';

get_footer('plans'); ?>