<?php
/**
 * Template part for displaying entry content (summary).
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

<?php do_action( 'coworking_interface_before_entry_summary' ); ?>
<div class="entry-summary si-entry"<?php coworking_interface_schema_markup( 'text' ); ?>>

	<?php
	if ( post_password_required() ) {
		esc_html_e( 'This content is password protected. To view it please go to the post page and enter the password.', 'coworking-interface' );
	} else {
		coworking_interface_excerpt();
	}
	?>

</div>
<?php do_action( 'coworking_interface_after_entry_summary' ); ?>
