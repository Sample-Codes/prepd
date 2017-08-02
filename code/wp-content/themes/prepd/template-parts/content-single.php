<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage myprepdmeals
 * @since Myprepdmeals 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 

	$author = get_the_author();
	$date = get_the_time('M d Y');
	$author_bio_avatar_size = apply_filters( 'post-thumbnail', 42 );
	$author_image = get_avatar( get_the_author_meta( 'user_email' ));

	echo '<div class="blog-info">';
	echo '<div class="container">';
	echo '<div class="top-author-info">' . $author_image;
	echo $author ? '<p>Written By: <br />' . $author . '</p>' : '';
	echo '<span class="small-date"><i class="fa fa-clock-o"></i>' . $date . '</span>';
	echo '</div>';
	echo '</div>';
	echo '</div>'; ?>

	<div class="entry-content container">
		
		<?php

			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'myprepdmeals' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			echo '<div class="txt-aligncenter"><a href="' . site_url() . '/meal-plans/" class="btn btn-view">Get Prep\'d</a></div>';

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		?>
		

	</div><!-- .entry-content -->

</article><!-- #post-## -->
