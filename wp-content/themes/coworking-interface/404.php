<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

			<?php do_action( 'coworking_interface_content_404' ); ?>

		</main><!-- #content .site-content -->

		<?php do_action( 'coworking_interface_after_content' ); ?>

	</div><!-- #primary .content-area -->

</div><!-- END .interface-container -->

<?php
get_footer();
