<?php
/**
 * Template part for displaying page header for single post.
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

?>

<div <?php coworking_interface_page_header_classes(); ?><?php coworking_interface_page_header_atts(); ?>>

	<?php do_action( 'coworking_interface_page_header_start' ); ?>

	<?php if ( coworking_interface_option( 'post_header_enable' ) || 'in-page-header' === coworking_interface_option( 'single_title_position' ) ) { ?>

		<div class="interface-container">
			<div class="si-page-header-wrapper">

				<?php
				if ( coworking_interface_single_post_displays( 'category' ) ) {
					get_template_part( 'template-parts/entry/entry', 'category' );
				}

				if ( coworking_interface_page_header_has_title() ) {
					echo '<div class="si-page-header-title">';
					coworking_interface_page_header_title();
					echo '</div>';
				}

				if ( coworking_interface_has_entry_meta_elements() ) {
					get_template_part( 'template-parts/entry/entry', 'meta' );
				}
				?>

			</div>
		</div>

	<?php } ?>

	<?php do_action( 'coworking_interface_page_header_end' ); ?>

</div>
