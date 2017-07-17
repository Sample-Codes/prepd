<?php
/**
 * Remove remove review and rating from single product page.
 */
add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
    function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    return $tabs;
}


/**
 * Redirect users after add to cart.
 */
function my_custom_add_to_cart_redirect( $url ) {
       $current_url = $url_string = "";
       $current_url = $_SERVER["REQUEST_URI"];
       $url_arr     = array();
       $url_arr     = explode('?', $current_url);
       if(count($url_arr) > 1 ) {
        $url_string  = $url_arr[1];
       }
       $url         = WC()->cart->get_checkout_url();
       $new_url     = $url . "/?" . $url_string;
    // $url = wc_get_checkout_url(); // since WC 2.5.0
}

    add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' );


/**
 * Removes the previous product and adds the new one.
 */

add_filter( 'woocommerce_add_cart_item_data', 'wdm_empty_cart', 10,  3);

function wdm_empty_cart( $cart_item_data, $product_id, $variation_id ) 
{

    global $woocommerce;
    $woocommerce->cart->empty_cart();

    // Do nothing with the data and return
    return $cart_item_data;
}

/**
 * Remove following from single product page.
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

add_action( 'wp_head', 'quantity_wp_head' );
function quantity_wp_head() {
if ( is_product() ) {
?>
<style type="text/css">.quantity, .buttons_added { width:0; height:0; display: none; visibility: hidden; }</style>
<?php
}
}


/**
 * Code for featured images.
 */
require_once('wp_bootstrap_navwalker.php'); 

 register_nav_menus( array(
  'primary' => esc_html__( 'Primary', 'myprepdmeals' ),
 ) );


/**
 * Code to save custom product field
 */
add_action( 'woocommerce_add_cart_item_data', 'alkurn_save_custom_product_field', 10, 2 );
function alkurn_save_custom_product_field( $cart_item_data, $product_id ) {

	$meals_order = $_REQUEST['meals_order'];
	update_post_meta($product_id, 'wpcf-meals-order',$meals_order);
    $meals_order_value = get_post_meta($product_id , 'wpcf-meals-order', true);
 	
    if( !empty( $meals_order_value ) ) 
    {
        $cart_item_data['meals_order'] = $meals_order_value;

        // below statement make sure every add to cart action as unique line item
        $cart_item_data['unique_key'] = md5( microtime().rand() );
    }
    return $cart_item_data;
}

/**
 * Code to render custom product meta field to cart and checkout
 */
add_filter( 'woocommerce_get_item_data', 'alkurn_render_meta_on_cart_and_checkout', 10, 2 );
function alkurn_render_meta_on_cart_and_checkout( $cart_data, $cart_item ) {
    $custom_items = array();
    // Woo 2.4.2 updates
    if( !empty( $cart_data ) ) {
        $custom_items = $cart_data;
    }
    if( isset( $cart_item['meals_order'] ) ) {
        $custom_items[] = array( "name" => "Customer Order", "value" => $cart_item['meals_order'] );
    }
    return $custom_items;
}


/**
 * Code to add custom product meta field to order meta
 */
add_action('woocommerce_add_order_item_meta','alkurn_add_values_to_order_item_meta',10,2);
if(!function_exists('alkurn_add_values_to_order_item_meta'))
{
  function alkurn_add_values_to_order_item_meta($item_id, $values)
  {
        global $woocommerce,$wpdb;
        $user_custom_values = $values['meals_order'];
        if(!empty($user_custom_values))
        {
            wc_add_order_item_meta($item_id,'meals_order',$user_custom_values);  
        }
  }
} 

/**
 * Code to save custom product plan type
 */
add_action( 'woocommerce_add_cart_item_data', 'alkurn_save_custom_product_plan_type', 10, 2 );
function alkurn_save_custom_product_plan_type( $cart_item_data, $product_id ) {

    $plan_type = $_REQUEST['plan_type'];
    update_post_meta($product_id, 'wpcf-plan-type',$plan_type);
    $plan_type_value = get_post_meta($product_id , 'wpcf-plan-type', true);
    
    if( !empty( $plan_type_value ) ) 
    {
        $cart_item_data['plan_type'] = $plan_type_value;

        // below statement make sure every add to cart action as unique line item
        $cart_item_data['unique_key'] = md5( microtime().rand() );
    }
    return $cart_item_data;
}

/**
 * Code to render custom product plan type field to cart and checkout
 */
add_filter( 'woocommerce_get_item_data', 'alkurn_render_plan_type_on_cart_and_checkout', 10, 2 );
function alkurn_render_plan_type_on_cart_and_checkout( $cart_data, $cart_item ) {
    $custom_items = array();
    // Woo 2.4.2 updates
    if( !empty( $cart_data ) ) {
        $custom_items = $cart_data;
    }
    if( isset( $cart_item['plan_type'] ) ) {
        $custom_items[] = array( "name" => "Plan Type", "value" => $cart_item['plan_type'] );
    }
    return $custom_items;
}

/**
 * Code to add custom product plan type field to order meta
 */
add_action('woocommerce_add_order_item_meta','alkurn_add_values_to_order_item_plan_type',10,2);
if(!function_exists('alkurn_add_values_to_order_item_plan_type'))
{
  function alkurn_add_values_to_order_item_plan_type($item_id, $values)
  {
        global $woocommerce,$wpdb;
        $user_custom_values = $values['plan_type'];
        if(!empty($user_custom_values))
        {
            wc_add_order_item_meta($item_id,'plan_type',$user_custom_values);  
        }
  }
} 


/**
 * Code for featured images.
 */
add_image_size( 'meal-small-image', 60, 60, true );
add_image_size( 'meal-image', 286, 191, true );
add_image_size( 'meal-detail-image', 568, 379, true );

add_image_size( 'blog-post-front-image', 360, 128, true );
add_image_size( 'blog-post-detail-image', 170, 320, true );

add_image_size( 'meal-post-front-image', 360, 158, true );
add_image_size( 'meal-post-detail-image', 450, 450, true );
add_image_size( 'meal-post-related-image', 230, 230, true );

add_image_size( 'team-management-members-image', 360, 360, true );
add_image_size( 'team-cook-members-image', 300, 300, true );

/**
 * Code to limit excerpt characters for featured posts.
 */
function custom_featured_excerpt($string) {
    return substr($string, 0, 200);
}


/**
 * Code to limit excerpt characters.
 */
function custom_excerpt($string, $limit) {
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0, $limit));
}

/**
 * Code to limit excerpt characters in related meals/snacks.
 */
function custom_excerpt_related_meals($string, $limit) {
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0, $limit));
}

/**
 * Code to get function term slugs.
 */

function get_term_slug_by_post_id($post_id,$taxonomy){
    $slugs = array();
    $all_slugs = "";
    if(!empty($post_id)){
        $term_slugs = wp_get_post_terms( $post_id, $taxonomy ); 
        foreach( $term_slugs as $term_slug ) {
            
            $all_slugs .=  ' '.$term_slug->slug; 
        }
        return $all_slugs;
    }else{
        return $all_slugs;
    }
}

function get_menu_term_slug_by_post_id($post_id,$taxonomy){
    $slugs = array();
    $all_slugs = "";
    if(!empty($post_id)){
        $term_slugs = wp_get_post_terms( $post_id, $taxonomy ); 
        $cnt = 0;
        foreach( $term_slugs as $term_slug ) {
            if($cnt == (count($term_slugs)-1)){
                $all_slugs .=  $term_slug->slug; 
            }else{
                $all_slugs .=  $term_slug->slug.' '; 
            }
            $cnt++;
        }
        return $all_slugs;
    }else{
        return $all_slugs;
    }
}


// hide homepage feilds from all pages except homepage
add_action('admin_head', 'custom_admin_styles');
function custom_admin_styles() {
    $arr1=$arr2=$arr3= array();

    $arr1 = array(108);
    if(get_post_type() == 'page' && !in_array(get_the_ID(), $arr1))
    {
        echo '<style type="text/css">
          #wpcf-group-our-full-menu-description-group {display:none;}
         </style>';
    }

    $arr2 = array(82);
    if(get_post_type() == 'page' && !in_array(get_the_ID(), $arr2))
    {
        echo '<style type="text/css">
          #wpcf-group-how-it-works-group {display:none;}
         </style>';
    }

    $arr2 = array(366);
    if(get_post_type() == 'page' && !in_array(get_the_ID(), $arr2))
    {
        echo '<style type="text/css">
          #wpcf-group-weekly-meal-plans-group {display:none;}
         </style>';
    }
}

/**
 * Add meals/snacks destination URL fields to media uploader
 *
 */
 
function article_destination_url_attachment_field( $form_fields, $post ) {

    $form_fields['article-destination-url'] = array(
        'label' => 'Meals/Snacks URL',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'article_destination_url', true ),
        'helps' => 'Enter the Meals/Snacks destination URL',
    );

    return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'article_destination_url_attachment_field', 10, 2 );

/**
 * Save meals/snacks  destination URL fields to media uploader
 *
 */

function article_destination_url_attachment_field_save( $post, $attachment ) {
    if( isset( $attachment['article-destination-url'] ) )
    update_post_meta( $post['ID'], 'article_destination_url', esc_url( $attachment['article-destination-url'] ) );

    return $post;
}

add_filter( 'attachment_fields_to_save', 'article_destination_url_attachment_field_save', 10, 2 );

/**
 * Remove Product Summary Box
 *
 * @see woocommerce_template_single_excerpt()
 * @see woocommerce_template_single_meta()
 * 
 */

//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/**
 * change text of add_to_cart_button according to logged in user
 *
 */
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
 
function woo_custom_cart_button_text() {
        
    if ( is_user_logged_in() ) {
        return __( 'CONTINUE', 'woocommerce' );
    }else{
        return __( 'Sign Up Now', 'woocommerce' );
    }
 
}
?>