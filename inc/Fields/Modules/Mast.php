<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Mast Module
 * @see views/modules/mast-module.php
 * @see scss/components/masts.scss
 */
$mast_module = new FieldsBuilder('mast_module');
$mast_module
  ->addMessage('', 'The Mast Module adds a masthead to the page ')
  ->addText('title')
  ->addTextArea('text')
  ->addImage('image', [
    'label' => 'Mast Image <br/><span>Size to 2000x1200</span>'
  ]);
