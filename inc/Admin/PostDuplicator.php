<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Duplicate Posts and Pages
 * Provides functionality to dupe pages and posts
 * Gets all post info/data, including ACF Fields and Modules
 */
add_action( 'admin_action_duplicate_post_as_draft', 'duplicate_post_as_draft' );

function duplicate_post_as_draft(){

  global $wpdb;

  if (! ( isset( $_GET['post']) || isset( $_POST['post'])  ||
        ( isset($_REQUEST['action']) && 'duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {

    wp_die('You haven\'t supplied a post to duplicate');

  }

  /*
   * Get original post id
   */
  $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );

  /*
   * Get orginal post data
   */
  $post = get_post( $post_id );

  /**
   * Get Current User
   * Don't want current user to be the new post author?
   * Then do this: $new_post_author = $post->post_author;
   */
  $current_user = wp_get_current_user();
  $new_post_author = $current_user->ID;

  /*
   * if post data exists, create the post duplicate
   */
  if (isset( $post ) && $post != null) {

    /**
     * Post Data Args
     */
    $args = array(
      'comment_status' => $post->comment_status,
      'ping_status'    => $post->ping_status,
      'post_author'    => $new_post_author,
      'post_content'   => $post->post_content,
      'post_excerpt'   => $post->post_excerpt,
      'post_name'      => $post->post_name,
      'post_parent'    => $post->post_parent,
      'post_password'  => $post->post_password,
      'post_status'    => 'draft',
      'post_title'     => $post->post_title,
      'post_type'      => $post->post_type,
      'to_ping'        => $post->to_ping,
      'menu_order'     => $post->menu_order
    );

    /**
     * Insert post via wp_insert_post()
     */
    $new_post_id = wp_insert_post( $args );

    /**
     * Get array of Post Terms and set on duped post
     */
    $taxonomies = get_object_taxonomies($post->post_type);

    /**
     * Loop through terms
     */
    foreach ($taxonomies as $taxonomy) {
      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
    }

    /**
     * SQL Queries to get post & meta infos
     */
    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");

    if ( count( $post_meta_infos ) != 0 ) {

      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";

      foreach ( $post_meta_infos as $meta_info ) {
        $meta_key = $meta_info->meta_key;
        $meta_value = addslashes($meta_info->meta_value);
        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
      }

      $sql_query.= implode(" UNION ALL ", $sql_query_sel);

      $wpdb->query($sql_query);
    }

    /**
     * Redirect to new post in edit mode
     */
    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
    exit;

  } else {
    // if error
    wp_die('Post creation failed, could not find original post: ' . $post_id);

  }
}

/**
 * Add the duplicate link to action list
 * @see post_row_actions filter;
 */
add_filter( 'post_row_actions', 'duplicate_post_link', 10, 2 );
add_filter( 'page_row_actions', 'duplicate_post_link', 10, 2 );

function duplicate_post_link( $actions, $post ) {

  if (current_user_can('edit_posts')) {
    $actions['duplicate'] = '<a href="admin.php?action=duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
  }
  return $actions;
}
