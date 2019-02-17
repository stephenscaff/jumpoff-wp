<?php
/**
 * Four Oh Four Template
 *
 * @author    Stephen Scaff
 * @package   404
 * @version   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

<!-- MAIN -->
<main class="has-header-offset bg-white">

<section class="fourohfour">
  <div class="grid">
    <div class="fourohfour__grid">
      <figure class="fourohfour__figure">
        <img src="<?php echo jumpoff_img(); ?>/404/404-1.gif">
      </figure>

      <div class="fourohfour__content">
        <span class="fourohfour__pretitle">404</span>
        <h1 class="fourohfour__title">Four Oh Four</h1>
        <p class="fourohfour__text">Nothing to see here. </p>
        <a class="fourhofour__btn btn" href="<?php echo jumpoff_page_url('home') ?>">Take Me Home</a>
      </div>
    </div>
  </div>
</section>

</main>

<!-- Footer  -->
<?php get_footer(); ?>
