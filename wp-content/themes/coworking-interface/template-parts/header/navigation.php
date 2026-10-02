<?php
/**
 * The template for displaying header navigation.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>

<nav class="site-navigation main-navigation coworking-interface-primary-nav coworking-interface-nav si-header-element" role="navigation"<?php coworking_interface_schema_markup( 'site_navigation' ); ?> aria-label="<?php esc_attr_e( 'Site Navigation', 'coworking-interface' ); ?>">
<?php

if ( has_nav_menu( 'coworking-interface-primary' ) ) {
	wp_nav_menu(
		array(
			'theme_location' => 'coworking-interface-primary',
			'menu_id'        => 'coworking-interface-primary-nav',
			'container'      => '',
			'link_before'    => '<span>',
			'link_after'     => '</span>',
		)
	);
} else {
	wp_page_menu(
		array(
			'menu_class'  => 'coworking-interface-primary-nav',
			'show_home'   => true,
			'container'   => 'ul',
			'before'      => '',
			'after'       => '',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		)
	);
}

?>
</nav><!-- END .coworking-interface-nav -->
