<?php
/**
 * Template for Single post
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

?>

<?php do_action( 'coworking_interface_before_article' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'coworking-interface-article' ); ?><?php coworking_interface_schema_markup( 'article' ); ?>>

	<?php
	if ( 'quote' === get_post_format() ) {
		get_template_part( 'template-parts/entry/format/media', 'quote' );
	}

	$coworking_interface_single_post_elements = coworking_interface_get_single_post_elements();

	if ( ! empty( $coworking_interface_single_post_elements ) ) {
		foreach ( $coworking_interface_single_post_elements as $coworking_interface_element ) {

			if ( 'content' === $coworking_interface_element ) {
				do_action( 'coworking_interface_before_single_content' );
				get_template_part( 'template-parts/entry/entry', $coworking_interface_element );
				do_action( 'coworking_interface_after_single_content' );
			} else {
				get_template_part( 'template-parts/entry/entry', $coworking_interface_element );
			}
		}
	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action( 'coworking_interface_after_article' ); ?>
