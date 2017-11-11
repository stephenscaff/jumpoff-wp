<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *  Post Type: Clients
 *
 *  Slug : press-releases
 *  Supports : title','thumbnail', 'editor', 'excerpt'
 *
 *  @version    1.0
 *  @see        single-press-releases
 *  @see        archive-press-releases
 */

/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );

?>

<section class="dash">

  <header class="dash-header">
    <h1 class="dash-header__title">Welcome to the CellNetix CMS</h1>
    <p class="dash-header__text">From here you can create and manage the font-end experience.</p>
  </header>

  <section class="dash-cards">

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php?post_type=page' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-file-empty"></i>

          <h3 class="dash-card__title">Manage Pages</h3>

          <p class="dash-card__text">Add new pages, or manage editing</p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-tag"></i>

          <h3 class="dash-card__title">Manage Posts / News</h3>

          <p class="dash-card__text">Add new posts / news stories</p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'admin.php?page=company-contacts' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-phone-handset"></i>

          <h3 class="dash-card__title">Edit Company Contacts</h3>

          <p class="dash-card__text">Edit global company phone numbers, socials, etc. </p>
        </div>
      </a>
    </article>



  </section>
</section>
<?php //include( ABSPATH . 'wp-admin/admin-footer.php' );
