<?php
/**
* The default template for single blog posts.
*
* @author    Stephen Scaff
* @package   Jumpoff
*/

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

while (have_posts()) : the_post();

$post_title           = get_the_title();
$post_ft_img          = get_ft_img('full');
$post_subtitle        = get_post_meta($post->ID,'subtitle', true);
$author_id            = get_the_author_meta('ID');
$author_content       = get_user_meta($author_id, 'user_content', true);
$author_avatar        = get_user_meta($author_id, 'user_avatar', true);
$author_avatar_img    = wp_get_attachment_image_src($author_avatar)[0];
$author_gravatar_img  = get_avatar_url( $author_id );
$avatar_or_gravatar   = get_field_fallback($author_avatar_img, $author_gravatar_img);
$author_position      = get_user_meta($author_id, 'position', true);
$author_link          = get_author_posts_url( $author_id, get_the_author_meta( 'user_nicename' ) );
$author_name          = get_the_author_meta('display_name');

?>

<main>

<article class="post-single">

<?php include(locate_template( 'views/post/_post-mast.php' ) ); ?>
<?php include(locate_template( 'views/post/_post-content.php' ) ); ?>
<?php include(locate_template( 'views/post/_post-footer.php' ) ); ?>

</article>

<?php include(locate_template( 'views/post/_related.php' ) ); ?>

</main>

<?php endwhile; ?>

<?php get_footer(); ?>
