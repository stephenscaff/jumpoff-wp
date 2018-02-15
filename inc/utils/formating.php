<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 *  jumpoff_format_dashes
 *  Builds id friedly string by replacing whitespace with dashes
 *  and converting to lowercase
 *  @return: $classes (string)
 */
function jumpoff_format_dashes($str) {
  //Lower case everything
  $str = strtolower($str);
  //Make alphanumeric (removes all other characters)
  $str = preg_replace("/[^a-z0-9_\s-]/", "", $str);
  //Clean up multiple dashes or whitespaces
  $str = preg_replace("/[\s-]+/", " ", $str);
  //Convert whitespaces and underscore to dash
  $str = preg_replace("/[\s_]/", "-", $str);

  return $str;
}

/**
 *  jumpoff_line_wrap ()
 *  Gets line breaks from a field and wraps
 *  them in span or list.
 *
 *  @param   string $type Markup wrapping lines
 *  @return  $output
 *  @example
 *           jumpoff_line_wrap($fieldname, 'span')
 */
function jumpoff_line_wrap ( $textarea, $type="list" ){
  $lines = explode("\n", $textarea);
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
