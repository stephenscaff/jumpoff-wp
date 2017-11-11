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
add_action('init', 'create_film_post_type');

function create_team_post_type() {
  register_post_type( 'film',

  array(
    'labels'              => array(
    'name'                => __( 'Film' ),
    'singular_name'       => __( 'Film' ),
    'add_new'             => __( 'Add New Film' ),
    'add_new_item'        => __( 'Add Another Film Peep.' ),
    'edit'                => __( 'Edit This Film, Please' ),
    'edit_item'           => __( 'Edit This Film, Please' ),
    'new_item'            => __( 'New Film' ),
    'view'                => __( 'Peep This Film' ),
    'view_item'           => __( 'Peep All Films ' ),
    'search_items'        => __( 'Search Your Films.' ),
    'not_found'           => __( 'Sorry punk. That Film cannot be found. Thank god, right?' ),
    'not_found_in_trash'  => __( 'That Film is not in the Trash. But it should be.' ),
  ),

  'description'           => __( 'The Films and Flicks or Ryan Cory.' ),
  'public'                => true,
  'show_ui'               => true,
  'menu_position'         => 6,
  'menu_dashicon'         => 'dashicons-video-alt3',
  'menu_icon'             => 'dashicons-video-alt3',
  'query_var'             => true,
  'supports'              => array( 'title','thumbnail', 'editor' ),
  'capability_type'       => 'post',
  'can_export'            => true,
  'has_archive'           => true,
  'rewrite'               => array('slug' => 'films', 'with_front' => false),
  ));
}
