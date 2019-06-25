<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Tracking
 * Mainly GTM ID to add GTM Container.
 * Added to head and after body open (no-js) via inc/utiles/hooksHead.php
 */
$tracking = new StoutLogic\AcfBuilder\FieldsBuilder('tracking');

$tracking
  ->addText('gtm_id',
    [ 'label' => 'Provide GTM Id <span>(ie: GTM-ABCDEFG)</span>' ]
  )
  ->addText('google_meta')
  ->addText('bing_meta')
  ->setLocation('options_page', '==', 'tracking');

add_action('acf/init', function() use ($tracking) {
   acf_add_local_field_group($tracking->build());
});
