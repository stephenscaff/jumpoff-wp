<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Modules Library
 *
 * A lib of modules saved to vars for adding to other locations/field groups
 *
 */
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Featured Content Module
 *
 * @see partials/modules/featured-content-module.php
 * @see scss/components/ft-cards.scss
 */
$featured_content_module = new FieldsBuilder('featured_content_module');
$featured_content_module
  ->addMessage('', 'The Featured Content Module allows you to select various content types to display as cards. You can search for a title or filter with the selects.')
  ->addRelationship('post_selector',  [
   'post_type' =>  array('community', 'resource'),
   'min' => 0,
   'max' => 1,
   //'filters' => array('search', 'testimonai', 'audience'),
 ]);

 /**
  * Content Module
  * Creates an content / wysi section
  * @see scss/components/_content (post-content)
  */
 $content_module = new FieldsBuilder('content_module');
 $content_module
   ->addMessage('', 'The Content Module creates an all purpose content/wysi region.')
    ->addWysiwyg('content');
