<?php
/**
 *  Partial: partials/partial-mast
 *
 *  Template for displaying a mast sections with ACFs
 *
 *  @author    Stephen Scaff
 *  @package   partials
 *  @version   1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Modules
while (has_sub_field('modules')) :
  ACF_Modules::render(get_row_layout()); 
endwhile; 

?>