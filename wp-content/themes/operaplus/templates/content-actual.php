<div <?php post_class('box box-icon box-icon_small box--small box--recommended') ?>>
	<div class="row">
		<div class="col-sm-4 col-md-3 col-lg-12">
			<div class="box-image">
				<?php
					if (has_post_thumbnail ()) {
						$thumbDesktop = wp_get_attachment_image_src ( get_post_thumbnail_id ( $postID ), 'thumbnail' );
						// srcset support $thumbMobile = wp_get_attachment_image_src ( get_post_thumbnail_id ( $postID ), 'actual-post-thumbnails' );

						$url = $thumbDesktop['0'];
						echo '<a href="'. get_permalink() .'">';
							echo  '<img src="' . $url . '" alt="' .get_the_title(). '">';
						echo '</a>';
					} else {
						$content = get_the_content();
						$imageUrl = get_image_url($content);

						if(!empty($imageUrl)) {
							echo '<a href="'. get_permalink() .'"><img src="' . $imageUrl . '" alt=""></a>';
						} else {
							echo '<a href="'. get_permalink() .'"><div class="thumb"></div></a>';
						}
					}

					$category = get_the_category ( $postID );
					$categoryUrl = get_category_link ( $category [0] );

					// Exclude category "Ptali jste se"
					$categoryExclude = $category[0]->category_parent == 8678;

					if ( isset($category [1])) {
							$categoryExcludeUrl = get_category_link ( $category [1] );
					}

					// ToDo change to better solution. Change category name if parent category is "Ptali jste se"
					if ($categoryExclude) {
						echo '<a href="' . $categoryExcludeUrl . '" class="label label--category">' . $category[1]->cat_name . '</a>';
					} else {
						echo '<a href="' . $categoryUrl . '" class="label label--category">' . $category[0]->cat_name . '</a>';
					}
				?>
			</div><!--/.box-image -->
		</div>
		<div class="col-sm-8 col-md-9 col-lg-12">
			<div class="box-content">
				<h5 class="box-content-title bold">
					<a href="<?php the_permalink(); ?>" class="box-content-link"><?php echo wp_trim_words( get_the_title(), 10, '...'  ); ?></a>
				</h5>
			</div><!--/.box-content -->
		</div>
	</div>
</div>

