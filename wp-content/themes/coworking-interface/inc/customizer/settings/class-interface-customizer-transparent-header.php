<?php
/**
 * Coworking Interface Transparent Header Settings section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Transparent_Header' ) ) :
	/**
	 * Coworking Interface Main Transparent section in Customizer.
	 */
	class Coworking_Interface_Customizer_Transparent_Header {

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

			// Transparent Header Section.
			$options['section']['coworking_interface_section_transparent_header'] = array(
				'title'    => esc_html__( 'Transparent Header', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_header',
				'priority' => 80,
			);

			// Enable Transparent Header.
			$options['setting']['coworking_interface_tsp_header'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-toggle',
					'label'   => esc_html__( 'Enable Globally', 'coworking-interface' ),
					'section' => 'coworking_interface_section_transparent_header',
				),
			);

			// Disable choices.
			$disable_choices = array(
				'404' => array(
					'title' => esc_html__( '404 page', 'coworking-interface' ),
				),
				'posts_page' => array(
					'title' => esc_html__( 'Blog / Posts page', 'coworking-interface' ),
				),
				'archive' => array(
					'title' => esc_html__( 'Archive pages', 'coworking-interface' ),
				),
				'search' => array(
					'title' => esc_html__( 'Search pages', 'coworking-interface' ),
				),
				'post' => array(
					'title' => esc_html__( 'Posts', 'coworking-interface' ),
				),
				'page' => array(
					'title' => esc_html__( 'Pages', 'coworking-interface' ),
				),
			);

			// Get additionally registered post types.
			$post_types = get_post_types(
				array(
					'public'   => true,
					'_builtin' => false,
				),
				'objects'
			);

			if ( is_array( $post_types ) && ! empty( $post_types ) ) {
				foreach ( $post_types as $slug => $post_type ) {
					$disable_choices[ $slug ] = array(
						'title' => $post_type->label,
					);
				}
			}

			// Transparent header display on.
			$options['setting']['coworking_interface_tsp_header_disable_on'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_checkbox_group',
				'control'           => array(
					'type'        => 'coworking-interface-checkbox-group',
					'label'       => esc_html__( 'Disable On: ', 'coworking-interface' ),
					'description' => esc_html__( 'Choose on which pages you want to disable Transparent Header. ', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_transparent_header',
					'choices'     => $disable_choices,
					'required'    => array(
						array(
							'control'  => 'coworking_interface_tsp_header',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Logo Settings Heading.
			$options['setting']['coworking_interface_tsp_logo_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Logo Settings', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_transparent_header',
				),
			);

			// Logo.
			$options['setting']['coworking_interface_tsp_logo'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_background',
				'control'           => array(
					'type'        => 'coworking-interface-background',
					'section'     => 'coworking_interface_section_transparent_header',
					'label'       => esc_html__( 'Alternative Logo', 'coworking-interface' ),
					'description' => esc_html__( 'Upload a different logo to be used with Transparent Header.', 'coworking-interface' ),
					'advanced'    => false,
					'strings'     => array(
						'select_image' => __( 'Select logo', 'coworking-interface' ),
						'use_image'    => __( 'Select', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_tsp_logo_heading',
							'value'    => true,
							'operator' => '==',
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

			// Logo Retina.
			$options['setting']['coworking_interface_tsp_logo_retina'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_background',
				'control'           => array(
					'type'        => 'coworking-interface-background',
					'section'     => 'coworking_interface_section_transparent_header',
					'label'       => esc_html__( 'Alternative Logo - Retina', 'coworking-interface' ),
					'description' => esc_html__( 'Upload exactly 2x the size of your alternative logo to make your logo crisp on HiDPI screens. This options is not required if logo above is in SVG format.', 'coworking-interface' ),
					'advanced'    => false,
					'strings'     => array(
						'select_image' => __( 'Select logo', 'coworking-interface' ),
						'use_image'    => __( 'Select', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_tsp_logo_heading',
							'value'    => true,
							'operator' => '==',
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
			$options['setting']['coworking_interface_tsp_logo_max_height'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'label'       => esc_html__( 'Logo Height', 'coworking-interface' ),
					'description' => esc_html__( 'Maximum logo image height on transparent header.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_transparent_header',
					'min'         => 0,
					'max'         => 1000,
					'step'        => 10,
					'unit'        => 'px',
					'responsive'  => true,
					'required'    => array(
						array(
							'control'  => 'coworking_interface_tsp_logo_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Logo margin.
			$options['setting']['coworking_interface_tsp_logo_margin'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-spacing',
					'label'       => esc_html__( 'Logo Margin', 'coworking-interface' ),
					'description' => esc_html__( 'Specify spacing around logo on transparent header. Negative values are allowed. Leave empty to inherit from Logos & Site Title » Logo Margin.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_transparent_header',
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
					'required'    => array(
						array(
							'control'  => 'coworking_interface_tsp_logo_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Custom Colors Heading.
			$options['setting']['coworking_interface_tsp_colors_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Main Header Colors', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_transparent_header',
				),
			);

			// Background.
			$options['setting']['coworking_interface_tsp_header_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'section'  => 'coworking_interface_section_transparent_header',
					'label'    => esc_html__( 'Background', 'coworking-interface' ),
					'space'    => true,
					'display'  => array(
						'background' => array(
							'color' => esc_html__( 'Solid Color', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_tsp_colors_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Text Color.
			$options['setting']['coworking_interface_tsp_header_font_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'section'  => 'coworking_interface_section_transparent_header',
					'label'    => esc_html__( 'Font Color', 'coworking-interface' ),
					'space'    => true,
					'display'  => array(
						'color' => array(
							'text-color'       => esc_html__( 'Text Color', 'coworking-interface' ),
							'link-color'       => esc_html__( 'Link Color', 'coworking-interface' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_tsp_colors_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Border.
			$options['setting']['coworking_interface_tsp_header_border'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'section'  => 'coworking_interface_section_transparent_header',
					'label'    => esc_html__( 'Border', 'coworking-interface' ),
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
							'control'  => 'coworking_interface_tsp_colors_heading',
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
new Coworking_Interface_Customizer_Transparent_Header();
