<?php
/**
 * Coworking Interface Top Bar Settings section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Top_Bar' ) ) :
	/**
	 * Coworking Interface Top Bar Settings section in Customizer.
	 */
	class Coworking_Interface_Customizer_Top_Bar {

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
			$options['section']['coworking_interface_section_top_bar'] = array(
				'title'    => esc_html__( 'Top Bar', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_header',
				'priority' => 10,
			);

			// Enable Top Bar.
			$options['setting']['coworking_interface_top_bar_enable'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-toggle',
					'label'       => esc_html__( 'Enable Top Bar', 'coworking-interface' ),
					'description' => esc_html__( 'Top Bar is a section with widgets located above Main Header area.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_top_bar',
				),
			);

			// Top Bar container width.
			$options['setting']['coworking_interface_top_bar_container_width'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Top Bar Width', 'coworking-interface' ),
					'description' => esc_html__( 'Stretch the Top Bar container to full width, or match your site&rsquo;s content width.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_top_bar',
					'choices'     => array(
						'content-width' => esc_html__( 'Content Width', 'coworking-interface' ),
						'full-width'    => esc_html__( 'Full Width', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar visibility.
			$options['setting']['coworking_interface_top_bar_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Device Visibility', 'coworking-interface' ),
					'description' => esc_html__( 'Devices where the Top Bar is displayed.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_top_bar',
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'coworking-interface' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'coworking-interface' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'coworking-interface' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar widgets heading.
			$options['setting']['coworking_interface_top_bar_heading_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-heading',
					'label'       => esc_html__( 'Top Bar Widgets', 'coworking-interface' ),
					'description' => esc_html__( 'Click the Add Widget button to add available widgets to your Top Bar.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_top_bar',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar widgets.
			$options['setting']['coworking_interface_top_bar_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_widget',
				'control'           => array(
					'type'       => 'coworking-interface-widget',
					'label'      => esc_html__( 'Top Bar Widgets', 'coworking-interface' ),
					'section'    => 'coworking_interface_section_top_bar',
					'widgets'    => array(
						'text'    => array(
							'max_uses' => 3,
						),
						'nav'     => array(
							'max_uses' => 1,
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
							'control'  => 'coworking_interface_top_bar_heading_widgets',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#coworking-interface-topbar',
					'render_callback'     => 'coworking_interface_topbar_output',
					'container_inclusive' => true,
					'fallback_refresh'    => true,
				),
			);

			// Top Bar widget separator.
			$options['setting']['coworking_interface_top_bar_widgets_separator'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Widgets Separator', 'coworking-interface' ),
					'description' => esc_html__( 'Display a separator line between widgets.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_top_bar',
					'choices'     => array(
						'none'    => esc_html__( 'None', 'coworking-interface' ),
						'regular' => esc_html__( 'Regular', 'coworking-interface' ),
						'slanted' => esc_html__( 'Slanted', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_top_bar_heading_widgets',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar design options heading.
			$options['setting']['coworking_interface_top_bar_heading_design_options'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Design Options', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_top_bar',
					'required' => array(
						array(
							'control'  => 'coworking_interface_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar Background.
			$options['setting']['coworking_interface_top_bar_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Background', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_top_bar',
					'display'  => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'coworking-interface' ),
							'gradient' => esc_html__( 'Gradient', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_top_bar_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar Text Color.
			$options['setting']['coworking_interface_top_bar_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Font Color', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_top_bar',
					'display'  => array(
						'color' => array(
							'text-color'       => esc_html__( 'Text Color', 'coworking-interface' ),
							'link-color'       => esc_html__( 'Link Color', 'coworking-interface' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_top_bar_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar Border.
			$options['setting']['coworking_interface_top_bar_border'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Border', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_top_bar',
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
							'control'  => 'coworking_interface_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_top_bar_heading_design_options',
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
new Coworking_Interface_Customizer_Top_Bar();
