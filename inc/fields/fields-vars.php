<?php
/**
 * Global Fields
 * Fields registered here can be reused by variable.
 * Hopefully, this keeps things a bit tidier.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use StoutLogic\AcfBuilder\FieldsBuilder;


/**
 * Buttons
 */
$button_field = new FieldsBuilder('button');
$button_field
  # Button URL
  ->addPageLink('button_url', [
    'allow_null'  => 'true',
    'wrapper' =>  ['width' => '33.333%']
  ])
  # Button External URL
  ->addUrl('button_url_ext', [
    'wrapper' =>  ['width' => '33.333%']
  ])
  # Button Text
  ->addText('button_text', [
    'wrapper' =>  ['width' => '33.333%']
  ]);


/**
 * Title
 */
$title_field = new FieldsBuilder('title');
$title_field
  ->addText('title');


/**
 * Pre Titles
 */
$pretitle_field = new FieldsBuilder('pretitle');
$pretitle_field
  ->addText('pretitle');


/**
 * Content
 */
$content_field = new FieldsBuilder('content');
$content_field
  ->addTextArea('content',  [
    'rows' =>  '4'
  ]);

  
/**
 * Headings
 */
$heading_field = new FieldsBuilder('heading');
$heading_field
  # Pretitle
  ->addText('pretitle', [
    'label' => 'Section Heading Pretitle'
  ])
  # Title
  ->addText('title', [
    'label' => 'Section Heading Title'
  ])
  # Content
  ->addText('content', [
    'label' => 'Section Heading Text'
  ]);
