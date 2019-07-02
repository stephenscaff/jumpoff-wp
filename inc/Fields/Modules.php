<?php
/**
 * Modules
 */

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

require_once('Modules/Banners.php');
require_once('Modules/Cards.php');
require_once('Modules/Content.php');
require_once('Modules/Posts.php');
require_once('Modules/Mast.php');

$modules= new FieldsBuilder('modules', [
  'key' => 'group_modules',
  'menu_order' => '2',
]);

$modules
  ->addFlexibleContent('modules',
    ['button_label'=> 'Add Module']
  )
  ->addLayout($banners_module,
    ['name'=> 'banners_module']
  )
  ->addLayout($cards_module,
    ['name'=> 'cards_module']
  )
  ->addLayout($content_module,
    ['name'=> 'content_module']
  )
  ->addLayout($posts_module,
    ['name'=> 'posts_module']
  )
  ->addLayout($mast_module,
    ['name'=> 'mast_module']
  )
  ->setLocation('page_template', '==', 'templates/modules.php')
    ->or('page_template', '==', 'templates/home.php');

  add_action('acf/init', function() use ($modules) {
     acf_add_local_field_group($modules->build());
  });
