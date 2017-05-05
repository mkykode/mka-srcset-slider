<?php
/**
 * Initializes plugin
 *
 * @package MKASimpleSlider
 */

/**
 * This defines all the hooks and setups the plugin.
 *
 * @package MKASrcsetSlider
 * @subpackage MKA_Srcset_slider/inc
 * @author Jull Weber <jull@monkeykodeagency.com>
 */
class SrcsetSlider {
	/**
	 * Text domain
	 *
	 * @since 1.0.0
	 * @var $text_domain
	 */
	private static $text_domain;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since    1.0.0
	 *
	 * @param string $text_domain Text domain.
	 */
	public function __construct( $text_domain ) {
		self::$text_domain = $text_domain;
	}


	/**
	 * Run the basic setup. Generate the slider custom post type.
	 */
	public static function run() {

		$options = SrcsetSliderOptions::load();
		SrcsetSliderAdmin::run( $options, self::$text_domain );
		// Enqueue Files.
		SrcsetSliderPublic::run( $options );
		SrcsetSliderShortcode::run( $options );
	}
}
