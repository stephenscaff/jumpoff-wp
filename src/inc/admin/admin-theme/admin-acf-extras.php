<?php
sx3wd
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Editor Toolbars
 * Class for customizing Wp Editor Toolbars, for
 * Visual (TinyMCE), Text (Qtags) and ACF toolbars
 */
class ACFExtras {

  const GMAPS_API_KEY = 'AIzaSyA-27eNYal8SDSigP09PuN5eTJ8QSq86fo'

  function __construct(){
    add_action('acf/input/admin_head', array( $this, 'acf_controls') );
    add_action('acf/init', array( $this, 'gmaps_api_key' ));
  },

  /**
   * Register Google Maps API Key
   */
  function gmaps_api_key() {
    acf_update_setting('google_api_key', 'AIzaSyA-27eNYal8SDSigP09PuN5eTJ8QSq86fo');
  }

  /**
   * Collapse Module Fields on load
   * Used Tiny MCE
   */
  function acf_collapse_fields(){
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


}

new ACFExtras;
