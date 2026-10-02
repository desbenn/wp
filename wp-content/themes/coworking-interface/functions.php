<?php
/**
 * Theme functions and definitions.
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

/**
 * Main Coworking Interface class.
 *
 * @since 1.0.0
 */
final class Coworking_Interface
{

	/**
	 * Singleton instance of the class.
	 *
	 * @since 1.0.0
	 * @var object
	 */
	private static $instance;

	/**
	 * Theme version.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $version = '1.0.2';

    /**
     * Theme option handler.
     *
     * @var Coworking_Interface_Options
     */
    public $options;

    /**
     * Font handler.
     *
     * @var Coworking_Interface_Fonts
     */
    public $fonts;

    /**
     * Icon handler.
     *
     * @var Coworking_Interface_Icons
     */
    public $icons;

    /**
     * Customizer handler.
     *
     * @var Coworking_Interface_Customizer
     */
    public $customizer;

    /**
     * Admin handler.
     *
     * @var Coworking_Interface_Admin
     */
    public $admin;
	/**
	 * Main Coworking Interface Instance.
	 *
	 * Insures that only one instance of Coworking Interface exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 1.0.0
	 * @return Coworking Interface
	 */
	public static function instance()
	{

		if (!isset(self::$instance) && !(self::$instance instanceof Coworking_Interface)) {
			self::$instance = new Coworking_Interface();

			self::$instance->constants();
			self::$instance->includes();
			self::$instance->objects();

			// Hook now that all of the Coworking Interface stuff is loaded.
			do_action('coworking_interface_loaded');
		}
		return self::$instance;
	}

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Setup constants.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function constants()
	{

		if (!defined('COWORKING_INTERFACE_VERSION')) {
			define('COWORKING_INTERFACE_VERSION', $this->version);
		}

		if (!defined('COWORKING_INTERFACE_URI')) {
			define('COWORKING_INTERFACE_URI', get_parent_theme_file_uri());
		}

		if (!defined('COWORKING_INTERFACE_PATH')) {
			define('COWORKING_INTERFACE_PATH', get_parent_theme_file_path());
		}
	}

	/**
	 * Include files.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function includes()
	{

		require_once COWORKING_INTERFACE_PATH . '/inc/common.php';

		require_once COWORKING_INTERFACE_PATH . '/inc/helpers.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/widgets.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/template-tags.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/template-parts.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/icon-functions.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/breadcrumbs.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/class-interface-dynamic-styles.php';

		// Core.
		require_once COWORKING_INTERFACE_PATH . '/inc/core/class-interface-options.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/core/class-interface-enqueue-scripts.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/core/class-interface-fonts.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/core/class-interface-theme-setup.php';

		// Compatibility.
		require_once COWORKING_INTERFACE_PATH . '/inc/compatibility/woocommerce/class-interface-woocommerce.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/compatibility/class-interface-wpforms.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/compatibility/class-interface-jetpack.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/compatibility/class-interface-beaver-themer.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/compatibility/class-interface-elementor.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/compatibility/class-interface-elementor-pro.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/compatibility/class-interface-hfe.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/compatibility/class-interface-elementskit.php';
		require_once COWORKING_INTERFACE_PATH . '/inc/compatibility/class-interface-smartocs.php';

		if (is_admin()) {
			require_once COWORKING_INTERFACE_PATH . '/inc/utilities/class-interface-plugin-utilities.php';
			require_once COWORKING_INTERFACE_PATH . '/inc/admin/class-interface-admin.php';
		}

		// Customizer.
		require_once COWORKING_INTERFACE_PATH . '/inc/customizer/class-interface-customizer.php';
	}

	/**
	 * Setup objects to be used throughout the theme.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function objects()
	{

		coworking_interface()->options = new Coworking_Interface_Options();
		coworking_interface()->fonts = new Coworking_Interface_Fonts();
		coworking_interface()->icons = new Coworking_Interface_Icons();
		coworking_interface()->customizer = new Coworking_Interface_Customizer();

		if (is_admin()) {
			coworking_interface()->admin = new Coworking_Interface_Admin();
		}
	}
}

/**
 * The function which returns the one Coworking Interface instance.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $coworking-interface = coworking_interface(); ?>
 *
 * @since 1.0.0
 * @return object
 */
function coworking_interface()
{
	return Coworking_Interface::instance();
}

coworking_interface();

/**
 * Declare theme category for WPInterface Add-ons demo import.
 * 
 * @since 1.0.0
 * @return string
 */
add_filter('wpinterface_theme_category', function () {
	return 'business';
});