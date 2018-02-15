<?php
/**
 * Template Name: About
 *
 * @author    Stephen Scaff
 * @package   page
 * @version   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

<!-- Main --> 
<main role="main">

<!-- Mast --> 
<section class="mast mast--page">
  <header class="mast__header">
    <h1><?php the_title(); ?></h1>
  </header>
</section>

</main>

<!-- Footer --> 
<?php get_footer(); ?>