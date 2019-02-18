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

//
// public function load_class($class){
//     $path = str_replace('_', '/', $class);
//     foreach(self::$_directories as $directories){
//         if(file_exists($directories . '/' . $path . '.php')){
//             require_once($directories . '/' . $path . '.php');
//             return;
//         }
//     }
// }


// $files = glob(get_template_directory() . "/inc/*/*.php");
// foreach ($files as $function) {
// 	var_dump($files);
//     //$function= basename($function);
// 		require $function;
//     //require get_template_directory() . '/inc/' . $function;
// }
