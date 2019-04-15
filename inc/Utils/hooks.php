<?php

namespace Jumpoff;

/**
 *  Body Class
 *  Cleans up body classes, then adds custom, based on page or cpt names
 *
 *  @return string $classes - Space deliminated collection of class names
 */
add_filter('body_class', function($classes) {

  global $post, $page;

  if (is_single() || is_page() && !is_front_page()) {
    $classes[] = 'page-' . basename(get_permalink());
  }
  if (is_front_page()) {
    $classes[] = 'page-home';
  }
  if (is_home() || is_singular('post') || is_post_type_archive( 'post' )) {
    $classes[] = 'page-news';
  }
  if (is_post_type_archive()) {
    $post_type_obj = get_queried_object();
    $classes[] = 'page-index-'.$post_type_obj->name;
  }
  if (is_any_post_type()) {
    $post_type_obj = get_queried_object();
    $post_type = get_post_type_object(get_post_type($post_type_obj));
    $classes[] = 'page-'.$post_type_obj->name;
  }

  $extra_classes = array('');
  $classes = array_merge( $classes, $extra_classes );

  $home_id_class = 'page-id-' . get_option('page_on_front');
  $page_id_class = 'page-id-' . get_the_ID();
  $post_id_class = 'postid-' . get_the_ID();
  $page_template_name_class = 'page-template-page-' . basename(get_permalink());
  $page_template_name_php = 'page-template-page-' . basename(get_permalink()) . '-php';

  $remove_classes = array(
    'page-template-default',
    'page-template',
    'single-format-standard',
    $home_id_class,
    $page_id_class,
    $post_id_class,
    $page_template_name_class,
    $page_template_name_php
  );

  $classes = array_diff($classes, $remove_classes);

  return $classes;

});
