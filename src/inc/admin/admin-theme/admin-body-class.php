<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 * Admin Body Class
 * Adds body class to admin pages
 */
class AdminBodyClass {

  function __construct(){
    add_filter( 'admin_body_class', array( $this, 'admin_body_class' ) );
  }


  /**
   *  Body Class for admin
   *  Adding a body class allows us to target
   *  and style desired elements
   */
  function admin_body_class(){

    global $post;


    if( !is_object($post) ) {
      return;
    }

    setup_postdata( $post );

    // Returns an object that includes the screen’s ID, base, post type, taxonomy
    // @see https://developer.wordpress.org/reference/functions/get_current_screen
    $screen = get_current_screen();

    // Construct class from post id
    $post_id = 'admin-post-'.$post->ID;

    // Page Name
    $page_name = 'admin-'.$post->post_name;
    $page_template = $page_template_name;
    $classes;
    $classes = ' ' . $screen->post_type . ' ' . $post_id . ' ' . $page_name . '';

    // Had issues returning page template name, so...
    if (basename( get_page_template() ) === 'page.php' OR basename(get_page_template()) === 'mast.php'){
      $classes .= ' admin-page-template-default';
    }

    return $classes;
    wp_reset_postdata( $post );
  }
}

new AdminBodyClass;
