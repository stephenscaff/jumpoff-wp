<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Buttons
 */
$button_field = new FieldsBuilder('button');
$button_field
 # Button Page link
 ->addPageLink('button_link', [
   'allow_null'  => 'true',
   'wrapper' =>  ['width' => '33.333%'],
   'label'  =>   'Button Page Link (internal)',
 ])
 # Button URL
 ->addText('button_url', [
   'wrapper' =>  ['width' => '33.333%'],
   'label'  =>   'Button URL (external)'
 ])
 # Button Text
 ->addText('button_text', [
   'wrapper' =>  ['width' => '33.333%'],
 ]);


 /**
  * Headings
  */
 $heading_field = new FieldsBuilder('heading');
 $heading_field
  # Heading Title
  ->addText('heading_title', [
    'label' =>  'Section Title'
  ]);
