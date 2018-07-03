<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 * Remove Wp's Auto P
 */
function jumpoff_unautop($str) {
  $str = str_replace("\n", "", $str);
  $str = str_replace("<p>", "", $str);
  $str = str_replace(array("<br />", "<br>", "<br/>"), "\n", $s);
  $str = str_replace("</p>", "\n\n", $s);

  return $str;
}


/**
 *  jumpoff_format_dashes
 *  Builds id friedly string by replacing whitespace with dashes
 *  and converting to lowercase
 *  @return: $classes (string)
 */
function jumpoff_format_dashes($str) {
  # Lower case everything
  $str = strtolower($str);

  # Make alphanumeric (removes all other characters)
  $str = preg_replace("/[^a-z0-9_\s-]/", "", $str);

  # Clean up multiple dashes or whitespaces
  $str = preg_replace("/[\s-]+/", " ", $str);

  # Convert whitespaces and underscore to dash
  $str = preg_replace("/[\s_]/", "-", $str);

  return $str;
}


/**
 *  Line Wrapper
 *  Detects line breaks in string and wraps them 
 *  in a list or span.
 *
 *  @param    string $str The string / field
 *  @param    string $type Markup wrapping lines
 *  @return   string $output
 *  @example  jumpoff_line_wrap( $fieldname,  'span' )
 */
function jumpoff_line_wrap ( $str, $type='list' ){

  $lines = explode("\n", $str);

  $output = '';

  if ( !empty($lines) ) {
    foreach ( $lines as $line ) {
      if ($type == 'list'){
        $output .= '<li>'. trim( $line ) .'</li>';
      }
      elseif ($type == 'span'){
        $output .= '<span>'. trim( $line ) .' ' . '</span>';
      }
    }
  }
  return $output;
}
