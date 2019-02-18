<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 *  Featured News/Post
 */
 $message_label = "Select a Post to Feature";
 $message_text = "If nothing is selected here, the latest or dragged to the top post will be featured.";

 /**
  * Featured Community Post on Community
  */
 $featured_post = new StoutLogic\AcfBuilder\FieldsBuilder('featured', [
   'key' => 'group_featured',
   'position' => 'normal',
   'menu_order' => '1',
 ]);
 $featured_post
   ->addMessage($message_label, $message_text)
   ->addRelationship('featured_post_select',  [
    'post_type' =>  array('post'),
    'filters' => array('search', '', ''),
    'max'  => 1,
   ])
   ->setLocation('options_page', '==', 'posts-index');

 add_action('acf/init', function() use ($featured_post) {
   acf_add_local_field_group($featured_post->build());
 });



 /**
  * Featured Community Post on Community
  */
 $featured_cats = new StoutLogic\AcfBuilder\FieldsBuilder('featured_categories', [
   'key' => 'group_featured_categories',
   'menu_order' => '2',
 ]);
 $featured_cats
   ->addMessage('Featured Categories', 'Select 2 Categories to Highlight')
   ->addTaxonomy('featured_cat_1', [
    'label'         => 'Highlight Category 1',
    'taxonomy'      => 'category',
    'return_format' => 'id',
    'field_type'    => 'select',
   ])
   ->addTaxonomy('featured_cat_2', [
    'label'         => 'Highlight Category 2',
    'taxonomy'      => 'category',
    'return_format' => 'id',
  'field_type'    => 'select',
   ])
   ->setLocation('options_page', '==', 'posts-index');

 add_action('acf/init', function() use ($featured_cats) {
   acf_add_local_field_group($featured_cats->build());
 });
