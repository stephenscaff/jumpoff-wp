<?php

namespace Jumpoff;

/**
 * Global Variables for Javascript stuff.
 *
 * Using wp_head hook to output a collection of useful globals
 * variables for javascript stuff.
 *
 * @return object appGlobals - An object with variable props.
 */
add_action ( 'wp_head', function() {
  $json = array(
    'admin_ajax'  => admin_url( 'admin-ajax.php' ),
    'site'        => get_bloginfo( 'template_directory' )
  );
  ?>
<script>
var appGlobals = <?php echo json_encode($json, JSON_PRETTY_PRINT); ?>;
</script>
<?php
});


/**
 * Next/Prev Links
 * Outputs next/prev rel links into head via wp_head hook.
 */
add_action ( 'wp_head', function() {
  global $paged;

  $prev = get_pagenum_link( $paged - 1 );
  $next = get_pagenum_link( $paged +1 );
  $output = "";

  if ( get_previous_posts_link() ) {
    $output .= "<link rel='prev' href='{$prev}' />";
  }
  if ( get_next_posts_link() ) {
    $output .= "<link rel='prev' href='{$next}' />";
  }

  return $output;
});



/**
 * SEO Metas Output
 */
add_action ( 'wp_head', function() {
  $get_id = get_id();
  $wp_visibility = get_option( 'blog_public' );
  $robots_index = get_field('seo_robots_index', $get_id);
  $robots_follow = get_field('seo_robots_follow', $get_id);
  $robots_noarchive = get_field('seo_robots_noarchive', $get_id);
  $robots_nosnippet = get_field('seo_robots_nosnippet', $get_id);
  $output = "";

  $index = 'index';
  $follow = 'follow';

  if ($robots_index) $index = 'noindex';
  if ($robots_follow) $follow = 'nofollow';

  if ( $wp_visibility) {
    $output .= "<meta name='robots' content='{$index}, {$follow}'> \n";
  }

  if ( $robots_noarchive ) {
    $output .= "<meta name='robots' content='noarchive'> \n";
  }

  if ( $robots_nosnippet ) {
    $output .= "<meta name='robots' content='nosnippet'> \n";
  }

  echo $output;

});
