<div <?php post_class('box-group box-icon box-icon_small box-group--small box-group--recommended'); ?>>
	<div class="row">
		<div class="box box--recommended">
			<div class="col-sm-4 col-md-3 col-lg-6">
				<div class="box-image">
					<?php
						if (has_post_thumbnail ()) {
							$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id ( $postID ), 'thumbnail' );
							$url = $thumb ['0'];
							echo '<a href="'. get_permalink() .'">';
								echo  '<img src="' . $url . '" alt="">';
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
			</div><!-- /.col-sm-5 -->
			<div class="col-sm-8 col-md-9 col-lg-6">
				<div class="box-content">
					<span class="label label--recomend">Recenze</span>
					<h3 class="box-content-title bold">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
				</div><!--/.box-content -->
			</div><!--/.col-sm-7-->
		</div>
	</div><!--/.row-->
</div>
