<?php
/**
 * Template Name: Modules
 *
 * @author      Stephen Scaff
 * @package     jumpoff
 * @subpackage  template
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

?>

<main class="app-main has-header-offset">
  <?php get_template_part( 'views/shared/modules' ); ?>
</main>

<?php get_footer(); ?>
