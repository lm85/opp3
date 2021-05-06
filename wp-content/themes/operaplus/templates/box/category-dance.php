<?php
// WP_Query arguments
global $ids;
$args = array(
  'category_name' => 'balet',
  'posts_per_page' => '5',
  'post__not_in' => $ids,
  'category__not_in' => getCorridorsCategory()
);

echo '<h3 class="box-title"><a href="obsah/balet">Tanec</a></h3>';

include 'category-loop.php';
