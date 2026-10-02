<?php
/**
 * Admin class.
 *
 * This class ties together all admin classes.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

/**
 * Do not allow direct script access.
 */
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('Coworking_Interface_Admin')):

	/**
	 * Admin Class
	 */
	class Coworking_Interface_Admin
	{

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct()
		{

			/**
			 * Include admin files.
			 */
			$this->includes();

			/**
			 * Load admin assets.
			 */
			add_action('admin_enqueue_scripts', array($this, 'load_assets'));

			/**
			 * Add filters for WordPress header and footer text.
			 */
			add_filter('admin_footer_text', array($this, 'filter_admin_footer_text'), 50);

			/**
			 * Admin page header.
			 */
			add_action('in_admin_header', array($this, 'admin_header'), 100);

			/**
			 * Admin page footer.
			 */
			add_action('in_admin_footer', array($this, 'admin_footer'), 100);

			/**
			 * Add notices.
			 */
			add_action('admin_notices', array($this, 'admin_notices'));

			/**
			 * After admin loaded
			 */
			do_action('coworking_interface_admin_loaded');
		}

		/**
		 * Includes files.
		 *
		 * @since 1.0.0
		 */
		private function includes()
		{

			/**
			 * Include helper functions.
			 */
			require_once COWORKING_INTERFACE_PATH . '/inc/admin/helpers.php'; // phpcs:ignore

			/**
			 * Include Coworking Interface welcome page.
			 */
			require_once COWORKING_INTERFACE_PATH . '/inc/admin/class-interface-dashboard.php'; // phpcs:ignore

			/**
			 * Include Coworking Interface meta boxes.
			 */
			require_once COWORKING_INTERFACE_PATH . '/inc/admin/metabox/class-interface-meta-boxes.php'; // phpcs:ignore
		}

		/**
		 * Load our required assets on admin pages.
		 *
		 * @since 1.0.0
		 * @param string $hook it holds the information about the current page.
		 */
		public function load_assets($hook)
		{

			/**
			 * Do not enqueue if we are not on one of our pages or showing the plugins notice on the dashboard/themes pages.
			 */
			$is_notice_page = in_array($hook, array('index.php', 'themes.php'), true) && !coworking_interface_is_notice_dismissed('coworking_interface_notice_recommended-plugins');
			if (!$is_notice_page && !coworking_interface_is_admin_page($hook)) {
				return;
			}

			// Script debug.
			$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

			/**
			 * Enqueue admin pages stylesheet.
			 */
			if (coworking_interface_is_admin_page($hook)) {
				wp_enqueue_style(
					'coworking-interface-admin-styles',
					COWORKING_INTERFACE_URI . '/inc/admin/assets/css/admin' . $suffix . '.css',
					false,
					COWORKING_INTERFACE_VERSION
				);
			}

			/**
			 * Enqueue admin pages script.
			 */
			wp_enqueue_script(
				'coworking-interface-admin-script',
				COWORKING_INTERFACE_URI . '/inc/admin/assets/js/admin' . $suffix . '.js',
				array('jquery', 'wp-util', 'updates'),
				COWORKING_INTERFACE_VERSION,
				true
			);

			/**
			 * Localize admin strings.
			 */
			$texts = array(
				'install' => esc_html__('Install', 'coworking-interface'),
				'install-inprogress' => esc_html__('Installing...', 'coworking-interface'),
				'activate-inprogress' => esc_html__('Activating...', 'coworking-interface'),
				'deactivate-inprogress' => esc_html__('Deactivating...', 'coworking-interface'),
				'active' => esc_html__('Active', 'coworking-interface'),
				'retry' => esc_html__('Retry', 'coworking-interface'),
				'please_wait' => esc_html__('Please Wait...', 'coworking-interface'),
				'importing' => esc_html__('Importing... Please Wait...', 'coworking-interface'),
				'currently_processing' => esc_html__('Currently processing: ', 'coworking-interface'),
				'import' => esc_html__('Import', 'coworking-interface'),
				'import_demo' => esc_html__('Import Demo', 'coworking-interface'),
				'importing_notice' => esc_html__('The demo importer is still working. Closing this window may result in failed import.', 'coworking-interface'),
				'import_complete' => esc_html__('Import Complete!', 'coworking-interface'),
				'import_complete_desc' => esc_html__('The demo has been imported.', 'coworking-interface') . ' <a href="' . esc_url(get_home_url()) . '">' . esc_html__('Visit site.', 'coworking-interface') . '</a>',
			);

			$strings = array(
				'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
				'wpnonce' => wp_create_nonce('coworking_interface_nonce'),
				'texts' => $texts,
				'color_pallete' => array('#424F7A', '#06cca6', '#2c2e3a', '#e4e7ec', '#f0b849', '#ffffff', '#000000'),
			);

			$strings = apply_filters('coworking_interface_admin_strings', $strings);

			wp_localize_script('coworking-interface-admin-script', 'coworking_interface_strings', $strings);
		}

		/**
		 * Filter WordPress footer left text to display our text.
		 *
		 * @since 1.0.0
		 * @param string $text Text that we're going to replace.
		 */
		public function filter_admin_footer_text($text)
		{

			if (coworking_interface_is_admin_page()) {
				return;
			}

			return $text;
		}

		/**
		 * Outputs the page admin header.
		 *
		 * @since 1.0.0
		 */
		public function admin_header()
		{

			$base = get_current_screen()->base;

			if (!coworking_interface_is_admin_page($base)) {
				return;
			}
			?>

			<div id="coworking-interface-header">
				<div class="interface-container">

					<a href="<?php echo esc_url(admin_url('admin.php?page=coworking-interface-dashboard')); ?>"
						class="coworking-interface-logo">
						<img src="<?php echo esc_url(COWORKING_INTERFACE_URI . '/assets/images/coworking-interface-logo.svg'); ?>"
							alt="<?php echo esc_html('Coworking Interface'); ?>" />
					</a>

					<div class="coworking-interface-header-action">
                        <a href="<?php echo esc_url('https://wpinterface.com/themes/coworking-interface/#choose-pricing-plan'); ?>" class="interface-button primary" target="_blank" rel="noopener noreferrer"><span class="dashicons dashicons-unlock"></span><span class="interface-button-label"><?php esc_html_e('Unlock Pro Features', 'coworking-interface'); ?></span></a>
                        <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="interface-button secondary"><span class="dashicons dashicons-admin-customizer"></span><span class="interface-button-label hide-button-label"><?php esc_html_e('Customize', 'coworking-interface'); ?></span></a>
                        <a href="<?php echo esc_url('https://wpinterface.com/support/'); ?>" class="interface-button secondary" target="_blank" rel="noopener noreferrer"><span class="dashicons dashicons-editor-help"></span><span class="interface-button-label hide-button-label"><?php esc_html_e('Help Center', 'coworking-interface'); ?></span></a>
					</div>

				</div>
			</div><!-- END #coworking-interface-header -->
			<?php
		}

		/**
		 * Outputs the page admin footer.
		 *
		 * @since 1.0.0
		 */
		public function admin_footer()
		{

			$base = get_current_screen()->base;

			if (!coworking_interface_is_admin_page($base) || coworking_interface_is_admin_page($base, 'coworking_interface_wizard')) {
				return;
			}
			?>
			<div id="coworking-interface-footer">
				<ul>
					<li>
                        <a href="<?php echo esc_url('https://docs.wpinterface.com/coworking-interface'); ?>" target="_blank" rel="noopener noreferrer">
                            <?php esc_html_e('Help Articles', 'coworking-interface'); ?>
                        </a>
					</li>
					<li>
                        <a href="<?php echo esc_url('https://wordpress.org/support/theme/coworking-interface/reviews/#new-post'); ?>" target="_blank" rel="noopener noreferrer">
                            <span class="dashicons dashicons-heart" aria-hidden="true"></span><?php esc_html_e('Leave a Review', 'coworking-interface'); ?>
                        </a>
					</li>
				</ul>
			</div><!-- END #coworking-interface-footer -->

			<?php
		}

		/**
		 * Admin Notices
		 *
		 * @since 1.0.0
		 */
		public function admin_notices()
		{

			$screen = get_current_screen();

			// Display on Dashboard, Themes and Coworking Interface admin pages.
			if (!in_array($screen->base, array('dashboard', 'themes'), true) && !coworking_interface_is_admin_page()) {
				return;
			}

			// Display if not dismissed and not on Coworking Interface plugins page.
			if (!coworking_interface_is_notice_dismissed('coworking_interface_notice_recommended-plugins') && !coworking_interface_is_admin_page(false, 'coworking-interface-plugins')) {

				$plugins = coworking_interface_plugin_utilities()->get_recommended_plugins();
				$plugins = coworking_interface_plugin_utilities()->get_deactivated_plugins($plugins);

				$plugin_list = '';

				if (is_array($plugins) && !empty($plugins)) {

					$plugin_list = '<div class="plugins">';
					foreach ($plugins as $slug => $plugin) {
						if (coworking_interface_plugin_utilities()->is_installed($slug)) {
							$action = 'activate';
							$btn_text = esc_html__('Activate', 'coworking-interface') . ' ' . esc_html($plugin['name']);
						} else {
							$action = 'install';
							$btn_text = esc_html__('Install Now', 'coworking-interface') . ' ' . esc_html($plugin['name']);
						}

						$plugin_list .= '<a href="#" class="interface-button primary button-primary" style="margin-left:5px;margin-right:5px;" data-plugin="' . esc_attr($slug) . '" data-action="' . esc_attr($action) . '">' . $btn_text . '</a>';
					}
					$plugin_list .= '</div>';

					wp_enqueue_script('plugin-install');

                    $message = esc_html__('Thanks for choosing Coworking Interface! We recommend the following plugins to help you unlock more features and get the most out of your website:', 'coworking-interface') . $plugin_list;

                    coworking_interface_print_notice(
						array(
							'type' => 'info',
							'message' => $message,
							'message_id' => 'recommended-plugins',
							'expires' => 7 * 24 * 60 * 60,
						)
					);
				}
			}

		}
	}
endif;
