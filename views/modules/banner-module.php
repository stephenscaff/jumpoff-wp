<?php
/**
 * views/modules/banner-module
 *
 * @author       Stephen Scaff
 * @package      jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

global $post ;

$image        = get_sub_field('image');
$title        = get_sub_field('title');
$content      = get_sub_field('content');
$btn_link     = get_sub_field('button_link');
$btn_url      = get_sub_field('button_url');
$link_or_url  = get_field_fallback($btn_link, $btn_url);
$btn_text     = get_sub_field('button_text');

?>

<section class="banner module">
  <figure class="banner__figure" style="background-image: url(<?php echo $image['url']; ?>)"></figure>
  <div class="grid-lg">
    <a class="banner__link" href="<?php echo $link_or_url; ?>">
      <header class="banner__header">
        <h3 class="banner__title"><?php echo $title; ?></h3>
        <?php if ($text) : ?>
          <p class="banner__text"><?php echo $content; ?></p>
        <?php endif; ?>
        <span class="btn-line"><?php $btn_text; ?></span>
      </header>
    </a>
  </div>
</section>
