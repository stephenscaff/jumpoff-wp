<?php
/**
 * views/modules/content-module
 *
 * @author       Stephen Scaff
 * @package      views/modules
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

$content = get_sub_field('content');
$grid = get_sub_field('grid_width');

?>

<section class="content content--module">
  <div class="<?php echo $grid; ?>">
    <?php echo $content; ?>
  </div>
</section>
