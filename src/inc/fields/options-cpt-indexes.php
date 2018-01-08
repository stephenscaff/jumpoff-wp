<?php
/**
 *   SEO Metas Fields
 *   For more traditional paginations
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'options_contacts' );

function options_contacts() {
  Container::make( 'theme_options', 'Contacts' )
    ->set_icon( 'dashicons-phone' )
    ->add_fields( array(
        Field::make( 'text', 'contact_phone' )
        ->set_width( 50 ),
        Field::make( 'text', 'contact_email' )
        ->set_width( 50 ),
        Field::make( 'text', 'contact_instagram' )
        ->set_width( 50 ),
        Field::make( 'text', 'contact_twitter' )
        ->set_width( 50 ),
    ) );
}
