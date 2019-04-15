<?php
/**
 * Views/Post/search
 * View for displaying Search results
 *
 * @author    Stephen Scaff
 * @version   1.0
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

$search_query = get_search_query();

get_header();

?>

<main role="main">

<section class="search-mast">
  <div class="grid-sm">
    <h1 class="search-mast__title">Search</h1>
    <form class="search-box" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <i class="search-box__icon icon-search"></i>
      <input type="hidden" name="post_type" value="<?php echo $post_type; ?>">
      <input id="s" name="s" type="search" class="search-box__input  js-search" placeholder="Search for news and press releases">
    </form>
  </div>
</section>

<section class="search-info">
  <div class="grid-sm">
    <h5 class="search-info__title">
      <span>Seach results for </span>
      <span class="search-info__term"><?php echo htmlspecialchars($search_query); ?></span>
    </h5>
  </div>
</section>

<section class="search-items">
  <div class="grid-sm">
    <?php
    if ( have_posts() ): while ( have_posts() ) : the_post();
      get_template_part( 'views/post/_post'  );
    endwhile; else:
      get_template_part( 'views/post/_none' );
    endif;
    ?>
  </div>
</section>

</main>

<?php get_footer(); ?>
