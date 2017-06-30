<?php
/**
 * Template Name: Pricing
 *
 */

get_header('banner'); ?>

    <div class="work-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2>Standard Plan</h2>
            <div class="text-style">
              <?php 
                $standard_plan_description = '';
                $standard_plan_description = term_description( 39, 'product_cat' ) ;
                if(!empty($standard_plan_description)){echo $standard_plan_description; }else{echo '';}
              ?>
            </div>
          </div>
          <?php 
              $args = array('post_type' => 'product',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' =>  39,
                    ),
                ),
                'meta_query'  => array(
                    array(
                        'key' => 'wpcf-display-on-prep-d-pricing-page',
                        'value' => 1
                    )
                ),  
             );

            $standard_plan = new WP_Query($args);
            if($standard_plan->have_posts()) {
              $price=$subscription_period=$meals_quantity=$snacks_quantity= "";   
               while($standard_plan->have_posts()) : $standard_plan->the_post();
                  $price               = get_post_meta( get_the_ID(), '_subscription_price', true);
                  $subscription_period = get_post_meta( get_the_ID(), '_subscription_period', true);
                  $meals_quantity      = get_post_meta( get_the_ID(), 'wpcf-meals-quantity', true);
                  $snacks_quantity     = get_post_meta( get_the_ID(), 'wpcf-snacks-quantity', true);
                  
              ?>
                 <div class="col-sm-4">
                    <div class="price-listing">
                      <div class="green-bg">
                        <div class="price">$<?php if(!empty($price)){echo $price; }else{echo '0';} ?></div>
                        <span>per <?php if(!empty($subscription_period)){echo $subscription_period; }else{echo 'day';} ?></span>
                      </div>
                      <div class="item-meals">
                         <?php 
                            if(!empty($meals_quantity)){
                              echo $meals_quantity.' Meals'; 
                            }else{
                              echo '0 Meals'; 
                            }
                          ?>
                        <br>
                        <?php 
                            if(!empty($snacks_quantity)){
                              echo $snacks_quantity.' Snacks'; 
                            }else{
                              echo '0 Snacks'; 
                            }
                        ?>
                      </div>
                    </div>
                 </div>
              <?php
               endwhile;
             }
          ?>

          <!-- Fuel Plan -->
          <div class="col-sm-12">
            <h2>Fuel Plan</h2>
            <div class="text-style">
              <?php 
                $standard_plan_description = '';
                $standard_plan_description = term_description( 38, 'product_cat' ) ;
                if(!empty($standard_plan_description)){echo $standard_plan_description; }else{echo '';}
              ?>
          </div>

            <?php 
              $args = array('post_type' => 'product',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' =>  38,
                    ),
                ),
                'meta_query'  => array(
                    array(
                        'key' => 'wpcf-display-on-prep-d-pricing-page',
                        'value' => 1
                    )
                ),  
             );

            $fuel_plan = new WP_Query($args);
            if($fuel_plan->have_posts()) {
              $price=$subscription_period=$meals_quantity=$snacks_quantity= "";   
               while($fuel_plan->have_posts()) : $fuel_plan->the_post();
                  $price               = get_post_meta( get_the_ID(), '_subscription_price', true);
                  $subscription_period = get_post_meta( get_the_ID(), '_subscription_period', true);
                  $meals_quantity      = get_post_meta( get_the_ID(), 'wpcf-meals-quantity', true);
                  $snacks_quantity     = get_post_meta( get_the_ID(), 'wpcf-snacks-quantity', true);
                  
              ?>
                 <div class="col-sm-4">
                    <div class="price-listing">
                      <div class="green-bg">
                        <div class="price">$<?php if(!empty($price)){echo $price; }else{echo '0';} ?></div>
                        <span>per <?php if(!empty($subscription_period)){echo $subscription_period; }else{echo 'day';} ?></span>
                      </div>
                      <div class="item-meals">
                         <?php 
                            if(!empty($meals_quantity)){
                              echo $meals_quantity.' Meals'; 
                            }else{
                              echo '0 Meals'; 
                            }
                          ?>
                        <br>
                        <?php 
                            if(!empty($snacks_quantity)){
                              echo $snacks_quantity.' Snacks'; 
                            }else{
                              echo '0 Snacks'; 
                            }
                        ?>
                      </div>
                    </div>
                 </div>
              <?php
               endwhile;
             }
          ?>
          <div class="col-sm-12">
            <!--<div class="note-text">*We have a one-time only $25 sign-up fee to cover the cost of our delivery equipment.</div>-->
             <a href="<?php echo site_url(); ?>/meal-plans/" class="btn btn-pricing-signup">Sign Up</a>
          </div>

        </div>
      </div>
    </div>

<?php get_footer('plans'); ?>

