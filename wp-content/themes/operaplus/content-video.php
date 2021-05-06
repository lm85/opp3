<?php
/**
 * Template for main HP box listing
 *
 */
?>

<?php

// Check if exist 'reklama' label
$valueAd = get_field( 'reklama' );

// Check post format
$format = has_post_format('video',$post->ID);

// Check post category "Zprávy"
$term = term_exists('Zprávy', 'category');

if ( $valueAd ) {
	$test = ' ad';
} else {
	$test = '';
} ?>

<article <?php post_class('box' . $test); ?>>

	<div class="box-image">
		<?php
			if (has_post_thumbnail ()) {
				$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'post-sticky' );
				$url = $thumb ['0'];
				echo '<a href="'. get_permalink() .'"><img src="' . $url . '" alt=""></a>';
			} else {
				$content = get_the_content();
				$imageUrl = get_image_url($content);
				if(!empty($imageUrl)) {
					echo '<a href="'. get_permalink() .'"><img src="' . $imageUrl . '" alt=""></a>';
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
	</div>
	<!-- /.box-image -->

	<div class="box-content">
		<span class="label label--recomend">Videoreportáž</span>
		<h2 class="box-content-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
	</div><!-- /.box-content -->

</article>
