<?php
/**
 *  Partial: More Posts
 *  The More Posts section that appears at the bottom of
 *  single post/cpt instances, providing additional post previews.
 *
 *  @author     Stephen Scaff
 *  @package    partials
 *  @version    1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

// Get id of current post
$current_post = get_the_ID();

// Content type logic
$post_type = '';

if (is_post_type('work')){
  $post_type = 'work';
} else {
  $post_type = 'post';
}

?>

<section class="heading bg-lightgrey">
  <div class="grid-lg">
    <h3 class="color-alpha">More Articles</h3>
  </div>
</section>

<section class="cards pad bg-lightgrey">
  <div class="grid-lg">
    <div class="cards__grid">
    <?php
    $args = array(
      'post_type'        => $post_type,
      'posts_per_page'   => 3,
      'post__not_in'     => array ($current_post),
      'order'            => 'DESC',
    );

    $more_posts = get_posts($args);

    if ($more_posts) :
      foreach ( $more_posts as $post ) : setup_postdata( $post );
        get_template_part( 'partials/content/content', 'post' );
      endforeach;
    endif;
    wp_reset_postdata();
    ?>
    </div>
  </div>
</section>
