<?php

/**
 *  Admin Dash View
 *
 *
 *  @version    1.0
 *  @see        admin-dash.php
 *  @see        admin/admin-theme/assets (for styles)
 */

if ( ! defined( 'ABSPATH' ) ) exit;

# Wp admin bootstrap
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );

?>

<section class="dash">

  <header class="dash-header">
    <h1 class="dash-header__title">Welcome to your Site</h1>
    <p class="dash-header__text">From here you can create and manage the font-end experience.</p>
  </header>

  <section class="dash-cards">

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo site_url( '' ); ?>" target="_blank">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-open-in-browser"></i>

          <h3 class="dash-card__title">Launch Site</h3>

          <p class="dash-card__text">Go to the Site's Home Page.</p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'admin.php?page=company-contacts' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-phone-talk"></i>

          <h3 class="dash-card__title">Edit Contacts</h3>

          <p class="dash-card__text">Edit global links, contacts, socials, etc. </p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php?post_type=page' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-pages"></i>

          <h3 class="dash-card__title">Manage Pages</h3>

          <p class="dash-card__text">Add new pages, or manage editing</p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-tag"></i>

          <h3 class="dash-card__title">Articles / News</h3>

          <p class="dash-card__text">Add new posts / news stories</p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-tag"></i>

          <h3 class="dash-card__title">Some Post Type</h3>

          <p class="dash-card__text">Add new whateves</p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-tag"></i>

          <h3 class="dash-card__title">Some Post Type</h3>

          <p class="dash-card__text">Add new whateves</p>
        </div>
      </a>
    </article>
  </section>
</section>
<?php //include( ABSPATH . 'wp-admin/admin-footer.php' );
