<article <?php post_class('box box-icon box--medium'); ?>>
	<div class="row">
		<div class="col-sm-6 col-md-5 col-lg-6">
			<div class="box-image">
				<?php
					if (has_post_thumbnail ()) {
						$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'post-sticky' );
		
						$url = $thumb ['0'];
						echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" class="box-link"><img src="' . $url . '" alt="">';
					} else {
						$content = get_the_content();
						$imageUrl = get_image_url($content);
						if(!empty($imageUrl)) {
							echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" class="box-link"><img src="' . $imageUrl . '" alt=""></a>';
						} else {
							echo '<div class="thumb"></div>';
						}
					}
					$category = get_the_category ( $post->ID );
					$category = is_array($category)? array_filter($category, function($cat){
						return $cat->category_parent === 34;
					}) : [];
		
					$categoryUrl = get_category_link ( reset($category));
		
				$cat = reset($category);
				if(!empty($cat)) {
					echo '<a href="'.$categoryUrl.'" class="label label--category">'. $cat->cat_name .'</a>';
				}
				?>
			</div><!-- /.box-image -->
		</div>
		
		<div class="col-sm-6 col-md-7 col-lg-6">
			<div class="box-content">
				<span class="label label--recomend">Fotogalerie</span>
				<h2 class="box-content-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
			</div><!-- /.box-content -->
		</div>
	</div><!--/.row-->
</article>
