<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 * Admin Extras
 * Class to add useful stuff and remove stupid stuff.
 */
class AdminUserFields{

  function __construct(){
    add_filter('user_contactmethods', array( $this, 'add_profile_fields') );
    $this->remove_profile_fields();
  }

  /**
   * Featured Image Meta Hints
   */
  function add_profile_fields($user_fields){

    $user_fields['facebook'] = 'Facebook';
    $user_fields['twitter'] = 'Twitter';
    $user_fields['phone'] = 'Phone Number';
    $user_fields['position'] = 'Position';

    return $user_fields;
  }

  /**
   * Admin Clean Ups
   * Clean up any pointless dingleberries
   */
  function remove_profile_fields(){
    remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
    remove_action( 'additional_capabilities_display', 'additional_capabilities_display' );
  }
}
new AdminUserFields;
