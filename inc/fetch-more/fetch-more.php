<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *   Fetch More Posts
 *   A simple load more / pagination replacement using Fetch API
 *
 *   @see fetch-more-posts/fetch-more.js
 *   @see scss/components/_fetch-more.scss
 */
add_action('template_redirect', 'fm_js');

function fm_js() {
  global $wp_query;

  if( is_home() || is_archive() || is_tax() ) {

    /**
     * Load script.
     */
    wp_enqueue_script('fetchmore_js',
    get_template_directory_uri() . '/inc/fetch-more/fetch-more.js', '', false, true );

    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
    $max_pages = $wp_query->max_num_pages;

    wp_localize_script(
      'fetchmore_js',
      'fetchMore',
      array(
        'startPage' => $paged,
        'maxPages'  => $max_pages,
        'nextLink'  => next_posts($max_pages, false),
      )
    );
  }
}


/**
 * Limit Posts
 * Filter to creating required ppp offsets
 * for our fetch more functionality.
 */
function fm_limit_posts($limit) {

  global $paged, $postOffset;

  if (empty($paged)) {
    $paged = 1;
  }

  // Posts Per Page
  $ppp = intval( get_option('posts_per_page') );

  // Create offset
  $pagedStart = ((intval($paged) -1) * $ppp) + $postOffset . ', ';

  // Limit Posts
  $limit = 'LIMIT '.$pagedStart.$ppp;

  return $limit;
}
