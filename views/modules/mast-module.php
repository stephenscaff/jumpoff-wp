<?php
/**
 * views/modules/mast-module
 *
 * @author       Stephen Scaff
 * @package      views/modules
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

$title = get_sub_field('title');
$title = get_sub_field('text');
$img   = get_sub_field('image');

?>

<section class="mast module">
  <figure class="mast__figure">
    <div class="mast__img"  style="background-image: url(<?php echo $img['url']; ?>)"></div>
  </figure>
    <header class="mast__header grid-lg">
      <h1 class="mast__title"><?php echo $title; ?></h1>
      <?php if ($mast_text) : ?>
        <p class="mast__text"><?php echo $text; ?></p>
      <?php endif; ?>
    </header>
</section>
