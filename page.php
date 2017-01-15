<?php get_header(); ?>
<div class="view">
  <?php
  // Start the loop.
  while ( have_posts() ) : the_post();

  the_content();
    // End of the loop.
  endwhile;
  ?>
</div>

<?php get_footer() ?>
