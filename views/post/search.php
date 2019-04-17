<?php
/**
 * Prfessionals Archive - now professionals search
 *
 * @author    Stephen Scaff
 * @package   page
 * @version   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

namespace Jumpoff;

get_header();

global $wp_query;

$search_query = get_search_query();
$search_count = $wp_query->found_posts;
$search_terms = $wp_query->search_terms;
$post_type    = get_post_type( get_the_ID() );
?>

<main class="has-header-offset">

<?php get_template_part( 'views/shared/mast' ); ?>

<section class="filter-bar has-search">
  <div class="grid-lg">
    <div class="filter-bar__grid">
      <div class="filter-bar__search">
        <form
          class="search-box"
          role="search"
          method="get"
          action="<?php echo esc_url( home_url( '/' ) ); ?>">
          <i class="search-box__icon icon-search"></i>
          <input
            type="hidden"
            name="post_type"
            value="<?php echo $post_type; ?>">
  		    <input
            id="s"
            class="search-box__input  js-search"
            name="s"
            type="search"
            placeholder="Search for news and stuff">
        </form>
      </div>
  </div>
</section>

<?php get_template_part( 'views/shared/search-info' ); ?>

<section class="text-posts pad has-fetch-more js-results-container">
  <div class="grid-lg">
    <div id="js-posts" class="text-posts__grid">
      <?php
      if ( have_posts() ): while ( have_posts() ) : the_post();
        get_template_part( 'views/content/post'  );
      endwhile; else:
        get_template_part( 'views/content/none' );
      endif;
      ?>
    </div>
  </div>
</section>

<?php include(locate_template('views/shared/fetch-more.php' ));?>

</main>

<?php get_footer(); ?>
