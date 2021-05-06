<?php
	// Check if exist this categories
	$term = term_exists('Zprávy', 'category');
?>

<article <?php post_class('box box-icon box--medium' .$adClass); ?>>
	<div class="row">
		<div class="col-sm-6 col-md-5 col-lg-6">
			<div class="box-image">
			<?php
				if (has_post_thumbnail ()) {
					$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'post-sticky' );
					$url = $thumb ['0'];
					echo '<a href="' .get_permalink(). '" title="'. get_the_title() .'" class="box-link">';
						echo '<img src="' . $url . '" alt="'. get_the_title() .'">';
					echo '</a>';
				} else {
					$content = get_the_content();
					$imageUrl = get_image_url($content);
					if(!empty($imageUrl)) {
						echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" class="box-link">';
							echo '<img src="' . $imageUrl . '" alt="'. get_the_title() .'">';
						echo '</a>';
					} else {
						echo '<div class="thumb"></div>';
					}
				}

				$category = get_the_category ( $post->ID );
				$categoryUrl = get_category_link ( $category [0] );

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
				<span class="label label--recomend">Článek plus</span>
				<h2 class="box-content-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
			</div><!-- /.box-content -->
		</div>
	</div><!-- /.row-->
</article>
