<?php
if (post_password_required()) {
  return;
}
?>

<section id="comments" class="comments">
  <?php if (have_comments()) : ?>
    <h3 class="box-title">
      <?php printf(_nx('Komentáře &ldquo;%2$s&rdquo;', 'Reakcí (%1$s) &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sage'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>'); ?>
    </h3>

    <ol class="comment-list">
      <?php wp_list_comments(['style' => 'ol', 'short_ping' => true]); ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <nav>
        <ul class="pager">
          <?php if (get_previous_comments_link()) : ?>
            <li class="previous"><?php previous_comments_link(__('&larr; Starší komentáře', 'sage')); ?></li>
          <?php endif; ?>
          <?php if (get_next_comments_link()) : ?>
            <li class="next"><?php next_comments_link(__('Novější komentáře &rarr;', 'sage')); ?></li>
          <?php endif; ?>
        </ul>
      </nav>
    <?php endif; ?>
  <?php endif; // have_comments() ?>

  <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert alert-warning">
      <?php _e('Komentáře jsou uzavřeny.', 'sage'); ?>
    </div>
  <?php endif; ?>

  <?php comment_form(); ?>
</section>
