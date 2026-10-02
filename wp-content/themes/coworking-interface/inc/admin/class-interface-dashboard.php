<?php
/**
 * Coworking Interface About page class.
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

if (!class_exists('Coworking_Interface_Dashboard')):
	/**
	 * Coworking Interface Dashboard page class.
	 */
	final class Coworking_Interface_Dashboard
	{

		/**
		 * Singleton instance of the class.
		 *
		 * @since 1.0.0
		 * @var object
		 */
		private static $instance;

		/**
		 * Main Coworking Interface Dashboard Instance.
		 *
		 * @since 1.0.0
		 * @return Coworking_Interface_Dashboard
		 */
		public static function instance()
		{

			if (!isset(self::$instance) && !(self::$instance instanceof Coworking_Interface_Dashboard)) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct()
		{

			/**
			 * Register admin menu item under Appearance menu item.
			 */
			add_action('admin_menu', array($this, 'add_to_menu'), 10);
			add_filter('submenu_file', array($this, 'highlight_submenu'));

			/**
			 * Ajax activate & deactivate plugins.
			 */
			add_action('wp_ajax_coworking-interface-plugin-activate', array($this, 'activate_plugin'));
			add_action('wp_ajax_coworking-interface-plugin-deactivate', array($this, 'deactivate_plugin'));

			/**
			 * Set admin page title for hidden pages.
			 */
			add_action('admin_init', array($this, 'set_admin_page_title'));
		}

		/**
		 * Register our custom admin menu item.
		 *
		 * @since 1.0.0
		 */
		public function add_to_menu()
		{

			/**
			 * Dashboard page.
			 */
			add_theme_page(
				esc_html__('Coworking Interface', 'coworking-interface'),
				'Coworking Interface',
				apply_filters('coworking_interface_manage_cap', 'edit_theme_options'),
				'coworking-interface-dashboard',
				array($this, 'render_dashboard')
			);

			/**
			 * Plugins page.
			 */
			add_theme_page(
				esc_html__('Plugins', 'coworking-interface'),
				'Plugins',
				apply_filters('coworking_interface_manage_cap', 'edit_theme_options'),
				'coworking-interface-plugins',
				array($this, 'render_plugins')
			);

			// Hide from admin navigation.
			remove_submenu_page('themes.php', 'coworking-interface-plugins');

			/**
			 * Changelog page.
			 */
			add_theme_page(
				esc_html__('Changelog', 'coworking-interface'),
				'Changelog',
				apply_filters('coworking_interface_manage_cap', 'edit_theme_options'),
				'coworking-interface-changelog',
				array($this, 'render_changelog')
			);

			// Hide from admin navigation.
			remove_submenu_page('themes.php', 'coworking-interface-changelog');

			/**
			 * Starter Demos page.
			 */
			add_theme_page(
				esc_html__('Starter Demos', 'coworking-interface'),
				'Starter Demos',
				apply_filters('coworking_interface_manage_cap', 'edit_theme_options'),
				'coworking-interface-starter-demos',
				array($this, 'render_starter_demos')
			);

			// Hide from admin navigation.
			remove_submenu_page('themes.php', 'coworking-interface-starter-demos');
		}

		/**
		 * Set admin page title for hidden pages.
		 *
		 * @since 1.0.0
		 */
		public function set_admin_page_title()
		{
			global $title, $plugin_page;

			if (isset($plugin_page) && empty($title)) {
				switch ($plugin_page) {
					case 'coworking-interface-plugins':
						$title = esc_html__('Plugins', 'coworking-interface');
						break;
					case 'coworking-interface-starter-demos':
						$title = esc_html__('Starter Demos', 'coworking-interface');
						break;
					case 'coworking-interface-changelog':
						$title = esc_html__('Changelog', 'coworking-interface');
						break;
				}
			}
		}

		/**
		 * Render dashboard page.
		 *
		 * @since 1.0.0
		 */
		public function render_dashboard()
		{

			// Render dashboard navigation.
			$this->render_navigation();

			?>
			<div class="interface-container">

				<div class="coworking-interface-section-title">
					<h2 class="coworking-interface-section-title"><?php esc_html_e('Getting Started', 'coworking-interface'); ?></h2>
				</div><!-- END .coworking-interface-section-title -->

				<div class="coworking-interface-section coworking-interface-columns">

					<div class="coworking-interface-column">
						<div class="coworking-interface-box">
							<h4><i
									class="dashicons dashicons-admin-plugins"></i><?php esc_html_e('Install Plugins', 'coworking-interface'); ?>
							</h4>
							<p><?php esc_html_e('Explore recommended plugins. These free plugins provide additional features and customization options.', 'coworking-interface'); ?>
							</p>

							<div class="coworking-interface-buttons">
								<a href="<?php echo esc_url(menu_page_url('coworking-interface-plugins', false)); ?>"
									class="interface-button secondary"
									role="button"><?php esc_html_e('Install Plugins', 'coworking-interface'); ?></a>
							</div><!-- END .coworking-interface-buttons -->
						</div>
					</div>

					<div class="coworking-interface-column">
						<div class="coworking-interface-box">
							<h4><i
									class="dashicons dashicons-layout"></i><?php esc_html_e('Start with a Template', 'coworking-interface'); ?>
							</h4>
							<p><?php esc_html_e('Don&rsquo;t want to start from scratch? Import a pre-built demo website in 1-click and get a head start.', 'coworking-interface'); ?>
							</p>

							<div class="coworking-interface-buttons">
								<a href="<?php echo esc_url(menu_page_url('coworking-interface-starter-demos', false)); ?>"
									class="interface-button secondary"
									role="button"><?php esc_html_e('Starter Demos', 'coworking-interface'); ?></a>
							</div><!-- END .coworking-interface-buttons -->
						</div>
					</div>

					<div class="coworking-interface-column">
						<div class="coworking-interface-box">
							<h4><i
									class="dashicons dashicons-palmtree"></i><?php esc_html_e('Upload Your Logo', 'coworking-interface'); ?>
							</h4>
							<p><?php esc_html_e('Kick off branding your new site by uploading your logo. Simply upload your logo and customize as you need.', 'coworking-interface'); ?>
							</p>

							<div class="coworking-interface-buttons">
								<a href="<?php echo esc_url(admin_url('customize.php?autofocus[control]=custom_logo')); ?>"
									class="interface-button secondary" target="_blank"
									rel="noopener noreferrer"><?php esc_html_e('Upload Logo', 'coworking-interface'); ?></a>
							</div><!-- END .coworking-interface-buttons -->
						</div>
					</div>

					<div class="coworking-interface-column">
						<div class="coworking-interface-box">
							<h4><i
									class="dashicons dashicons-welcome-widgets-menus"></i><?php esc_html_e('Change Menus', 'coworking-interface'); ?>
							</h4>
							<p><?php esc_html_e('Customize menu links and choose what&rsquo;s displayed in available theme menu locations.', 'coworking-interface'); ?>
							</p>

							<div class="coworking-interface-buttons">
								<a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="interface-button secondary"
									target="_blank"
									rel="noopener noreferrer"><?php esc_html_e('Go to Menus', 'coworking-interface'); ?></a>
							</div><!-- END .coworking-interface-buttons -->
						</div>
					</div>

					<div class="coworking-interface-column">
						<div class="coworking-interface-box">
							<h4><i class="dashicons dashicons-art"></i><?php esc_html_e('Change Colors', 'coworking-interface'); ?>
							</h4>
							<p><?php esc_html_e('Replace the default theme colors and make your website color scheme match your brand design.', 'coworking-interface'); ?>
							</p>

							<div class="coworking-interface-buttons">
								<a href="<?php echo esc_url(admin_url('customize.php?autofocus[section]=coworking_interface_section_colors')); ?>"
									class="interface-button secondary" target="_blank"
									rel="noopener noreferrer"><?php esc_html_e('Change Colors', 'coworking-interface'); ?></a>
							</div><!-- END .coworking-interface-buttons -->
						</div>
					</div>

					<div class="coworking-interface-column">
						<div class="coworking-interface-box">
							<h4><i
									class="dashicons dashicons-editor-help"></i><?php esc_html_e('Need Help?', 'coworking-interface'); ?>
							</h4>
							<p><?php esc_html_e('Head over to our site to learn more about the Coworking Interface theme, read help articles and get support.', 'coworking-interface'); ?>
							</p>

							<div class="coworking-interface-buttons">
								<a href="https://docs.wpinterface.com/coworking-interface" target="_blank" rel="noopener noreferrer"
									class="interface-button secondary"><?php esc_html_e('Help Articles', 'coworking-interface'); ?></a>
							</div><!-- END .coworking-interface-buttons -->
						</div>
					</div>
				</div><!-- END .coworking-interface-section -->

				<div class="coworking-interface-section large-section">
					<div class="coworking-interface-hero">
						<img src="<?php echo esc_url(COWORKING_INTERFACE_URI . '/assets/images/upgrade.svg'); ?>"
							alt="<?php echo esc_html('Customize'); ?>" />
					</div>

					<h2><?php esc_html_e('Let‘s customize your website', 'coworking-interface'); ?></h2>
					<p><?php esc_html_e('There are many changes you can make to customize your website. Explore Coworking Interface customization options and make it unique.', 'coworking-interface'); ?>
					</p>

					<div class="coworking-interface-buttons">
						<a href="<?php echo esc_url(admin_url('customize.php')); ?>"
							class="interface-button primary large-button"><?php esc_html_e('Start Customizing', 'coworking-interface'); ?></a>
					</div><!-- END .coworking-interface-buttons -->

				</div><!-- END .coworking-interface-section -->

				<?php do_action('coworking_interface_about_content_after'); ?>

			</div><!-- END .interface-container -->

			<?php
		}

		/**
		 * Render the recommended plugins page.
		 *
		 * @since 1.0.0
		 */
		public function render_plugins()
		{

			// Render dashboard navigation.
			$this->render_navigation();

			$plugins = coworking_interface_plugin_utilities()->get_recommended_plugins();
			?>
			<div class="interface-container">

				<div class="coworking-interface-section-title">
					<h2 class="coworking-interface-section-title"><?php esc_html_e('Recommended Plugins', 'coworking-interface'); ?>
					</h2>
				</div><!-- END .coworking-interface-section-title -->

				<div class="coworking-interface-section coworking-interface-columns plugins">

					<?php if (is_array($plugins) && !empty($plugins)) { ?>
						<?php foreach ($plugins as $plugin) { ?>

							<?php
							// Check plugin status.
							if (coworking_interface_plugin_utilities()->is_activated($plugin['slug'])) {
								$btn_class = 'interface-button secondary disabled';
								$btn_text = esc_html__('Already Activated', 'coworking-interface');
								$action = '';
								$notice = '<span class="si-active-plugin"><span class="dashicons dashicons-yes"></span>' . esc_html__('Plugin activated', 'coworking-interface') . '</span>';
							} elseif (coworking_interface_plugin_utilities()->is_installed($plugin['slug'])) {
								$btn_class = 'interface-button primary';
								$btn_text = esc_html__('Activate', 'coworking-interface');
								$action = 'activate';
								$notice = '';
							} else {
								$btn_class = 'interface-button primary';
								$btn_text = esc_html__('Install & Activate', 'coworking-interface');
								$action = 'install';
								$notice = '';
							}
							?>

							<div class="coworking-interface-column">
								<div class="coworking-interface-box">

									<div class="plugin-image">
										<img src="<?php echo esc_url($plugin['thumb']); ?>"
											alt="<?php echo esc_html($plugin['name']); ?>" />
									</div>

									<div class="plugin-info">
										<h4><?php echo esc_html($plugin['name']); ?></h4>
										<p><?php echo esc_html($plugin['desc']); ?></p>
										<div class="coworking-interface-buttons">
											<?php echo (wp_kses_post($notice)); ?>
											<a href="#" class="<?php echo esc_attr($btn_class); ?>"
												data-plugin="<?php echo esc_attr($plugin['slug']); ?>"
												data-action="<?php echo esc_attr($action); ?>"><?php echo esc_html($btn_text); ?></a>
										</div>
									</div>

								</div>
							</div>
						<?php } ?>
					<?php } ?>

				</div><!-- END .coworking-interface-section -->

				<?php do_action('coworking_interface_recommended_plugins_after'); ?>

			</div><!-- END .interface-container -->

			<?php
		}

		/**
		 * Render the starter demos page.
		 *
		 * @since 1.0.0
		 */
		public function render_starter_demos()
		{

			// Render dashboard navigation.
			$this->render_navigation();

			?>
			<div class="interface-container">
				<?php
				if (function_exists('smartocs_display_smart_import')) {
					smartocs_display_smart_import(array(
						'wrapper_class' => 'interface-smartocs',  // Custom CSS class for wrapper
						'show_header' => false,  // Hide plugin header
						'show_sidebar' => false,  // Hide theme card sidebar
						'show_smart_import_tabs' => false,  // Hide the tabs
						'show_intro_text' => false,  // Hide the intro text
					));
				} else {
					?>
					<h2 class="coworking-interface-section-title"><?php esc_html_e('Starter Demos', 'coworking-interface'); ?></h2>

					<div class="coworking-interface-box">
						<p><?php esc_html_e('Please install and activate the Smart One Click Setup plugin to import demo content.', 'coworking-interface'); ?>
						</p>
						<div class="coworking-interface-buttons">
							<a href="<?php echo esc_url(menu_page_url('coworking-interface-plugins', false)); ?>"
								class="interface-button primary"
								role="button"><?php esc_html_e('Install Plugin', 'coworking-interface'); ?></a>
						</div>
					</div>

					<?php
				}
				?>
			</div><!-- END .interface-container -->
			<?php
		}

		/**
		 * Render the changelog page.
		 *
		 * @since 1.0.0
		 */
		public function render_changelog()
		{

			// Render dashboard navigation.
			$this->render_navigation();

			$changelog = COWORKING_INTERFACE_PATH . '/changelog.txt';

			if (!file_exists($changelog)) {
				$changelog = esc_html__('Changelog file not found.', 'coworking-interface');
			} elseif (!is_readable($changelog)) {
				$changelog = esc_html__('Changelog file not readable.', 'coworking-interface');
			} else {
				global $wp_filesystem;

				// Check if the the global filesystem isn't setup yet.
				if (is_null($wp_filesystem)) {
					WP_Filesystem();
				}

				$changelog = $wp_filesystem->get_contents($changelog);
			}

			?>
			<div class="interface-container">

				<div class="coworking-interface-section-title">
					<h2 class="coworking-interface-section-title">
						<span><?php esc_html_e('Coworking Interface Changelog', 'coworking-interface'); ?></span>
						<span class="changelog-version"><?php echo esc_html(sprintf('v%1$s', COWORKING_INTERFACE_VERSION)); ?></span>
					</h2>

				</div><!-- END .coworking-interface-section-title -->

				<div class="coworking-interface-section coworking-interface-columns">

					<div class="coworking-interface-column column-12">
						<div class="coworking-interface-box coworking-interface-changelog">
							<pre><?php echo esc_html($changelog); ?></pre>
						</div>
					</div>
				</div><!-- END .coworking-interface-columns -->

				<?php do_action('coworking_interface_after_changelog'); ?>

			</div><!-- END .interface-container -->
			<?php
		}

		/**
		 * Render admin page navigation tabs.
		 *
		 * @since 1.0.0
		 */
		public function render_navigation()
		{

			// Get navigation items.
			$menu_items = $this->get_navigation_items();

			?>
			<div class="interface-container">

				<div class="coworking-interface-tabs">
					<ul>
						<?php
						// Determine current tab.
						$base = $this->get_current_page();

						// Display menu items.
						foreach ($menu_items as $item) {

							// Check if we're on a current item.
							$current = false !== strpos($base, $item['id']) ? 'current-item' : '';
							?>

							<li class="<?php echo esc_attr($current); ?>">
								<a href="<?php echo esc_url($item['url']); ?>">
									<?php echo esc_html($item['name']); ?>

									<?php
									if (isset($item['icon']) && $item['icon']) {
										coworking_interface_print_admin_icon($item['icon']);
									}
									?>
								</a>
							</li>

						<?php } ?>
					</ul>
				</div><!-- END .coworking-interface-tabs -->

			</div><!-- END .interface-container -->
			<?php
		}

		/**
		 * Return the current Coworking Interface Dashboard page.
		 *
		 * @since 1.0.0
		 * @return string $page Current dashboard page slug.
		 */
		public function get_current_page()
		{

			$page = isset($_GET['page']) ? sanitize_text_field(wp_unslash($_GET['page'])) : 'dashboard'; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$page = str_replace('coworking-interface-', '', $page);
			$page = apply_filters('coworking_interface_dashboard_current_page', $page);

			return esc_html($page);
		}

		/**
		 * Print admin page navigation items.
		 *
		 * @since 1.0.0
		 * @return array $items Array of navigation items.
		 */
		public function get_navigation_items()
		{

			$items = array(
				'dashboard' => array(
					'id' => 'dashboard',
					'name' => esc_html__('About', 'coworking-interface'),
					'icon' => '',
					'url' => menu_page_url('coworking-interface-dashboard', false),
				),
				'plugins' => array(
					'id' => 'plugins',
					'name' => esc_html__('Recommended Plugins', 'coworking-interface'),
					'icon' => '',
					'url' => menu_page_url('coworking-interface-plugins', false),
				),
				'starter-demos' => array(
					'id' => 'starter-demos',
					'name' => esc_html__('Starter Demos', 'coworking-interface'),
					'icon' => '',
					'url' => menu_page_url('coworking-interface-starter-demos', false),
				),
				'changelog' => array(
					'id' => 'changelog',
					'name' => esc_html__('Changelog', 'coworking-interface'),
					'icon' => '',
					'url' => menu_page_url('coworking-interface-changelog', false),
				),
			);

			return apply_filters('coworking_interface_dashboard_navigation_items', $items);
		}

		/**
		 * Activate plugin.
		 *
		 * @since 1.0.0
		 */
		public function activate_plugin()
		{

			// Security check.
			check_ajax_referer('coworking_interface_nonce');

			// Plugin data.
			$plugin = isset($_POST['plugin']) ? sanitize_text_field(wp_unslash($_POST['plugin'])) : '';

			if (empty($plugin)) {
				wp_send_json_error(esc_html__('Missing plugin data', 'coworking-interface'));
			}

			if ($plugin) {

				$response = coworking_interface_plugin_utilities()->activate_plugin($plugin);

				if (is_wp_error($response)) {
					wp_send_json_error($response->get_error_message(), $response->get_error_code());
				}

				wp_send_json_success();
			}

			wp_send_json_error(esc_html__('Failed to activate plugin. Missing plugin data.', 'coworking-interface'));
		}

		/**
		 * Deactivate plugin.
		 *
		 * @since 1.0.0
		 */
		public function deactivate_plugin()
		{

			// Security check.
			check_ajax_referer('coworking_interface_nonce');

			// Plugin data.
			$plugin = isset($_POST['plugin']) ? sanitize_text_field(wp_unslash($_POST['plugin'])) : '';

			if (empty($plugin)) {
				wp_send_json_error(esc_html__('Missing plugin data', 'coworking-interface'));
			}

			if ($plugin) {
				$response = coworking_interface_plugin_utilities()->deactivate_plugin($plugin);

				if (is_wp_error($response)) {
					wp_send_json_error($response->get_error_message(), $response->get_error_code());
				}

				wp_send_json_success();
			}

			wp_send_json_error(esc_html__('Failed to deactivate plugin. Missing plugin data.', 'coworking-interface'));
		}

		/**
		 * Highlight dashboard page for plugins page.
		 *
		 * @since 1.0.0
		 * @param string $submenu_file The submenu file.
		 */
		public function highlight_submenu($submenu_file)
		{

			global $pagenow;

			// Check if we're on coworking-interface plugins or changelog page.
			if ('themes.php' === $pagenow) {
				if (isset($_GET['page'])) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
					if ('coworking-interface-plugins' === $_GET['page'] || 'coworking-interface-changelog' === $_GET['page'] || 'coworking-interface-starter-demos' === $_GET['page']) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
						$submenu_file = 'coworking-interface-dashboard';
					}
				}
			}

			return $submenu_file;
		}
	}
endif;

/**
 * The function which returns the one Coworking_Interface_Dashboard instance.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $coworking_interface_dashboard = coworking_interface_dashboard(); ?>
 *
 * @since 1.0.0
 * @return object
 */
function coworking_interface_dashboard()
{
	return Coworking_Interface_Dashboard::instance();
}

coworking_interface_dashboard();
