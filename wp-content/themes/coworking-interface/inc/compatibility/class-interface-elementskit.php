<?php
/**
 * Coworking Interface compatibility class for ElementsKit Header & Footer builder.
 *
 * When ElementsKit's "Header & Footer" module replaces the site header via the
 * generic Theme_Support hook (get_header), it renders its own template and then
 * swallows the theme's header.php output with ob_start() / ob_get_clean(). This
 * means the `coworking_interface_page_header` action that fires inside header.php
 * (and outputs the in-page-header for single posts) never produces any visible
 * output. This class fixes that by hooking onto ElementsKit's
 * `elementskit/template/after_header` action and manually calling the page-header
 * template when a matching page-header should be displayed.
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

// Return if ElementsKit is not active.
if ( ! class_exists( 'ElementsKit_Lite\Modules\Header_Footer\Activator' ) ) {
	return;
}

if ( ! class_exists( 'Coworking_Interface_ElementsKit' ) ) :

	/**
	 * ElementsKit Header & Footer compatibility.
	 *
	 * @since 1.0.0
	 */
	class Coworking_Interface_ElementsKit {

		/**
		 * Singleton instance of the class.
		 *
		 * @var Coworking_Interface_ElementsKit
		 */
		private static $instance;

		/**
		 * Instance.
		 *
		 * @since 1.0.0
		 * @return Coworking_Interface_ElementsKit
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Coworking_Interface_ElementsKit ) ) {
				self::$instance = new Coworking_Interface_ElementsKit();
			}
			return self::$instance;
		}

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function __construct() {
			/**
			 * ElementsKit fires this action after it renders the custom header block.
			 * We use it to output the theme's page-header (in-page-header / breadcrumbs)
			 * which would otherwise be lost because ElementsKit suppresses header.php output.
			 */
			add_action( 'elementskit/template/after_header', array( $this, 'output_page_header' ) );
		}

		/**
		 * Output the theme page header after the ElementsKit header.
		 *
		 * This mirrors what `header.php` would normally do via the
		 * `coworking_interface_page_header` action, but only when ElementsKit
		 * is actually replacing the theme header (i.e. a header template ID exists).
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function output_page_header() {

			// Only act when ElementsKit has an active header template – if it
			// didn't replace the header, our hook was never reached anyway, but
			// this provides an extra safety guard.
			$template_ids = \ElementsKit_Lite\Modules\Header_Footer\Activator::template_ids();
			if ( empty( $template_ids[0] ) ) {
				return;
			}

			// Re-run the same action the theme fires inside header.php.
			// coworking_interface_page_header_template() is attached to this action
			// and handles the is_page_header_displayed() check internally.
			do_action( 'coworking_interface_page_header' );
		}
	}

endif;

/**
 * Returns the one Coworking_Interface_ElementsKit instance.
 *
 * @since 1.0.0
 * @return Coworking_Interface_ElementsKit
 */
function coworking_interface_elementskit() {
	return Coworking_Interface_ElementsKit::instance();
}

coworking_interface_elementskit();
