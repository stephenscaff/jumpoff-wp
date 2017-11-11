<?php
/**
 * Partial: partials/partial-head
 *
 * @author    Stephen Scaff
 * @package   jumpoff/partials/partial-head
 * @version   1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Meta/OG variables
$ids = jumpoff_ids();
$meta_author = "Stephen Scaff";
$meta_site_name = get_bloginfo('name') .' - '. get_bloginfo('description');
$meta_title = get_post_meta($ids, 'seo_title', true );
if (!$meta_title) $meta_title = wp_title('|', false, 'right') . get_bloginfo('name');

$meta_description = get_post_meta($ids, 'seo_description', true );
if (!$meta_description) $meta_description = 'The Jumpoff is a Wp starter using gulp.';

$meta_img_id = get_post_meta( get_the_ID(), 'seo_image', true );
$meta_img_url = wp_get_attachment_url( $meta_img_id );
$meta_img = $meta_img_url ? $meta_img_url : jumpoff_ft_img('large');

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
<meta name="twitter:site" content="@pigeonwisdom"/>
<meta name="twitter:creator" content="https://twitter.com/CellNetixLabs">
<meta name="twitter:domain" content="http://cellnetix.com"/>
<meta name="twitter:image" content="<?php echo $meta_img; ?>" />

<!-- Mobile -->
<meta name="viewport" content="width=device-width, initial-scale = 1, maximum-scale=1" />

<!-- Fav and icons -->
<link rel="shortcut icon" href="<?php jumpoff_img(); ?>/favicon.ico" type="image/ico" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php jumpoff_img(); ?>/fav-152.png">
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php jumpoff_img(); ?>/fav-120.png">
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php jumpoff_img(); ?>/fav-60.png">
<link rel="apple-touch-icon-precomposed" href="<?php jumpoff_img(); ?>/fav-152.png">
<link rel="apple-touch-icon" sizes="57x57" href="<?php jumpoff_img(); ?>/favs/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php jumpoff_img(); ?>/favs/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php jumpoff_img(); ?>/favs/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php jumpoff_img(); ?>/favs/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php jumpoff_img(); ?>/favs/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php jumpoff_img(); ?>/favs/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php jumpoff_img(); ?>/favs/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php jumpoff_img(); ?>/favs/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php jumpoff_img(); ?>/favs/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php jumpoff_img(); ?>/favs/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php jumpoff_img(); ?>/favs/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php jumpoff_img(); ?>/favs/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php jumpoff_img(); ?>/favs/favicon-16x16.png">

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
