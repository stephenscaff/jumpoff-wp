<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Remove Wp's Auto P
 */
function set_unautop($str) {
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
function make_hash($str) {

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
 *  @example  jumpoff_format_lines( $fieldname,  'span' )
 */
function format_lines ( $str, $type='list' ){

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

/**
 *  Covert to Words
 *  Converts _ to space and capitalizes words.
 *
 *  @param    string $str The string / field
 *  @return   string $output
 */
function convert_to_words($str, $replacer = "_") {
  return ucwords(str_replace($replacer, " ", $str));
}

/**
 *  Format Tel Link
 *  Covert human readable / cms entered
 *
 *  @param    string $str The string / field of the number
 *  @return   string $output
 */
function format_tel_link($str) {
  return str_replace('[^0-9]', '', $str);
}


/**
 * Pluralizes a word if quantity is not one.
 *
 * @param array $count_arry  Array to count
 * @param string $singular   Singular form of word
 * @param string $plural     Plural form of word; function will attempt to deduce plural form from singular if not provided
 * @return string pluralized of singular word.
 */
function pluralize($count_arry, $singular, $plural = null) {

  $quantity = sizeof($count_arry);

  if ( $quantity == 1 || !strlen($singular) ) return $singular;
  if ( $plural !== null ) return $plural;

  $last_letter = strtolower($singular[strlen($singular)-1]);

  switch($last_letter) {
    case 'y':
      return substr($singular,0,-1).'ies';
    case 's':
      return $singular.'es';
    default:
      return $singular.'s';
  }
}
