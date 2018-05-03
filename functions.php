<?php
/**
 * Includes from inc
 * Represents The Jumpoff's functionality
 */

if ( ! defined( 'ABSPATH' ) ) exit;

# General Site and WP Settings
require_once('inc/settings/settings.php');

# Admin specfic stuff
require_once('inc/admin/admin.php');

# ACF Utils - Modules, search, etc.
require_once('inc/acf-utils/acf-utils.php');

# General site utilities
require_once('inc/utils/utils.php');

# Post Templates/Helpers
require_once('inc/post-helpers/post-helpers.php');

# Post Types
require_once('inc/post-types/post-types.php');

# Fields (ACF via Stout Logic's Builder)
require_once('inc/fields/fields.php');
