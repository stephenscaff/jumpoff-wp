<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register Contacts Options Page
 */
 if( function_exists('acf_add_options_page') ) {

   /**
    * Company Contacts Page
    */
   $page_contacts = acf_add_options_page(array(
     'page_title'  => 'Contacts',
     'menu_title'  => 'Contacts',
     'menu_slug'   => 'contacts',
     'icon_url'    =>  'dashicons-location',
     'capability'  => 'edit_posts',
     'position'    =>  '3',
     'redirect'    => false
   ));
 }

/**
 * Contacts Fields
 */
$contacts_fields = new StoutLogic\AcfBuilder\FieldsBuilder('contacts');

$contacts_fields
    ->addText('contacts_phone', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->addText('contacts_email', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->addText('contacts_instagram', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->addText('contacts_twitter', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->addText('contacts_linkedin', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->addText('contacts_facebook', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->setLocation('options_page', '==', 'contacts');

add_action('acf/init', function() use ($contacts_fields) {
   acf_add_local_field_group($contacts_fields->build());
});
