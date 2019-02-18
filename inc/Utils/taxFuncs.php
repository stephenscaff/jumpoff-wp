<?php

namespace jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;



/**
 * Jumpoff term
 * Returns a single term via provided tax.
 *
 * @return obj(name, slug, url)
 */
function get_term($taxonomy, $post_id = '') {

  global $post;

  if ($post_id) {
    $post = get_post($post_id);
  }

  $terms = wp_get_post_terms($post->ID, $taxonomy);
  $term = '';
  $term_obj = '';

  foreach ( $terms as $term ) {

    if (is_wp_error( $terms )) return;

    $queried_object = get_queried_object();

    if ( is_tax() ) {

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
 * Terms
 * Retrives the terms applied to the current post
 */
function get_terms($taxonomy, $type) {
  $terms = get_the_terms($post->ID, $taxonomy);
  $output = '';

  if (!$terms) return;

  foreach ( $terms as $term ) {

    if ($type === 'comma'){
      $output .= $term->name . ', ';
    }
    elseif ( $type === 'list' ){
      $output .= '<li>' . $term->slug . '</li>';
    }
    else {
      $output .= $term->name;
    }
  }

  return rtrim($output, ', ');
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
function get_term_link($term, $tax){
  $term_link = get_term_link( $term, $tax );

  return $term_link;
}


/**
 *  Single Post Categorey
 *  Returns a post's cat (first in cat array)
 *
 *  @see
 *  @return (string) $single_cat;
 */
function get_cat($type){

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
  *  Categories List
  *  Returns cats wtih content to output as list
  *
  *  @return string $category_item
  */
function get_cats($type) {
 $categories = get_categories();
 $category_item = '';

 if ( $categories ) {
   foreach ( $categories as $category ) {

     if ( is_wp_error( $categories ) ) continue;

      $category_link = get_category_link( $category->term_id );

     if ($type === 'link'){
       $category_item .= '<a href="' . $category_link . '">' . $category->name . '</a>, ';
     } else {
       $category_item .= '<li><a href="' . $category_link . '">' . $category->name . '</a></li>';
     }
   }

   return rtrim($category_item, ', ');
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
  * Jumpoff Query Filters
  * Builds out term links using query var
  */
function get_query_filters($tax, $type, $class) {

  $output = "";

  $args = array(
    'taxonomy'   => $tax,
    'hide_empty' => 0,
  );

  $link = get_post_type_archive_link($type);

  $terms = get_terms( $args);

  # wp_error object check
  if (is_wp_error( $terms )) return;

  if (!$terms) return;

  foreach ($terms as $term)  {
    $url = $link .'?'.$tax . '=' . $term->slug;
    $title = $term->name;
    $output .= '<a class="' . $class . '" href="' . $url . '">' . $title . '</a>';
  }

  return $output;
}
