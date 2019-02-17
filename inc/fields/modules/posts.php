<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;


/**
 * News Module
 * @see partials/modules/team-module
 */
$posts_module = new FieldsBuilder('posts_module');
$posts_module
  ->addMessage('', 'The Posts Module will display 3 latest news posts, unless you select to show by category or manually select specific posts.')
  ->addFields($heading_field, [
   'label' => 'Section Title',
  ])
  ->addTaxonomy('posts_cat', [
   'label'      => 'Show Posts by selected Category (overrides latest)',
   'taxonomy'   => 'category',
   'return_format' => 'object',
   'field_type'     => 'select',
   'allow_null'     => 1,
   'wrapper'    =>  ['width' => '50%'],
  ])
  ->addRelationship('posts_selector',  [
   'label'      => 'Or, Show Posts by Selection (overrides category and latest )',
   'post_type'  =>  array('post'),
   'filters' => array('search', '', ''),
   'max'        => 3,
   'wrapper'    =>  ['width' => '50%'],
  ]);
