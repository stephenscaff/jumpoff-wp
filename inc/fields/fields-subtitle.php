<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *   Subtitle Field
 *   Appears where - Currently for posts, add on for post types.
 */
$subtitle_field = new StoutLogic\AcfBuilder\FieldsBuilder('subtitle', [
    'key' => 'group_subtitle',
    'position' => 'acf_after_title',
    'menu_order' => '1',
]);;

$subtitle_field
    ->addText('subtitle')
    ->setLocation('post_type', '==', 'post');

add_action('acf/init', function() use ($subtitle_field) {
   acf_add_local_field_group($subtitle_field->build());
});
