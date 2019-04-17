<?php
/**
 * Views/Content/None
 *
 * @author    Stephen Scaff
 * @package   jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

if (is_search()) {
  $title = "No Results";
  $text  = "Your search returned no results.";
} else {
  $title = "We're Sorry";
  $text  = "No content was found.";
}
?>

<section class="nunzo">
  <div class="grid">
    <div class="nunzo__content">
      <i class="nunzo__icon icon-eye-off"></i>
      <h4 class="nunzo__title"><?php echo $title; ?></h4>
      <p class="nunzo__text"><?php echo $text; ?></p>
   </div>
  </div>
</section>
