<?php
/**
 * Template part for displaying entry thumbnail (featured image).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
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

$coworking_interface_post_format = get_post_format();

// Wrap with link for non-singular pages.
if ( 'link' === $coworking_interface_post_format || ! is_single( get_the_ID() ) ) {

	$coworking_interface_icon = '';

	if ( is_sticky() ) {
		$coworking_interface_icon = sprintf(
			'<span class="entry-media-icon" title="%1$s" aria-hidden="true"><span class="entry-media-icon-wrapper">%2$s%3$s</span></span>',
			esc_attr__( 'Featured', 'coworking-interface' ),
			coworking_interface()->icons->get_svg(
				'star',
				array(
					'class'       => 'top-icon',
					'aria-hidden' => 'true',
				)
			),
			coworking_interface()->icons->get_svg( 'star', array( 'aria-hidden' => 'true' ) )
		);
	} elseif ( 'video' === $coworking_interface_post_format ) {
		$coworking_interface_icon = sprintf(
			'<span class="entry-media-icon" aria-hidden="true"><span class="entry-media-icon-wrapper">%1$s%2$s</span></span>',
			coworking_interface()->icons->get_svg(
				'play',
				array(
					'class'       => 'top-icon',
					'aria-hidden' => 'true',
				)
			),
			coworking_interface()->icons->get_svg( 'play', array( 'aria-hidden' => 'true' ) )
		);
	} elseif ( 'link' === $coworking_interface_post_format ) {
		$coworking_interface_icon = sprintf(
			'<span class="entry-media-icon" title="%1$s" aria-hidden="true"><span class="entry-media-icon-wrapper">%2$s%3$s</span></span>',
			esc_url( coworking_interface_entry_get_permalink() ),
			coworking_interface()->icons->get_svg(
				'external-link',
				array(
					'class'       => 'top-icon',
					'aria-hidden' => 'true',
				)
			),
			coworking_interface()->icons->get_svg( 'external-link', array( 'aria-hidden' => 'true' ) )
		);
	}

	$coworking_interface_icon = apply_filters( 'coworking_interface_post_format_media_icon', $coworking_interface_icon, $coworking_interface_post_format );

	$coworking_interface_media = sprintf(
		'<a href="%1$s" class="entry-image-link">%2$s%3$s</a>',
		esc_url( coworking_interface_entry_get_permalink() ),
		$coworking_interface_media,
		$coworking_interface_icon
	);
}

$coworking_interface_media = apply_filters( 'coworking_interface_post_thumbnail', $coworking_interface_media );

// Print the post thumbnail.
echo wp_kses(
	sprintf(
		'<div class="post-thumb entry-media thumbnail">%1$s</div>',
		$coworking_interface_media
	),
	coworking_interface_get_allowed_html_tags()
);
