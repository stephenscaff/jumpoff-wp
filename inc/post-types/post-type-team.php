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
add_action('init', 'create_team_post_type');

function create_team_post_type() {
  register_post_type( 'team',

  array(
    'labels'              => array(
    'name'                => __( 'Team' ),
    'singular_name'       => __( 'Team' ),
    'add_new'             => __( 'Add New Team' ),
    'add_new_item'        => __( 'Add Another Team.' ),
    'edit'                => __( 'Edit This Team' ),
    'edit_item'           => __( 'Edit This Team' ),
    'new_item'            => __( 'New Team' ),
    'view'                => __( 'Peep This Team' ),
    'view_item'           => __( 'Peep All Team ' ),
    'search_items'        => __( 'Search Your Team' ),
    'not_found'           => __( 'Sorry. That Team cannot be found.' ),
    'not_found_in_trash'  => __( 'That Team is not in the Trash.' ),
  ),

  'description'           => __( 'The ___ Team' ),
  'public'                => true,
  'show_ui'               => true,
  'menu_position'         => 6,
  'menu_dashicon'         => 'dashicons-id',
  'menu_icon'             => 'dashicons-id',
  'query_var'             => true,
  'supports'              => array( 'title','thumbnail', 'editor', 'author' ),
  'capability_type'       => 'post',
  'can_export'            => true,
  'has_archive'           => true,
  'rewrite'               => array('slug' => 'Team', 'with_front' => false),
  ));
}



/**
 *  Taxonomy: Team Cat
 *
 *  Creates 'Team_cat' custom taxonomy
 *
 *  Slug : Team-categories
 *  hierarchical : true
 *
 *  @author     Stephen Scaff
 *  @version    1.0
 */
add_action( 'init', 'team_cat');

function team_cat() {
  register_taxonomy(
  'team_cat',
  'team',
    array(
      'labels'            => array(
      'name'              => _x('Team Categories', 'taxonomy general name'),
      'singular_name'     => _x('Team Categories', 'taxonomy singular name'),
      'search_items'      => __('Search Team Categories '),
      'all_items'         => __('All Team Categories'),
      'edit_item'         => __('Edit Team Categories'),
      'update_item'       => __('Update Team Categories'),
      'add_new_item'      => __('Add New Team Categories'),
      'new_item_name'     => __('New Team Categories'),
      'menu_name'         => __('Team Categories'),
    ),
    'hierarchical'        => true,
    'show_ui'             => true,
    'show_admin_column'   => true,
    'show_in_quick_edit'  => true,
    'rewrite'             => array(
        'slug'            => 'team-categories',
        'with_front'      => false,
      ),
  ));
}
