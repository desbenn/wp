<?php
/**
 * The template for displaying page preloader.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Coworking Interface
 * @author  WPInterface Team
 * @since   1.0.0
 */

?>

<div id="si-preloader"<?php coworking_interface_preloader_classes(); ?>>
	<?php get_template_part( 'template-parts/preloader/preloader', coworking_interface_option( 'preloader_style' ) ); ?>
</div><!-- END #si-preloader -->
