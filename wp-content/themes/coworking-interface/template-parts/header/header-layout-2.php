<?php
/**
 * The template for displaying header layout 2.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>

<div class="interface-container si-header-container">

	<?php
	coworking_interface_header_logo_template();
	coworking_interface_main_navigation_template();

	do_action( 'coworking_interface_header_widget_location', array( 'left', 'right' ) );
	?>

	<span class="si-header-element si-mobile-nav">
		<?php coworking_interface_hamburger( coworking_interface_option( 'main_nav_mobile_label' ), 'coworking-interface-primary-nav' ); ?>
	</span>

</div><!-- END .interface-container -->
