<?php
require_once ('../../../../wp-load.php');
global $wpdb;
$post_id = "";
$product_arr= array();
$post_id = $_REQUEST['post_id'];
$post = get_post($post_id); 


//echo '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button><h5 class="modal-title" id="myModalLabel">'.the_title().'</h5><a href="#" class="btn btn-popup pull-right">Add to order</a></div><div class="modal-body"><div class="modal-img">'.the_post_thumbnail("full").'</div><div><p>'.the_content().'</p></div></div>';
echo '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button><h5 class="modal-title" id="myModalLabel">'.the_title().'</h5><a href="#" class="btn btn-popup pull-right">Add to order</a></div><div class="modal-body"><div class="modal-img">'.the_post_thumbnail('meal-detail-image').'</div><div>'.the_excerpt().'</div></div>';

wp_reset_postdata();
