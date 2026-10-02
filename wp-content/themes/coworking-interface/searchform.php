<?php
/**
 * The template for displaying search form.
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

// Support for custom search post type.
$coworking_interface_post_type = apply_filters( 'coworking_interface_search_post_type', 'all' );
$coworking_interface_post_type = 'all' !== $coworking_interface_post_type ? '<input type="hidden" name="post_type" value="' . esc_attr( $coworking_interface_post_type ) . '" />' : '';
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<input type="search" class="search-field" aria-label="<?php esc_attr_e( 'Enter search keywords', 'coworking-interface' ); ?>" placeholder="<?php esc_attr_e( 'Search', 'coworking-interface' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
		<?php echo $coworking_interface_post_type; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<button role="button" type="submit" class="search-submit" aria-label="<?php esc_attr_e( 'Search', 'coworking-interface' ); ?>">
			<?php echo coworking_interface()->icons->get_svg( 'search', array( 'aria-hidden' => 'true' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</button>
	</div>
</form>
