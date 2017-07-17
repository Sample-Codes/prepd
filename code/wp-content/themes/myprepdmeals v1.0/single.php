<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage myprepdmeals
 * @since Myprepdmeals 1.0
 */

get_header('single-blog-post'); ?>

<div id="primary" class="content-area">
	<div class="blog-individual">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the single post content template.
			get_template_part( 'template-parts/content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			echo '<div class="container">';
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			echo '</div>';

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->
	</div>

</div><!-- .content-area -->

<?php get_footer(); ?>
