<?php
/**
 * Template Name: Weekly Menu
 *
 */
get_header('banner'); ?>

    <div class="weekly-menus">
      <div class="container">
        <div class="row">
            <div class="col-sm-12">
              <h2>Fresh, Healthy and Never Boring</h2>
              <p>Each week, we feature a new variety of meal and snack options from our full menu, giving you new options to help fuel your week. Plus, most of our meals can be easily modified to help meet your dietary needs and preferences. Check out the upcoming weekly selections below, or browse our full menu for nutrition facts, ingredient information and more.</p>
            </div>
        </div>
      </div>
    </div>
    <div class="why-section">
      <div class="container">
        <div class="row leaf-column">
          <div class="col-sm-4">
            <div class="square-box">
              <div class="circle-leaf"><i class="fa fa-cutlery" aria-hidden="true"></i></div>
              <h2 class="gap-bottom-2"><?php the_field( 'weekly_menu_box_1_date' ); ?></h2>
              <a href="<?php the_field( 'menu_link_1' ); ?> " class="btn btn-view">View Menu</a>
              <p class="gap-top-2">Order before <?php the_field( 'menu_order_expiration_1' ) ?>.</p>
            </div>
          </div>
          
<div class="col-sm-4">
            <div class="square-box">
              <div class="circle-leaf"><i class="fa fa-cutlery" aria-hidden="true"></i></div>
              <h2 class="gap-bottom-2"><?php the_field( 'menu_date_2' ); ?></h2>
              <a href="<?php the_field( 'menu_link_2' ); ?> " class="btn btn-view">View Menu</a>
              <p class="gap-top-2">Order before <?php the_field( 'menu_order_expiration_2' ) ?>.</p>
            </div>
          </div>
          <div class="col-sm-4">
           <div class="square-box">
              <div class="circle-leaf"><i class="fa fa-cutlery" aria-hidden="true"></i></div>
              <h2 class="gap-bottom-2"><?php the_field( 'menu_date_3' ); ?></h2>
              <a href="<?php the_field( 'menu_link_3' ); ?> " class="btn btn-view">View Menu</a>
              <p class="gap-top-2">Order before <?php the_field( 'menu_order_expiration' ) ?>.</p>
            </div>
          </div>
        </div>
      </div>
    </div>


<?php get_footer('plans'); ?>