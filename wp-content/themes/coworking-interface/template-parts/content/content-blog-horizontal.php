<?php
/**
 * Template part for displaying blog post - horizontal.
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

		$coworking_interface_classes     = array();
		$coworking_interface_classes[]   = 'si-blog-entry-wrapper';
		$coworking_interface_thumb_align = coworking_interface_option( 'blog_image_position' );
		$coworking_interface_thumb_align = apply_filters( 'coworking_interface_horizontal_blog_image_position', $coworking_interface_thumb_align );
		$coworking_interface_classes[]   = 'si-thumb-' . $coworking_interface_thumb_align;
		$coworking_interface_classes     = implode( ' ', $coworking_interface_classes );
		?>

		<div class="<?php echo esc_attr( $coworking_interface_classes ); ?>">
			<?php get_template_part( 'template-parts/entry/entry-thumbnail' ); ?>

			<div class="si-entry-content-wrapper">

				<?php
				if ( coworking_interface_option( 'blog_horizontal_post_categories' ) ) {
					get_template_part( 'template-parts/entry/entry-category' );
				}

				get_template_part( 'template-parts/entry/entry-header' );
				get_template_part( 'template-parts/entry/entry-summary' );


				if ( coworking_interface_option( 'blog_horizontal_read_more' ) ) {
					get_template_part( 'template-parts/entry/entry-summary-footer' );
				}

				get_template_part( 'template-parts/entry/entry-meta' );
				?>
			</div>
		</div>

	<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action( 'coworking_interface_after_article' ); ?>
