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

add_action( 'init', function() {
 $type = 'team';

 // Call the function and save it to $labels
 $labels = jumpoff_post_type_labels('Team Member', 'Team');

 $args = [
   'public'             => true,
   'description'        => 'Wecu Team Members.',
   'labels'             => $labels,
   'show_ui'            => true,
   'menu_position'      => 3,
   'menu_dashicon'      => 'dashicons-id',
   'menu_icon'          => 'dashicons-id',
   'query_var'          => true,
   'supports'           => array( 'title','thumbnail', 'editor' ),
   'capability_type'    => 'post',
   'can_export'         => true,
   'has_archive'        => true,
   'rewrite'            => array('slug' => 'team', 'with_front' => false),
 ];
 register_post_type( $type, $args);
});


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

 add_action( 'init', function() {
   $tax = 'team_cat';
   $type = 'team';

   // Call the function and save it to $labels
   $labels = jumpoff_post_type_labels('Team Categories', 'Team Categorey');

   $args = [
       'description'        => 'Wecu Team Members.',
       'labels'             => $labels,
       'hierarchical'        => true,
       'show_ui'             => true,
       'show_admin_column'   => true,
       'show_in_quick_edit'  => true,
       'rewrite'            => array('slug' => 'team-categories', 'with_front' => false),
   ];
   register_taxonomy( $tax, $type, $args);
 });

//
// add_action( 'init', 'team_cat');
//
// function team_cat() {
//   register_taxonomy(
//   'team_cat',
//   'team',
//     array(
//       'labels'            => array(
//       'name'              => _x('Team Categories', 'taxonomy general name'),
//       'singular_name'     => _x('Team Categories', 'taxonomy singular name'),
//       'search_items'      => __('Search Team Categories '),
//       'all_items'         => __('All Team Categories'),
//       'edit_item'         => __('Edit Team Categories'),
//       'update_item'       => __('Update Team Categories'),
//       'add_new_item'      => __('Add New Team Categories'),
//       'new_item_name'     => __('New Team Categories'),
//       'menu_name'         => __('Team Categories'),
//     ),
//     'hierarchical'        => true,
//     'show_ui'             => true,
//     'show_admin_column'   => true,
//     'show_in_quick_edit'  => true,
//     'rewrite'             => array(
//         'slug'            => 'team-categories',
//         'with_front'      => false,
//       ),
//   ));
// }
