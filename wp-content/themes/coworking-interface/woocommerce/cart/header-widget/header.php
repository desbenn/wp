<?php
/**
 * Header Cart Widget dropdown header.
 *
 * @package     Coworking Interface
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$coworking_interface_cart_count    = WC()->cart->get_cart_contents_count();
$coworking_interface_cart_subtotal = WC()->cart->get_cart_subtotal();

?>
<div class="wc-cart-widget-header">
	<span class="si-cart-count">
		<?php
		/* translators: %s: the number of cart items; */
		echo wp_kses_post( sprintf( _n( '%s item', '%s items', $coworking_interface_cart_count, 'coworking-interface' ), $coworking_interface_cart_count ) );
		?>
	</span>

	<span class="si-cart-subtotal">
		<?php
		/* translators: %s is the cart subtotal. */
		echo wp_kses_post( sprintf( __( 'Subtotal: %s', 'coworking-interface' ), '<span>' . $coworking_interface_cart_subtotal . '</span>' ) );
		?>
	</span>
</div>
