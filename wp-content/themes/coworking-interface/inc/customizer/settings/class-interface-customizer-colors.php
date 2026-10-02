<?php
/**
 * Coworking Interface Base Colors section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Colors' ) ) :
	/**
	 * Coworking Interface Colors section in Customizer.
	 */
	class Coworking_Interface_Customizer_Colors {

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
			$options['section']['coworking_interface_section_colors'] = array(
				'title'    => esc_html__( 'Base Colors', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_general',
				'priority' => 20,
			);

			// Accent color.
			$options['setting']['coworking_interface_accent_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_color',
				'control'           => array(
					'type'        => 'coworking-interface-color',
					'label'       => esc_html__( 'Accent Color', 'coworking-interface' ),
					'description' => esc_html__( 'The accent color is used subtly throughout your site, to call attention to key elements.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_colors',
					'priority'    => 10,
					'opacity'     => false,
				),
			);

			// Body background heading.
			$options['setting']['coworking_interface_body_background_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'priority' => 40,
					'label'    => esc_html__( 'Body Background', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_colors',
					'toggle'   => false,
				),
			);

			// Content background heading.
			$options['setting']['coworking_interface_content_colors_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'priority' => 50,
					'label'    => esc_html__( 'Content', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_colors',
					'toggle'   => false,
				),
			);

			// Content text color.
			$options['setting']['coworking_interface_content_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_color',
				'control'           => array(
					'type'     => 'coworking-interface-color',
					'label'    => esc_html__( 'Text Color', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_colors',
					'priority' => 50,
					'opacity'  => true,
				),
			);

			// Content text color.
			$options['setting']['coworking_interface_content_link_hover_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_color',
				'control'           => array(
					'type'        => 'coworking-interface-color',
					'label'       => esc_html__( 'Link Hover Color', 'coworking-interface' ),
					'description' => esc_html__( 'This only applies to entry content area, other links will use the accent color on hover.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_colors',
					'priority'    => 50,
					'opacity'     => true,
				),
			);

			// Headings color.
			$options['setting']['coworking_interface_headings_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_color',
				'control'           => array(
					'type'     => 'coworking-interface-color',
					'label'    => esc_html__( 'Headings Color', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_colors',
					'priority' => 50,
					'opacity'  => true,
				),
			);

			// Content background color.
			$options['setting']['coworking_interface_boxed_content_background_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_color',
				'control'           => array(
					'type'        => 'coworking-interface-color',
					'label'       => esc_html__( 'Boxed Content - Background Color', 'coworking-interface' ),
					'description' => esc_html__( 'Only used if Site Layout is Boxed or Boxed Content.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_colors',
					'priority'    => 50,
					'opacity'     => true,
				),
			);

			return $options;
		}

	}
endif;
new Coworking_Interface_Customizer_Colors();
