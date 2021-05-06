<?php
/**
 * Created by IntelliJ IDEA.
 * User: jorat1
 * Date: 6/15/2015
 * Time: 21:28
 */
function filter_function_name($guid) {
	return str_replace ( 'http://operatest.eu', WP_DEV_URL, $guid );
}
function rewrite_url($url) {
	return str_replace ( 'http://operatest.eu', WP_DEV_URL, $url );
}

add_filter ( 'site_url', 'rewrite_url' );
add_filter ( 'home_url', 'rewrite_url' );
add_filter ( 'content_url', 'rewrite_url' );
add_filter ( 'post_link', 'rewrite_url' );
add_filter ( 'get_the_guid', 'filter_function_name' );

//commented out because we want pictures from TEST server
//add_filter('the_content', 'rewrite_url');