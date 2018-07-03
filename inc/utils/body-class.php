<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 *  Body Class
 *  Cleans up body classes, then adds custom, based on page or cpt names
 *  @return (array) $classes collection of classes
 */

add_filter('body_class', 'jumpoff_body_class');

function jumpoff_body_class($classes) {

  global $post, $page;

  # Classes Array
  $classes = [];

  # Single Pages
  if ( is_single() || is_page() && !is_front_page() ) {

    $classes[] = 'page-' . basename(get_permalink());

  }

   /**
    * Blog / News page
    */
   if (is_home() || is_singular('post') || is_post_type_archive( 'post' )) {

     $classes[] = 'page-news';

   }

   /**
    * Is any post type?
    * @see inc/utils/conditionals.php
    */
   if ( is_any_post_type() ) {

     $post_type_obj = get_queried_object();
     $post_type = get_post_type_object(get_post_type($post_type_obj));
     $classes[] = 'page-'.$post_type->rewrite['slug'];

   }

   if ( is_post_type_archive() ) {

     $classes[] = 'page-index-'.$post_type_obj->name;

   }

   /**
    * Add Specific Classes
    */
   $extra_classes = array('');

   /**
    * Merge our final array
    */
   $classes = array_merge( $classes, $extra_classes );

   return $classes;
}

  // List of the only WP generated classes allowed
  //$whitelist = array( '  ', 'home', 'error404' );
  // Filter the body classes
  //$classes = array_intersect( $classes, $whitelist );
  //$classes = array_merge( $classes, (array) $classes );
