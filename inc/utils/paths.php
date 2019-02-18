<?php

namespace jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 *  jumpoff_img()
 *  An image path helper that gets template path of images
 */
function get_img_path(){
  $template_path = bloginfo( 'template_directory' );

  return $template_path . '/assets/images';
}


/**
 *  jumpoff_path
 *  An asset path helper that gets template path.
 *  @example : <video src="<?php jumpoff_path(); ?>/videos/vide.mp4">
 */
function get_assets_path(){
  $template_path = bloginfo( 'template_directory' );

  return $template_path . '/assets';
}


/**
 *  jumpoff_svg
 *  An asset path helper that gets template path.
 *  @example : <video src="<?php jumpoff_path(); ?>/videos/vide.mp4">
 */
function get_svg_file( $file ){
  $svg = get_template_part( 'assets/images/svgs/' . $file, 'svg' );

  return $svg;
}
