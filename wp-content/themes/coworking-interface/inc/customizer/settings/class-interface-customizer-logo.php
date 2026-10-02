<?php
/**
 * Coworking Interface Logo section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Logo' ) ) :
	/**
	 * Coworking Interface Logo section in Customizer.
	 */
	class Coworking_Interface_Customizer_Logo {

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

			// Logo Retina.
			$options['setting']['coworking_interface_logo_default_retina'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_background',
				'control'           => array(
					'type'        => 'coworking-interface-background',
					'section'     => 'title_tagline',
					'label'       => esc_html__( 'Retina Logo', 'coworking-interface' ),
					'description' => esc_html__( 'Upload exactly 2x the size of your default logo to make your logo crisp on HiDPI screens. This options is not required if logo above is in SVG format.', 'coworking-interface' ),
					'priority'    => 20,
					'advanced'    => false,
					'strings'     => array(
						'select_image' => __( 'Select logo', 'coworking-interface' ),
						'use_image'    => __( 'Select', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'custom_logo',
							'value'    => false,
							'operator' => '!=',
						),
					),
				),
				'partial'           => array(
					'selector'            => '.coworking-interface-logo',
					'render_callback'     => 'coworking_interface_logo',
					'container_inclusive' => false,
					'fallback_refresh'    => true,
				),
			);

			// Logo Max Height.
			$options['setting']['coworking_interface_logo_max_height'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'label'       => esc_html__( 'Logo Height', 'coworking-interface' ),
					'description' => esc_html__( 'Maximum logo image height.', 'coworking-interface' ),
					'section'     => 'title_tagline',
					'priority'    => 30,
					'min'         => 0,
					'max'         => 1000,
					'step'        => 10,
					'unit'        => 'px',
					'responsive'  => true,
					'required'    => array(
						array(
							'control'  => 'custom_logo',
							'value'    => false,
							'operator' => '!=',
						),
					),
				),
			);

			// Logo margin.
			$options['setting']['coworking_interface_logo_margin'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-spacing',
					'label'       => esc_html__( 'Logo Margin', 'coworking-interface' ),
					'description' => esc_html__( 'Specify spacing around logo. Negative values are allowed.', 'coworking-interface' ),
					'section'     => 'title_tagline',
					'settings'    => 'coworking_interface_logo_margin',
					'priority'    => 40,
					'choices'     => array(
						'top'    => esc_html__( 'Top', 'coworking-interface' ),
						'right'  => esc_html__( 'Right', 'coworking-interface' ),
						'bottom' => esc_html__( 'Bottom', 'coworking-interface' ),
						'left'   => esc_html__( 'Left', 'coworking-interface' ),
					),
					'responsive'  => true,
					'unit'        => array(
						'px',
					),
				),
			);

			// Show tagline.
			$options['setting']['coworking_interface_display_tagline'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-toggle',
					'label'    => esc_html__( 'Display Tagline', 'coworking-interface' ),
					'section'  => 'title_tagline',
					'settings' => 'coworking_interface_display_tagline',
					'priority' => 80,
				),
				'partial'           => array(
					'selector'            => '.coworking-interface-logo',
					'render_callback'     => 'coworking_interface_logo',
					'container_inclusive' => false,
					'fallback_refresh'    => true,
				),
			);

			// Site Identity heading.
			$options['setting']['coworking_interface_logo_heading_site_identity'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Site Identity', 'coworking-interface' ),
					'section'  => 'title_tagline',
					'settings' => 'coworking_interface_logo_heading_site_identity',
					'priority' => 50,
					'toggle'   => false,
				),
			);

			// Logo typography heading.
			$options['setting']['coworking_interface_typography_logo_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Typography', 'coworking-interface' ),
					'section'  => 'title_tagline',
					'priority' => 100,
					'required' => array(
						array(
							'control'  => 'custom_logo',
							'value'    => false,
							'operator' => '==',
						),
					),
				),
			);

			// Site title font size.
			$options['setting']['coworking_interface_logo_text_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'       => 'coworking-interface-range',
					'label'      => esc_html__( 'Site Title Font Size', 'coworking-interface' ),
					'section'    => 'title_tagline',
					'priority'   => 100,
					'min'        => 8,
					'max'        => 30,
					'step'       => 1,
					'responsive' => true,
					'unit'       => array(
						array(
							'id'   => 'px',
							'name' => 'px',
							'min'  => 8,
							'max'  => 90,
							'step' => 1,
						),
						array(
							'id'   => 'em',
							'name' => 'em',
							'min'  => 0.5,
							'max'  => 5,
							'step' => 0.01,
						),
						array(
							'id'   => 'rem',
							'name' => 'rem',
							'min'  => 0.5,
							'max'  => 5,
							'step' => 0.01,
						),
					),
					'required'   => array(
						array(
							'control'  => 'custom_logo',
							'value'    => false,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_typography_logo_heading',
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
new Coworking_Interface_Customizer_Logo();
