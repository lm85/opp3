<div class="breadcrumb">
  <?php
    if (function_exists ( 'yoast_breadcrumb' )) {
      yoast_breadcrumb ();
    }
    ?>
</div>

<?php while (have_posts()) : the_post(); ?>
	<?php get_template_part('templates/page', 'header'); ?>
	<?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?> 
