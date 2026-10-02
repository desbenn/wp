<?php
/**
 * Coworking Interface compatibility class for Elementor.
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

namespace Elementor; // phpcs:ignore

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if Elementor not active.
if ( ! class_exists( '\Elementor\Plugin' ) ) {
	return;
}

if ( ! class_exists( 'Coworking_Interface_Elementor' ) ) :

	/**
	 * Elementor compatibility.
	 */
	class Coworking_Interface_Elementor {

		/**
		 * Singleton instance of the class.
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 * Instance.
		 *
		 * @since 1.0.0
		 * @return Coworking_Interface_Elementor
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Coworking_Interface_Elementor ) ) {
				self::$instance = new Coworking_Interface_Elementor();
			}
			return self::$instance;
		}

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function __construct() {

			// Enqueue Elementor editor styles.
			add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_editor_style' ) );

			// Setup postdata for Elementor pages.
			add_action( 'wp', array( $this, 'setup_postdata' ), 1 );
			add_action( 'elementor/preview/init', array( $this, 'setup_postdata' ), 5 );

			// Enqueue additional Elementor styles.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_additional' ) );

			// Hide page header for Elementor pages.
			add_filter( 'coworking_interface_is_page_header_displayed', array( $this, 'hide_page_header' ), 10, 2 );
		}

		/**
		 * Editor stylesheet.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_editor_style() {

			// Script debug.
			$coworking_interface_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_style(
				'coworking-interface-elementor-editor',
				COWORKING_INTERFACE_URI . '/assets/css/compatibility/elementor-editor-style' . $coworking_interface_suffix . '.css',
				false,
				COWORKING_INTERFACE_VERSION,
				'all'
			);
		}

		/**
		 * Setup default postdata for Elementor pages.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function setup_postdata() {

			// Page builder compatibility disabled.
			if ( ! coworking_interface_enable_page_builder_compatibility() ) {
				return;
			}

			// Skip posts.
			if ( 'post' === get_post_type() ) {
				return;
			}

			// Don't modify postdata if we are not on Elementor's edit page.
			if ( ! $this->is_elementor_editor() ) {
				return;
			}

			global $post;

			$id = coworking_interface_get_the_id();

			$setup = get_post_meta( $id, '_coworking_interface_page_builder_setup', true );

			if ( isset( $post ) && empty( $setup ) && ( is_admin() || is_singular() ) && empty( $post->post_content ) && $this->is_built_with_elementor( $id ) ) {

				update_post_meta( $id, '_coworking_interface_page_builder_setup', true );
				update_post_meta( $id, 'coworking_interface_disable_page_title', true );
				update_post_meta( $id, 'coworking_interface_disable_breadcrumbs', true );
				update_post_meta( $id, 'coworking_interface_disable_thumbnail', true );
				update_post_meta( $id, 'coworking_interface_sidebar_position', 'no-sidebar' );

				update_post_meta( $id, '_wp_page_template', 'page-templates/template-coworking-interface-fullwidth.php' );
			}

		}

		/**
		 * Additional Elementor styles.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_additional() {

			// Script debug.
			$coworking_interface_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

            // RTL version.
            $coworking_interface_rtl = is_rtl() ? '-rtl' : '';

			// Enqueue theme stylesheet.
			wp_enqueue_style(
				'coworking-interface-elementor',
				COWORKING_INTERFACE_URI . '/assets/css/compatibility/elementor' . $coworking_interface_rtl . $coworking_interface_suffix . '.css',
				false,
				COWORKING_INTERFACE_VERSION,
				'all'
			);
		}

		/**
		 * Check if page is built with elementor.
		 *
		 * @param int $id Post/Page Id.
		 * @since 1.0.0
		 *
		 * @return boolean
		 */
		public function is_built_with_elementor( $id ) {
			if ( version_compare( ELEMENTOR_VERSION, '1.5.0', '<' ) ) {
				return ( 'builder' === Plugin::$instance->db->get_edit_mode( $id ) );
			} else {
				return Plugin::$instance->db->is_built_with_elementor( $id );
			}
		}

		/**
		 * Check if Elementor Editor is loaded.
		 *
		 * @since 1.0.0
		 *
		 * @return boolean Elementor editor is loaded.
		 */
		private function is_elementor_editor() {
			return ( isset( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] ) || isset( $_REQUEST['elementor-preview'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}

		/**
		 * Hide page header for pages built with Elementor.
		 *
		 * @since 1.0.0
		 * @param boolean $displayed Whether the page header is displayed.
		 * @param int     $post_id   The post ID.
		 * @return boolean
		 */
		public function hide_page_header( $displayed, $post_id ) {

			// If page header is already hidden, return early.
			if ( ! $displayed ) {
				return $displayed;
			}

			// Check if current page is built with Elementor.
			if ( $this->is_built_with_elementor( $post_id ) ) {
				return false;
			}

			return $displayed;
		}
	}

endif;

/**
 * Returns the one Coworking_Interface_Elementor instance.
 */
function coworking_interface_elementor() {
	return Coworking_Interface_Elementor::instance();
}

coworking_interface_elementor();
