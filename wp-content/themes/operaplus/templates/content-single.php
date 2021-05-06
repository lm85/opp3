<div class="breadcrumb">
	<?php
		if (function_exists ( 'yoast_breadcrumb' )) {
			yoast_breadcrumb ();
		}
		?>
</div>

<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class('box--medium'); ?>>
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php
	//			$categoryEvents = get_cat_ID('udalosti');
				
	//			if ( !in_category($categoryEvents) ) {
	//				if ( !is_singular( array( 'soutez', 'zeptejte_se' ) ) ) {
			        	get_template_part('templates/entry-meta');
	//		        }
	//		    } ?>
		</header>
		
		<?php
		$notPaginated = isset($_GET['preview']) || isset($_GET['full']);
$notPaginated = 1;
		
		if(!$notPaginated) {
			$content = wpautop(get_the_content());
			$decomposition = [];
			list ( $page, $max ) = parse_post_pagination ( $content , $decomposition);
			if ($max > 1) {
				$permalink = get_permalink ();
				echo paginate ( $page, $max, $permalink );
			}
		} else {
			$page = 1;
		}
		?>
		
		<div class="content content-post">
			
			<?php
				// Don't show the excerpt if url slug contains tyzden-s-hudbou
				$urlSlug = get_permalink();
				
				$postID = $post->ID;

				// At 12 of the November 2017 we lunched new styles for "Týden s hudbou" icons.
				// Old "Týden s hudbou" articles are with previous icons
				$postDate = strtotime( $post->post_date );
				$featureDate = strtotime( date( '2017-11-12' ) );
			?>
			
			<?php
if ( $page === 1 && has_excerpt ( $post->ID )/* && !strpos($urlSlug, 'tyden-s-hudbou')*/ ) {
					echo '<strong class="excerpt">' . get_the_excerpt () . '</strong>';
				} 
				
/*
				if ( $page === 1 && has_excerpt ( $post->ID ) && !strpos($urlSlug, 'tyden-s-hudbou') ) {
					echo '<strong class="excerpt">' . get_the_excerpt () . '</strong>';
				} elseif ( strpos($urlSlug, 'tyden-s-hudbou') && $postDate < $featureDate ) {
					echo '<strong class="excerpt">' . get_the_excerpt () . '</strong>';
				}*/
			?>

			<?php
			if ($page === 1) {
				$posttags = get_the_tags ();
			}
			if (!empty($posttags)) { ?>
				<div class="tag-list"><span>Témata:</span><?
					foreach ( $posttags as $tag ) {
						echo '<a href=' . get_tag_link ( $tag->term_id ) . '>';
						echo $tag->name . '  ';
						echo '</a>';
					} ?>
				</div><?php
			}
			?>

			<?php
			if($notPaginated) {
				the_content();
			} else {
				echo paginated_content($content);
			}
			?>

		</div><!--/.entry-content-->

		<div class="group group-inline social">
			<div>
<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=60&layout=button&action=like&size=small&share=false&height=65&appId" width="100" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
				<!--<div class="fb-share-button" data-href="<?php echo get_permalink(); ?>" data-layout="button_count"></div>//-->
			</div>
			<div>
				<a href="https://twitter.com/share" class="twitter-share-button" data-via="OperaPlus" data-hashtags="operaplus"></a>
				<script>
jQuery(document).ready(function(){
					!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
});
				</script>
			</div>
		</div>
<div id="nl-box">
<p>Nejaktuálnější zprávy ze světa hudby
<strong>přímo do Vaší schránky</strong></p>
<? echo do_shortcode('[mc4wp_form id="339371"]');?>
</div>
	</article>

	<?php
		if ($max > 1) {
			$permalink = get_permalink ();
			echo paginate ( $page, $max, $permalink );
		}
		$ratingIds = get_post_meta ( $post->ID, 'hodnoceni_id', true );
		$ids = empty ( $ratingIds ) ? array () : explode ( ",", $ratingIds );

		if (! empty ( $ids )) :
	?>

	<h3 class="box-title">Hodnocení</h3>
	<?php
			foreach ( $ids as $id ) {
				$id = trim($id);
				$rating = get_post ( $id );
				echo "<h4>Vaše hodnocení - {$rating->post_title}</h4>";
				echo do_shortcode ( '[yasr_visitor_votes postid="' . $id . '" size="small"]' );
			}

			endif;
			
		echo print_related_posts ( $post->ID );
	?>

	<footer>
		<?php
		wp_link_pages ( [
				'before' => '<nav class="page-nav"><p>' . __ ( 'Pages:', 'sage' ),
				'after' => '</p></nav>'
		] );
		?>
	</footer>

	<?php comments_template('/templates/comments.php'); ?>

<?php endwhile; ?>
