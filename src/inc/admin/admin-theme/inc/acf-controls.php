<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly


/**
 * Close ACF Flex boxes on load
 */

add_action('acf/input/admin_head', 'acf_controls');

function acf_controls() {
?>
<script type="text/javascript">
  (function(jQuery){

    jQuery(document).ready(function(){

      jQuery('.layout').addClass('-collapsed');
      //jQuery('.acf-postbox').addClass('closed');
    });
  })(jQuery);
</script>
<?php
}