<?php

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

function jumpoff_text_limit($string, $length, $replacer) {
  if(strlen($string) > $length)
  return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
  return $string;
}

/**
 *  jumpoff_excerpt
 *
 *  Outputs a shortened get_the_excerpt via length arg (by char)
 *
 *  @todo     change this to a return
 *  @param    int  $characters Number of chars to outputv
 *  @param    string  $rep Ellipser
 *  @example  jumpoff_excerpt(100);
 *
 */

function jumpoff_excerpt($characters, $rep='...') {
  $excerpt = get_the_excerpt('', '', false);
  $shortened_excerpt = jumpoff_text_limit($excerpt, $characters, $rep);
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
function get_module_field_excerpt($module_name, $module_field, $characters, $rep='...') {
  $field = "";
  $excerpt = "";
  $modules = get_field("modules");

  if ($modules[0]["acf_fc_layout"] == $module_name) {
    $field = $modules[0][$module_field];
    $excerpt = jumpoff_text_limit($field, $characters, $rep);
    $excerpt = strip_tags(html_entity_decode($excerpt));
  }

  return  $excerpt;
}


/**
 *  jumpoff_source_tag
 *
 *  A grouping of options for outputing pretitles containing the
 *  post type name, archive link, or a sim-link for blocklevel links
 *
 * @param string  $format Desired format
 * @param string  $class Adds a specified class name to the output
 * @return $output
 */

function jumpoff_source_tag($format, $class){
  $post_type = get_post_type_object(get_post_type());
  $post_type_name = $post_type->labels->name;
  $post_type_slug = $post_type->rewrite['slug'];
  $post_type_link = get_post_type_archive_link( $post_type_slug );

  $output='';

  switch($format){
    case 'name';
      $output = '<span class="' . $class . '">' . $post_type->labels->name . '</span>';
      break;
    case 'url':
      $output = '<a class="' . $class . '" href="' . esc_url($post_type_link ). '">' . $post_type->labels->name . '</a>';
      break;
    case'sim-link':
      $output  = '<span class="' . $class . '" data-sim-link="' . esc_url($post_type_link) . '">' . $post_type->labels->name . '</span>';
      break;
  }

  return $output;
}
