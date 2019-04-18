<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Check for Options Page capabilities
 */
 if ( function_exists('acf_add_options_page') ) {

/**
 * Contacts Fields
 */
$contacts = new StoutLogic\AcfBuilder\FieldsBuilder('contacts');

$contacts
  ->addTextArea('company_mail_address',
    [
      'wrapper' =>  ['width' => '100%'],
      'rows'    =>  '4',
    ]
  )
  ->addText('company_phone',
    [
      'wrapper' =>  ['width' => '50%']
    ]
  )
  ->addText('company_email',
    [
      'wrapper' =>  ['width' => '50%']
    ]
  )
  ->addMessage('Socials', '')
  ->addText('company_youtube',
    [
      'wrapper' =>  ['width' => '50%']
    ]
  )
  ->addText('company_instagram',
    [
      'wrapper' =>  ['width' => '50%']
    ]
  )
  ->addText('company_twitter',
    [
      'wrapper' =>  ['width' => '50%']
    ]
  )
  ->addText('company_facebook',
    [
      'wrapper' =>  ['width' => '50%']
    ]
  )
  ->setLocation('options_page', '==', 'contacts');

  add_action('acf/init', function() use ($contacts) {
     acf_add_local_field_group($contacts->build());
  });
}
