<?php if (!is_home()) {
	get_template_part('templates/page', 'header');
} ?>

<?php if (!have_posts()) : ?>
<div class="alert alert-warning">
		<?php _e('Sorry, no results were found.', 'sage'); ?>
	</div>
<?php get_search_form(); ?>
<?php endif; ?>

<?php
global $ids;
$ids = array ();

// sticky post
$stickyPosts = get_option ( 'sticky_posts' );

query_posts ( array (
		'posts_per_page' => 1,
		'post__in' => $stickyPosts
) );

get_template_part ( 'templates/content', 'sticky' );
// end sticky post

if(function_exists('the_ad_placement')) { ?>
	<div class="ad-full-banner<?php if ( wp_is_mobile() ) { echo "-mobile"; } ?>"><?php the_ad_placement('reklama-full-banner'); ?></div><?php
}

$ids [] = get_the_ID ();

// main posts
query_posts ( array (
	'posts_per_page' => 9,
	'post__not_in' => $ids,
	'category__in' => getMainCategories ()
) ); ?>

<div class="box-wrapper">

	<?php
		while ( have_posts () ) :
			the_post ();
			$ids [] = get_the_ID ();
			get_template_part ( 'templates/content', get_post_type () != 'post' ? get_post_type () : get_post_format () );
		endwhile;
	?>

	<div class="row">
		<div class="col-lg-8">
			<?php
				query_posts ( array (
					'meta_key' => 'doporucujeme',
					'meta_value' => TRUE,
					'post__not_in' => $ids,
					'posts_per_page' => 4,
					'category__not_in' => getCorridorsCategory ()
				) );

				while ( have_posts () ) :
					the_post ();
					if (get_field ( 'doporucujeme' )) {
						$ids [] = get_the_ID ();
						get_template_part ( 'templates/recommend', get_post_type () != 'post' ? get_post_type () : get_post_format () );
					}
				endwhile;
			?>
			<?php
				// Get the ID of a given category
				$category_id = get_cat_ID('Hlavní');

				// Get the URL of this category
				$category_link = get_category_link( $category_id );
			?>

			<div class="box-wrapper--btn">
				<a href="<?php echo esc_url( $category_link ); ?>" class="btn-secondary" title="Všechny články">Všechny články</a>
			</div>
		</div><!--/.col-md-8-->

		<div class="col-lg-4">
			<div class="box-group--actual">
				<h4 class="box-group-title box-group-title--actual">Aktuální téma</h4>
				<?php
					query_posts ( array (
						'meta_key' => 'aktualni-tema',
						'meta_value' => TRUE,
						'post__not_in' => $ids,
						'posts_per_page' => 2,
						'category__not_in' => getCorridorsCategory ()
					) );

					while ( have_posts () ) :
						the_post ();
						if (get_field ( 'aktualni-tema' )) {
							$ids [] = get_the_ID ();
							get_template_part ( 'templates/content-actual', get_post_type () != 'post' ? get_post_type () : get_post_format () );
						}
					endwhile;
				?>

				<?php if(function_exists('the_ad_placement')) the_ad_placement('reklama-ad-actual'); ?>
			</div>
		</div><!--/.col-md-4-->
	</div>
</div>


<?php if(function_exists('the_ad_placement')) { ?>
	<div class="ad-full-banner-2<?php if ( wp_is_mobile() ) { echo "-mobile"; } ?>"><?php the_ad_placement('reklama-full-banner-2'); ?></div><?php
} ?>

<div class="clearfix">
	<div class="box box-category box-extend">
		<?php get_template_part('templates/box/extend'); ?>
	</div>
</div>

<?php if(function_exists('the_ad_placement')) { ?>
	<div class="ad-full-banner-3<?php if ( wp_is_mobile() ) { echo "-mobile"; } ?>"><?php the_ad_placement('reklama-full-banner-3'); ?></div><?php
} ?>

<div class="clearfix">

	<!-- box category Hudba -->
	<div class="box box-category">
		<?php get_template_part('templates/box/category-music'); ?>
	</div>

	<!-- box category Opera -->
	<div class="box box-category opera">
		<?php get_template_part('templates/box/category-opera'); ?>
	</div>

</div>

<div class="clearfix">

	<!-- box category Tanec -->
	<div class="box box-category">
		<?php get_template_part('templates/box/category-dance'); ?>
	</div>

	<!-- box category Ostatní -->
	<div class="box box-category others">
		<?php get_template_part('templates/box/category-others'); ?>
	</div>

</div>

<div class="clearfix">
	<!-- box category Opera -->
	<div class="box box-category box--small">
		<?php get_template_part('templates/box/category-blog'); ?>
	</div>

	<!-- box category Tanec -->
	<div class="box box-category box--small">
		<?php get_template_part('templates/box/category-questions'); ?>
	</div>
</div>

<?php if(function_exists('the_ad_placement')) { ?>
	<div class="ad-full-banner-4<?php if ( wp_is_mobile() ) { echo "-mobile"; } ?>"><?php the_ad_placement('reklama-full-banner-4'); ?></div><?php
} ?>

<div class="box-pr ad ad--pr">
	<?php get_template_part('templates/box/category-pr'); ?>
</div>
