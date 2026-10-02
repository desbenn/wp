<?php
/**
 * The template for displaying theme sidebar.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

if ( ! coworking_interface_is_sidebar_displayed() ) {
	return;
}

$coworking_interface_sidebar = coworking_interface_get_sidebar();
?>

<aside id="secondary" class="widget-area si-sidebar-container"<?php coworking_interface_schema_markup( 'sidebar' ); ?> role="complementary">

	<div class="si-sidebar-inner">
		<?php do_action( 'coworking_interface_before_sidebar' ); ?>

		<?php
		if ( is_active_sidebar( $coworking_interface_sidebar ) ) {

			dynamic_sidebar( $coworking_interface_sidebar );

		} elseif ( current_user_can( 'edit_theme_options' ) ) {

			$coworking_interface_sidebar_name = coworking_interface_get_sidebar_name_by_id( $coworking_interface_sidebar );
			?>
			<div class="interface-sidebar-widget interface-widget coworking-interface-no-widget">

				<div class='h4 widget-title'><?php echo esc_html( $coworking_interface_sidebar_name ); ?></div>

				<p class='no-widget-text'>
					<?php if ( is_customize_preview() ) { ?>
						<a href='#' class="coworking-interface-set-widget" data-sidebar-id="<?php echo esc_attr( $coworking_interface_sidebar ); ?>">
					<?php } else { ?>
						<a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>'>
					<?php } ?>
						<?php esc_html_e( 'Click here to assign a widget.', 'coworking-interface' ); ?>
					</a>
				</p>
			</div>
			<?php
		}
		?>

		<?php do_action( 'coworking_interface_after_sidebar' ); ?>
	</div>

</aside><!--#secondary .widget-area -->

<?php
