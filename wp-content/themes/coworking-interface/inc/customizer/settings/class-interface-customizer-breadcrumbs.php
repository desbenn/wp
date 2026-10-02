<?php
/**
 * Coworking Interface Breadcrumbs Settings section in Customizer.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.1.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Coworking_Interface_Customizer_Breadcrumbs' ) ) :
	/**
	 * Coworking Interface Breadcrumbs Settings section in Customizer.
	 */
	class Coworking_Interface_Customizer_Breadcrumbs {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.1.0
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
		 * @since 1.1.0
		 * @param array $options Array of customizer options.
		 */
		public function register_options( $options ) {

			// Main Navigation Section.
			$options['section']['coworking_interface_section_breadcrumbs'] = array(
				'title'    => esc_html__( 'Breadcrumbs', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_header',
				'priority' => 70,
			);

			// Breadcrumbs.
			$options['setting']['coworking_interface_breadcrumbs_enable'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-toggle',
					'label'    => esc_html__( 'Enable Breadcrumbs', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_breadcrumbs',
				),
			);

			// Hide breadcrumbs on.
			$options['setting']['coworking_interface_breadcrumbs_hide_on'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_checkbox_group',
				'control'           => array(
					'type'        => 'coworking-interface-checkbox-group',
					'label'       => esc_html__( 'Disable On: ', 'coworking-interface' ),
					'description' => esc_html__( 'Choose on which pages you want to disable breadcrumbs. ', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_breadcrumbs',
					'choices'     => coworking_interface_get_display_choices(),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_breadcrumbs_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Position.
			$options['setting']['coworking_interface_breadcrumbs_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'     => 'coworking-interface-select',
					'label'    => esc_html__( 'Position', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_breadcrumbs',
					'choices'  => array(
						'in-page-header' => esc_html__( 'In Page Header', 'coworking-interface' ),
						'below-header'   => esc_html__( 'Below Header (Separate Container)', 'coworking-interface' ),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_breadcrumbs_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Alignment.
			$options['setting']['coworking_interface_breadcrumbs_alignment'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'     => 'coworking-interface-alignment',
					'label'    => esc_html__( 'Alignment', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_breadcrumbs',
					'choices'  => 'horizontal',
					'icons'    => array(
						'left'   => 'dashicons dashicons-editor-alignleft',
						'center' => 'dashicons dashicons-editor-aligncenter',
						'right'  => 'dashicons dashicons-editor-alignright',
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_breadcrumbs_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_breadcrumbs_position',
							'value'    => 'below-header',
							'operator' => '==',
						),
					),
				),
			);

			// Spacing.
			$options['setting']['coworking_interface_breadcrumbs_spacing'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-spacing',
					'label'       => esc_html__( 'Spacing', 'coworking-interface' ),
					'description' => esc_html__( 'Specify top and bottom padding.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_breadcrumbs',
					'choices'     => array(
						'top'    => esc_html__( 'Top', 'coworking-interface' ),
						'bottom' => esc_html__( 'Bottom', 'coworking-interface' ),
					),
					'responsive'  => true,
					'unit'        => array(
						'px',
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_breadcrumbs_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Design options heading.
			$options['setting']['coworking_interface_breadcrumbs_heading_design'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Design Options', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_breadcrumbs',
					'required' => array(
						array(
							'control'  => 'coworking_interface_breadcrumbs_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_breadcrumbs_position',
							'value'    => 'below-header',
							'operator' => '==',
						),
					),
				),
			);

			// Background design.
			$options['setting']['coworking_interface_breadcrumbs_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Background', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_breadcrumbs',
					'display'  => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'coworking-interface' ),
							'gradient' => esc_html__( 'Gradient', 'coworking-interface' ),
							'image'    => esc_html__( 'Image', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_breadcrumbs_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_breadcrumbs_heading_design',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_breadcrumbs_position',
							'value'    => 'below-header',
							'operator' => '==',
						),
					),
				),
			);

			// Text Color.
			$options['setting']['coworking_interface_breadcrumbs_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Font Color', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_breadcrumbs',
					'display'  => array(
						'color' => array(
							'text-color'       => esc_html__( 'Text Color', 'coworking-interface' ),
							'link-color'       => esc_html__( 'Link Color', 'coworking-interface' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_breadcrumbs_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_breadcrumbs_heading_design',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_breadcrumbs_position',
							'value'    => 'below-header',
							'operator' => '==',
						),
					),
				),
			);

			// Border.
			$options['setting']['coworking_interface_breadcrumbs_border'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Border', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_breadcrumbs',
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
							'control'  => 'coworking_interface_breadcrumbs_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_breadcrumbs_heading_design',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_breadcrumbs_position',
							'value'    => 'below-header',
							'operator' => '==',
						),
					),
				),
			);

			return $options;
		}
	}
endif;
new Coworking_Interface_Customizer_Breadcrumbs();
