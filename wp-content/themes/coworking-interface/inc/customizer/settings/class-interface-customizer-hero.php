<?php
/**
 * Coworking Interface Hero Section Settings section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Hero' ) ) :
	/**
	 * Coworking Interface Page Title Settings section in Customizer.
	 */
	class Coworking_Interface_Customizer_Hero {

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

			// Hero Section.
			$options['section']['coworking_interface_section_hero'] = array(
				'title'    => esc_html__( 'Hero', 'coworking-interface' ),
				'priority' => 3,
			);

			// Hero enable.
			$options['setting']['coworking_interface_enable_hero'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-toggle',
					'section' => 'coworking_interface_section_hero',
					'label'   => esc_html__( 'Enable Hero Section', 'coworking-interface' ),
				),
			);

			// Visibility.
			$options['setting']['coworking_interface_hero_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'section'     => 'coworking_interface_section_hero',
					'label'       => esc_html__( 'Device Visibility', 'coworking-interface' ),
					'description' => esc_html__( 'Devices where the Hero is displayed.', 'coworking-interface' ),
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'coworking-interface' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'coworking-interface' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'coworking-interface' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_hero',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Hero display on.
			$options['setting']['coworking_interface_hero_enable_on'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_checkbox_group',
				'control'           => array(
					'type'        => 'coworking-interface-checkbox-group',
					'label'       => esc_html__( 'Enable On: ', 'coworking-interface' ),
					'description' => esc_html__( 'Choose on which pages you want to enable Hero. ', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_hero',
					'choices'     => array(
						'home'       => array(
							'title' => esc_html__( 'Home Page', 'coworking-interface' ),
						),
						'posts_page' => array(
							'title' => esc_html__( 'Blog / Posts Page', 'coworking-interface' ),
						),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_hero',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Hover Slider heading.
			$options['setting']['coworking_interface_hero_hover_slider'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'section'  => 'coworking_interface_section_hero',
					'label'    => esc_html__( 'Style', 'coworking-interface' ),
					'required' => array(
						array(
							'control'  => 'coworking_interface_enable_hero',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_type',
							'value'    => 'hover-slider',
							'operator' => '==',
						),
					),
				),
			);

			// Hover Slider container width.
			$options['setting']['coworking_interface_hero_hover_slider_container'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'section'     => 'coworking_interface_section_hero',
					'label'       => esc_html__( 'Width', 'coworking-interface' ),
					'description' => esc_html__( 'Stretch the container to full width, or match your site&rsquo;s content width.', 'coworking-interface' ),
					'choices'     => array(
						'content-width' => esc_html__( 'Content Width', 'coworking-interface' ),
						'full-width'    => esc_html__( 'Full Width', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_hero',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_hover_slider',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_type',
							'value'    => 'hover-slider',
							'operator' => '==',
						),
					),
				),
			);

			// Hover Slider height.
			$options['setting']['coworking_interface_hero_hover_slider_height'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_range',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'section'     => 'coworking_interface_section_hero',
					'label'       => esc_html__( 'Height', 'coworking-interface' ),
					'description' => esc_html__( 'Set the height of the container.', 'coworking-interface' ),
					'min'         => 350,
					'max'         => 1000,
					'step'        => 1,
					'unit'        => 'px',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_hero',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_hover_slider',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_type',
							'value'    => 'hover-slider',
							'operator' => '==',
						),
					),
				),
			);

			// Hover Slider overlay.
			$options['setting']['coworking_interface_hero_hover_slider_overlay'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'section'     => 'coworking_interface_section_hero',
					'label'       => esc_html__( 'Overlay', 'coworking-interface' ),
					'description' => esc_html__( 'Choose hero overlay style.', 'coworking-interface' ),
					'choices'     => array(
						'none' => esc_html__( 'None', 'coworking-interface' ),
						'1'    => esc_html__( 'Overlay 1', 'coworking-interface' ),
						'2'    => esc_html__( 'Overlay 2', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_hero',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_hover_slider',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_type',
							'value'    => 'hover-slider',
							'operator' => '==',
						),
					),
				),
			);

			// Hover Slider Elements.
			$options['setting']['coworking_interface_hero_hover_slider_elements'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_sortable',
				'control'           => array(
					'type'        => 'coworking-interface-sortable',
					'section'     => 'coworking_interface_section_hero',
					'label'       => esc_html__( 'Post Elements', 'coworking-interface' ),
					'description' => esc_html__( 'Set order and visibility for post elements.', 'coworking-interface' ),
					'sortable'    => false,
					'choices'     => array(
						'category'  => esc_html__( 'Categories', 'coworking-interface' ),
						'meta'      => esc_html__( 'Post Details', 'coworking-interface' ),
						'read_more' => esc_html__( 'Continue Reading', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_hero',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_hover_slider',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_type',
							'value'    => 'hover-slider',
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#hero',
					'render_callback'     => 'coworking_interface_hero',
					'container_inclusive' => true,
					'fallback_refresh'    => true,
				),
			);

			// Post Settings heading.
			$options['setting']['coworking_interface_hero_hover_slider_posts'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'section'  => 'coworking_interface_section_hero',
					'label'    => esc_html__( 'Post Settings', 'coworking-interface' ),
					'required' => array(
						array(
							'control'  => 'coworking_interface_enable_hero',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_type',
							'value'    => 'hover-slider',
							'operator' => '==',
						),
					),
				),
			);

			// Post count.
			$options['setting']['coworking_interface_hero_hover_slider_post_number'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_range',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'section'     => 'coworking_interface_section_hero',
					'label'       => esc_html__( 'Post Number', 'coworking-interface' ),
					'description' => esc_html__( 'Set the number of visible posts.', 'coworking-interface' ),
					'min'         => 1,
					'max'         => 4,
					'step'        => 1,
					'unit'        => '',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_hero',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_hover_slider_posts',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_type',
							'value'    => 'hover-slider',
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#hero',
					'render_callback'     => 'coworking_interface_hero',
					'container_inclusive' => true,
					'fallback_refresh'    => true,
				),
			);

			// Post category.
			$options['setting']['coworking_interface_hero_hover_slider_category'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'section'     => 'coworking_interface_section_hero',
					'label'       => esc_html__( 'Category', 'coworking-interface' ),
					'description' => esc_html__( 'Display posts from selected category only. Leave empty to include all.', 'coworking-interface' ),
					'is_select2'  => true,
					'data_source' => 'category',
					'multiple'    => true,
					'required'    => array(
						array(
							'control'  => 'coworking_interface_enable_hero',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_hover_slider_posts',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_hero_type',
							'value'    => 'hover-slider',
							'operator' => '==',
						),
					),
				),
			);

			return $options;
		}
	}
endif;
new Coworking_Interface_Customizer_Hero();
