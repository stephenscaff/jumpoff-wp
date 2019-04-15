<?php
/**
 * Views/Shared/None
 *
 * @author    Stephen Scaff
 * @package   Jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<section class="nunzo">
  <div class="grid">
    <div class="nunzo__content">
      <?php if (is_search()) : ?>
        <h4>Sorry.</h4>
        <p>Your search returned no results</p>
      <?php else : ?>
      <h4>Sorry.</h4>
      <p>No content found.</p>
     <?php endif; ?>
   </div>
  </div>
</section>
