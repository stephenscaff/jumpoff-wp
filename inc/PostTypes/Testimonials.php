<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Post Type: Testimonials (non hierarchical example)
 *
 *  @version    1.0
 *  @author     stephen scaff
 *  @see        inc/utils/post-type-labels
 */

add_action( 'init', function() {
  $type = 'testimonial';

  $labels = jumpoff_post_type_labels('Testimonial', 'Testimonials');

  $args = [
   'public'             => true,
   'description'        => 'Testimonals post type example.',
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
