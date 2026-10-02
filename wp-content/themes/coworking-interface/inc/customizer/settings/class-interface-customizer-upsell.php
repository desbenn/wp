<?php
/**
 * Coworking Interface Upsell section in Customizer.
 *
 * @package     Coworking Interface
 * @since       1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Coworking_Interface_Customizer_Upsell')):
    /**
     * Coworking Interface Upsell section in Customizer.
     */
    class Coworking_Interface_Customizer_Upsell
    {

        public function __construct()
        {
            add_filter('coworking_interface_customizer_options', array($this, 'register_options'));
        }

        public function register_options($options)
        {

            // Section.
            $options['section']['coworking_interface_upsell_section'] = array(
                'title' => esc_html__('Coworking Interface Pro', 'coworking-interface'),
                'priority' => 1,
            );

            // Upsell control.
            $options['setting']['coworking_interface_upsell_setting'] = array(
                'sanitize_callback' => 'sanitize_text_field',
                'control' => array(
                    'type' => 'coworking-interface-upsell',
                    'label' => esc_html__('Upgrade to Pro!', 'coworking-interface'),
                    'description' => esc_html__('Get access to premium starter templates, multiple headers, footer builder, more typography options, advanced WooCommerce integration, and more!', 'coworking-interface'),
                    'section' => 'coworking_interface_upsell_section',
                    'priority' => 10,
                    'url' => 'https://wpinterface.com/themes/coworking-interface/#choose-pricing-plan',
                    'button_text' => esc_html__('View Pro Version', 'coworking-interface'),
                ),
            );

            return $options;
        }

    }
endif;
new Coworking_Interface_Customizer_Upsell();
