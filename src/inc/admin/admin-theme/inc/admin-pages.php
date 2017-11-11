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
    'page_title'  => 'Company Contact Info',
    'menu_title'  => 'Company Contacts',
    'menu_slug'   => 'company-contacts',
    'icon_url'    =>  'dashicons-location',
    'capability'  => 'edit_posts',
    'position'    =>  '3',
    'redirect'    => false
  ));

  /**
   * Site Meny
   */
  $page_menu = acf_add_options_page(array(
    'page_title'  => 'Site Menu',
    'menu_title'  => 'Site Menu',
    'menu_slug'   => 'site-menu',
    'icon_url'    => 'dashicons-menu',
    'capability'  => 'edit_posts',
    'position'    =>  '1',
    'redirect'    => false
  ));
}