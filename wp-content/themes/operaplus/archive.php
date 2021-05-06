<div class="breadcrumb">
  <?php

if (function_exists ( 'yoast_breadcrumb' )) {
			yoast_breadcrumb ();
		}
		?>
</div>
<?php get_template_part('templates/page', 'header'); ?>
<?php $i=0;?>
<?php if (!have_posts()) : ?>
<div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
<?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
<span id="art<?=++$i?>"></span>
  <?php get_template_part('templates/content'); ?>
<?php endwhile; ?>
<?php the_ad(309405); ?>

<?php
if (function_exists ( 'wp_paginate' )) {
	wp_paginate ();
} ?>

