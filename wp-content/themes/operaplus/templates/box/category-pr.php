<?php
// WP_Query arguments
global $ids;
$args = array(
  'category_name' => 'pr-zpravy',
  'posts_per_page' => 6,
  'post__not_in' => $ids,
  'category__not_in' => getCorridorsCategory()
);

echo '<p></p><div><ul>';
// The Query
global $ids;

$query = new WP_Query($args);

// The Loop
if ($query->have_posts()) {
  $i = 0;
  while ($query->have_posts()) {
    $query->the_post();
    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
  }
}

echo '</ul></div>';

// Restore original Post Data
wp_reset_postdata();
?>

