<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Buttons
 */
$button = new FieldsBuilder('button');
$button
  ->addPageLink('button_link',
    [
      'allow_null' => 'true',
      'wrapper'    => ['width' => '33.333%'],
      'label'      => 'Button Page Link (internal)',
    ]
  )
  ->addText('button_url',
    [
      'wrapper'    => ['width' => '33.333%'],
      'label'      => 'Button URL (external)'
    ]
  )
  ->addText('button_text',
    [
      'wrapper'    => ['width' => '33.333%'],
    ]
  );


/**
 * Headings
 */
$heading = new FieldsBuilder('heading');
$heading
  ->addText('heading_title',
    ['label' => 'Section Title']
  );


/**
 * SVG Selector
 */
$svg_selector = new FieldsBuilder('svg_selector');
$svg_selector
  ->addSelect('svgs',
    ['return_format'	=> 'value']
  )
    ->addChoice('brand-logo', 'Brand Logo')
    ->addChoice('brand-monogram', 'Brand Monogram')
    ->addChoice('some-icon', 'Some Icon');
