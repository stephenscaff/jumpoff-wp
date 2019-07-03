<?php
/**
 * Shares/Views/Head
 *
 * Head partial including metas, custom seo fields, wp_head(), etc.
 *
 * @author    Stephen Scaff
 * @package   jumpoff
 * @see       inc/utils/hooks-head.php
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

$ids            = get_id();
$meta_author    = 'Stephen Scaff';
$meta_site_name = 'Jumpoff';
$meta_title     = '';
$seo_title      = get_field('seo_title', $ids);

# Title
if ($seo_title) {
  $meta_title = $seo_title . ' | ' . $meta_site_name;
} else {
  $meta_title = wp_title('|', false, 'right') . $meta_site_name;
}

# Meta Description
$meta_description = get_field('seo_description', $ids);
if (!$meta_description) $meta_description = '';

# Meta Image
$meta_img = get_field('seo_image', $ids);
$meta_img = $meta_img ? $meta_img['url'] : get_ft_img('large')->url;

# Meta Canonical
$meta_canonical = get_field('seo_canonical_url', $ids);
if (!$meta_canonical) $meta_canonical = get_the_permalink();

?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->

<title><?php echo $meta_title ?></title>
<meta name="author" content="<?php echo $meta_author ?>">
<meta name="description" content="<?php echo $meta_description ?>">

<meta property="og:title" content="<?php echo $meta_title ?>">
<meta property="og:url" content="<?php echo the_permalink() ?>">
<meta property="og:site_name" content="<?php echo $meta_site_name ?>">
<meta property="og:description" content="<?php echo $meta_description ?>">
<meta property="og:image" content="<?php echo $meta_img; ?>">
<meta name="twitter:card" content="summary"/>
<meta name="twitter:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>"/>
<meta name="twitter:url" content="<?php echo the_permalink() ?>">
<meta name="twitter:site" content="@"/>
<meta name="twitter:creator" content="https://twitter.com/">
<meta name="twitter:domain" content="<?php echo get_site_url(); ?>"/>
<meta name="twitter:image" content="<?php echo $meta_img; ?>" />

<meta name="viewport" content="width=device-width, initial-scale = 1, maximum-scale=1" />

<link rel="canonical" href="<?php echo $meta_canonical; ?>" />

<!-- Favs -->
<?php if (has_site_icon()) : wp_site_icon();  endif; ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

<script type="text/javascript">
  var html = document.querySelector('html');
  html.className = html.className.replace('no-js','js');
</script>

<?php wp_head(); ?>

<?php
/**
 * GTM Tracking
 */
$gtm_id = get_field('gtm_id', 'options');

if ($gtm_id) : ?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo $gtm_id; ?>');</script>
<?php endif; ?>

</head>

<body <?php echo body_class(); ?>>

<?php if ($gtm_id) : ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gtm_id; ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>
