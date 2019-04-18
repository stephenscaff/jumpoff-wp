<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Get Image Directory
 *  An image path helper that gets template path of images
 *  @return string theme image directory
 */
function get_img_dir(){
  $template_path = bloginfo( 'template_directory' );
  $img_path = $template_path . '/assets/images';
  return $img_path;
}


/**
 *  Get Assets Path
 *  An asset path helper that gets template path.
 *  @return string assets directory
 */
function get_assets_path(){
  $template_path = bloginfo( 'template_directory' );
  $path = $template_path . '/assets';
  return $path;
}


/**
 *  Get SVG
 *  An asset path helper that gets template path.
 * @param string $file - Svg file name
 */
function get_svg( $file ){
  $svg = get_template_part( 'assets/images/svgs/' . $file, 'svg' );
  return $svg;
}
