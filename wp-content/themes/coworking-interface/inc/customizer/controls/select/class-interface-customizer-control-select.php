<?php
/**
 * Coworking Interface Customizer custom select control class.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Control_Select' ) ) :
	/**
	 * Coworking Interface Customizer custom select control class.
	 */
	class Coworking_Interface_Customizer_Control_Select extends Coworking_Interface_Customizer_Control {

		/**
		 * The control type.
		 *
		 * @var string
		 */
		public $type = 'coworking-interface-select';

		/**
		 * Placeholder text.
		 *
		 * @since 1.0.0
		 * @var string|false
		 */
		public $placeholder = false;

		/**
		 * Select2 flag.
		 *
		 * @since 1.0.0
		 * @var boolean
		 */
		public $is_select2 = false;

		/**
		 * Data source.
		 *
		 * @since 1.0.0
		 * @var string|false
		 */
		public $data_source = false;

		/**
		 * Multiple items.
		 *
		 * @since 1.0.0
		 * @var boolean
		 */
		public $multiple = false;

		/**
		 * Set the default typography options.
		 *
		 * @since 1.0.8
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
		 * @param string               $id      Control ID.
		 * @param array                $args    Default parent's arguments.
		 */
		public function __construct( $manager, $id, $args = array() ) {

			parent::__construct( $manager, $id, $args );

			if ( $this->is_select2 ) {

				switch ( $this->data_source ) {

					case 'category':
						$categories = get_categories();
						$choices    = array();

						if ( ! empty( $categories ) ) {

							foreach ( $categories as $category ) {
								$choices[ $category->slug ] = $category->name;
							}
						}

						$this->choices = $choices;

						break;

					default:
						// code...
						break;
				}
			}
		}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			$this->json['choices']     = $this->choices;
			$this->json['placeholder'] = $this->placeholder;
			$this->json['is_select2']  = $this->is_select2;
			$this->json['multiple']    = $this->multiple ? ' multiple="multiple"' : '';

			if ( $this->multiple ) {
				$this->json['value'] = implode( ',', (array) $this->json['value'] );
			}
		}

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue() {

			parent::enqueue();

			if ( $this->is_select2 ) {

				// Script debug.
				$coworking_interface_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

				/**
				 * Enqueue select2 stylesheet.
				 */
				wp_enqueue_style(
					'coworking-interface-select2-style',
					COWORKING_INTERFACE_URI . '/inc/admin/assets/css/select2' . $coworking_interface_suffix . '.css',
					false,
					COWORKING_INTERFACE_VERSION,
					'all'
				);

				/**
				 * Enqueue select2 script.
				 */
				wp_enqueue_script(
					'coworking-interface-select2-js',
					COWORKING_INTERFACE_URI . '/inc/admin/assets/js/libs/select2' . $coworking_interface_suffix . '.js',
					array( 'jquery' ),
					COWORKING_INTERFACE_VERSION,
					true
				);
			}
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
			<div class="interface-control-wrapper coworking-interface-select-wrapper">

				<label>
					<# if ( data.label ) { #>
						<div class="customize-control-title">
							<span>{{{ data.label }}}</span>

							<# if ( data.description ) { #>
								<i class="interface-info-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
										<circle cx="12" cy="12" r="10"></circle>
										<path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
										<line x1="12" y1="17" x2="12" y2="17"></line>
									</svg>
									<span class="interface-tooltip">{{{ data.description }}}</span>
								</i>
							<# } #>
						</div>
					<# } #>

					<select class="coworking-interface-select-control" {{{ data.link }}}{{{ data.multiple }}}>

						<# if ( data.is_select2 ) { #>

							<# _.each( data.choices, function( label, choice ) { #>

								<option value="{{ choice }}" <# if ( -1 !== data.value.indexOf( choice ) ) { #> selected="selected" <# } #>>{{ label }}</option>

							<# } ) #>

						<# } else { #>
							<# for ( key in data.choices ) { #>
								<option value="{{ key }}" <# if ( key === data.value ) { #> checked="checked" <# } #>>{{ data.choices[ key ] }}</option>
							<# } #>
						<# } #>
					</select>

				</label>

			</div><!-- END .interface-control-wrapper -->
			<?php
		}
	}
endif;
