<?php
/**
 * Template part for displaying media of the entry.
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

$coworking_interface_post_format = get_post_format();

if ( is_single() ) {
	$coworking_interface_post_format = '';
}

do_action( 'coworking_interface_before_entry_thumbnail' );

get_template_part( 'template-parts/entry/format/media', $coworking_interface_post_format );

do_action( 'coworking_interface_after_entry_thumbnail' );
