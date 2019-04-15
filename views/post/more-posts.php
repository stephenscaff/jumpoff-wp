<?php
/**
 *  Views/Post/MorePosts
 *  The More Posts section that appears at the bottom of
 *  single post/cpt instances, providing additional post previews.
 *
 *  @author     Stephen Scaff
 *  @package    Jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

$current_post = get_the_ID();
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
        include(locate_template('views/content/_post.php' ));
      endforeach;
    endif;
    wp_reset_postdata();
    ?>
    </div>
  </div>
</section>
