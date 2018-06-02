<?php
/**
 * The primary page for posts / blog index.                                                                                                                       n
 *
 * @author    Stephen Scaff
 * @package   page
 * @version   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

<!-- Main -->
<main role="main" class="">

<section class="mast pad-xl">
  <div class="grid-sm">
    <h1 class="mast__title">The Jumpoff - <span class="color-grey">Just a simple Wp + Gulp project starter to set it off.</span></h2>
    <p class="mast__text">Contains some intergrated wp functionalitythat I use a good bit (see inc directory), StoutLogic's ACF builder, an ACF module class, an admin theme, and a tiny front-end framework of sorts.</p>
  </div>
</section>

<!-- Posts -->
<?php //get_template_part( 'partials/partial', 'posts' );?>

</main>

<!-- Footer -->
<?php get_footer(); ?>
