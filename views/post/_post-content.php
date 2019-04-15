<?php
/**
 * Post Content
 *
 * @author    Stephen Scaff
 * @package   jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<section class="post-content content">
  <div class="grid-sm">
    <?php the_content(); ?>
  </div>
</section>
