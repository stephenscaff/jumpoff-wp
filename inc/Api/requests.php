<?php

if ( ! defined( 'ABSPATH' ) ) exit;

 * API CORS / Headers
 * Whitelistrsnjd j n of allowed origins for external requests
 */
add_action( 'rest_api_init', function() {

	remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );

	add_filter( 'rest_pre_serve_request', function( $value ) {

		$origin = get_http_origin();

    $allowed_origins = array(
      'http://127.0.0.1:9999/',
      'http://127.0.0.1',
      'http://staging-somsite.kinsta.cloud',
      'https://somesite.com'
    );

		if ( $origin && in_array( $origin,  $allowed_origins) ) {
			header( 'Access-Control-Allow-Origin: ' . esc_url_raw( $origin ) );
			header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
			header( 'Access-Control-Allow-Credentials: true' );
		}

		return $value;

	});
}, 15 );



/**
 * Meta Request Params
 * Gets multipe meta_values seperated by comamas
 * @example fetch request : ?meta_key=professional_email&meta_value=ebutler@kiddermathews.com,mgardner@kiddermathews.com
 */
add_filter( 'rest_POSTTYPE_query', 'meta_request_params', 99, 2 );

function meta_request_params( $args, $request ) {

  $queries = explode(',', $request['meta_value'][0]);

	$args += array(
		'meta_key'   => $request['meta_key'],
		'meta_value' => $queries,
		'meta_query' => $request['meta_query'],
	);
    return $args;
}
