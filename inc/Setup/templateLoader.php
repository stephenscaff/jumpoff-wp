<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Template Loader
 *
 * Interceps the existing WP template loader with a
 * more organized file structrue (as much as possible anyway),
 * using the template_include hook.
 *
 * Archive, Single and Search tempaltes first look for a folder
 * named after the post_type in our views directroy. If nothing
 * is found, core naming is respected.
 */
add_filter('template_include', function( $original_template ) {
  global $wp_query;
  $post_type = get_query_var('post_type');
  $template_dir = "views/{$post_type}";
  $post_dir = "views/post/";


  if (is_admin()) return;

  elseif (is_search( [ $post_type ]) && locate_template( "{$template_dir}/search.php")) {
    return locate_template("{$template_dir}/search.php");
  }
  elseif ( is_search( ['post'] ) && locate_template( "{$post_dir}/search.php") ) {
    return locate_template("{$post_dir}/search.php");
  }

  elseif ( is_singular( [ $post_type ] ) && locate_template( "{$template_dir}/single.php") ) {
    return locate_template("{$template_dir}/single.php");
  }
  elseif ( is_singular( [ 'post'] ) && locate_template( "{$post_dir}/single.php")) {
    return locate_template("{$post_dir}/single.php");
  }

  elseif ( is_post_type_archive( [ $post_type ] ) && locate_template( "{$template_dir}/archive.php") ) {
    return locate_template("{$template_dir}/archive.php");
  }
  elseif ( is_post_type_archive( 'post' ) && locate_template( "{$post_dir}/archive.php") ) {
    return locate_template("{$post_dir}/archive.php");
  }

  else {
    return $original_template;
  }
});
