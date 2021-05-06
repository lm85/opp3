<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
DEFINE('OPERAPLUS_PREFIX','_operaplus_');


include get_template_directory()."/de.php";
$sage_includes = array (
		'lib/utils.php', // Utility functions
		'lib/init.php', // Initial theme setup and constants
		'lib/wrapper.php', // Theme wrapper class
		'lib/conditional-tag-check.php', // ConditionalTagCheck class
		'lib/config.php', // Configuration
		'lib/assets.php', // Scripts and stylesheets
		'lib/titles.php', // Page titles
		'lib/extras.php',
        'vendor/autoload.php'
); // Custom functions

foreach ( $sage_includes as $file ) {
	if (! $filepath = locate_template ( $file )) {
		trigger_error ( sprintf ( __ ( 'Error locating %s for inclusion', 'sage' ), $file ), E_USER_ERROR );
	}

	require_once $filepath;
}
unset ( $file, $filepath );

// support for distributed development
if (defined ( 'WP_DEV' ) && WP_DEV) {
	require "lib/url-rewrite.php";
}

require_once ('operaplus-framework/operaplus.php');

function custom_excerpt_length($length) {
	return 22;
}

add_filter ( 'excerpt_length', 'custom_excerpt_length', 999 );
function paginate($current, $max, $urlBase) {
	$result = '<ol class="wp-paginate">';
	if ($current > 1) {
		$url = sprintf ( '%s?pa=%d', $urlBase, $current - 1 );
		$label = '‹ předchozí';
		$result .= "<li><a class='prev' href='{$url}'>{$label}</a></li>";
	}
	for($i = 0; $i < $max; $i ++) {
		$url = sprintf ( '%s?pa=%d', $urlBase, $i + 1 );
		$label = $i + 1;
		if ($i + 1 === $current) {
			$result .= "<li><span class='page current'>{$label}</span></li>";
		} else {
			$result .= "<li><a class='page' href='{$url}'>{$label}</a></li>";
		}
	}
	if ($current < $max) {
		$url = sprintf ( '%s?pa=%d', $urlBase, $current + 1 );
		$label = 'následující ›';
		$result .= "<li><a class='next' href='{$url}'>{$label}</a></li>";
	}
	$result .= '</ol>';
	return $result;
}

/**
 * ID of category "Z kuluaru"
 */
function getCorridorsCategory() {
	return array (
			'84'
	);
}

/**
 * Array of cat ids for main post listing
 *
 * @return array
 */
function getMainCategories() {
	return array (
			9973, // Zpravy
			9974, // Zpravy - Tanec
			9975, // Zpravy - Hudba
			9976, // Zpravy - Opera
			9977, // Zpravy - Ruzne
			33, // Hudba
			32, // Opera
			31, // Ruzne
			30
	); // // Tanec
}

function print_related_posts($post_id, $count = 6) {
	$not = array (
			$post_id
	);

	$gotCounter = 0;
	$output = array ();

	$taxonomies = array (
			'souvisejici-clanky',
			'serialy',
			'jmenny_rejstrik',
			'dila',
			'vecny_rejstrik'
	);
	$taxonomiesFlipped = array_flip ( $taxonomies );
	$args = array (
			'orderby' => 'date'
	);

	$terms = wp_get_post_terms ( $post_id, $taxonomies, $args );
	if (! is_array ( $terms )) {
		$terms = array ();
	}
	usort ( $terms, function ($a, $b) use($taxonomiesFlipped) {
		if ($taxonomiesFlipped [$a->taxonomy] < $taxonomiesFlipped [$b->taxonomy]) {
			return - 1;
		} elseif ($taxonomiesFlipped [$a->taxonomy] === $taxonomiesFlipped [$b->taxonomy]) {
			return 0;
		} else {
			return 1;
		}
	} );

	// TODO showposts could conflict with $count
	foreach ( $terms as $term ) {
		if ($gotCounter > $count) {
			break;
		}
		$posts = get_posts ( array (
				'showposts' => '10',
				$term->taxonomy => $term->slug,
				'post__not_in' => $not,
				'post_type' => 'post'
		) );
		foreach ( $posts as $post ) {
			if (++ $gotCounter > $count) {
				break;
			}
			if (has_post_thumbnail ( $post->ID )) {
				$thumbSrc = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ) );
				$thumbSrc = $thumbSrc [0];
				$thumb = "<img src='{$thumbSrc}'/>";
			}
            $format = get_post_format($post->ID) ? : 'standard';

            $output [] = "<li class='related-item box box-icon box-icon_small format-".$format." col-md-6'><div class='row'><div class='box-image col-6'><a href='" . get_permalink ( $post ) . "' title='" . get_the_title ( $post ) . "'>" . $thumb . "</a></div><div class='col-6'><a href='" . get_permalink ( $post ) . "' class='title' rel='bookmark' title='" . get_the_title ( $post ) . "'>" . get_the_title ( $post ) . "</a></div></div></li>\n\n";
			$not [] = $post->ID;
		}
	}
	if (! empty ( $output )) {
		echo '<h3 class="box-title">Mohlo by vás zajímat</h3><ul class="related">';
		foreach ( $output as $item ) {
			echo $item;
		}
		echo '</ul><div style="clear: both;"></div><br/>';
	}
}
function content($text, $limit) {
	$content = explode ( ' ', $text, $limit );
	if (count ( $content ) >= $limit) {
		array_pop ( $content );
		$content = implode ( " ", $content ) . '...';
	} else {
		$content = implode ( " ", $content );
	}
	$content = preg_replace ( '/\[.+\]/', '', $content );
	$content = str_replace ( ']]>', ']]&gt;', $content );
	$content = strip_tags ( $content );
	return $content;
}
function title_filter($where, &$wp_query) {
	global $wpdb;

	if ($search_term = $wp_query->get ( 'title_filter' )) {
		/* using the esc_like() in here instead of other esc_sql() */
		$search_term = $wpdb->esc_like ( $search_term );
		$search_term = ' \'' . $search_term . '\'';
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE ' . $search_term;
	}

	return $where;
}
function paginated_content($content, $allowedChars = 6000) {
	$decomposition = [ ];
	list ( $page, $max ) = parse_post_pagination ( $content, $decomposition, $allowedChars );
	if ($page > 0 && $page <= $max) {
		$content = implode ( PHP_EOL, $decomposition [$page - 1] );
	}
	$content = apply_filters ( 'the_content', $content );
	$content = str_replace ( ']]>', ']]&gt;', $content );
	return $content;
}

function parse_post_pagination($content, array &$paragraphsDecomposition, $allowedChars = 6000) {
	$page = isset ( $_GET ['pa'] ) ? intval ( $_GET ['pa'] ) : 1;
	//workaround
	$content = str_replace("<br />\n", '<br />', $content);
	$paragraphs = [ ];
	$doc = new DOMDocument ( '1.0', 'UTF-8' );
	@$doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
	$body = $doc->getElementsByTagName('body');

	if ($body->length === 1) {
		$bodyChilds = $body->item ( 0 )->childNodes;
		$t = 0;
		$index = 0;
		$paragraphCounter = 0;
		foreach ( $bodyChilds as $node ) {
			if ('#text' !== $node->nodeName || ! empty ( trim ( $node->nodeValue ) )) {
				$paragraph = $node->ownerDocument->saveHTML ( $node );
				$length = mb_strlen ( strip_tags ( $paragraph ) );
				$t += $length;
				// change index and lengthCounter unless first paragraph
				if ($t >= $allowedChars && $paragraphCounter > 0) {
					$t = 0;
					$index ++;
				}
				if (! isset ( $paragraphsDecomposition [$index] )) {
					$paragraphsDecomposition [$index] = [ ];
				}
				$paragraphsDecomposition [$index] [] = $paragraph;
				$paragraphCounter++;
			}
		}

		return array (
				$page,
				count ( $paragraphsDecomposition )
		);
	}

	return array (
			$page,
			$max
	);
}

function old_gallery_support($content) {
	$matches = array ();
	$matchesImages = array ();
	// TODO performance leak
	$result= $content;
	$replacement = [];
	if (preg_match_all( '/\+\+\+(.+)===/', $content, $matches ) > 0) {
		foreach ($matches[1] as $galleryContent) {
			if (preg_match_all ( '/wp-image-([0-9]+)/', $galleryContent, $matchesImages ) > 0) {
				$replacement[] = do_shortcode ( '[gallery ids="' . implode ( ',', $matchesImages[1] ) . '"]' );
			}
		}
		$result = str_replace($matches[0], $replacement, $content);
	}
	return $result;
}

// TODO migrate to custom plugin dependent on: Advanced Ads
$showedAds = array ();
function ads_filter($ordered_ad_ids, $type, $ads, $weights) {
	global $showedAds;
	return array_diff ( $ordered_ad_ids, $showedAds );
}
function ads_showed($adsArgs) {
	global $showedAds;
	$showedAds [] = $adsArgs ['id'];
	return $adsArgs;
}
function display_taxonomy_listing_callback($atts, $content, $tag) {
	// TODO: if not isset
	$taxonomy = $atts ['taxonomy'];
	$terms = get_terms ( $taxonomy, array (
			'orderby' => 'name'
	) );
	ob_start ();
	$lastChar = '';
	mb_internal_encoding ( "UTF-8" );
	$filter = isset ( $_GET ['filter'] ) ? $_GET ['filter'] : '';

	$sorted_terms = [];
    foreach ($terms as $term) {
        $first_char = strtoupper ( mb_substr ( $term->name, 0, 1 ) );
        $key = strtoupper ( mb_substr ( $term->name, 0, 2 ) ) == 'CH' ? 'CH' : $first_char;

        if ($filter) {
            if ($key == $filter) {
                $sorted_terms[$key][] = $term;
            }
        } else {
            $sorted_terms[$key][] = $term;
        }
	}


    $alphabet = ['A','B','C','Č','D','Ď','E','F','G','H','CH','I','J','K','L','M','N','Ň','O','P','Q','R','Ř','S','Š','T','Ť','U','Ú','V','W','X','Y','Z','Ž'];

    uksort($sorted_terms, function($key1, $key2) use ($alphabet) {
        return (array_search($key1, $alphabet) > array_search($key2, $alphabet));
    });

    echo "<ul class='taxonomy-register-listing'>";
	foreach ( $sorted_terms as $key => $terms ) { ?>
        <li class='taxonomy-register-group'>
            <span class='taxonomy-register-group-label'><?php echo $key; ?></span>
            <ul>
                <?php foreach ($terms as $term) {
                    $term_link = get_term_link ( $term );
                    ?>
                    <li class='taxonomy-register-item'><a href='<?php echo $term_link;?>'><?php echo $term->name;?></a></li>
                <?php } ?>
            </ul>
        </li>
        <?php
	}
	echo "</ul>";
	/*
	 * if (! empty ( $filter )) {
	 * $backUrl = dirname ( $_SERVER ['REQUEST_URI'] );
	 * echo "<br/><div><a class='btn-secondary' href='{$backUrl}'>zpět</a></div>";
	 * }
	 */
	$result = ob_get_contents ();
	ob_end_clean ();
	return $result;
}

function display_taxonomy_listing_callbackv2($atts, $content, $tag) {
	// TODO: if not isset
	$taxonomy = $atts ['taxonomy'];
	$terms = get_terms ( $taxonomy, array (
			'orderby' => 'ID',
            'order'         =>  'DESC'
            
	) );
    
	ob_start ();
	$lastChar = '';
	mb_internal_encoding ( "UTF-8" );
	$filter = isset ( $_GET ['filter'] ) ? $_GET ['filter'] : '';

    //print_r($terms);

	$sorted_terms = [];
    foreach ($terms as $term) {
        $first_char = strtoupper ( mb_substr ( $term->name, 0, 1 ) );
        $key = strtoupper ( mb_substr ( $term->name, 0, 2 ) ) == 'CH' ? 'CH' : $first_char;

        if ($filter) {
            if ($key == $filter) {
                $sorted_terms[$key][] = $term;
            }
        } else {
            $sorted_terms[$key][] = $term;
        }
	}
                                   
    $alphabet = ['A','B','C','Č','D','Ď','E','F','G','H','CH','I','J','K','L','M','N','Ň','O','P','Q','R','Ř','S','Š','T','Ť','U','Ú','V','W','X','Y','Z','Ž'];
    uksort($sorted_terms, function($key1, $key2) use ($alphabet) {
        return (array_search($key1, $alphabet) > array_search($key2, $alphabet));
    });

///vytáhnu podkategorie
$allterms = get_terms( array( 
'taxonomy' => 'serialy',
'numberposts'=>25  ) );

//print_r($allterms);

foreach ($allterms as $term) {
    $args = array(
        'post_type'      =>  'post',
        'post_status'    =>  'publish',
        'posts_per_page' =>  1,
	'orderby' => 'date',
    'order'   => 'DESC',
        'tax_query'      => array ( array (
            'taxonomy' => 'serialy',
	    'field'     => 'id',	    
            'terms'    => $term->term_id,
         ))
        
  );

//print_r($args);


	//vytáhnu příspěvky

      $video_query  = new WP_Query( $args );
      if ($video_query->have_posts()) {
//    print_r($term);
         echo ":::::::".	$term->name."<br>";

    $the_query = get_posts(array('taxonomy' => 'serialy','category'=>$term->slug,'numberposts'=>1,'orderby'=> 'date',
        'order'            => 'DESC',  ));


//echo "<pre>";

    	foreach ( $the_query as $qpost) { 
    print_r($qpost);



}

}



//      }
////break;
}
exit;

$the_query = get_posts(array('taxonomy' => 'serialy','numberposts'=>25 ));

$the_query =   new WP_Query($args);

	foreach ( $the_query as $qpost) { 
//print_r($qpost);        


$postID = $qpost->ID;
$format = get_post_format($postID );
?>

<article <?php post_class('box box-icon box--medium list' .$adClass); ?>>
	<div class="box">
		<div class="row">
			<div class="col-sm-4 col-md-3 col-lg-4">
				<div class="box-image">
				<?php

                	if (has_post_thumbnail ($qpost->ID)) {
						$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id ( $qpost->ID ), 'thumbnail' );
						$url = $thumb ['0'];

						
						echo 	'<img src="' . $url . '" alt="'. get_the_title($qpost->ID) .'">';
                        the_post_thumbnail('archive-thumb');
                        echo '</a>';


					}
					$category = get_the_category( $qpost->ID );//print_r($category );
                                        $categoryUrl = get_category_link ( $category [0] );

                                        // Exclude category label "Ptali jste se" and "Speciální stránka"
                                        $categoryExclude = $category[0]->category_parent == 8678;
                                        $categoryExcludeSpecial = $category[0]->term_id == 21372;

                                        if ( isset($category [1])) {
                                                $categoryExcludeUrl = get_category_link ( $category [1] );
                                        }

                                        // ToDo change to better solution. Change category name if parent category is "Ptali jste se"
                                        if ($categoryExclude || $categoryExcludeSpecial) {
                                                echo '<a href="' . $categoryExcludeUrl . '" class="label label--category">' . $category[1]->cat_name . '</a>';
                                        } else {
                                                echo '<a href="' . $categoryUrl . '" class="label label--category">' . $category[0]->cat_name . '</a>';
                                        } 
?>
				</div><!-- /.box-image -->
			</div>

			<div class="col-sm-8 col-md-9 col-lg-8">

				<div class="box-content">
					<?php
						if ( $format == 'video' ) {
							echo '<span class="label label--recomend">Videoreportáž</span>';
						} elseif ( $format == 'gallery' ) {
							echo '<span class="label label--recomend">Fotogalerie</span>';
						} elseif ( $format == 'aside' ) {
							echo '<span class="label label--recomend">Článek plus</span>';
						}
					 ?>
									<h2 class="box-content-title">
						<a href="<?php echo get_permalink($postID); ?>"><?php echo $qpost->post_title; ?></a>
					</h2>
			<?php echo $qpost->post_excerpt;?>
					
				</div><!-- /.box-content -->
			</div>
		</div><!-- /.row-->
	</div>
</article>
                    
                
                 
                              
                <?php } //}} ?>
            
        <?php
	
	
	/*
	 * if (! empty ( $filter )) {
	 * $backUrl = dirname ( $_SERVER ['REQUEST_URI'] );
	 * echo "<br/><div><a class='btn-secondary' href='{$backUrl}'>zpět</a></div>";
	 * }
	 */
	$result = ob_get_contents ();
	ob_end_clean ();
	return $result;
}




function display_rating_listing_callback($atts, $content, $tag) {
	$type = $atts ['type'];
	$archive = in_array ( 'archive', $atts );
	$postType = 'hodn-' . $type;
	$terms = get_terms ( "soubor", 'hide_empty=1&orderby=slug' );
	foreach ( $terms as $term ) {
		ob_start ();
		if ($term->description != $type) {
			// ignore unmatched rating types
			continue;
		}

		$args = array (
				'post_type' => $postType,
				'posts_per_page' => - 1,
				'taxonomy' => "soubor",
				'order' => "ASC",
				'post_status' => 'publish',
				'orderby' => "meta_value",
				'term' => $term->slug,
				'meta_key' => 'hodnoceni_titul'
		);
		if ($archive) {
			$args ['meta_query'] = array (
					'relation' => 'AND',
					array (
							'key' => 'hodnoceni_archiv',
							'value' => '1',
							'compare' => '='
					)
			);
		}
		$termPosts = get_posts ( $args );

		if ($archive && empty ( $termPosts )) {
			// ignore empty ratings
			continue;
		}

		$termUrl = get_term_link ( $term );
		echo "<h3><a href='{$termUrl}'>{$term->name}</a></h3>";
		echo "<ul class='rating-list'>";
		foreach ( $termPosts as $post ) {
			$premiere = get_post_meta ( $post->ID, 'hodnoceni_premiera', true );
			if (! empty ( $premiere )) {
				$premiere = "($premiere)";
			}

			$note = get_post_meta ( $post->ID, 'hodnoceni_poznamka', true );
			if (! empty ( $note )) {
				$note = "<div>($note)</div>";
			}

			$title = get_post_meta ( $post->ID, 'hodnoceni_titul', true );
			$author = get_post_meta ( $post->ID, 'hodnoceni_autor', true );
			echo "<li><strong>$title</strong> - $author $premiere";
			// render rating
			echo do_shortcode ( '[yasr_visitor_votes postid="' . $post->ID . '" size="small"]' );
			echo $note;

			// related posts
			$args = array (
					'orderby' => 'post_date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'meta_query' => array (
							array (
									'key' => 'hodnoceni_id',
									'value' => $post->ID,
									'compare' => 'LIKE'
							)
					)
			);
			$posts = get_posts ( $args );
			if (! empty ( $posts )) {
				// TODO localization support
				echo "<h5 class='related-posts-list-title'>Související články:</h5><ul class='related-posts-list'>";
				foreach ( $posts as $relatedPost ) {
					$url = get_permalink ( $relatedPost->ID );
					echo "<li><a href='{$url}'>{$relatedPost->post_title}</a></li>";
				}
				echo "</ul>";
			}
			echo "<br/></li>";
			// flush output buffer
			ob_end_flush ();
		}
		echo "</ul>";
	}
}
function display_taxonomy_filter($atts, $content, $tag) {
	// TODO validation of $atts
	extract ( $atts );
	$terms = get_terms ( $taxonomy, array (
			'orderby' => 'name'
	) );
	$alphabetMap = array ();
	$lastChar = '';
	mb_internal_encoding ( "UTF-8" );
    
	foreach ( $terms as $term ) {
		if (($temp = strtoupper ( mb_substr ( $term->name, 0, 1 ) )) !== $lastChar) {
			$lastChar = $temp;
			$alphabetMap [$lastChar] = 0;
		}


        if (($temp = strtoupper ( mb_substr ( $term->name, 0, 2 ) )) !== $lastChar && $temp == 'CH') {
            $lastChar = $temp;
            $alphabetMap [$lastChar] = 0;
        }

		$alphabetMap [$lastChar] ++;
	}


    $alphabet = [1,2,3,4,5,6,7,8,9,'A','Á','Â','B','C','Č','D','Ď','E','É','F','G','H','CH','I','J','K','L','Ł','M','N','Ň','O','Ö','P','Q','R','Ř','S','Š','Ś','T','Ť','U','Ú','ú','Ü','V','W','X','Y','Z','Ž','Ż'];

    uksort($alphabetMap, function($key1, $key2) use ($alphabet) {
        return (array_search($key1, $alphabet) > array_search($key2, $alphabet));
    });


    $baseUrl = get_permalink ();
	ob_start ();
	echo '<div class="alphabet-filter"><ul>';
	foreach ( $alphabetMap as $key => $value ) {
		$url = $baseUrl . '?filter=' . htmlentities ( $key );
		echo "<li><a href='{$url}'>{$key}</a></li>"; /* ({$value}) */
	}
	echo '</ul></div>';
	$result = ob_get_contents ();
	ob_end_clean ();
	return $result;
}
function category_permalink_filter($termlink, $term, $taxonomy) {
	$return = $termlink;
	if ($taxonomy === 'category') {
		$parts = explode ( '/', $termlink );
		// $categoryBase = get_option ( 'category_base' );
		// performance issue
		$categoryBase = 'archiv-clanku';
		$beforeLastItem = count ( $parts ) - 3;
		if ($parts [$beforeLastItem] !== $categoryBase) {
			unset ( $parts [$beforeLastItem] );
		}
		$return = implode ( '/', $parts );
	}

	return $return;
}
function get_image_url(&$content) {
	$matches = array ();
	preg_match ( '/<img .* src="([^"]+)".*/', $content, $matches );
	if (isset ( $matches [1] )) {
		return $matches [1];
	} else {
		return '';
	}
}


function uniqueSlugAllPostTypes($slug, $post_ID, $post_status, $post_type, $post_parent, $original_slug)
{
	global $wpdb;

	$check_sql = "SELECT post_name FROM $wpdb->posts WHERE post_name = %s AND ID != %d LIMIT 1";
	$post_name_check = $wpdb->get_var($wpdb->prepare($check_sql, $slug, $post_ID));
	if ($post_name_check) {
		$suffix = 2;
		do {
			$alt_post_name = _truncate_post_slug($slug, 200 - (strlen($suffix) + 1)) . "-$suffix";
			$post_name_check = $wpdb->get_var($wpdb->prepare($check_sql, $alt_post_name, $post_ID));
			$suffix++;
		} while ($post_name_check);
		$slug = $alt_post_name;
	}
	return $slug;
}

// Removed "Zaujalo nás" category from RSS
function myFilter($query) {
	if ($query->is_feed) {
		$query->set('cat','-28, -12689'); //Don't forget to change the category ID
	}
	return $query;
}
add_filter('pre_get_posts','myFilter');

add_shortcode ( 'display_taxonomy', 'display_taxonomy_listing_callback' );
add_shortcode ( 'display_taxonomyv2', 'display_taxonomy_listing_callbackv2' );
add_shortcode ( 'taxonomy_filter', 'display_taxonomy_filter' );
add_shortcode ( 'display_rating', 'display_rating_listing_callback' );

add_filter ( 'advanced-ads-group-output-ad-ids', 'ads_filter', 10, 4 );
add_filter ( 'advanced-ads-ad-select-args', 'ads_showed', 10, 1 );

add_filter ( 'posts_where', 'title_filter', 10, 2 );
add_filter ( 'the_content', 'old_gallery_support', 99 );
// add_filter ( 'term_link', 'category_permalink_filter', 10, 3 );
add_filter('wp_unique_post_slug', 'uniqueSlugAllPostTypes', 10, 6);


// Shortcodes
// At first add the button for custom formats to a menu bar of TinyMCE, in example line 2 with hook
add_filter( 'mce_buttons_2', 'fb_mce_editor_buttons' );

function fb_mce_editor_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

// Then enhance the drop down of this button. Aslo useful the enancement via additional value in the array, see the codex for this example.
add_filter( 'tiny_mce_before_init', 'fb_mce_before_init' );

function fb_mce_before_init( $settings ) {
	$style_formats = array(
		array(
			'title' => 'Upozornení',
			'block' => 'div',
			'classes' => 'alert alert-warning',
			'wrapper' => true
		),
		array(
			'title' => 'Chyba',
			'block' => 'div',
			'classes' => 'alert alert-danger',
			'wrapper' => true
		),
		array(
			'title' => 'Úspěch',
			'block' => 'div',
			'classes' => 'alert alert-success',
			'wrapper' => true
		),
		array(
			'title' => 'Informace',
			'block' => 'div',
			'classes' => 'alert alert-info',
			'wrapper' => true
		),
		array(
			'title' => 'Blok základní',
			'block' => 'div',
			'classes' => 'block block-default',
			'wrapper' => true
		),
		array(
			'title' => 'Blok upozornění',
			'block' => 'div',
			'classes' => 'block block-warning',
			'wrapper' => true
		)
		/*array(
			'title' => 'Red Uppercase Text',
			'inline' => 'span',
			'styles' => array(
				'color'         => 'red', // or hex value #ff0000
				'fontWeight'    => 'bold',
				'textTransform' => 'uppercase'
			)
		)*/
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;

}

// Add styles to login page
function my_login_stylesheet() {
	global $hash;

	wp_enqueue_style( 'login-styles',
		get_stylesheet_directory_uri() . '/build/css/wp-login.css',
		null,
		$hash
	);
}

add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

// Add styles to administration
function my_custom_fonts() {
	global $hash;

	wp_enqueue_style( 'wp-styles',
		get_stylesheet_directory_uri() . '/build/css/wp-admin.css',
		null,
		$hash
	);
}

function opArgVal($arr, $key, $default) {
	if(isset($arr[$key])) {
		return $arr[$key];
	} else {
		return $default;
	}
}

add_action('admin_head', 'my_custom_fonts');

// Exclude some categories from RSS feed
function exclude_category($query) {
	if ( $query->is_feed ) {
		$query->set('cat', '-10250, -8241, -16, -12689, -28');
	}
	
	return $query;
}

add_filter('pre_get_posts', 'exclude_category');

function disable_tag_feed () {
	if (strrpos($link, '/tags/') > 0)
		return;
		else
			return $link;
}
add_filter('category_feed_link', 'disable_tag_feed');

// Custom styles for the box "Týden s hudbou"
function custom_styles( $init_array ) {  
    $style_formats = array(  
        // These are the custom styles
        array(  
            'title' => 'Týden s hudbou',  
            'block' => 'div',  
            'classes' => 'box box-week',
            'wrapper' => true,
        ),  
    );
    
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    
    return $init_array;
}

// Custom styles for the box "Týden s hudbou"
add_filter( 'tiny_mce_before_init', 'custom_styles' );

// Limit heartbeet
add_action( 'init', 'stop_heartbeat', 1 );

add_filter( 'shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter', 10, 3 );

function custom_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
	$my_attr = 'post_id';

	if ( isset( $atts[$my_attr] ) ) {
		$out[$my_attr] = $atts[$my_attr];
	}

	return $out;
}


require "lib/wp-admin-extension.php";

/**
 * Remove menu pages for non-admin users
 */
add_action( 'admin_init', 'operaplus_remove_menu_pages' );
function operaplus_remove_menu_pages() {
    if (!current_user_can('administrator')) {
        remove_menu_page( 'index.php' );
        remove_menu_page( 'jetpack' );
    }
}

/**
 * Remove admin bar items for non admin users
 */
add_action('admin_bar_menu', 'operaplus_remove_toolbar_node', 999);
function operaplus_remove_toolbar_node($wp_admin_bar) {
    $wp_admin_bar->remove_node('wp-logo');
}

add_action( 'cmb2_admin_init', 'operaplus_metaboxes' );

/**
 * Define the metabox and field configurations.
 */
function operaplus_metaboxes() {

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => OPERAPLUS_PREFIX.'post_details',
        'title'         => __( 'Nastavení článku', 'cmb2' ),
        'object_types'  => array( 'post', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true
    ) );

    // Regular text field
    $cmb->add_field( array(
        'name'       => __( 'Necachovat', 'operaplus' ),
        'desc'       => __( 'Zašrtněte, pokud nechcete tuto stránku cachovat', 'operaplus' ),
        'id'         => OPERAPLUS_PREFIX . 'disable_cache',
        'type'       => 'checkbox'
    ) );


}


function wptuts_recentpost($atts, $content=null) {
	extract(shortcode_atts(
		array(
			'id' => 1
		), $atts )
	);
	
	$postID = get_post( $atts['id'] ); 
	$format = get_post_format($postID);
	$postTitle = $postID->post_title;
	
	$post_thumbnail_id = get_post_thumbnail_id( $postID );
	if ( ! $post_thumbnail_id ) {
		return false;
	}
	
	//$image .= wp_get_attachment_image_url( $post_thumbnail_id, 'medium' );
	
	$return = "<div class='box-related box box-icon box-icon_small format-" . get_post_format($postID) . "'><b>Přečtěte si také</b><span class='box-image'><a href='" . get_permalink($postID) . "' class='box-related-link'><img src=".wp_get_attachment_image_url( $post_thumbnail_id, 'thumbnail' )."></a></span><span class='related-content-inner'><a href='" . get_permalink($postID) . "' class='box-related-link'>" . $postID->post_title . "</a></span></div>";
	
	return $return;
	//return wp_get_attachment_image_url( $post_thumbnail_id, 'medium' );
}

add_shortcode('clanek', 'wptuts_recentpost');


/**
 * Fix categories not being indexed
 */
add_filter('wpseo_robots','operaplus_wpseo_robots');
function operaplus_wpseo_robots($robots) {
    if (is_category()) {
        $robots = 'index,follow';
    }
    return $robots;
}

function get_post_primary_category($post_id, $term='category', $return_all_categories=false){
    $return = array();

    if (class_exists('WPSEO_Primary_Term')){
        // Show Primary category by Yoast if it is enabled & set
        $wpseo_primary_term = new WPSEO_Primary_Term( $term, $post_id );
        $primary_term = get_term($wpseo_primary_term->get_primary_term());

        if (!is_wp_error($primary_term)){
            $return['primary_category'] = $primary_term;
        }
    }

    if (empty($return['primary_category']) || $return_all_categories){
        $categories_list = get_the_terms($post_id, $term);

        if (empty($return['primary_category']) && !empty($categories_list)){
            $return['primary_category'] = $categories_list[0];  //get the first category
        }
        if ($return_all_categories){
            $return['all_categories'] = array();

            if (!empty($categories_list)){
                foreach($categories_list as &$category){
                    $return['all_categories'][] = $category->term_id;
                }
            }
        }
    }

    return $return;
}


function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );	
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    
    // Remove from TinyMCE
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );


//Remove JQuery migrate
function remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        
        if ($script->deps) { // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, array(
                'jquery-migrate'
            ));
        }
    }
}

add_action('wp_default_scripts', 'remove_jquery_migrate');

add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );