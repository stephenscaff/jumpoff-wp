<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 * Editor Toolbars
 * Class for customizing Wp Editor Toolbars, for
 * Visual (TinyMCE), Text (Qtags) and ACF toolbars
 */
class AdminEditors {

  /**
   * @var AdminEditors
   */
  public static $instance;

  /**
   * @return AdminEditors
   */
  public static function init() {
   if ( is_null( self::$instance ) )
     self::$instance = new AdminEditors();
   return self::$instance;
  }


  private function __construct(){
    add_action( 'admin_print_footer_scripts', array( $this, 'text_editor_toolbar' ), 999 );
    add_filter( 'tiny_mce_before_init', array( $this, 'visual_editor_toolbar' ));
    add_filter('acf/fields/wysiwyg/toolbars' , array( $this, 'acf_toolbar') );
    add_action( 'admin_init', array($this, 'hide_editor' ));
  }

  /**
   * Text Editor Toolbar
   * Used qtags editor
   */
  function text_editor_toolbar(){
    ?>
    <script type="text/javascript">
      QTags.addButton( 'h3-title', 'Title', '<h3>', '</h3>', '3', 'Title', 1 );
      QTags.addButton( 'h4-subtitle', 'Subtitle', '<h4>', '</h4>', '4', 'Subtitle', 1 );
      QTags.addButton( 'p-small', 'Small', '<p class="font-sm">', '</p>', '7', 'Small', 1 );
      QTags.addButton( 'hr-sep', 'Seperator', '<hr class="sep is-centered"/>', '', 's', 'Seperator', 202 );
    </script>
    <?php
  }

  /**
   * Visual Editor Toolbar
   * Used Tiny MCE
   */
  function visual_editor_toolbar($toolbar){
    $toolbar['block_formats'] = "Title=h3; Subtitle=h4; Paragraph=p; Small=small";
    $toolbar['toolbar1'] = 'formatselect,bold,italic,small,bullist,numlist,blockquote,hr,alignleft,link,unlink,spellchecker,pastetext,removeformat,plyr,wp_fullscreen';
    $toolbar['toolbar2'] = '';

    return $toolbar;
  }

  /**
   * ACF Toolbars
   * For the ACF editor field.
   */
  function acf_toolbar( $toolbar ){
    $toolbar['Full'] = array();
    $toolbar['Full'][1] = array('formatselect', 'bold', 'italic', 'underline', 'alignleft', 'aligncenter', 'blockquote', 'hr', 'bullist', 'numlist', 'removeformat', );
    $toolbar['Full'][2] = array();

    // remove the 'Basic' toolbar completely (if you want)
    unset( $toolbar['Basic' ] );

    return $toolbar;
  }

  /**
   * Hide COntent Editor
   */
  function hide_editor() {
    $post_id = isset($_GET['post']) ? $_GET['post'] : isset($_POST['post_ID']);
    if ( !$post_id )   return;
    $title = get_the_title($post_id);

    if ( in_array($title, array('Home', 'Contact Us', 'About')) ) {
      remove_post_type_support('page', 'editor');
    }
    if ( is_page_template('templates/modules.php')) {
      remove_post_type_support('page', 'editor');
    }
  }
}

AdminEditors::init();
//
//
//
// add_filter( 'mce_buttons', function($buttons) {
//   array_unshift( $buttons, 'styleselect' );
// 	return $buttons;
// });
//
//
// // Attach callback to 'tiny_mce_before_init'
// add_filter( 'tiny_mce_before_init', function($init_array) {
//   // Define the style_formats array
//   $style_formats = array(
//     array(
//       'title' => 'Title',
//       'block' => 'h2',
//     ),
//     array(
//       'title' => 'SubTitle',
//       'block' => 'h4',
//     ),
//     array(
//       'title' => 'Small',
//       'block' => 'sp',
//       'classes' => 'font-sm',
//       'wrapper' => true,
//
//     ),
//   );
//   // Insert the array, JSON ENCODED, into 'style_formats'
//   $init_array['style_formats'] = json_encode( $style_formats );
//
//   return $init_array;
// } );
