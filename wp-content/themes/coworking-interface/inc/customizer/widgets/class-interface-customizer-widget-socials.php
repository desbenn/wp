<?php
/**
 * Coworking Interface Customizer widgets class.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Widget_Socials' ) ) :

	/**
	 * Coworking Interface Customizer widget class
	 */
	class Coworking_Interface_Customizer_Widget_Socials extends Coworking_Interface_Customizer_Widget_Nav {

		/**
		 * Social styles.
		 *
		 * @since 1.0.0
		 * @var array
		 */
		public $styles = array();

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 * @param array $args An array of the values for this widget.
		 */
		public function __construct( $args = array() ) {

			$values = array(
				'style'      => '',
				'visibility' => 'all',
			);

			$args['values'] = isset( $args['values'] ) ? wp_parse_args( $args['values'], $values ) : $values;

			$args['values']['style'] = sanitize_text_field( $args['values']['style'] );

			parent::__construct( $args );

			$this->name        = __( 'Social Links', 'coworking-interface' );
			$this->description = __( 'Links to your social media profiles.', 'coworking-interface' );
			$this->icon        = 'dashicons dashicons-twitter';
			$this->type        = 'socials';
			$this->styles      = isset( $args['styles'] ) ? $args['styles'] : array();
		}

		/**
		 * Displays the form for this widget on the Widgets page of the WP Admin area.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function form() {

			parent::form();

			if ( ! empty( $this->styles ) ) { ?>
				<p class="coworking-interface-widget-socials-style">
					<label for="widget-socials-<?php echo esc_attr( $this->id ); ?>-<?php echo esc_attr( $this->number ); ?>-style">
						<?php esc_html_e( 'Style', 'coworking-interface' ); ?>:
					</label>
					<select id="widget-socials-<?php echo esc_attr( $this->id ); ?>-<?php echo esc_attr( $this->number ); ?>-style" name="widget-socials[<?php echo esc_attr( $this->number ); ?>][style]" data-option-name="style">
						<?php foreach ( $this->styles as $key => $value ) { ?>
							<option 
								value="<?php echo esc_attr( $key ); ?>" 
								<?php selected( $key, $this->values['style'], true ); ?>>
								<?php echo esc_html( $value ); ?>
							</option>
						<?php } ?>
					</select>
				</p>
				<?php
			}
		}
	}
endif;
