<?php

/**
 * Login Logo
 * Injects an SVG logo on the default login screen
 * via the login_message filter.
 * @see jumpoff_svg at inc/paths
 */
add_filter( 'login_message', function( $message ) {
  $svg = jumpoff_svg('-logo');
  return $svg;
});
