<?php
/**
 * Coworking Interface compatibility class for Smart One Click Setup.
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

/**
 * Do not allow direct script access.
 */
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Coworking_Interface_SmartOCS')):

    /**
     * Smart One Click Setup compatibility.
     */
    class Coworking_Interface_SmartOCS
    {

        /**
         * Singleton instance of the class.
         *
         * @var object
         */
        private static $instance;

        /**
         * Instance.
         *
         * @since 1.0.0
         * @return Coworking_Interface_SmartOCS
         */
        public static function instance()
        {
            if (!isset(self::$instance) && !(self::$instance instanceof Coworking_Interface_SmartOCS)) {
                self::$instance = new Coworking_Interface_SmartOCS();
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
            // After import setup.
            add_action('smartocs/after_import', array($this, 'after_import_setup'));

            // Enable attachment/image fetching during import.
            add_filter('smartocs/importer_options', array($this, 'set_importer_options'));

            // Increase HTTP timeout for large image downloads.
            add_filter('http_request_timeout', array($this, 'increase_http_timeout'), 10, 2);
        }

        /**
         * Enable attachment/image fetching during import.
         *
         * @since 1.0.0
         * @param array $options Importer options.
         * @return array
         */
        public function set_importer_options($options)
        {
            $options['fetch_attachments'] = true;
            return $options;
        }

        /**
         * Increase HTTP timeout for large image imports.
         *
         * @since 1.0.0
         * @param int    $timeout Default timeout in seconds.
         * @param string $url     Request URL.
         * @return int
         */
        public function increase_http_timeout($timeout, $url)
        {
            // Apply extended timeout only during admin import operations.
            if (is_admin() && function_exists('get_current_screen')) {
                return 300; // 5 minutes for large image downloads.
            }
            return $timeout;
        }

        /**
         * After import setup.
         *
         * @since 1.0.0
         * @param array $selected_import Selected import data.
         * @return void
         */
        public function after_import_setup($selected_import)
        {

            // Assign menus to locations.
            $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

            if ($main_menu) {
                set_theme_mod(
                    'nav_menu_locations',
                    array(
                        'primary' => $main_menu->term_id,
                        'footer' => $main_menu->term_id,
                    )
                );
            }

            // Set front page.
            $front_page = get_page_by_title('Home');

            if ($front_page) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $front_page->ID);
            }

            // Set blog page.
            $blog_page = get_page_by_title('Blog');

            if ($blog_page) {
                update_option('page_for_posts', $blog_page->ID);
            }

            // Flush rewrite rules.
            flush_rewrite_rules();


        }
    }

endif;



// Disable admin menu items
add_filter('smartocs/disable_admin_menu', '__return_true');

/**
 * Returns the one Coworking_Interface_SmartOCS instance.
 */
function coworking_interface_smartocs()
{
    return Coworking_Interface_SmartOCS::instance();
}

coworking_interface_smartocs();
