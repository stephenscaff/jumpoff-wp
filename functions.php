<?php

if ( ! defined( 'ABSPATH' ) ) exit;


# Setup
require_once( 'inc/Setup/Setup.php'  );
require_once( 'inc/Setup/templateLoader.php'  );

# Additional Includes
array_map(
	function( $folder ) {
		require_once( "inc/{$folder}/includes.php"  );
	},
	[
		'Utils',
		'Acf',
    'Admin',
    'FetchMore',
    'Fields',
    'Media',
    'PostTypes',
		'Api',
	]
);
