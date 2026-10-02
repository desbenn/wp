<?php
/**
 * Template part for displaying entry header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php do_action( 'coworking_interface_before_entry_header' ); ?>
<header class="entry-header">

	<?php
	$coworking_interface_tag = is_single( get_the_ID() ) && ! coworking_interface_page_header_has_title() ? 'h1' : 'h2';
	$coworking_interface_tag = apply_filters( 'coworking_interface_entry_header_tag', $coworking_interface_tag );

	$coworking_interface_title_string = '%2$s%1$s';

	if ( 'link' === get_post_format() ) {
		$coworking_interface_title_string = '<a href="%3$s" title="%3$s" rel="bookmark">%2$s%1$s</a>';
	} elseif ( ! is_single( get_the_ID() ) ) {
		$coworking_interface_title_string = '<a href="%3$s" title="%4$s" rel="bookmark">%2$s%1$s</a>';
	}

	$coworking_interface_title_icon = apply_filters( 'coworking_interface_post_title_icon', '' );
	$coworking_interface_title_icon = coworking_interface()->icons->get_svg( $coworking_interface_title_icon );
	?>

	<<?php echo tag_escape( $coworking_interface_tag ); ?> class="entry-title"<?php coworking_interface_schema_markup( 'headline' ); ?>>
		<?php
		echo sprintf(
			wp_kses_post( $coworking_interface_title_string ),
			wp_kses_post( get_the_title() ),
			$coworking_interface_title_icon ? wp_kses_post( $coworking_interface_title_icon ) : '',
			esc_url( coworking_interface_entry_get_permalink() ),
			the_title_attribute( array( 'echo' => false ) )
		);
		?>
	</<?php echo tag_escape( $coworking_interface_tag ); ?>>

</header>
<?php do_action( 'coworking_interface_after_entry_header' ); ?>
