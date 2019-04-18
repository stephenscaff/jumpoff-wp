<?php

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Jumpoff term
 * Returns a single term via provided tax.
 *
 * @return obj(name, slug, url)
 */
function jumpoff_term($taxonomy, $post_id = '') {


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
 *
 *  @see
 *  @return (string) $single_cat;
 */
function jumpoff_cat($type){

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
function jumpoff_get_cat_slug($cat_id) {
	$cat_id = (int) $cat_id;
	$category = get_category($cat_id);

  if (!$category) return;

	return $category->slug;
}

/**
 *  Get Category/term Archive Link
 *  @param    $term
 *  @param    string  $rep Ellipser
 *
 */
function jumpoff_get_cat_link($term_field = '') {
  global $post;
  $post_type = get_post_type_object(get_post_type());
  $post_type_name = $post_type->name;

  if ($term_field) {
    $archive_link = get_term_link($term_field->slug, 'category');
  }

  else {
    $archive_link = jumpoff_get_page_url('news');
  }

  return $archive_link;
}


/**
  *  jumpoff_term_link()
  *  Gets the term archive link, used with View All links
  *
  *  @see    index.php
  *  @param  $term (string)
  *  @param  $tax (string)
  *  @return $term_link (string) the term archive link
  */
function jumpoff_term_link($term, $tax){

 // @see https://developer.wordpress.org/reference/functions/get_term_link/
 $term_link = get_term_link( $term, $tax );

 return $term_link;
}


 /**
  * Jumpoff tax filters
  */
function jumpoff_tax_filters($tax, $class) {
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
