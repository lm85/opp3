<?php
 if (!is_home()) {
    get_template_part('templates/page', 'header');
}
 ?>

<?php if (!have_posts()) : ?>
    <div class="alert alert-warning">
        <?php _e('Sorry, no results were found.', 'sage'); ?>
    </div>
    <?php get_search_form(); ?>
<?php endif; ?>

<?php
global $ids;
$ids = array();

// sticky post
$stickyPosts = get_option('sticky_posts');

$args = [
    'post__in' => $stickyPosts,
    'category__not_in' => getCorridorsCategory(),
    'posts_per_page' => 1,
    'ignore_sticky_posts' => true
];
//print_r($args);
$the_query = new WP_Query($args);

// The Loop
while ($the_query->have_posts()) {
    $the_query->the_post();
    $ids [] = get_the_ID();
    get_template_part('templates/content-sticky', get_post_format());
}
wp_reset_postdata();


/*
query_posts ( array (
		'posts_per_page' => 1,
		'post__in' => $stickyPosts
) );

get_template_part ( 'templates/content', 'sticky' );
// end sticky post
*/

if (function_exists('the_ad_placement')) { ?>
    <div class="ad-full-banner<?php if (wp_is_mobile()) {
        echo "-mobile";
    } ?>"><?php the_ad_placement('reklama-full-banner'); ?></div><?php
}

if (function_exists('the_ad_placement')) { ?>
    <div class="ad-skyscraper-backup ad-full-banner"><?php the_ad_placement('reklama-skyscraper-backup'); ?></div><?php
}

$ids [] = get_the_ID();

?>
<div class="box-wrapper">

    <?php


    $args = [
        'category__in' => getMainCategories(),
        'post__not_in' => $ids,
        'ignore_sticky_posts' => true,
        'posts_per_page' => 9
    ];


    $the_query = new WP_Query($args);

    while ($the_query->have_posts()) {
        $the_query->the_post();
        $ids [] = get_the_ID();
        get_template_part('templates/content', get_post_format());
    }
    wp_reset_postdata();


    ?>

    <div class="box-group--interview box--medium">
	<div class="box-wrapper--btn aligncenter" style="text-align:center">
<?php
$hurl=esc_url($category_link);
if ($hurl=="") $hurl = "/obsah/#art11";
?>
                <a href="<?php echo $hurl; ?>" class="btn-secondary" title="Další články">Další články</a>
            </div>
        <h4 class="box-group-title box-group-title--interview"><span>Rozhovory</span></h4>
        <div class="row">
            <?php
            $args = [
                'category__not_in' => getCorridorsCategory(),
                'post__not_in' => $ids,
                'ignore_sticky_posts' => true,
                'posts_per_page' => 3,
                'meta_query' => array(
                    array(
                        'key' => 'rozhovory',
                        'value' => 1
                    ),
                ),
            ];

            $the_query = new WP_Query($args);

            // The Loop
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $ids [] = get_the_ID();
                get_template_part('templates/content-interview', get_post_type() != 'post' ? get_post_type() : get_post_format());
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>

	<?php
	
	if (function_exists('the_ad_placement')) { ?>
	    <div class="ad-full-banner<?php if (wp_is_mobile()) {
	        echo "-mobile";
	    } ?>"><?php the_ad_placement('full-banner-recommend'); ?></div><?php
	}
	
	?>

    <div class="box-group--interview box--medium">
        <h4 class="box-group-title box-group-title--interview"><span>Doporučujeme</span></h4>
        <div class="row">
            <?php
            $args = [
                'category__not_in' => getCorridorsCategory(),
                'post__not_in' => $ids,
                'ignore_sticky_posts' => true,
                'posts_per_page' => 3,
                'meta_query' => array(
                    array(
                        'key' => 'doporucujeme',
                        'value' => 1
                    ),
                ),
            ];

            $the_query = new WP_Query($args);

            // The Loop
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $ids [] = get_the_ID();
                get_template_part('templates/content-interview', get_post_type() != 'post' ? get_post_type() : get_post_format());
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>

	<?php
	
	if (function_exists('the_ad_placement')) { ?>
	    <div class="ad-full-banner<?php if (wp_is_mobile()) {
	        echo "-mobile";
	    } ?>"><?php the_ad_placement('reklama-full-banner-2'); ?></div><?php
	}
	
	?>

    <div class="row">
        <div class="col-lg-8">
            <?php
            $args = [
                'category__not_in' => getCorridorsCategory(),
                'post__not_in' => $ids,
                'ignore_sticky_posts' => true,
                'posts_per_page' => 4,
                'meta_query' => array(
                    array(
                        'key' => 'recenze',
                        'value' => 1
                    ),
                ),
            ];

            $the_query = new WP_Query($args);

            // The Loop
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $ids [] = get_the_ID();
                get_template_part('templates/content-reviews', get_post_type() != 'post' ? get_post_type() : get_post_format());
            }
            wp_reset_postdata();
            ?>


            <?php
            // Get the ID of a given category
            $category_id = get_cat_ID('Hlavní');

            // Get the URL of this category
            $category_link = get_category_link($category_id);
            ?>

            
        </div><!--/.col-md-8-->

        <div class="col-lg-4">
            <div class="box-group--actual">
                <h4 class="box-group-title box-group-title--actual">Aktuální téma</h4>
                <?php

                    $args = [
                        'category__not_in' => getCorridorsCategory(),
                        'post__not_in' => $ids,
                        'ignore_sticky_posts' => true,
                        'posts_per_page' => 2,
                        'meta_query' => array(
                            array(
                                'key' => 'aktualni-tema',
                                'value' => 1
                            ),
                        ),
                    ];

                    $the_query = new WP_Query( $args );

                    // The Loop
                    while ( $the_query->have_posts() ) {
                    	$the_query->the_post();
                        $ids [] = get_the_ID();
                        get_template_part('templates/content-actual', get_post_type() != 'post' ? get_post_type() : get_post_format());
                    }
                    wp_reset_postdata();
                ?>

                <?php if (function_exists('the_ad_placement')) the_ad_placement('reklama-ad-actual'); ?>
            </div>
        </div><!--/.col-md-4-->
    </div>
</div>


<?php if (function_exists('the_ad_placement')) { ?>
    <div class="ad-full-banner<?php if (wp_is_mobile()) {
        echo "-mobile";
    } ?>"><?php the_ad_placement('reklama-full-banner-3'); ?></div><?php
} ?>

<div class="clearfix">
    <div class="box box-category box-extend">
        <?php get_template_part('templates/box/extend'); ?>
    </div>
</div>

<?php if (function_exists('the_ad_placement')) { ?>
    <div class="ad-full-banner<?php if (wp_is_mobile()) {
        echo "-mobile";
    } ?>"><?php the_ad_placement('reklama-full-banner-4'); ?></div><?php
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

<?php if (function_exists('the_ad_placement')) { ?>
    <div class="ad-full-banner<?php if (wp_is_mobile()) {
        echo "-mobile";
    } ?>"><?php the_ad_placement('reklama-full-banner-5'); ?></div><?php
} ?>

<div class="box-pr ad ad--pr">
    <?php get_template_part('templates/box/category-pr'); ?>
</div>

