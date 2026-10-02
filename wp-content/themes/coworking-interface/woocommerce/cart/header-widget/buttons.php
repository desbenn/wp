<?php
/**
 * Header Cart Widget cart & checkout buttons.
 *
 * @package     Coworking Interface
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="si-cart-buttons">
	<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="interface-button btn-text-1" role="button">
		<span><?php esc_html_e( 'View Cart', 'coworking-interface' ); ?></span>
	</a>

	<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="interface-button btn-fw" role="button">
		<span><?php esc_html_e( 'Checkout', 'coworking-interface' ); ?></span>
	</a>
</div>
