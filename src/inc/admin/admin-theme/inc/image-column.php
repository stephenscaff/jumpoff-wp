<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Post Image Column
 * Add featured image to posts cols
 */
class PostsImageColumn{

  /**
   * Constructor
   */
  function __construct(){
    add_filter('manage_posts_columns', array( $this, 'posts_columns'), 5 );
    add_action('manage_posts_custom_column', array( $this, 'posts_custom_columns'), 5, 2 );
    //add_action('manage_test_posts_custom_column', array( $this, 'posts_custom_columns'), 5, 2 );
  }


  /**
   * Order Remaining Menu Items
   */
  function posts_columns($defaults){
    $defaults['column_post_thumbs'] = __('Thumbs');
    return $defaults;
  }


  /**
   * Order Remaining Menu Items
   */
  function posts_custom_columns($column_name, $id){
    if($column_name === 'column_post_thumbs'){
      echo the_post_thumbnail( 'featured-thumbnail');
    }
  }
}

new PostsImageColumn;
