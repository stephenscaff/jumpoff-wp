<?php

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Jumpoff Admin Setup
 * Variety of admin specific directives and settings.
 */
class JumpoffAdminSetup {

	public static $instance;

  /**
   * Init
   */
	public static function init() {
		if ( is_null( self::$instance ) )
			self::$instance = new JumpoffAdminSetup();
		return self::$instance;
	}

  /**
   * SetUp Constructor
   */
	private function __construct() {
    add_action( 'admin_enqueue_scripts', array( $this, 'load_styles' ) );
    add_action( 'login_enqueue_scripts', array ( $this, 'load_styles' ) );
		add_action( 'wp_before_admin_bar_render', array( $this, 'admin_bar' ) );
    add_action( 'admin_menu', array( $this, 'remove_menu_items') );
    add_filter( 'menu_order', array( $this, 'menu_order' ) );
    add_filter( 'custom_menu_order', array( $this, 'menu_order' ) );
    add_filter( 'admin_body_class', array( $this, 'body_class' ) );
    add_filter( 'admin_footer_text', array( $this,  'admin_footer' ) );
    add_filter( 'admin_post_thumbnail_html', array( $this, 'ft_img_size_hints' ) );
    $this->login_logo();
		$this->disable_gutenberg();
		$this->no_front_adminbar();
	}

  /**
   * Load styles
   */
  function load_styles(){
    wp_enqueue_style('admin', get_template_directory_uri() . '/inc/Admin/AdminTheme/assets/css/admin.min.css', false );
  }

	/**
	 * Disable GutenBerg
	 */
	function disable_gutenberg() {
		add_filter('use_block_editor_for_post', '__return_false');
		add_filter('gutenberg_can_edit_post_type', '__return_false');

		add_action( 'wp_enqueue_scripts', function(){
			wp_dequeue_style( 'wp-block-library' );
		}, 100 );
	}

  /**
   * Backend Admin Bar Cleanup
   */
  function admin_bar(){
    global $wp_admin_bar;

    // Remove Menu Items
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    //$wp_admin_bar->remove_menu('site-name');
    $wp_admin_bar->remove_menu('view-site');
    $wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('new-content');
  }

  /**
   * Remove Front End Admin Bar
   */
  function no_front_adminbar(){
    add_filter('show_admin_bar', '__return_false');
  }

  /**
   * Remove Items
   * Remove menu items if not super user (me)
   */
  function remove_menu_items(){
    global $current_user;

    # Always Remove
    remove_menu_page( 'edit-comments.php' );
    //remove_menu_page( 'edit.php?post_type=acf-field-group' );
    //remove_menu_page( 'themes.php' );

    # If not admin remove
    if ( !current_user_can('administrator')  ) {
      remove_menu_page( 'plugins.php' );
      remove_menu_page( 'tools.php' );
    }
  }

 /**
  * Order Remaining Menu Items
  */
 function menu_order($menu_order){
   if ( !$menu_order ) return true;

   return array(
     'index.php',
     'upload.php',
     'contacts',
     'notice-bar',
     'edit.php',
		 'edit.php?post_type=team',
     'edit.php?post_type=page',
     'edit.php?post_type=service',
     'edit.php',
     'users.php',
     'plugins.php',
     'tools.php',
     'options-general.php',
     'themes.php',
   );
 }

 /**
  * Admin Footer Message
  */
 function admin_footer(){
   return '<span id="footer-thankyou">Developed by <a href="http://greenrubino.com" target="_blank">Green Rubino</a></span>';
 }

 /**
  * Featured Image Meta Hints
  */
 function ft_img_size_hints( $content ) {
   global $post_type;

   if ( 'some_post_type' == $post_type ) {
     $content .= '<p>Headshot Image: <br /> Size to 550x550</p>';
   }

	 elseif ( 'page' == $post_type ) {
     $content .= '<p>Featured Image: <br /> Size to 1500x900.</p>';
   }

	 elseif ( 'post' == $post_type ) {
     $content .= '<p>Mast Image: <br /> Size to 1500x900.</p>';
   }

	 else {
     //$content .= '<p>Size to 1500x900px.<br/>';
		 $content .= '<p>Mast Image: <br /> Size to 1500x900.</p>';
   }

   return $content;
 }

 function login_logo() {
   add_filter( 'login_message', function( $message ) {
     $svg = get_svg('brand-logo');
     return $svg;
   });
 }


 function body_class(){
   global $post;

   if ( !is_object($post) ) return;

   setup_postdata( $post );

   // Returns an object that includes the screen’s ID, base, post type, taxonomy
   // @see https://developer.wordpress.org/reference/functions/get_current_screen
   $screen = get_current_screen();
   $post_id = 'admin-post-'.$post->ID;
   $page_name = 'admin-'.$post->post_name;
   $page_template = $page_name;
   $classes = '';
   $classes = ' ' . $screen->post_type . ' ' . $post_id . ' ' . $page_name . '';

   // Had issues returning page template name, so...
   if (basename( get_page_template() ) === 'page.php' ){
     $classes .= ' admin-page-template-default';
   }

   return $classes;
   wp_reset_postdata( $post );
 }
}

JumpoffAdminSetup::init();
