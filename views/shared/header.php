<?php
/**
 * Views/Shared/Header
 *
 * Main site/app header and nav section.
 *
 * @author    Stephen Scaff
 * @package   jumpoff
 */

namespace jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

$home_url = get_page_url('home');

?>

<body <?php body_class(); ?>>

<header class="app-header">
  <div class="grid-lg">
    <a class="app-header__brand" href="<?php echo $home_url; ?>">The JumpOff</a>
    <button
      class="menu-toggle js-menu-toggle is-mobile-only"
      arial-label="Menu">
      <div class="menu-toggle__bars"></div>
    </button>
  </div>
</header>
