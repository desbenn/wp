<?php
/**
 * Template part for displaying entry category.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>

<div class="post-category">

	<?php
	do_action( 'coworking_interface_before_post_category' );

	if ( is_singular() ) {
		coworking_interface_entry_meta_category( ' ', false );
	} else {
		if ( 'blog-horizontal' === coworking_interface_get_article_feed_layout() ) {
			coworking_interface_entry_meta_category( ' ', false );
		} else {
			coworking_interface_entry_meta_category( ', ', false );
		}
	}

	do_action( 'coworking_interface_after_post_category' );
	?>

</div>
