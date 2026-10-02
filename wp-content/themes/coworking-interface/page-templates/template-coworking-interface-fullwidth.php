<?php
/**
 * Template Name: Coworking Interface Fullwidth
 *
 * 100% wide page template without vertical spacing.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content/content', 'coworking-interface-fullwidth' );
	endwhile;
endif;
get_footer();
