<?php 
$post_id = is_singular() ? get_the_ID() : false;
$posts = esi_get_related_posts($post_id, $related_taxonomy, $related_posts_count);	
$current_post_id = $post_id; 	 		      			 	 	 
$show = apply_filters('esi-services-related_posts', !empty($posts), $post_id);
//if ($show) {
//	$out = '';
//	foreach ($posts as $related) {
//		
//	}
//}

if (esi_getval($type, 'related-display_title')) {
	echo '<h3>'.esi_getval($type, 'related-display_title').'</h3>';
}

$displayed_thumb_left =  false;

?>


<div class="esi-posts hfeed">

  <?php if ($show) : ?>

      <?php foreach ($posts as $post) { ?>

        <?php $current_post = (!$is_vertical ? ' esi-slide-related-horiz' : '');//($post->ID == $current_post_id && is_single()) ? 'active' : '';
        ?>

        <article <?php post_class($current_post); ?>>

          <header>

            <?php if (current_theme_supports('post-thumbnails') && esi_getval($type, 'related-show_thumbnail') && has_post_thumbnail() && (esi_getval($type, 'related-thumb_pos') == 'before' || esi_getval($type, 'related-thumb_pos') == 'left')) : ?>
              <div class="entry-image <?php echo ((esi_getval($type, 'related-thumb_pos') == 'left') ? 'entry-image-left' : ''); ?>">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                  <?php the_post_thumbnail(esi_getval($type, 'related-thumb_size')); ?>
                </a>
              </div>
            <?php if (esi_getval($type, 'related-thumb_pos') == 'left') { $displayed_thumb_left = true; }?>
            <?php endif; ?>
          
           <?php if (get_the_title() && esi_getval($type, 'related-show_title')) : ?>
              <h4 class="entry-title <?php echo ((esi_getval($type, 'related-thumb_pos') == 'left' && $displayed_thumb_left) ? 'entry-title-left' : ''); ?>">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                  <?php the_title(); ?>
                </a>
              </h4>
            <?php endif; ?>
            
            <?php if (current_theme_supports('post-thumbnails') && esi_getval($type, 'related-show_thumbnail') && has_post_thumbnail() && (esi_getval($type, 'related-thumb_pos') == 'after' || esi_getval($type, 'related-thumb_pos') == '')) : ?>
              <div class="entry-image">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                  <?php the_post_thumbnail(esi_getval($type, 'related-thumb_size')); ?>
                </a>
              </div>
            <?php endif; ?>

           

            <?php if (esi_getval($type, 'related-show_date') ||esi_getval($type, 'related-show_author') || esi_getval($type, 'related-show_comments')) : ?>

              <div class="entry-meta <?php echo ((esi_getval($type, 'related-thumb_pos') == 'left' && $displayed_thumb_left) ? 'entry-meta-left' : ''); ?>">

                <?php if (esi_getval($type, 'related-show_date')) : ?>
                  <time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_time('F j, Y g:i a'); ?></time>
                <?php endif; ?>

                <?php if (esi_getval($type, 'related-show_date') && esi_getval($type, 'related-show_author')) : ?>
                  <span class="sep"><?php _e('|', 'esi'); ?></span>
                <?php endif; ?>

                <?php if (esi_getval($type, 'related-show_author')) : ?>
                  <span class="author vcard">
                    <?php echo __('By', 'esi'); ?>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn">
                      <?php echo get_the_author(); ?>
                    </a>
                  </span>
                <?php endif; ?>

                <?php if (esi_getval($type, 'related-show_author') && esi_getval($type, 'related-show_comments')) : ?>
                  <span class="sep"><?php _e('|', 'esi'); ?></span>
                <?php endif; ?>

                <?php if (esi_getval($type, 'related-show_comments')) : ?>
                  <a class="comments" href="<?php comments_link(); ?>">
                    <?php comments_number(__('No comments', 'esi'), __('One comment', 'esi'), __('% comments', 'esi')); ?>
                  </a>
                <?php endif; ?>

              </div>

            <?php endif; ?>

          </header>

          <?php if (esi_getval($type, 'related-show_excerpt')) : ?>
            <div class="entry-summary">
              <p>
                <?php echo esi_get_related_post_excerpt($post); ?>
                <?php if (esi_getval($type, 'related-show_readmore')) : ?>
                  <a href="<?php the_permalink(); ?>" class="more-link"><?php echo esi_getval($type, 'related-excerpt_readmore'); ?></a>
                <?php endif; ?>
              </p>
            </div>
          <?php elseif (esi_getval($type, 'related-show_content')) : ?>
            <div class="entry-content">
              <?php the_content() ?>
            </div>
          <?php endif; ?>

          <footer>

            <?php
            $categories = get_the_term_list($post->ID, 'category', '', ', ');
            if (esi_getval($type, 'related-show_cats') && $categories) :
            ?>
              <div class="entry-categories">
                <strong class="entry-cats-label"><?php _e('Posted in', 'esi'); ?>:</strong>
                <span class="entry-cats-list"><?php echo $categories; ?></span>
              </div>
            <?php endif; ?>

            <?php
            $tags = get_the_term_list($post->ID, 'post_tag', '', ', ');
            if (esi_getval($type, 'related-show_tags') && $tags) :
            ?>
              <div class="entry-tags">
                <strong class="entry-tags-label"><?php _e('Tagged', 'esi'); ?>:</strong>
                <span class="entry-tags-list"><?php echo $tags; ?></span>
              </div>
            <?php endif; ?>

          

          </footer>

        </article>

      <?php } ?>

  <?php else : ?>

    <p class="esi-not-found">
      <?php _e('No posts found.', 'esi'); ?>
    </p>

  <?php endif; ?>

</div>