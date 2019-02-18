<?php
/**
 * Partial: Posts
 *
 * Outputs default posts loop. #js-posts is the handler for fetch-more
 *
 * @author    Stephen Scaff
 * @package   partials
 * @version   1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<section class="posts has-fetch-more">
  <div class="grid">
    <div id="js-posts" class="posts__grid">
    <?php
    if ( have_posts() ): while ( have_posts() ) : the_post();
      get_template_part( 'partials/content/content', 'post' );
    endwhile; else:
      get_template_part( 'partials/content/content', 'none' );
    endif;
    ?>
    </div>
  </div>
</section>
