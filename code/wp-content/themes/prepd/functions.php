<?php
/**
 * Myprepdmeals functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Myprepdmeals 1.0
 */

/**
 * Myprepdmeals only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'myprepdmeals_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own myprepdmeals_setup() function to override in a child theme.
 *
 * @since Myprepdmeals 1.0
 */

// adding acf options page

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

// declaring woocommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function myprepdmeals_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/myprepdmeals
	 * If you're building a theme based on Myprepdmeals, use a find and replace
	 * to change 'myprepdmeals' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'myprepdmeals' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Myprepdmeals 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'myprepdmeals' ),
		'social'  => __( 'Social Links Menu', 'myprepdmeals' ),
		'footer'  => __( 'Footer Menu', 'myprepdmeals' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', myprepdmeals_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // myprepdmeals_setup
add_action( 'after_setup_theme', 'myprepdmeals_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Myprepdmeals 1.0
 */
function myprepdmeals_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'myprepdmeals_content_width', 840 );
}
add_action( 'after_setup_theme', 'myprepdmeals_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Myprepdmeals 1.0
 */
function myprepdmeals_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'myprepdmeals' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'myprepdmeals' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'myprepdmeals' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'myprepdmeals' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'myprepdmeals' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'myprepdmeals' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'myprepdmeals_widgets_init' );

if ( ! function_exists( 'myprepdmeals_fonts_url' ) ) :
/**
 * Register Google fonts for Myprepdmeals.
 *
 * Create your own myprepdmeals_fonts_url() function to override in a child theme.
 *
 * @since Myprepdmeals 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function myprepdmeals_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'myprepdmeals' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'myprepdmeals' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'myprepdmeals' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Myprepdmeals 1.0
 */
function myprepdmeals_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'myprepdmeals_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Myprepdmeals 1.0
 */
function myprepdmeals_scripts() {
	wp_enqueue_script( 'myprepdmeals-min-js', get_template_directory_uri() . '/js/jquery.min.js', array(), 'v1.12.4' );
	wp_enqueue_script( 'myprepdmeals-validate', get_template_directory_uri() . '/js/jquery.validate.js', array(), '' );
	wp_enqueue_style( 'myprepdmeals-bootcss', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 'v3.3.7' );
	wp_enqueue_style( 'myprepdmeals-animate', get_template_directory_uri() . '/css/animate.css', array(), 'v1.0' );
	wp_enqueue_style( 'myprepdmeals-bootsnav', get_template_directory_uri() . '/css/bootsnav.css', array(), 'v.1.1' );
	wp_enqueue_style( 'myprepdmeals-customcss', get_template_directory_uri() . '/css/custom.css', array(), 'v.1.0' );
	wp_enqueue_style( 'myprepdmeals-owlcss-car', get_template_directory_uri() . '/owl.carousel/owl.carousel.css', array(), 'v.1.0' );
	wp_enqueue_style( 'myprepdmeals-owlcss', get_template_directory_uri() . '/owl.carousel/owl.theme.default.css', array(), 'v.1.0' );
	

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'myprepdmeals-fonts', myprepdmeals_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'myprepdmeals-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'myprepdmeals-ie', get_template_directory_uri() . '/css/ie.css', array( 'myprepdmeals-style' ), '20160816' );
	wp_style_add_data( 'myprepdmeals-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'myprepdmeals-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'myprepdmeals-style' ), '20160816' );
	wp_style_add_data( 'myprepdmeals-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'myprepdmeals-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'myprepdmeals-style' ), '20160816' );
	wp_style_add_data( 'myprepdmeals-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'myprepdmeals-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'myprepdmeals-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'myprepdmeals-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'myprepdmeals-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'myprepdmeals-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'myprepdmeals-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'myprepdmeals' ),
		'collapse' => __( 'collapse child menu', 'myprepdmeals' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'myprepdmeals_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Myprepdmeals 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function myprepdmeals_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'myprepdmeals_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Myprepdmeals 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function myprepdmeals_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Myprepdmeals 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function myprepdmeals_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'myprepdmeals_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Myprepdmeals 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function myprepdmeals_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'myprepdmeals_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Myprepdmeals 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function myprepdmeals_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'myprepdmeals_widget_tag_cloud_args' );

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

include('custom-function.php');


// creating nutrition tables for meals and snacks pages
function render_nutrition_table( $meals_id ) {
	
	$cals_standard = get_field('cals_standard', $meals_id);
	$fat_standard = get_field('fat_standard', $meals_id);
	$carbs_standard = get_field('carbs_standard', $meals_id);
	$protein_standard = get_field('protein_standard', $meals_id);

	$cals_fuel = get_field('cals_fuel', $meals_id);
	$fat_fuel = get_field('fat_fuel', $meals_id);
	$carbs_fuel = get_field('carbs_fuel', $meals_id);
	$protein_fuel = get_field('protein_fuel', $meals_id);

	echo '<h4>Nutrition Facts:</h4>';
	echo '<table class="nutrition-info">';
	echo '<tr>';
	echo '<td></td>';
	echo '<td><h5>Standard</strong></h5>';
	echo '<td><h5>Fuel</strong></h5>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Calories</td>';
	echo '<td>' . $cals_standard . '</td>';
	echo '<td>' . $cals_fuel . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Fat (g)</td>';
	echo '<td>' . $fat_standard . '</td>';
	echo '<td>' . $fat_fuel . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Carbs (g)</td>';
	echo '<td>' . $carbs_standard . '</td>';
	echo '<td>' . $carbs_fuel . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Protein (g)</td>';
	echo '<td>' . $protein_standard . '</td>';
	echo '<td>' . $protein_fuel . '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<p class="p1"><em><span class="s1">Nutrition facts are generated by <a href="http://www.myfitnesspal.com/"><span class="s2">MyFitnessPal</span></a> and are estimates</span></em></p>';
	
}


// adding meals custom fields to profile page
add_action( 'show_user_profile', 'module_user_profile_fields' );
add_action( 'edit_user_profile', 'module_user_profile_fields' );
function module_user_profile_fields( $user ) { 

$checkout_meals = get_field('checkout_meals', 'option');
$current_week = get_field('current_week', 'option');

    echo '<h3>Select Your Meals for the Week of ' . $current_week . '</h3>';
    
    if( $checkout_meals ) :
       	foreach( $checkout_meals as $checkout_meal ):

        $meal_id = $checkout_meal->ID;
    	$meals_id = $checkout_meal->ID;
        $meal_title = $checkout_meal->post_title;
        $meal_content = $checkout_meal->post_content;
        $meal_label = $checkout_meal->post_name;
        $image = get_the_post_thumbnail( $meal_id, 'meal-image' );
        $large_image = get_the_post_thumbnail( $meal_id );
        $modal_title = $meal_label . '-modal';
        $value = get_the_author_meta( $meal_label, $user->ID );

    echo '<div class="col-sm-4">';
    echo !is_admin() ? '<a data-toggle="modal" href="#' . $modal_title . '" class="btn btn-weekly-meal">' : '';
    echo !is_admin() ? $image : '';
    echo '<h4><label for="' . $meal_label . '">' . $meal_title . '</label></h4>'; 
    echo !is_admin() ? '</a>' : '';
    echo '<input class="quantity-btn" id="' . $meal_label . '" name="' . $meal_label . '" type="number" value="' . $value . '" placeholder="0" max="10" min="0"/>';
    echo '</div>';
    
    if(!is_admin()) {
    	echo '<div id="' . $modal_title . '" class="modal fade">';
    	echo '<div class="modal-dialog">';
    	echo '<div class="modal-content">';
    	echo '<div class="modal-header">';
    	echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    	echo '<h4 class="modal-title">' . $meal_title .' </h4>';
    	echo '</div>';
    	echo '<div class="modal-body">';
    	echo $large_image;
    	echo $meal_content;
    	render_nutrition_table($meals_id);
    	echo '</div>';
    	echo '<div class="modal-footer">';
    	echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
    	echo '</div>';
    	echo '</div>';
    	echo '</div>';
    	echo '</div>';
}
	 endforeach;

   endif;

	// snacks
	$checkout_snacks = get_field('checkout_snacks', 'option');

	    echo '<div id="order-snacks">';
	    echo '<h3>Select Your Snacks</h3>';
	    
	    if( $checkout_snacks ) :
	       	foreach( $checkout_snacks as $checkout_snack ):

	        $snack_id = $checkout_snack->ID;
	    	$snack_id = $checkout_snack->ID;
	        $snack_title = $checkout_snack->post_title;
	        $snack_content = $checkout_snack->post_content;
	        $snack_label = $checkout_snack->post_name;
	        $image = get_the_post_thumbnail( $snack_id, 'meal-image' );
	        $large_image = get_the_post_thumbnail( $snack_id );
	        $modal_title = $snack_label . '-modal';
	        $value = get_the_author_meta( $snack_label, $user->ID );

	    echo '<div class="col-sm-4">';
	    echo !is_admin() ? '<a data-toggle="modal" href="#' . $modal_title . '" class="btn btn-weekly-meal">' : '';
	    echo !is_admin() ? $image : '';
	    echo '<h4><label for="' . $snack_label . '">' . $snack_title . '</label></h4>'; 
	    echo !is_admin() ? '</a>' : '';
	    echo '<input class="quantity-btn" id="' . $snack_label . '" name="' . $snack_label . '" type="number" value="' . $value . '" placeholder="0" max="10"/>';
	    echo '</div>';
	    
	    if(!is_admin()) {
	    	echo '<div id="' . $modal_title . '" class="modal fade">';
	    	echo '<div class="modal-dialog">';
	    	echo '<div class="modal-content">';
	    	echo '<div class="modal-header">';
	    	echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
	    	echo '<h4 class="modal-title">' . $snack_title .' </h4>';
	    	echo '</div>';
	    	echo '<div class="modal-body">';
	    	echo $large_image;
	    	echo $snack_content;
	    	render_nutrition_table($snack_id);
	    	echo '</div>';
	    	echo '<div class="modal-footer">';
	    	echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
	    	echo '</div>';
	    	echo '</div>';
	    	echo '</div>';
	    	echo '</div>';
	}
		 endforeach;

	   endif;
	   echo '</div>';

 }

add_action( 'personal_options_update', 'save_module_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_module_user_profile_fields' );

function save_module_user_profile_fields( $user_id ) {
    
    // meals
    $checkout_meals = get_field('checkout_meals', 'option');

    if( $checkout_meals ) :
    	foreach( $checkout_meals as $checkout_meal ):
       		$meal_label = $checkout_meal->post_name;
       	if ( current_user_can('edit_user',$user_id) ) {
         	update_user_meta($user_id, $meal_label, $_POST[$meal_label]);
         }
	 
	 	endforeach;
	endif;

	//snacks
  	$checkout_snacks = get_field('checkout_snacks', 'option');

	if( $checkout_snacks ) :
		foreach( $checkout_snacks as $checkout_snack ):
			$snack_label = $checkout_snack->post_name;
    if ( current_user_can('edit_user',$user_id) ) {
       update_user_meta($user_id, $snack_label, $_POST[$snack_label]);
    }
	 
	 	endforeach;
   	endif;

}


// adding date to user profile
add_action( 'show_user_profile', 'date_user_profile_fields' );
add_action( 'edit_user_profile', 'date_user_profile_fields' );

function date_user_profile_fields( $user ) {

	// checking if admin page
	$admin = false;
	
	if( is_admin() ) {
		$admin = true;
	}

	$date = current_time( 'm-d-Y', 0 );

	echo '<input id="date_submitted" name="date_submitted" type="hidden" value="' . $date . '">';

	if($admin) {
		// If is current user's profile (profile.php)
		if ( defined('IS_PROFILE_PAGE') && IS_PROFILE_PAGE ) {
		    $user_id = get_current_user_id();
		// If is another user's profile page
		} elseif (! empty($_GET['user_id']) && is_numeric($_GET['user_id']) ) {
		    $user_id = $_GET['user_id'];
		// Otherwise something is wrong.
		} else {
		    die( 'No user id defined.' );
		}

		$date_submitted = get_user_meta( $user_id, 'date_submitted', true );
		echo $date_submitted ? '<h4>Order Submitted On: ' . $date_submitted . '</h4>' : 'No order has been submitted';
	}
}

add_action( 'personal_options_update', 'save_date_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_date_user_profile_fields' );

	function save_date_user_profile_fields( $user_id ) {
	    if ( current_user_can('edit_user',$user_id) ) {
	         	update_user_meta($user_id, 'date_submitted', $_POST['date_submitted']);
	         }
	}


// Adding woocommerce account menu custom link
add_filter ( 'woocommerce_account_menu_items', 'woo_one_more_link' );
function woo_one_more_link( $menu_links ){
	$new = array( 'my_weekly_order' => 'My Weekly Order' );
 
	$menu_links = array_slice( $menu_links, 0, 1, true ) 
	+ $new 
	+ array_slice( $menu_links, 1, NULL, true );
 
	return $menu_links;
}
 
add_filter( 'woocommerce_get_endpoint_url', 'woo_hook_endpoint', 10, 4 );
function woo_hook_endpoint( $url, $endpoint, $value, $permalink ){
 
	if( $endpoint === 'my_weekly_order' ) {
 
		// ok, here is the place for your custom URL, it could be external
		$url = get_site_url() . '/my-weekly-order/';
 
	}
	return $url;
 
}