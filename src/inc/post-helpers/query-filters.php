<?php
/**
 * Limit Posts
 * Creates a filter for offsetting posts and ajaxed pagination. 
 */
function jumpoff_limit_posts($limit) {
  // globals
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
 * Work Query
 * Modify Work query's ppp, before query is run
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 *
 */
add_action( 'pre_get_posts', 'jumpoff_case_study_query' );

function jumpoff_case_study_query( $query ){
  if( ! is_admin()
    && $query->is_post_type_archive( 'work' )
    && $query->is_main_query() ){
        $query->set( 'posts_per_page', -1 );
  }
}
