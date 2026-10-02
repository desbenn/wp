<?php
/**
 * Coworking Interface Customizer helper functions.
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
 * Returns array of available widgets.
 *
 * @since 1.0.0
 * @return array, $widgets array of available widgets.
 */
function coworking_interface_get_customizer_widgets() {

	$widgets = array(
		'text'    => 'Coworking_Interface_Customizer_Widget_Text',
		'nav'     => 'Coworking_Interface_Customizer_Widget_Nav',
		'socials' => 'Coworking_Interface_Customizer_Widget_Socials',
		'search'  => 'Coworking_Interface_Customizer_Widget_Search',
		'button'  => 'Coworking_Interface_Customizer_Widget_Button',
	);

	return apply_filters( 'coworking_interface_customizer_widgets', $widgets );
}

/**
 * Get choices for "Hide on" customizer options.
 *
 * @since  1.0.0
 * @return array
 */
function coworking_interface_get_display_choices() {

	// Default options.
	$return = array(
		'home'       => array(
			'title' => esc_html__( 'Home Page', 'coworking-interface' ),
		),
		'posts_page' => array(
			'title' => esc_html__( 'Blog / Posts Page', 'coworking-interface' ),
		),
		'search'     => array(
			'title' => esc_html__( 'Search', 'coworking-interface' ),
		),
		'archive'    => array(
			'title' => esc_html__( 'Archive', 'coworking-interface' ),
			'desc'  => esc_html__( 'Dynamic pages such as categories, tags, custom taxonomies...', 'coworking-interface' ),
		),
		'post'       => array(
			'title' => esc_html__( 'Single Post', 'coworking-interface' ),
		),
		'page'       => array(
			'title' => esc_html__( 'Single Page', 'coworking-interface' ),
		),
	);

	// Get additionally registered post types.
	$post_types = get_post_types(
		array(
			'public'   => true,
			'_builtin' => false,
		),
		'objects'
	);

	if ( is_array( $post_types ) && ! empty( $post_types ) ) {
		foreach ( $post_types as $slug => $post_type ) {
			$return[ $slug ] = array(
				'title' => $post_type->label,
			);
		}
	}

	return apply_filters( 'coworking_interface_display_choices', $return );
}

/**
 * Get device choices for "Display on" customizer options.
 *
 * @since  1.2.0
 * @return array
 */
function coworking_interface_get_device_choices() {

	// Default options.
	$return = array(
		'desktop' => array(
			'title' => esc_html__( 'Hide On Desktop', 'coworking-interface' ),
		),
		'tablet' => array(
			'title' => esc_html__( 'Hide On Tablet', 'coworking-interface' ),
		),
		'mobile' => array(
			'title' => esc_html__( 'Hide On Mobile', 'coworking-interface' ),
		),
	);

	return apply_filters( 'coworking_interface_device_choices', $return );
}
