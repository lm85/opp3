  <article <?php post_class('box'); ?>>
    <div class="box-image">
        <?php //get_template_part('templates/entry-meta'); ?>
        <?php
        if ( has_post_thumbnail() ) {
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
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
        }

        $category = get_the_category( $post->ID ); ?>

        <?php echo '<a href="'. $category[0]->slug .'" class="label label--category">'. $category[0]->cat_name .'</a>' ?>
    </div><!-- /.box-image -->

    <div class="box-content">
      <span class="label label--recomend">Doporučujeme</span>
      <h2 class="box-content-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </div><!-- /.box-content -->
  </article>

