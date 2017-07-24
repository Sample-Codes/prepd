<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   3.0.0
 * This is a custom template, will need to be manually updated with woocommerce updates
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
   * woocommerce_before_single_product hook.
   *
   * @hooked wc_print_notices - 10
   */
   do_action( 'woocommerce_before_single_product' );

   if ( post_password_required() ) {
    echo get_the_password_form();
    return;
   }

$plan_id=$total_meals=$total_snacks=$selected_plan=$selected_plan_type= "";
$plan_id = $_REQUEST['plan_id'];


if(!empty($plan_id)){
  $total_meals   = get_post_meta($plan_id,'wpcf-meals-quantity',true);
  $total_snacks  = get_post_meta($plan_id,'wpcf-snacks-quantity',true);
  $selected_plan = "Choose ".$total_meals." meals and ".$total_snacks." snacks.";
}else{
  $total_meals   = 0;
  $total_snacks  = 0;
  $selected_plan = "Choose ".$total_meals." meals and ".$total_snacks." snacks.";
}

?>

<!---temp scripts -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.mixitup.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>

<div class="meals-plans-secction">
  <div class="container-fluid">
    <div class="row">
      <div class="left-choose-column">
        <!-- Left Column -->
        <div class="fixed-meals">
          Your total meals  &nbsp;<span id="selected-meals-count">0</span>/<span id="total-meals"><?php echo $total_meals; ?></span> <br />and Your total snacks &nbsp;<span id="selected-snacks-count">0</span>/<span id="total-snacks"><?php echo $total_snacks; ?></span>
        </div>
          <div class="add-remove-alert">
            <div id="choose-meal-plan" class="alert alert-warning alert-dismissible fade in" role="alert"> 
              <strong class=""><?php echo $selected_plan; ?></strong>
            </div>
            <div class="next-btn-section">
              <?php do_action( 'woocommerce_single_product_summary' ); ?>
            </div>
          </div>
      </div>
          <!-- Right Column -->
      <div class="right-meals-column">
        <div class="full-meals-pln">
          <div class="meals-nav">
            <div class="row">
              <div class="col-sm-6">
                <ul>
                  <li><a href="#entrees">Meals</a></li>
                  <li><a href="#breakfasts">Snacks</a></li>
                </ul>
              </div>
              <div class="col-sm-6">
                <div class="filter-drp">
                  <!-- Filter menu -->
                  <div class="menu-button" id="menu-button">Filter <span id="filter-count"></span></div>
                  <nav id="hide-menu" class="hide-menu">
                    <p>Filter out meals with:</p>
                    <div class="chk-box">
                      <!-- checkbox start -->
                          <form class="controls" id="Filters">
                <!-- We can add an unlimited number of "filter groups" using the following format: -->
                  <?php 
                        $meal_taxonomy = 'meal-category';  
                        $meal_terms = get_terms($meal_taxonomy,array('orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false)); 
                          echo '<fieldset>';
                              foreach($meal_terms as $meal_term) {  
                                  //echo '<label for="" class="btn btn-default filter meal-cat">'.$meal_term->name.'<input class="meal-term" type="checkbox" autocomplete="off" data-term-id="'.$meal_term->term_id.'" checked></label>';
                                  echo '<div class="checkbox"><input type="checkbox" value=".'.$meal_term->slug.'"/><label>'.$meal_term->name.'</label></div>';
                              }
                          echo '</fieldset>';
                  ?>
                      <button id="Reset">Clear Filters</button>
              </form>
                      <!-- checkbox end -->
                    </div>
                  </nav>
                  <!-- End Filter menu -->
                  </div>
                </div>
              </div>
              </div>
              <!-- end ul nav -->

              <div id="Container" class="container">
                <div class="fail-message"><span>No items were found matching the selected filters</span></div>
                <div class="col-sm-12 plans-head-gap" id="entrees"><h3>Meals</h3></div>
                <?php
                    
                    $checkout_meals = get_field('checkout_meals', 'option');
                      if( $checkout_meals ) :
                        foreach( $checkout_meals as $post ):
                          setup_postdata($post);

                        echo '<div class="col-sm-4 col-xs-6 mix' . get_term_slug_by_post_id(get_the_ID(), 'meal-category' ) . '">'; 
                        $term_slugs = wp_get_post_terms( get_the_ID(), 'meal-category' );
                            
                            foreach( $term_slugs as $term_slug ) {
                                $all_slugs =  ' '. $term_slug->slug; 
                            }

                          $meal_id = get_the_ID();
                          $meal_thumbnail = get_the_post_thumbnail_url();
                          $meal_title = get_the_title();
                          $meal_content = get_the_content();
                          $meal_second_image = get_the_post_thumbnail_url($meal_id, 'meal-detail-image' );

                          echo '<div class="min-meals-01">';
                          echo '<div class="quantity-input">';
                          echo '<input data-product="meal" type="button" id="adds-' . $meal_id . '" value="ADD" class="btn btn-default btn-plus" onclick="add(' . get_the_ID() . ')" data-meal-small-image="' . $meal_thumbnail .  '" data-meal-title="' . $meal_title . '" />';
                          echo '<input type="text" style="" class="onlyNumber form-control cnt-num pull-left" id="no-of-meals-' . $meal_id . '" value="0" name="no_of_meals" />';
                          echo '<input data-product="meal" type="button" id="subs-' . $meal_id . '" value="-" class="btn btn-default btn-dash pull-left" style="display:none;" onclick="remove(' . $meal_id . ')"  />';
                          echo '</div>';
                          echo '<div class="mid-image">';
                          echo '<a class="view-meals" data-post-id="' . $meal_id . '" data-post-title="' . $meal_title . '" data-desc=\'' . $meal_content . '\' data-toggle="modal" data-target="#meal-details" data-image="' . $meal_thumbnail . '">';
                     
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail('meal-image');
                            }  else {
                                echo '<img width="286px" height="191px" src="' . get_bloginfo( 'stylesheet_directory' ) 
                                    . '/images/dummy-img-01.jpg" />';
                            }

                          echo '</a>';
                          echo '</div>';
                          echo '<div class="meals-heading">';
                          echo '<a class="view-meals" data-post-id="' . $meal_id . '" data-post-title="' . $meal_title . '"  data-toggle="modal" data-target="#meal-details" data-image="' . $meal_second_image . '" ><p>' . $meal_title . '</p></a>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';

                        endforeach;
                      endif;
                  wp_reset_postdata();
                ?>
                <div class="clearfix"></div>
<?php // Snacks ?>  
                <div class="col-sm-12" id="breakfasts"><h3>Snacks</h3></div>
                 

                <?php
                    $checkout_snacks = get_field('checkout_snacks', 'option');
                      if( $checkout_snacks ) :
                        foreach( $checkout_snacks as $post ):
                          setup_postdata($post);

                    
                  echo '<div class="col-sm-4 col-xs-6 mix' . get_term_slug_by_post_id(get_the_ID(), 'meal-category' ) . '">'; 
                        $term_slugs = wp_get_post_terms( get_the_ID(), 'meal-category' );
                            
                            foreach( $term_slugs as $term_slug ) {
                                $all_slugs =  ' '.$term_slug->slug; 
                            }

                          $snack_id = get_the_ID();
                          $snack_thumbnail = get_the_post_thumbnail_url();
                          $snack_title = get_the_title();
                          $snack_content = get_the_content();
                          $meal_second_image = get_the_post_thumbnail_url($meal_id, 'meal-detail-image' );

                          echo '<div class="min-meals-01">';
                          echo '<div class="quantity-input">';
                          echo '<input data-product="snack" type="button" id="adds-' . $snack_id . '" value="ADD" class="btn btn-default btn-plus" onclick="add(' . $snack_id . ')" data-meal-small-image="' . $snack_thumbnail .  '" data-meal-title="' . $snack_title . '" />';
                          echo '<input type="text" style="" class="onlyNumber form-control cnt-num pull-left" id="no-of-meals-' . $snack_id . '" value="0" name="no_of_meals" />';
                          echo '<input data-product="snack" type="button" id="subs-' . $snack_id . '" value="-" class="btn btn-default btn-dash pull-left" style="display:none;" onclick="remove(' . $snack_id . ')"  />';
                          echo '</div>';
                          echo '<div class="mid-image">';
                          echo '<a class="view-meals" data-post-id="' . $snack_id . '" data-post-title="' . $snack_title . '" data-desc=\'' . $snack_content . '\' data-toggle="modal" data-target="#meal-details" data-image="' . $snack_thumbnail . '">';
                     
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail('meal-image');
                            }  else {
                                echo '<img width="286px" height="191px" src="' . get_bloginfo( 'stylesheet_directory' ) 
                                    . '/images/dummy-img-01.jpg" />';
                            }

                          echo '</a>';
                          echo '</div>';
                          echo '<div class="meals-heading">';
                          echo '<a class="view-meals" data-post-id="' . $snack_id . '" data-post-title="' . $snack_title . '"  data-toggle="modal" data-target="#meal-details" data-image="' . $meal_second_image . '" ><p>' . $snack_title . '</p></a>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';

                        endforeach;
                      endif;
                  wp_reset_postdata();
                ?>
                <!--<div class="gap"></div>
                <div class="gap"></div>
                <div class="gap"></div>
                <div class="gap"></div>-->
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  
<!-- Start : Code for meal detail modal -->
  <div class="modal fade" id="meal-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
          <h5 class="modal-title" id="meal-label">Three Bean Ancho Turkey Chili</h5>
            <a href="#" id="add-to-order" class="btn btn-popup pull-right">Add to order</a>
        </div>
        <div class="modal-body">
          <div class="modal-img" id="post-image"></div>
          <div id="post-desc">
              
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End : Code for meal detail modal -->  

