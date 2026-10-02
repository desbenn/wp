<?php
/**
 * The template for displaying theme top bar.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

?>

<?php do_action( 'coworking_interface_before_topbar' ); ?>
<div id="coworking-interface-topbar" <?php coworking_interface_top_bar_classes(); ?>>
	<div class="interface-container">
		<div class="si-flex-row">
			<div class="col-md flex-basis-auto start-sm"><?php do_action( 'coworking_interface_topbar_widgets', 'left' ); ?></div>
			<div class="col-md flex-basis-auto end-sm"><?php do_action( 'coworking_interface_topbar_widgets', 'right' ); ?></div>
		</div>
	</div>
</div><!-- END #coworking-interface-topbar -->
<?php do_action( 'coworking_interface_after_topbar' ); ?>
