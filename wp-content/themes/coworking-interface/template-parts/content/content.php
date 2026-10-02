<?php
/**
 * Template part for displaying post in post listing.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>

<?php do_action( 'coworking_interface_before_article' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'coworking-interface-article' ); ?><?php coworking_interface_schema_markup( 'article' ); ?>>

	<?php
	$coworking_interface_blog_entry_format = get_post_format();

	if ( 'quote' === $coworking_interface_blog_entry_format ) {
		get_template_part( 'template-parts/entry/format/media', $coworking_interface_blog_entry_format );
	} else {

		$coworking_interface_blog_entry_elements = coworking_interface_get_blog_entry_elements();

		if ( ! empty( $coworking_interface_blog_entry_elements ) ) {
			foreach ( $coworking_interface_blog_entry_elements as $coworking_interface_element ) {
				get_template_part( 'template-parts/entry/entry', $coworking_interface_element );
			}
		}
	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action( 'coworking_interface_after_article' ); ?>
