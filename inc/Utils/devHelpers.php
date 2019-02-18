<?php

namespace jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Loop Content
 * A Dev helper to test a loop/list of content blocks;
 * @var integar $items - number of items for loop.
 * @var string $contet - the content partial
 */
function get_loop_content($items, $content) {

  for ( $i = 0; $i < $items; $i++) {
    require(locate_template("partials/content/content-{$content}.php" ));
  }
}
