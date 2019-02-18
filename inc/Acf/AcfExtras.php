<?php

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * ACF Extras
 * Additional ACF Settings and helpers
 */
class ACFExtras {

  //const GMAPS_API_KEY = 'xxxxx'

  /**
   * @var ACFExtras
   */
  public static $instance;

  /**
   * @return ACFExtras
   */
  public static function init() {
    if ( is_null( self::$instance ) )
      self::$instance = new ACFExtras();
    return self::$instance;
  }

  private function __construct(){
    add_action('acf/input/admin_head', array( $this, 'collapse_fields') );
    add_action('admin_head', array( $this, 'wysi_height') );
    add_action('acf/init', array( $this, 'gmaps_api_key' ));
  }

  /**
   * Register Google Maps API Key
   */
  function gmaps_api_key() {
    acf_update_setting('google_api_key', '[addkeyhere]');
  }


  /**
   * Collapse Module Fields on load
   * Used Tiny MCE
   */
  function collapse_fields(){
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

  /**
   * Set WYSI editor height
   */
  function wysi_height() { ?>
  	<style>
  		iframe[id^='acf-editor-'] {
  			min-height:15px;
        max-height: 19em;
  		}
  	</style> <?php
  }
}

ACFExtras::init();
