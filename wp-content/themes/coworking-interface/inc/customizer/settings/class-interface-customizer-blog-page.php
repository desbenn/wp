<?php
/**
 * Coworking Interface Blog » Blog Page / Archive section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Blog_Page' ) ) :
	/**
	 * Coworking Interface Blog » Blog Page / Archive section in Customizer.
	 */
	class Coworking_Interface_Customizer_Blog_Page {

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
			$options['section']['coworking_interface_section_blog_page'] = array(
				'title' => esc_html__( 'Blog Page / Archive', 'coworking-interface' ),
				'panel' => 'coworking_interface_panel_blog',
			);

			// Layout.
			$options['setting']['coworking_interface_blog_layout'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Layout', 'coworking-interface' ),
					'description' => esc_html__( 'Choose blog layout. This will affect blog layout on archives, search results and posts page.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_page',
					'choices'     => array(
						'blog-layout-1'   => esc_html__( 'Vertical', 'coworking-interface' ),
						'blog-horizontal' => esc_html__( 'Horizontal', 'coworking-interface' ),
					),
				),
			);

			$_image_sizes = coworking_interface_get_image_sizes();
			$size_choices = array();

			if ( ! empty( $_image_sizes ) ) {
				foreach ( $_image_sizes as $key => $value ) {
					$name = ucwords( str_replace( array( '-', '_' ), ' ', $key ) );

					$size_choices[ $key ] = $name;

					if ( $value['width'] || $value['height'] ) {
						$size_choices[ $key ] .= ' (' . $value['width'] . 'x' . $value['height'] . ')';
					}
				}
			}

			// Featured Image Size.
			$options['setting']['coworking_interface_blog_image_size'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Featured Image Size', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_page',
					'choices'     => $size_choices,
				),
			);

			// Post Elements.
			$options['setting']['coworking_interface_blog_entry_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_sortable',
				'control'           => array(
					'type'        => 'coworking-interface-sortable',
					'section'     => 'coworking_interface_section_blog_page',
					'label'       => esc_html__( 'Post Elements', 'coworking-interface' ),
					'description' => esc_html__( 'Set order and visibility for post elements.', 'coworking-interface' ),
					'choices'     => array(
						'summary'        => esc_html__( 'Summary', 'coworking-interface' ),
						'header'         => esc_html__( 'Title', 'coworking-interface' ),
						'meta'           => esc_html__( 'Post Meta', 'coworking-interface' ),
						'thumbnail'      => esc_html__( 'Featured Image', 'coworking-interface' ),
						'summary-footer' => esc_html__( 'Read More', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_blog_layout',
							'value'    => 'blog-layout-1',
							'operator' => '==',
						),
					),
				),
			);

			// Meta/Post Details Layout.
			$options['setting']['coworking_interface_blog_entry_meta_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_sortable',
				'control'           => array(
					'type'        => 'coworking-interface-sortable',
					'section'     => 'coworking_interface_section_blog_page',
					'label'       => esc_html__( 'Post Meta', 'coworking-interface' ),
					'description' => esc_html__( 'Set order and visibility for post meta details.', 'coworking-interface' ),
					'choices'     => array(
						'author'   => esc_html__( 'Author', 'coworking-interface' ),
						'date'     => esc_html__( 'Publish Date', 'coworking-interface' ),
						'comments' => esc_html__( 'Comments', 'coworking-interface' ),
						'category' => esc_html__( 'Categories', 'coworking-interface' ),
						'tag'      => esc_html__( 'Tags', 'coworking-interface' ),
					),
				),
			);

			// Post Categories.
			$options['setting']['coworking_interface_blog_horizontal_post_categories'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-toggle',
					'label'       => esc_html__( 'Show Post Categories', 'coworking-interface' ),
					'description' => esc_html__( 'A list of categories the post belongs to. Displayed above post title.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_page',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_blog_layout',
							'value'    => 'blog-horizontal',
							'operator' => '==',
						),
					),
				),
			);

			// Read More Button.
			$options['setting']['coworking_interface_blog_horizontal_read_more'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'        => 'coworking-interface-toggle',
					'label'       => esc_html__( 'Show Read More Button', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_page',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_blog_layout',
							'value'    => 'blog-horizontal',
							'operator' => '==',
						),
					),
				),
			);

			// Meta Author image.
			$options['setting']['coworking_interface_entry_meta_icons'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-toggle',
					'section' => 'coworking_interface_section_blog_page',
					'label'   => esc_html__( 'Show avatar and icons in post meta', 'coworking-interface' ),
				),
			);

			// Featured Image Position.
			$options['setting']['coworking_interface_blog_image_position'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Featured Image Position', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_blog_page',
					'choices'     => array(
						'left'  => esc_html__( 'Left', 'coworking-interface' ),
						'right' => esc_html__( 'Right', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_blog_layout',
							'value'    => 'blog-horizontal',
							'operator' => '==',
						),
					),
				),
			);

			// Excerpt Length.
			$options['setting']['coworking_interface_excerpt_length'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_range',
				'control'           => array(
					'type'        => 'coworking-interface-range',
					'section'     => 'coworking_interface_section_blog_page',
					'label'       => esc_html__( 'Excerpt Length', 'coworking-interface' ),
					'description' => esc_html__( 'Number of words displayed in the excerpt.', 'coworking-interface' ),
					'min'         => 0,
					'max'         => 100,
					'step'        => 1,
					'unit'        => '',
					'responsive'  => false,
				),
			);

			// Excerpt more.
			$options['setting']['coworking_interface_excerpt_more'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'coworking-interface-text',
					'section'     => 'coworking_interface_section_blog_page',
					'label'       => esc_html__( 'Excerpt More', 'coworking-interface' ),
					'description' => esc_html__( 'What to append to excerpt if the text is cut.', 'coworking-interface' ),
				),
			);

			return $options;
		}
	}
endif;

new Coworking_Interface_Customizer_Blog_Page();
