<?php
/**
 * Modules Library
 * Modules registed are are inteded to be reused by variable
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use StoutLogic\AcfBuilder\FieldsBuilder;


/**
 * Featured Content Module
 * @see partials/modules/featured-content-module.php
 * @see scss/components/ft-cards.scss
 */
$featured_content_module = new FieldsBuilder('featured_content_module');
$featured_content_module
  ->addMessage('', 'The Featured Content Module allows you to select various content types to display as cards. You can search for a title or filter with the selects.')
  ->addRelationship('post_selector',  [
   'post_type' =>  array('post', 'article'),
   'min' => 1,
   'max' => 1,
   //'filters' => array('search', 'testimonai', 'audience'),
  ])

/**
 * Post Cards Module
 */
$post_cards_module = new FieldsBuilder('post_cards_module');
$post_cards_module
  ->addMessage('', 'The Cards Module allows you to select various content types to display as cards. You can search for a title or filter with the selects.')
  ->addFields($heading_field)
  ->addRelationship('posts_picker',  [
    'post_type' =>  array('article', 'recipe'),
    'min' => 1,
  ])
  ->addSelect('archive_link', [
    'instructions' => 'Select an Optional View All archive link.',
    'allow_null'   =>  '1'
  ])
    ->addChoice('post', 'Posts')
    ->addChoice('article', 'Article')
