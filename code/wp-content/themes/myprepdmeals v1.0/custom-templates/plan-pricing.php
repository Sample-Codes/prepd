<?php
/**
 * Template Name: Plan Pricing
 *
 */

get_header('banner'); ?>

    <!-- =============== How it Work image section =============== -->
    <div class="pricing-plans">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="pn-head">Standard Plan</h2>
          </div>
          <div class="col-sm-4 circle-img">
            <!-- <img src="images/Standard-Meals-contain.jpg" alt="" class=""> -->
            <div class="circle-meal-plans">
              <h3>Standard Plan meals contain:</h3>
              <div>
                <?php 
                  $standard_plan_meals_contain = "";
                  $standard_plan_meals_contain = get_term_meta(39,'wpcf-plan-meals-contain',true);
                  if(!empty($standard_plan_meals_contain)){echo wpautop($standard_plan_meals_contain); }else{echo '';}
                ?>
              </div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="std-all-plans">
              <div class="row">
                <?php 
                  $args = array('post_type' => 'product',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'term_id',
                            'terms' =>  39,
                        ),
                    )
                 );
                $standard_plan = new WP_Query($args);
                 if($standard_plan->have_posts()) {
                  $price=$subscription_period=$meals_quantity=$snacks_quantity=$food_timing= "";   
                   while($standard_plan->have_posts()) : $standard_plan->the_post();
                      $price               = get_post_meta( get_the_ID(), '_subscription_price', true);
                      $subscription_period = get_post_meta( get_the_ID(), '_subscription_period', true);
                      $meals_quantity      = get_post_meta( get_the_ID(), 'wpcf-meals-quantity', true);
                      $snacks_quantity     = get_post_meta( get_the_ID(), 'wpcf-snacks-quantity', true);
                      $food_timing         = get_post_meta( get_the_ID(), 'wpcf-food-timing', true);
                      $food_serving        = get_post_meta( get_the_ID(), 'wpcf-food-serving', true);
                ?>
                    <div class="col-sm-3 col-xs-6">
                    <div class="weekly-plans-sm">
                      <div class="pn-lunch">
                        <?php if(!empty($food_timing)){echo $food_timing; }else{echo '';} ?>
                      </div>
                      <div class="pn-week">
                      $<?php if(!empty($price)){echo $price; }else{echo '';} ?>/<?php if(!empty($subscription_period)){echo $subscription_period; }else{echo '';} ?>
                      </div>
                      <div class="pn-details">
                        <strong>
                          <?php if(!empty($food_serving)){echo $food_serving; }else{echo '';} ?>
                        </strong>
                        <?php the_content(); ?>
                        <a href="<?php echo get_permalink(get_the_ID()); ?>" class="btn btn-buy">Buy Now</a>
                      </div>
                      <div class="clearfix"></div>
                    </div> 
                  </div>

                <?php  
                   endwhile;
                }   
                ?>

              </div>
            </div>
          </div>

        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <h2 class="pn-head">Fuel Plan</h2>
          </div>
          <div class="col-sm-8">
            <div class="std-all-plans">
              <div class="row">

               <?php 
                  $args = array('post_type' => 'product',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'term_id',
                            'terms' =>  38,
                        ),
                    )
                 );
                $standard_plan = new WP_Query($args);
                 if($standard_plan->have_posts()) {
                  $price=$subscription_period=$meals_quantity=$snacks_quantity=$food_timing= "";   
                   while($standard_plan->have_posts()) : $standard_plan->the_post();
                      $price               = get_post_meta( get_the_ID(), '_subscription_price', true);
                      $subscription_period = get_post_meta( get_the_ID(), '_subscription_period', true);
                      $meals_quantity      = get_post_meta( get_the_ID(), 'wpcf-meals-quantity', true);
                      $snacks_quantity     = get_post_meta( get_the_ID(), 'wpcf-snacks-quantity', true);
                      $food_timing         = get_post_meta( get_the_ID(), 'wpcf-food-timing', true);
                      $food_serving        = get_post_meta( get_the_ID(), 'wpcf-food-serving', true);
                ?>

                <div class="col-sm-3 col-xs-6">
                    <div class="weekly-plans-sm">
                      <div class="pn-lunch">
                        <?php if(!empty($food_timing)){echo $food_timing; }else{echo '';} ?>
                      </div>
                      <div class="pn-week">
                      $<?php if(!empty($price)){echo $price; }else{echo '';} ?>/<?php if(!empty($subscription_period)){echo $subscription_period; }else{echo '';} ?>
                      </div>
                      <div class="pn-details">
                        <strong>
                          <?php if(!empty($food_serving)){echo $food_serving; }else{echo '';} ?>
                        </strong>
                        <?php the_content(); ?>
                        <a href="<?php echo get_permalink(get_the_ID()); ?>" class="btn btn-buy">Buy Now</a>
                      </div>
                      <div class="clearfix"></div>
                    </div> 
                  </div>

                <?php  
                   endwhile;
                }   
                ?>

              </div>
            </div>
          </div>
          <div class="col-sm-4 circle-img">
            <!-- <img src="images/Standard-Meals-contain-1.jpg" alt=""> -->
            <div class="circle-meal-plans">
              <h3>Fuel Plan meals contain:</h3>
              <div>
              <?php 
                  $fuel_plan_meals_contain = "";
                  $fuel_plan_meals_contain = get_term_meta(38,'wpcf-plan-meals-contain',true);
                  if(!empty($fuel_plan_meals_contain)){echo wpautop($fuel_plan_meals_contain); }else{echo '';} 
                ?>
              </div>
              
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="txt-std-palns">
            <p>We have a one-time only <a href="#">$25 sign-up fee</a> to cover cost of our delivery equipment.</p>
            <p>If you decide to stop ordering at any point in the future, our super cool delivery bags are yours to keep!</p>
            </div>
            <div class="focus-line">
              <i class="fa fa-flag"></i>
              Hungry for Prep’d breakfast? The meal plans that include breakfast above are coming soon. Stay tuned for the new menu!
            </div>
          </div>
        </div>

        <div class="row why-meals">
          <div class="top-seperator"></div>
          <div class="col-sm-12">
            <h2>Weekly Meal Plans</h2>
          </div>
          <div class="col-sm-12">
            <?php 
              $weekly_meal_plans   = get_post_meta( 366, 'wpcf-weekly-meal-plans', true);
              if(!empty($weekly_meal_plans)){echo wpautop($weekly_meal_plans); }else{echo '';}
            ?>
          </div>
        </div>

        <div class="row why-meals">
          <div class="top-seperator"></div>
          <div class="col-sm-6 col-sm-offset-6">
            <h2>Why Meal Prep?</h2>
          </div>
          <div class="col-sm-12">
            <?php
               $why_meal_prep = get_post_meta( 366, 'wpcf-why-meal-prep', true);
               if(!empty($why_meal_prep)){echo wpautop($why_meal_prep); }else{echo '';}
            ?>
          </div>
        </div>

      </div>
    </div>

<?php get_footer(); ?>

