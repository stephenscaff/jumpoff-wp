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
    $all_custom_post_types = get_post_types( array ( '_builtin' => FALSE ) );

    // there are no custom post types
    if ( empty ( $all_custom_post_types ) )
        return FALSE;

    $custom_types      = array_keys( $all_custom_post_types );
    $current_post_type = get_post_type( $post );

    // could not detect current type
    if ( ! $current_post_type )
        return FALSE;

    return in_array( $current_post_type, $custom_types );
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

  $id='';

  if( !is_object( $post ) )
     return;

  if (is_post_type_archive()){
    $post_type = get_queried_object();
    //$post_type = get_post_type( $post->ID );
    $cpt = $post_type->name;
    $id = $cpt . '-index';
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
*  jumpoff_mod_class
*  For creating BEM style modifiers
*  @return: $class (string)
*/
function jumpoff_mod_class() {
  $page_for_posts = get_option( 'page_for_posts' );
  $class='';

  if (is_home()){
    $class ='news';
  }
  elseif (is_front_page()) {
    $class ='home';
  }
  elseif (is_post_type('name')){
    $class = 'name';
  }
  elseif (is_archive()){
    $class = 'archive';
  }
  else {
    $class = basename(get_permalink());
  }
  return $class;
}

/**
 *  Jumpoff Styler
 *  A helper for conditional checking custom fields (mostly using ACF).
 *
 *  @param: $spacer (string) - the custom field, only for strings
 *  @param: $spacer (boolean) - adds space to right of string out
 *  @return: (string) The field if it passes our check
 */
function jumpoff_styler($field, $spacer = false){

  $field_output = '';

  if ($field) {
    if ($spacer === true) {
      $field_output = ' ' . $field;
    } else {
      $field_output = $field;
    }
  }
  return $field_output;
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

  $output = '';

  if ($field) {
    $output = $field;
  } else {
    $output = $fallback;
  }
  return $output;
}
