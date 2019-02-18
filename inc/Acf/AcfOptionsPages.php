<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Create Global Elements Menu Item
 */
if( function_exists('acf_add_options_page') ) {

 	# Site Globals (Parent)
	$site_globals = acf_add_options_page(array(
		'page_title' 	=> 'Site Globals',
		'menu_title' 	=> 'Site Globals',
		'icon_url'		=> 'dashicons-marker',
		'redirect' 		=> true
	));

	# Contacts
	$page_contacts = acf_add_options_sub_page(array(
    'page_title'  => 'Contacts & Info',
    'menu_title'  => 'Contacts',
    'menu_slug'   => 'contacts',
    'position'    =>  '1',
		'parent_slug' 	=> $site_globals['menu_slug'],
	));

	# JS Tracking
	$page_tracking_scripts = acf_add_options_page(array(
		'page_title'  => 'Tracking Scripts',
		'menu_title'  => 'Tracking Scripts',
		'menu_slug'   => 'tracking',
		'position'    =>  '6',
		'parent_slug' 	=> $site_globals['menu_slug'],
	));
}
