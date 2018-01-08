<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *  Post Type: Article
 *
 *  Slug :      Articles
 *  Supports : 'title','thumbnail','editor'
 *
 *  @version    1.0
 *  @author     stephen scaff
 */

# Init Work
add_action('init', 'create_article_post_type');

function create_article_post_type() {
  register_post_type( 'article',

  array(
    'labels'              => array(
    'name'                => __( 'Articles' ),
    'singular_name'       => __( 'Article' ),
    'add_new'             => __( 'Add New Article' ),
    'add_new_item'        => __( 'Add Another Article.' ),
    'edit'                => __( 'Edit This Article' ),
    'edit_item'           => __( 'Edit This Article' ),
    'new_item'            => __( 'New Article' ),
    'view'                => __( 'Peep This Article' ),
    'view_item'           => __( 'Peep All Article ' ),
    'search_items'        => __( 'Search Your Articles' ),
    'not_found'           => __( 'Sorry. That Article cannot be found.' ),
    'not_found_in_trash'  => __( 'That Article is not in the Trash.' ),
  ),

  'description'           => __( 'Articles by Beecher\'s Foundation' ),
  'public'                => true,
  'show_ui'               => true,
  'menu_position'         => 6,
  'menu_dashicon'         => 'dashicons-format-aside',
  'menu_icon'             => 'dashicons-format-aside',
  'query_var'             => true,
  'supports'              => array( 'title','thumbnail', 'editor', 'author' ),
  'capability_type'       => 'post',
  'can_export'            => true,
  'has_archive'           => true,
  'rewrite'               => array('slug' => 'article', 'with_front' => false),
  ));
}



/**
 *  Taxonomy: Article Cat
 *
 *  Creates 'Article_cat' custom taxonomy
 *
 *  Slug : Article-categories
 *  hierarchical : true
 *
 *  @author     Stephen Scaff
 *  @version    1.0
 */
add_action( 'init', 'article_cat');

function article_cat() {
  register_taxonomy(
  'article_cat',
  'article',
    array(
      'labels'            => array(
      'name'              => _x('Article Categories', 'taxonomy general name'),
      'singular_name'     => _x('Article Categories', 'taxonomy singular name'),
      'search_items'      => __('Search Article Categories '),
      'all_items'         => __('All Article Categories'),
      'edit_item'         => __('Edit Article Categories'),
      'update_item'       => __('Update Article Categories'),
      'add_new_item'      => __('Add New Article Categories'),
      'new_item_name'     => __('New Article Categories'),
      'menu_name'         => __('Article Categories'),
    ),
    'hierarchical'        => true,
    'show_ui'             => true,
    'show_admin_column'   => true,
    'show_in_quick_edit'  => true,
    'rewrite'             => array(
        'slug'            => 'article-categories',
        'with_front'      => false,
      ),
  ));
}
