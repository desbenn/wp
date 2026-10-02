<?php
/**
 * Enqueue scripts & styles.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

/**
 * Enqueue and register scripts and styles.
 *
 * @since 1.0.0
 */
function coworking_interface_enqueues()
{

	// Script debug.
	$coworking_interface_suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

	// RTL version.
	$coworking_interface_rtl = is_rtl() ? '-rtl' : '';

	// Enqueue theme stylesheet.
	wp_enqueue_style(
		'coworking-interface-styles',
		COWORKING_INTERFACE_URI . '/assets/css/style' . $coworking_interface_rtl . $coworking_interface_suffix . '.css',
		false,
		COWORKING_INTERFACE_VERSION,
		'all'
	);

	// Register ImagesLoaded library.
	wp_register_script(
		'coworking-interface-imagesloaded',
		COWORKING_INTERFACE_URI . '/assets/js/vendors/imagesloaded' . $coworking_interface_suffix . '.js',
		array(),
		'4.1.4',
		true
	);

	// Register Coworking Interface slider.
	wp_register_script(
		'coworking-interface-slider-js',
		COWORKING_INTERFACE_URI . '/assets/js/slider' . $coworking_interface_suffix . '.js',
		array('coworking-interface-imagesloaded'),
		COWORKING_INTERFACE_VERSION,
		true
	);

	// Load comment reply script if comments are open.
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Enqueue main theme script.
	wp_enqueue_script(
		'coworking-interface-script-js',
		COWORKING_INTERFACE_URI . '/assets/js/script' . $coworking_interface_suffix . '.js',
		array(),
		COWORKING_INTERFACE_VERSION,
		true
	);

	// Comment count used in localized strings.
	$comment_count = get_comments_number();

	// Localized variables so they can be used for translatable strings.
	$localized = array(
		'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
		'nonce' => wp_create_nonce('coworking-interface-nonce'),
		'responsive-breakpoint' => intval(coworking_interface_option('main_nav_mobile_breakpoint')),
		'sticky-header' => array(
			'enabled' => coworking_interface_option('sticky_header'),
			'hide_on' => coworking_interface_option('sticky_header_hide_on'),
		),
		'strings' => array(
			/* translators: %s Comment count */
			'comments_toggle_show' => $comment_count > 0 ? esc_html(sprintf(_n('Show %s Comment', 'Show %s Comments', $comment_count, 'coworking-interface'), $comment_count)) : esc_html__('Leave a Comment', 'coworking-interface'),
			'comments_toggle_hide' => esc_html__('Hide Comments', 'coworking-interface'),
		),
	);

	wp_localize_script(
		'coworking-interface-script-js',
		'coworking_interface_vars',
		apply_filters('coworking_interface_localized', $localized)
	);

	// Enqueue google fonts.
	coworking_interface()->fonts->enqueue_google_fonts();

	// Add additional theme styles.
	do_action('coworking_interface_enqueue_scripts');
}
add_action('wp_enqueue_scripts', 'coworking_interface_enqueues');

/**
 * Enqueue assets for the Block Editor.
 *
 * @since 1.0.0
 *
 * @return void
 */
function coworking_interface_block_editor_assets()
{

	// RTL version.
	$rtl = is_rtl() ? '-rtl' : '';

	// Minified version.
	$min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

	// Enqueue block editor styles.
	wp_enqueue_style(
		'coworking-interface-block-editor-styles',
		COWORKING_INTERFACE_URI . '/inc/admin/assets/css/block-editor-styles' . $rtl . $min . '.css',
		false,
		COWORKING_INTERFACE_VERSION,
		'all'
	);

	// Enqueue google fonts.
	coworking_interface()->fonts->enqueue_google_fonts();

	// Add dynamic CSS as inline style.
	wp_add_inline_style(
		'coworking-interface-block-editor-styles',
		apply_filters('coworking_interface_block_editor_dynamic_css', coworking_interface_dynamic_styles()->get_block_editor_css())
	);
}
add_action('enqueue_block_editor_assets', 'coworking_interface_block_editor_assets');
