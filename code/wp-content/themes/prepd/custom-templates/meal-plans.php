<?php
/**
 * Template Name: Meal Plans
 *
 */

get_header('banner'); ?>

    <div class="work-section">
      <div class="container">
        <form id="plan-form" action="">
            <div class="row">
              <div class="col-sm-12">
              <h2>How many meals per week?</h2>
              <p style="font-family: Nothing You Could Do, cursive; font-size: 20px; text-align:center;"> -price will be reflected depending on selections below- </p>

              <?php 

                $fuel_category = get_term_by( 'slug', 'fuel-plan', 'product_cat' );
                $fuel_cat_id = $fuel_category->term_id;

                $standard_category = get_term_by( 'slug', 'standard-plan', 'product_cat' );
                $standard_cat_id = $standard_category->term_id;

                $args = array(
                  'post_type' => 'product',
                  'orderby' => 'date',
                  'order' => 'DESC',
                  'tax_query' => array(
                      array(
                          'taxonomy' => 'product_cat',
                          'field' => 'term_id',
                          'terms' =>  array($fuel_cat_id,$standard_cat_id),
                      )
                  ),
                  'meta_query'  => array(
                      array(
                          'key' => 'wpcf-display-on-prep-d-pricing-page',
                          'value' => 1
                      )
                  ),  
               );

                $plans = new WP_Query($args);

                if($plans->have_posts()) {
                  $price=$subscription_period=$meals_quantity=$snacks_quantity=$post_id= "";   
                  $term_ids = array();
                  while($plans->have_posts()) : $plans->the_post();

                  $post_id             = get_the_ID(); 
                  $price               = get_post_meta( get_the_ID(), '_subscription_price', true);
                  $subscription_period = get_post_meta( get_the_ID(), '_subscription_period', true);
                  $meals_quantity      = get_post_meta( get_the_ID(), 'wpcf-meals-quantity', true);
                  $snacks_quantity     = get_post_meta( get_the_ID(), 'wpcf-snacks-quantity', true);

                  $term_ids = wp_get_post_terms($post_id, 'product_cat', array("fields" => "ids"));
                ?>

                <?php
                  if($meals_quantity == 5 && $snacks_quantity == 10){
                    if(in_array($standard_cat_id, $term_ids)){
                ?>
                  <div class="col-sm-4">
                    <div id="plain-bg-<?php echo $post_id; ?>" class="plain-bg leaf-bg">
                     <label>
                        <input type="radio" id="standard-snacks-meals-plan-<?php echo $post_id; ?>" name="standard_snacks_meals_plan" value="" data-standard-post-id="<?php echo $post_id; ?>" data-standard-price="<?php echo $price; ?>" data-standard-subscription="<?php echo $subscription_period; ?>" data-standard-meals-quantity="<?php echo $meals_quantity; ?>" data-standard-snacks-quantity="<?php echo $snacks_quantity; ?>" data-standard-plan-quantity="<?php echo $meals_quantity; ?>_<?php echo $snacks_quantity; ?>"  data-standard-plan-url="<?php echo get_permalink($post_id); ?>" >
                        <div class="option-1"><?php echo $meals_quantity; ?></div> <div class="option-2">+ <?php echo $snacks_quantity; ?> Snacks</div>
                     </label>
                    </div>
                  </div>
                  <?php } ?>

                  <?php if(in_array($fuel_cat_id, $term_ids)){ ?>
                      <input type="hidden" id="fuel_snacks_meals_plan_<?php echo $meals_quantity; ?>_<?php echo $snacks_quantity; ?>" name="fuel_snacks_meals_plan_<?php echo $post_id; ?>" value="" data-fuel-post-id="<?php echo $post_id; ?>" data-fuel-price="<?php echo $price; ?>" data-fuel-subscription="<?php echo $subscription_period; ?>" data-fuel-meals-quantity="<?php echo $meals_quantity; ?>" data-fuel-snacks-quantity="<?php echo $snacks_quantity; ?>" data-fuel-plan-url="<?php echo get_permalink($post_id); ?>">
                  <?php } 
                      } 
                  ?>

                 <?php
                  if($meals_quantity == 10 && $snacks_quantity == 10){
                    if(in_array($standard_cat_id, $term_ids)){
                ?>
                  <div class="col-sm-4">
                      <div id="plain-bg-<?php echo $post_id; ?>" class="plain-bg leaf-bg">
                        <label>
                          <input type="radio" id="standard-snacks-meals-plan-<?php echo $post_id; ?>" name="standard_snacks_meals_plan" value="" data-standard-post-id="<?php echo $post_id; ?>" data-standard-price="<?php echo $price; ?>" data-standard-subscription="<?php echo $subscription_period; ?>" data-standard-meals-quantity="<?php echo $meals_quantity; ?>" data-standard-snacks-quantity="<?php echo $snacks_quantity; ?>" data-standard-plan-quantity="<?php echo $meals_quantity; ?>_<?php echo $snacks_quantity; ?>" data-standard-plan-url="<?php echo get_permalink($post_id); ?>">
                          <div class="option-1"><?php echo $meals_quantity; ?></div> <div class="option-2">+ <?php echo $snacks_quantity; ?> Snacks</div>
                       </label>
                      </div>
                  </div>
                  <?php } ?>

                  <?php if(in_array($fuel_cat_id, $term_ids)){ ?>
                       <input type="hidden" id="fuel_snacks_meals_plan_<?php echo $meals_quantity; ?>_<?php echo $snacks_quantity; ?>" name="fuel_snacks_meals_plan_<?php echo $post_id; ?>" value="" data-fuel-post-id="<?php echo $post_id; ?>" data-fuel-price="<?php echo $price; ?>" data-fuel-subscription="<?php echo $subscription_period; ?>" data-fuel-meals-quantity="<?php echo $meals_quantity; ?>" data-fuel-snacks-quantity="<?php echo $snacks_quantity; ?>" data-fuel-plan-url="<?php echo get_permalink($post_id); ?>">
                  <?php } 
                    }
                  ?>


                <?php
                  if($meals_quantity == 15 && $snacks_quantity == 10){
                    if(in_array($standard_cat_id, $term_ids)){
                ?>
                  <div class="col-sm-4">
                      <div id="plain-bg-<?php echo $post_id; ?>" class="plain-bg leaf-bg">
                        <label>
                          <input type="radio" id="standard-snacks-meals-plan-<?php echo $post_id; ?>" name="standard_snacks_meals_plan" value="" data-standard-post-id="<?php echo $post_id; ?>" data-standard-price="<?php echo $price; ?>" data-standard-subscription="<?php echo $subscription_period; ?>" data-standard-meals-quantity="<?php echo $meals_quantity; ?>" data-standard-snacks-quantity="<?php echo $snacks_quantity; ?>" data-standard-plan-quantity="<?php echo $meals_quantity; ?>_<?php echo $snacks_quantity; ?>" data-standard-plan-url="<?php echo get_permalink($post_id); ?>">
                          <div class="option-1"><?php echo $meals_quantity; ?></div> <div class="option-2">+ <?php echo $snacks_quantity; ?> Snacks</div>
                       </label>
                      </div>
                  </div>
                  <?php } ?>

                  <?php if(in_array($fuel_cat_id, $term_ids)){ ?>
                      <input type="hidden" id="fuel_snacks_meals_plan_<?php echo $meals_quantity; ?>_<?php echo $snacks_quantity; ?>" name="fuel_snacks_meals_plan_<?php echo $post_id; ?>" value="" data-fuel-post-id="<?php echo $post_id; ?>" data-fuel-price="<?php echo $price; ?>" data-fuel-subscription="<?php echo $subscription_period; ?>" data-fuel-meals-quantity="<?php echo $meals_quantity; ?>" data-fuel-snacks-quantity="<?php echo $snacks_quantity; ?>" data-fuel-plan-url="<?php echo get_permalink($post_id); ?>">
                  <?php }  
                    } 
                  ?>


              <?php 
                endwhile; 
                } 
              ?>

              </div>
            
              <div style="display:none;" id="plan-type-div" class="row">
                <div id="hungry-div"  class="col-sm-12">
                <button type="reset" class="btn btn-next" value="Reset" id="reset">Reset Options</button>
                <p>&nbsp;</p>
                <h2>How Hungry Are You?</h2>
                <p style="font-family: Nothing You Could Do, cursive; font-size: 20px; text-align:center;"> - pick your meal portion size -</p>
                  <div class="col-sm-2">&nbsp;</div>
                  <div class="col-sm-4">
                      <div id="standard-plain-bg" class="plain-bg">
                        <label><input type="radio" id="standard-plan-type" name="plan_type" value="standard" data-post-id="" data-price="" data-subscription="" data-meals-quantity="" data-snacks-quantity="" >
                        <div class="option-pln">Standard</div>
						<div class="std-pln-details">4 oz. protein<br> propotional sides <br> 300-500 cal.</div>
                        </label>
                      </div>
                      <div class="hover-tool"><a href="#" data-toggle="tooltip" title="For the lighter eater. 4 oz of a protein and propotional sides. 300 to 500 calories">?</a></div>
                  </div>

                  <div class="col-sm-4">
                      <div id="fuel-plain-bg" class="plain-bg">
                       <label><input type="radio" id="fuel-plan-type" name="plan_type" value="fuel" data-post-id="" data-price="" data-subscription="" data-meals-quantity="" data-snacks-quantity="">
                       <div class="option-pln">Fuel</div>
                       <div class="std-pln-details">6 oz. protein<br> propotional sides <br> 450-700 cal.</div>
                       </label>
                      </div>
					  <div class="hover-tool"><a href="#" data-toggle="tooltip" title="For the heartier eater. 6 oz of a protein and propotional sides. 450 to 700 calories">?</a></div>

                  </div>
                </div>
                  
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <p><span id="plan-type-error"></span></p>
                  <div class="final-total"> Final total $ <span id="plan-price"></span> / each <span id="plan-subscription"></span></div>
                   <button type="submit" class="btn btn-next" value="Submit" id="submit">NEXT</button>
                </div>
              </div>

            </div>
        </form>
      </div>
    </div>

<script type="text/javascript">
  jQuery(document).ready(function() {

     //Start : code for snacks and meals plan radio change
    jQuery('input[type=radio][name=standard_snacks_meals_plan]').change(function() {

      jQuery('input[type=radio][name=plan_type]').attr('checked', false); // Unchecks it

      jQuery('#plan-type-div').css('display','block');

      var standard_post_id        = jQuery(this).data( "standard-post-id" );
      var standard_price          = jQuery(this).data( "standard-price" );
      var standard_subscription   = jQuery(this).data( "standard-subscription" );
      var standard_meals_quantity = jQuery(this).data( "standard-meals-quantity" );
      var standard_snacks_quantity= jQuery(this).data( "standard-snacks-quantity" );
      var standard_plan_quantity  = jQuery(this).data( "standard-plan-quantity" );
      var standard_plan_url       = jQuery(this).data( "standard-plan-url" );

      var fuel_post_id        = jQuery("#fuel_snacks_meals_plan_"+standard_plan_quantity).data( "fuel-post-id" );
      var fuel_price          = jQuery("#fuel_snacks_meals_plan_"+standard_plan_quantity).data( "fuel-price" );
      var fuel_subscription   = jQuery("#fuel_snacks_meals_plan_"+standard_plan_quantity).data( "fuel-subscription" );
      var fuel_meals_quantity = jQuery("#fuel_snacks_meals_plan_"+standard_plan_quantity).data( "fuel-meals-quantity" );
      var fuel_snacks_quantity= jQuery("#fuel_snacks_meals_plan_"+standard_plan_quantity).data( "fuel-snacks-quantity" );
      var fuel_plan_url       = jQuery("#fuel_snacks_meals_plan_"+standard_plan_quantity).data( "fuel-plan-url" );
      
      jQuery( '#standard-plan-type' ).attr( "data-post-id", standard_post_id );
      jQuery( '#standard-plan-type' ).attr( "data-price", standard_price );
      jQuery( '#standard-plan-type' ).attr( "data-subscription", standard_subscription );
      jQuery( '#standard-plan-type' ).attr( "data-meals-quantity", standard_meals_quantity );
      jQuery( '#standard-plan-type' ).attr( "data-snacks-quantity", standard_snacks_quantity );
      jQuery( '#standard-plan-type' ).attr( "data-url", standard_plan_url );


      jQuery( '#fuel-plan-type' ).attr( "data-post-id", fuel_post_id );
      jQuery( '#fuel-plan-type' ).attr( "data-price", fuel_price );
      jQuery( '#fuel-plan-type' ).attr( "data-subscription", fuel_subscription );
      jQuery( '#fuel-plan-type' ).attr( "data-meals-quantity", fuel_meals_quantity );
      jQuery( '#fuel-plan-type' ).attr( "data-snacks-quantity", fuel_snacks_quantity );
      jQuery( '#fuel-plan-type' ).attr( "data-url", fuel_plan_url );

      jQuery('#plan-price').text(standard_price);
      jQuery('#plan-subscription').text(standard_subscription);

      jQuery("div.plain-bg").css('box-shadow', '');
      if(jQuery('#standard-snacks-meals-plan-'+standard_post_id).is(':checked')) { 
         jQuery("div#plain-bg-"+standard_post_id).css('box-shadow', '0px 0px 0px 3px rgba(0, 0, 0, 1)');
      }else{
         jQuery("div.plain-bg").css('box-shadow', '');
      }

      jQuery('html, body').animate({
        scrollTop: jQuery("#hungry-div").offset().top
      }, 1000);

    });
    //End : code for snacks and meals plan radio change

    //start : code for plan type radio change
    jQuery('input[type=radio][name=plan_type]').change(function() {

          jQuery("div#standard-plain-bg").css('box-shadow', '');
          jQuery("div#fuel-plain-bg").css('box-shadow', '');

          if(jQuery(this).val() == 'standard'){

            var post_id        = jQuery('#standard-plan-type').attr( "data-post-id" );
            var price          = jQuery('#standard-plan-type').attr( "data-price" );
            var subscription   = jQuery('#standard-plan-type').attr( "data-subscription" );
            var meals_quantity = jQuery('#standard-plan-type').attr( "data-meals-quantity" );
            var snacks_quantity= jQuery('#standard-plan-type').attr( "data-snacks-quantity" );
            var url            = jQuery('#standard-plan-type').attr( "data-url" );

             jQuery('#plan-price').text(price);
             jQuery('#plan-subscription').text(subscription);

             jQuery("div#standard-plain-bg").css('box-shadow', '0px 0px 0px 3px rgba(0, 0, 0, 1)');

          }

          if(jQuery(this).val() == 'fuel'){

            var post_id        = jQuery('#fuel-plan-type').attr( "data-post-id" );
            var price          = jQuery('#fuel-plan-type').attr( "data-price" );
            var subscription   = jQuery('#fuel-plan-type').attr( "data-subscription" );
            var meals_quantity = jQuery('#fuel-plan-type').attr( "data-meals-quantity" );
            var snacks_quantity= jQuery('#fuel-plan-type').attr( "data-snacks-quantity" );
            var url            = jQuery('#fuel-plan-type').attr( "data-url" );

            jQuery('#plan-price').text(price);
            jQuery('#plan-subscription').text(subscription);

            jQuery("div#fuel-plain-bg").css('box-shadow', '0px 0px 0px 3px rgba(0, 0, 0, 1)');
            
          }

          jQuery('html, body').animate({
            scrollTop: jQuery("#standard-plain-bg").offset().top
          }, 1000);
    });
    //End : code for plan type radio change

    //start : code for submit options.

    //jQuery('form#plan-form').submit(function(event) {
    jQuery('#submit').on('click',function(e){

      var url=plan_url=post_id=price=subscription=meals_quantity=snacks_quantity=selected_plan_type="";
    
      jQuery('#plan-type-error').text(''); 

      if(jQuery("input:radio[name='plan_type']").is(":checked")) {

         //if(jQuery("input:radio[name='plan_type']").val() == 'standard'){.
          if(jQuery("input:radio[name='plan_type']:checked","#plan-form").val() == 'standard'){

            post_id        = jQuery('#standard-plan-type').attr( "data-post-id" );
            price          = jQuery('#standard-plan-type').attr( "data-price" );
            subscription   = jQuery('#standard-plan-type').attr( "data-subscription" );
            meals_quantity = jQuery('#standard-plan-type').attr( "data-meals-quantity" );
            snacks_quantity= jQuery('#standard-plan-type').attr( "data-snacks-quantity" );
            url            = jQuery('#standard-plan-type').attr( "data-url" );
            selected_plan_type      = "standard_plan";
            plan_url = url+"?plan_type="+selected_plan_type+"&plan_id="+post_id;

            //alert(plan_url+"===standard_plan");
          }

          if(jQuery("input:radio[name='plan_type']:checked","#plan-form").val() == 'fuel'){

            post_id        = jQuery('#fuel-plan-type').attr( "data-post-id" );
            price          = jQuery('#fuel-plan-type').attr( "data-price" );
            subscription   = jQuery('#fuel-plan-type').attr( "data-subscription" );
            meals_quantity = jQuery('#fuel-plan-type').attr( "data-meals-quantity" );
            snacks_quantity= jQuery('#fuel-plan-type').attr( "data-snacks-quantity" );
            url            = jQuery('#fuel-plan-type').attr( "data-url" );
            selected_plan_type      = "fuel_plan";
            plan_url = url+"?plan_type="+selected_plan_type+"&plan_id="+post_id;

              //alert(plan_url+"===fuel_plan");
          }

       
        e.preventDefault();
        window.location.href = plan_url;
        
        //return false;
        
      }else{
        jQuery('#plan-type-error').text('Please select standard or fuel plan.'); 
        return false;
      }


    });
    //End : code for submit options

    //start : code for reset options
    jQuery( "#reset" ).click(function() {
      jQuery('#plan-type-div').css('display','none');
    });
    //End : code for reset options

});

jQuery(document).ready(function(){
    jQuery('[data-toggle="tooltip"]').tooltip();
});
</script>

<?php get_footer('plans'); ?>

