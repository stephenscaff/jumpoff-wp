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
		'acf',
    'admin',
    'fetch-more',
    'fields',
    'media',
    'post-helpers',
    'post-types',
    'taxonomies',
    'utils',
	]
);
