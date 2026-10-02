<?php
/**
 * The template for displaying all pages, single posts and attachments.
 *
 * This is a new template file that WordPress introduced in
 * version 4.3.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>

<?php get_header(); ?>

<div class="interface-container">

	<div id="primary" class="content-area">

		<?php do_action( 'coworking_interface_before_content' ); ?>

		<main id="content" class="site-content" role="main"<?php coworking_interface_schema_markup( 'main' ); ?>>

			<?php
			do_action( 'coworking_interface_before_singular' );

			do_action( 'coworking_interface_content_singular' );

			do_action( 'coworking_interface_after_singular' );
			?>

		</main><!-- #content .site-content -->

		<?php do_action( 'coworking_interface_after_content' ); ?>

	</div><!-- #primary .content-area -->

	<?php do_action( 'coworking_interface_sidebar' ); ?>

</div><!-- END .interface-container -->

<?php
get_footer();
