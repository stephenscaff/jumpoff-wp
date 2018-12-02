<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Jumpoff Setup
 * Load scripts/styles, define supports, etc
 */
class JumpoffSetup {

	public static $instance;

  /**
   * @var string
   */
  const JQUERY = 'jquery';

  /**
   * @var string
   */
  const JUMPOFF_JS = 'jumpoff_js';

  /**
   * @var string
   */
  const JUMPOFF_STYLES = 'jumpoff_styles';

  /**
   * @var string
   */
  const JUMPOFF_FONTS = 'jumpoff_fonts';

  /**
   * Init
   */
	public static function init() {
		if ( is_null( self::$instance ) )
			self::$instance = new JumpoffSetup();
		return self::$instance;
	}

  /**
   * SetUp Constructor
   */
	private function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ));
    add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
    add_filter( 'style_loader_src', array( $this, 'remove_version') );
    add_filter( 'script_loader_src', array( $this, 'remove_version') );
    add_filter( 'script_loader_tag', array($this, 'async_scripts' ), 10, 2 );
		add_action( 'after_setup_theme', array( $this, 'menus' ) );
		add_action( 'after_setup_theme', array( $this, 'supports') );
    add_action( 'init', array( $this, 'permalinks') );
		add_action( 'init', array( $this, 'cleanup' ) );
		add_action( 'init', array( $this, 'no_xmlrpc' ) );
	}


  /**
   * Set Permalinks Option
   */
  public function permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/news/%year%/%monthnum%/%postname%/' );
  }


  /**
   * Load Styles
   */
  public function styles() {
    if ( !is_admin() ) {
      wp_register_style( self::JUMPOFF_STYLES, get_template_directory_uri() . '/assets/css/app.min.css', false );
      wp_register_style( self::JUMPOFF_FONTS, get_template_directory_uri() . '/assets/css/fonts.min.css', false );
      wp_enqueue_style( self::JUMPOFF_STYLES );
      wp_enqueue_style( self::JUMPOFF_FONTS );
    }
  }

  /**
   * Load Scripts
   */
	public function scripts() {
    if ( !is_admin() ) {
      wp_deregister_script( self::JQUERY );
      wp_register_script( self::JQUERY, get_template_directory_uri() . '/assets/js/jquery.min.js', '', false, true );
      wp_register_script( self::JUMPOFF_JS, get_template_directory_uri() . '/assets/js/app.min.js', '', false, true );
      //wp_enqueue_script( self::JQUERY );
      wp_enqueue_script( self::JUMPOFF_JS);
    }
  }

  /**
   * Remove Versions for security
   */
  function remove_version($src) {
		if ( strpos( $src, 'ver=' ) ) {
			$src = remove_query_arg( 'ver', $src );
		}
		return $src;
  }


  /**
   * Asynch Select JS
   */
	function async_scripts( $tag, $handle ){
		if ($handle === self::JUMPOFF_JS)  {
			return str_replace( 'src', ' async="async" src', $tag );
		}
		elseif ($handle === self::JQUERY)  {
			return $tag;
		}
		else  {
			return $tag;
		}
  }

  /**
   * Register Menus
   */
	public function menus() {
		register_nav_menus( array(
		    'nav_menu' => esc_html__( 'Header Menu' ),
		    'footer_menu_1' => esc_html__( 'Footer Menu 1' ),
				'footer_menu_2' => esc_html__( 'Footer Menu 2' ),
				'footer_menu_3' => esc_html__( 'Footer Menu 3' ),
		) );
	}

  /**
   * Define Support
   */
	public function supports() {
    add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );
	}

  /**
   * CleanUps
   */
  public function cleanUp() {
      remove_action('wp_head', 'feed_links', 2);
      remove_action('wp_head', 'feed_links_extra', 3);
      remove_action('wp_head', 'rsd_link');
      remove_action('wp_head', 'wlwmanifest_link');
      remove_action('wp_head', 'wp_generator');
      remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			add_filter( 'emoji_svg_url', '__return_false' );
			remove_action( 'wp_head', 'adjacent_posts_rel_link' );
			remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
  }

	/**
	 * NO XMLRPC
	 */
	public function no_xmlrpc(){

    # Remove RSD link from head
    remove_action('wp_head', 'rsd_link');

    add_filter( 'wp_xmlrpc_server_class', '__return_false' );
    add_filter('xmlrpc_enabled', '__return_false');


    # Disable XMLRPC Class
    add_filter( 'xmlrpc_methods', function( $methods ) {
    	unset( $methods['pingback.ping'] );
    	return $methods;
    });

    # Remove x-pingback HTTP header
    add_filter('wp_headers', function($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    });
  }
}

JumpoffSetup::init();
