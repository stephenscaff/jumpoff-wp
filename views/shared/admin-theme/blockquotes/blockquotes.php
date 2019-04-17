<?php
/**
 * TinyMCE Blockquotes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Better Blockquotes
 *
 * @since 1.0.0
 */
class TinyBlockquotes {

	const VERSION = '1.0.0';

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function init() {

		// Translations used by javascript loaded with this plugin
		add_action( 'admin_enqueue_scripts', array( $this, 'js_settings' ) );

		// Loads the buttons if user has permissions
		add_action( 'admin_head', array( $this, 'tinyMCE_button_init' ) );
	}


	/**
	 * Localization for the tinymce-email-button.js file
	 *
	 * @return void
	 */
	public function js_settings() {

		wp_localize_script( 'editor', 'tiny_blockquotes', array(
			'add_blockquote' => 'Add Blockquote',
			'blockquote'     => 'Blockquote',
			'quote'          => 'Quote',
			'citation'       => 'Citation',
			'citation_link'  => 'Citation Link',
			'class'          => 'class',
			'class_options'  => apply_filters( 'tinyblockquotes_classes', false )
		) );

	}

	/**
	 * TinyMCE Button Init
	 *
	 * @return void
	 */
	public function tinyMCE_button_init() {

		// Exit if user can't edit posts
		if ( ! current_user_can( 'edit_posts') && ! current_user_can( 'edit_pages' ) ) {
   			return;
    	}

		// Exit if rich editing is not enable
    if ( 'true' != get_user_option( 'rich_editing' ) ) return;


		add_filter( 'mce_buttons', array( $this, 'register_tinyMCE_button' ) );
		add_filter( 'mce_external_plugins', array( $this, 'add_tinyMCE_plugin' ) );

	}

	/**
	 * Loads the javascript required for the custom TinyMCE button
	 *
	 * @return array TinyMCE buttons
	 */
	function add_tinyMCE_plugin( $plugin_array ) {

	   	$plugin_array['tiny_blockquote'] =  get_template_directory_uri() . '/inc/admin/blockquotes/blockquotes.js';
	   	return $plugin_array;

	}

	/**
	 * Adds the button to TinyMCE
	 *
	 * @since 1.0.0
	 */
	function register_tinyMCE_button( $buttons ) {

		// Removes the default blockquote button
		if ( false !== ( $key = array_search( 'blockquote', $buttons ) ) ) {
			unset( $buttons[$key] );
		}

	   // Add the custom blockquotes button
	   array_push( $buttons, 'tiny_blockquote' );

	   return $buttons;
	}
}

new TinyBlockquotes;
