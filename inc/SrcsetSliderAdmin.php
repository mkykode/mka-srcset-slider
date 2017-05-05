<?php

/**
 * Created by PhpStorm.
 * User: jullallan
 * Date: 11/22/16
 * Time: 3:46 PM
 */
class SrcsetSliderAdmin {
	/**
	 * Array of options.
	 *
	 * @var array
	 */
	private $options;
	/**
	 * Main text domain.
	 *
	 * @var string $text_domain Text domain.
	 */
	private static $text_domain;

	/**
	 * SimpleSliderAdmin constructor.
	 *
	 * @param SrcsetSliderOptions $options options.
	 *
	 * @param string $text_domain Text domain.
	 *
	 * @internal param string $text_domain Text domain.
	 */
	public function __construct( SrcsetSliderOptions $options, $text_domain ) {
		$this->options     = $options;
		self::$text_domain = $text_domain;
	}

	/**
	 * Registers post type
	 */
	public static function register_post_type() {
		SrcsetPostType::run( self::$text_domain );
	}

	/**
	 * Adds the admin page to the menu.
	 */
	public function add_admin_page() {
		add_submenu_page( 'edit.php?post_type=slider', __( 'Slider Settings', self::$text_domain ), __( 'Slider Settings', self::$text_domain ), 'manage_options', 'slider-settings', array(
			$this,
			'render',
		) );

	}

	/**
	 * Renders the admin page using the Settings API.
	 */
	public function render() {
		?>
		<div class="wrap" id="slider-settings-admin">
			<h2><?php esc_attr_e( 'Slider Settings', self::$text_domain ); ?></h2>
			<form action="options.php" method="POST">
				<?php settings_fields( 'slider_settings' ); ?>
				<?php do_settings_sections( 'settings_section' ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Configure the option page using the settings API.
	 */
	public function configure() {
		// Register settings.
		register_setting( 'slider_settings', 'slider_settings' );
		// General Section.
		add_settings_section( 'slider_options', __( 'General', self::$text_domain ), array(
			$this,
			'render_general_section',
		), 'settings_section' );
		add_settings_field( 'slider_speed', __( 'Slider Speed', self::$text_domain ), array(
			$this,
			'render_size_field',
		), 'settings_section', 'slider_options' );
		add_settings_field( 'slider_pause_hover', __( 'Pause on Hover', self::$text_domain ), array(
			$this,
			'render_pause_radio',
		), 'settings_section', 'slider_options' );
		add_settings_field( 'slider_prev_next_btn', __( 'Add Prev/Next buttons', self::$text_domain ), array(
			$this,
			'render_prev_next_radio',
		), 'settings_section', 'slider_options' );

		add_settings_field( 'slider_page_dots', __( 'Dots Navigation', self::$text_domain ), array(
			$this,
			'render_dots_radio',
		), 'settings_section', 'slider_options' );

		add_settings_field( 'slider_number_slides', __( 'Number of Slides to Show on each frame', self::$text_domain ), array(
			$this,
			'render_number_text_field',
		), 'settings_section', 'slider_options' );

		add_settings_field( 'slider_wrap_around', __( 'Infinite Loop', self::$text_domain ), array(
			$this,
			'render_wrap_around_radio',
		), 'settings_section', 'slider_options' );


	}

	/**
	 * Renders the general section.
	 */
	public function render_general_section() {
		?>
		<p><?php esc_attr_e( 'Configure Slider Options.', self::$text_domain ); ?></p>
		<?php
	}

	/**
	 * Renders the size field.
	 */
	public function render_size_field() {
		?>
		<input id="slider_speed" class="regular-text" name="slider_settings[speed]" type="number"
		       value="<?php echo esc_attr( $this->options->get( 'speed', '3500' ) ) ?>"/>
		<?php
	}
	/**
	 * Renders the size field.
	 */
	public function render_number_text_field() {
		?>
		<input id="slider_speed" class="regular-text" name="slider_settings[number_slides]" type="number"
		       value="<?php echo esc_attr( $this->options->get( 'number_slides', '1' ) ) ?>"/>
		<?php
	}

	/**
	 * Render Pause on hover radio button.
	 */
	public function render_pause_radio() {
		?>
		<fieldset>
			<legend class="screen-reader-text"><span><?php esc_attr_e( 'Pause on Hover', self::$text_domain ) ?></span>
			</legend>
			<label title='True'>
				<input type="radio" name="slider_settings[pause_on_hover]"
				       value="true" <?php checked( 'true', $this->options->get( 'pause_on_hover', 'true' ) ); ?> />
				<span><?php esc_attr_e( 'True', self::$text_domain ); ?></span>
			</label><br>
			<label title='False'>
				<input type="radio" name="slider_settings[pause_on_hover]"
				       value="false" <?php checked( 'false', $this->options->get( 'pause_on_hover', 'true' ) ); ?> />
				<span><?php esc_attr_e( 'False', self::$text_domain ); ?></span>
			</label>
		</fieldset>
		<?php
	}

	/**
	 * Render Prev/Next on hover radio button.
	 */
	public function render_prev_next_radio() {
		?>
		<fieldset>
			<legend class="screen-reader-text">
				<span><?php esc_attr_e( 'Prev/Next Buttons', self::$text_domain ) ?></span></legend>
			<label title='True'>
				<input type="radio" name="slider_settings[nav_buttons]"
				       value="true" <?php checked( 'true', $this->options->get( 'nav_buttons', 'true' ) ); ?> />
				<span><?php esc_attr_e( 'True', self::$text_domain ); ?></span>
			</label><br>
			<label title='False'>
				<input type="radio" name="slider_settings[nav_buttons]"
				       value="false" <?php checked( 'false', $this->options->get( 'nav_buttons', 'true' ) ); ?> />
				<span><?php esc_attr_e( 'False', self::$text_domain ); ?></span>
			</label>
		</fieldset>
		<?php
	}
	/**
	 * Render Page Dots on hover radio button.
	 */
	public function render_dots_radio() {
		?>
		<fieldset>
			<legend class="screen-reader-text">
				<span><?php esc_attr_e( 'Page Dots Nav', self::$text_domain ) ?></span></legend>
			<label title='True'>
				<input type="radio" name="slider_settings[page_dots]"
				       value="true" <?php checked( 'true', $this->options->get( 'page_dots', 'true' ) ); ?> />
				<span><?php esc_attr_e( 'True', self::$text_domain ); ?></span>
			</label><br>
			<label title='False'>
				<input type="radio" name="slider_settings[page_dots]"
				       value="false" <?php checked( 'false', $this->options->get( 'page_dots', 'true' ) ); ?> />
				<span><?php esc_attr_e( 'False', self::$text_domain ); ?></span>
			</label>
		</fieldset>
		<?php
	}
	/**
	 * Render Page Dots on hover radio button.
	 */
	public function render_wrap_around_radio() {
		?>
		<fieldset>
			<legend class="screen-reader-text">
				<span><?php esc_attr_e( 'Infinite Loop', self::$text_domain ) ?></span></legend>
			<label title='True'>
				<input type="radio" name="slider_settings[infinite_loop]"
				       value="true" <?php checked( 'true', $this->options->get( 'infinite_loop', 'true' ) ); ?> />
				<span><?php esc_attr_e( 'True', self::$text_domain ); ?></span>
			</label><br>
			<label title='False'>
				<input type="radio" name="slider_settings[infinite_loop]"
				       value="false" <?php checked( 'false', $this->options->get( 'infinite_loop', 'true' ) ); ?> />
				<span><?php esc_attr_e( 'False', self::$text_domain ); ?></span>
			</label>
		</fieldset>
		<?php
	}

	/**
	 * Run init.
	 *
	 * @param SrcsetSliderOptions $options Array.
	 * @param string $text_domain Text domain.
	 */
	public static function run( SrcsetSliderOptions $options, $text_domain ) {
		$page = new self( $options, $text_domain );
		add_action( 'admin_menu', array( $page, 'add_admin_page' ) );
		add_action( 'admin_init', array( $page, 'configure' ) );
		if ( is_admin() ) {
			self::register_post_type( $text_domain );
		}

	}
}