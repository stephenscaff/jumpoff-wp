<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Require Composer Autoload for StoutLogic ACF Builder
 * @see https://github.com/StoutLogic/acf-builder
 * @see https://github.com/StoutLogic/acf-builder/wiki
 */
$autoload = get_template_directory().'/vendor/autoload.php';

# Autoload warning
if ( is_file($autoload) ) {
  require_once( $autoload );
} else {
  trigger_error("Whoops! Make sure to run `composer install` first, so vendor/autoload.php exists for our ACF Fields Builder. Included in: ", E_USER_WARNING);
  die();
}

# Includes
require_once('Vars.php');
require_once('Contacts.php');
require_once('Mast.php');
require_once('Seo.php');
require_once('User.php');
