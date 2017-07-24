$( document ).ready(function() {

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

<!-- Filter Script -->

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

});