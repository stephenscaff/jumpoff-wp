<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Cards Builder Module
 * @see partials/modules/cards-builder-module.php
 * @see scss/components/cards.scss
 */
$cards_module = new FieldsBuilder('cards_module');
$cards_module
  ->addMessage('', 'The Cards Module enables you to build a section containing UI cards in a 3 column grid ')
  ->addFields($heading, [
    'label'         => 'Section Title',
  ])
  ->addRepeater('cards', [
    'button_label' => 'Add Card',
    'layout'       => 'block',
  ])
    ->addImage('image')
    ->addText('pretitle')
    ->addText('title')
    ->addTextArea('content')
    ->addFields($button)
  ->endRepeater();
