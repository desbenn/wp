<?php
/**
 * Coworking Interface Main Navigation Settings section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Main_Navigation' ) ) :
	/**
	 * Coworking Interface Main Navigation Settings section in Customizer.
	 */
	class Coworking_Interface_Customizer_Main_Navigation {

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

			// Main Navigation Section.
			$options['section']['coworking_interface_section_main_navigation'] = array(
				'title'    => esc_html__( 'Main Navigation', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_header',
				'priority' => 30,
			);

			// Navigation animation heading.
			$options['setting']['coworking_interface_main_nav_heading_animation'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Animation', 'coworking-interface' ),
					'section' => 'coworking_interface_section_main_navigation',
				),
			);

			// Hover animation.
			$options['setting']['coworking_interface_main_nav_hover_animation'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Hover Animation', 'coworking-interface' ),
					'description' => esc_html__( 'Choose menu item hover animation style.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_navigation',
					'choices'     => array(
						'none'      => esc_html__( 'None', 'coworking-interface' ),
						'underline' => esc_html__( 'Underline', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_main_nav_heading_animation',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Sub Menus heading.
			$options['setting']['coworking_interface_main_nav_heading_sub_menus'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Sub Menus', 'coworking-interface' ),
					'section' => 'coworking_interface_section_main_navigation',
				),
			);

			// Sub-Menu Indicators.
			$options['setting']['coworking_interface_main_nav_sub_indicators'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-toggle',
					'label'       => esc_html__( 'Dropdown Indicators', 'coworking-interface' ),
					'description' => esc_html__( 'Show indicators (arrow icons) on parent menu items that have sub menus.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_navigation',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_main_nav_heading_sub_menus',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '.main-navigation',
					'render_callback'     => 'coworking_interface_main_navigation_template',
					'container_inclusive' => true,
					'fallback_refresh'    => true,
				),
			);

			// Mobile Menu heading.
			$options['setting']['coworking_interface_main_nav_heading_mobile_menu'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Mobile Menu', 'coworking-interface' ),
					'section' => 'coworking_interface_section_main_navigation',
				),
			);

			// Mobile Menu Breakpoint.
			$options['setting']['coworking_interface_main_nav_mobile_breakpoint'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_range',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'label'       => esc_html__( 'Mobile Breakpoint', 'coworking-interface' ),
					'description' => esc_html__( 'Choose the breakpoint (in px) when to show the mobile navigation.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_navigation',
					'min'         => 0,
					'max'         => 1920,
					'step'        => 1,
					'unit'        => 'px',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_main_nav_heading_mobile_menu',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Mobile Menu Button Label.
			$options['setting']['coworking_interface_main_nav_mobile_label'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'coworking-interface-text',
					'label'       => esc_html__( 'Mobile Menu Button Label', 'coworking-interface' ),
					'description' => esc_html__( 'This text will be displayed next to the mobile menu button.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_navigation',
					'placeholder' => esc_html__( 'Leave empty to hide the label...', 'coworking-interface' ),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_main_nav_heading_mobile_menu',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Navigation design options heading.
			$options['setting']['coworking_interface_nav_design_options'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Design Options', 'coworking-interface' ),
					'section' => 'coworking_interface_section_main_navigation',
				),
			);

			// Navigation Background.
			$options['setting']['coworking_interface_main_nav_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Background', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_main_navigation',
					'display'  => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'coworking-interface' ),
							'gradient' => esc_html__( 'Gradient', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_nav_design_options',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_header_layout',
							'value'    => 'layout-3',
							'operator' => '==',
						),
					),
				),
			);

			// Navigation Font Color.
			$options['setting']['coworking_interface_main_nav_font_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Font Color', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_main_navigation',
					'display'  => array(
						'color' => array(
							'link-color'       => esc_html__( 'Link Color', 'coworking-interface' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_nav_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Navigation Border.
			$options['setting']['coworking_interface_main_nav_border'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Border', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_main_navigation',
					'display'  => array(
						'border' => array(
							'style'     => esc_html__( 'Style', 'coworking-interface' ),
							'color'     => esc_html__( 'Color', 'coworking-interface' ),
							'width'     => esc_html__( 'Width (px)', 'coworking-interface' ),
							'positions' => array(
								'top'    => esc_html__( 'Top', 'coworking-interface' ),
								'bottom' => esc_html__( 'Bottom', 'coworking-interface' ),
							),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_nav_design_options',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_header_layout',
							'value'    => 'layout-3',
							'operator' => '==',
						),
					),
				),
			);

			// Main navigation typography heading.
			$options['setting']['coworking_interface_typography_main_nav_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Typography', 'coworking-interface' ),
					'section' => 'coworking_interface_section_main_navigation',
				),
			);

			// Main navigation font size.
			$options['setting']['coworking_interface_main_nav_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'label'       => esc_html__( 'Font Size', 'coworking-interface' ),
					'description' => esc_html__( 'Choose your main navigation font size.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_navigation',
					'unit'        => array(
						array(
							'id'   => 'px',
							'name' => 'px',
							'min'  => 8,
							'max'  => 25,
							'step' => 1,
						),
						array(
							'id'   => 'em',
							'name' => 'em',
							'min'  => 0.5,
							'max'  => 2,
							'step' => 0.01,
						),
						array(
							'id'   => 'rem',
							'name' => 'rem',
							'min'  => 0.5,
							'max'  => 2,
							'step' => 0.01,
						),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_typography_main_nav_heading',
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
new Coworking_Interface_Customizer_Main_Navigation();
