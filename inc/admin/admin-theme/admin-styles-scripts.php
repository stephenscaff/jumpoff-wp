<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Admin Styles/Scripts Loader
 * Loads assets and provides methods for customizing the wp admin,
 */
class AdminStylesScripts {

  /**
   * Constructor
   */
  function __construct(){
    add_action('admin_enqueue_scripts', array( $this, 'load_styles') );
    add_action('login_enqueue_scripts', array ( $this, 'load_styles') );
  }

  /**
   * Load styles
   */
  function load_styles(){
    wp_enqueue_style('admin', get_template_directory_uri() . '/inc/admin/admin-theme/assets/css/admin.min.css', false );
  }
}

new AdminStylesScripts;
