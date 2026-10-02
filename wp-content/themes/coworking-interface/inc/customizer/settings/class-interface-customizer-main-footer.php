<?php
/**
 * Coworking Interface Main Footer section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Main_Footer' ) ) :
	/**
	 * Coworking Interface Main Footer section in Customizer.
	 */
	class Coworking_Interface_Customizer_Main_Footer {

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
			$options['section']['coworking_interface_section_main_footer'] = array(
				'title'    => esc_html__( 'Main Footer', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_footer',
				'priority' => 20,
			);

			// Enable Footer.
			$options['setting']['coworking_interface_enable_footer'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-toggle',
					'label'   => esc_html__( 'Enable Main Footer', 'coworking-interface' ),
					'section' => 'coworking_interface_section_main_footer',
				),
			);

			// Footer Layout.
			$options['setting']['coworking_interface_footer_layout'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-radio-image',
					'label'       => esc_html__( 'Column Layout', 'coworking-interface' ),
					'description' => esc_html__( 'Choose your site&rsquo;s footer column layout.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_footer',
					'choices'     => array(
						'layout-1' => array(
							'image' => COWORKING_INTERFACE_URI . '/inc/customizer/assets/images/footer-layout-1.svg',
							'title' => esc_html__( '1/4 + 1/4 + 1/4 + 1/4', 'coworking-interface' ),
						),
						'layout-2' => array(
							'image' => COWORKING_INTERFACE_URI . '/inc/customizer/assets/images/footer-layout-2.svg',
							'title' => esc_html__( '1/3 + 1/3 + 1/3', 'coworking-interface' ),
						),
						'layout-3' => array(
							'image' => COWORKING_INTERFACE_URI . '/inc/customizer/assets/images/footer-layout-3.svg',
							'title' => esc_html__( '2/3 + 1/3', 'coworking-interface' ),
						),
						'layout-4' => array(
							'image' => COWORKING_INTERFACE_URI . '/inc/customizer/assets/images/footer-layout-4.svg',
							'title' => esc_html__( '1/3 + 2/3', 'coworking-interface' ),
						),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#coworking-interface-footer-widgets',
					'render_callback'     => 'coworking_interface_footer_widgets',
					'container_inclusive' => false,
					'fallback_refresh'    => true,
				),
			);

			// Center footer widgets..
			$options['setting']['coworking_interface_footer_widgets_align_center'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-toggle',
					'label'    => esc_html__( 'Center Widget Content', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_main_footer',
					'required' => array(
						array(
							'control'  => 'coworking_interface_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#coworking-interface-footer-widgets',
					'render_callback'     => 'coworking_interface_footer_widgets',
					'container_inclusive' => false,
					'fallback_refresh'    => true,
				),
			);

			// Main Footer visibility.
			$options['setting']['coworking_interface_footer_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Device Visibility', 'coworking-interface' ),
					'description' => esc_html__( 'Devices where Main Footer is displayed.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_footer',
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'coworking-interface' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'coworking-interface' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'coworking-interface' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer Design Options heading.
			$options['setting']['coworking_interface_footer_heading_design_options'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Design Options', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_main_footer',
					'required' => array(
						array(
							'control'  => 'coworking_interface_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer Background.
			$options['setting']['coworking_interface_footer_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Background', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_main_footer',
					'display'  => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'coworking-interface' ),
							'gradient' => esc_html__( 'Gradient', 'coworking-interface' ),
							'image'    => esc_html__( 'Image', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_footer_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer Text Color.
			$options['setting']['coworking_interface_footer_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Font Color', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_main_footer',
					'display'  => array(
						'color' => array(
							'text-color'         => esc_html__( 'Text Color', 'coworking-interface' ),
							'link-color'         => esc_html__( 'Link Color', 'coworking-interface' ),
							'link-hover-color'   => esc_html__( 'Link Hover Color', 'coworking-interface' ),
							'widget-title-color' => esc_html__( 'Widget Title Color', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_footer_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer Border.
			$options['setting']['coworking_interface_footer_border'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Border', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_main_footer',
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
							'control'  => 'coworking_interface_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_footer_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer typography heading.
			$options['setting']['coworking_interface_typography_main_footer_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Typography', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_main_footer',
					'required' => array(
						array(
							'control'  => 'coworking_interface_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer widget title font size.
			$options['setting']['coworking_interface_footer_widget_title_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'label'       => esc_html__( 'Widget Title Font Size', 'coworking-interface' ),
					'description' => esc_html__( 'Choose your widget title font size.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_footer',
					'responsive'  => true,
					'unit'        => array(
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
					'required'    => array(
						array(
							'control'  => 'coworking_interface_typography_main_footer_heading',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_footer',
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
new Coworking_Interface_Customizer_Main_Footer();
