<?php

namespace Jumpoff;



if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Featured Image Helper
 *
 * @example: jumpoff_ft_img('full')
 *
 * @param array/string $size  images size - ie; full, medium, small)
 * @param string $id optional image id
 * @return string Image Url
 */

function get_ft_img($size, $post_id = '', $fallback = false) {
  global $post, $posts;

  // Allow for specific Image Ids
  if ($post_id) {
    $post = get_post($post_id);
    setup_postdata( $post_id );
  }

  // Read featured image data for image url.
  $image_id = get_post_thumbnail_id();

  // Get Image src of image attached to post.
  $attached_to_post = wp_get_attachment_image_src( get_post_thumbnail_id(), $size, false);

  // Set our attached image as the returned related image.
  $img =  $attached_to_post[0];

  // Get Alert
  $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

  // get $caption
  $caption = wp_get_attachment_caption( $image_id );

  if ( !empty( $img ) && $fallback == true ) {
    $img = get_random_img();
  }

  if ($post_id) {
    wp_reset_postdata( $post_id );
  }

  $img_obj = array(
    'url' => $img,
    'alt' => $alt,
    'caption' => $caption
  );
  return (object)$img_obj;
}

/**
 *  Random Image
 *  Generate a random image from predefined placeholders.
 *  Works with jumpoff_ft_img if $fallback == true.
 *
 *  @example: jumpoff_random_img()
 *  @param return image
 */
function get_random_img() {
  // Get dir
  $template_dir = get_bloginfo('template_directory');

  // Array of fallback images to deliver randomly
  // @since v1.2
  $random_no_images =
    array('placeholder-1.jpg',
          'placeholder-2.jpg',
          'placeholder-3.jpg',
          'placeholder-4.jpg',
          'placeholder-5.jpg',
          'placeholder-6.jpg');

  // Randomize array of fallbacks
  $randomNumber = array_rand($random_no_images);
  $randomImage = $random_no_images[$randomNumber];

  // Set placeholder path for out random fallbacks
  $related_img = $template_dir."/assets/images/placeholders/$randomImage";

  return $related_img;
}
