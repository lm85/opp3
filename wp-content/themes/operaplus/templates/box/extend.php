<?php
// WP_Query arguments
global $ids;
$args = array (
		'category_name' => 'z-kuloaru',
		'posts_per_page' => '7',
		'post__not_in' => $ids
);

echo '<h3 class="box-title"><a href="z-kuloaru/">Z kuloárů</a></h3>';

// The Query
$query = new WP_Query ( $args ); ?>

<div class="row">
	<?php
	// The Loop
	if ($query->have_posts ()) {

		$i = 0;

		while ( $query->have_posts () ) {
			$query->the_post ();

			if ($i == 0) { ?>
				<div class="col-md-6">
					<div class="row">
						<div class="col-sm-4 col-md-6"><?php
							if (has_post_thumbnail ()) {
								$post = get_post ();
								$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'thumbnail' );
								$url = $thumb ['0'];
								echo '<a href="'. get_permalink() .'"><img src="' . $url . '" alt="'. get_the_title() .'"></a>';
							} else {
								$content = get_the_content();
								$imageUrl = get_image_url($content);
								if(!empty($imageUrl)) {
									echo '<a href="'. get_permalink() .'"><img src="' . $imageUrl . '" alt="'. get_the_title() .'"></a>';
								} else {
									echo '<div class="thumb"></div>';
								}
							} ?>
						</div>
						<div class="col-sm-8 col-md-6"><?php
							echo '<h4><a href = "' . get_the_permalink () . '" title = "' . get_the_title () . '" > ' . get_the_title () . '</a></h4>'; ?>
						</div>
					</div><!--/.row--><?php
			}

			if ($i >= 1) {
					echo '<p><a href = "' . get_the_permalink () . '" title = "' . get_the_title () . '" > ' . get_the_title () . '</a></p>';
			}

			if ($i == 2) { ?>
				</div><?php
			}

			if ($i == 2) { ?>
				<div class="col-md-6"><?php
			}
			if ($i == 6) { ?>
				</div><?php
			}

			$ids [] = $post->ID;
			$i ++;
		}
	}

	// Restore original Post Data
	wp_reset_postdata (); ?>
</div><!--/.row-->
