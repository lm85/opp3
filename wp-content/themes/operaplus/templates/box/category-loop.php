<?php
if (isset ( $category_link )) {
	echo '<h3 class="box-title"><a href="' . esc_url ( $category_link ) . '">' . get_cat_name ( $category_id ) . '</a></h3>';
}
?>

<?php
// The Query
global $ids; 

$query = new WP_Query ( $args );   

// The Loop
if ($query->have_posts ()) {
	$i = 0;
	while ( $query->have_posts () ) {

		$query->the_post ();

		if ($i == 0) { ?>
			<div <?php post_class('box box-icon box-icon_small'); ?> style="overflow: hidden;">
			<div class="box-image box-category--media" >
			
			<?php
			if (has_post_thumbnail ()) {
				$post = get_post ();
				$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'thumbnail' );
				$url = $thumb ['0'];
				echo '<a href = "' . get_the_permalink () . '" title = "' . get_the_title () . '" ><img src="' . $url . '" alt=""></a>';
			} else {
				$content = get_the_content();
				$imageUrl = get_image_url($content);
				if(!empty($imageUrl)) {
					echo '<a href = "' . get_the_permalink () . '" title = "' . get_the_title () . '" ><img src="' . $imageUrl . '" alt=""></a>';
				} else {
					echo '<div class="thumb"></div>';
				}
			}

			echo '</div><h4 class="box-category--title">';
			echo '<a href = "' . get_the_permalink () . '" title = "' . get_the_title () . '" >' . get_the_title () . '</a >';
			echo '</h4></div >';
		} else {
			echo '<p><a href="' . get_permalink () . '">' . get_the_title () . '</a></p>';
		}
		$ids [] = $post->ID;
		$i ++;
	}
}

// Restore original Post Data
wp_reset_postdata ();
?>
