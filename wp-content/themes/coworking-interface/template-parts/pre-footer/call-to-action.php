<?php
/**
 * The template for displaying call to action in pre footer.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

$coworking_interface_cta_text = apply_filters( 'coworking_interface_pre_footer_cta_text', coworking_interface_option( 'pre_footer_cta_text' ) );

$coworking_interface_cta_button_args = array(
	'text'    => coworking_interface_option( 'pre_footer_cta_btn_text' ),
	'url'     => coworking_interface_option( 'pre_footer_cta_btn_url' ),
	'new_tab' => coworking_interface_option( 'pre_footer_cta_btn_new_tab' ),
	'class'   => 'interface-button button-large',
);
$coworking_interface_cta_button_args = apply_filters( 'coworking_interface_pre_footer_cta_button', $coworking_interface_cta_button_args );

$coworking_interface_cta_button = '';

if ( $coworking_interface_cta_button_args['text'] || is_customize_preview() ) {
	$coworking_interface_cta_button = sprintf(
		'<a href="%1$s" class="%2$s" role="button" %3$s>%4$s</a>',
		esc_url( $coworking_interface_cta_button_args['url'] ),
		esc_attr( $coworking_interface_cta_button_args['class'] ),
		$coworking_interface_cta_button_args['new_tab'] ? 'target="_blank" rel="noopener noreferrer"' : 'target="_self"',
		esc_html( $coworking_interface_cta_button_args['text'] )
	);
}

// Classes.
$coworking_interface_cta_classes    = array( 'interface-container', 'si-pre-footer-cta' );
$coworking_interface_cta_visibility = coworking_interface_option( 'pre_footer_cta_visibility' );

if ( 'all' !== $coworking_interface_cta_visibility ) {
	$coworking_interface_cta_classes[] = 'coworking-interface-' . $coworking_interface_cta_visibility;
}

$coworking_interface_cta_classes = apply_filters( 'coworking_interface_pre_footer_cta_classes', $coworking_interface_cta_classes );
$coworking_interface_cta_classes = trim( implode( ' ', $coworking_interface_cta_classes ) );

?>
<div class="<?php echo esc_attr( $coworking_interface_cta_classes ); ?>">
	<div class="si-flex-row middle-md">

		<div class="col-xs-12 col-md-8 center-xs start-md">
			<p class="h3"><?php echo wp_kses_post( $coworking_interface_cta_text ); ?></p>
		</div>

		<div class="col-xs-12 col-md-4 center-xs end-md">
			<?php echo $coworking_interface_cta_button; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>

	</div>
</div>
