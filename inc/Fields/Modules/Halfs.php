<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Halfs Module
 * @see views/modules/halfs-module.php
 * @see scss/components/_halfs.scss
 */
$halfs_module = new FieldsBuilder('halfs_module');
$halfs_module
  ->addMessage('', 'The Halfs Module creates a 2 column 50/50 layout of image and content.')
  ->addSelect('direction',
    ['return_format'	=> 'value']
  )
    ->addChoice('is-source-order', 'Image | Content')
    ->addChoice('is-reversed-order', 'Content | Image')
  ->addImage('image')
  ->addText('title')
  ->addTextArea('content')
  ->addFields($button);
