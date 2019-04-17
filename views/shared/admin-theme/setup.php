<?php

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Jumpoff Admin Setup
 * Variety admin specific directives and settings.
 */
class AdminThemeSetup {

	public static $instance;

  /**
   * Init
   */
	public static function init() {
		if ( is_null( self::$instance ) )
			self::$instance = new AdminThemeSetup();
		return self::$instance;
	}

  /**
   * SetUp Constructor
   */
	private function __construct() {
    add_action( 'admin_enqueue_scripts', array( $this, 'load_styles' ) );
    add_action( 'login_enqueue_scripts', array ( $this, 'load_styles' ) );
		add_action( 'wp_before_admin_bar_render', array( $this, 'admin_bar' ) );
    add_filter( 'menu_order', array( $this, 'menu_order' ) );
    add_filter( 'custom_menu_order', array( $this, 'menu_order' ) );
    add_filter( 'admin_body_class', array( $this, 'body_class' ) );
    add_filter( 'admin_footer_text', array( $this,  'admin_footer' ) );
    add_filter( 'admin_post_thumbnail_html', array( $this, 'ft_img_size_hints' ) );
		add_action(	'admin_head', array($this, 'hide_editor' ));
    $this->login_logo();
		$this->disable_gutenberg();
		$this->no_front_adminbar();
	}

  /**
   * Load styles
	 * Include a gulp task to compile assets/scss/admin.scss to assets/css/admin.min.css
   */
  function load_styles(){
    wp_enqueue_style('admin', get_template_directory_uri() . '/inc/admin-theme/admin-styles/assets/css/admin.min.css', false );
  }

	/**
	 * Disable GutenBerg
	 * Removes Gutenberg in favor of custom acf modules system
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
  * Order Menu Items
	* Example of defining menu order with default Items
	* Custom Post Types, and options table additions.
  */
 function menu_order($menu_order){
   if ( !$menu_order ) return true;

   return array(
     'index.php',
     'upload.php',
     'contacts',
     'edit.php',
     'edit.php?post_type=team',
     'edit.php?post_type=page',
     'edit.php',
     'edit.php?post_type=career',
     'users.php',
     'plugins.php',
     'tools.php',
     'options-general.php',
     'themes.php',
   );
 }

 /**
	* Hide Content Editors
	* Example method of removing content editor for
	* module-driven pages.
	*/
	function hide_editor() {
	 if (
		 is_template('templates/modules.php') OR
		 is_template('templates/about.php')

	 ) {
		 remove_post_type_support('page', 'editor');
	 }
	}

 /**
  * Admin Footer Message
  */
 function admin_footer(){
   return '<span id="footer-thankyou">Developed by <a href="http://urbaninfluence.com" target="_blank">Urban Influence</a></span>';
 }

 /**
	* Login screen logo svg
	* Adds a custom logo SVG
	*/
	function login_logo() {
		add_filter( 'login_message', function( $message ) {
			$svg = jumpoff_get_svg('brand-logo');
			return $svg;
		});
	}

 /**
  * Featured Image Meta Hints
	* Adding image size hints across various locations
	* Follow format for post types
  */
 function ft_img_size_hints( $content ) {
   global $post_type;

	 // Team Post Type
   if ( 'team' == $post_type ) {
     $content .= '<p>Headshot Image: <br /> Size to 550x550</p>';
   }

	 // Pages
	 elseif ( 'page' == $post_type ) {
     $content .= '<p>Featured Image: <br /> Size to 1500x900.</p>';
   }

	 // Posts
	 elseif ( 'post' == $post_type ) {
     $content .= '<p>Mast Image: <br /> Size to 1500x900.</p>';
   }

	 // Fallback
   else {
     //$content .= '<p>Size to 1500x900px.<br/>';
		 $content .= '<p>Mast Image: <br /> Size to 1500x900.</p>';
   }

   return $content;
 }


	/**
	 * Admin body class
	 */
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

AdminThemeSetup::init();
