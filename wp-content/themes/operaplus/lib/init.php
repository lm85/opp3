<?php

namespace Roots\Sage\Init;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
	// Make theme available for translation
	// Community translations can be found at https://github.com/roots/sage-translations
	load_theme_textdomain('sage', get_template_directory() . '/lang');

	// Enable plugins to manage the document title
	// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
	add_theme_support('title-tag');

	// Register wp_nav_menu() menus
	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus([
		'primary_navigation' => __('Primary Navigation', 'sage')
	]);

	// Add post thumbnails
	// http://codex.wordpress.org/Post_Thumbnails
	// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
	// http://codex.wordpress.org/Function_Reference/add_image_size
	add_theme_support('post-thumbnails');
	add_image_size('post-list', 235, 160, true );
	add_image_size('post-sticky', 375, 280, true );
	add_image_size('actual-post-thumbnails', 425, 9999, false );
	add_image_size('special-thumbnail', 1100, 600, true );
	add_image_size('special-thumbnail-hp', 800, 450, true );
	add_image_size('archive-thumb', 490, 320, true );

	// Add post formats
	// http://codex.wordpress.org/Post_Formats
	add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio','clanekplus']);

	// Add HTML5 markup for captions
	// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
	add_theme_support('html5', ['caption', 'comment-form', 'comment-list']);

	// Tell the TinyMCE editor to use a custom stylesheet
	//add_editor_style(Assets\asset_path('styles/editor-style.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
	register_sidebar([
		'name'          => __('Primary', 'sage'),
		'id'            => 'sidebar-primary',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	]);

	register_sidebar([
		'name'          => __('Sidebar Secondary', 'sage'),
		'id'            => 'sidebar-secondary',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	]);

	register_sidebar([
		'name'          => __('Sidebar Third', 'sage'),
		'id'            => 'sidebar-third',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	]);

	register_sidebar([
		'name'          => __('Sidebar Newsletter', 'sage'),
		'id'            => 'sidebar-newsletter',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	]);

	register_sidebar([
		'name'          => __('Sidebar Eshop', 'sage'),
		'id'            => 'sidebar-eshop',
		'before_widget' => '<div class="wideget %1$s %2$s">',
		'after_widget'  => '</div>',
	]);

	register_sidebar([
		'name'          => __('Footer', 'sage'),
		'id'            => 'sidebar-footer',
		'before_widget' => '<div class="%1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	]);

	register_sidebar([
		'name'          => __('Promo widget', 'sage'),
		'id'            => 'widget-promo',
		'before_widget' => '<div class="widget promo %1$s %2$s">',
		'after_widget'  => '</div>',
	]);

	register_sidebar([
		'name'          => __('Promo widget 2', 'sage'),
		'id'            => 'widget-promo-2',
		'before_widget' => '<div class="widget promo promo-2 %1$s %2$s">',
		'after_widget'  => '</div>',
	]);


}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');
