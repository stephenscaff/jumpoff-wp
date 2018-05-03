<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 * Get id by page name
 * @return integar Page id.
 */
function get_id_by_name($page) {
  $slug = get_page_by_path($page);
  $id = $slug->ID;

  return $id;
}


/**
 *  is_post_type()
 *  Adds is_post_type conditional.
 *  @param: $type (string)
 *  @return: boolean (ture if is specified post_type)
 */
function is_post_type( $type ){
  global $wp_query;

  if($type == get_post_type($wp_query->post->ID)){
    return true;
  }
  return false;
}


/**
 *  jumpoff_ids()
 *  Retrieves IDs to use in calling fields.
 *  @return: $id (the id of the post)
 *  @example: $postidd = jumpoff_ids();
 */
function jumpoff_ids() {
  global $post;

  $page_for_posts = get_option( 'page_for_posts' );
  $id="";

  if( !is_object( $post ) )
     return;

  if (is_post_type_archive()){
    //$post_type = get_queried_object();
    $post_type = get_post_type( $post->ID );
    $cpt = $post_type;
    $id = "cpt_$cpt";
  }

  elseif (is_home()){
    $id = 'options';
  }

  elseif (is_front_page()) {
    $id = get_option('page_on_front');
  }

  else{
    $id = $post->ID;
  }
  return $id;
}


/**
 * Custom Field Fallback
 * Defines a string fallback for custom fields.
 *
 * @param mixed $field Custom Field
 * @param mixed fallback, probably a string
 * @return mixed Custom field or fallback
 */
function jumpoff_field_fallback ($field, $fallback) {
  $output;

  if ($field) {
    $output = $field;
  } else {
    $output = $fallback;
  }
  return $output;
}
