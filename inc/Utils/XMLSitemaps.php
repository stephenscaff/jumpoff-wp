<?php
/**
 * SImple Sitemap XML Class generator
 * Just a simple singleton, as no need for reuse.
 */
class SitemapXML{

  /**
   * @var SitemapXML
   */
  public static $instance;

  /**
   * @return SitemapXML
   */
  public static function init() {

   if ( is_null( self::$instance ) )
     self::$instance = new SitemapXML();

   return self::$instance;
  }

  private function __construct(){
    add_action( 'save_post', array( $this, 'create' ));
  }

  /**
   * Build Sitemap XML
   * @return {xmlBlob} $sitemap - sitemap xml from post types
   */
  function build() {

    $sitemap_posts = get_posts( array(
        'numberposts' => -1,
        'orderby'     => 'modified',
        'post_type'   => array(
          'post', 'page',
          'market_reports',
          'office_location',
          'press_release',
          'service',
          'success_story',
          'team',
          'professional'
        ),
        'order'       => 'DESC'
    ) );
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
    $sitemap .= "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    //
    foreach( $sitemap_posts as $post ) {
        setup_postdata( $post );

        //$priority_level = 8.0;
        $postdate = explode( " ", $post->post_modified );
        $sitemap .= "\t" . '<url>' . "\n" .
            "\t\t" . '<loc>' . get_permalink( $post->ID ) . '</loc>' .
            "\n\t\t" . '<lastmod>' . $postdate[0] . '</lastmod>' .
            "\n\t\t" . '<changefreq>monthly</changefreq>' .
            "\n\t\t" . '<priority>1.0</priority>' .
            "\n\t" . '</url>' . "\n";
    }
    $sitemap .= '</urlset>';

    // Write file
    $fp = fopen( ABSPATH . "sitemap.xml", 'w' );
    fwrite( $fp, $sitemap );
    fclose( $fp );

    return $sitemap;
  }

  function create() {
    $xml = $this->build();

    $fp = fopen( ABSPATH . "sitemap.xml", 'w' );
    fwrite( $fp, $xml );
    fclose( $fp );
  }
}

SitemapXML::init();
