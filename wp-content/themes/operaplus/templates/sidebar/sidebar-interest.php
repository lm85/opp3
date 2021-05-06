<div class="widget">
  <h3 class="widget-title">Zaujalo nás</h3>
  <?php // WP_Query arguments
  $args = array (
    'category_name'          => 'precetli-jsme',
    'posts_per_page'         => '3',
    'orderby'                => 'date',
  );

	// The Query
	$query = new WP_Query($args);

  echo '<ul>';
  // The Loop
  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
      $query->the_post();
      if (get_field('zaujalo_nas_odkaz')) {
        echo '<li><a href="' .get_field('zaujalo_nas_odkaz').'" target="_blank">'. get_the_title() .'<i class="icon-link-ext"></i></a></li>';
      } else {
        echo '<li><a href="' .get_permalink().'">'. get_the_title() .'</a></li>';
      }
    }
  }

  echo '</ul>';

  // Restore original Post Data
  wp_reset_postdata();

  ?>
</div>
