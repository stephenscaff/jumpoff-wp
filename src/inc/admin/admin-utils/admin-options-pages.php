<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
 * Register Admin pages via ACF hook
 * for ACF fields (uses options table)
 */
if( function_exists('acf_add_options_page') ) {

  /**
   * Company Contacts Page
   */
  $page_contacts = acf_add_options_page(array(
    'page_title'  => 'Contactss',
    'menu_title'  => 'Contacts',
    'menu_slug'   => 'contacts',
    'icon_url'    =>  'dashicons-location',
    'capability'  => 'edit_posts',
    'position'    =>  '3',
    'redirect'    => false
  ));
}
