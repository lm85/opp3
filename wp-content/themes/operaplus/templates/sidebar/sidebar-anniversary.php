<div class="widget anniversary">
	<h3 class="widget-title">Výročí</h3>
	<?php // WP_Query arguments
	$args = array(
		'post_type' => 'vyroci',
		'posts_per_page' => '-1',
		'title_filter' => current_time('j.n.')
	);
	// The Query
	$query = new WP_Query($args);
//echo "<!-- print_r($query) -->";

	echo '<div>';
	// The Loop
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$post = get_post();
			$postMeta = get_metadata('post', $post->ID, 'perioda_koncovka');
			$period = !empty($postMeta) ? $postMeta[0] : '-1';
			$periods = explode(',', $period);
			$lastDigitYear = substr(current_time('Y'), 3);

//			if(in_array($lastDigitYear, $periods)) {
					$replaceText = str_replace("(", "<br>(", get_the_content());
					echo $replaceText;
				break;
//			}
		}
	} else {
		// no posts found
//echo "ne";
	}
	echo '</div>';

	// Restore original Post Data
	wp_reset_postdata();
	?>
</div>
