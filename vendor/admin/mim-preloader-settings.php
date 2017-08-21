<?php
if( ! defined( 'ABSPATH' ) ) exit();

require_once dirname( __FILE__ ) . '/class.mdc-settings-api.php';

if ( ! class_exists( 'MIM_PRELOADER_SETTINGS' ) ) :

class MIM_PRELOADER_SETTINGS {

    private $settings_api;

    function __construct() {
        $this->settings_api = new MDC_Settings_API;

        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ), 51 );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_menu_page( 'Preloader Settings', 'Preloader', 'manage_options', 'scroll-settings', array( $this, 'option_page' ), 'dashicons-controls-repeat' );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'mim_preloader',
                'title' => 'General Preloader',
            ),
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            
            'mim_preloader' => array(
                array(
                    'name'    =>  'background',
                    'label'   =>  'Background Color',
                    'type'    =>   'color',
                    'desc'    =>  '',
                    'default' =>  '#000',
                ),
                array(
                    'name'    =>  'background_color',
                    'label'   =>  'Preloader Color',
                    'type'    =>   'color',
                    'desc'    =>  '',
                    'default' =>  '#fff',
                ),
                array(
                    'name'    =>  'position',
                    'label'   =>  'Preloader Style',
                    'type'    =>   'radio',
                    'default' =>  'rotating',
                    'options' => array( 'rotating' => 'Rotating', 'wave' => 'Wave', 'chasing' => 'Chasing Dots', 'circle' => 'Circle', 'cube' => 'Cube Grid', 'double' => 'Double Bounce', 'fading' => 'Fading Circle', 'folding' => 'Folding Cube', 'pulse' => 'Pulse', 'three' => 'Three Bounce', 'wandering' => 'Wandering Cubes', 'loader' => 'Loader' )
                ),
            ),

        );

        return $settings_fields;
    }

    function option_page() {
        echo '<div class="wrap">';
        ?>
        
            <div class="scroll-to-up-setting-page-title">
                <h1><i>Preloader</i> Settings</h1>
            </div>

        <div class="stp-col-left">
            <?php 
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms(); ?>
        </div>


    <?php echo '</div>';
    }

    public function preset_icons() {
        $icons = [];
        for( $i=1; $i<=80; $i++){
            $icons[plugins_url( 'assets/icons/arrow' . $i . '.png', MDC_SCROLL_TO_TOP )] = '<img src="' . plugins_url( 'assets/icons/arrow' . $i . '.png', MDC_SCROLL_TO_TOP ) . '" />';
        }
        return $icons;
    }

}

new MIM_PRELOADER_SETTINGS;
endif;

if( ! function_exists( 'mdc_get_option' ) ) :
function mdc_get_option( $option, $section, $default = '' ) {
 
    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
 
    return $default;
}
endif;
