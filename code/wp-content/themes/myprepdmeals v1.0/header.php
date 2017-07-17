<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php endif; ?>
	<link rel="shortcut icon" href="https://www.myprepdmeals.com/favicon.ico" type="image/x-icon" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <header id="masthead" class="site-header" role="banner">
      <?php include(get_template_directory() . '/template-parts/main-navigation.php'); ?>
  </header>

<?php 
  
  // page banners  
  $banner_url = '';
  $page_title = get_the_title();
  $banner_image = get_the_post_thumbnail_url();
  $upload_image = get_field('upload_banner_image');
  $default_banner = get_field('default_banner', 'option');

  // blog posts
  if( is_single() ) {
    $banner_url = $banner_image;
  }

  // single pages
  if($upload_image) {
    $banner_url = $upload_image;
  } else {
    $banner_url = $default_banner;
  }


if (!is_front_page() && !is_home()) : 
  if( is_single() ) {
    echo '<div class="top-single-banner" style="background-image: url(\'' . $banner_url . '\');"><div class="top-banner-cont"><h1 class="text-title-1">' . $page_title . '</h1></div></div>';
  } else {
    echo '<div class="top-banner" style="background-image: url(\'' . $banner_url . '\');">';
    echo '<h1 class="text-title-1">' . $page_title . '</h1>';
    echo '</div>';
  }

endif;

?>