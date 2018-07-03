<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *  Post Type: Testimonals
 *
 *  Slug :      Team
 *  Supports : 'title','thumbnail','editor'
 *
 *  @version    1.0
 *  @author     stephen scaff
 */

add_action( 'init', function() {
  $type = 'testimonial';

  // Call the function and save it to $labels
  $labels = jumpoff_post_type_labels('Testimonial', 'Testimonials');

  $args = [
   'public'             => true,
   'description'        => 'Testimonals from WECU members.',
   'labels'             => $labels,
   'show_ui'            => true,
   'menu_position'      => 3,
   'menu_dashicon'      => 'dashicons-format-chat',
   'menu_icon'          => 'dashicons-format-chat',
   'query_var'          => true,
   'supports'           => array( 'title','thumbnail', 'editor' ),
   'capability_type'    => 'post',
   'can_export'         => false,
   'has_archive'        => false,
   'rewrite'            => array('slug' => 'team', 'with_front' => false),
  ];

 register_post_type( $type, $args);
});
