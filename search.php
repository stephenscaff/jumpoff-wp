<?php
/**
 * Calls Search Tempalte in Post as general fallback
 *
 * @author    Stephen Scaff
 * @package   jumpoff
 */

if ( ! defined( 'ABSPATH' ) ) exit;

include(locate_template( 'views/post/search.php' ) );
