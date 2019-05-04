<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get a Term
 * Returns a single term via provided tax.
 * @param string $taxonomy - tax name
 * @param number $post_id - id of post (optional)
 * @return obj(name, slug, url)
 */
function get_a_term($taxonomy, $post_id = '') {


  if ($post_id) {
    $post = get_post($post_id);
  }


  $terms = wp_get_post_terms(get_the_ID(), $taxonomy);
  $term = '';
  $term_obj = '';

  if (is_wp_error( $terms )) return;

  if (!$terms) return;

  foreach ( $terms as $term ) {

    if (is_wp_error( $terms )) return;

    $queried_object = get_queried_object();

    if ( is_tax() && !(isset($_GET))){
    $term_obj = array(
  		'name' => (string)$queried_object->name,
  		'slug' => (string)$queried_object->slug,
      'url' => (string)get_term_link($term),
		);

  } else {

    $term_obj = array(
  		'name' => (string)$term->name,
  		'slug' => (string)$term->slug,
      'url' => (string)get_term_link($term),
		);
  }
}
  return (object)$term_obj;
}


/**
 *  Single Post Categorey
 *  Returns a post's cat (first in cat array)
 *  @param string $type - cat name
 *  @return (string) $single_cat;
 */
function get_a_cat($type){

  global $post;

  // Get cats from post id
  $categories = get_the_category($post->ID);

  if ($categories){

    $single_cat = '';

    if ($type === 'name'){
      //return $categories[0]->cat_name;
      $single_cat = $categories[0]->cat_name;
    }

    if ($type === 'url'){
      //return esc_url( get_category_link( $categories[0]->term_id ) ) ;
      $single_cat = esc_url( get_category_link( $categories[0]->term_id ) );
    }

    return $single_cat;
  }
}

/**
 * Get Single Cat from slug
 * @return $categories (post_name);
 */
function get_cat_slug($cat_id) {
	$cat_id = (int) $cat_id;
	$category = get_category($cat_id);

  if (!$category) return;

	return $category->slug;
}

/**
 * Get Tax Filters
 * @return html - taxonomy link
 */
function get_tax_filters($tax, $class) {
  $args = array(
    'taxonomy'   => $tax,
    'hide_empty' => 0,
  );
  $output = '';

  $terms = get_terms( $args);

  # wp_error object check
  if (is_wp_error( $terms )) return;

  foreach ($terms as $term)  {
    $url = get_term_link($term);
    $title = $term->name;
    $output .= '<a class="' . $class . '" href="' . $url . '">' . $title . '</a>';
  }
  return $output;
}
