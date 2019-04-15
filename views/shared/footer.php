<?php
/**
 * Views/Shared/Footer
 *
 * Global footer element, inlcuding wp_footer().
 *
 * @author    Stephen Scaff
 * @package   partials
 * @version   1.0
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<footer class="site-footer">
  <div class="grid-sm">
    <p class="site-footer__creds">A little thing by <a href="http://stephenscaff.com" target="_blank" rel="external">Stephen Scaff</a></p>
  </div>
</footer>

<!-- Le javascript -->
<?php wp_footer(); ?>

</body>
</html>
