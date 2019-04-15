<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *   Nav Active Class.
 *   Adds active class, since we're not using native wp menus
 *
 *   @param    string $page_name
 *   @return   string 'is-active';
 */
function get_active_class( $page_name ){
  if (is_page( $page_name ) || is_post_type_archive( $page_name )) {
    return 'is-active';
  }
}


/**
 *   Gets page link.
 *   For use with our custom navigations
 *
 *   @param    string $page_name
 *   @return   string 'is-active';
 */
function get_page_url( $page_name, $cpt='' ){
  if ( $cpt == true ) {
    $page_url = esc_url( get_post_type_archive_link( $page_name ) );
  } else {
    $page_url = esc_url( get_permalink( get_page_by_title( $page_name ) ) );
  }
  return $page_url;
}


/**
 * Get Subpage Links
 * Outputs a post types subpages as nav items
 * @var $post_type sring - The desired post type
 * @var $klass string - class name for link
 * @return string
 */
function get_subpage_links( $post_type, $klass ){
  global $post ;

  $args = array(
   'posts_per_page'   => -1,
   'post_type'        => $post_type,
  );
  $links  = get_posts( $args );
  $output = '';

  foreach ( $links as $post ) : setup_postdata( $post );
    $url     = get_the_permalink();
    $title   = get_the_title();
    $output .= '<a class="'. $klass . '" href="' . $url . '">' . $title . '</a>';
  endforeach;
  wp_reset_postdata();

  return $output;
}


/**
 * Render Menu
 * Renders Simple Menus with options for class name and menu title.
 *
 * @var string $menu_name
 * @var string $menu_class - Nav element class name
 * @var string $menu_title - optional menu title
 * @return $output html blob
 */
 function render_menu($menu_name, $menu_class = null, $extra = null) {
   global $post;
   $locations = get_nav_menu_locations();
   $menu_id = $locations[$menu_name];
   $menu_items = wp_get_nav_menu_items($menu_id);
   $output = '';
   $output .= '
    <nav class="'.$menu_class.'__nav">';
    if ($menu_items) :
      foreach($menu_items as $menu_item  => $item) :
          $output .= '
           <a class="'.$menu_class.'__link" href="'.$item->url.'" role="menuitem">'.$item->title.'</a>';
      endforeach;
    endif;
    if ($extra) :
      $output .= $extra;
    endif;
    $output .= '
    </nav>';

  return $output;
}
