<?php
/**
 *  Partial: Masts
 *
 *  Template for displaying a common mast section.
 *
 *  @author    Stephen Scaff
 *  @package   partials
 *  @version    1.0
 *  @see       inc/utils/conditions.php for jumpoff_id() logic that snags relevant post id.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$id = jumpoff_ids();
$mast_title = get_field('mast_title', $id);
$mast_text = get_field('mast_text', $id);
$mast_img = get_field('mast_image', $id);
$ft_img = jumpoff_ft_img();
?>

<section class="mast">
  <?php if ($mast_img) : ?>
    <figure class="mast__figure" style="background-image:url(<?php echo $mast_img; ?>)"></figure>
  <?php else : ?>
    <figure class="mast__figure" style="background-image:url(<?php echo $ft_img->url ?>)"></figure>
  <?php endif; ?>
  <div class="grid">
    <div class="mast__content">
    <?php if ($mast_title) : ?>
      <h1 class="mast__title"><?php echo $mast_title; ?></h1>
    <?php elseif (is_tax()) : ?>
      <h1 class="mast__title"><?php single_cat_title('', true); ?>s</h1>
    <?php else : ?>
      <h1 class="mast__title"><?php the_title(); ?></h1>
    <?php endif; if ($mast_text) : ?>
      <p class="mast__text"><?php echo $mast_text; ?></p>
    <?php endif; ?>
    </div>
  </div>
</section>
