<?php
/**
 * Template part for displaying entry content.
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

<?php do_action( 'coworking_interface_before_entry_content' ); ?>
<div class="entry-content si-entry"<?php coworking_interface_schema_markup( 'text' ); ?>>
	<?php the_content(); ?>
</div>

<?php coworking_interface_link_pages(); ?>

<?php do_action( 'coworking_interface_after_entry_content' ); ?>
