<?php
/**
 * Plugin Name: 		Preloader
 * Plugin URI:        	https://github.com/makashm/MIM-Preloader
 * Description:       	Preloader Plugin for WordPress
 * Version:           	1.0.0
 * Author:            	Al Imran Akash
 * Author URI:        	http://im.medhabi.com
 * Text Domain:       	preloader
 * Domain Path:       	/languages
 */

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main class for the plugin
 * @package WordPress
 * @subpackage MIM_PRELOADER
 * @author Al Imran Akash
 */

if( ! class_exists( 'MIM_PRELOADER' ) ) :

	class MIM_PRELOADER {

		public static $_instance;
		public $plugin_name;
		public $plugin_version;
		
		function __construct() {
			self::define();
			self::inc();
			self::hooks();
		}

		/**
		 * Define something
		 */
		public function define() {
			$this->plugin_name = 'preloader';
			$this->plugin_version = '1.0.0';
			define( 'MIM_PRELOADER', __FILE__ );
		}

		/**
		 * Hooks
		 */
		public function hooks() {
			add_action( 'wp_footer', array( $this, 'preloader_show' ) );
			add_action( 'after_setup_theme', array( $this, 'setup' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Setups
		 */
		public function setup() {
			load_theme_textdomain( 'preloader', get_template_directory(). '/languages' );
		}

		/**
		 * Inc
		 */
		public function inc() {
			require_once dirname( MIM_PRELOADER ) . '/vendor/admin/mim-preloader-settings.php'; 
		}

		/**
		 * Enqueue Scripts
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( $this->plugin_name . '-mim-rotating', plugins_url( '/assets/css/mim-rotating-plane.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-chasing', plugins_url( '/assets/css/mim-chasing-dots.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-circle', plugins_url( '/assets/css/mim-circle.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-cube', plugins_url( '/assets/css/mim-cube-grid.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-double', plugins_url( '/assets/css/mim-double-bounce.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-fading', plugins_url( '/assets/css/mim-fading-circle.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-folding', plugins_url( '/assets/css/mim-folding-cube.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-pulse', plugins_url( '/assets/css/mim-pulse.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-three', plugins_url( '/assets/css/mim-three-bounce.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-wandering', plugins_url( '/assets/css/mim-wandering-cubes.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-wave', plugins_url( '/assets/css/mim-wave.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-loader', plugins_url( '/assets/css/mim-loader.css', MIM_PRELOADER ) );
			wp_enqueue_style( $this->plugin_name . '-mim-preloader-css', plugins_url( '/assets/css/mim-main-preloader.css', MIM_PRELOADER ) );

			$background = mdc_get_option( 'background', 'mim_preloader' );
			$background_color = mdc_get_option( 'background_color', 'mim_preloader' );
        	$position = mdc_get_option( 'position', 'mim_preloader');
			$custom_css = "
				.mim-preloader-overlay{
					background: $background;
				}
				.sk-rotating-plane{
					background-color: $background_color;
				}
				.sk-wave .sk-rect{
					background-color: $background_color;
				}
				.sk-chasing-dots .sk-child{
					background-color: $background_color;
				}
				.sk-circle .sk-child:before{
					background-color: $background_color;
				}
				.sk-cube-grid .sk-cube{
					background-color: $background_color;
				}
				.sk-double-bounce .sk-child{
					background-color: $background_color;
				}
				.sk-fading-circle .sk-circle:before{
					background-color: $background_color;
				}
				.sk-folding-cube .sk-cube:before{
					background-color: $background_color;
				}
				.sk-spinner-pulse{
					background-color: $background_color;
				}
				.sk-three-bounce .sk-child{
					background-color: $background_color;
				}
				.sk-wandering-cubes .sk-cube{
					background-color: $background_color;
				}
			";

			wp_add_inline_style( 'mim-preloader-css', $custom_css );

			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'mim-preloader-js', plugins_url( '/assets/js/mim-preloader.js', MIM_PRELOADER ), array('jquery'), $this->plugin_version, true );
		}

		/**
		 * Preloader Show
		 */
		public function preloader_show() {
			$position = mdc_get_option( 'position', 'mim_preloader', 'rotating' );

			switch ( $position ) {
				case 'rotating':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-rotating-plane"></div>
						</div>
					';

					echo $html;
				break;

				case 'wave':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-wave">
						        <div class="sk-rect sk-rect1"></div>
						        <div class="sk-rect sk-rect2"></div>
						        <div class="sk-rect sk-rect3"></div>
						        <div class="sk-rect sk-rect4"></div>
						        <div class="sk-rect sk-rect5"></div>
					      	</div>
						</div>
					';

					echo $html;
				break;
				
				case 'chasing':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-chasing-dots">
					        	<div class="sk-child sk-dot1"></div>
					        	<div class="sk-child sk-dot2"></div>
					      	</div>
						</div>
					';

					echo $html;
				break;

				case 'circle':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-circle">
						        <div class="sk-circle1 sk-child"></div>
						        <div class="sk-circle2 sk-child"></div>
						        <div class="sk-circle3 sk-child"></div>
						        <div class="sk-circle4 sk-child"></div>
						        <div class="sk-circle5 sk-child"></div>
						        <div class="sk-circle6 sk-child"></div>
						        <div class="sk-circle7 sk-child"></div>
						        <div class="sk-circle8 sk-child"></div>
						        <div class="sk-circle9 sk-child"></div>
						        <div class="sk-circle10 sk-child"></div>
						        <div class="sk-circle11 sk-child"></div>
						        <div class="sk-circle12 sk-child"></div>
						    </div>
						</div>
					';

					echo $html;
				break;

				case 'cube':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-cube-grid">
						        <div class="sk-cube sk-cube1"></div>
						        <div class="sk-cube sk-cube2"></div>
						        <div class="sk-cube sk-cube3"></div>
						        <div class="sk-cube sk-cube4"></div>
						        <div class="sk-cube sk-cube5"></div>
						        <div class="sk-cube sk-cube6"></div>
						        <div class="sk-cube sk-cube7"></div>
						        <div class="sk-cube sk-cube8"></div>
						        <div class="sk-cube sk-cube9"></div>
						    </div>
						</div>
					';

					echo $html;
				break;

				case 'double':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-double-bounce">
						        <div class="sk-child sk-double-bounce1"></div>
						        <div class="sk-child sk-double-bounce2"></div>
						    </div>
						</div>
					';

					echo $html;
				break;

				case 'fading':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-fading-circle">
						        <div class="sk-circle1 sk-circle"></div>
						        <div class="sk-circle2 sk-circle"></div>
						        <div class="sk-circle3 sk-circle"></div>
						        <div class="sk-circle4 sk-circle"></div>
						        <div class="sk-circle5 sk-circle"></div>
						        <div class="sk-circle6 sk-circle"></div>
						        <div class="sk-circle7 sk-circle"></div>
						        <div class="sk-circle8 sk-circle"></div>
						        <div class="sk-circle9 sk-circle"></div>
						        <div class="sk-circle10 sk-circle"></div>
						        <div class="sk-circle11 sk-circle"></div>
						        <div class="sk-circle12 sk-circle"></div>
						    </div>
						</div>
					';
					echo $html;

				break;

				case 'folding':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-folding-cube">
						        <div class="sk-cube1 sk-cube"></div>
						        <div class="sk-cube2 sk-cube"></div>
						        <div class="sk-cube4 sk-cube"></div>
						        <div class="sk-cube3 sk-cube"></div>
						    </div>
						</div>
					';

					echo $html;
				break;

				case 'pulse':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-spinner sk-spinner-pulse"></div>
						</div>
					';

					echo $html;
				break;

				case 'three':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-three-bounce">
						        <div class="sk-child sk-bounce1"></div>
						        <div class="sk-child sk-bounce2"></div>
						        <div class="sk-child sk-bounce3"></div>
						    </div>
						</div>
					';

					echo $html;
				break;

				case 'wandering':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-wandering-cubes">
						        <div class="sk-cube sk-cube1"></div>
						        <div class="sk-cube sk-cube2"></div>
						    </div>
						</div>
					';

					echo $html;
				break;

				case 'loader':

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="loader">
							  	<div class="dot"></div>
							  	<div class="dot"></div>
							  	<div class="dot"></div>
							  	<div class="dot"></div>
							  	<div class="dot"></div>
							</div>
						</div>
					';

					echo $html;
				break;
				
				default:

					$html = '
						<div class="mim-preloader">
							<div class="mim-preloader-overlay"></div>
							<div class="sk-rotating-plane"></div>
						</div>
					';
					
					echo $html;
				break;
			}
		}

		/**
		 * Instantiate
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
	}

endif;

MIM_PRELOADER::instance();

