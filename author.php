
<?php
/**
 * Template for author posts archives.                                                                                                               n
 *
 * @author    Stephen Scaff
 * @package   page
 * @version   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

<main role="main" class="">

<section class="mast mast--author">
  <div class="grid">
    <div class="mast__content">
      <h1 class="mast__title"><?php the_author_meta('display_name'); ?></h1>
      <?php if (get_the_author_meta('description')) : ?>
      <p><?php the_author_meta('description'); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Posts -->
<?php get_template_part( 'partials/partial', 'posts' ); ?>

<!-- Pagination -->
<?php get_template_part( 'partials/partial', 'fetch-more' );?>

</main>

<!-- Footer  -->
<?php get_footer(); ?>
