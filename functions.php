<?php

if ( ! defined( 'ABSPATH' ) ) exit;


# Setup
require_once( 'inc/setup/setup.php'  );

# Additional Includes
array_map(
	function( $folder ) {
		require_once( "inc/{$folder}/includes.php"  );
	},
	[
		'utils',
		'acf',
    'admin',
    'fetch-more',
    'fields',
    'media',
    'post-types',
    'taxonomies',
		'api',
	]
);
//
//
// function my_pre_get_posts( $query ) {
//
// 	// do not modify queries in the admin
// 	if( is_admin() ) {
//
// 		return $query;
//
// 	}
//
//
// 	// only modify queries for 'event' post type
// 	if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'success_story' ) {
//
// 		// allow the url to alter the query
// 		if( isset($_GET['pro']) ) {
//
//     		$query->set('meta_key', 'pro');
// 				$query->set('meta_value', $_GET['pro']);
//
//     	}
//
// 	}
//
// 	jumpoff_dump($query);
// 	// return
// 	return $query;
//
// }
//
// //add_action('pre_get_posts', 'my_pre_get_posts');
