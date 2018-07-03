<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * CPT ACF
 *
 * Adds a Menu Item for custom post types to add options page fields.
 *
 * @author    Stephen Scaff
 * @package   Jumpoff
 * @version   1.0
 */
add_action( 'init', 'post_type_index_options_pages', 99 );

function post_type_index_options_pages() {

  if( function_exists('acf_add_options_page') ) { //Check if installed acf

      $post_type_index_post_types = get_post_types( array(
          '_builtin' => false,
          'has_archive' => true
      ) ); //get post types

      foreach ( $post_type_index_post_types as $post_type ) {

        if( post_type_exists( $post_type ) ) {

          $post_type_name = get_post_type_object( $post_type )->labels->name;

          $post_type_acf_page = array(
              'page_title' => ucfirst( $post_type_name ) . ' Index',
              'menu_title' => ucfirst( $post_type_name ) . ' Index',
              'menu_slug' => $post_type. '-index',
              'capability' => 'edit_posts',
              'position' => false,
              'parent_slug' => 'edit.php?post_type=' . $post_type,
              'icon_url' => false,
              'redirect' => false,
              'post_id' => $post_type . '-index',
              'autoload' => false
          );

          acf_add_options_page( $post_type_acf_page );

      } // end if
    }
  } else {
    // Activation Warning
    add_action( 'admin_notices', 'post_type_index_admin_error_notice' );

    function post_type_index_admin_error_notice(){
      // $output = '<section class="admin-alert"><p>Whoops... Better create that post type first.</p></section>';
      //   echo $output;
    }
  }
}



if ( function_exists( 'acf_add_options_sub_page' ) ){
  acf_add_options_sub_page(array(
    'title'      => 'Blog Index',
    'parent'     => 'edit.php',
    'capability' => 'manage_options'
  ));
}
