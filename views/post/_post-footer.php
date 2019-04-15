<?php
/**
 * Views/Post/Post-Footer
 *
 * @author    Stephen Scaff
 * @package   jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit

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
        <a class="" href="https://twitter.com/share?url=<?php echo get_permalink() ?>&text=<?php echo substr(rawurlencode(get_the_title()), 0, 75) ?>&via=" target="_blank"><i class="icon-twitter bg-blue-dark"><span></span></i></a>
        <a class="" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>" target="_blank"><i class="icon-facebook bg-purple"><span></span></i></a>
        <a class="" href="https://www.linkedin.com/shareArticle?url=<?php echo get_permalink() ?>&title=<?php the_title(); ?>&summary=<?php echo jumpoff_excerpt(250); ?>&source=<?php get_home_url(); ?>" target="_blank"><i class="icon-linkedin bg-green"><span></span></i></a>
      </nav>
    </div>
  </div>
</section>
