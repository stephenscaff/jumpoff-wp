<?php
/**
 * Partial Load More
 *
 * Calls the load more ajax function
 *  
 *
 * @author    Stephen Scaff
 * @package   partials
 * @version   1.0
 * @see       inc/load-more (for js, css and php)
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<section class="view-all load-more">
  <a id="js-load-more" class="load-more__link" href="#">
    <span class="load-more__btn btn btn--alpha">Load More</span>
    <span class="load-more__preloader"><span class="preloader preloader--load-more"></span></span>
  </a>
</section>