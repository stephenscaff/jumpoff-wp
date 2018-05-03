<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *   Mast Fields
 *   For mastheads and stuff.
 */

$mast_fields = new StoutLogic\AcfBuilder\FieldsBuilder('mast', [
    'key' => 'group_mast',
    'position' => 'acf_after_title',
    'menu_order' => '1',
]);;


$mast_fields
    ->addText('mast_pretitle')
    ->addText('mast_title')
    ->addTextArea('mast_text',  [
      'rows' =>  '3'
    ])
    ->addImage('mast_image')
    ->setLocation('post_type', '==', 'page');

add_action('acf/init', function() use ($mast_fields) {
   acf_add_local_field_group($mast_fields->build());
});
