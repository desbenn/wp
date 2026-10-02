<?php
/**
 * Coworking Interface Post Header Settings section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Post_Header' ) ) :
	/**
	 * Coworking Interface Post Header Settings section in Customizer.
	 */
	class Coworking_Interface_Customizer_Post_Header {

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

			// Post Header Section.
			$options['section']['coworking_interface_section_post_header'] = array(
				'title'    => esc_html__( 'Post Header', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_header',
				'priority' => 65,
			);

			// Post Header enable.
			$options['setting']['coworking_interface_post_header_enable'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-toggle',
					'label'   => esc_html__( 'Enable Post Header', 'coworking-interface' ),
					'section' => 'coworking_interface_section_post_header',
				),
			);

			// Alignment.
			$options['setting']['coworking_interface_post_header_alignment'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'     => 'coworking-interface-alignment',
					'label'    => esc_html__( 'Title Alignment', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_post_header',
					'choices'  => 'horizontal',
					'icons'    => array(
						'left'   => 'dashicons dashicons-editor-alignleft',
						'center' => 'dashicons dashicons-editor-aligncenter',
						'right'  => 'dashicons dashicons-editor-alignright',
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_post_header_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Spacing.
			$options['setting']['coworking_interface_post_header_spacing'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-spacing',
					'label'       => esc_html__( 'Post Title Spacing', 'coworking-interface' ),
					'description' => esc_html__( 'Specify Post Title top and bottom padding.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_post_header',
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
							'control'  => 'coworking_interface_post_header_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Post Header design options heading.
			$options['setting']['coworking_interface_post_header_heading_design'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Design Options', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_post_header',
					'required' => array(
						array(
							'control'  => 'coworking_interface_post_header_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Post Header background design.
			$options['setting']['coworking_interface_post_header_background'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Background', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_post_header',
					'display'  => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'coworking-interface' ),
							'gradient' => esc_html__( 'Gradient', 'coworking-interface' ),
							'image'    => esc_html__( 'Image', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_post_header_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_post_header_heading_design',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Post Header Text Color.
			$options['setting']['coworking_interface_post_header_text_color'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Font Color', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_post_header',
					'display'  => array(
						'color' => array(
							'text-color'       => esc_html__( 'Text Color', 'coworking-interface' ),
							'link-color'       => esc_html__( 'Link Color', 'coworking-interface' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_post_header_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_post_header_heading_design',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Post Header Border.
			$options['setting']['coworking_interface_post_header_border'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Border', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_post_header',
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
							'control'  => 'coworking_interface_post_header_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_post_header_heading_design',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Post Header typography heading.
			$options['setting']['coworking_interface_typography_post_header'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Typography', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_post_header',
					'required' => array(
						array(
							'control'  => 'coworking_interface_post_header_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Post Header font size.
			$options['setting']['coworking_interface_post_header_font_size'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'label'       => esc_html__( 'Post Title Font Size', 'coworking-interface' ),
					'description' => esc_html__( 'Choose your post title font size.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_post_header',
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
							'control'  => 'coworking_interface_typography_post_header',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_post_header_enable',
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
new Coworking_Interface_Customizer_Post_Header();
