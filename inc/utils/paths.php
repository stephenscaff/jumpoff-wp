<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 *  Theme Directory Image Helper
 *  An image path helper that gets template path of images
 *  @return string full image path
 */
function jumpoff_img(){
  $template_path = bloginfo('template_directory');
  $img_path = $template_path . '/assets/images';
  return $img_path;
}


/**
 *  Theme directory asset path
 *  An asset path helper that gets template path.
 *  @return string asset path
 *  @example : <video src="<?php jumpoff_path(); ?>/videos/vide.mp4">
 */
function jumpoff_asset(){
  $template_path = bloginfo('template_directory');
  $path = $template_path . '/assets';
  return $path;
}


/**
 *  Get SVG from template part
 *  SVG helper that gets svg contents from php partial.
 *  A gulp task handles the svg to .php conversion
 */
function jumpoff_svg($file){
  $svg = get_template_part( 'assets/images/svgs/' . $file, 'svg' );
  return $svg;
}
