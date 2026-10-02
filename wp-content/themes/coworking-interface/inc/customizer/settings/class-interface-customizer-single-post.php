<?php
/**
 * Coworking Interface Blog - Single Post section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Single_Post' ) ) :
	/**
	 * Coworking Interface Blog - Single Post section in Customizer.
	 */
	class Coworking_Interface_Customizer_Single_Post {

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
			$options['section']['coworking_interface_section_blog_single_post'] = array(
				'title'    => esc_html__( 'Single Post', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_blog',
				'priority' => 20,
			);

			// Single post layout.
			$options['setting']['coworking_interface_single_post_layout_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Layout', 'coworking-interface' ),
					'section' => 'coworking_interface_section_blog_single_post',
				),
			);

			// Content Layout.
			$options['setting']['coworking_interface_single_title_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Title Position', 'coworking-interface' ),
					'description' => esc_html__( 'Select title position for single post pages.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_single_post',
					'choices'     => array(
						'in-content'     => esc_html__( 'In Content', 'coworking-interface' ),
						'in-page-header' => esc_html__( 'In Page Header', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Alignment.
			$options['setting']['coworking_interface_single_title_alignment'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'     => 'coworking-interface-alignment',
					'label'    => esc_html__( 'Title Alignment', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_blog_single_post',
					'choices'  => 'horizontal',
					'icons'    => array(
						'left'   => 'dashicons dashicons-editor-alignleft',
						'center' => 'dashicons dashicons-editor-aligncenter',
						'right'  => 'dashicons dashicons-editor-alignright',
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Spacing.
			$options['setting']['coworking_interface_single_title_spacing'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-spacing',
					'label'       => esc_html__( 'Title Spacing', 'coworking-interface' ),
					'description' => esc_html__( 'Specify title top and bottom padding.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_single_post',
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
							'control'  => 'coworking_interface_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_single_title_position',
							'value'    => 'in-page-header',
							'operator' => '==',
						),
					),
				),
			);

			// Content width.
			$options['setting']['coworking_interface_single_content_width'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Content Width', 'coworking-interface' ),
					'description' => esc_html__( 'Narrow content width or match your site&rsquo;s Content Width (defined in General Settings &raquo; Layout).', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_single_post',
					'choices'     => array(
						'wide'   => esc_html__( 'Content Width', 'coworking-interface' ),
						'narrow' => esc_html__( 'Narrow Width', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Narrow container width.
			$options['setting']['coworking_interface_single_narrow_container_width'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_range',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'label'       => esc_html__( 'Narrow Container Width', 'coworking-interface' ),
					'description' => esc_html__( 'Choose the width (in px) for narrow container on single posts.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_single_post',
					'min'         => 500,
					'max'         => 1500,
					'step'        => 10,
					'required'    => array(
						array(
							'control'  => 'coworking_interface_single_content_width',
							'value'    => 'narrow',
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Single post elements.
			$options['setting']['coworking_interface_single_post_elements_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Post Elements', 'coworking-interface' ),
					'section' => 'coworking_interface_section_blog_single_post',
				),
			);

			$options['setting']['coworking_interface_single_post_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_sortable',
				'control'           => array(
					'type'        => 'coworking-interface-sortable',
					'section'     => 'coworking_interface_section_blog_single_post',
					'label'       => esc_html__( 'Post Elements', 'coworking-interface' ),
					'description' => esc_html__( 'Set visibility of post elements.', 'coworking-interface' ),
					'sortable'    => false,
					'choices'     => array(
						'thumb'          => esc_html__( 'Featured Image', 'coworking-interface' ),
						'category'       => esc_html__( 'Post Categories', 'coworking-interface' ),
						'tags'           => esc_html__( 'Post Tags', 'coworking-interface' ),
						'last-updated'   => esc_html__( 'Last Updated Date', 'coworking-interface' ),
						'about-author'   => esc_html__( 'About Author Box', 'coworking-interface' ),
						'prev-next-post' => esc_html__( 'Next/Prev Post Links', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Meta/Post Details Layout.
			$options['setting']['coworking_interface_single_post_meta_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_sortable',
				'control'           => array(
					'type'        => 'coworking-interface-sortable',
					'label'       => esc_html__( 'Post Meta', 'coworking-interface' ),
					'description' => esc_html__( 'Set order and visibility for post meta details.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_single_post',
					'choices'     => array(
						'author'   => esc_html__( 'Author', 'coworking-interface' ),
						'date'     => esc_html__( 'Publish Date', 'coworking-interface' ),
						'comments' => esc_html__( 'Comments', 'coworking-interface' ),
						'category' => esc_html__( 'Categories', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Meta icons.
			$options['setting']['coworking_interface_single_entry_meta_icons'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-toggle',
					'section'  => 'coworking_interface_section_blog_single_post',
					'label'    => esc_html__( 'Show avatar and icons in post meta', 'coworking-interface' ),
					'required' => array(
						array(
							'control'  => 'coworking_interface_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Toggle Comments.
			$options['setting']['coworking_interface_single_toggle_comments'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-toggle',
					'label'       => esc_html__( 'Show Toggle Comments', 'coworking-interface' ),
					'description' => esc_html__( 'Hide comments and comment form behind a toggle button. ', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_single_post',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Single Post typography heading.
			$options['setting']['coworking_interface_typography_single_post_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Typography', 'coworking-interface' ),
					'section' => 'coworking_interface_section_blog_single_post',
				),
			);

			// Single post content font size.
			$options['setting']['coworking_interface_single_content_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'label'       => esc_html__( 'Post Content Font Size', 'coworking-interface' ),
					'description' => esc_html__( 'Choose your single post content font size.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_single_post',
					'responsive'  => true,
					'unit'        => array(
						array(
							'id'   => 'px',
							'name' => 'px',
							'min'  => 8,
							'max'  => 30,
							'step' => 1,
						),
						array(
							'id'   => 'em',
							'name' => 'em',
							'min'  => 0.5,
							'max'  => 1.875,
							'step' => 0.01,
						),
						array(
							'id'   => 'rem',
							'name' => 'rem',
							'min'  => 0.5,
							'max'  => 1.875,
							'step' => 0.01,
						),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_typography_single_post_heading',
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
new Coworking_Interface_Customizer_Single_Post();
