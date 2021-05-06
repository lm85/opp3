<div class="breadcrumb">
	<?php
		if (function_exists ( 'yoast_breadcrumb' )) {
			yoast_breadcrumb ();
		}
		?>
</div>

<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class('box--medium'); ?>>
		<header class="content-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php get_template_part('templates/entry-meta'); ?>
			<?php echo '<strong class="excerpt">' . get_the_excerpt () . '</strong>'; ?>
			
			<?php
			$posttags = get_the_tags ();
			
			if (!empty($posttags)) { ?>
				<div class="tag-list"><span>Témata:</span><?
					foreach ( $posttags as $tag ) {
						echo '<a href=' . get_tag_link ( $tag->term_id ) . '>';
						echo $tag->name . '  ';
						echo '</a>';
					} ?>
				</div><?php
			}
			?>
		</header>

		<div class="content content-post">
		
			<?php
				the_content();
			?>
			
			<div class="group group-inline social">
				<div>
					<div class="fb-share-button" data-href="<?php echo get_permalink(); ?>" data-layout="button_count"></div>
				</div>
				<div>
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="OperaPlus" data-hashtags="operaplus"></a>
					<script async defer>
						!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
					</script>
				</div>
			</div>
			
			<?php echo print_related_posts ( $post->ID ); ?>

			<?php comments_template('/templates/comments.php'); ?>

		</div><!--/.content-post-->

		

	</article>

<?php endwhile; ?>
