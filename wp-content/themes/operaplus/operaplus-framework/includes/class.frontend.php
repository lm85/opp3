<?php
namespace OperaPlus;

class Frontend {
    function initialize() {
        add_filter('pre_get_posts',array($this,'merge_categories'));
        add_action('template_redirect',array($this,'maybe_generate_pdf'));
    }

    /**
     * Merge specific categories archives
     * Allows displaying two categories on single category archive page
     */
    function merge_categories($query) {
        if (is_front_page() || is_home())
            return $query;

        if (is_archive() && is_category()) {
            $categories = [
                'hudba' => 'hudba,hudba-z-kuloaru',
                'opera' => 'opera,opera-z-kuloaru',
                'balet' => 'balet,balet-z-kuloaru',
                'ruzne' => 'ruzne,ruzne-z-kuloaru'
            ];

            foreach ($categories as $key => $category) {
                if(isset($query->query_vars['category_name']) && $query->query_vars['category_name'] == $key) {
                    $query->set( 'category_name', $category);
                }
            }
        }
        return $query;
    }

    function maybe_generate_pdf() {
    	if (!isset($_GET['pdf']))
    		return;

    	global $post;

    	$args = [
    		'p' => $post->ID
	    ];

    	$the_query = new \WP_Query( $args );

    	// The Loop
    	while ( $the_query->have_posts() ) {
    		$the_query->the_post();
		    $mpdf = new \Mpdf\Mpdf();

		    $mpdf->WriteHTML('<h1>'.get_the_title().'</h1>'.apply_filters('the_content',get_the_content()));
		    $mpdf->Output();
    		the_content();
    	}
    	wp_reset_postdata();
	    exit();


    }


}

$frontend = new Frontend();
$frontend->initialize();

