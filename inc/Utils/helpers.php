<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get id by page name
 * @return int $id - id of the returned page
 */
function get_id_by_name($page) {
  $slug = get_page_by_path($page);
  $id = $slug->ID;

  return $id;
}


/**
 *  jumpoff_get_id()
 *  Retrieves IDs to use in calling fields.
 *  @return integar $id - the id of the post
 *  @example $id = jumpoff_get_id();
 */
function get_id() {
  global $post;
  $term_obj = get_queried_object();
  $page_for_posts = get_option( 'page_for_posts' );

  $id='';

  if (is_search() && is_post_type_archive('post')) {
    $id = 'news-index';
  }
  elseif (is_post_type_archive()){
    $post_type = get_queried_object();
    //$post_type = get_post_type( $post->ID );
    $cpt = $post_type->name;
    $id = $cpt . '-index';
  }
  elseif (is_home() OR is_search()){
    $id = 'news-index';
  }
  elseif (is_front_page()) {
    $id = get_option('page_on_front');
  }
  elseif (is_tax('activity_type') OR is_tax('activity_location')) {
    $id = $term_obj->taxonomy . '_' . $term_obj->term_id;
  }
  else{
    $id = get_the_ID();
  }
  return $id;
}


/**
 * Custom Field Fallback
 * Defines a string fallback for custom fields.
 *
 * @param mixed $field - Custom Field
 * @param mixed fallback - probably a string
 * @return mixed Custom field or fallback
 */
function get_field_fallback ($field, $fallback) {

  $output = '';

  if ($field) {
    $output = $field;
  } else {
    $output = $fallback;
  }
  return $output;
}


/**
 * Join Fields
 * Coverts an array of style (class name) Fields
 * to a space seperated grouping.
 *
 * @example jumpoff_add_class($class, 'module')
 * @return string $group - space seperated sting of class names
 */
function chain_classes($fields){
  $group = join(' ', $fields);

  return $group;
}


/**
 * Add Character Count Class
 * outputs a css class if character count exceeds f
 * defined amount.
 * @param string $str - string to count chars
 * @param number $num - Character count
 * @return string $klass - css output class
 */
function add_char_class($str, $num, $klass) {
  if ( strlen($str) > $num ) {
    return $klass;
  }
}
