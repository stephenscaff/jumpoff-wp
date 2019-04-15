<?php
/**
 * Views/Posts/Related
 * The section for Related Posts.
 *
 * @author    Stephen Scaff
 * @package   jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<section class="heading">
  <header class="grid-lg">
    <h2 class="heading__title">Related News</h2>
  </header>
</section>

<section class="posts pad">
  <div class="grid-xl">
    <div class="posts__grid">
    <?php
    $cat  = get_cat_slug();
    $args = array(
      'post_type' => 'post',
      'category_name'    => $cat,
      'posts_per_page'   => 3,
      'orderby'          => 'date',
      'order'            => 'DESC',
      'post__not_in' => array($post->ID),
      'tax_query' => array()
    );
    $posts = get_posts( $args );

    foreach ( $posts as $post ) : setup_postdata( $post );
      include(locate_template('views/content/post.php' ));
    endforeach;
    wp_reset_postdata();
    ?>
    </div>
  </div>
</section>
