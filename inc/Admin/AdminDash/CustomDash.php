<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Custom Dash
 *
 *  Class to establish a new dash/welcome view
 *
 *  @version    1.0
 */

class CustomDash {

  /**
   * @var CustomDash
   */
  public static $instance;

  /**
   * @return CustomDash
   */
  public static function init() {
    if ( is_null( self::$instance ) )
      self::$instance = new CustomDash();
    return self::$instance;
  }

  /**
   * Constructor
   */
  function __construct() {
    add_action('admin_menu', array( $this,'register_menu') );
    add_action('load-index.php', array( $this,'redirect_dash') );
  }

  /**
   * Redirect to custom dash view
   */
  function redirect_dash() {

    if( is_admin() ) {
      $screen = get_current_screen();

      if( $screen->base == 'dashboard' ) {
        wp_redirect( admin_url( 'index.php?page=welcome' ) );
      }
    }
  }

  /**
   * Register Menu item for dash
   */
  function register_menu() {
    add_dashboard_page( 'Welcome', 'Welcome', 'read', 'welcome', array( $this,'dash_view') );
  }

  /**
   * Load the Dash View
   */
  function dash_view() {
    require_once('dash_view.php');;
  }
}

CustomDash::init();
