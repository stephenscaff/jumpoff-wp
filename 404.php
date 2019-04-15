<?php
/**
 * 404 Template
 *
 * @author    Stephen Scaff
 * @package   Jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

<main class="has-header-offset bg-white">

<section class="fourohfour">
  <div class="grid">
    <div class="fourohfour__grid">
      <figure class="fourohfour__figure">
        <img src="<?php echo get_img_dir(); ?>/404/404-1.gif">
      </figure>

      <div class="fourohfour__content">
        <span class="fourohfour__pretitle">404</span>
        <h1 class="fourohfour__title">Four Oh Four</h1>
        <p class="fourohfour__text">Nothing to see here. </p>
        <a class="fourhofour__btn btn" href="<?php echo get_page_url('home') ?>">Take Me Home</a>
      </div>
    </div>
  </div>
</section>

</main>

<!-- Footer  -->
<?php get_footer(); ?>
