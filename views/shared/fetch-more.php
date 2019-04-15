<?php
/**
 * Views/Shared/Fetch-More
 * Calls the load more ajax function
 *
 * @author    Stephen Scaff
 * @package   Jumpoff
 * @see       inc/load-more (for js, css and php)
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

if (has_more_posts($post->ID)) :

?>

<section class="fetch-more">
  <a id="js-fetch-more" class="fetch-more__link" href="#">
    <span class="fetch-more__btn btn">Keep Reading</span>
  </a>
</section>

<?php endif;
