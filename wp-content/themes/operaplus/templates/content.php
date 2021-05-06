<?php
	// Check if exist this categories
	$term = term_exists('Zprávy', 'category');
	
	// Check if exist 'reklama' label
	$valueAd = get_field( 'reklama' );

	if ( $valueAd ) {
		$adClass = ' ad ad--list';
	} else {
		$adClass = '';
	}

	$postID = $post->ID;
	
	$format = get_post_format( $postID );
?>

<article <?php post_class('box box-icon box--medium list' .$adClass); ?>>
	<div class="box">
		<div class="row">
			<div class="col-sm-4 col-md-3 col-lg-4">
				<div class="box-image">
				<?php
                	if (has_post_thumbnail ()) {
//						$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'thumbnail' );
//						$url = $thumb ['0'];
//
						echo '<a href="' .get_permalink(). '" title="'. get_the_title() .'" class="box-link">';
						//echo 	'<img src="' . $url . '" alt="'. get_the_title() .'">';
                        the_post_thumbnail('archive-thumb');
                        echo '</a>';


					} else {
						$content = get_the_content();
						$imageUrl = get_image_url($content);
						if(!empty($imageUrl)) {
							echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" class="box-link"><img src="' . $imageUrl . '" alt=""></a>';
						} else {
							echo '<div class="thumb"></div>';
						}
					}

					//$category = get_the_category ( $post->ID );
$post_categories = get_post_primary_category($post->ID, 'category'); 
$category[0] = $post_categories['primary_category'];

//print_r($post_categories);
					$categoryUrl = get_category_link ( $category[0] );

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
						echo '<a href="' . $categoryUrl . '" class="label label--category">' . $category[0]->name . '</a>';
					} ?>
				</div><!-- /.box-image -->
			</div>

			<div class="col-sm-8 col-md-9 col-lg-8">

				<div class="box-content">
					<?php
						if ( $format == 'video' ) {
							echo '<span class="label label--recomend">Videoreportáž</span>';
						} elseif ( $format == 'gallery' ) {
							echo '<span class="label label--recomend">Fotogalerie</span>';
						} elseif ( $format == 'aside' ) {
							echo '<span class="label label--recomend">Článek plus</span>';
						}
					 ?>
				 
					<?php // Check if the parent category is "Zpráva"
						$parrentCategory = $category[1]->parent; 
						
						// Zpráva ID 3397
						if ($parrentCategory == '9973') {
							echo '<span class="label label--news">Zpráva</span>';
						}
					?>
					
					<h2 class="box-content-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>

					<?php
					if ($term !== 0 && $term !== null && $parrentCategory != '9973') {
						if (has_excerpt ( $post->ID )) {
							echo '<p>' . wp_trim_words( get_the_excerpt(), 25 ) . '</p>';
						} else {
							echo '<p>' .wp_trim_words( strip_shortcodes( get_the_content() ), 25) . '</p>';
						}
					}
					?>
				</div><!-- /.box-content -->
			</div>
		</div><!-- /.row-->
	</div>
</article>
