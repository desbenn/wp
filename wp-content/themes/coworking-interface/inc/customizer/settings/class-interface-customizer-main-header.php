<?php
/**
 * Coworking Interface Main Header Settings section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Main_Header' ) ) :
	/**
	 * Coworking Interface Main Header section in Customizer.
	 */
	class Coworking_Interface_Customizer_Main_Header {

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

			// Main Header Section.
			$options['section']['coworking_interface_section_main_header'] = array(
				'title'    => esc_html__( 'Main Header', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_header',
				'priority' => 20,
			);

			// Header Layout.
			$options['setting']['coworking_interface_header_layout'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-radio-image',
					'label'       => esc_html__( 'Header Layout', 'coworking-interface' ),
					'description' => esc_html__( 'Pre-defined positions of header elements, such as logo and navigation.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_header',
					'choices'     => array(
						'layout-1' => array(
							'image' => COWORKING_INTERFACE_URI . '/inc/customizer/assets/images/header-layout-1.svg',
							'title' => esc_html__( 'Header 1', 'coworking-interface' ),
						),
						'layout-2' => array(
							'image' => COWORKING_INTERFACE_URI . '/inc/customizer/assets/images/header-layout-2.svg',
							'title' => esc_html__( 'Header 2', 'coworking-interface' ),
						),
						'layout-3' => array(
							'image' => COWORKING_INTERFACE_URI . '/inc/customizer/assets/images/header-layout-3.svg',
							'title' => esc_html__( 'Header 3', 'coworking-interface' ),
						),
					),
				),
			);

			// Header container width.
			$options['setting']['coworking_interface_header_container_width'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Header Width', 'coworking-interface' ),
					'description' => esc_html__( 'Stretch the Header container to full width, or match your site&rsquo;s content width.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_header',
					'choices'     => array(
						'content-width' => esc_html__( 'Content Width', 'coworking-interface' ),
						'full-width'    => esc_html__( 'Full Width', 'coworking-interface' ),
					),
				),
			);

			// Header widgets heading.
			$options['setting']['coworking_interface_header_heading_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-heading',
					'label'       => esc_html__( 'Header Widgets', 'coworking-interface' ),
					'description' => esc_html__( 'Click the Add Widget button to add available widgets to your Header. Click the down arrow icon to expand widget options.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_header',
					'space'       => true,
				),
			);

			// Header widgets.
			$options['setting']['coworking_interface_header_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_widget',
				'control'           => array(
					'type'       => 'coworking-interface-widget',
					'label'      => esc_html__( 'Header Widgets', 'coworking-interface' ),
					'section'    => 'coworking_interface_section_main_header',
					'widgets'    => apply_filters(
						'coworking_interface_main_header_widgets',
						array(
							'search' => array(
								'max_uses' => 1,
							),
							'button' => array(
								'max_uses' => 1,
							),
						)
					),
					'locations'  => array(
						'left'  => esc_html__( 'Left', 'coworking-interface' ),
						'right' => esc_html__( 'Right', 'coworking-interface' ),
					),
					'visibility' => array(
						'all'                => esc_html__( 'Show on All Devices', 'coworking-interface' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'coworking-interface' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'coworking-interface' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'coworking-interface' ),
					),
					'required'   => array(
						array(
							'control'  => 'coworking_interface_header_heading_widgets',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#coworking-interface-header',
					'render_callback'     => 'coworking_interface_header_content_output',
					'container_inclusive' => false,
					'fallback_refresh'    => true,
				),
			);

			// Header widget separator.
			$options['setting']['coworking_interface_header_widgets_separator'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Widgets Separator', 'coworking-interface' ),
					'description' => esc_html__( 'Display a separator line between widgets.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_main_header',
					'choices'     => array(
						'none'    => esc_html__( 'None', 'coworking-interface' ),
						'regular' => esc_html__( 'Regular', 'coworking-interface' ),
						'slanted' => esc_html__( 'Slanted', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_header_heading_widgets',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Header design options heading.
			$options['setting']['coworking_interface_header_heading_design_options'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Design Options', 'coworking-interface' ),
					'section' => 'coworking_interface_section_main_header',
					'space'   => true,
				),
			);

			// Header Background.
			$options['setting']['coworking_interface_header_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'        => 'coworking-interface-design-options',
					'label'       => esc_html__( 'Background', 'coworking-interface' ),
					'description' => '',
					'section'     => 'coworking_interface_section_main_header',
					'space'       => true,
					'display'     => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'coworking-interface' ),
							'gradient' => esc_html__( 'Gradient', 'coworking-interface' ),
							'image'    => esc_html__( 'Image', 'coworking-interface' ),
						),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_header_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Header Text Color.
			$options['setting']['coworking_interface_header_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Font Color', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_main_header',
					'space'    => true,
					'display'  => array(
						'color' => array(
							'text-color'       => esc_html__( 'Tagline Color', 'coworking-interface' ),
							'link-color'       => esc_html__( 'Link Color', 'coworking-interface' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_header_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Header Border.
			$options['setting']['coworking_interface_header_border'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Border', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_main_header',
					'space'    => true,
					'display'  => array(
						'border' => array(
							'style'     => esc_html__( 'Style', 'coworking-interface' ),
							'color'     => esc_html__( 'Color', 'coworking-interface' ),
							'width'     => esc_html__( 'Width (px)', 'coworking-interface' ),
							'positions' => array(
								'top'    => esc_html__( 'Top', 'coworking-interface' ),
								'bottom' => esc_html__( 'Bottom', 'coworking-interface' ),
							),
							'separator' => esc_html__( 'Separator Color', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_header_heading_design_options',
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
new Coworking_Interface_Customizer_Main_Header();
