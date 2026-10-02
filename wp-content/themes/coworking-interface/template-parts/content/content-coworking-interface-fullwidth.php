<?php
/**
 * Template part for displaying content of Coworking Interface Canvas [Fullwidth] page template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php coworking_interface_schema_markup( 'article' ); ?>>
	<div class="entry-content si-entry si-fullwidth-entry">
		<?php
		do_action( 'coworking_interface_before_page_content' );

		the_content();

		do_action( 'coworking_interface_after_page_content' );
		?>
	</div><!-- END .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
