<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 * ACF Search
 * A simple/barebones way to inlcude ACF fields in default WP search
 * @todo improve excerpt to include matching and surrounding text.
 */
class ACFSearch {

  /**
   * @var $wpbd object
   */
  private $wpdb;

  /**
   * Constructor
   */
  function __construct() {

    global $wpdb;

    $this->wpdb = &$wpdb;

    add_filter('posts_join',  array($this, 'join'));
    add_filter('posts_where',  array($this, 'where'));
    add_filter('posts_distinct',  array($this, 'distinct'));
  }


  /**
   *  Join posts and posts meta table
   *  @link http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
   */
  function join ($join) {

    if ( is_search() ) {
      $join .=' LEFT JOIN '.$this->wpdb->postmeta. ' ON '. $this->wpdb->posts . '.ID = ' . $this->wpdb->postmeta . '.post_id ';
    }

    return $join;
  }


  /**
   *  Modify the search query with posts_where
   *  @link http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
   */
  function where ($where) {

    if ( is_search() ) {
      $where = preg_replace(
        "/\(\s*".$this->wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
        "(".$this->wpdb->posts.".post_title LIKE $1) OR (".$this->wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
  }

  
  /**
   * Prevent duplicates (surprisingly)
   * @link https://tommcfarlin.com/selecting-distinct-records-in-wordpress/
   */
  function distinct ($where) {

    if ( is_search() ) {
      return "DISTINCT";
    }

    return $where;
  }
}

new ACFSearch;
