<?php
/**
 * Pagination
 *
 * Calls pagination funciton
 *
 *
 * @author    Stephen Scaff
 * @package   partials
 * @version   1.0
 * @see       inc/functions/pagination.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( function_exists('jumpoff_pagination') ) :
  jumpoff_pagination();
endif;
