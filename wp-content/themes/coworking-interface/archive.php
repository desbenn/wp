<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

?>

<?php get_header(); ?>

<div class="interface-container">

	<div id="primary" class="content-area">

		<?php do_action( 'coworking_interface_before_content' ); ?>

		<main id="content" class="site-content" role="main"<?php coworking_interface_schema_markup( 'main' ); ?>>

			<?php do_action( 'coworking_interface_content_archive' ); ?>

		</main><!-- #content .site-content -->

		<?php do_action( 'coworking_interface_after_content' ); ?>

	</div><!-- #primary .content-area -->

	<?php do_action( 'coworking_interface_sidebar' ); ?>

</div><!-- END .interface-container -->

<?php
get_footer();
