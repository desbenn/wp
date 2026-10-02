<?php
/**
 * Header Cart Widget empty cart.
 *
 * @package     Coworking Interface
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<p class="si-empty-cart"><?php esc_html_e( 'No products in the cart.', 'coworking-interface' ); ?></p>
