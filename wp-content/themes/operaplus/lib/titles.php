<?php

namespace Roots\Sage\Titles;

/**
 * Page titles
 */
function title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      //return __('Latest Posts', 'sage');
    }
  } elseif (is_archive()) {
    return single_term_title();
  } elseif (is_search()) {
    return sprintf(__('Výsledky hledání pro: %s', 'sage'), get_search_query());
  } elseif (is_404()) {
    return __('Stránka nenalezena', 'sage');
  } else {
    return get_the_title();
  }
}
