<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Modules Library
 */
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Cards Builder Module
 * @see partials/modules/cards-builder-module.php
 * @see scss/components/cards.scss
 */
$cards_module = new FieldsBuilder('cards_module');
$cards_module
  ->addMessage('', 'The Cards Module enables you to build a section containing UI cards in a 3 column grid ')
  ->addRepeater('cards', [
    'max' => 4,
    'button_label' => 'Add Card',
    'layout' => 'block',
  ])
    ->addImage('image')
    ->addText('pretitle')
    ->addText('title')
    ->addTextArea('content')
  ->endRepeater();


/**
 * Content Module
 * Creates an content / wysi section
 * @see scss/components/_content (post-content)
 */
$content_module = new FieldsBuilder('content_module');
$content_module
  ->addMessage('', 'The Content Module creates an all purpose content/wysi region.')
  ->addWysiwyg('content');

/**
 * Posts Module
 *
 * @see partials/modules/team-module
 */
$posts_module = new FieldsBuilder('posts_module');
$posts_module
 ->addMessage('', 'The Posts Module adds a section displaying the 3 latest Posts, unless you manually select 3 posts with the Posts Selector.')
 ->addRelationship('posts_selector',  [
    'post_type' =>  array('post'),
    'filters' => array('search', '', ''),
    'max'  => 3,
  ]);


/**
 * Video Module
 *
 * @see partials/modules/video-module
 */
$video_module = new FieldsBuilder('video_module');
$video_module
  ->addMessage('', 'The Video modules creates a single video instance. Upload an Mp3 OR provide a Vimeo ID OR Youtube ID')
  ->addFile('video_mp4', [
   'wrapper' =>  ['width' => '33.333%'],
   'label'   =>  'Mp4'
  ])
  ->addText('video_vimeo_id', [
   'wrapper' =>  ['width' => '33.333%'],
   'label'   =>  'Vimeo ID'
  ])
  ->addText('video_youtube_id', [
   'wrapper' =>  ['width' => '33.333%'],
   'label'   =>  'YouTube ID'
  ]);
