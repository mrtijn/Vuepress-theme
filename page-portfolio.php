<?php /* template name: portfolio */ ?>
<?php get_header(); ?>
<div class="view">

  <ul class="img-list">
    <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/1.jpg" alt=""></li>
    <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/2.jpg" alt=""></li>
    <li><a href="/blog/test-post"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/3.jpg" alt=""></a></li>
    <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/4.jpg" alt=""></li>
    <li class="big"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/5.jpg" alt=""></li>
    <li class="big"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/6.jpg" alt=""></li>

  </ul>
  <?php
  // Start the loop.
  while ( have_posts() ) : the_post();

  the_content();
    // End of the loop.
  endwhile;
  ?>
</div>

<?php get_footer() ?>
