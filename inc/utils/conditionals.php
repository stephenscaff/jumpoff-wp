<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 *  is_post_type()
 *  Adds is_post_type conditional.
 *  @param: $type (string)
 *  @return: boolean (ture if is specified post_type)
 */
function is_post_type( $type ){
  global $wp_query;

  // Test if object to avoid error
  // if( !is_object($type) ) {
  //   return;
  // }
  if($type == get_post_type($wp_query->post->ID)){
    return true;
  }
  return false;
}

/**
 *  jumpoff_field
 *  A helper for conditional checking custom fields (mostly using ACF).
 *
 *  @param boolean add a space after class name
 *  @param string  $spacer (boolean) - adds space to right of string out
 *  @return string The field if it passes our check
 */
function jumpoff_field_styler($field, $spacer = false){
  $output;
  if ($field) {
    if ($spacer === true) {
      $output = '  ' . $field;
    } else {
      $output = $field;
    }
  }
  return $output;
}

/**
 * use Custom Field or Fallback
 * @return string $output
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
