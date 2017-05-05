<?php
/**
 * Get and Load all your options for plugin.
 *
 * @package MKASimpleSlider
 */

/**
 * Manages SimpleSlider Shortcode options.
 *
 * @author Jull Weber
 */
class SrcsetSliderOptions {
	/**
	 * Local Variable option.
	 *
	 * @var array
	 */
	private $options;

	/**
	 * Load the plugin options from WordPress.
	 *
	 * @return SimpleSliderOptions
	 */
	public static function load() {
		$options = get_option( SLIDER_SETTINGS , array() );

		return new self( $options );
	}

	/**
	 * Constructor.
	 *
	 * @param array $options Submitted options.
	 */
	public function __construct( array $options = array() ) {
		$this->options = $options;
	}

	/**
	 * Gets the option for the given name. Returns the default value if the
	 * value does not exist.
	 *
	 * @param string $name Name of option.
	 * @param mixed $default Default value.
	 *
	 * @return mixed
	 */
	public function get( $name, $default = null ) {
		if ( ! $this->has( $name ) ) {
			return $default;
		}

		return $this->options[ $name ];
	}

	/**
	 * Checks if the option exists or not.
	 *
	 * @param string $name Name of option.
	 *
	 * @return Boolean
	 */
	public function has( $name ) {
		return isset( $this->options[ $name ] );
	}

	/**
	 * Sets an option. Overwrites the existing option if the name is already in use.
	 *
	 * @param string $name NAme of option.
	 * @param mixed $value Value of new option.
	 */
	public function set( $name, $value ) {
		$this->options[ $name ] = $value;
	}
}