<?php
/**
 * Views/Shared/Footer
 *
 * Global footer element, inlcuding wp_footer().
 *
 * @author    Stephen Scaff
 * @package   jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

$address   = get_field('contacts_address', 'options');
$phone     = get_field('contacts_phone', 'options');
$email     = get_field('contacts_email', 'options');
$twitter   = get_field('contacts_twitter', 'options');
$facebook  = get_field('contacts_facebook', 'options');
$instagram = get_field('contacts_instagram', 'options');
$linkedin  = get_field('contacts_linkedin', 'options');
$youtube   = get_field('contacts_youtube', 'options');
$vimeo     = get_field('contacts_vimeo', 'options');

?>

<footer class="app-footer">
  <div class="grid-lg">
    <div class="app-footer__grid">
      <?php if ($address) : ?>
      <div class="app-footer__col">
        <h5 class="app-footer__heading">Address</h5>
        <address class="app-footer__address">
          <?php echo format_lines($address, 'span'); ?></address>
        </address>
      </div>
      <?php endif; ?>
      <?php if ($phone || $email) : ?>
        <div class="app-footer__col">
          <h5 class="app-footer__heading">Contact</h5>
          <?php if ($phone) : ?>
            <span class="app-footer__label">Phone:</span>
            <a class="" href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
          <?php endif; ?>
          <?php if ($email) : ?>
            <span class="app-footer__label">Email:</span>
            <a class="" href="tel:<?php echo $email; ?>"><?php echo $email; ?></a>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="app-footer__col">
          <nav class="app-footer__nav is-social">
            <?php if ($facebook) : ?><a href="<?php echo $facebook; ?>">Facebook</a><?php endif; ?>
            <?php if ($twitter) : ?><a href="<?php echo $twitter; ?>">Twitter</a><?php endif; ?>
            <?php if ($instagram) : ?><a href="<?php echo $instagram; ?>">Instagram</a><?php endif; ?>
            <?php if ($youtube) : ?><a href="<?php echo $youtube; ?>">YouTube</a><?php endif; ?>
          </nav>
        </div>
      </div>
    <div class="app-footer__ending">
      <p class="app-footer__creds">A little thing by <a href="http://stephenscaff.com" target="_blank" rel="external">Stephen Scaff</a></p>

      <p class="app-footer__copyright">&copy; <?php echo date("Y"); ?> TheJumpoff</p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
