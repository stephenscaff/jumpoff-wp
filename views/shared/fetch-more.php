<?php
/**
 * Views/Shared/Fetch-More
 *
 * Displays button for Load More Posts via fetch api
 *
 *
 * @author      Stephen Scaff
 * @package     jumpoff
 * @subpackage  FetchMore
 * @see         inc/fetch-more
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

if (has_more_posts(get_the_ID())) :

?>

<section class="fetch-more">
  <div class="grid">
    <a id="js-fetch-more" class="fetch-more__link" href="#">
      <span class="fetch-more__btn btn">View More</span>
    </a>
  </div>
</section>

<?php endif;
