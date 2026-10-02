<?php
/**
 * Coworking Interface Sticky Header Settings section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Sticky_Header' ) ) :
	/**
	 * Coworking Interface Sticky Header section in Customizer.
	 */
	class Coworking_Interface_Customizer_Sticky_Header {

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

			// Sticky Header Section.
			$options['section']['coworking_interface_section_sticky_header'] = array(
				'title'    => esc_html__( 'Sticky Header', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_header',
				'priority' => 80,
			);

			// Enable Transparent Header.
			$options['setting']['coworking_interface_sticky_header'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-toggle',
					'label'   => esc_html__( 'Enable Sticky Header', 'coworking-interface' ),
					'section' => 'coworking_interface_section_sticky_header',
				),
			);

			// Responsive heading.
			$options['setting']['coworking_interface_sticky_header_responsive'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'section'  => 'coworking_interface_section_sticky_header',
					'label'    => esc_html__( 'Responsive', 'coworking-interface' ),
					'required' => array(
						array(
							'control'  => 'coworking_interface_sticky_header',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Hide sticky header on.
			$options['setting']['coworking_interface_sticky_header_hide_on'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_checkbox_group',
				'control'           => array(
					'type'        => 'coworking-interface-checkbox-group',
					'label'       => esc_html__( 'Hide on: ', 'coworking-interface' ),
					'description' => esc_html__( 'Choose on which devices to hide Sticky Header on. ', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_sticky_header',
					'choices'     => coworking_interface_get_device_choices(),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_sticky_header',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_sticky_header_responsive',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			return $options;
		}
	}
endif;
new Coworking_Interface_Customizer_Sticky_Header();
