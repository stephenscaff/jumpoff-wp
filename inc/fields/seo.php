<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Fields - SEO
 * Location: all pages, posts and post types. Edit as needed.
 */

$seo_fields = new StoutLogic\AcfBuilder\FieldsBuilder('seo', [
  'key' => 'group_seo',
  'position' => 'normal',
  'menu_order' => '999',
]);

$seo_fields
  ->addText('seo_title')
  ->addText('seo_canonical_url')
  ->addTextArea('seo_description',  [
    'rows' =>  '2'
  ])
  ->addImage('seo_image')
  ->setLocation('post_type', '==', 'page')
           ->or('post_type', '==', 'post')
           ->or('post_type', '==', 'article');

add_action('acf/init', function() use ($seo_fields) {
   acf_add_local_field_group($seo_fields->build());
});
