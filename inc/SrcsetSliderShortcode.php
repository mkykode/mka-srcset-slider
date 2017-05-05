<?php
/**
 * Flcikity shortcode class
 *
 * @package MKASimpleSlider
 */

/**
 * Class SimpleSliderShortcode
 * Creates the shortcode with and initializes the flickity slider.
 */
class SrcsetSliderShortcode {
	/**
	 * Array of options local.
	 *
	 * @var array Options.
	 */
	private $options;
	/**
	 * Slider class
	 *
	 * @var string Hard coded.
	 */
	protected $slider_class;
	/**
	 * Autoplay option.
	 *
	 * @var string
	 */
	protected $autoplay;
	/**
	 * Paus options.
	 *
	 * @var string
	 */
	protected $pause_auto_play_on_hover;
	/**
	 * UI options.
	 *
	 * @var string
	 */
	protected $prev_next_buttons;
	/**
	 * UI options.
	 *
	 * @var string
	 */
	protected $page_dots;
	/**
	 * How many slides.
	 *
	 * @var string
	 */
	protected $group_cells;

	/**
	 * SimpleSliderShortcode constructor.
	 *
	 * @param SimpleSliderOptions $options Array of options.
	 */
	public function __construct( SrcsetSliderOptions $options ) {
		$this->options      = $options;
		$this->slider_class = 'carousel';


	}

	/**
	 * Shortcode content.
	 */
	public function display_shortcode() {
		$this->enqueue_scripts();

		return $this->display_slider();
	}

	/**
	 * Init slider.
	 */
	public function enqueue_scripts() {

		wp_enqueue_style( 'flickity-css' );
		wp_enqueue_script( 'flickity-js' );
		add_action( 'wp_footer', array( $this, 'output_js' ), 99 );

	}

	/**
	 * Output js code.
	 */
	public function output_js() {
		$speed         = is_numeric( $this->options->get( 'speed', '3500' ) ) ? $this->options->get( 'speed', '3500' ) : 3500;
		$number_slides = is_numeric( $this->options->get( 'number_slides', 1 ) ) ? $this->options->get( 'number_slides', 1 ) : 1;
		$nav_buttons   = $this->options->get( 'nav_buttons', 'true' );
		$pause_hover   = $this->options->get( 'pause_on_hover', 'true' );
		$page_dots     = $this->options->get( 'page_dots', 'true' );
		$wrap_around   = $this->options->get( 'infinite_loop', 'true' );

		$output = '(function( $ ) { ';
		$output .= '$(function() { ';
		$output .= "$('.carousel').flickity( {";
		$output .= 'autoPlay:' . $speed . ', ';
		$output .= 'pauseAutoPlayOnHover:' . $pause_hover . ', ';
		$output .= 'prevNextButtons:' . $nav_buttons . ', ';
		$output .= 'pageDots:' . $page_dots . ' , ';
		$output .= 'groupCells:' . $number_slides . ', ';
		$output .= 'wrapAround:' . $wrap_around . ', ';
		$output .= "cellAlign:'center', ";
		$output .= 'contain:false';
		$output .= '});';
		$output .= '});';
		$output .= '})(jQuery);';

		echo '<script type=\'text/javascript\'>' . $output . '</script>';
	}

	/**
	 * Query for slider posts.
	 */
	public function display_slider() {
		$args  = array(
			'post_type' => array( 'slider' ),
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			echo '<div class="' . esc_attr( $this->slider_class ) . '">';
			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<div class="carousel-cell">';
				echo '<div class="carousel-wrap">';
				echo '<div class="carousel-content">';
				the_post_thumbnail();
				echo '<div class="carousel-text">';
				the_title( '<h2>', '</h2>' );
				the_content();
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';

			}
			echo '</div>';
		} else {
			echo 'Add a slide.';
		}
		wp_reset_postdata();
	}

	/**
	 * Adds shortcode and runs the class.
	 *
	 * @param SimpleSliderOptions $options Local options.
	 */
	public static function run( SrcsetSliderOptions $options ) {
		$shortcode = new self( $options );
		add_shortcode( 'mka-srcset-slider', array( $shortcode, 'display_shortcode' ) );

	}
}