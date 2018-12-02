<?php

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Jumpoff term
 * Returns a single term via provided tax.
 *
 * @return obj(name, slug, url)
 */
function jumpoff_term($taxonomy, $post_id = '') {

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

    if ( is_tax() ){
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
function jumpoff_terms($taxonomy, $type) {
  $terms = get_the_terms($post->ID, $taxonomy);
  $output = '';
  if ($terms) {
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
}


/**
 * Terms
 * Retrives the terms applied to the current post
 */
function jumpoff_related_terms($taxonomy) {
  $terms = get_the_terms($post->ID, $taxonomy);
  $output = '';
  if ($terms) {
    foreach ( $terms as $term ) {

      if ($type === 'comma'){
        $output .= $term->name . ', ';
      }
      elseif ( $type === 'list' ){
        $output .= '<li>' . $term->slug . '</li>';
      }
      elseif ( $type === 'array' ){
        $output .= '<li>' . $term->slug . '</li>';
      }
      else {
        $output .= $term->name;
      }
    }
    return rtrim($output, ', ');
  }
}



/**
 * jumpoff_filter_items
 * Gets all available terms for CPT filtering, via mixitup.js, or building term archive links.
 *
 *  @param  string  $taxonomy   The custom taxonomy
 *  @param  boolean $filtering  True(default) Use mixit filters, false: use term archive link
 *  @see    partials/partial-resources
 *  @see    kit/assets/js/vendor/_mixitup.js
 *  @return string $filter_item
 */
 function jumpoff_filters($taxonomy, $type) {

   global $post;
   $terms = get_terms($taxonomy);
   $filter_item ='';

   if ($terms) {
     $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
     $class = '';

     foreach ( $terms as $term ) {

       if ( is_wp_error( $term ) ) {
         continue;
       }

       if( !is_object($term) ) {
         return;
       }

       $term_link = get_term_link( $term );

       if (is_tax()){
         $class = $current_term->slug == $term->slug ? 'is-active' : '' ;
       }

       if ( $type == 'span'  )  {
         $filter_items .= '<span class="filter ' . $class . '" data-filter="' . $term->slug . '">' . $term->name . '</span>';
       }
       elseif ($type == 'list') {
         $filter_items .= '<li><a class="' . $class . '" href="' . esc_url( $term_link) . '">' . $term->name . '</a></li>';
       }
       elseif ($type = 'link') {
         $filter_items .= '<a class="' . $class . '" href="' . esc_url( $term_link) . '">' . $term->name . '</a>';
       }
     }
     return $filter_items;
   }
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
  *  Categories List
  *  Returns cats wtih content to output as list
  *
  *  @return string $category_item
  */
 function jumpoff_cats($type) {
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
 function jumpoff_get_cat_slug(){
   // Import global post object
   global $post;

   $categories = get_the_category($post->ID);

   return $categories[0]->slug;
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
