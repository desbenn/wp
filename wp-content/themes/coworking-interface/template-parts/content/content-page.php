<?php
/**
 * Template part for displaying page layout in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php coworking_interface_schema_markup( 'article' ); ?>>

<?php
if ( coworking_interface_show_post_thumbnail() ) {
	get_template_part( 'template-parts/entry/format/media', 'page' );
}
?>

<div class="entry-content si-entry">
	<?php
	do_action( 'coworking_interface_before_page_content' );

	the_content();

	do_action( 'coworking_interface_after_page_content' );
	?>
</div><!-- END .entry-content -->

<?php coworking_interface_link_pages(); ?>

</article><!-- #post-<?php the_ID(); ?> -->
