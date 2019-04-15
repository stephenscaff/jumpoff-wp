<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Upload Images by Content Type
 */
 add_filter( 'upload_dir', 'uploads_by_type' );

 function uploads_by_type( $args ) {
   $id = ( isset( $_REQUEST['post_id'] ) ? $_REQUEST['post_id'] : '' );

   if ( $id ) {
    $directory = '/' . get_post_type( $id );

    $args['path']    = str_replace( $args['subdir'], '', $args['path'] );
    $args['url']     = str_replace( $args['subdir'], '', $args['url'] );
    $args['subdir']  = $directory;
    $args['path']   .= $directory;
    $args['url']    .= $directory;
   }

   return $args;
 }
