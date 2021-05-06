<?php
// WP_Query arguments
global $ids;
$args = array(
  'category_name' => 'ruzne',
  'posts_per_page' => '5',
  'post__not_in' => $ids,
  'category__not_in' => getCorridorsCategory()
);

// Get the ID of a given category
$category_id = get_cat_ID('ruzne');

// Get the URL of this category
$category_link = get_category_link( $category_id );

include 'category-loop.php';
