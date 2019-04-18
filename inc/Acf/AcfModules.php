<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
* ACF Module Loader Class
*
* Autoloads ACF Flexible Content Fields as modules by matching the module name with the file name
* from within the modules directory.
*
* @author       Stephen Scaff
* @see          views/modules
* @see          advancedcustomfields.com/add-ons/flexible-content-field
* @version      1.0
* @example      ACF_module::render(get_row_module());
*/


class ACF_Modules {
  /**
   * Path of where the module templates are found,
   * (relative to the theme template directory).
   */
  const MODULE_DIRECTORY = '/views/modules/';

  /**
   * Get module
   *
   * @param  {string} $file
   * @param  {array}  $data
   * @return {string}
   */
  static function get_module($module, $data = null){

    $module_dir = get_template_directory() . self::MODULE_DIRECTORY;
    $module_file = '{{module}}.php';
    $find = array('{{module}}', '_');
    $replace = array($module, '-');

    // Locate file matching format
    $located_module_file = str_replace($find[0], $replace[0], $module_file);

    if (file_exists($module_dir . $located_module_file)){
      include($module_dir . $located_module_file);
      return true;

    } else {

      // Find matching module file
      $located_module_file = str_replace($find, $replace, $module_file);

      if (file_exists($module_dir . $located_module_file)) {
        include($module_dir . $located_module_file);
        return true;
      }
    }

    // If no files can be matched,
    // and WP DEBUG is true: throw a warning.
    if (WP_DEBUG) {
      echo "<pre>ACF_Modules: No module template found for $module.</pre>";
    }

    return false;
  }

  /**
   * Render
   * Main rendering method
   *
   * @param  {string} $module
   * @return {string}
   */
  static function render($module, $data = null) {
    return self::get_module($module, $data);
  }
}
