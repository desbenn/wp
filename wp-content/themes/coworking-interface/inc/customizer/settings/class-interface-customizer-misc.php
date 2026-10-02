<?php
/**
 * Coworking Interface Misc section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Misc' ) ) :
	/**
	 * Coworking Interface Misc section in Customizer.
	 */
	class Coworking_Interface_Customizer_Misc {

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
			$options['section']['coworking_interface_section_misc'] = array(
				'title'    => esc_html__( 'Misc Settings', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_general',
				'priority' => 60,
			);

			// Schema toggle.
			$options['setting']['coworking_interface_enable_schema'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-toggle',
					'label'       => esc_html__( 'Schema Markup', 'coworking-interface' ),
					'description' => esc_html__( 'Add structured data to your content.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_misc',
				),
			);

			// Custom form styles.
			$options['setting']['coworking_interface_custom_input_style'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-toggle',
					'label'       => esc_html__( 'Custom Form Styles', 'coworking-interface' ),
					'description' => esc_html__( 'Custom design for checkboxes and radio buttons.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_misc',
				),
			);

			// Page Preloader heading.
			$options['setting']['coworking_interface_preloader_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Page Preloader', 'coworking-interface' ),
					'section' => 'coworking_interface_section_misc',
				),
			);

			// Enable/Disable Page Preloader.
			$options['setting']['coworking_interface_preloader'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-toggle',
					'label'       => esc_html__( 'Enable Page Preloader', 'coworking-interface' ),
					'description' => esc_html__( 'Show animation until page is fully loaded.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_misc',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_preloader_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Preloader visibility.
			$options['setting']['coworking_interface_preloader_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Device Visibility', 'coworking-interface' ),
					'description' => esc_html__( 'Devices where Page Preloader is displayed.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_misc',
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'coworking-interface' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'coworking-interface' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'coworking-interface' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_preloader_heading',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_preloader',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Scroll Top heading.
			$options['setting']['coworking_interface_scroll_top_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Scroll Top Button', 'coworking-interface' ),
					'section' => 'coworking_interface_section_misc',
				),
			);

			// Enable/Disable Scroll Top.
			$options['setting']['coworking_interface_enable_scroll_top'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-toggle',
					'label'       => esc_html__( 'Enable Scroll Top Button', 'coworking-interface' ),
					'description' => esc_html__( 'A sticky button that allows users to easily return to the top of a page.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_misc',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_scroll_top_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Scroll Top device visibility.
			$options['setting']['coworking_interface_scroll_top_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Device Visibility', 'coworking-interface' ),
					'description' => esc_html__( 'Devices where the button is displayed.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_misc',
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'coworking-interface' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'coworking-interface' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'coworking-interface' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_scroll_top',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_scroll_top_heading',
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
new Coworking_Interface_Customizer_Misc();
