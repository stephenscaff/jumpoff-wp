<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *   Fetch More Posts
 *   A simple load more / pagination replacement using Fetch API
 *
 *   @see fetch-more-posts/fetch-more.js
 *   @see scss/components/_fetch-more.scss
 */
add_action('template_redirect', 'wp_fetch_more');

function wp_fetch_more() {
  global $wp_query;

  // If on posts pages
  if( is_home() || is_archive() || is_tax() ) {

    /**
     * Load JS and Set our wpFetchMore variable
     */
    wp_enqueue_script('wp_fetch_more_js',
    get_template_directory_uri() . '/inc/fetch-more/fetch-more.js', '', false, true );

    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
    $max_pages = $wp_query->max_num_pages;
    
    // Set wpFetchMore var
    wp_localize_script(
      'wp_fetch_more_js',
      'wpFetchMore',
      array(
        'startPage' => $paged,
        'maxPages'  => $max_pages,
        'nextLink'  => next_posts($max_pages, false),
      )
    );
  }
}
