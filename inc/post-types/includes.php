<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Flush Rewrites
 */
add_action( 'after_switch_theme', 'jumpoff_flush_rewrite_rules' );

function jumpoff_flush_rewrite_rules() {
  flush_rewrite_rules();
}

# require_once('Team.php');
# require_once('Testimonials.php');
