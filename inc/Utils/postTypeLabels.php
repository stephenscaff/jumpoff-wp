<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Post Type Labels
 *  Utility to handle singular / plural labels of register_post_type();
 *  $labels = set_post_type_labels('Project', 'Projects');
 */
function set_post_type_labels( $singular = 'Post', $plural = 'Posts' ) {
 $p_lower = strtolower( $plural );
 $s_lower = strtolower( $singular );

 return [
   'name'                   => $plural,
   'singular_name'          => $singular,
   'add_new_item'           => "New $singular",
   'edit_item'              => "Edit $singular",
   'view_item'              => "View $singular",
   'view_items'             => "View $plural",
   'search_items'           => "Search $plural",
   'not_found'              => "No $p_lower found",
   'not_found_in_trash'     => "No $p_lower found in trash",
   'parent_item_colon'      => "Parent $singular",
   'all_items'              => "All $plural",
   'archives'               => "$singular Archives",
   'attributes'             => "$singular Attributes",
   'insert_into_item'       => "Insert into $s_lower",
   'uploaded_to_this_item'  => "Uploaded to this $s_lower",
 ];
}
