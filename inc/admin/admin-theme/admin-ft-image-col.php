<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Post Image Column
 * Add featured image to posts cols
 */
class FeaturedImageColumn {

  /**
   * Constructor
   */
  function __construct(){
    add_filter('manage_posts_columns', array( $this, 'add_column'), 5 );
    add_action('manage_posts_custom_column', array( $this, 'add_image'), 5, 2 );
  }

  /**
   * Add Col
   */
  function add_column($defaults){
    $defaults['column_post_thumbs'] = __('Featured Image');
    return $defaults;
  }

  /**
   * Add Ft Image to Col
   */
  function add_image($column_name, $id){
    if ($column_name === 'column_post_thumbs'){
      echo the_post_thumbnail( 'featured-thumbnail');
    }
  }
}

new FeaturedImageColumn;
