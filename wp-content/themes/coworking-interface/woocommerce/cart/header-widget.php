<?php
/**
 * Header Cart Widget.
 *
 * @package     Coworking Interface
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$coworking_interface_cart_count = WC()->cart->get_cart_contents_count();
$coworking_interface_cart_icon  = apply_filters( 'coworking_interface_wc_cart_widget_icon', 'shopping-cart' );

?>
<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="si-cart">
	<?php echo coworking_interface()->icons->get_svg( $coworking_interface_cart_icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php if ( $coworking_interface_cart_count > 0 ) { ?>
		<span class="si-cart-count"><?php echo esc_html( $coworking_interface_cart_count ); ?></span>
	<?php } ?>
</a>
