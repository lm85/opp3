<div class="breadcrumb">
	<?php
		if (function_exists ( 'yoast_breadcrumb' )) {
			yoast_breadcrumb ();
		}
		?>
</div>

<?php while (have_posts()) : the_post(); ?>
<article <?php post_class('format-gallery box--gallery'); ?>>
	<header>
		<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php get_template_part('templates/entry-meta'); ?>
	</header>

	<div class="content content-post">
		<?php the_content(); ?>
	</div><!--/.entry-content-->

	<div class="group group-inline social">
		<div>
			<div class="fb-share-button" data-href="<?php echo get_permalink(); ?>" data-layout="button_count"></div>
		</div>
		<div>
			<a href="https://twitter.com/share" class="twitter-share-button" data-via="OperaPlus" data-hashtags="operaplus"></a>
			<script async defer >
				!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
			</script>
		</div>
	</div>
</article>
<?php endwhile; ?>
