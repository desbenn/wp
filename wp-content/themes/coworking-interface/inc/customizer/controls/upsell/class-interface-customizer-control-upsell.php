<?php
/**
 * Coworking Interface Customizer upsell control class.
 *
 * @package     Coworking Interface
 * @since       1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Coworking_Interface_Customizer_Control_Upsell')):
    /**
     * Coworking Interface Customizer upsell control class.
     */
    class Coworking_Interface_Customizer_Control_Upsell extends Coworking_Interface_Customizer_Control
    {

        public $type = 'coworking-interface-upsell';

        public $url = '';

        public $button_text = 'Learn More';

        public function enqueue()
        {
            $coworking_interface_suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
            $coworking_interface_type = str_replace('coworking-interface-', '', $this->type);

            wp_enqueue_style(
                'coworking-interface-' . $coworking_interface_type . '-control-style',
                COWORKING_INTERFACE_URI . '/inc/customizer/controls/' . $coworking_interface_type . '/' . $coworking_interface_type . $coworking_interface_suffix . '.css',
                false,
                COWORKING_INTERFACE_VERSION,
                'all'
            );
        }

        public function to_json()
        {
            parent::to_json();

            $this->json['url'] = esc_url($this->url);
            $this->json['button_text'] = esc_html($this->button_text);
        }

        protected function content_template()
        {
            ?>
            <div class="coworking-interface-upsell-wrapper">
                <# if ( data.label ) { #>
                    <span class="customize-control-title"
                        style="font-size: 14px; font-weight: 600; color: #000; margin-bottom: 5px; display: block;">
                        {{{ data.label }}}
                    </span>
                    <# } #>

                        <# if ( data.description ) { #>
                            <div class="customize-control-description" style="color: #444; margin-bottom: 15px;">
                                {{{ data.description }}}
                            </div>
                            <# } #>

                                <# if ( data.url && data.button_text ) { #>
                                    <a href="{{ data.url }}" class="button button-primary" target="_blank" rel="noopener noreferrer"
                                        style="width: 100%; text-align: center;">
                                        {{ data.button_text }}
                                    </a>
                                    <# } #>
            </div>
            <?php
        }
    }
endif;
