<div class="widget">
  <h3 class="widget-title">Soutěže</h3>
  <?php // WP_Query arguments
  $args = array (
    'post_type'              => 'soutez',
    'posts_per_page'         => '5',
    'orderby'                => 'date',
  );

  // The Query
  $query = new WP_Query($args);


  echo '<ul>';
  // The Loop
  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
      $query->the_post();

      echo '<li><a href="' .get_permalink().'">'. get_the_title() .'</a></li>';

    }
  } else {
    // no posts found
  }
  echo '</ul>';

  // Restore original Post Data
  wp_reset_postdata();

  ?>
</div>
