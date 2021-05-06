<article <?php post_class('box box--medium search-result'); ?>>
	<div class="row">
		<?php
		if (has_post_thumbnail ()) { ?>
			<div class="col-sm-4 col-md-3 col-lg-4"><?php
				$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'thumbnail' );
				$url = $thumb ['0'];
				echo '<img src="' . $url . '" alt="' .get_post(get_post_thumbnail_id())->post_title. '">'; ?>
			</div><!--/.box-image --><?php
		}
		if (has_post_thumbnail ()) {
			echo '<div class="col-sm-8 col-md-9 col-lg-8"><div class="box-content">';
		} else {
			echo '<div class="col-sm-12">';
		}
		?>
			<h2 class="box-content-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<?php
				if (has_excerpt ( $post->ID )) {
					echo '<p>' . wp_trim_words(get_the_excerpt(), 35 ) . '</p>';
				} else {
					echo '<p>' .strip_shortcodes(wp_trim_words( get_the_content(), 20 )) . '</p>';
				}
			?>
		</div><!-- /.box-content -->
	</div><!--/.row-->
</article>
