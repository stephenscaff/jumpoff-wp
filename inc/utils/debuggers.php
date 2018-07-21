<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Formated Dumper (tee hee)
 * @return {string} a parsable string representation of a variable
 */
function jumpoff_dump( $var, $name = '' ) {
	echo '<pre>';
	if ( '' !== $name ) {
		echo $name . ': ';
	}
	var_export( $var );
	echo '</pre>';
}


/**
 * Js Console Debugger
 */
function jumpoff_dump_js( $data ) {
	$output  = '<script>';
	$output .= 'console.info( "Debug in Console:" );';
	$output .= 'console.log(' . json_encode( $data ) . ');';
	$output .= '</script>';
	echo $output;
}

/**
 * Formats a JSON string for pretty printing
 *
 * @param string $json The JSON to make pretty
 * @param bool $html Insert nonbreaking spaces and <br />s for tabs and linebreaks
 * @return string The prettified output
 */
function jumpoff_format_json($json, $html = false) {
  $tabcount = 0;
  $result = '';
  $inquote = false;
  $ignorenext = false;

	if ($html) {
    $tab = "&nbsp;&nbsp;&nbsp;";
    $newline = "<br/>";
	} else {
    $tab = "\t";
    $newline = "\n";
	}

  for($i = 0; $i < strlen($json); $i++) {
    $char = $json[$i];

    if ($ignorenext) {
      $result .= $char;
      $ignorenext = false;
    } else {
      switch($char) {
        case '{':
          $tabcount++;
          $result .= $char . $newline . str_repeat($tab, $tabcount);
          break;
        case '}':
          $tabcount--;
          $result = trim($result) . $newline . str_repeat($tab, $tabcount) . $char;
          break;
        case ',':
          $result .= $char . $newline . str_repeat($tab, $tabcount);
          break;
        case '"':
          $inquote = !$inquote;
          $result .= $char;
          break;
        case '\\':
          if ($inquote) $ignorenext = true;
          $result .= $char;
          break;
        default:
          $result .= $char;
      }
	  }
	}

	return '<pre>' . $result . '</pre>';
}
