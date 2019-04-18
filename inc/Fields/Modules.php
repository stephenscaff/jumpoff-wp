<?php
/**
 * Modules
 */

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

$modules= new FieldsBuilder('modules', [
  'key' => 'group_modules',
  'menu_order' => '2',
]);

$modules
  ->addFlexibleContent('modules', [
    'button_label'=> "Add Module",
  ])
  ->addLayout($halfs_module, [
    'name'=> "halfs_module",
  ])
  ->addLayout($fulls_module, [
    'name'=> "fulls_module",
  ])
  ->setLocation('page_template', '==', 'templates/modules.php')
    ->or('page_template', '==', 'templates/home.php');

  add_action('acf/init', function() use ($modules) {
     acf_add_local_field_group($modules->build());
  });
