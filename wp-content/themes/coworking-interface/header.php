<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?><?php coworking_interface_schema_markup( 'html' ); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action( 'coworking_interface_before_page_wrapper' ); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'coworking-interface' ); ?></a>

	<?php do_action( 'coworking_interface_before_masthead' ); ?>

	<header id="masthead" class="site-header" role="banner"<?php coworking_interface_masthead_atts(); ?><?php coworking_interface_schema_markup( 'header' ); ?>>
		<?php do_action( 'coworking_interface_header' ); ?>
		<?php do_action( 'coworking_interface_page_header' ); ?>
	</header><!-- #masthead .site-header -->

	<?php do_action( 'coworking_interface_after_masthead' ); ?>

	<?php do_action( 'coworking_interface_before_main' ); ?>
	<div id="main" class="site-main">
		<?php do_action( 'coworking_interface_main_start' ); ?>
