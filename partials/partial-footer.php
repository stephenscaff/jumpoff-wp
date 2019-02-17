<?php
/**
 * Partial: Footer
 *
 * Global footer element, inlcuding wp_footer().
 *
 * @author    Stephen Scaff
 * @package   partials
 * @version   1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<footer class="app-footer">
  <div class="grid-sm">
    <p class="app-footer__creds">A little thing by <a href="http://stephenscaff.com" target="_blank" rel="external">Stephen Scaff</a></p>
  </div>
</footer>

<!-- Le javascript -->
<?php wp_footer(); ?>

</body>
</html>
