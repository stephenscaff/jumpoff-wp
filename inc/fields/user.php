<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Admin Extras
 * Class to add useful stuff and remove stupid stuff.
 */
class UserFields{

  /**
   * Constructor
   */
  function __construct(){

    # autoloader for composer / StoutLogic
    // $autoload = get_template_directory().'/vendor/autoload.php';
    // require_once( $autoload);

    add_filter('user_contactmethods', array( $this, 'add_contact_fields') );
    $this->add_content_fields();
    $this->remove_fields();
  }

  /**
   * Add Contact Method Fields
   *
   * Could maybe roll all this into our ACF fields,
   * for consistency. But, seems better to leverage
   * native/baked-in helpers.
   */
  function add_contact_fields($user_fields){
    # LinkedIn, Phone, Company position
    $user_fields['facebook'] = 'Facebook';
    $user_fields['twitter'] = 'Twitter';
    $user_fields['phone'] = 'Phone Number';
    $user_fields['position'] = 'Position';

    return $user_fields;
  }

  /**
   * Add User COntent Fields
   * Normally adding this from inc/fields but let's keep related things grouped.
   * Using StoutLogic's ACF Builder.
   * @see StoutLogic
   * @see ACF
   */
  function add_content_fields() {
    # Define User field group
    $user_fields = new StoutLogic\AcfBuilder\FieldsBuilder('user', [
      'key' => 'group_user',
      'title' => 'User Content'
    ]);

    # Add avatar, wysi editor, youtube id
    $user_fields
      ->addImage('user_avatar')
      ->addWysiwyg('user_content')
      ->setGroupConfig( 'position', 'high' )
      ->setLocation('user_form', '==', 'all');

    # Init User Field Group
    add_action('acf/init', function() use ($user_fields) {
       acf_add_local_field_group($user_fields->build());
    });
  }

  /**
   * Remove useless fields
   * Clean up any pointless dingleberries
   */
  function remove_fields(){
    add_filter( 'option_show_avatars', '__return_false' );
    remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
    remove_action( 'additional_capabilities_display', 'additional_capabilities_display' );
  }
}

new UserFields;
