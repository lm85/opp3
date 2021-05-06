<?php global $hash; ?>

<header class="banner" role="banner">
    <div class="container">
    <div class="header-bg"></div>


    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <div class="row row-header">
	<div class="brand-logo">
	    <a class="brand" href="<?= esc_url(home_url('/')); ?>">
	    <img src="<?php echo get_template_directory_uri(); ?>/build/img/logo.png?<?php echo $hash; ?>">
	    <span class="brand-title"><?php bloginfo('description'); ?></span>
	    </a>
	</div><!-- /.brand-logo -->
<div class="right_header">
	<div class="brand-nav">
	    <div class="row">
<!--
	    <div class="col-sm-4 col-md-6 col-lg-4 hidden-sm-down">
	        <div class="brand-promo hidden-sm-down">
		<?php //dynamic_sidebar('widget-promo'); ?>
	        </div>
	    </div>
//-->
	    
	    </div>

	</div>
<div class="brand-social hidden-sm-down">
		<a href="https://www.facebook.com/operapluscz/" title="OperaPlus Facebook" target="_blank" class="btn btn-facebook"><?php get_template_part('build/img/icon', 'facebook.svg'); ?></a>
		<a href="https://twitter.com/OperaPlus" title="OperaPlus Twitter" target="_blank" class="btn btn-twitter"><?php get_template_part('build/img/icon', 'twitter.svg'); ?></a>
		<a href="https://www.youtube.com/channel/UCZt56dNHLFAceCsDDcnlQdQ"  target="_blank" title="OperaPlus Youtube" class="btn btn-youtube-play"><?php get_template_part('build/img/icon', 'youtube.svg'); ?></a>
		<a href="http://operaplus.cz/feed/" title="OperaPlus RSS"  target="_blank" class="btn btn-rss"><?php get_template_part('build/img/icon', 'rss.svg'); ?></a>
<a href="https://en.operaplus.cz/" title="English version"  target="_blank" class="btn btn-rss no-lazy enflag">
<svg version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"></circle><g><path style="fill:#0052B4;" d="M52.92, 100.142c-20.109, 26.163-35.272, 56.318-44.101, 89.077h133.178L52.92, 100.142z"></path><path style="fill:#0052B4;" d="M503.181, 189.219c-8.829-32.758-23.993-62.913-44.101-89.076l-89.075, 89.076H503.181z"></path><path style="fill:#0052B4;" d="M8.819, 322.784c8.83, 32.758, 23.993, 62.913, 44.101, 89.075l89.074-89.075L8.819, 322.784L8.819, 322.784   z"></path><path style="fill:#0052B4;" d="M411.858, 52.921c-26.163-20.109-56.317-35.272-89.076-44.102v133.177L411.858, 52.921z"></path><path style="fill:#0052B4;" d="M100.142, 459.079c26.163, 20.109, 56.318, 35.272, 89.076, 44.102V370.005L100.142, 459.079z"></path><path style="fill:#0052B4;" d="M189.217, 8.819c-32.758, 8.83-62.913, 23.993-89.075, 44.101l89.075, 89.075V8.819z"></path><path style="fill:#0052B4;" d="M322.783, 503.181c32.758-8.83, 62.913-23.993, 89.075-44.101l-89.075-89.075V503.181z"></path><path style="fill:#0052B4;" d="M370.005, 322.784l89.075, 89.076c20.108-26.162, 35.272-56.318, 44.101-89.076H370.005z"></path></g><g><path style="fill:#D80027;" d="M509.833, 222.609h-220.44h-0.001V2.167C278.461, 0.744, 267.317, 0, 256, 0   c-11.319, 0-22.461, 0.744-33.391, 2.167v220.44v0.001H2.167C0.744, 233.539, 0, 244.683, 0, 256c0, 11.319, 0.744, 22.461, 2.167, 33.391   h220.44h0.001v220.442C233.539, 511.256, 244.681, 512, 256, 512c11.317, 0, 22.461-0.743, 33.391-2.167v-220.44v-0.001h220.442   C511.256, 278.461, 512, 267.319, 512, 256C512, 244.683, 511.256, 233.539, 509.833, 222.609z"></path><path style="fill:#D80027;" d="M322.783, 322.784L322.783, 322.784L437.019, 437.02c5.254-5.252, 10.266-10.743, 15.048-16.435   l-97.802-97.802h-31.482V322.784z"></path><path style="fill:#D80027;" d="M189.217, 322.784h-0.002L74.98, 437.019c5.252, 5.254, 10.743, 10.266, 16.435, 15.048l97.802-97.804   V322.784z"></path><path style="fill:#D80027;" d="M189.217, 189.219v-0.002L74.981, 74.98c-5.254, 5.252-10.266, 10.743-15.048, 16.435l97.803, 97.803   H189.217z"></path><path style="fill:#D80027;" d="M322.783, 189.219L322.783, 189.219L437.02, 74.981c-5.252-5.254-10.743-10.266-16.435-15.047   l-97.802, 97.803V189.219z"></path></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
</a>
	        </div><!-- /.brand-social -->

	        <div class="brand-search">
		<div class="input-group hidden-md-down">
		    <?php get_search_form(); ?>
		</div><!-- /.input-group -->
	        </div>
</div>
        </div><!--/.row-->
<div class="col-12 col-md-12 col-lg-12 text-center center " id="myHeader">
	        
<div class="brand-logo">
<a class="brand" href="https://operaplus.cz/">
<img class="lazy loaded" src="https://operaplus.cz/wp-content/themes/operaplus/build/img/logo.png?20202020-0707-1313h#v35" data-src="https://operaplus.cz/wp-content/themes/operaplus/build/img/logo.png?20202020-0707-1313h#v35" data-was-processed="true">
<span class="brand-title">Váš průvodce světem hudby, opery a tance</span>
</a>
</div>
	        <button class="navbar-toggler navbar-toggler--menu hidden-lg-up pull-right" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-item"></span>
		<span class="navbar-toggler-item"></span>
		<span class="navbar-toggler-item"></span>
	        </button>
	        <button class="navbar-toggler navbar-toggler--search hidden-lg-up pull-right" type="button" data-toggle="collapse" data-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
		<i class="icon-search"></i>
	        </button>

	        <nav class="hidden-md-down" role="navigation">
<a class="brand stickyimg" href="https://operaplus.cz/">
<img class="lazy loaded" src="https://operaplus.cz/wp-content/themes/operaplus/build/img/logo.png?20202020-0606-2929h#v35" data-src="https://operaplus.buzz/wp-content/themes/operaplus/build/img/logo.png?20202020-0606-2929h#v35" data-was-processed="true">

</a>

		<?php
		if (has_nav_menu('primary_navigation')) :
		    wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
		endif;
		?>
	        </nav>
	    
        <div class="collapse navbar-collapse" id="navbarMenu">
	<nav role="navigation">
	    <?php
	    if (has_nav_menu('primary_navigation')) :
	    wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
	    endif;
	    ?>
	</nav>
        </div><!--/.collapse-->
</div><!--idheader//-->

        <div class="collapse navbar-collapse" id="navbarSearch">
	<div class="input-group">
	    <?php get_search_form(); ?>
	</div><!-- /.input-group -->
        </div><!--/.collapse-->

        <div class="brand-promo hidden-md-up">
	<?php dynamic_sidebar('widget-promo'); ?>
        </div><!-- /.brand-promo -->
    </nav>
    </div>
<?php// wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);?>
</header>

