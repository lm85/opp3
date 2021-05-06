<p class="byline author vcard entry-meta">
  <?php
		if(in_array(get_post_type( get_the_ID()), array ('infobox', 'footer'))) {
			return;
		}
		$authors = wp_get_post_terms ( $post->ID, 'autori', array (
				"fields" => "all"
		) );
  		if((empty($authors->errors))) {
			foreach ( $authors as $author ) {
				$authorName = implode ( ' ', array_reverse ( explode ( ' ', $author->name ) ) );
				$authorUrl = get_term_link ( $author );
				echo "<a href='{$authorUrl}' rel='author' class='fn'>{$authorName}</a>, ";
			}
		}
		$postDateTimeReadable = get_the_time ( 'd.m.Y G:i', $post );
		$postDateTime = get_the_time ( 'c', $post );
		echo "<time class='' datetime='{$postDateTime}'>{$postDateTimeReadable}</time>";

		?>
		<?php if (get_field('aktualizovano')) {
			echo '<span class="label label--updated">aktualizováno</span>';
		}
		// Check if exist 'reklama' label
		$valueAd = get_field( 'reklama' );

		if ( $valueAd ) {
			echo '<span class="label label--info">Komerční sdělení</span>';
		} ?>
</p>
