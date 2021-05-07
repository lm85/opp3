<!-- Square-300x250 #1 -->
<div class="ad-square"><?php
	if(function_exists('the_ad_placement')) the_ad_placement('reklama-ad-1'); ?>
</div>

<?php
	if ( is_active_sidebar( 'widget-promo-2' ) ) :
		dynamic_sidebar('widget-promo-2'); 
	endif;
?>

<!-- Infobox #1 -->
<?php dynamic_sidebar('sidebar-primary'); ?>

<?php if (function_exists('wpp_get_mostpopular')) { ?>
<div class="widget popular">
	<h3 class="widget-title">Nejčtenější články</h3>

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#day" role="tab" aria-controls="day">Dnes</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#week" role="tab" aria-controls="week">Týden</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#month" role="tab" aria-controls="month">Měsíc</a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="day" role="tabpanel">
			<div>
				<?php wpp_get_mostpopular( 'range="daily"&limit=6&post_type="post"' );  ?>
			</div>
		</div>
		<div class="tab-pane" id="week" role="tabpanel">
			<div>
				<?php wpp_get_mostpopular( 'range="weekly"&limit=6&post_type="post"' );  ?>
			</div>
		</div>
		<div class="tab-pane" id="month" role="month">
			<div>
				<?php //wpp_get_mostpopular( 'range="monthly"&limit=6&post_type="post"' ); 
//https://gist.github.com/salvatorecapolupo/1110827e6dfd062a6bac5cbf8c9819ff
wpp_get_mostpopular( 'range="last30days"&limit=6&post_type="post"' );
 ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<!-- Infobox #1 -->
<?php dynamic_sidebar('sidebar-newsletter'); ?>

<!-- Square-300x250 #2 -->
<div class="ad-square"><?php
	if(function_exists('the_ad_placement')) the_ad_placement('reklama-ad-2'); ?>
</div>

<?php //get_template_part('templates/sidebar/sidebar-anniversary'); ?>

<!-- Square-300x250 #3 -->
<div class="ad-square"><?php
	if(function_exists('the_ad_placement')) the_ad_placement('reklama-ad-3'); ?>
</div>

<div id="cadc598a361ed26aea96399d56b03e916"></div>
<div class="widget widget_recent_comments">
	<h3 class="widget-title">Nejnovější komentáře</h3>
	<ul>
		<?php
			$args = array (
					'number' => '8',
					'status' => 'approve'
			);
			$comments = get_comments ( $args );
			foreach ( $comments as $comment ) :
				echo '<li><span class="comment-author-link">' . $comment->comment_author . ': </span><a href="/?p=' . $comment->comment_post_ID . '/#comment-' . $comment->comment_ID . '">' . content ( $comment->comment_content, 15 ) . '</a></li>';
			endforeach
			;
		?>
	</ul>
</div>

<!-- Infobox #2 -->
<?php dynamic_sidebar('sidebar-secondary'); ?>

<!-- Square-300x250 #3 -->
<div class="ad-square"><?php
	if(function_exists('the_ad_placement')) the_ad_placement('reklama-ad-4'); ?>
</div>

<?php get_template_part('templates/sidebar/sidebar-interest'); ?>

<!-- Halfpage-300x600 -->
<?php dynamic_sidebar('sidebar-third'); ?>

<!-- Halfpage-300x600 -->
<div class="ad-square"><?php
	if(function_exists('the_ad_placement')) the_ad_placement('reklama-ad-300x600'); ?>
</div>

<?php dynamic_sidebar('sidebar-eshop'); ?>

<!-- Adsense #1 -->
<div class="ad-square"><?php
	if(function_exists('the_ad_placement')) the_ad_placement('reklama-adsense-1'); ?>
</div>

<?php get_template_part('templates/sidebar/sidebar-contest'); ?>
<!-- Adsense #2 -->
<div class="ad-square"><?php
	if(function_exists('the_ad_placement')) the_ad_placement('reklama-adsense-2'); ?>
</div>
<div class="ad-square pod_souteze"><?php
if( function_exists('the_ad_placement') ) { the_ad_placement('pod-souteze'); }
?>
</div>

<?php get_template_part('templates/sidebar/sidebar-events'); ?>

<!-- Adsense #3 -->
<div class="ad-square"><?php
	if(function_exists('the_ad_placement')) the_ad_placement('reklama-adsense-3'); ?>
</div>

<!-- Adsense #4 -->
<div class="ad-adsbygoogle"><?php
	if(function_exists('the_ad_placement')) the_ad_placement('reklama-adsense-4'); ?>
</div>

<!-- Adsense #5 -->
<div class="ad-adsbygoogle"><?php
	if(function_exists('the_ad_placement')) the_ad_placement('reklama-adsense-5'); ?>
</div>

<!-- Adsense #6 -->
<div class="ad-adsbygoogle"><?php
	if(function_exists('the_ad_placement')) the_ad_placement('reklama-adsense-6'); ?>
</div>

<div class="ad-skyscraper ad-skyscraper-right"><?php if(function_exists('the_ad_placement') && !wp_is_mobile()) the_ad_placement('reklama-ad-skyscraper-right'); ?></div>
