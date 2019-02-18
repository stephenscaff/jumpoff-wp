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

namespace jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

$this_id = get_current_id();

$mast_title = get_field('mast_title', $this_id);
if (!$mast_title) $mast_title = get_the_title();

$mast_text = get_field('mast_text', $this_id);

$mast_img = get_field('mast_image', $this_id);
$ft_img = get_ft_img();
if (!$mast_img) $mast_img = $ft_img->url;

?>

<section class="mast">
  <figure class="mast__figure" style="background-image:url(<?php echo $mast_img; ?>)"></figure>
  <div class="grid">
    <div class="mast__content">
    <?php if ($mast_title) : ?>
      <h1 class="mast__title"><?php echo $mast_title; ?></h1>
    <?php endif; if ($mast_text) : ?>
      <p class="mast__text"><?php echo $mast_text; ?></p>
    <?php endif; ?>
    </div>
  </div>
</section>
