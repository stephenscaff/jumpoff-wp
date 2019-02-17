<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Example Post Type
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
 $labels = jumpoff_post_type_labels('Team Member', 'Team Members');

 $args = [
   'public'             => true,
   'description'        => 'Team Members post type example.',
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
   'show_in_rest'       => true,
   'rest_base'          => 'team',
   'rest_controller_class' => 'WP_REST_Posts_Controller',
   'rewrite'            => array(
     'slug'       => 'team',
     'with_front' => false
   ),
 ];
 register_post_type( $type, $args);
});


/**
 *  Taxonomy: Team Filters
 *
 *  Creates 'Team_cat' custom taxonomy
 *
 *  Slug : team-categories
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
       'description'        => 'Team Members Categories.',
       'labels'             => $labels,
       'hierarchical'        => true,
       'show_ui'             => true,
       'show_admin_column'   => true,
       'show_in_quick_edit'  => true,
       'rewrite'            => array('slug' => 'team-categories', 'with_front' => false),
   ];
   register_taxonomy( $tax, $type, $args);
 });





/**
 * Add ACF Fields to Products Endpoint
 */
add_filter("rest_prepare_team", 'team_rest_prepare_post', 10, 3);

function team_rest_prepare_post($data, $post, $request) {
   $_data = $data->data;

   $fields = get_fields($post->ID);

   foreach ($fields as $key => $value){
       $_data[$key] = get_field($key, $post->ID);
   }

   $data->data = $_data;
   return $data;
}
