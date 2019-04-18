<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  jumpoff_text_limit
 *
 *  Function to limit text length outputs. Used in functions below
 *
 *  @param int  $string Number of chars to output
 *  @param int  $length Desired char length
 *  @param string  $replacer
 *  @return $string
 */

function text_limit($string, $length, $replacer) {
  if(strlen($string) > $length)
  return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
  return $string;
}

/**
 *  get_excerpt
 *
 *  Outputs a shortened get_the_excerpt via length arg (by char)
 *
 *  @todo     change this to a return
 *  @param    int  $characters Number of chars to outputv
 *  @param    string  $rep Ellipser
 *  @example  jumpoff_excerpt(100);
 *
 */

function get_excerpt($characters, $rep='...') {
  $excerpt = get_the_excerpt('', '', false);
  $shortened_excerpt = text_limit($excerpt, $characters, $rep);
  return $shortened_excerpt;
}




/**
 * Get Module Field
 * Returns the value of a specific module field from within a loop.

 * @var $module_name string Name of the module
 * @var $module_field string Name of the module's field
 * @return string Field value
 */
function get_module_field($module_name, $module_field) {
  $field = "";
  $modules = get_field("modules");

  if ($modules[0]["acf_fc_layout"] == $module_name) {
    $field = $modules[0][$module_field];
  }

  return $field;
}

/**
 * Get Module Field
 * Returns the value of a specific module field from within a loop.

 * @var $module_name string Name of the module
 * @var $module_field string Name of the module's field
 * @return string Field value
 */
function get_module_field_excerpt(
  $module_name,
  $module_field,
  $characters,
  $rep='...'
) {
  $field = "";
  $excerpt = "";
  $modules = get_field("modules");

  if ($modules[0]["acf_fc_layout"] == $module_name) {
    $field = $modules[0][$module_field];
    $excerpt = text_limit($field, $characters, $rep);
    $excerpt = strip_tags(html_entity_decode($excerpt));
  }

  return  $excerpt;
}
