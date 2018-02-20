<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Require Composer Autoload for StoutLogic ACF Builder
 * @see https://github.com/StoutLogic/acf-builder
 * @see https://github.com/StoutLogic/acf-builder/wiki
 */
$autoload = get_template_directory().'/vendor/autoload.php';

if (is_file($autoload)) {
  require_once( $autoload);
} else {
  trigger_error("Whoops! Make sure to run `composer install` first, so vendor/autoload.php exists for our ACF Fields Builder. Included in: ", E_USER_WARNING);
  die();
}

require_once('options-contacts.php');
require_once('options-cpt-indexes.php');
require_once('fields-seo.php');
require_once('fields-subtitle.php');
require_once('fields-mast.php');
require_once('fields-user.php');
