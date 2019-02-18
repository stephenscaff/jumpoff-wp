<?php
/**
 *  Partial: Modules
 *
 *  Partial for loading modules via file name using a class extending
 *  ACF's flexible content field.
 *
 *  @author    Stephen Scaff
 *  @package   partials
 *  @version   1.0
 *  @see       inc/acf-utils/acf-modules.php - Modules class
 *  @see       inc/fields/* - Defined fields and modules
 */

if ( ! defined( 'ABSPATH' ) ) exit; 


while (has_sub_field('modules')) :
  ACF_Modules::render(get_row_layout());
endwhile;
