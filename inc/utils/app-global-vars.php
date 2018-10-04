<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Global Variables for Javascript stuff.
 */
add_action ( 'wp_head', function() { ?>
  <script>
    var appGlobals = <?php echo json_encode(
      array(
        'foo' => '',
        'bar' => '',
      )
    ) ?>;
  </script><?php
});
