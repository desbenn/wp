<?php
/**
 * Template part for displaying quote format entry.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

if ( post_password_required() ) {
	return;
}

$coworking_interface_quote_content = apply_filters( 'coworking_interface_post_format_quote_content', get_the_content() );
$coworking_interface_quote_author  = apply_filters( 'coworking_interface_post_format_quote_author', get_the_title() );
$coworking_interface_quote_bg      = has_post_thumbnail() ? ' style="background-image: url(\'' . esc_url( get_the_post_thumbnail_url() ) . '\')"' : '';
?>

<div class="si-blog-entry-content">
	<div class="entry-content si-entry"<?php coworking_interface_schema_markup( 'text' ); ?>>

		<?php if ( ! is_single() ) { ?>
			<a href="<?php the_permalink(); ?>" class="quote-link" aria-label="<?php esc_attr_e( 'Read more', 'coworking-interface' ); ?>"></a>
		<?php } ?>

			<div class="quote-post-bg"<?php echo $coworking_interface_quote_bg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>></div>

			<div class="quote-inner">

				<?php echo coworking_interface()->icons->get_svg( 'quote', array( 'class' => 'icon-quote' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

				<h3><?php echo wp_kses( $coworking_interface_quote_content, coworking_interface_get_allowed_html_tags() ); ?></h3>
				<div class="author"><?php echo wp_kses( $coworking_interface_quote_author, coworking_interface_get_allowed_html_tags() ); ?></div>

			</div><!-- END .quote-inner -->

	</div>
</div><!-- END .si-blog-entry-content -->
