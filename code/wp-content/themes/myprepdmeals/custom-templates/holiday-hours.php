<?php
/**
 * Template Name: Holiday Hours
 *
 */

get_header(''); ?>

<!-- ============= Banner Section ============= -->
    <div class="why-banner-section">
        <h1 class="text-title-1">Holiday Schedule 2016</h1>
    </div>

    <?php 
        $holiday_post_id = 134;//This is page id or post id
        $content_post    = get_post($holiday_post_id);
        $content         = $content_post->post_content;
        $content         = apply_filters('the_content', $content);
        $content         = str_replace(']]>', ']]&gt;', $content);
        echo $content;
    ?>


<?php get_footer('plans'); ?>