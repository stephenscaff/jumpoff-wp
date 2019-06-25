<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Full Module
 * @see views/modules/fulls-module.php
 * @see scss/components/_fulls.scss
 */
$banners_module = new FieldsBuilder('banners_module');
$banners_module
  ->addMessage('', 'The Banners Module creates a full width element with content over an image')
  ->addImage('image')
  ->addText('title')
  ->addTextArea('content')
  ->addFields($button);
