<?php
/**
 * Views/Posts/Archive
 *
 * @author    Stephen Scaff
 * @package   jumpoff
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$current_obj = get_queried_object();
$ppp         = get_option('posts_per_page');
$paged       = (get_query_var('paged')) ? get_query_var('paged') : 1;

if (is_tax() OR (is_category())) {
  $title = $current_obj->name;
}
elseif ($index_title) {
  $title = get_field('mast_title', 'posts-index');
}
else {
  $title = "News";
}

?>

<main class="has-header-offset">

  <section class="mast is-centered">
    <div class="grid-lg">
      <h1 class="mast__title"><?php echo $title; ?></h1>
    </div>
  </section>

  <section class="posts-cards pad">
    <div class="grid-lg">
      <div id="js-posts" class="posts-cards__grid grid-1-2-3">
        <?php

        if (is_category() OR is_tax()) {

          $queried_object = get_queried_object();
          $tax = $queried_object->taxonomy;
          $term_slug = $queried_object->slug;
          $term_name = $queried_object->name;

          $args = array (
            'post_type'       => 'post',
            'posts_per_page' => $ppp,
            'paged'          => $paged,
            'tax_query'       => array(
              array(
                'taxonomy'    => 'category',
                'field'       => 'slug',
                'terms'       => $term_slug,
                'operator'    => 'IN',
              )
            )
          );
        }

        else {
          $ppp = get_option('posts_per_page');
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $args = array (
            'post_type'        => 'post',
            'posts_per_page'   => $ppp,
            'paged'            => $paged
          );
        }

      $posts = new WP_Query($args);

      if (have_posts()) :
        while ( $posts->have_posts() ) : $posts->the_post();
          include(locate_template('views/post/_post.php'));
        endwhile;
      else :
        include(locate_template('views/content/none.php'));
      endif;
      wp_reset_postdata();
      ?>
    </div>
  </div>
</section>

<?php get_template_part( 'views/shared/fetch-more' ); ?>

</main>

<?php get_footer(); ?>
