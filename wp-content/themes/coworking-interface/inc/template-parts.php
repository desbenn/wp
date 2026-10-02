<?php
/**
 * Template parts.
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

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 *
 * @since 1.0.0
 */
function coworking_interface_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'coworking_interface_pingback_header' );

/**
 * Adds the meta tag for website accent color.
 *
 * @since 1.0.0
 */
function coworking_interface_meta_theme_color() {

	$color = coworking_interface_option( 'accent_color' );

	if ( $color ) {
		printf( '<meta name="theme-color" content="%s">', esc_attr( $color ) );
	}
}
add_action( 'wp_head', 'coworking_interface_meta_theme_color' );

/**
 * Outputs the theme top bar area.
 *
 * @since 1.0.0
 */
function coworking_interface_topbar_output() {

	if ( ! coworking_interface_is_top_bar_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/topbar/topbar' );
}
add_action( 'coworking_interface_header', 'coworking_interface_topbar_output', 10 );

/**
 * Outputs the top bar widgets.
 *
 * @since 1.0.0
 * @param string $location Widget location in top bar.
 */
function coworking_interface_topbar_widgets_output( $location ) {

	do_action( 'coworking_interface_top_bar_widgets_before_' . $location );

	$coworking_interface_top_bar_widgets = coworking_interface_option( 'top_bar_widgets' );

	if ( is_array( $coworking_interface_top_bar_widgets ) && ! empty( $coworking_interface_top_bar_widgets ) ) {
		foreach ( $coworking_interface_top_bar_widgets as $widget ) {

			if ( ! isset( $widget['values'] ) ) {
				continue;
			}

			if ( $location !== $widget['values']['location'] ) {
				continue;
			}

			if ( function_exists( 'coworking_interface_top_bar_widget_' . $widget['type'] ) ) {

				$classes   = array();
				$classes[] = 'si-topbar-widget__' . esc_attr( $widget['type'] );
				$classes[] = 'si-topbar-widget';

				if ( isset( $widget['values']['visibility'] ) && $widget['values']['visibility'] ) {
					$classes[] = 'coworking-interface-' . esc_attr( $widget['values']['visibility'] );
				}

				$classes = apply_filters( 'coworking_interface_topbar_widget_classes', $classes, $widget );
				$classes = trim( implode( ' ', $classes ) );

				printf( '<div class="%s">', esc_attr( $classes ) );
				call_user_func( 'coworking_interface_top_bar_widget_' . $widget['type'], $widget['values'] );
				printf( '</div><!-- END .si-topbar-widget -->' );
			}
		}
	}

	do_action( 'coworking_interface_top_bar_widgets_after_' . $location );
}
add_action( 'coworking_interface_topbar_widgets', 'coworking_interface_topbar_widgets_output' );

/**
 * Outputs the theme header area.
 *
 * @since 1.0.0
 */
function coworking_interface_header_output() {

	if ( ! coworking_interface_is_header_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/header/base' );
}
add_action( 'coworking_interface_header', 'coworking_interface_header_output', 20 );

/**
 * Outputs the header widgets in Header Widget Locations.
 *
 * @since 1.0.0
 * @param string $locations Widget location.
 */
function coworking_interface_header_widgets( $locations ) {

	$locations      = (array) $locations;
	$all_widgets    = (array) coworking_interface_option( 'header_widgets' );
	$header_widgets = $all_widgets;
	$header_class   = '';

	if ( ! empty( $locations ) ) {

		$header_widgets = array();

		foreach ( $locations as $location ) {

			$header_class = ' coworking-interface-widget-location-' . $location;

			$header_widgets[ $location ] = array();

			if ( ! empty( $all_widgets ) ) {
				foreach ( $all_widgets as $i => $widget ) {
					if ( $location === $widget['values']['location'] ) {
						$header_widgets[ $location ][] = $widget;
					}
				}
			}
		}
	}

	echo '<div class="si-header-widgets si-header-element' . esc_attr( $header_class ) . '">';

	if ( ! empty( $header_widgets ) ) {
		foreach ( $header_widgets as $location => $widgets ) {

			do_action( 'coworking_interface_header_widgets_before_' . $location );

			if ( ! empty( $widgets ) ) {
				foreach ( $widgets as $widget ) {
					if ( function_exists( 'coworking_interface_header_widget_' . $widget['type'] ) ) {

						$classes   = array();
						$classes[] = 'si-header-widget__' . esc_attr( $widget['type'] );
						$classes[] = 'si-header-widget';

						if ( isset( $widget['values']['visibility'] ) && $widget['values']['visibility'] ) {
							$classes[] = 'coworking-interface-' . esc_attr( $widget['values']['visibility'] );
						}

						$classes = apply_filters( 'coworking_interface_header_widget_classes', $classes, $widget );
						$classes = trim( implode( ' ', $classes ) );

						printf( '<div class="%s"><div class="interface-widget-wrapper">', esc_attr( $classes ) );
						call_user_func( 'coworking_interface_header_widget_' . $widget['type'], $widget['values'] );
						printf( '</div></div><!-- END .si-header-widget -->' );
					}
				}
			}

			do_action( 'coworking_interface_header_widgets_after_' . $location );
		}
	}

	echo '</div><!-- END .si-header-widgets -->';
}
add_action( 'coworking_interface_header_widget_location', 'coworking_interface_header_widgets', 1 );

/**
 * Outputs the content of theme header.
 *
 * @since 1.0.0
 */
function coworking_interface_header_content_output() {

	// Get the selected header layout from Customizer.
	$header_layout = coworking_interface_option( 'header_layout' );

	?>
	<div id="coworking-interface-header-inner">
	<?php

	// Load header layout template.
	get_template_part( 'template-parts/header/header', $header_layout );

	?>
	</div><!-- END #coworking-interface-header-inner -->
	<?php
}
add_action( 'coworking_interface_header_content', 'coworking_interface_header_content_output' );

/**
 * Outputs the main footer area.
 *
 * @since 1.0.0
 */
function coworking_interface_footer_output() {

	if ( ! coworking_interface_is_footer_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/footer/base' );

}
add_action( 'coworking_interface_footer', 'coworking_interface_footer_output', 20 );

/**
 * Outputs the copyright area.
 *
 * @since 1.0.0
 */
function coworking_interface_copyright_bar_output() {

	if ( ! coworking_interface_is_copyright_bar_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/footer/copyright/copyright' );
}
add_action( 'coworking_interface_footer', 'coworking_interface_copyright_bar_output', 30 );

/**
 * Outputs the copyright widgets.
 *
 * @since 1.0.0
 * @param string $location Widget location in copyright.
 */
function coworking_interface_copyright_widgets_output( $location ) {

	do_action( 'coworking_interface_copyright_widgets_before_' . $location );

	$coworking_interface_widgets = coworking_interface_option( 'copyright_widgets' );

	if ( is_array( $coworking_interface_widgets ) && ! empty( $coworking_interface_widgets ) ) {
		foreach ( $coworking_interface_widgets as $widget ) {

			if ( ! isset( $widget['values'] ) ) {
				continue;
			}

			if ( isset( $widget['values'], $widget['values']['location'] ) && $location !== $widget['values']['location'] ) {
				continue;
			}

			if ( function_exists( 'coworking_interface_copyright_widget_' . $widget['type'] ) ) {

				$classes   = array();
				$classes[] = 'si-copyright-widget__' . esc_attr( $widget['type'] );
				$classes[] = 'si-copyright-widget';

				if ( isset( $widget['values']['visibility'] ) && $widget['values']['visibility'] ) {
					$classes[] = 'coworking-interface-' . esc_attr( $widget['values']['visibility'] );
				}

				$classes = apply_filters( 'coworking_interface_copyright_widget_classes', $classes, $widget );
				$classes = trim( implode( ' ', $classes ) );

				printf( '<div class="%s">', esc_attr( $classes ) );
				call_user_func( 'coworking_interface_copyright_widget_' . $widget['type'], $widget['values'] );
				printf( '</div><!-- END .si-copyright-widget -->' );
			}
		}
	}

	do_action( 'coworking_interface_copyright_widgets_after_' . $location );

}
add_action( 'coworking_interface_copyright_widgets', 'coworking_interface_copyright_widgets_output' );

/**
 * Outputs the theme sidebar area.
 *
 * @since 1.0.0
 */
function coworking_interface_sidebar_output() {

	if ( coworking_interface_is_sidebar_displayed() ) {
		get_sidebar();
	}
}
add_action( 'coworking_interface_sidebar', 'coworking_interface_sidebar_output' );

/**
 * Outputs the back to top button.
 *
 * @since 1.0.0
 */
function coworking_interface_back_to_top_output() {

	if ( ! coworking_interface_option( 'enable_scroll_top' ) ) {
		return;
	}

	get_template_part( 'template-parts/misc/back-to-top' );
}
add_action( 'coworking_interface_after_page_wrapper', 'coworking_interface_back_to_top_output' );

/**
 * Outputs the theme page content.
 *
 * @since 1.0.0
 */
function coworking_interface_page_header_template() {

	do_action( 'coworking_interface_before_page_header' );

	if ( coworking_interface_is_page_header_displayed() ) {
		if ( is_singular( 'post' ) ) {
			get_template_part( 'template-parts/header-page-title-single' );
		} else {
			get_template_part( 'template-parts/header-page-title' );
		}
	}

	do_action( 'coworking_interface_after_page_header' );
}
add_action( 'coworking_interface_page_header', 'coworking_interface_page_header_template' );

/**
 * Outputs the theme hero content.
 *
 * @since 1.0.0
 */
function coworking_interface_hero() {

	if ( ! coworking_interface_is_hero_displayed() ) {
		return;
	}

	// Hero type.
	$hero_type = coworking_interface_option( 'hero_type' );

	do_action( 'coworking_interface_before_hero' );

	// Enqueue Coworking Interface Slider script.
	wp_enqueue_script( 'slider-js' );

	?>
	<div id="hero" <?php coworking_interface_hero_classes(); ?>>
		<?php get_template_part( 'template-parts/hero/hero', $hero_type ); ?>
	</div><!-- END #hero -->
	<?php

	do_action( 'coworking_interface_after_hero' );
}
add_action( 'coworking_interface_after_masthead', 'coworking_interface_hero', 30 );

/**
 * Outputs the queried articles.
 *
 * @since 1.0.0
 */
function coworking_interface_content() {

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content/content', coworking_interface_get_article_feed_layout() );
		endwhile;

		coworking_interface_pagination();

		else :
			get_template_part( 'template-parts/content/content', 'none' );
		endif;
}
add_action( 'coworking_interface_content', 'coworking_interface_content' );
add_action( 'coworking_interface_content_archive', 'coworking_interface_content' );
add_action( 'coworking_interface_content_search', 'coworking_interface_content' );

/**
 * Outputs the theme single content.
 *
 * @since 1.0.0
 */
function coworking_interface_content_singular() {

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			if ( is_singular( 'post' ) ) {
				do_action( 'coworking_interface_content_single' );
			} else {
				do_action( 'coworking_interface_content_page' );
			}

		endwhile;
		else :
			get_template_part( 'template-parts/content/content', 'none' );
	endif;
}
add_action( 'coworking_interface_content_singular', 'coworking_interface_content_singular' );

/**
 * Outputs the theme 404 page content.
 *
 * @since 1.0.0
 */
function coworking_interface_404_page_content() {

	get_template_part( 'template-parts/content/content', '404' );
}
add_action( 'coworking_interface_content_404', 'coworking_interface_404_page_content' );

/**
 * Outputs the theme page content.
 *
 * @since 1.0.0
 */
function coworking_interface_content_page() {

	get_template_part( 'template-parts/content/content', 'page' );
}
add_action( 'coworking_interface_content_page', 'coworking_interface_content_page' );

/**
 * Outputs the theme single post content.
 *
 * @since 1.0.0
 */
function coworking_interface_content_single() {

	get_template_part( 'template-parts/content/content', 'single' );
}
add_action( 'coworking_interface_content_single', 'coworking_interface_content_single' );

/**
 * Outputs the comments template.
 *
 * @since 1.0.0
 */
function coworking_interface_output_comments() {
	comments_template();
}
add_action( 'coworking_interface_after_singular', 'coworking_interface_output_comments' );

/**
 * Outputs the theme archive page info.
 *
 * @since 1.0.0
 */
function coworking_interface_archive_info() {

	// Author info.
	if ( is_author() ) {
		get_template_part( 'template-parts/entry/entry', 'about-author' );
	}
}
add_action( 'coworking_interface_before_content', 'coworking_interface_archive_info' );

/**
 * Outputs more posts button to author description box.
 *
 * @since 1.0.0
 */
function coworking_interface_add_author_posts_button() {
	if ( ! is_author() ) {
		get_template_part( 'template-parts/entry/entry', 'author-posts-button' );
	}
}
add_action( 'coworking_interface_entry_after_author_description', 'coworking_interface_add_author_posts_button' );

/**
 * Outputs Comments Toggle button.
 *
 * @since 1.0.0
 */
function interface_comments_toggle() {

	if ( interface_comments_toggle_displayed() ) {
		get_template_part( 'template-parts/entry/entry-show-comments' );
	}
}
add_action( 'coworking_interface_before_comments', 'interface_comments_toggle' );

/**
 * Outputs Pre-Footer area.
 *
 * @since 1.0.0
 */
function coworking_interface_pre_footer() {

	if ( ! coworking_interface_is_pre_footer_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/pre-footer/base' );
}
add_action( 'coworking_interface_before_colophon', 'coworking_interface_pre_footer' );

/**
 * Outputs Page Preloader.
 *
 * @since 1.0.0
 */
function coworking_interface_preloader() {

	if ( ! coworking_interface_is_preloader_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/preloader/base' );
}
add_action( 'coworking_interface_before_page_wrapper', 'coworking_interface_preloader' );

/**
 * Outputs breadcrumbs after header.
 *
 * @since  1.1.0
 * @return void
 */
function coworking_interface_breadcrumb_after_header_output() {

	if ( 'below-header' === coworking_interface_option( 'breadcrumbs_position' ) && coworking_interface_has_breadcrumbs() ) {

		$alignment = 'si-text-align-' . coworking_interface_option( 'breadcrumbs_alignment' );

		$args = array(
			'container_before' => '<div class="si-breadcrumbs"><div class="interface-container ' . $alignment . '">',
			'container_after'  => '</div></div>',
		);

		coworking_interface_breadcrumb( $args );
	}
}
add_action( 'coworking_interface_main_start', 'coworking_interface_breadcrumb_after_header_output' );

/**
 * Outputs breadcumbs in page header.
 *
 * @since  1.1.0
 * @return void
 */
function coworking_interface_breadcrumb_page_header_output() {

	if ( coworking_interface_page_header_has_breadcrumbs() ) {

		if ( is_singular( 'post' ) ) {
			$args = array(
				'container_before' => '<div class="interface-container si-breadcrumbs">',
				'container_after'  => '</div>',
			);
		} else {
			$args = array(
				'container_before' => '<div class="si-breadcrumbs">',
				'container_after'  => '</div>',
			);
		}

		coworking_interface_breadcrumb( $args );
	}
}
add_action( 'coworking_interface_page_header_end', 'coworking_interface_breadcrumb_page_header_output' );

/**
 * Replace tranparent header logo.
 *
 * @since  1.1.1
 * @param  string $output Current logo markup.
 * @return string         Update logo markup.
 */
function coworking_interface_transparent_header_logo( $output ) {

	// Check if transparent header is displayed.
	if ( coworking_interface_is_header_transparent() ) {

		// Check if transparent logo is set.
		$logo = coworking_interface_option( 'tsp_logo' );
		$logo = isset( $logo['background-image-id'] ) ? $logo['background-image-id'] : false;

		$retina = coworking_interface_option( 'tsp_logo_retina' );
		$retina = isset( $retina['background-image-id'] ) ? $retina['background-image-id'] : false;

		if ( $logo ) {
			$output = coworking_interface_get_logo_img_output( $logo, $retina, 'si-tsp-logo' );
		}
	}

	return $output;
}
add_filter( 'coworking_interface_logo_img_output', 'coworking_interface_transparent_header_logo' );
add_filter( 'coworking_interface_site_title_markup', 'coworking_interface_transparent_header_logo' );

/**
 * Output the main navigation template.
 */
function coworking_interface_main_navigation_template() {
	get_template_part( 'template-parts/header/navigation' );
}

/**
 * Output the Header logo template.
 */
function coworking_interface_header_logo_template() {
	get_template_part( 'template-parts/header/logo' );
}
