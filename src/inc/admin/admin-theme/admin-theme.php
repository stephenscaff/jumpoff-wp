<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

require_once('admin-bar.php');
require_once('admin-body-class.php');
require_once('admin-editors.php');
require_once('admin-ft-image-col.php');
require_once('admin-user-fields.php');
require_once('admin-styles-scripts.php');


/**
 * Admin Footer Message
 */
add_filter( 'admin_footer_text', 'admin_footer');

function admin_footer(){
  _e( '<span id="footer-thankyou">Developed by <a href="http://stephenscaff.com" target="_blank">S Money Scaff</a></span>' );
}
