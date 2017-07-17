<?php
/**
 * Template Name: How It Works
 *
 */
get_header('banner');

$how_it_works_image = get_field('how_it_works_image');
$section_one = get_field('content_section_one');
$section_two_image = get_field('section_two_image');
$section_two = get_field('content_section_two');
$background_image = get_field('section_three_background_image');
$section_three = get_field('content_section_three');

  // how it works image
  echo '<div class="work-section">';
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col-sm-12 wow bounceInLeft">';
  echo '<img src="' . $how_it_works_image . '" alt="how it works">';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';

  // content section one
  echo '<div class="pick-plan parallax-2">';
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col-sm-12 wow fadeIn">';
  echo $section_one;
  echo '</div>';
  echo '<div class="col-sm-12">';
  echo '<div class="text-xs-center" id="example-caption-1">Standard Plan</div>';
  echo '<div class="progress">';
  echo '<div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">';
  echo '</div>';
  echo '</div>';
  echo '<div class="text-xs-center" id="example-caption-2">Fuel Plan</div>';
  echo '<div class="progress">';
  echo '<div class="progress-bar progress-bar-full" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '<div class="col-sm-12 middle-img">';
  echo '<a href="' . site_url() . '/meal-plans/" class="btn btn-plan">Pick Your Plan</a>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
    
  //content section two
  echo '<div class="pick-meals">';
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col-sm-5">';
  echo '<img src="' . $section_two_image . '" alt="" width="768" height="521" class="size-full wp-image-10071" />';
  echo '</div>';
  echo '<div class="col-sm-7">';
  echo $section_two;
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';

  // content section three
  echo '<div class="pick-plan parallax-3" style="background: url(\'' . $background_image . '\')">';
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col-sm-12 wow fadeIn">';
  echo '<h2 class="text-title-2">Have a Powerful Week</h2>';
  echo '<p>The first half of your delivery will arrive between 4 and 7 a.m. Monday morning, and the second half will arrive Thursday morning. Simply leave your empty bag and ice packs outside the night before delivery, and you’ll wake up to delicious, nutritious food to start your week off on the right foot!</p>';
  echo '<p>We get it – you’re busy. And we want you to stay busy with the things you love, without having to sacrifice the type of nutrition that’s going to help you do them. With Prep’d, you can cross “meal prep” off your to-do list, and then conquer the rest of that list at your highest possible level.</p>';
  echo '<p>No matter how you fill your busy schedule, Prep’d will fill your fridge with the food you need to fuel it. <a class="bl-link" href="http://www.myprepdmeals.com/meal-plans/">Get started</a> today, and tackle your week like the warrior you are.</p>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
     
get_footer('plans'); ?>