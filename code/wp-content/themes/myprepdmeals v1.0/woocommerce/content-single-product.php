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

<script type="text/javascript">


// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "checkboxFilter".

var checkboxFilter = {
  
  // Declare any variables we will need as properties of the object
  
  $filters: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: '',
  
  // The "init" method will run on document ready and cache any jQuery objects we will need.
  
  init: function(){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.
    
    self.$filters = $('#Filters');
    self.$reset = $('#Reset');
    self.$container = $('#Container');
    
    self.$filters.find('fieldset').each(function(){
      self.groups.push({
        $inputs: $(this).find('input'),
        active: [],
        tracker: false
      });
    });
    
    self.bindHandlers();
  },
  
  // The "bindHandlers" method will listen for whenever a form value changes. 
  
  bindHandlers: function(){
    var self = this;
    
    self.$filters.on('change', function(){
      self.parseFilters();
    });
    
    self.$reset.on('click', function(e){
      e.preventDefault();
      self.$filters[0].reset();
      self.parseFilters();
    });
  },
  
  // The parseFilters method checks which filters are active in each group:
  
  parseFilters: function(){
    var self = this;
 
    // loop through each filter group and add active filters to arrays
    
    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = []; // reset arrays
      group.$inputs.each(function(){ 
        $(this).is(':checked') && group.active.push(this.value);
      });
      group.active.length && (group.tracker = 0);
    }
    
    self.concatenate();
  },
  
  // The "concatenate" method will crawl through each group, concatenating filters as desired:
  
  concatenate: function(){
    var self = this,
      cache = '',
      crawled = false,
      checkTrackers = function(){
        var done = 0;
        
        for(var i = 0, group; group = self.groups[i]; i++){
          (group.tracker === false) && done++;
        }

        return (done < self.groups.length);
      },
      crawl = function(){
        for(var i = 0, group; group = self.groups[i]; i++){
          group.active[group.tracker] && (cache += group.active[group.tracker]);

          if(i === self.groups.length - 1){
            self.outputArray.push(cache);
            cache = '';
            updateTrackers();
          }
        }
      },
      updateTrackers = function(){
        for(var i = self.groups.length - 1; i > -1; i--){
          var group = self.groups[i];

          if(group.active[group.tracker + 1]){
            group.tracker++; 
            break;
          } else if(i > 0){
            group.tracker && (group.tracker = 0);
          } else {
            crawled = true;
          }
        }
      };
    
    self.outputArray = []; // reset output array

    do{
      crawl();
    }
    while(!crawled && checkTrackers());

    self.outputString = self.outputArray.join();
    
    // If the output string is empty, show all rather than none:
    
    !self.outputString.length && (self.outputString = 'all'); 
    
    //console.log(self.outputString); 
    
    // ^ we can check the console here to take a look at the filter string that is produced
    
    // Send the output string to MixItUp via the 'filter' method:
    
    if(self.$container.mixItUp('isLoaded')){
      self.$container.mixItUp('filter', self.outputString);
    }
  }
};
  
// On document ready, initialise our code.

$(function(){
      
  // Initialize checkboxFilter code
      
  checkboxFilter.init();
      
  // Instantiate MixItUp
      
  jQuery('#Container').mixItUp({
    controls: {
      enable: false // we won't be needing these
    },
    animation: {
      easing: 'cubic-bezier(0.86, 0, 0.07, 1)',
      duration: 600
    }
  });    
});

jQuery(function(){
      
  // Initialize buttonFilter code
      
  buttonFilter.init();
      
  // Instantiate MixItUp
      
  jQuery('#Container').mixItUp({
    controls: {
      enable: false // we won't be needing these
    },
    callbacks: {
      onMixFail: function(){
        alert('No items were found matching the selected filters.');
      }
    }
  });    
});

</script>

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
  
<script type="text/javascript">

  jQuery('form.cart').append('<input type="hidden" id="meals-order" class="meals-order" name="meals_order" value="">');
     
   var selected_meal=selected_snack= 0;
   var selected_meal_cnt=selected_snack_cnt= "";

   jQuery('.single_add_to_cart_button').attr('disabled','disabled');
   jQuery('.product_meta').remove(); 
   //jQuery('[itemprop="description"]').remove(); 

  /* Start : Code to for meal quantity selection error */
  function quntity_selection_error(){
    var selected_meals_quantity=total_meals_quantity=remove_meals_quantity=total_snacks_quantity=selected_snacks_quantity=remove_snacks_quantity= "";
    selected_meals_quantity = jQuery('#selected-meals-count').text();
    selected_snacks_quantity= jQuery('#selected-snacks-count').text();
    total_meals_quantity    = jQuery('#total-meals').text();
    total_snacks_quantity   = jQuery('#total-snacks').text();

     if( (selected_meals_quantity == total_meals_quantity) && (selected_snacks_quantity == total_snacks_quantity)) {
          jQuery('.meal-error-msg').remove();
          jQuery('.snack-error-msg').remove();
          jQuery('.single_add_to_cart_button').removeAttr('disabled');
     }else{

        if(parseInt(selected_meals_quantity.trim()) > parseInt(total_meals_quantity.trim())){
           jQuery('.single_add_to_cart_button').attr('disabled','disabled');
           if(jQuery('.meal-error-msg').length <=0){
              jQuery('.quantity').before('<div id="meal-error-msg" class="meal-error-msg">Please remove 1 meal to proceed.</div>');
           }else{
                remove_meals_quantity = selected_meals_quantity-total_meals_quantity;
                jQuery('#meal-error-msg').text('Please remove '+remove_meals_quantity+' meal to proceed.');
           }
        }else{

          remove_meals_quantity = selected_meals_quantity-total_meals_quantity;
          if(remove_meals_quantity < total_meals_quantity){
            jQuery('.meal-error-msg').remove();
            jQuery('.single_add_to_cart_button').attr('disabled','disabled');
          }else{
            jQuery('#meal-error-msg').text('Please remove '+remove_meals_quantity+' meal to proceed.');
            jQuery('.single_add_to_cart_button').attr('disabled','disabled');
          }

        }


        if(parseInt(selected_snacks_quantity.trim()) > parseInt(total_snacks_quantity.trim())){

         jQuery('.single_add_to_cart_button').attr('disabled','disabled');
           if(jQuery('.snack-error-msg').length <=0){
              jQuery('.quantity').before('<div id="snack-error-msg" class="snack-error-msg">Please remove 1 snack to proceed.</div>');
           }else{
                remove_snacks_quantity = selected_snacks_quantity-total_snacks_quantity;
                jQuery('#snack-error-msg').text('Please remove '+remove_snacks_quantity+' snack to proceed.');
           }
           
        }else{

          remove_snacks_quantity = selected_snacks_quantity-total_snacks_quantity;
          if(remove_snacks_quantity < total_snacks_quantity){
            jQuery('.snack-error-msg').remove();
            jQuery('.single_add_to_cart_button').attr('disabled','disabled');
          }else{
            jQuery('#snack-error-msg').text('Please remove '+remove_snacks_quantity+' snack to proceed.');
            jQuery('.single_add_to_cart_button').attr('disabled','disabled');
          }

        }

     }

  }
  /* End : Code to for meal quantity selection error */

  /* Start : Code to add meal to left bar */
  function add(id){

    var meal_img=product="";
    product = jQuery("#adds-"+id).data("product");
    jQuery('#choose-meal-plan').remove();

    var input = jQuery('#no-of-meals-'+id),
        value = input.val();
        
    input.val(++value);
    
    if(value > 0){
      jQuery('#subs-'+id).removeAttr('disabled');
    }

    var default_img_url = "<?php echo get_template_directory_uri(); ?>/images/dummy-img-01.jpg";
    var meal_small_image_url = jQuery('#adds-'+id).data('meal-small-image');
    var meal_title = jQuery('#adds-'+id).data('meal-title');

    if(meal_small_image_url){
      meal_img = '<img src="'+meal_small_image_url+'" alt="" class="left-thm-img">';
    }else{
      meal_img = '<img width="60px" height="60px" src="'+default_img_url+'" alt="" class="left-thm-img">';
    }

    if(product == 'meal'){

      if(jQuery('#block-'+id).length <= 0){

        jQuery('.add-remove-alert').append('<div id="block-'+id+'" class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" onclick="remove_meal('+id+')"><span aria-hidden="true">×</span></button><input data-product="meal" type="button" value="+" id="add-qty-'+id+'" class="btn btn-default btn-inc" onclick="add_quantity('+id+')" />&nbsp;<input type="text" data-product-type="meal" style="width: 22px; height:18px; text-align: center; margin: -4px 0px 0px; border:0px; box-shadow:none;" class="onlyNumber form-control pull-left" id="no-of-quantity-'+id+'" value="1" name="no_of_quantity" />&nbsp;<input data-product="meal" type="button" value="-" id="sub-qty-'+id+'" class="btn btn-default btn-minus pull-left" style="margin-right: 2%" onclick="remove_quantity('+id+')"/><span class="counter-dv"></span>'+meal_img+'<strong class="my-meals-head">'+meal_title+'</strong><div class="clearfix"></div></div>');

      }else{
        jQuery('#no-of-quantity-'+id).val(value++);
      }

    }

    if(product == 'snack'){

      if(jQuery('#block-'+id).length <= 0){

        jQuery('.add-remove-alert').append('<div id="block-'+id+'" class="alert alert-warning alert-dismissible fade in" role="alert"><button data-product="snack" type="button" class="close" onclick="remove_meal('+id+')"><span aria-hidden="true">×</span></button><input type="button" value="+" id="add-qty-'+id+'" class="btn btn-default btn-inc" onclick="add_quantity('+id+')" />&nbsp;<input type="text" data-product-type="snack" style="width: 22px; height:18px; text-align: center; margin: -4px 0px 0px; border:0px; box-shadow:none;" class="onlyNumber form-control pull-left" id="no-of-quantity-'+id+'" value="1" name="no_of_quantity" />&nbsp;<input data-product="snack" type="button" value="-" id="sub-qty-'+id+'" class="btn btn-default btn-minus pull-left" style="margin-right: 2%" onclick="remove_quantity('+id+')"/><span class="counter-dv"></span>'+meal_img+'<strong class="my-meals-head">'+meal_title+'</strong><div class="clearfix"></div></div>');

      }else{
        jQuery('#no-of-quantity-'+id).val(value++);
      }
      
    }

      //alert(selected_meal_cnt);
      //var test = count_me(selected_meal);

      if(product == 'meal'){
         selected_meal_cnt = ++selected_meal;
         if(selected_meal_cnt > 0){
          jQuery('#selected-meals-count').text(selected_meal_cnt);
        }else{
          jQuery('#selected-meals-count').text(0);
        }
      }

      if(product == 'snack'){
        selected_snack_cnt = ++selected_snack;
         if(selected_snack_cnt > 0){
          jQuery('#selected-snacks-count').text(selected_snack_cnt);
        }else{
          jQuery('#selected-snacks-count').text(0);
        }
      }
      
      jQuery('#subs-'+id).css('display','block');
      jQuery('#no-of-meals-'+id).css('display','block');

      quntity_selection_error();
      jQuery('#meal-details').modal('hide');
  }

  
  /* End : Code to add meal to left bar */

  /* Start : Code to remove meal from left bar */
  function remove(id){
     var val_cnt= 0;
     var product="";
     product = jQuery("#adds-"+id).data("product");
     var input = jQuery('#no-of-meals-'+id),
         value = input.val();
        
     if(value > 0){
       input.val(--value);
     }else{
      
    }

    jQuery('#no-of-quantity-'+id).val(value--);
    val_cnt = jQuery('#no-of-meals-'+id).val();

    if(val_cnt == 0){
        jQuery("#block-"+id).remove();
        jQuery("#subs-"+id).css('display','none');
        jQuery("#no-of-meals-"+id).css('display','none');
    }

     if(product == 'meal'){
         selected_meal_cnt = --selected_meal;
         if(selected_meal_cnt > 0){
          jQuery('#selected-meals-count').text(selected_meal_cnt);
        }else{
          jQuery('#selected-meals-count').text(0);
        }
      }

      if(product == 'snack'){
        selected_snack_cnt = --selected_snack;
         if(selected_snack_cnt > 0){
          jQuery('#selected-snacks-count').text(selected_snack_cnt);
        }else{
          jQuery('#selected-snacks-count').text(0);
        }
      }
      
      quntity_selection_error();
  }
   /* End : Code to remove meal from left bar */

  /* Start : Code to increment meal quantity of left bar */
  function add_quantity(id){
    var product="";
    product = jQuery("#adds-"+id).data("product");

    var input = jQuery('#no-of-quantity-'+id),
        value = input.val();
        
    input.val(++value);

    jQuery('#no-of-meals-'+id).val(value++)
    
    if(value > 0){
      jQuery('#subs-qty'+id).removeAttr('disabled');
    }

      if(product == 'meal'){
         selected_meal_cnt = ++selected_meal;
         if(selected_meal_cnt > 0){
          jQuery('#selected-meals-count').text(selected_meal_cnt);
        }else{
          jQuery('#selected-meals-count').text(0);
        }
      }

      if(product == 'snack'){
        selected_snack_cnt = ++selected_snack;
         if(selected_snack_cnt > 0){
          jQuery('#selected-snacks-count').text(selected_snack_cnt);
        }else{
          jQuery('#selected-snacks-count').text(0);
        }
      }

      quntity_selection_error();
  }
  /* End : Code to increment meal quantity of left bar */

  /* Start : Code to decrement meal quantity of left bar */
  function remove_quantity(id){
     var product="";
     product = jQuery("#adds-"+id).data("product");
     var val_cnt = 0;
     var input = jQuery('#no-of-quantity-'+id),
         value = input.val();
        
     if(value > 0){
       input.val(--value);
     }else{
       jQuery('#subs-qty-'+id).attr('disabled','disabled');
       
    }

   jQuery('#no-of-meals-'+id).val(value--);
   val_cnt = jQuery('#no-of-meals-'+id).val();

    if(val_cnt == 0){
        jQuery("#block-"+id).remove();
        jQuery("#subs-"+id).css('display','none');
        jQuery("#no-of-meals-"+id).css('display','none');
    }

      if(product == 'meal'){
         selected_meal_cnt = --selected_meal;
         if(selected_meal_cnt > 0){
          jQuery('#selected-meals-count').text(selected_meal_cnt);
        }else{
          jQuery('#selected-meals-count').text(0);
        }
      }

      if(product == 'snack'){
        selected_snack_cnt = --selected_snack;
         if(selected_snack_cnt > 0){
          jQuery('#selected-snacks-count').text(selected_snack_cnt);
        }else{
          jQuery('#selected-snacks-count').text(0);
        }
      }
      
      quntity_selection_error();
  }
  /* End : Code to decrement meal quantity of left bar */

  /* Start : Code to selected meal from left bar */
  function remove_meal(id){
    var product="";
    product = jQuery("#adds-"+id).data("product");

    var selected_meal_quantity=selected_snack_quantity=total_selected_meals_quantity=total_meals_quantity=total_remaining_meal_quantity=total_snacks_quantity=total_selected_snacks_quantity=total_remaining_snack_quantity= "";

    total_selected_meals_quantity = jQuery('#selected-meals-count').text();
    total_selected_snacks_quantity= jQuery('#selected-snacks-count').text();
    total_meals_quantity          = jQuery('#total-meals').text();
    total_snacks_quantity         = jQuery('#total-snacks').text();
    

    if(product == 'meal'){
        selected_meal_quantity        = jQuery('#no-of-quantity-'+id).val();
        total_remaining_meal_quantity = total_selected_meals_quantity-selected_meal_quantity;

        jQuery("#block-"+id).remove();
        jQuery('#no-of-meals-'+id).val(0);
        jQuery('#no-of-quantity-'+id).val(0);

        selected_meal_cnt = selected_meal-selected_meal_quantity;
        selected_meal = selected_meal_cnt;
          
        if(selected_meal_cnt > 0){
          jQuery('#selected-meals-count').text(selected_meal_cnt);
        }else{
          jQuery('#selected-meals-count').text(0);
        }
    }


    if(product == 'snack'){
        selected_snack_quantity        = jQuery('#no-of-quantity-'+id).val();
        total_remaining_snack_quantity = total_selected_snacks_quantity-selected_snack_quantity;

        jQuery("#block-"+id).remove();
        jQuery('#no-of-meals-'+id).val(0);
        jQuery('#no-of-quantity-'+id).val(0);

        selected_snack_cnt = selected_snack-selected_snack_quantity;
        selected_snack     = selected_snack_cnt;
          
        if(selected_snack_cnt > 0){
          jQuery('#selected-snacks-count').text(selected_snack_cnt);
        }else{
          jQuery('#selected-snacks-count').text(0);
        }

    }


    quntity_selection_error();
    
  }
  /* End : Code to selected meal from left bar */

  // Start : Code for "continue/Sign uo Now" (add_to_cart_button) button 
  jQuery(".single_add_to_cart_button").click(function() {
    var meals=snacks=meals_list=snacks_list= "";
    var parent_div = jQuery('.add-remove-alert');
    var total_child_div  = parent_div.find('div.alert').length;
    jQuery( "div.alert" ).each(function( index ) {
        var meal_name     = jQuery(this).find(".my-meals-head").text();
        var meal_quantity = jQuery(this).find("input.onlyNumber").val();
        var meal_type = jQuery(this).find("input.onlyNumber").data('product-type');
        
        if(meal_type == 'meal'){
          meals_list += meal_name+' × '+meal_quantity+', ';
        }
        if(meal_type == 'snack'){
          snacks_list += meal_name+' × '+meal_quantity+', ';
        }
  });
      meals = meals_list.replace(/,\s*$/, ".");
      snacks = snacks_list.replace(/,\s*$/, ".");
     jQuery('#meals-order').val("<b>Meals : </b>"+meals+" <br/> <b>Snacks : </b>"+snacks);
  }); 
  // End : Code for "continue/Sign uo Now" (add_to_cart_button) button 

var filter_cnt = 0; 
jQuery('.meal-cat').click(function() {
  
  if( jQuery( this ).hasClass( "active" ) ) {
    jQuery(this).removeClass('active');
  }else{
    jQuery(this).addClass('active');
  }
});

</script>


<!-- Filter Script -->
<script type="text/javascript">

 jQuery('#menu-button').click(function(e){
    e.stopPropagation();
     jQuery('#hide-menu').toggleClass('show-menu');
});
jQuery('#hide-menu').click(function(e){
    e.stopPropagation();
});
jQuery('body,html').click(function(e){
       jQuery('#hide-menu').removeClass('show-menu');
});

/* Start : Code for modal popup */
jQuery('.view-meals').on('click', function(evt) {
  var post_title=post_desc=post_image=default_img_url=post_id= "";
    post_title  = jQuery(this).data('post-title');
    post_desc   = jQuery(this).data('desc');
    post_image  = jQuery(this).data('image');
    post_id     = jQuery(this).data('post-id');

    jQuery('#add-to-order').attr('onClick','add('+post_id+')');
    jQuery('#meal-label').text(post_title);
      var default_img_url = "<?php echo get_template_directory_uri(); ?>/images/dummy-img-01.jpg";
        if(post_image){
          jQuery('#post-image').html('<img src="'+post_image+'"/>');
        }else{
          jQuery('#post-image').html('<img width="568px" height="379px" src="'+default_img_url+'" />');
        }
    jQuery('#post-desc').html(post_desc);
});
/* End : Code for modal popup */

</script>

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

