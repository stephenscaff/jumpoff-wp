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
    <h1 class="dash-header__title">Welcome to Your Site</h1>
    <p class="dash-header__text">From here you can create and manage the contetn and font-end experience of your site.</p>
    <p class="dash-header__text">  <a class="" href="<?php echo site_url( '' ); ?>" target="_blank">Launch Homepage</a></p>
  </header>

  <section class="dash-cards">

    <article class="dash-card">
      <div class="dash-card__link">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-explore"></i>

          <h3 class="dash-card__title">Site Globals</h3>

          <p class="dash-card__text">
            <a href="<?php echo admin_url( 'admin.php?page=contacts' ); ?>">Contacts</a>
            <span class="vert-sep">|</span>
            <a href="<?php echo admin_url( 'admin.php?page=tracking' ); ?>">Tracking</a>
          </p>
        </div>
      </div>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'post.php?post=4&action=edit' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-pages"></i>

          <h3 class="dash-card__title">Home Page</h3>

          <p class="dash-card__text">Manage Homepage Content.</p>
        </div>
      </a>
    </article>


    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php?post_type=some_post_type' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-explore"></i>

          <h3 class="dash-card__title">Some Post Type</h3>

          <p class="dash-card__text">Create and manage Success Stories</p>

        </div>
      </a>
    </article>


    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php?post_type=page' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-pages"></i>

          <h3 class="dash-card__title">Manage Pages</h3>

          <p class="dash-card__text">Manage page modules and content</p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-pages"></i>

          <h3 class="dash-card__title">Manage Posts</h3>

          <p class="dash-card__text">Write and manage posts / news</p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <div class="dash-card__link" href="<?php echo admin_url( 'edit.php?post_type=team' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-tag-user"></i>

          <h3 class="dash-card__title">Some Post Type</h3>


          <p class="dash-card__text">
            <a href="<?php echo admin_url( 'admin.php?page=sompage' ); ?>">Item One</a>
            <span class="vert-sep">|</span>
            <a href="<?php echo admin_url( 'admin.php?page=team' ); ?>">Item Two</a>
          </p>

        </div>
      </div>
    </article>
  </section>
</section>

<?php //include( ABSPATH . 'wp-admin/admin-footer.php' );
