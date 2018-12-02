<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Allow VCard (VCF) uploads
 * Adds the 'vcf' mime type to WP's approved upload
 * formats using wp's upload_mimes filter.
 */
add_filter('upload_mimes', 'allow_vcard_uploads');

function allow_vcard_uploads( $mime_types ){
  $mime_types['vcf'] = 'text/x-vcard';
  return $mime_types;
}

/**
 * vCard Directory
 * Save Professional vCard uploads to their own directory
 * Field: professional_vcard
 * Dir:  '/professionals/vcards'
 */
add_filter('acf/upload_prefilter/name=professional_vcard',

  function($errors, $file, $field) {
    add_filter('upload_dir', 'vcf_upload_dir');
  }, 10, 3
);

function vcf_upload_dir( $param ){
  $dir = '/professionals/vcards';
  $param['path'] = $param['basedir'] . $dir;
  $param['url'] = $param['baseurl'] . $dir;

  return $param;
}

/**
 * Professional BIO PDFs
 * Save Professional BIO PDF uploads to their own directory
 * Field: professional_bio_pdf
 * Dir:  '/professionals/vcards'
 */
add_filter('acf/upload_prefilter/name=professional_bio_pdf',

  function($errors, $file, $field) {
    add_filter('upload_dir', 'bio_upload_dir');
  }, 10, 3
);

function bio_upload_dir( $param ){
  $dir = '/professionals/bio_pdfs';
  $param['path'] = $param['basedir'] . $dir;
  $param['url'] = $param['baseurl'] . $dir;

  return $param;
}
