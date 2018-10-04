<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Admin Menus
 * Cleans up menu items, removing and reordering.
 */
class AdminMenus{

  /**
   * Constructor
   */
  function __construct(){
    // Uncomment to remove dangerous items for all but specified admin
    add_action( 'admin_menu', array( $this, 'remove_items') );
    add_filter('menu_order', array( $this, 'order_items') );
    add_filter('custom_menu_order', array( $this, 'order_items') );
  }


  /**
   * Remove Items
   * Remove menu items if not super user (me)
   */
  function remove_items(){
    global $current_user;

    # Always Remove
    remove_menu_page( 'edit-comments.php' );
    remove_menu_page( 'edit.php?post_type=acf-field-group' );
    //remove_menu_page( 'themes.php' );

    # If not admin remove
    if ( !current_user_can('administrator')  ) {
      remove_menu_page( 'plugins.php' );
      remove_menu_page( 'tools.php' );
    }
  }


  /**
   * Order Remaining Menu Items
   */
  function order_items($menu_order){
    if (!$menu_order) return true;

    return array(
      'index.php',
      'upload.php',
      'contacts',
      'notice-bar',
      'edit.php',
      'edit.php?post_type=team',
      'edit.php?post_type=page',                           // Media
      'users.php',                            // Users
      'separator2',                           // Second separator
      'plugins.php',                          // Plugins
      'tools.php',                            // Tools
      'options-general.php',                  // Settings
      'themes.php',                           // Appearance
    );
  }
}

new AdminMenus;
