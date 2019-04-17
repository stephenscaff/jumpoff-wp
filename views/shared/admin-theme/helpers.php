<?php
/**
 * Is page template
 *
 * @param $template - page template to check against
 * @return boolean
 */
function is_template( $template ) {
   global $post;
   if ( ! $post ) return false;
   return $template === get_post_meta( $post->ID, '_wp_page_template', true );
}
