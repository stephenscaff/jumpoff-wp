<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  JumpoffImageSettings
 *
 *  Class to handle various image settings and handling.
 *
 *  Image Sizes (All ratios of 2000x1200, and hard set)
 *  Full : 2000 x 1200 (ideally)
 *  Medium: 1250 x 750
 *  Large: 1500 x 900
 */
if (!class_exists('WpImageSettings ')) {

 class WpImageSettings {


   /**
    * Medium Size
    */
   const THUMB_WIDTH = "";
   const THUMB_HEIGHT = "";

   /**
    * Medium Size
    */
   const MED_WIDTH = "";
   const MED_HEIGHT = "";

   /**
    * Large Size
    */
   const LG_WIDTH = "";
   const LG_HEIGHT = "";



  // Constructor
  function __construct() {
    $this->THUMB_WIDTH = 500;
    $this->THUMB_HEIGHT = 500;
    $this->MED_WIDTH = 1250;
    $this->MED_HEIGHT = 750;
    $this->LG_WIDTH = 1500;
    $this->LG_HEIGHT = 900;

    add_filter('intermediate_image_sizes_advanced',  array($this, 'remove_image_sizes'));
    add_filter('pre_update_option_',  array($this, 'medium_images'));
    add_filter('load-options.php',  array($this, 'large_images'));
    add_filter('load-options.php',  array($this, 'add_image_sizes'));
    add_filter('image_size_names_choose',  array($this, 'add_images_to_admin'));
    add_filter('post_thumbnail_html',  array($this, 'remove_wxh_attribute' ));

    // Comment out the following method calls for src set images
    $this->image_output();
    //add_filter('image_send_to_editor',  array($this, 'remove_wxh_attribute', 10 ));
    add_action('after_setup_theme',  array($this, 'image_output_settings'));
  }

/**
 *  Remove Sizes we won't need, so we're not creating pointless images
 *
 *  @return $sizes
 */
  function remove_image_sizes( $sizes) {
    //unset( $sizes['thumbnail'] );
    return $sizes;
  }

  /**
   *  Set Med sizes
   *
   *  1250x750
   */
    function thumb_images(){
      update_option( 'thumb_size_w', $this->THUMB_WIDTH );
      update_option( 'thumb_size_h', $this->THUMB_HEIGHT );

      // Add cropping capability
      if (false === get_option('thumb_crop')) {
        add_option('thumb_crop', '1');
      } else {
        update_option('thumb_crop', '1');
      }
    }

/**
 *  Set Med sizes
 *
 *  1250x750
 */
  function medium_images(){
    update_option( 'medium_size_w', $this->MED_WIDTH );
    update_option( 'medium_size_h', $this->MED_HEIGHT );

    // Add cropping capability
    if(false === get_option('medium_crop')) {
      add_option('medium_crop', '1');
    } else {
      update_option('medium_crop', '1');
    }
  }

/**
 *  Set Large sizes
 *
 *  1500x900
 */
  function large_images(){
    update_option( 'large_size_w', $this->LG_WIDTH );
    update_option( 'large_size_h', $this->LG_HEIGHT );

    if(false === get_option("large_crop")) {
         add_option('large_crop', '1');
    } else {
      update_option('large_crop', '1');
    }
  }

/**
 *  Create Custom image size.
 *
 *  Used for Mastheads and full width images.
 *  Duplicate add_image_size for additional custom sizes.
 *
 *  Name: "Mast"
 *  Size: 2000x1200
 */
  function add_image_sizes(){
    // New Image: 'Mast'
    add_image_size( 'professional', $this->PROFESSIONAL_WIDTH, $this->PROFESSIONAL_HEIGHT, true );
  }

/**
 *  Add our custom image, "Mast" to the admin / media gal.
 *  Continue array with additional custom sizes.
 *
 *  @return $sizes
 */
  function add_images_to_admin( $sizes ) {

    return array_merge( $sizes, array(
      'professional' => __('Professional'),
    ));
  }

/**
 *  Remove wxh attributes
 *  Prevent Wp from injecting height and width for images in the_content
 *
 *  @return $html
 */
  function remove_wxh_attribute( $html ) {
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
    return $html;
  }

/**
 *  Image Output Settings
 *  Additional cleanups for images added to the_content
 *
 *  @return $html
 */
  function image_output_settings() {

   // no alignment
   update_option('image_default_align', 'none' );
   // don't auto link
   update_option('image_default_link_type', 'none' );
   //insert at full width
   update_option('image_default_size', 'full' );
  }

  /**
   * Image output
   * Wraps post images in a figure/figcaption
   */
  function image_output() {

    add_filter( 'image_send_to_editor', 'image_wrapper', 10, 9 );

    function image_wrapper($html, $id, $caption, $title, $align, $url, $size, $alt) {
      $src  = wp_get_attachment_image_src( $id, $size, false );
      $output = "<figure id='media-" .$id . "' class='align-" . $align . "'>";
      $output .= "<img src='" . $src[0] . "' alt='" . $alt . "' />";
      if ($caption) {
        $output .= "<figcaption>" . $caption ."</figcaption>";
      }
      $output .= "</figure>";
      return $output;
    }
    }
  }
}

new WpImageSettings ();
