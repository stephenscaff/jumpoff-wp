<?php
/**
 * Views/Post/Post-Footer
 *
 * @author    Stephen Scaff
 * @package   jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<section class="post-footer">
  <div class="grid-sm">
    <div class="post-footer__grid">
      <figure class="post-footer__avatar">
        <img class="post-footer__avatar-img" src="<?php echo $author_avatar_img; ?>">
      </figure>
      <div class="post-footer__byline">
        <span class="post-footer__byline-meta">Posted By</span>
        <a class="post-footer__byline-author" href=""><?php echo $author_name; ?></a>
        <p class="post-footer__byline-attr"><?php echo $author_position; ?></p>
      </div>
      <nav class="post-footer__shares">
        <a
          class="post-footer__share"
          href="https://twitter.com/share?url=<?php echo $url; ?>&text=<?php echo substr(rawurlencode($title), 0, 75) ?>&via="
          target="_blank">
          <i class="icon-twitter"></i>
        </a>
        <a
          class="post-footer__share"
          href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url ?>"
          target="_blank">
          <i class="icon-facebook bg-purple"></i>
        </a>
        <a
          class=""
          href="https://www.linkedin.com/shareArticle?url=<?php echo $url ?>&title=<?php the_title(); ?>&summary=<?php echo $excerpt; ?>&source=<?php echo $source; ?>"
          target="_blank">
          <i class="icon-linkedin"></i>
        </a>
      </nav>
    </div>
  </div>
</section>
