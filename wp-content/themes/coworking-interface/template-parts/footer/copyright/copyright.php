<?php
/**
 * The template for displaying theme copyright bar.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>

<?php do_action( 'coworking_interface_before_copyright' ); ?>
<div id="coworking-interface-copyright" <?php coworking_interface_copyright_classes(); ?>>
	<div class="interface-container">
		<div class="si-flex-row">

			<div class="col-xs-12 center-xs col-md flex-basis-auto start-md"><?php do_action( 'coworking_interface_copyright_widgets', 'start' ); ?></div>
			<div class="col-xs-12 center-xs col-md flex-basis-auto end-md"><?php do_action( 'coworking_interface_copyright_widgets', 'end' ); ?></div>

		</div><!-- END .si-flex-row -->
	</div>
</div><!-- END #coworking-interface-copyright -->
<?php do_action( 'coworking_interface_after_copyright' ); ?>
