<?php
/**
 * Coworking Interface Pre Footer section in Customizer.
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

if ( ! class_exists( 'Coworking_Interface_Customizer_Pre_Footer' ) ) :
	/**
	 * Coworking Interface Pre Footer section in Customizer.
	 */
	class Coworking_Interface_Customizer_Pre_Footer {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			/**
			 * Registers our custom options in Customizer.
			 */
			add_filter( 'coworking_interface_customizer_options', array( $this, 'register_options' ) );
		}

		/**
		 * Registers our custom options in Customizer.
		 *
		 * @since 1.0.0
		 * @param array $options Array of customizer options.
		 */
		public function register_options( $options ) {

			// Pre Footer.
			$options['section']['coworking_interface_section_pre_footer'] = array(
				'title'    => esc_html__( 'Pre Footer', 'coworking-interface' ),
				'panel'    => 'coworking_interface_panel_footer',
				'priority' => 10,
			);

			// Pre Footer - Call to Action.
			$options['setting']['coworking_interface_pre_footer_cta'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'    => 'coworking-interface-heading',
					'label'   => esc_html__( 'Call to Action', 'coworking-interface' ),
					'section' => 'coworking_interface_section_pre_footer',
				),
			);

			// Enable Pre Footer CTA.
			$options['setting']['coworking_interface_enable_pre_footer_cta'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-toggle',
					'label'    => esc_html__( 'Enable Call to Action', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_pre_footer',
					'required' => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#si-pre-footer',
					'render_callback'     => 'coworking_interface_pre_footer',
					'container_inclusive' => true,
					'fallback_refresh'    => true,
				),
			);

			// Pre Footer visibility.
			$options['setting']['coworking_interface_pre_footer_cta_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Device Visibility', 'coworking-interface' ),
					'description' => esc_html__( 'Devices where the Top Bar is displayed.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_pre_footer',
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'coworking-interface' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'coworking-interface' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'coworking-interface' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Pre Footer Hide on.
			$options['setting']['coworking_interface_pre_footer_cta_hide_on'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'coworking_interface_sanitize_checkbox_group',
				'control'           => array(
					'type'        => 'coworking-interface-checkbox-group',
					'label'       => esc_html__( 'Disable On: ', 'coworking-interface' ),
					'description' => esc_html__( 'Choose on which pages you want to disable Pre Footer Call to Action. ', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_pre_footer',
					'choices'     => coworking_interface_get_display_choices(),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Pre Footer CTA Style.
			$options['setting']['coworking_interface_pre_footer_cta_style'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_select',
				'control'           => array(
					'type'        => 'coworking-interface-select',
					'label'       => esc_html__( 'Style', 'coworking-interface' ),
					'description' => esc_html__( 'Choose CTA Style.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_pre_footer',
					'choices'     => array(
						'1' => esc_html__( 'Contained', 'coworking-interface' ),
						'2' => esc_html__( 'Fullwidth', 'coworking-interface' ),
					),
					'required'    => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Pre Footer CTA Text.
			$options['setting']['coworking_interface_pre_footer_cta_text'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_textarea',
				'control'           => array(
					'type'        => 'coworking-interface-textarea',
					'label'       => esc_html__( 'Content', 'coworking-interface' ),
					'description' => esc_html__( 'Shortcodes and basic html elements allowed.', 'coworking-interface' ),
					'placeholder' => esc_html__( 'Call to Action Content', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_pre_footer',
					'rows'        => '5',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Pre Footer CTA Button Text.
			$options['setting']['coworking_interface_pre_footer_cta_btn_text'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'coworking-interface-text',
					'label'       => esc_html__( 'Button Text', 'coworking-interface' ),
					'description' => esc_html__( 'Label for the CTA button.', 'coworking-interface' ),
					'section'     => 'coworking_interface_section_pre_footer',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Pre Footer CTA Button URL.
			$options['setting']['coworking_interface_pre_footer_cta_btn_url'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'coworking-interface-text',
					'label'       => esc_html__( 'Button Link', 'coworking-interface' ),
					'description' => esc_html__( 'Link for the CTA button.', 'coworking-interface' ),
					'placeholder' => 'http://',
					'section'     => 'coworking_interface_section_pre_footer',
					'required'    => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Pre Footer CTA open in new tab.
			$options['setting']['coworking_interface_pre_footer_cta_btn_new_tab'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-toggle',
					'label'    => esc_html__( 'Open link in new tab?', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_pre_footer',
					'required' => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Pre Footer - Call to Action Design Options.
			$options['setting']['coworking_interface_pre_footer_cta_design_options'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Design Options', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_pre_footer',
					'required' => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Pre Footer - Call to Action Background.
			$options['setting']['coworking_interface_pre_footer_cta_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Background', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_pre_footer',
					'display'  => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'coworking-interface' ),
							'gradient' => esc_html__( 'Gradient', 'coworking-interface' ),
							'image'    => esc_html__( 'Image', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_pre_footer_cta_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Pre Footer - Call to Action Text Color.
			$options['setting']['coworking_interface_pre_footer_cta_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Font Color', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_pre_footer',
					'display'  => array(
						'color' => array(
							'text-color'       => esc_html__( 'Text Color', 'coworking-interface' ),
							'link-color'       => esc_html__( 'Link Color', 'coworking-interface' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'coworking-interface' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_pre_footer_cta_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Pre Footer - Call to Action Border.
			$options['setting']['coworking_interface_pre_footer_cta_border'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_design_options',
				'control'           => array(
					'type'     => 'coworking-interface-design-options',
					'label'    => esc_html__( 'Border', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_pre_footer',
					'display'  => array(
						'border' => array(
							'style'     => esc_html__( 'Style', 'coworking-interface' ),
							'color'     => esc_html__( 'Color', 'coworking-interface' ),
							'width'     => esc_html__( 'Width (px)', 'coworking-interface' ),
							'positions' => array(
								'top'    => esc_html__( 'Top', 'coworking-interface' ),
								'right'  => esc_html__( 'Right', 'coworking-interface' ),
								'bottom' => esc_html__( 'Bottom', 'coworking-interface' ),
								'left'   => esc_html__( 'Left', 'coworking-interface' ),
							),
						),
					),
					'required' => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_pre_footer_cta_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// CTA typography heading.
			$options['setting']['coworking_interface_pre_footer_cta_typography'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_toggle',
				'control'           => array(
					'type'     => 'coworking-interface-heading',
					'label'    => esc_html__( 'Typography', 'coworking-interface' ),
					'section'  => 'coworking_interface_section_pre_footer',
					'required' => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// CTA font size.
			$options['setting']['coworking_interface_pre_footer_cta_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'coworking_interface_sanitize_responsive',
				'control'           => array(
					'type'       => 'coworking-interface-range',
					'label'      => esc_html__( 'Font Size', 'coworking-interface' ),
					'section'    => 'coworking_interface_section_pre_footer',
					'min'        => 8,
					'max'        => 90,
					'step'       => 1,
					'responsive' => true,
					'unit'       => array(
						array(
							'id'   => 'px',
							'name' => 'px',
							'min'  => 8,
							'max'  => 90,
							'step' => 1,
						),
						array(
							'id'   => 'em',
							'name' => 'em',
							'min'  => 0.5,
							'max'  => 5,
							'step' => 0.01,
						),
						array(
							'id'   => 'rem',
							'name' => 'rem',
							'min'  => 0.5,
							'max'  => 5,
							'step' => 0.01,
						),
					),
					'required'   => array(
						array(
							'control'  => 'coworking_interface_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_enable_pre_footer_cta',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'coworking_interface_pre_footer_cta_typography',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			return $options;
		}
	}
endif;
new Coworking_Interface_Customizer_Pre_Footer();
