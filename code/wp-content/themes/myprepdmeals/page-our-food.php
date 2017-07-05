<?php

get_header('banner');

$intro_content = get_the_content();
$column_one = get_field('column_one');
$column_two = get_field('column_two');

echo '<main id="main" class="site-main" role="main">';

echo '<div class="container">';
echo $intro_content;
echo '<div class="row leaf-column">';
echo '<div class="col-sm-6">';
echo '<div class="square-box">';
echo '<div class="circle-leaf"><i class="fa fa-leaf"></i></div>';
echo $column_one;
echo '</div>';
echo '</div>';
echo '<div class="col-sm-6">';
echo '<div class="square-box">';
echo '<div class="circle-leaf"><i class="fa fa-leaf"></i></div>';
echo $column_two;
echo '</div>'; 
echo '</div>'; 
echo '</div>'; 
echo '</div>'; 

echo '</main>';

get_footer('plans'); ?>

?>