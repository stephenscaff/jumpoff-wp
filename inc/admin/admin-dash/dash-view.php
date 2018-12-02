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
    <h1 class="dash-header__title">Welcome to KidderMathews</h1>
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
      <div class="dash-card__link" href="<?php echo admin_url( 'edit.php?post_type=professional' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-tag-user"></i>

          <h3 class="dash-card__title">Professionals & Teams</h3>


          <p class="dash-card__text">
            <a href="<?php echo admin_url( 'admin.php?page=professional' ); ?>">Professionals</a>
            <span class="vert-sep">|</span>
            <a href="<?php echo admin_url( 'admin.php?page=team' ); ?>">Teams</a>
          </p>

        </div>
      </div>
    </article>

    <article class="dash-card">
      <div class="dash-card__link">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-pie-chart"></i>

          <h3 class="dash-card__title">Research</h3>

          <p class="dash-card__text">
            <a href="<?php echo admin_url( 'edit.php?post_type=trend_article' ); ?>">Trend Articles</a>
            <span class="vert-sep">|</span>
            <a href="<?php echo admin_url( 'admin.php?page=market_report' ); ?>">Market Reports</a>
          </p>
        </div>
      </div>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php?post_type=success_story' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-explore"></i>

          <h3 class="dash-card__title">Success Stories</h3>

          <p class="dash-card__text">Create and manage Success Stories</p>

        </div>
      </a>
    </article>


    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php?post_type=service' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-case"></i>

          <h3 class="dash-card__title">Services</h3>

          <p class="dash-card__text">Create and manage Services</p>

        </div>
      </a>
    </article>


    <article class="dash-card">
      <div class="dash-card__link">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-chat-clear"></i>

          <h3 class="dash-card__title">News and Press Releases</h3>

          <p class="dash-card__text">
            <a href="<?php echo admin_url( 'edit.php' ); ?>">News Features</a>
            <span class="vert-sep">|</span>
            <a href="<?php echo admin_url( 'edit.php' ); ?>">Press Releases</a>
          </p>
        </div>
      </div>
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

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url( 'edit.php?post_type=career' ); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-tag-user"></i>

          <h3 class="dash-card__title">Careers</h3>

          <p class="dash-card__text">Create and manage Career Listings</p>

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


<?php //include( ABSPATH . 'wp-admin/admin-footer.php' );
