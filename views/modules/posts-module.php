<?php
/**
 * views/modules/posts-module
 *
 * @author       Stephen Scaff
 * @package      jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

global $post;

//vars
$title = get_sub_field('heading_title');
$archive_link = get_sub_field('archive_link');


/**
 * Latest, Cat or Selected Logic
 * Gets 3 latest posts, unless posts are manually
 * selected via posts_selector relationship field or
 * latest if nothing is selected.
 */
$by_selected_or_cat_or_latest = "";
$by_selected = get_sub_field('posts_selector');
$by_cat =  get_sub_field('posts_cat');


if ( $by_selected ) {

  $by_selected_or_cat_or_latest = $by_selected;

} elseif ( $by_cat ) {

  $args = array(
    'post_type'       => 'post',
    'posts_per_page'  => 3,
    'orderby'         => 'date',
    'order'           => 'DESC',
    'tax_query' => array(
      array(
        'taxonomy'  => 'category',
        'field'     => 'slug',
        'terms'     => $by_cat->slug,
        'operator'  => 'IN',
      ),
    ),
  );

  $by_selected_or_cat_or_latest = get_posts( $args );

} else {

  $args = array(
    'post_type'       => 'post',
    'posts_per_page'  => 3,
    'orderby'         => 'date',
    'order'           => 'DESC',
  );

  $by_selected_or_cat_or_latest = get_posts( $args );
}

?>

<section class="cards module">
  <div class="grid-lg">

    <?php if ($title) : ?>
    <header class="heading">
      <h2 class="heading__title"><?php echo $title; ?></h2>
    </header>
    <?php endif; ?>

    <div class="cards__grid">
    <?php
    foreach ( $by_selected_or_cat_or_latest as $post ) : setup_postdata( $post );
      include(locate_template('views/post/_post.php' ));
    endforeach;
    wp_reset_postdata();
    ?>
    </div>

    <?php if ($archive_link) : ?>
    <footer class="cards__footer">
      <a class="btn-line btn--beta" href="<?php echo $archive_link; ?> ?>">View All</a>
    </footer>
    <?php endif; ?>
  </div>
</section>
