<?php
/**
 * Template part for displaying entry tags.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

$coworking_interface_entry_elements    = coworking_interface_option( 'single_post_elements' );
$coworking_interface_entry_footer_tags = isset( $coworking_interface_entry_elements['tags'] ) && $coworking_interface_entry_elements['tags'] && has_tag();
$coworking_interface_entry_footer_date = isset( $coworking_interface_entry_elements['last-updated'] ) && $coworking_interface_entry_elements['last-updated'] && get_the_time( 'U' ) !== get_the_modified_time( 'U' );

$coworking_interface_entry_footer_tags = apply_filters( 'coworking_interface_display_entry_footer_tags', $coworking_interface_entry_footer_tags );
$coworking_interface_entry_footer_date = apply_filters( 'coworking_interface_display_entry_footer_date', $coworking_interface_entry_footer_date );

// Nothing is enabled, don't display the div.
if ( ! $coworking_interface_entry_footer_tags && ! $coworking_interface_entry_footer_date ) {
	return;
}
?>

<?php do_action( 'coworking_interface_before_entry_footer' ); ?>

<div class="entry-footer">

	<?php
	// Post Tags.
	if ( $coworking_interface_entry_footer_tags ) {
		coworking_interface_entry_meta_tag(
			'<div class="post-tags"><span class="cat-links">',
			'',
			'</span></div>',
			0,
			false
		);
	}

	// Last Updated Date.
	if ( $coworking_interface_entry_footer_date ) {

		$coworking_interface_before = '<span class="last-updated si-iflex-center">';

		if ( true === coworking_interface_option( 'single_entry_meta_icons' ) ) {
			$coworking_interface_before .= coworking_interface()->icons->get_svg( 'edit-3' );
		}

		coworking_interface_entry_meta_date(
			array(
				'show_published' => false,
				'show_modified'  => true,
				'before'         => $coworking_interface_before,
				'after'          => '</span>',
			)
		);
	}
	?>

</div>

<?php do_action( 'coworking_interface_after_entry_footer' ); ?>
