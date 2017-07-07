<?php

get_header('banner');

$intro_content = get_the_content();
$column_one = get_field('feature_box_one');
$column_two = get_field('feature_box_two');
$column_three = get_field('feature_box_three');

echo '<div id="primary" class="content-area content-all-page">';
echo '<main id="main" class="site-main" role="main">';

echo '<div class="container">';
echo $intro_content;

echo '<div class="row leaf-column">';

echo '<div class="col-sm-4">';
echo '<div class="square-box">';
echo '<div class="circle-leaf"><i class="fa fa-leaf"></i></div>';
echo $column_one;
echo '</div>';
echo '</div>';

echo '<div class="col-sm-4">';
echo '<div class="square-box">';
echo '<div class="circle-leaf"><i class="fa fa-leaf"></i></div>';
echo $column_two;
echo '</div>'; 
echo '</div>'; 

echo '<div class="col-sm-4">';
echo '<div class="square-box">';
echo '<div class="circle-leaf"><i class="fa fa-leaf"></i></div>';
echo $column_three;
echo '</div>'; 
echo '</div>';

echo '</div>'; // row

echo '</div>'; // container

echo '</main>';
echo '</div>';

get_footer('plans'); ?>