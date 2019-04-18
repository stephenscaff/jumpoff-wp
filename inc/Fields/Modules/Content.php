<?php

if ( ! defined( 'ABSPATH' ) ) exit;


use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Content Module
 * Creates an content / wysi section
 * @see scss/components/_content (post-content)
 */
$content_module = new FieldsBuilder('content_module');
$content_module
  ->addMessage('', 'The Content Module creates an all purpose content/wysi region.')
  ->addWysiwyg('content');
