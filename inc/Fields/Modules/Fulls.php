<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Full Module
 * @see views/modules/fulls-module.php
 * @see scss/components/_fulls.scss
 */
$fulls_module = new FieldsBuilder('fulls_module');
$fulls_module
  ->addMessage('', 'The Fulls Module creates a full width element with content over an image')
  ->addImage('image')
  ->addText('title')
  ->addTextArea('content')
  ->addFields($button);
