<?php
/**
 * Plugin Name: MKA Srcset Slider
 * Version:     1.0.0
 * Description: Srcset Slider by Monkey Kode using wp responsive featured Image.
 * Author:      Jull Weber
 * Author URI:  https://monkeykode.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mka-simple-slider
 * Domain Path: /languages
 */

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once( 'inc/CheckCDNReadability.php' );
require_once( 'inc/SrcsetPostType.php' );
require_once( 'inc/SrcsetSliderPublic.php' );
require_once( 'inc/SrcsetSliderAdmin.php' );
require_once( 'inc/SrcsetSliderOptions.php' );
require_once( 'inc/SrcsetSliderShortcode.php' );
require_once( 'inc/SrcsetSlider.php' );
define( 'THEME_NAME', 'schwerdtle' );
define( 'PLUGIN_VERSION', '1.0.0' );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );


/**
 * Initialize slider class. Check if doesn't exist.
 */
if ( ! function_exists( 'srcset_slider_init' ) ) :
	/**
	 * Init function.
	 */
	function srcset_slider_init() {
		SrcsetSlider::run( THEME_NAME );
	}

	srcset_slider_init();
endif;
