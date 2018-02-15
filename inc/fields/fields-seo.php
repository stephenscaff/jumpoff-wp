<?php
/**
 * Fields - SEO
 * Location: all pages, posts and post types
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$seo_fields = new StoutLogic\AcfBuilder\FieldsBuilder('seo', [
'key' => 'seo',
'position' => 'normal',
'menu_order' => '13',
]);

$seo_fields
  # SEO Title
  ->addText('seo_title')
  # SEO Description
  ->addTextArea('seo_description',  [
    'rows' =>  '2'
  ])
  # SEO Image
  ->addImage('seo_image')
  ->setLocation('post_type', '==', 'page')
      ->or('post_type', '==', 'post')
      ->or('post_type', '==', 'article');

add_action('acf/init', function() use ($seo_fields) {
   acf_add_local_field_group($seo_fields->build());
});
