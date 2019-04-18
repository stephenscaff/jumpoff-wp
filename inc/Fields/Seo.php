<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Fields - SEO
 * Location: all pages, posts and post types. Edit as needed.
 */
 // Meta robots index/noindex (to allow pages to be included or removed from search results)
 // Meta robots follow/nofollow (to direct search engines to the right pages)
 // Meta robots noodp and noydi

$seo = new StoutLogic\AcfBuilder\FieldsBuilder('seo', [
  'key' => 'seo',
  'position' => 'normal',
  'menu_order' => '13',
]);

$seo
  ->addText('seo_title')
  ->addTextArea('seo_description',  [
    'rows' =>  '2'
  ])
  ->addImage('seo_image', [
    'label'         => 'Social Media Image <br/><span>Recommeded Size: 1200x630px</span>',
  ])
  ->addText('seo_canonical_url')
  ->addMessage('Robots', 'Modify Robots meta. Note, if unsure leave these settings alone')
  ->addTrueFalse('seo_robots_index', [
    'label'         => 'Robots: Index',
    'message'       => 'Index -OR- NoIndex',
    'instructions'  => 'Apply NoIndex tells search engines not to index a page',
    'default_value' => 0,
    'ui'            => 1,
    'ui_on_text'    => 'NoIndex',
    'ui_off_text'   => 'Index',
    'wrapper'    =>  ['width' => '50%']
  ])

  ->addTrueFalse('seo_robots_follow', [
    'label'         => 'Robots: Follow',
    'message'       => 'Follow -OR- NoFollow',
    'instructions'  => 'Adding NoFollow tells crawlers not to follow any links on this page or pass along any link equity.',
    'default_value' => 0,
    'ui'            => 1,
    'ui_on_text'    => 'NoFollow',
    'ui_off_text'   => 'Follow',
    'wrapper'    =>  ['width' => '50%']
  ])

  ->addTrueFalse('seo_robots_noarchive', [
    'label'         => 'Robots: NoArchive',
    'message'       => 'Add Robots: NoArchive',
    'instructions'  => 'Adding NoArchive prevents search engines from showing a cached link to this page on a SERP',
    'default_value' => 0,
    'ui'            => 1,
    'ui_on_text'    => 'Yes',
    'ui_off_text'   => 'No',
    'wrapper'    =>  ['width' => '50%']
  ])

  ->addTrueFalse('seo_robots_nosnippet', [
    'label'         => 'Robots: NoSnippet',
    'message'       => 'Add Robots: NoSnippet',
    'instructions'  => 'Adding NoSnippet prevents search engines from showing snippet of this page (i.e. meta description) on a SERP.',
    'default_value' => 0,
    'ui'            => 1,
    'ui_on_text'    => 'Yes',
    'ui_off_text'   => 'No',
    'wrapper'    =>  ['width' => '50%']
  ])

  ->addTrueFalse('seo_robots_noodp', [
    'label'         => 'Robots: noodp',
    'message'       => 'Add Robots noodp, noydi',
    'instructions'  => 'Apply Noopd',
    'default_value' => 0,
    'ui'            => 1,
    'ui_on_text'    => 'Yes',
    'ui_off_text'   => 'No',
    'wrapper'    =>  ['width' => '100%']
  ])

  ->setLocation('post_type',    '==', 'page')
           ->or('post_type',    '==', 'post')
           ->or('post_type',    '==', 'menu');

add_action('acf/init', function() use ($seo) {
   acf_add_local_field_group($seo->build());
});
