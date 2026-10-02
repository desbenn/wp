<?php
/**
 * The template for displaying header layout 3.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>

<div class="si-header-container">
	<div class="si-logo-container">
		<div class="interface-container">

			<?php
			do_action( 'coworking_interface_header_widget_location', 'left' );
			coworking_interface_header_logo_template();
			do_action( 'coworking_interface_header_widget_location', 'right' );
			?>

			<span class="si-header-element si-mobile-nav">
				<?php coworking_interface_hamburger( coworking_interface_option( 'main_nav_mobile_label' ), 'coworking-interface-primary-nav' ); ?>
			</span>

		</div><!-- END .interface-container -->
	</div><!-- END .si-logo-container -->

	<div class="si-nav-container">
		<div class="interface-container">

			<?php coworking_interface_main_navigation_template(); ?>

		</div><!-- END .interface-container -->
	</div><!-- END .si-nav-container -->
</div><!-- END .si-header-container -->
