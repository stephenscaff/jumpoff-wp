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

<section class="heading pad-t">
  <header class="grid-lg">
    <h4 class="heading__title">Related News</h4>
  </header>
</section>

<section class="posts pad-b">
  <div class="grid-lg">
    <div class="posts__grid grid-1-2-3">
    <?php
    $id   = get_the_ID();
    $cat  = get_cat_slug($id);
    $args = array(
      'post_type'        => 'post',
      'category_name'    => $cat,
      'posts_per_page'   => 3,
      'orderby'          => 'date',
      'order'            => 'DESC',
      'post__not_in'     => array($post->ID),
      'tax_query'        => array()
    );
    $posts = get_posts( $args );

    foreach ( $posts as $post ) : setup_postdata( $post );
      include(locate_template('views/post/_post.php' ));
    endforeach;
    wp_reset_postdata();
    ?>
    </div>
  </div>
</section>
