<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Posts Module
 * @see views/modules/posts-module.php
 * @see scss/components/_cards.scss
 */
$posts_module = new FieldsBuilder('posts_module');
$posts_module
  ->addMessage('', 'The Posts Module adds a section displaying the 3 posts by category, manual selection, or latest (if nothing is selected).')

  ->addFields($heading, [
    'label'         => 'Section Title',
  ])
  ->addTaxonomy('posts_cat', [
   'label'         => 'Show Posts by Category',
   'taxonomy'      => 'category',
   'return_format' => 'object',
   'field_type'    => 'select',
   'allow_null'    => 1,
   'wrapper'       =>  ['width' => '50%'],
  ])
  ->addRelationship('posts_selector',  [
   'label'         => 'Show Posts by Selection (overrides category )',
   'post_type'     => array('post'),
   'filters'       => array('search', '', ''),
   'max'           => 3,
   'wrapper'       =>  ['width' => '50%'],
  ])
  ->addText('archive_link');
