<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Is page template
 *
 * @param $template - page template to check against
 * @return boolean
 */
function is_template( $template ) {
   global $post;
   if ( ! $post ) return false;
   return $template === get_post_meta( $post->ID, '_wp_page_template', true );
}


/**
 *  is_post_type()
 *  Adds is_post_type conditional.
 *  @param: $type (string)
 *  @return: boolean (ture if is specified post_type)
 */
function is_post_type( $type ){
  global $wp_query, $post;

  if( !is_object($post) ) return;

  if (is_404()) return;

  if ($type == get_post_type($wp_query->post->ID) ){
    return true;
  }
  return false;
}


/**
 * Check if a post is a custom post type.
 * @param  mixed $post Post object or ID
 * @return boolean
 */
function is_any_post_type( $post = NULL ) {
  $all_custom_post_types = get_post_types( array ( '_builtin' => false ) );

  // there are no custom post types
  if ( empty ( $all_custom_post_types ) ) return false;

  $custom_types      = array_keys( $all_custom_post_types );
  $current_post_type = get_post_type( $post );

  // could not detect current type
  if ( ! $current_post_type ) return false;

  return in_array( $current_post_type, $custom_types );
}


/**
 * Has More Posts
 * Checks if current query has pagination
 * pages so we can print our fetch-more-posts
 *
 * @return boolean
 */
function has_more_posts() {
  global $wp_query;

  if ($wp_query->max_num_pages > 1) {
    return true;
  }
  return false;
}


/**
 * Has Featured Image
 */
function has_ft_img($id) {
  $ft_img = jumpoff_ft_img('full', $id);

  if ($ft_img->url) {
    return true;
  }
  return false;
}



/**
 * Is Extended CLass
 * Counts a fields characaters and adds an
 * 'is-extended' class.
 * @return string
 */
function is_extended_class($str, $chars = '200') {
  $class = '';
  if (strlen($str) > $chars) {
    $class = 'is-extended';
  }

  return $class;
}

/**
 * Has Get
 *
 * Check if a $_Get filter is in play
 *
 * @param string $key - $_GET key value.
 * @return boolean;
 */
function has_get($key) {
  if (isset($_GET[$key])) {
    return true;
  }

  return false;
}


/**
 * Is Page Check
 * Helper to check a page template
 * @param string File Name (sans file type)
 * @return boolean
 */
function is_page_check($page_name){
  if (is_page_template("templates/${page_name}.php")) {
    return true;
  }
  return false;
}


/**
 * Is Type Check
 * Helper to check post type
 * @param string Post Type Name
 * @return boolean
 */
function is_post_type_check($type) {
  global $post;
  $post_type = get_query_var('post_type');
  if ($post_type == $type) {
    return true;
  }
  return false;
}

/**
 * Is Team Page
 */
function is_team() {
  return is_post_type_check('team');
}
