<?php
/**
* The default template for single blog posts.
*
* @author    Stephen Scaff
* @package   jumpoff
* @version   1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

while (have_posts()) : the_post();

$post_title = get_the_title();
$post_ft_img = jumpoff_ft_img('full');
$post_subtitle = get_post_meta($post->ID,'subtitle', true);
$author_id = get_the_author_meta('ID');
$author_avatar = get_user_meta($author_id, 'user_avatar', true);
$author_avatar_img = wp_get_attachment_image_src($author_avatar)[0];
$author_position = get_user_meta($author_id, 'position', true);
$author_link = get_author_posts_url( $author_id, get_the_author_meta( 'user_nicename' ) );
$author_name = get_the_author_meta('display_name');

?>

<!-- MAIN-->
<main role="main">


<article>

<!-- Post Header -->
<section class="post-mast pad">
  <header class="post-mast__header">
    <time class="post-mast__meta"><?php the_time('F j, Y'); ?></time>
    <h1 class="post-mast__title"><?php echo $post_title; ?></h1>
    <p class="post-mast__subtitle"><?php echo $post_subtitle; ?></p>
  </header>
  <div class="grid-lg">
    <figure class="post-mast__figure">
      <img class="post-mast__img" src="<?php echo $post_ft_img; ?>" alt="">
    </figure>
  </div>
</section>

<!--Post Content -->
<section class="post-content content">
  <div class="grid-sm">
      <?php the_content(); ?>
  </div>
</section>

<!-- Footer -->
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
        <a class="" href="https://twitter.com/share?url=<?php echo get_permalink() ?>&text=<?php echo substr(rawurlencode(get_the_title()), 0, 75) ?>&via=Beecher\'s Foundation" target="_blank"><i class="icon-twitter bg-blue-dark"><span></span></i></a>
        <a class="" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>" target="_blank"><i class="icon-facebook bg-purple"><span></span></i></a>
        <a class="" href="https://www.linkedin.com/shareArticle?url=<?php echo get_permalink() ?>&title=<?php the_title(); ?>&summary=<?php echo jumpoff_excerpt(250); ?>&source=<?php get_home_url(); ?>" target="_blank"><i class="icon-linkedin bg-green"><span></span></i></a>
      </nav>
    </div>
  </div>
</section>

</article>

<?php

// get_template_part( 'partials/partial', 'next' );
// get_template_part( 'partials/partial', 'related-posts' );
?>
</main>

<?php endwhile; ?>

<!-- Footer-->
<?php get_footer(); ?>
