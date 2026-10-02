<?php
/**
 * Template part for displaying page header.
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

?>

<div <?php coworking_interface_page_header_classes(); ?><?php coworking_interface_page_header_atts(); ?>>
	<div class="interface-container">

	<?php do_action( 'coworking_interface_page_header_start' ); ?>

	<?php if ( coworking_interface_page_header_has_title() ) { ?>

		<div class="si-page-header-wrapper">

			<div class="si-page-header-title">
				<?php coworking_interface_page_header_title(); ?>
			</div>

			<?php $coworking_interface_description = apply_filters( 'coworking_interface_page_header_description', coworking_interface_get_the_description() ); ?>

			<?php if ( $coworking_interface_description ) { ?>

				<div class="si-page-header-description">
					<?php echo wp_kses( $coworking_interface_description, coworking_interface_get_allowed_html_tags() ); ?>
				</div>

			<?php } ?>
		</div>

	<?php } ?>

	<?php do_action( 'coworking_interface_page_header_end' ); ?>

	</div>
</div>
