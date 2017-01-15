<?php get_header(); ?>
<div class="view single">
  <?php
  // Start the loop.
  while ( have_posts() ) : the_post();
  if ( has_post_thumbnail() ) {
	the_post_thumbnail();
  }
  the_content();
    // End of the loop.
  endwhile;
  ?>
</div>

<?php get_footer() ?>
