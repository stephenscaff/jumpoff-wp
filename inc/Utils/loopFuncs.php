<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 *  Get Tax Posts
 *
 *  Gets posts by post type and tax/term with some options
 *
 * @see      partials-content-products.php For useage
 * @param    string  $post_type The post type
 * @param    string  $tax   The taxonomy
 * @param    string  $term  The taxonomy's term
 * @param    int     $num_posts  Number of posts
 * @param    string  $grid_size Determines grid layout via css grid helper class
 * @return   $posts
 */

function get_posts_by_term($opts){
  global $post ;

  $defaults = array(
  	'post_type'  => 'post',
  	'tax'        => null,
  	'terms'      => null,
  	'num_posts'  => 3,
    'template'   => 'post',
    'grid_cols'  => '1-3',
    'show_archive_link' => false,
    'excluded'   => null,
  );

  $args = wp_parse_args( $opts, $defaults );


  $post_args = array(
    'posts_per_page'   => $args['num_posts'],
    'post_type'        => $args['post_type'],
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post__not_in'     => array($args['excluded']),
    'tax_query' 			 => array(
			array(
        'taxonomy' 	=> $args['tax'],
        'terms' 		=> array($args['terms']),
				'field' 		=> 'slug',
        'operator' 	=> 'IN',
      ),
    ),
  );

  $term_obj  = get_term_by( 'slug', $args['terms'], $args['tax']);

?>
<section class="post-cards">
  <div class="grid-lg">
    <heading class="heading">
      <h2 class="title__title"><?php echo $term_obj->name; ?></h2>
    </heading>

    <div class="post-cards__grid grid-1-2-3">
    <?php
    $posts = get_posts( $post_args );
    foreach ( $posts as $post ) : setup_postdata( $post );
      include(locate_template( "partials/content/content-{$args['template']}.php" ) );
    endforeach;
    wp_reset_postdata(); ?>
    </div>
    <?php if ($args['show_archive_link']) : ?>
    <footer class="ending">
      <a class="btn" href="<?php echo get_category_link($term_obj->term_id); ?>">View All</a>
    </footer>
    <?php endif; ?>
  </div>
</section> <?php
}
