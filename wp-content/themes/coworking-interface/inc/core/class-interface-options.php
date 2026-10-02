<?php
/**
 * Coworking Interface Options Class.
 *
 * @package     Coworking Interface
 * @author   WPInterface Team
 * @since    1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Coworking_Interface_Options' ) ) :

	/**
	 * Coworking Interface Options Class.
	 */
	class Coworking_Interface_Options {

		/**
		 * Singleton instance of the class.
		 *
		 * @since 1.0.0
		 * @var object
		 */
		private static $instance;

		/**
		 * Options variable.
		 *
		 * @since 1.0.0
		 * @var mixed $options
		 */
		private static $options;

		/**
		 * Main Coworking_Interface_Options Instance.
		 *
		 * @since 1.0.0
		 * @return Coworking_Interface_Options
		 */
		public static function instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Coworking_Interface_Options ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Refresh options.
			add_action( 'after_setup_theme', array( $this, 'refresh' ) );
		}

		/**
		 * Set default option values.
		 *
		 * @since  1.0.0
		 * @return array Default values.
		 */
		public function get_defaults() {

			$defaults = array(

				/**
				 * General Settings.
				 */

				// Layout.
				'coworking_interface_site_layout'                      => 'fw-contained',
				'coworking_interface_container_width'                  => 1200,

				// Base Colors.
				'coworking_interface_accent_color'                     => '#424F7A',
				'coworking_interface_content_text_color'               => '#30373e',
				'coworking_interface_headings_color'                   => '#131313',
				'coworking_interface_content_link_hover_color'         => '#131313',
				'coworking_interface_body_background_heading'          => true,
				'coworking_interface_content_background_heading'       => true,
				'coworking_interface_boxed_content_background_color'   => '#FFFFFF',
				'coworking_interface_scroll_top_visibility'            => 'all',

				// Base Typography.
				'coworking_interface_html_base_font_size'              => array(
					'desktop' => 16,
				),
				'coworking_interface_font_smoothing'                   => true,
				'coworking_interface_typography_body_heading'          => false,
				'coworking_interface_typography_headings_heading'      => false,
				'coworking_interface_body_font'                        => coworking_interface_typography_defaults(
					array(
						'font-family'         => 'default',
						'font-weight'         => 400,
						'font-size-desktop'   => '0.9375',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.733',
					)
				),
				'coworking_interface_headings_font'                    => coworking_interface_typography_defaults(
					array(
						'font-weight'     => 500,
						'font-style'      => 'normal',
						'text-transform'  => 'none',
						'text-decoration' => 'none',
					)
				),
				'coworking_interface_h1_font'                          => coworking_interface_typography_defaults(
					array(
						'font-weight'         => 600,
						'font-size-desktop'   => '2.375',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.1',
					)
				),
				'coworking_interface_h2_font'                          => coworking_interface_typography_defaults(
					array(
						'font-weight'         => 'inherit',
						'font-size-desktop'   => '1.875',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.25',
					)
				),
				'coworking_interface_h3_font'                          => coworking_interface_typography_defaults(
					array(
						'font-weight'         => 'inherit',
						'font-size-desktop'   => '1.625',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.25',
					)
				),
				'coworking_interface_h4_font'                          => coworking_interface_typography_defaults(
					array(
						'font-weight'         => 'inherit',
						'font-size-desktop'   => '1.25',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.5',
					)
				),
				'coworking_interface_h5_font'                          => coworking_interface_typography_defaults(
					array(
						'font-weight'         => 'inherit',
						'font-size-desktop'   => '1',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.5',
					)
				),
				'coworking_interface_h6_font'                          => coworking_interface_typography_defaults(
					array(
						'font-weight'         => 'inherit',
						'font-size-desktop'   => '0.6875',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.72',
						'text-transform'      => 'uppercase',
						'letter-spacing'      => '2',
					)
				),
				'coworking_interface_heading_em_font'                  => coworking_interface_typography_defaults(
					array(
						'font-weight' => 'inherit',
						'font-style'  => 'italic',
					)
				),
				'coworking_interface_footer_widget_title_font_size'    => array(
					'desktop' => 1.125,
					'unit'    => 'em',
				),

				// Primary Button.
				'coworking_interface_primary_button_heading'           => false,
				'coworking_interface_primary_button_bg_color'          => '',
				'coworking_interface_primary_button_hover_bg_color'    => '',
				'coworking_interface_primary_button_text_color'        => '#FFFFFF',
				'coworking_interface_primary_button_hover_text_color'  => '#FFFFFF',
				'coworking_interface_primary_button_border_radius'     => array(
					'top-left'     => 2,
					'top-right'    => 2,
					'bottom-right' => 2,
					'bottom-left'  => 2,
					'unit'         => 'px',
				),
				'coworking_interface_primary_button_border_width'      => 1,
				'coworking_interface_primary_button_border_color'      => 'rgba(0, 0, 0, 0.12)',
				'coworking_interface_primary_button_hover_border_color' => 'rgba(0, 0, 0, 0.12)',
				'coworking_interface_primary_button_typography'        => coworking_interface_typography_defaults(
					array(
						'font-family'         => 'inherit',
						'font-weight'         => 500,
						'font-size-desktop'   => '0.9375',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.4',
					)
				),

				// Secondary Button.
				'coworking_interface_secondary_button_heading'         => false,
				'coworking_interface_secondary_button_bg_color'        => '#131313',
				'coworking_interface_secondary_button_hover_bg_color'  => '#3e4750',
				'coworking_interface_secondary_button_text_color'      => '#FFFFFF',
				'coworking_interface_secondary_button_hover_text_color' => '#FFFFFF',
				'coworking_interface_secondary_button_border_radius'   => array(
					'top-left'     => 2,
					'top-right'    => 2,
					'bottom-right' => 2,
					'bottom-left'  => 2,
					'unit'         => 'px',
				),
				'coworking_interface_secondary_button_border_width'    => 1,
				'coworking_interface_secondary_button_border_color'    => 'rgba(0, 0, 0, 0.12)',
				'coworking_interface_secondary_button_hover_border_color' => 'rgba(0, 0, 0, 0.12)',
				'coworking_interface_secondary_button_typography'      => coworking_interface_typography_defaults(
					array(
						'font-family'         => 'inherit',
						'font-weight'         => 500,
						'font-size-desktop'   => '0.9375',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.4',
					)
				),

				// Text button.
				'coworking_interface_text_button_heading'              => false,
				'coworking_interface_text_button_text_color'           => '#131313',
				'coworking_interface_text_button_hover_text_color'     => '',
				'coworking_interface_text_button_typography'           => coworking_interface_typography_defaults(
					array(
						'font-family'         => 'inherit',
						'font-weight'         => 500,
						'font-size-desktop'   => '0.9375',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.4',
					)
				),

				// Misc Settings.
				'coworking_interface_enable_schema'                    => true,
				'coworking_interface_custom_input_style'               => true,
				'coworking_interface_preloader_heading'                => false,
				'coworking_interface_preloader'                        => false,
				'coworking_interface_preloader_style'                  => '1',
				'coworking_interface_preloader_visibility'             => 'all',
				'coworking_interface_scroll_top_heading'               => false,
				'coworking_interface_enable_scroll_top'                => true,

				/**
				 * Logos & Site Title.
				 */
				'coworking_interface_logo_default_retina'              => '',
				'coworking_interface_logo_max_height'                  => array(
					'desktop' => 30,
				),
				'coworking_interface_logo_margin'                      => array(
					'desktop' => array(
						'top'    => 25,
						'right'  => 0,
						'bottom' => 25,
						'left'   => 0,
					),
					'tablet'  => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'mobile'  => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'unit'    => 'px',
				),
				'coworking_interface_display_tagline'                  => false,
				'coworking_interface_logo_heading_site_identity'       => true,
				'coworking_interface_typography_logo_heading'          => false,
				'coworking_interface_logo_text_font_size'              => array(
					'desktop' => 1.875,
					'unit'    => 'rem',
				),

				/**
				 * Header.
				 */

				// Top Bar.
				'coworking_interface_top_bar_enable'                   => false,
				'coworking_interface_top_bar_container_width'          => 'content-width',
				'coworking_interface_top_bar_visibility'               => 'hide-mobile-tablet',
				'coworking_interface_top_bar_heading_widgets'          => true,
				'coworking_interface_top_bar_widgets'                  => array(
					array(
						'classname' => 'coworking_interface_customizer_widget_text',
						'type'      => 'text',
						'values'    => array(
							'content'    => esc_html__( 'This is a placeholder text widget in Top Bar section.', 'coworking-interface' ),
							'location'   => 'left',
							'visibility' => 'all',
						),
					),
				),
				'coworking_interface_top_bar_widgets_separator'        => 'regular',
				'coworking_interface_top_bar_heading_design_options'   => false,
				'coworking_interface_top_bar_background'               => coworking_interface_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(
								'background-color' => '#FFFFFF',
							),
							'gradient' => array(),
						),
					)
				),
				'coworking_interface_top_bar_text_color'               => coworking_interface_design_options_defaults(
					array(
						'color' => array(),
					)
				),
				'coworking_interface_top_bar_border'                   => coworking_interface_design_options_defaults(
					array(
						'border' => array(
							'border-bottom-width' => '1',
							'border-style'        => 'solid',
							'border-color'        => 'rgba(0,0,0, .085)',
							'separator-color'     => '#cccccc',
						),
					)
				),

				// Main Header.
				'coworking_interface_header_layout'                    => 'layout-1',
				'coworking_interface_header_container_width'           => 'content-width',
				'coworking_interface_header_heading_widgets'           => true,
				'coworking_interface_header_widgets'                   => array(
					array(
						'classname' => 'coworking_interface_customizer_widget_search',
						'type'      => 'search',
						'values'    => array(
							'location'   => 'left',
							'visibility' => 'hide-mobile-tablet',
						),
					),
				),
				'coworking_interface_header_widgets_separator'         => 'none',
				'coworking_interface_header_heading_design_options'    => false,
				'coworking_interface_header_background'                => coworking_interface_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(
								'background-color' => '#FFFFFF',
							),
							'gradient' => array(),
							'image'    => array(),
						),
					)
				),
				'coworking_interface_header_border'                    => coworking_interface_design_options_defaults(
					array(
						'border' => array(
							'border-bottom-width' => 1,
							'border-color'        => 'rgba(0,0,0, .085)',
							'separator-color'     => '#cccccc',
						),
					)
				),
				'coworking_interface_header_text_color'                => coworking_interface_design_options_defaults(
					array(
						'color' => array(
							'text-color' => '#66717f',
							'link-color' => '#131313',
						),
					)
				),

				// Transparent Header.
				'coworking_interface_tsp_header'                       => false,
				'coworking_interface_tsp_header_disable_on'            => array(
					'404',
					'posts_page',
					'archive',
					'search',
				),
				'coworking_interface_tsp_logo_heading'                 => false,
				'coworking_interface_tsp_logo'                         => '',
				'coworking_interface_tsp_logo_retina'                  => '',
				'coworking_interface_tsp_logo_max_height'              => array(
					'desktop' => 30,
				),
				'coworking_interface_tsp_logo_margin'                  => array(
					'desktop' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'tablet'  => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'mobile'  => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'unit'    => 'px',
				),
				'coworking_interface_tsp_colors_heading'               => false,
				'coworking_interface_tsp_header_background'            => coworking_interface_design_options_defaults(
					array(
						'background' => array(
							'color' => array(),
						),
					)
				),
				'coworking_interface_tsp_header_font_color'            => coworking_interface_design_options_defaults(
					array(
						'color' => array(),
					)
				),
				'coworking_interface_tsp_header_border'                => coworking_interface_design_options_defaults(
					array(
						'border' => array(),
					)
				),

				// Sticky Header.
				'coworking_interface_sticky_header'                    => false,
				'coworking_interface_sticky_header_hide_on'            => array( '' ),

				// Main Navigation.
				'coworking_interface_main_nav_heading_animation'       => false,
				'coworking_interface_main_nav_hover_animation'         => 'none',
				'coworking_interface_main_nav_heading_sub_menus'       => false,
				'coworking_interface_main_nav_sub_indicators'          => true,
				'coworking_interface_main_nav_heading_mobile_menu'     => false,
				'coworking_interface_main_nav_mobile_breakpoint'       => 960,
				'coworking_interface_main_nav_mobile_label'            => '',
				'coworking_interface_nav_design_options'               => false,
				'coworking_interface_main_nav_background'              => coworking_interface_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(
								'background-color' => '#FFFFFF',
							),
							'gradient' => array(),
						),
					)
				),
				'coworking_interface_main_nav_border'                  => coworking_interface_design_options_defaults(
					array(
						'border' => array(
							'border-top-width'    => 1,
							'border-bottom-width' => 1,
							'border-style'        => 'solid',
							'border-color'        => 'rgba(0,0,0, .085)',
						),
					)
				),
				'coworking_interface_main_nav_font_color'              => coworking_interface_design_options_defaults(
					array(
						'color' => array(),
					)
				),
				'coworking_interface_typography_main_nav_heading'      => false,
				'coworking_interface_main_nav_font_size'               => array(
					'value' => 0.9375,
					'unit'  => 'rem',
				),

				// Page Header.
				'coworking_interface_page_header_enable'               => true,
				'coworking_interface_page_header_alignment'            => 'left',
				'coworking_interface_page_header_spacing'              => array(
					'desktop' => array(
						'top'    => 30,
						'bottom' => 30,
					),
					'tablet'  => array(
						'top'    => '',
						'bottom' => '',
					),
					'mobile'  => array(
						'top'    => '',
						'bottom' => '',
					),
					'unit'    => 'px',
				),
				'coworking_interface_page_header_background'           => coworking_interface_design_options_defaults(
					array(
						'background' => array(
							'color'    => array( 'background-color' => 'rgba(0,0,0,.025)' ),
							'gradient' => array(),
							'image'    => array(),
						),
					)
				),
				'coworking_interface_page_header_text_color'           => coworking_interface_design_options_defaults(
					array(
						'color' => array(),
					)
				),
				'coworking_interface_page_header_border'               => coworking_interface_design_options_defaults(
					array(
						'border' => array(
							'border-bottom-width' => 1,
							'border-style'        => 'solid',
							'border-color'        => 'rgba(0,0,0,.062)',
						),
					)
				),
				'coworking_interface_typography_page_header'           => false,
				'coworking_interface_page_header_font_size'            => array(
					'desktop' => '36',
					'tablet'  => '',
					'mobile'  => '',
					'unit'    => 'px',
				),

				/**
				 * Post Header (Single Posts)
				 */
				'coworking_interface_post_header_enable'               => false,
				'coworking_interface_post_header_alignment'            => 'left',
				'coworking_interface_post_header_spacing'              => array(
					'desktop' => array(
						'top'    => '100',
						'bottom' => '100',
						'left'   => '',
						'right'  => '',
					),
					'tablet'  => array(
						'top'    => '',
						'bottom' => '',
						'left'   => '',
						'right'  => '',
					),
					'mobile'  => array(
						'top'    => '',
						'bottom' => '',
						'left'   => '',
						'right'  => '',
					),
					'unit'    => 'px',
				),
				'coworking_interface_post_header_background'           => coworking_interface_design_options_defaults(
					array(
						'background' => array(
							'color'    => array( 'background-color' => '' ),
							'gradient' => array(),
							'image'    => array(),
						),
					)
				),
				'coworking_interface_post_header_text_color'           => coworking_interface_design_options_defaults(
					array(
						'color' => array(),
					)
				),
				'coworking_interface_post_header_border'               => coworking_interface_design_options_defaults(
					array(
						'border' => array(),
					)
				),
				'coworking_interface_post_header_font_size'            => array(
					'desktop' => '36',
					'tablet'  => '',
					'mobile'  => '',
					'unit'    => 'px',
				),

				// Breadcrumbs.
				'coworking_interface_breadcrumbs_enable'               => true,
				'coworking_interface_breadcrumbs_hide_on'              => array( 'home' ),
				'coworking_interface_breadcrumbs_position'             => 'in-page-header',
				'coworking_interface_breadcrumbs_alignment'            => 'left',
				'coworking_interface_breadcrumbs_spacing'              => array(
					'desktop' => array(
						'top'    => 15,
						'bottom' => 15,
					),
					'tablet'  => array(
						'top'    => '',
						'bottom' => '',
					),
					'mobile'  => array(
						'top'    => '',
						'bottom' => '',
					),
					'unit'    => 'px',
				),
				'coworking_interface_breadcrumbs_heading_design'       => false,
				'coworking_interface_breadcrumbs_background'           => coworking_interface_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(),
							'gradient' => array(),
							'image'    => array(),
						),
					)
				),
				'coworking_interface_breadcrumbs_text_color'           => coworking_interface_design_options_defaults(
					array(
						'color' => array(),
					)
				),
				'coworking_interface_breadcrumbs_border'               => coworking_interface_design_options_defaults(
					array(
						'border' => array(
							'border-top-width'    => 0,
							'border-bottom-width' => 0,
							'border-color'        => '',
							'border-style'        => 'solid',
						),
					)
				),

				/**
				 * Hero.
				 */
				'coworking_interface_enable_hero'                      => false,
				'coworking_interface_hero_type'                        => 'hover-slider',
				'coworking_interface_hero_visibility'                  => 'all',
				'coworking_interface_hero_enable_on'                   => array( 'home' ),
				'coworking_interface_hero_hover_slider'                => false,
				'coworking_interface_hero_hover_slider_container'      => 'content-width',
				'coworking_interface_hero_hover_slider_height'         => 500,
				'coworking_interface_hero_hover_slider_overlay'        => '1',
				'coworking_interface_hero_hover_slider_elements'       => array(
					'category'  => true,
					'meta'      => true,
					'read_more' => true,
				),
				'coworking_interface_hero_hover_slider_posts'          => false,
				'coworking_interface_hero_hover_slider_post_number'    => 3,
				'coworking_interface_hero_hover_slider_category'       => array(),

				/**
				 * Blog.
				 */

				// Blog Page / Archive.
				'coworking_interface_blog_entry_elements'              => array(
					'thumbnail'      => true,
					'header'         => true,
					'meta'           => true,
					'summary'        => true,
					'summary-footer' => true,
				),
				'coworking_interface_blog_entry_meta_elements'         => array(
					'author'   => true,
					'date'     => true,
					'category' => true,
					'tag'      => false,
					'comments' => true,
				),
				'coworking_interface_entry_meta_icons'                 => false,
				'coworking_interface_excerpt_length'                   => 30,
				'coworking_interface_excerpt_more'                     => '&hellip;',
				'coworking_interface_blog_layout'                      => 'blog-layout-1',
				'coworking_interface_blog_image_position'              => 'left',
				'coworking_interface_blog_image_size'                  => 'large',
				'coworking_interface_blog_horizontal_post_categories'  => true,
				'coworking_interface_blog_horizontal_read_more'        => false,

				// Single Post.
				'coworking_interface_single_post_layout_heading'       => false,
				'coworking_interface_single_title_position'            => 'in-content',
				'coworking_interface_single_title_alignment'           => 'left',
				'coworking_interface_single_title_spacing'             => array(
					'desktop' => array(
						'top'    => 152,
						'bottom' => 100,
					),
					'tablet'  => array(
						'top'    => 90,
						'bottom' => 55,
					),
					'mobile'  => array(
						'top'    => '',
						'bottom' => '',
					),
					'unit'    => 'px',
				),
				'coworking_interface_single_content_width'             => 'narrow',
				'coworking_interface_single_narrow_container_width'    => 700,
				'coworking_interface_single_post_elements_heading'     => false,
				'coworking_interface_single_post_meta_elements'        => array(
					'author'   => true,
					'date'     => true,
					'comments' => true,
					'category' => false,
				),
				'coworking_interface_single_post_thumb'                => true,
				'coworking_interface_single_post_categories'           => true,
				'coworking_interface_single_post_tags'                 => true,
				'coworking_interface_single_last_updated'              => true,
				'coworking_interface_single_about_author'              => true,
				'coworking_interface_single_post_next_prev'            => true,
				'coworking_interface_single_post_elements'             => array(
					'thumb'          => true,
					'category'       => true,
					'tags'           => true,
					'last-updated'   => true,
					'about-author'   => true,
					'prev-next-post' => true,
				),
				'coworking_interface_single_toggle_comments'           => false,
				'coworking_interface_single_entry_meta_icons'          => false,
				'coworking_interface_typography_single_post_heading'   => false,
				'coworking_interface_single_content_font_size'         => array(
					'desktop' => '1',
					'unit'    => 'rem',
				),

				/**
				 * Sidebar.
				 */

				'coworking_interface_sidebar_position'                 => 'right-sidebar',
				'coworking_interface_single_post_sidebar_position'     => 'no-sidebar',
				'coworking_interface_single_page_sidebar_position'     => 'default',
				'coworking_interface_archive_sidebar_position'         => 'default',
				'coworking_interface_sidebar_options_heading'          => false,
				'coworking_interface_sidebar_style'                    => '1',
				'coworking_interface_sidebar_width'                    => 25,
				'coworking_interface_sidebar_sticky'                   => '',
				'coworking_interface_sidebar_responsive_position'      => 'after-content',
				'coworking_interface_typography_sidebar_heading'       => false,
				'coworking_interface_sidebar_widget_title_font_size'   => array(
					'desktop' => 1,
					'unit'    => 'rem',
				),

				/**
				 * Footer.
				 */

				// Pre Footer.
				'coworking_interface_pre_footer_cta'                   => true,
				'coworking_interface_enable_pre_footer_cta'            => false,
				'coworking_interface_pre_footer_cta_visibility'        => 'all',
				'coworking_interface_pre_footer_cta_hide_on'           => array(),
				'coworking_interface_pre_footer_cta_style'             => '1',
				'coworking_interface_pre_footer_cta_text'              => wp_kses_post( __( 'This is an example of <em>Pre Footer</em> section in Coworking Interface.', 'coworking-interface' ) ),
				'coworking_interface_pre_footer_cta_btn_text'          => wp_kses_post( __( 'Example Button', 'coworking-interface' ) ),
				'coworking_interface_pre_footer_cta_btn_url'           => '#',
				'coworking_interface_pre_footer_cta_btn_new_tab'       => false,
				'coworking_interface_pre_footer_cta_design_options'    => false,
				'coworking_interface_pre_footer_cta_background'        => coworking_interface_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(),
							'gradient' => array(),
							'image'    => array(),
						),
					)
				),
				'coworking_interface_pre_footer_cta_border'            => coworking_interface_design_options_defaults(
					array(
						'border' => array(),
					)
				),
				'coworking_interface_pre_footer_cta_text_color'        => coworking_interface_design_options_defaults(
					array(
						'color' => array(
							'text-color' => '#FFFFFF',
						),
					)
				),
				'coworking_interface_pre_footer_cta_typography'        => false,
				'coworking_interface_pre_footer_cta_font_size'         => array(
					'desktop' => 1.75,
					'unit'    => 'rem',
				),

				// Copyright.
				'coworking_interface_enable_copyright'                 => true,
				'coworking_interface_copyright_layout'                 => 'layout-1',
				'coworking_interface_copyright_separator'              => 'contained-separator',
				'coworking_interface_copyright_visibility'             => 'all',
				'coworking_interface_copyright_heading_widgets'        => true,
				'coworking_interface_copyright_widgets'                => array(
					array(
						'classname' => 'coworking_interface_customizer_widget_text',
						'type'      => 'text',
						'values'    => array(
							'content'    => esc_html__( 'Copyright {{the_year}} &mdash; {{site_title}}. All rights reserved. {{theme_link}}', 'coworking-interface' ),
							'location'   => 'start',
							'visibility' => 'all',
						),
					),
				),
				'coworking_interface_copyright_heading_design_options' => false,
				'coworking_interface_copyright_background'             => coworking_interface_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(),
							'gradient' => array(),
						),
					)
				),
				'coworking_interface_copyright_text_color'             => coworking_interface_design_options_defaults(
					array(
						'color' => array(
							'text-color'       => '',
							'link-color'       => '',
							'link-hover-color' => '#FFFFFF',
						),
					)
				),

				// Main Footer.
				'coworking_interface_enable_footer'                    => true,
				'coworking_interface_footer_layout'                    => 'layout-1',
				'coworking_interface_footer_widgets_align_center'      => false,
				'coworking_interface_footer_visibility'                => 'all',
				'coworking_interface_footer_heading_design_options'    => false,
				'coworking_interface_footer_background'                => coworking_interface_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(
								'background-color' => '#131313',
							),
							'gradient' => array(),
							'image'    => array(),
						),
					)
				),
				'coworking_interface_footer_text_color'                => coworking_interface_design_options_defaults(
					array(
						'color' => array(
							'text-color'         => '#9BA1A7',
							'link-color'         => '',
							'link-hover-color'   => '#FFFFFF',
							'widget-title-color' => '#FFFFFF',
						),
					)
				),
				'coworking_interface_footer_border'                    => coworking_interface_design_options_defaults(
					array(
						'border' => array(),
					)
				),
				'coworking_interface_typography_main_footer_heading'   => false,
			);

			$defaults = apply_filters( 'coworking_interface_default_option_values', $defaults );

			return $defaults;
		}

		/**
		 * Get the options from static array()
		 *
		 * @since  1.0.0
		 * @return array    Return array of theme options.
		 */
		public function get_options() {
			return self::$options;
		}

		/**
		 * Get the options from static array()
		 *
		 * @since  1.0.0
		 * @return array    Return array of theme options.
		 */
		public function get( $id ) {
			$value = isset( self::$options[ $id ] ) ? self::$options[ $id ] : self::get_default( $id );
			$value = apply_filters( "theme_mod_{$id}", $value ); // phpcs:ignore
			return $value;
		}

		/**
		 * Set option.
		 *
		 * @since  1.0.0
		 */
		public function set( $id, $value ) {
			set_theme_mod( $id, $value );
			self::$options[ $id ] = $value;
		}

		/**
		 * Refresh options.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function refresh() {
			self::$options = wp_parse_args(
				get_theme_mods(),
				self::get_defaults()
			);
		}

		/**
		 * Returns the default value for option.
		 *
		 * @since  1.0.0
		 * @param  string $id Option ID.
		 * @return mixed      Default option value.
		 */
		public function get_default( $id ) {
			$defaults = self::get_defaults();
			return isset( $defaults[ $id ] ) ? $defaults[ $id ] : false;
		}
	}

endif;
