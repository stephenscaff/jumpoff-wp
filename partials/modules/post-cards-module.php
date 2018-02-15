<?php
/**
* Gallery Module
*
* A simple image gallery module
*
* @author       Stephen Scaff
* @package      partials/modules
* @see          inc/fields/fields-modules
* @see          scss/components/_gal.scss
* @version      1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$pretitle = get_sub_field('pretitle');
$title = get_sub_field('title');
$content = get_sub_field('content');
$cards = get_sub_field('posts_picker');
$archive_select = get_sub_field('archive_link');

?>

<section class="heading bg-grey-light">
  <div class="grid">
    <span class="heading__pretitle"><?php echo $pretitle; ?></span>
    <h2 class="heading__title"><?php echo $title; ?></h2>
    <p class="heading__text"><?php echo $content; ?></p>
  </div>
</section>

<section class="cards -downloads bg-grey-light">
  <div class="grid-lg">
    <div class="cards__grid">
      <?php
      global $post;
      foreach( $cards as $post) :
        setup_postdata( $post );
          include(locate_template('partials/content/content-card.php'));
        wp_reset_postdata();
      endforeach;
      ?>
    </div>
  </div>
</section>
