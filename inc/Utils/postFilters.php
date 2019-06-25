<?php


if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Limit Posts
 * Creates a filter for offsetting posts and ajaxed pagination.
 */
function limit_posts_filter($limit) {

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
