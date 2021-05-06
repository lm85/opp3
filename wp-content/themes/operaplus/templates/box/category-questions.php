<?php
// WP_Query arguments
global $ids;
$args = array (
  'post_type'              => 'zeptejte_se',
  'posts_per_page'         => '1',
  'orderby'                => 'date',
);

echo '<h3 class="box-title">Zeptejte se sami</h3>';

include 'category-loop.php'; ?>
