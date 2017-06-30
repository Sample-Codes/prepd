<?php
/**
 * Template Name: How It Works
 *
 */
get_header('banner'); ?>

    <!-- =============== How it Work image section =============== -->
    <div class="work-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 wow bounceInLeft">
            <img src="<?php echo get_template_directory_uri(); ?>/images/pick-your-plan.jpg" alt="">
          </div>
        </div>
      </div>
    </div>

    <!-- =============== Our Philosophy =============== -->
    <div class="pick-plan parallax-2">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 wow fadeIn">
            <h2 class="text-title-2">Pick Your Plan</h2>
            <?php echo  wpautop(get_post_meta(get_the_ID(),'wpcf-pick-your-meals',true), true); ?>
          </div>
          <div class="col-sm-12">
            <div class="text-xs-center" id="example-caption-1">Standard Plan</div>
            <div class="progress">
              <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
              </div>
            </div>
            <div class="text-xs-center" id="example-caption-2">Fuel Plan</div>
            <div class="progress">
              <div class="progress-bar progress-bar-full" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
              </div>
            </div>

          </div>
          <div class="col-sm-12 middle-img">
            <a href="<?php echo site_url(); ?>/meal-plans/" class="btn btn-plan">Pick Your Plan</a>
          </div>
        </div>
      </div>
    </div>

    <!-- =============== Pick Your Meals =============== -->

    <div class="pick-meals">
      <div class="container">
        <div class="row">
            <?php echo  wpautop(get_post_meta(get_the_ID(),'wpcf-pick-your-plan',true), true); ?>
            <div class="middle-img">
            <a href="<?php echo site_url(); ?>/meal-plans/" class="btn btn-plan">Make Your Picks</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- =============== Pick Your Meals =============== -->

    <!-- =============== Have a Powerful Week =============== -->
     <div class="pick-plan parallax-3">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 wow fadeIn">
            <h2 class="text-title-2">Have a Powerful Week</h2>
            <?php echo  wpautop(get_post_meta(get_the_ID(),'wpcf-have-a-powerful-week',true), true); ?>
          </div>
        </div>
      </div>
    </div>
    <!-- =============== Have a Powerful Week =============== -->
<?php get_footer('plans'); ?>