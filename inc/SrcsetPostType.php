<?php

/**
 * Class SliderPostType.
 *
 * @package MKASimpleSlider
 */
class SrcsetPostType {
	/**
	 * Text domain
	 *
	 * @var string $text_domain
	 */
	private static $text_domain;

	/**
	 * SliderPostType constructor.
	 *
	 * @param string $text_domain Text domain for theme.
	 */
	public function __construct( $text_domain ) {
		self::$text_domain = $text_domain;
	}

	/**
	 * Register POst type with options.
	 */
	public function register_cpt() {
		$labels = array(
			'name'                  => _x( 'Slider', 'Post Type General Name', self::$text_domain ),
			'singular_name'         => _x( 'Slider', 'Post Type Singular Name', self::$text_domain ),
			'menu_name'             => __( 'Slider', self::$text_domain ),
			'name_admin_bar'        => __( 'Slider', self::$text_domain ),
			'archives'              => __( 'Slider Archives', self::$text_domain ),
			'parent_item_colon'     => __( 'Parent Slide:', self::$text_domain ),
			'all_items'             => __( 'All Slides', self::$text_domain ),
			'add_new_item'          => __( 'Add New Slide', self::$text_domain ),
			'add_new'               => __( 'Add New', self::$text_domain ),
			'new_item'              => __( 'New Slide', self::$text_domain ),
			'edit_item'             => __( 'Edit Slide', self::$text_domain ),
			'update_item'           => __( 'Update Slide', self::$text_domain ),
			'view_item'             => __( 'View Slide', self::$text_domain ),
			'search_items'          => __( 'Search Slide', self::$text_domain ),
			'not_found'             => __( 'Not found', self::$text_domain ),
			'not_found_in_trash'    => __( 'Not found in Trash', self::$text_domain ),
			'featured_image'        => __( 'Featured Image', self::$text_domain ),
			'set_featured_image'    => __( 'Set featured image', self::$text_domain ),
			'remove_featured_image' => __( 'Remove featured image', self::$text_domain ),
			'use_featured_image'    => __( 'Use as featured image', self::$text_domain ),
			'insert_into_item'      => __( 'Insert into Slide', self::$text_domain ),
			'uploaded_to_this_item' => __( 'Uploaded to this Slide', self::$text_domain ),
			'items_list'            => __( 'Slider list', self::$text_domain ),
			'items_list_navigation' => __( 'Slider list navigation', self::$text_domain ),
			'filter_items_list'     => __( 'Slider items list', self::$text_domain ),
		);
		$args   = array(
			'label'               => __( 'Slider', self::$text_domain ),
			'description'         => __( 'Post types for MKA Simple Slider.', self::$text_domain ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'taxonomies'          => array( 'category', 'post_tag' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-images-alt',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'slider', $args );

	}

	/**
	 * Register hook.
	 *
	 * @param string $text_domain text domain.
	 */
	public static function run( $text_domain ) {
		$post_type = new self( $text_domain );
		add_action( 'init', array( $post_type, 'register_cpt' ) );
	}
}