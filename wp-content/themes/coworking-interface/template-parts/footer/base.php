<?php
/**
 * The template for displaying theme footer.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>

<?php do_action( 'coworking_interface_before_footer' ); ?>
<div id="coworking-interface-footer" <?php coworking_interface_footer_classes(); ?>>
	<div class="interface-container">
		<div class="si-flex-row" id="coworking-interface-footer-widgets">

			<?php coworking_interface_footer_widgets(); ?>

		</div><!-- END .si-flex-row -->
	</div><!-- END .interface-container -->
</div><!-- END #coworking-interface-footer -->
<?php do_action( 'coworking_interface_after_footer' ); ?>
