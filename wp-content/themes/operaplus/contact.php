<?php
/*
template name: cf
*/
?>
<?php
 
if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
  wpcf7_enqueue_scripts();
}
 
if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
  wpcf7_enqueue_styles();
}
 
?>
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
