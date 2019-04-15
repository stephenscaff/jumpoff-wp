<?php
/**
 *  Views/Shared/Modules
 *
 *  @author    Stephen Scaff
 *  @package   Jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

while (has_sub_field('modules')) :
  ACF_Modules::render(get_row_layout());
endwhile;
