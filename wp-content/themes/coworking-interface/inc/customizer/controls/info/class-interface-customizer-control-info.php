<?php
/**
 * Coworking Interface Customizer info control class.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Control_Info' ) ) :
	/**
	 * Coworking Interface Customizer info control class.
	 */
	class Coworking_Interface_Customizer_Control_Info extends Coworking_Interface_Customizer_Control {

		/**
		 * The control type.
		 *
		 * @var string
		 */
		public $type = 'coworking-interface-info';

		/**
		 * Custom URL.
		 *
		 * @since  1.0.0
		 * @var    string
		 */
		public $url = '';

		/**
		 * Link target.
		 *
		 * @since  1.0.0
		 * @var    string
		 */
		public $target = '_blank';

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue() {

			// Script debug.
			$coworking_interface_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			// Control type.
			$coworking_interface_type = str_replace( 'coworking-interface-', '', $this->type );

			/**
			 * Enqueue control stylesheet
			 */
			wp_enqueue_style(
				'coworking-interface-' . $coworking_interface_type . '-control-style',
				COWORKING_INTERFACE_URI . '/inc/customizer/controls/' . $coworking_interface_type . '/' . $coworking_interface_type . $coworking_interface_suffix . '.css',
				false,
				COWORKING_INTERFACE_VERSION,
				'all'
			);
		}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			$this->json['url']    = $this->url;
			$this->json['target'] = $this->target;
		}

		/**
		 * An Underscore (JS) template for this control's content (but not its container).
		 *
		 * Class variables for this control class are available in the `data` JS object;
		 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
		 *
		 * @see WP_Customize_Control::print_template()
		 */
		protected function content_template() {
			?>
			<div class="interface-info-wrapper interface-control-wrapper">

				<# if ( data.label ) { #>
					<span class="coworking-interface-control-heading customize-control-title coworking-interface-field">{{{ data.label }}}</span>
				<# } #>

				<# if ( data.description ) { #>
					<div class="description customize-control-description coworking-interface-field coworking-interface-info-description">{{{ data.description }}}</div>
				<# } #>

				<a href="{{ data.url }}" class="button button-primary" target="{{ data.target }}" rel="noopener noreferrer"><?php esc_html_e( 'Learn More', 'coworking-interface' ); ?></a>

			</div><!-- END .interface-control-wrapper -->
			<?php
		}

	}
endif;
