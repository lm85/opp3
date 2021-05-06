<article <?php post_class('box box--medium'); ?>>
	<div class="row">
		<div class="col-sm-4 col-md-3 col-lg-4">
			<div class="box-image">
				<?php //get_template_part('templates/entry-meta'); ?>
				<?php
					if (has_post_thumbnail ()) {
						$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'thumbnail' );
						$url = $thumb ['0'];
						echo '<img src="' . $url . '" alt="">';
					} else {
						$content = get_the_content();
						$imageUrl = get_image_url($content);
						if(!empty($imageUrl)) {
							echo '<img src="' . $imageUrl . '" alt="">';
						} else {
							echo '<div class="thumb"></div>';
						}
					}

					$category = get_the_category ( $post->ID );
					$categoryUrl = get_category_link ( $category [0] );
				?>
			</div><!-- /.box-image -->
		</div>
		<div class="col-sm-8 col-md-9 col-lg-8">
			<div class="box-content">
				<h2 class="box-content-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<?php
				// TODO change hardcoded approach to less messy approach
				if (has_excerpt ( $post->ID )) {
					echo '<p>' . wp_trim_words(get_the_excerpt(), 35 ) . '</p>';
				} else {
					echo '<p>' .strip_shortcodes(wp_trim_words( get_the_content(), 30 )) . '</p>';
				}
				?>
			</div><!-- /.box-content -->
		</div>
	</div>
</article>
