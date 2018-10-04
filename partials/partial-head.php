<?php
/**
 * Partial: head
 *
 * Head partial including metas, custom seo fields, wp_head(), etc.
 *
 * @author    Stephen Scaff
 * @package   partials
 * @version   1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$ids = jumpoff_ids();

$meta_author = "Jumpoff";
$meta_site_name = get_bloginfo('name') .' - '. get_bloginfo('description');

# Meta Title
$meta_title = get_post_meta('seo_title', $ids);
if (!$meta_title) $meta_title = wp_title('|', false, 'right') . get_bloginfo('name');

# Meta Description
$meta_description = get_field('seo_description', $ids);
if (!$meta_description) $meta_description = 'Jumpoff...';

# Meta Image
$meta_img = get_field('seo_image', $ids);
$meta_img = $meta_img ? $meta_img['url'] : jumpoff_ft_img('large')->url;


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->

<!-- Title and Meta-->
<title><?php echo $meta_title ?></title>
<meta name="author" content="<?php echo $meta_author ?>">
<meta name="description" content="<?php echo $meta_description ?>">

<!-- Facebook Open Graph Meta-->
<meta property="og:title" content="<?php echo $meta_title ?>">
<meta property="og:url" content="<?php echo the_permalink() ?>">
<meta property="og:site_name" content="<?php echo $meta_site_name ?>">
<meta property="og:description" content="<?php echo $meta_description ?>">
<meta property="og:image" content="<?php echo $meta_img; ?>">

<!-- Twitter Meta -->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>"/>
<meta name="twitter:url" content="<?php echo the_permalink() ?>">
<meta name="twitter:site" content="@"/>
<meta name="twitter:creator" content="https://twitter.com/">
<meta name="twitter:domain" content="<?php echo get_site_url(); ?>"/>
<meta name="twitter:image" content="<?php echo $meta_img; ?>" />

<!-- Mobile -->
<meta name="viewport" content="width=device-width, initial-scale = 1, maximum-scale=1" />

<!-- Favs -->
<?php if (has_site_icon()) : wp_site_icon();  endif; ?>

<!-- Tracking -->
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-12345678-X', 'auto');
  ga('send', 'pageview');
</script>

<!-- Feed -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

<!-- CSS & Js -->
<?php wp_head(); ?>

</head>
