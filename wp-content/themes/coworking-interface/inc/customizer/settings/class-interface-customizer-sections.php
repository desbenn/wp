<?php
/**
 * Coworking Interface Customizer sections and panels.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Sections' ) ) :
	/**
	 * Coworking Interface Customizer sections and panels.
	 */
	class Coworking_Interface_Customizer_Sections {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			/**
			 * Registers our custom panels in Customizer.
			 */
			add_filter( 'coworking_interface_customizer_options', array( $this, 'register_panel' ) );
		}

		/**
		 * Registers our custom options in Customizer.
		 *
		 * @since 1.0.0
		 * @param array $options Array of customizer options.
		 */
		public function register_panel( $options ) {

			// General panel.
			$options['panel']['coworking_interface_panel_general'] = array(
				'title'    => esc_html__( 'General Settings', 'coworking-interface' ),
				'priority' => 1,
			);

			// Header panel.
			$options['panel']['coworking_interface_panel_header'] = array(
				'title'    => esc_html__( 'Header', 'coworking-interface' ),
				'priority' => 3,
			);

			// Footer panel.
			$options['panel']['coworking_interface_panel_footer'] = array(
				'title'    => esc_html__( 'Footer', 'coworking-interface' ),
				'priority' => 5,
			);

			// Blog settings.
			$options['panel']['coworking_interface_panel_blog'] = array(
				'title'    => esc_html__( 'Blog', 'coworking-interface' ),
				'priority' => 6,
			);

			return $options;
		}
	}
endif;
new Coworking_Interface_Customizer_Sections();
