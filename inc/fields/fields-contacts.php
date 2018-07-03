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
     'page_title'  => 'Company Contacts & Info',
     'menu_title'  => 'Contacts',
     'menu_slug'   => 'contacts',
     'icon_url'    =>  'dashicons-location',
     'capability'  => 'edit_posts',
     'position'    =>  '2',
     'redirect'    => false
   ));
 }

/**
 * Contacts Fields
 */
$contacts_fields = new StoutLogic\AcfBuilder\FieldsBuilder('contacts');

$contacts_fields
    ->addTextArea('company_mail_address', [
      'wrapper' =>  ['width' => '100%'],
      'rows' =>  '4',
    ])
    ->addMessage('Phone Numbers', '')
    ->addText('company_phone_local', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->addText('company_phone_tollfree', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->addMessage('Emails', '')
    ->addText('wecu_email', [
      'wrapper' =>  ['width' => '100%']
    ])
    ->addMessage('Socials', '')
    ->addText('company_youtube', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->addText('company_instagram', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->addText('company_twitter', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->addText('company_linkedin', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->addText('company_facebook', [
      'wrapper' =>  ['width' => '50%']
    ])
    ->setLocation('options_page', '==', 'contacts');

add_action('acf/init', function() use ($contacts_fields) {
   acf_add_local_field_group($contacts_fields->build());
});
