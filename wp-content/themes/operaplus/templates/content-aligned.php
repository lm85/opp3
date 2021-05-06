<article <?php post_class('box'); ?>>
  <a href="<?php the_permalink(); ?>" class="box-wrapper">
    <div>
        <?php //get_template_part('templates/entry-meta'); ?>
        <?php
        if ( has_post_thumbnail() ) {
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
          $url = $thumb['0'];
          echo '<img src="' .$url. '" alt="">';
        } else {
			$content = get_the_content();
			$imageUrl = get_image_url($content);
			if(!empty($imageUrl)) {
				echo '<img src="' . $imageUrl . '" alt="">';
			} else {
				echo '<div class="thumb"></div>';
			}
        } ?>

    </div><!-- /.box-image -->

    <div>
      <h2 class="box-content-title"><?php the_title(); ?></h2>
    </div><!-- /.box-content -->
  </a>
</article>
