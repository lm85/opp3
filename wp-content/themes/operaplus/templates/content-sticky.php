<?php
	$category = get_the_category ( $post->ID );
	$categoryUrl = get_category_link ( $category [0] );

	// Exclude category "Ptali jste se"
	$categoryExclude = $category[0]->category_parent == 8678;

	// Sticky post content
	$postStickyContent = get_the_content();

	// Check if exist this categories
	$term = term_exists('Zprávy', 'category');
	
	$post_id = get_the_ID();
					
	$format = get_post_format( $post_id );

?>

<article <?php post_class('box box-icon box-sticky box--medium'); ?>>
	<div class="row">
		<div class="col-sm-6 col-md-5 col-lg-6">
			<div class="box-image">
				<?php
				if (has_post_thumbnail()) {
					$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id( $post->ID ), 'post-sticky' );
					$url = $thumb ['0'];
					echo '<a href="' .get_permalink(). '" title="'. get_the_title() .'" class="box-link">';
					echo 	'<img src="' . $url . '" alt="'. get_the_title() .'">';
					echo '</a>';
				} else {
					$imageUrl = get_image_url($postStickyContent);
					if(!empty($imageUrl)) {
						echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" class="box-link"><img src="' . $imageUrl . '" alt="'. get_the_title() .'"></a>';
					} else {
						echo '<div class="thumb"></div>';
					}
				}

			// Exclude category label "Ptali jste se" and "Speciální stránka"
			$categoryExclude = $category[0]->category_parent == 8678;
			$categoryExcludeSpecial = $category[0]->term_id == 21372;

			if ( isset($category [1])) {
				$categoryExcludeUrl = get_category_link ( $category [1] );
			}

			// ToDo change to better solution. Change category name if parent category is "Ptali jste se"
			if ($categoryExclude || $categoryExcludeSpecial) {
				echo '<a href="' . $categoryExcludeUrl . '" class="label label--category">' . $category[1]->cat_name . '</a>';
			} else {
				echo '<a href="' . $categoryUrl . '" class="label label--category">' . $category[0]->cat_name . '</a>';
			} ?>

			</div><!-- /.box-image -->
		</div>

		<div class="col-sm-6 col-md-7 col-lg-6">
			<div class="box-content">
				<?php
					if ( $format == 'video' ) {
						echo '<span class="label label--recomend">Videoreportáž</span>';
					} elseif ( $format == 'gallery' ) {
						echo '<span class="label label--recomend">Fotogalerie</span>';
					}
				 ?>
				<h2 class="box-content-title--sticky">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<?php
					if ($term !== 0 && $term !== null) {
						if (has_excerpt ( $post->ID )) {
							echo '<p>' . wp_trim_words( get_the_excerpt(), 25 ) . '</p>';
						} else {
							echo '<p>' .wp_trim_words( strip_shortcodes( $postStickyContent ), 25) . '</p>';
						}
					}
				?>
			</div><!-- /.box-content -->
		</div>
	</div>

</article>
