<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * FeaturedImageShortcode
 * Shortcode for creating blockquotes
 *
 * @example   [bquote format="long" cite="Carlos Danger"]
 * @see        theme-glossary for details
 */
if (!class_exists('FeaturedImageShortcode')) {

  class FeaturedImageShortcode {

    // Constructor
    function __construct() {
      add_shortcode('featured-image',  array($this, 'shortcode_output'));
    }

    // Output
    function shortcode_output( $output = null )  {
      $output = '<figure class="featured-image"><img src="'. get_ft_img('full','', false) .'"></figure>';

      return $output;
    }
  }

  new FeaturedImageShortcode();

}


/**
 * BlockquoteShortcode
 * Shortcode for creating blockquotes
 *
 * @example   [bquote format="long" cite="Carlos Danger"]
 * @see theme-glossary for details
 */
if (!class_exists('BlockquoteShortcode')) {

  class BlockquoteShortcode {

    // Constructor
    public function __construct() {
      add_shortcode('quote',  array($this, 'shortcode_output'));
    }

    // Output
    public function shortcode_output( $atts, $content = null )  {

      extract(shortcode_atts(array(
      'class'        => '',
      'cite'       => '',
      ), $atts));

      // Vars

      if ($class) {
        $class = $atts['class'];
      }
      // Cite
      if($cite){
        $cite = '<cite>' . $atts['cite'] . '</cite>';
      }

      // Outputs
      $output = '<blockquote class="'. $class .'">' . $content . $cite . '</blockquote>';
      //$output = str_replace(array('<br />', '<br/>', '<br>', '<br>'), array('', '', '', ''), $output);
      $output = str_replace('<br>', '', $output);
      $output = wpautop($output);
      return $output;
    }
  }

  new BlockquoteShortcode();
}


/**
 * BlockquoteShortcode
 * Shortcode for creating blockquotes
 *
 * @example   [bquote format="long" cite="Carlos Danger"]
 * @see theme-glossary for details
 */
if (!class_exists('VideoEmbedShortcode')) {

  class VideoEmbedShortcode {

    // Constructor
    public function __construct() {
      add_shortcode('video-embed',  array($this, 'output'));
    }

    // Output
    public function output( $atts, $content = null )  {

      extract(shortcode_atts(array(
      'provider'    => '',
      'id'          => '',
      ), $atts));

      $output = '';
      $output = '<div id="js-plyr" class="vid plyr-embed js-plyr" data-plyr-provider="'.$atts['provider'].'" data-plyr-embed-id="'.$atts['id'].'"></div>';

      return $output;
    }
  }

  new VideoEmbedShortcode();
}
