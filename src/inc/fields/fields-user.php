<?php
/**
 * Fields - User / Author
 * Location: User Profile Page
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$user_fields = new StoutLogic\AcfBuilder\FieldsBuilder('user');

$user_fields
    ->addImage('user_avatar')
    ->setGroupConfig( 'position', 'high' )
    ->setLocation('user_form', '==', 'all');

add_action('acf/init', function() use ($user_fields) {
   acf_add_local_field_group($user_fields->build());
});
