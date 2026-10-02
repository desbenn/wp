<?php
/**
 * Coworking Interface Layout section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Layout' ) ) :
	/**
	 * Coworking Interface Layout section in Customizer.
	 */
	class Coworking_Interface_Customizer_Layout {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			/**
			 * Registers our custom options in Customizer.
			 */
			add_filter( 'coworking_interface_customizer_options', array( $this, 'register_options' ) );
		}

		/**
		 * Registers our custom options in Customizer.
		 *
		 * @since 1.0.0
		 * @param array $options Array of customizer options.
		 */
		public function register_options( $options ) {

			// Section.
			$options['section']['coworking_interface_layout_section'] = array(
				'title'    => esc_html__( 'Layout', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_general',
				'priority' => 10,
			);

			// Site layout.
			$options['setting']['coworking_interface_site_layout'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'section'     => 'coworking_interface_layout_section',
					'label'       => esc_html__( 'Site Layout', 'coworking-interface' ),
					'description' => esc_html__( 'Choose your site&rsquo;s main layout.', 'coworking-interface' ),
					'choices'     => array(
						'fw-contained'    => esc_html__( 'Full Width: Contained', 'coworking-interface' ),
						'fw-stretched'    => esc_html__( 'Full Width: Stretched', 'coworking-interface' ),
						'boxed-separated' => esc_html__( 'Boxed Content', 'coworking-interface' ),
						'boxed'           => esc_html__( 'Boxed', 'coworking-interface' ),
					),
				),
			);

			// Container width.
			$options['setting']['coworking_interface_container_width'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_range',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'section'     => 'coworking_interface_layout_section',
					'label'       => esc_html__( 'Content Width', 'coworking-interface' ),
					'description' => esc_html__( 'Change your site&rsquo;s main container width.', 'coworking-interface' ),
					'min'         => 500,
					'max'         => 1920,
					'step'        => 10,
					'unit'        => 'px',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_site_layout',
							'value'    => 'fw-stretched',
							'operator' => '!=',
						),
					),
				),
			);

			return $options;
		}
	}
endif;
new Coworking_Interface_Customizer_Layout();
