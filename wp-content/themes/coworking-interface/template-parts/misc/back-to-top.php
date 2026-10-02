<?php
/**
 * The template for displaying scroll to top button.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>

<a href="#" id="si-scroll-top" class="si-smooth-scroll" title="<?php esc_attr_e( 'Scroll to Top', 'coworking-interface' ); ?>" <?php coworking_interface_scroll_top_classes(); ?>>
	<span class="si-scroll-icon" aria-hidden="true">
		<?php echo coworking_interface()->icons->get_svg( 'chevron-up', array( 'class' => 'top-icon' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo coworking_interface()->icons->get_svg( 'chevron-up' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</span>
	<span class="screen-reader-text"><?php esc_html_e( 'Scroll to Top', 'coworking-interface' ); ?></span>
</a><!-- END #coworking-interface-scroll-to-top -->
