<div class="breadcrumb">
	<?php if (function_exists('yoast_breadcrumb')) {
		yoast_breadcrumb();
	} ?>
</div>

<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
	<header class="page-header">
		<h1><?php the_title(); ?></h1>
	</header>
	<div class="content content-page">
		<?php the_content(); ?>
		<?php echo do_shortcode ( '[contact-form-7 id="28555" title="zeptejte_se"]' ); ?>
	</div>

	<footer>
		<?php
		wp_link_pages ( [
			'before' => '<nav class="page-nav"><p>' . __ ( 'Pages:', 'sage' ),
			'after' => '</p></nav>'
		] );
		?>
	</footer>
	<?php comments_template('/templates/comments.php'); ?>
</article>
<?php endwhile; ?>
