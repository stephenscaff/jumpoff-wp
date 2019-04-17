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
    <p class="dash-header__text">From here you can create and manage your site's content and front-end experience.</p>
    <p class="dash-header__text">  <a class="" href="<?php echo site_url( '' ); ?>" target="_blank">Launch Homepage</a></p>
  </header>

  <section class="dash-cards">


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

          <h3 class="dash-card__title">Posts</h3>

          <p class="dash-card__text">Manage and Create Posts</p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php?post_type=team' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-tag-user"></i>

          <h3 class="dash-card__title">Teams</h3>

          <p class="dash-card__text">Manage Team Members.</p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php?post_type=location' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-gps-add"></i>

          <h3 class="dash-card__title">Locations</h3>

          <p class="dash-card__text">Create and manage Locations</p>

        </div>
      </a>
    </article>
  </section>
</section>
