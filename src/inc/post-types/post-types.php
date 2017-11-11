<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Flush Rewrites
 */
add_action( 'after_switch_theme', 'jumpoff_flush_rewrite_rules' );

function jumpoff_flush_rewrite_rules() {
  flush_rewrite_rules();
}

// Includes
require_once('post-taxonomy.php');
require_once('post-type-film.php');
require_once('post-type-photo.php');
