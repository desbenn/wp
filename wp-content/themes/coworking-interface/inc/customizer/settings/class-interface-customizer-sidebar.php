<?php
/**
 * Coworking Interface Sidebar section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Sidebar' ) ) :

	/**
	 * Coworking Interface Sidebar section in Customizer.
	 */
	class Coworking_Interface_Customizer_Sidebar {

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
			$options['section']['coworking_interface_section_sidebar'] = array(
				'title'    => esc_html__( 'Sidebar', 'coworking-interface' ),
				'priority' => 4,
			);

			// Default sidebar position.
			$options['setting']['coworking_interface_sidebar_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'section'     => 'coworking_interface_section_sidebar',
					'label'       => esc_html__( 'Default Position', 'coworking-interface' ),
					'description' => esc_html__( 'Choose default sidebar position layout. You can change this setting per page via metabox settings.', 'coworking-interface' ),
					'choices'     => array(
						'no-sidebar'    => esc_html__( 'No Sidebar', 'coworking-interface' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'coworking-interface' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'coworking-interface' ),
					),
				),
			);

			// Single post sidebar position.
			$options['setting']['coworking_interface_single_post_sidebar_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Single Post', 'coworking-interface' ),
					'description' => esc_html__( 'Choose default sidebar position layout for single posts. You can change this setting per post via metabox settings.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_sidebar',
					'choices'     => array(
						'default'       => esc_html__( 'Default', 'coworking-interface' ),
						'no-sidebar'    => esc_html__( 'No Sidebar', 'coworking-interface' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'coworking-interface' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'coworking-interface' ),
					),
				),
			);

			// Single page sidebar position.
			$options['setting']['coworking_interface_single_page_sidebar_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Page', 'coworking-interface' ),
					'description' => esc_html__( 'Choose default sidebar position layout for pages. You can change this setting per page via metabox settings.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_sidebar',
					'choices'     => array(
						'default'       => esc_html__( 'Default', 'coworking-interface' ),
						'no-sidebar'    => esc_html__( 'No Sidebar', 'coworking-interface' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'coworking-interface' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'coworking-interface' ),
					),
				),
			);

			// Archive sidebar position.
			$options['setting']['coworking_interface_archive_sidebar_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Archives & Search', 'coworking-interface' ),
					'description' => esc_html__( 'Choose default sidebar position layout for archives and search results.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_sidebar',
					'choices'     => array(
						'default'       => esc_html__( 'Default', 'coworking-interface' ),
						'no-sidebar'    => esc_html__( 'No Sidebar', 'coworking-interface' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'coworking-interface' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'coworking-interface' ),
					),
				),
			);

			// Sidebar options heading.
			$options['setting']['coworking_interface_sidebar_options_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Options', 'coworking-interface' ),
					'section' => 'coworking_interface_section_sidebar',
				),
			);

			// Sidebar style.
			$options['setting']['coworking_interface_sidebar_style'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'section'     => 'coworking_interface_section_sidebar',
					'label'       => esc_html__( 'Sidebar Style', 'coworking-interface' ),
					'description' => esc_html__( 'Choose sidebar style.', 'coworking-interface' ),
					'choices'     => array(
						'1' => esc_html__( 'Minimal', 'coworking-interface' ),
						'2' => esc_html__( 'Title Focus', 'coworking-interface' ),
						'3' => esc_html__( 'Widgets Separated', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_sidebar_options_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Sidebar width.
			$options['setting']['coworking_interface_sidebar_width'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_range',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'section'     => 'coworking_interface_section_sidebar',
					'label'       => esc_html__( 'Sidebar Width', 'coworking-interface' ),
					'description' => esc_html__( 'Change your sidebar width.', 'coworking-interface' ),
					'min'         => 15,
					'max'         => 50,
					'step'        => 1,
					'unit'        => '%',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_sidebar_options_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Sticky sidebar.
			$options['setting']['coworking_interface_sidebar_sticky'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'section'     => 'coworking_interface_section_sidebar',
					'label'       => esc_html__( 'Sticky Sidebar', 'coworking-interface' ),
					'description' => esc_html__( 'Stick sidebar when scrolling.', 'coworking-interface' ),
					'choices'     => array(
						''            => esc_html__( 'Disable', 'coworking-interface' ),
						'sidebar'     => esc_html__( 'Stick first widget', 'coworking-interface' ),
						'last-widget' => esc_html__( 'Stick last widget', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_sidebar_options_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Sidebar mobile position.
			$options['setting']['coworking_interface_sidebar_responsive_position'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'section'     => 'coworking_interface_section_sidebar',
					'label'       => esc_html__( 'Responsive Sidebar Position', 'coworking-interface' ),
					'description' => esc_html__( 'Control sidebar position on smaller screens.', 'coworking-interface' ),
					'choices'     => array(
						'hide'           => esc_html__( 'Hide', 'coworking-interface' ),
						'before-content' => esc_html__( 'Before Content', 'coworking-interface' ),
						'after-content'  => esc_html__( 'After Content', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_sidebar_options_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Sidebar typography heading.
			$options['setting']['coworking_interface_typography_sidebar_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Typography', 'coworking-interface' ),
					'section' => 'coworking_interface_section_sidebar',
				),
			);

			// Sidebar widget heading.
			$options['setting']['coworking_interface_sidebar_widget_title_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'label'       => esc_html__( 'Widget Title Font Size', 'coworking-interface' ),
					'description' => esc_html__( 'Specify sidebar widget title font size.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_sidebar',
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
							'control'  => 'coworking_interface_typography_sidebar_heading',
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

new Coworking_Interface_Customizer_Sidebar();
