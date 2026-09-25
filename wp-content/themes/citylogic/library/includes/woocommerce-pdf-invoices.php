<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wpo_wcpdf_custom_styles', 'otb_wcpdf_load_theme_styles', 10, 2 );

function otb_wcpdf_load_theme_styles( $document_type, $document ) {
	$css_file = get_template_directory() . '/library/css/woocommerce-pdf-invoices.css';

	if ( file_exists( $css_file ) ) {
        echo wp_strip_all_tags( file_get_contents( $css_file ), true );
	}
}
