<?php
/**
 * Coworking Interface Base Typography section in Customizer.
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Coworking_Interface_Customizer_Typography' ) ) :
	/**
	 * Coworking Interface Typography section in Customizer.
	 */
	class Coworking_Interface_Customizer_Typography {

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
			$options['section']['coworking_interface_section_typography'] = array(
				'title'    => esc_html__( 'Base Typography', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_general',
				'priority' => 30,
			);

			// HTML base font size.
			$options['setting']['coworking_interface_html_base_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'label'       => esc_html__( 'Base Font Size', 'coworking-interface' ),
					'description' => esc_html__( 'REM base of the root (html) element.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_typography',
					'min'         => 8,
					'max'         => 30,
					'step'        => 1,
					'unit'        => 'px',
					'responsive'  => true,
				),
			);

			// Anti-Aliased Font Smoothing.
			$options['setting']['coworking_interface_font_smoothing'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-toggle',
					'label'       => esc_html__( 'Font Smoothing', 'coworking-interface' ),
					'description' => esc_html__( 'Enable/Disable anti-aliasing font smoothing.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_typography',
				),
			);

			// Headings typography heading.
			$options['setting']['coworking_interface_typography_body_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Body & Content', 'coworking-interface' ),
					'section' => 'coworking_interface_section_typography',
				),
			);

			// Body Font.
			$options['setting']['coworking_interface_body_font'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_typography',
				'control'           => array(
					'type'     => 'coworking-interface-typography',
					'label'    => esc_html__( 'Body Typography', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_typography',
					'display'  => array(
						'font-family'     => array(),
						'font-subsets'    => array(),
						'font-weight'     => array(),
						'font-style'      => array(),
						'text-transform'  => array(),
						'text-decoration' => array(),
						'letter-spacing'  => array(),
						'font-size'       => array(),
						'line-height'     => array(),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_typography_body_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Headings typography heading.
			$options['setting']['coworking_interface_typography_headings_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Headings (H1 - H6)', 'coworking-interface' ),
					'section' => 'coworking_interface_section_typography',
				),
			);

			// Headings default.
			$options['setting']['coworking_interface_headings_font'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_typography',
				'control'           => array(
					'type'     => 'coworking-interface-typography',
					'label'    => esc_html__( 'Headings Default', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_typography',
					'display'  => array(
						'font-family'    => array(),
						'font-subsets'   => array(),
						'font-weight'    => array(),
						'font-style'     => array(),
						'text-transform' => array(),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_typography_headings_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			for ( $i = 1; $i <= 6; $i++ ) {

				$options['setting'][ 'coworking_interface_h' . $i . '_font' ] = array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'coworking_interface_sanitize_typography',
					'control'           => array(
						'type'     => 'coworking-interface-typography',
						/* translators: %s Heading size */
						'label'    => esc_html( sprintf( __( 'H%s', 'coworking-interface' ), $i ) ),
						'section'  => 'coworking_interface_section_typography',
						'display'  => array(
							'font-family'     => array(),
							'font-subsets'    => array(),
							'font-weight'     => array(),
							'font-style'      => array(),
							'text-transform'  => array(),
							'text-decoration' => array(),
							'letter-spacing'  => array(),
							'font-size'       => array(),
							'line-height'     => array(),
						),
						'required' => array(
							array(
								'control'  => 'coworking_interface_typography_headings_heading',
								'value'    => true,
								'operator' => '==',
							),
						),
					),
				);
			}

			$options['setting']['coworking_interface_heading_em_font'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_typography',
				'control'           => array(
					'type'        => 'coworking-interface-typography',
					'label'       => esc_html__( 'Heading Emphasized Text', 'coworking-interface' ),
					'description' => esc_html__( 'Adds a separate font for styling of &lsaquo;em&rsaquo; tags, so you can create stylish typographic elements.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_typography',
					'display'     => array(
						'font-family'     => array(),
						'font-subsets'    => array(),
						'font-weight'     => array(),
						'font-style'      => array(),
						'text-transform'  => array(),
						'text-decoration' => array(),
						'letter-spacing'  => array(),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_typography_headings_heading',
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
new Coworking_Interface_Customizer_Typography();
