<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

$postFormat = get_post_format(); 

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<?php get_template_part('templates/head'); ?>
	<body <?php body_class(); ?>>
		<!--[if lt IE 9]>
			<div class="alert alert-warning">
				<?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
			</div>
		<![endif]-->

		<div class="header">
			<div class="container">
				<?php if(function_exists('the_ad_placement')) { ?>
					<div class="ad-leaderboard<?php if ( wp_is_mobile() ) { echo "-mobile"; } ?>"><?php the_ad_placement('reklama-leaderboard-1'); the_ad_placement('reklama-leaderboard-2'); ?></div><?php
				} ?>
			</div>

			<?php
				do_action('get_header');
				get_template_part('templates/header');
			?>
		</div>

		<div class="wrap container violin" role="document">
			<div class="row" id="mainrow" style="/*top:-21px*/">
				
				<main class="main <?php if (($postFormat == 'aside' ) && is_single()) : echo 'special'; endif; ?>" role="main">
					<?php include Wrapper\template_path(); ?>

					<div class="ad-skyscraper ad-skyscraper-left"><?php if(function_exists('the_ad_placement') && !wp_is_mobile()) the_ad_placement('reklama-ad-skyscraper-left'); ?></div>

				</main><!-- /.main -->
				<?php if (Config\display_sidebar()) : ?>
					<?php
						/* Disable sidebar if post format is aside */
						if (($postFormat == 'aside' ) && is_single()) {}
						else { ?>
							<aside class="sidebar" role="complementary">
								<?php
									if (in_category('udalosti')) {
										get_template_part('templates/sidebar-events');
									} else {
										include Wrapper\sidebar_path();
									} ?>
							</aside><!-- /.sidebar -->
						<?php } ?>
				<?php endif; ?>
			</div><!-- /.content -->

		</div><!-- /.wrap -->
		<?php
			do_action('get_footer');
			get_template_part('templates/footer');
			wp_footer();
		?>
	</body>
</html>
