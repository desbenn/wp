<?php
/**
 * Coworking Interface Copyright Bar section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Copyright_Settings' ) ) :
	/**
	 * Coworking Interface Copyright Bar section in Customizer.
	 */
	class Coworking_Interface_Customizer_Copyright_Settings {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Registers our custom options in Customizer.
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
			$options['section']['coworking_interface_section_copyright_bar'] = array(
				'title'    => esc_html__( 'Copyright Bar', 'coworking-interface' ),
				'priority' => 30,
				'panel'    => 'coworking_interface_panel_footer',
			);

			// Enable Copyright Bar.
			$options['setting']['coworking_interface_enable_copyright'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-toggle',
					'label'   => esc_html__( 'Enable Copyright Bar', 'coworking-interface' ),
					'section' => 'coworking_interface_section_copyright_bar',
				),
			);

			// Copyright Layout.
			$options['setting']['coworking_interface_copyright_layout'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-radio-image',
					'section'     => 'coworking_interface_section_copyright_bar',
					'label'       => esc_html__( 'Copyright Layout', 'coworking-interface' ),
					'description' => esc_html__( 'Choose your site&rsquo;s copyright widgets layout.', 'coworking-interface' ),
					'choices'     => array(
						'layout-1' => array(
							'image' => COWORKING_INTERFACE_URI . '/inc/customizer/assets/images/copyright-layout-1.svg',
							'title' => esc_html__( 'Centered', 'coworking-interface' ),
						),
						'layout-2' => array(
							'image' => COWORKING_INTERFACE_URI . '/inc/customizer/assets/images/copyright-layout-2.svg',
							'title' => esc_html__( 'Inline', 'coworking-interface' ),
						),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Enable Copyright Bar.
			$options['setting']['coworking_interface_copyright_separator'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'section'     => 'coworking_interface_section_copyright_bar',
					'label'       => esc_html__( 'Copyright Separator', 'coworking-interface' ),
					'description' => esc_html__( 'Select type of Copyright Separator.', 'coworking-interface' ),
					'choices'     => array(
						'none'                => esc_html__( 'None', 'coworking-interface' ),
						'contained-separator' => esc_html__( 'Contained Separator', 'coworking-interface' ),
						'fw-separator'        => esc_html__( 'Fullwidth Separator', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Copyright visibility.
			$options['setting']['coworking_interface_copyright_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'section'     => 'coworking_interface_section_copyright_bar',
					'label'       => esc_html__( 'Device Visibility', 'coworking-interface' ),
					'description' => esc_html__( 'Devices where Copyright Bar is displayed.', 'coworking-interface' ),
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'coworking-interface' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'coworking-interface' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'coworking-interface' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Copyright widgets heading.
			$options['setting']['coworking_interface_copyright_heading_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-heading',
					'section'     => 'coworking_interface_section_copyright_bar',
					'label'       => esc_html__( 'Copyright Bar Widgets', 'coworking-interface' ),
					'description' => esc_html__( 'Click the Add Widget button to add available widgets to your Copyright Bar.', 'coworking-interface' ),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Copyright widgets.
			$options['setting']['coworking_interface_copyright_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_widget',
				'control'           => array(
					'type'       => 'coworking-interface-widget',
					'section'    => 'coworking_interface_section_copyright_bar',
					'label'      => esc_html__( 'Copyright Bar Widgets', 'coworking-interface' ),
					'widgets'    => array(
						'text'    => array(
							'max_uses' => 3,
						),
						'nav'     => array(
							'menu_location' => apply_filters( 'coworking_interface_footer_menu_location', 'coworking-interface-footer' ),
							'max_uses'      => 1,
						),
						'socials' => array(
							'max_uses' => 1,
							'styles'   => array(
								'minimal' => esc_html__( 'Minimal', 'coworking-interface' ),
								'rounded' => esc_html__( 'Rounded', 'coworking-interface' ),
							),
						),
					),
					'locations'  => array(
						'start' => esc_html__( 'Start', 'coworking-interface' ),
						'end'   => esc_html__( 'End', 'coworking-interface' ),
					),
					'visibility' => array(
						'all'                => esc_html__( 'Show on All Devices', 'coworking-interface' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'coworking-interface' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'coworking-interface' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'coworking-interface' ),
					),
					'required'   => array(
						array(
							'control'  => 'coworking_interface_copyright_heading_widgets',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#coworking-interface-copyright',
					'render_callback'     => 'coworking_interface_copyright_bar_output',
					'container_inclusive' => true,
					'fallback_refresh'    => true,
				),
			);

			// Copyright design options heading.
			$options['setting']['coworking_interface_copyright_heading_design_options'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'section'  => 'coworking_interface_section_copyright_bar',
					'label'    => esc_html__( 'Design Options', 'coworking-interface' ),
					'required' => array(
						array(
							'control'  => 'coworking_interface_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Copyright Background.
			$options['setting']['coworking_interface_copyright_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'section'  => 'coworking_interface_section_copyright_bar',
					'label'    => esc_html__( 'Background', 'coworking-interface' ),
					'space'    => true,
					'display'  => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'coworking-interface' ),
							'gradient' => esc_html__( 'Gradient', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_copyright_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Copyright Text Color.
			$options['setting']['coworking_interface_copyright_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'        => 'coworking-interface-design-options',
					'section'     => 'coworking_interface_section_copyright_bar',
					'label'       => esc_html__( 'Font Color', 'coworking-interface' ),
					'description' => '',
					'space'       => true,
					'display'     => array(
						'color' => array(
							'text-color'       => esc_html__( 'Text Color', 'coworking-interface' ),
							'link-color'       => esc_html__( 'Link Color', 'coworking-interface' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'coworking-interface' ),
						),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_copyright_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_copyright',
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
new Coworking_Interface_Customizer_Copyright_Settings();
