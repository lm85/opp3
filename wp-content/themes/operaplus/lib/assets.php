<?php

namespace Roots\Sage\Assets;

/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/dist/styles/main.css
 *
 * Enqueue scripts in the following order:
 * 1. /theme/dist/scripts/modernizr.js
 * 2. /theme/dist/scripts/main.js
 */

class JsonManifest {
  private $manifest;

  public function __construct($manifest_path) {
	if (file_exists($manifest_path)) {
	  $this->manifest = json_decode(file_get_contents($manifest_path), true);
	} else {
	  $this->manifest = [];
	}
  }

  public function get() {
	return $this->manifest;
  }

  public function getPath($key = '', $default = null) {
	$collection = $this->manifest;
	if (is_null($key)) {
	  return $collection;
	}
	if (isset($collection[$key])) {
	  return $collection[$key];
	}
	foreach (explode('.', $key) as $segment) {
	  if (!isset($collection[$segment])) {
		return $default;
	  } else {
		$collection = $collection[$segment];
	  }
	}
	return $collection;
  }
}

function asset_path($filename) {
	$dist_path = get_template_directory_uri() . DIST_DIR;
	$directory = dirname($filename) . '/';
	$file = basename($filename);
	static $manifest;

	if (empty($manifest)) {
		$manifest_path = get_template_directory() . DIST_DIR . 'assets.json';
		$manifest = new JsonManifest($manifest_path);
	}

	if (array_key_exists($file, $manifest->get())) {
		return $dist_path . $directory . $manifest->get()[$file];
	} else {
		return $dist_path . $directory . $file;
	}
}

$hash = date('YY-mm-dd'). 'h#v35';

function assets() {
	global $hash;

	wp_enqueue_style( 'opera-styles',
		asset_path('css/styles.css'),
		null,
		$hash
	);

	wp_dequeue_style('wordpress-popular-posts');
	wp_dequeue_style('cookie-bar-css');
	wp_dequeue_script('cookie-bar-js');

	if (is_single() && comments_open() && get_option('thread_comments')) {
		//wp_enqueue_script('comment-reply');
	}
/*
	wp_enqueue_script( 'modernizr',
		asset_path('js/modernizr.js'),
		null,
		$hash,
		true
	);
*/
	wp_enqueue_script( 'sage-js',
		asset_path('js/main.js'),
		null,
		$hash,
		true
	);

	wp_enqueue_script( 'bootstrap-tether-js',
		asset_path('js/tether-min.js'),
		null,
		$hash,
		true
	);

	wp_enqueue_script( 'bootstrap-js',
		asset_path('js/bootstrap-min.js'),
		null,
		$hash,
		true
	);

	wp_enqueue_script( 'cookie-bar-js',
		plugins_url('js/cookie-bar.js'),
		null,
		$hash,
		true
	);
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
