<?php
/**
 * The base template for displaying theme header area.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>
<?php do_action( 'coworking_interface_before_header' ); ?>
<div id="coworking-interface-header" <?php coworking_interface_header_classes(); ?>>
	<?php do_action( 'coworking_interface_header_content' ); ?>
</div><!-- END #coworking-interface-header -->
<?php do_action( 'coworking_interface_after_header' ); ?>
