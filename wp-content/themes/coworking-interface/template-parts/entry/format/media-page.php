<?php
/**
 * Template part for displaying page featured image.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get default post media.
$coworking_interface_media = coworking_interface_get_post_media( '' );

if ( ! $coworking_interface_media || post_password_required() ) {
	return;
}

$coworking_interface_media = apply_filters( 'coworking_interface_post_thumbnail', $coworking_interface_media, get_the_ID() );

$coworking_interface_classes = array( 'post-thumb', 'entry-media', 'thumbnail' );

$coworking_interface_classes = apply_filters( 'coworking_interface_post_thumbnail_wrapper_classes', $coworking_interface_classes, get_the_ID() );
$coworking_interface_classes = trim( implode( ' ', array_unique( $coworking_interface_classes ) ) );

// Print the post thumbnail.
echo wp_kses_post(
	sprintf(
		'<div class="%2$s">%1$s</div>',
		$coworking_interface_media,
		esc_attr( $coworking_interface_classes )
	)
);
