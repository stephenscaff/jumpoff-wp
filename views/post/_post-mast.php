<?php
/**
 *  Views/Posts/_Post-Mast
 *  Post Mast for Single Posts and post-like post types
 *
 *  @author    Stephen Scaff
 *  @package   jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

$post_title     = get_the_title();
$post_subtitle  = get_field('post_subtitle');
$post_img       = get_ft_img('full');
$post_img_url   = $post_img->url;
$post_date      = get_the_time('F j, Y');

# Featured Image or Fallback logic
$has_img = false;

if ($post_img->url) {
  $has_img = true;
}

?>

<section class="post-mast <?php if ($has_img) { echo 'has-img'; } else { echo 'no-img'; }; ?>">
  <header class="post-mast__header grid-sm ">
    <time class="post-mast__meta"><?php echo $post_date; ?></time>
    <h1 class="post-mast__title"><?php echo $post_title; ?></h1>

    <?php if ($post_subtitle): ?>
    <p class="post-mast__subtitle"><?php echo $post_subtitle; ?> </p>
    <?php endif; ?>
  </header>

  <?php if ($has_img) : ?>
  <figure class="post-mast__figure grid">
    <img class="post-mast__img" src="<?php echo $post_img_url; ?>" alt="<?php echo $post_img->alt; ?>">
    <?php if ($post_img->caption) : ?>
      <figcaption class="post-mast__img-caption"><?php echo $post_img->caption; ?></figcaption>
    <?php endif; ?>
  </figure>
  <?php endif; ?>
</section>
