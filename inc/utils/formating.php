<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly



/**
 * Join Fields
 * Coverts an array of style (class name) Fields
 * to a space seperated grouping.
 *
 * @example jumpoff_add_class($class, 'module')
 * @return string $group - space seperated sting of class names
 */
function jumpoff_add_classes($fields){
  $group = join(' ', $fields);

  return $group;
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



/**
 *  Make Hash ID
 *  Builds id friedly string by replacing whitespace with dashes
 *  and converting to lowercase
 *  @return: $classes (string)
 */
function jumpoff_make_hash($str) {
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
