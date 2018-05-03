<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Flush Rewrites
 */
add_action( 'after_switch_theme', 'jumpoff_flush_rewrite_rules' );

function jumpoff_flush_rewrite_rules() {
  flush_rewrite_rules();
}

# Global Tax for featured posts and so on
require_once('tax-post-functions.php');

# Example Content Type - Team
# require_once('post-type-team.php');
