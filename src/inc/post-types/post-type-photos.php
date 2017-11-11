<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *  Post Type: Team
 *
 *  Slug :      Team
 *  Supports : 'title','thumbnail','editor'
 *
 *  @version    1.0
 *  @author     stephen scaff
 */

# Init Work
add_action('init', 'create_photo_post_type');

function create_photo_post_type() {
  register_post_type( 'photo',

  array(
    'labels'              => array(
    'name'                => __( 'Photos' ),
    'singular_name'       => __( 'Photo' ),
    'add_new'             => __( 'Add New Photos' ),
    'add_new_item'        => __( 'Add Another Photos Peep.' ),
    'edit'                => __( 'Edit This Photos, Please' ),
    'edit_item'           => __( 'Edit This Photos, Please' ),
    'new_item'            => __( 'New Photos' ),
    'view'                => __( 'Peep This Photos' ),
    'view_item'           => __( 'Peep All Photos ' ),
    'search_items'        => __( 'Search Your Photos.' ),
    'not_found'           => __( 'Sorry punk. That Photos cannot be found. Thank god, right?' ),
    'not_found_in_trash'  => __( 'That Photos is not in the Trash. But it should be.' ),
  ),

  'description'           => __( 'Photos of Ryan "Stinky Pinky" Cory.' ),
  'public'                => true,
  'show_ui'               => true,
  'menu_position'         => 6,
  'menu_dashicon'         => 'dashicons-format-image',
  'menu_icon'             => 'dashicons-format-image',
  'query_var'             => true,
  'supports'              => array( 'title','thumbnail', 'editor' ),
  'capability_type'       => 'post',
  'can_export'            => true,
  'has_archive'           => true,
  'rewrite'               => array('slug' => 'photos', 'with_front' => false),
  ));
}
