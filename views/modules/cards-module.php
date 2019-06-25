<?php
/**
 * Views/Modules/Cards-Module
 *
 * Card building module
 *
 * @author       Stephen Scaff
 * @package      jumpoff/kidder
 * @version      1.0
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

$title = get_sub_field('heading_title');
$cards = get_sub_field('cards');

if (!empty($cards)) :

?>

<section class="cards">
  <div class="grid-lg">
    <?php if ($title) : ?>
    <header class="heading">
      <h2 class="heading__title"><?php echo $title; ?></h2>
    </header>
    <?php endif; ?>

    <div class="cards__grid">
      <?php
      foreach ( $cards as $card ) :
        $image_id     = $card['image'];
        $img          = jumpoff_ft_img('full', $image_id);
        $title        = $card['title'];
        $pretitle     = $card['pretitle'];
        $text         = $card['text'];
        $link         = $card['button_link'];
        $url          = $card['button_url'];
        $link_or_url  = get_field_fallback($link, $url);
        $btn_text     = $card['button_text'];

      ?>
      <article class="card">
        <a class="card__link" href="<?php echo $link_or_url; ?>">
          <figure class="card-post__figure">
            <img class="card-post__img"
                 src="<?php echo $img->url; ?>"
                 alt="<?php echo $img->alt; ?>"/>
          </figure>

          <header class="cardt__header">
            <?php if ($pretitle) : ?>
              <span class="card__pretitle"><?php echo $pretitle; ?></span>
            <?php endif; ?>
            <h4 class="card__title"><?php echo $title; ?></h4>
            <p class="card__text">
              <?php echo $content; ?>
            </p>

            <span class="card__btn btn-line"><?php echo $btn_text; ?></span>
          </header>
        </a>
      </article>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<?php endif; ?>
