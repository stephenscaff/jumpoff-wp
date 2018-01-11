<?php
/**
 * Template for iconv(in_charset, out_charset, str)                                                                                                                       n
 *
 * @author    Stephen Scaff
 * @package   page
 * @version   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

<!-- Main -->
<main role="main" class="">

<section class="mast pad-lg">
  <div class="grid-sm">
    <h1 class="mast__title">The Jumpoff</h1>
    <h2 class="mast__subtitle color-alpha">Just a simple WP / Gulp starter to set shit off.</h2>
    <hr class="sep">
    <p class="mast__text">Contains wp stuff I use a good bit, with a front-end system containing a bit of useful css, sensible scss/js structuring, a js includes system (see src/assets/js/app.js), and system error notices.</p>
  </div>
</section>


<!-- Posts -->
<?php get_template_part( 'partials/partial', 'posts' );?>

<!-- Pagination -->
<?php get_template_part( 'partials/partial', 'pagination' );?>

</main>

<!-- Footer -->
<?php get_footer(); ?>
