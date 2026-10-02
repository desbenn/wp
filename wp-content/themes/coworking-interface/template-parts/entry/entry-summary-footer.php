<?php
/**
 * Template part for displaying entry footer.
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

?>

<?php do_action( 'coworking_interface_before_entry_footer' ); ?>
<footer class="entry-footer">
	<?php

	// Allow text to be filtered.
	$coworking_interface_read_more_text = apply_filters( 'coworking_interface_entry_read_more_text', __( 'Read More', 'coworking-interface' ) );

	?>
	<a href="<?php echo esc_url( coworking_interface_entry_get_permalink() ); ?>" class="interface-button btn-text-1"><span><?php echo esc_html( $coworking_interface_read_more_text ); ?></span></a>
</footer>
<?php do_action( 'coworking_interface_after_entry_footer' ); ?>
