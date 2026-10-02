<?php
/**
 * Coworking Interface Customizer Widget control class.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Control_Widget' ) ) :
	/**
	 * Coworking Interface Customizer custom select control class.
	 */
	class Coworking_Interface_Customizer_Control_Widget extends Coworking_Interface_Customizer_Control {

		/**
		 * The control type.
		 *
		 * @var string
		 */
		public $type = 'coworking-interface-widget';

		/**
		 * Array of allowed customizer widgets.
		 *
		 * @var array
		 */
		public $widgets = array();

		/**
		 * Array of locations for widgets.
		 *
		 * @var array
		 */
		public $locations = array();

		/**
		 * Array of visibility options for widgets.
		 *
		 * @var array
		 */
		public $visibility = array();

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			$this->json['widgets']    = $this->widgets;
			$this->json['locations']  = $this->locations;
			$this->json['visibility'] = $this->visibility;

			// Add widget templates to be used when generating new widgets.
			if ( is_array( $this->widgets ) && ! empty( $this->widgets ) ) {

				// Get all widgets.
				$widgets = coworking_interface_get_customizer_widgets();

				foreach ( $this->widgets as $widget_id => $args ) {

					// If this widget is not defined, skip.
					if ( ! isset( $widgets[ $widget_id ] ) ) {
						continue;
					}

					// Widget locations.
					$args['locations']  = $this->locations;
					$args['visibility'] = $this->visibility;
					$args['id']         = $this->id;

					// Create a widget instance.
					$classname = $widgets[ $widget_id ];
					$instance  = new $classname( $args );

					// Add info about max uses for the widget.
					$max_uses = isset( $args['max_uses'] ) ? intval( $args['max_uses'] ) : -1;

					ob_start();
					?>
					<div data-widget-id="<?php echo esc_attr( $instance->id_base ); ?>" class="coworking-interface-widget-tpl-<?php echo esc_attr( $instance->id_base ); ?> coworking-interface-widget" data-max-uses=<?php echo esc_attr( $max_uses ); ?>>
						<?php $instance->template(); ?>
					</div>
					<?php
					$this->json['widget_tpl'][ $widget_id ] = ob_get_clean();
				}
			}

			$value = $this->value();

			$this->json['value'] = array();

			// Added widgets.
			if ( is_array( $value ) && ! empty( $value ) ) {
				foreach ( $value as $i => $widget ) {

					// Widget type is required.
					if ( ! isset( $widget['type'], $widget['values'] ) ) {
						continue;
					}

					// This widget type is not allowed.
					if ( ! isset( $this->widgets[ $widget['type'] ] ) ) {
						continue;
					}

					// Create widget instance.
					$classname = $widget['classname'];

					$args = $this->widgets[ $widget['type'] ];

					$args['id']         = $this->id . '_' . $i;
					$args['number']     = $i;
					$args['values']     = $widget['values'];
					$args['locations']  = $this->locations;
					$args['visibility'] = $this->visibility;

					if ( class_exists( $classname ) ) {
						$instance = new $classname( $args );

						// Print widget template.
						ob_start();
						$instance->template();
						$this->json['value'][] = ob_get_clean();
					}
				}
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
			<div class="interface-control-wrapper coworking-interface-widget-wrapper">

				<div class="coworking-interface-widget-container">

					<# _.each( data.value, function( template, i ) { #>
						{{{ template }}}
					<# }); #>

				</div><!-- END .coworking-interface-widget-container -->

				<div class="coworking-interface-add-widget-wrap">
					<button type="button" class="button coworking-interface-add-widget" data-location-title="{{{ data.label }}}" data-control="{{{ data.id }}}"><?php esc_html_e( 'Add Widget', 'coworking-interface' ); ?></button>
				</div>

				<div class="coworking-interface-widget-tmpls">

					<# _.each( data.widget_tpl, function( template, i ) { #>
						{{{ template }}}
					<# }); #>

				</div>

			</div><!-- END .interface-control-wrapper -->
			<?php
		}
	}
endif;
