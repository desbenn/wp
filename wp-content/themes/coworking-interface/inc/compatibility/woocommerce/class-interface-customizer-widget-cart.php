<?php
/**
 * Coworking Interface Customizer widgets class.
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Coworking_Interface_Customizer_Widget_Cart' ) ) :

	/**
	 * Coworking Interface Customizer widget class
	 */
	class Coworking_Interface_Customizer_Widget_Cart extends Coworking_Interface_Customizer_Widget {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 * @param array $args An array of the values for this widget.
		 */
		public function __construct( $args = array() ) {

			parent::__construct( $args );

			$this->name        = esc_html__( 'Cart', 'coworking-interface' );
			$this->description = esc_html__( 'Displays WooCommerce cart.', 'coworking-interface' );
			$this->icon        = 'dashicons dashicons-cart';
			$this->type        = 'cart';
		}

		/**
		 * Displays the form for this widget on the Widgets page of the WP Admin area.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function form() {}
	}
endif;
