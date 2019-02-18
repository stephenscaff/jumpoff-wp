<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Global Variables
 */
add_action ( 'wp_head', function() {
  $json = array(
    'admin_ajax' => admin_url( 'admin-ajax.php' ),
    'site'       => get_bloginfo( 'template_directory' ),
    //'locations_api' => get_rest_url(null, 'wp/v2/office_locations'),
  );
  ?>
<script>
var appGlobals = <?php echo json_encode($json, JSON_PRETTY_PRINT); ?>;
</script>
<?php
});
