<?php
/**
 *  Views/Shared/Mast
 *
 *  Template for displaying a common mast section.
 *
 *  @author    Stephen Scaff
 *  @package   Jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

$id         = get_id();
$mast_title = get_field('mast_title', $id);
$mast_text  = get_field('mast_text', $id);
$mast_img   = get_field('mast_image', $id);
$ft_img     = get_ft_img();
if !($mast_img) $mast_img = $ft_img->url;
if !($mast_title) $mast_title = get_the_title();

?>

<section class="mast">
  <figure class="mast__figure" style="background-image:url(<?php echo $mast_img; ?>)"></figure>
  <div class="grid">
    <header class="mast__header">
    <h1 class="mast__title"><?php echo $mast_title; ?></h1>
    <?php if ($mast_text) : ?>
      <p class="mast__text"><?php echo $mast_text; ?></p>
    <?php endif; ?>
  </header>
  </div>
</section>
