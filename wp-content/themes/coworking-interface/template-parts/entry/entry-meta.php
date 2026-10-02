<?php
/**
 * Template part for displaying entry meta info.
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

/**
 * Only show meta tags for posts.
 */
if ( ! in_array( get_post_type(), (array) apply_filters( 'coworking_interface_entry_meta_post_type', array( 'post' ) ), true ) ) {
	return;
}

do_action( 'coworking_interface_before_entry_meta' );

// Get meta items to be displayed.
$coworking_interface_meta_elements = coworking_interface_get_entry_meta_elements();

if ( ! empty( $coworking_interface_meta_elements ) ) {

	echo '<div class="entry-meta"><div class="entry-meta-elements">';

	do_action( 'coworking_interface_before_entry_meta_elements' );

	// Loop through meta items.
	foreach ( $coworking_interface_meta_elements as $coworking_interface_meta_item ) {

		// Call a template tag function.
		if ( function_exists( 'coworking_interface_entry_meta_' . $coworking_interface_meta_item ) ) {
			call_user_func( 'coworking_interface_entry_meta_' . $coworking_interface_meta_item );
		}
	}

	// Add edit post link.
	$coworking_interface_edit_icon = coworking_interface()->icons->get_meta_icon( 'edit', coworking_interface()->icons->get_svg( 'edit-3', array( 'aria-hidden' => 'true' ) ) );

	coworking_interface_edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				$coworking_interface_edit_icon . __( 'Edit <span class="screen-reader-text">%s</span>', 'coworking-interface' ),
				coworking_interface_get_allowed_html_tags()
			),
			esc_html( get_the_title() )
		),
		'<span class="edit-link">',
		'</span>'
	);

	do_action( 'coworking_interface_after_entry_meta_elements' );

	echo '</div></div>';
}

do_action( 'coworking_interface_after_entry_meta' );
