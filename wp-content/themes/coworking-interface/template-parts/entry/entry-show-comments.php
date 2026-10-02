<?php
/**
 * Template part for displaying ”Show Comments” button.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

// Do not show if the post is password protected.
if ( post_password_required() ) {
	return;
}

$coworking_interface_comment_count = get_comments_number();
$coworking_interface_comment_title = esc_html__( 'Leave a Comment', 'coworking-interface' );

if ( $coworking_interface_comment_count > 0 ) {
	/* translators: %s is comment count */
	$coworking_interface_comment_title = esc_html( sprintf( _n( 'Show %s Comment', 'Show %s Comments', $coworking_interface_comment_count, 'coworking-interface' ), $coworking_interface_comment_count ) );
}

?>
<a href="#" id="coworking-interface-comments-toggle" class="interface-button button-large btn-fw btn-left-icon">
	<?php echo coworking_interface()->icons->get_svg( 'chat' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<span><?php echo $coworking_interface_comment_title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
</a>
