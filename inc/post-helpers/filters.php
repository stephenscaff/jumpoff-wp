<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Limit Posts
 * Creates a filter for offsetting posts and ajaxed pagination.
 */
function jumpoff_limit_posts($limit) {

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



/**
 * Video Embed
 * Use wp's  oembed filter to wrap video with a rwd class.
 */
add_filter('embed_oembed_html', 'jumpoff_vid_embed', 99, 4);

function jumpoff_vid_embed($html, $url, $attr, $post_id) {
  return '<div class="flex-vid">' . $html . '</div>';
}
