<?php

namespace Hop_EL_Kit\Modules\Slider;

use Hop_EL_Kit\SingletonTrait;

class Post_Type {

	use SingletonTrait;

	const CPT = 'hop_ekits_slide';

	const TAXONOMY = 'hop_ekits_slider';

	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'restrict_manage_posts', array( $this, 'filter_slider_by_taxonomy' ) );
		add_filter( 'parse_query', array( $this, 'convert_id_to_term_in_query' ) );
	}

	public function register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'All Items', 'hop-elementor-kit' ),
			'singular_name'      => esc_html__( 'All Item', 'hop-elementor-kit' ),
			'add_new'            => esc_html__( 'Add New', 'hop-elementor-kit' ),
			'add_new_item'       => esc_html__( 'Add New Item', 'hop-elementor-kit' ),
			'edit_item'          => esc_html__( 'Edit Item', 'hop-elementor-kit' ),
			'new_item'           => esc_html__( 'New Item', 'hop-elementor-kit' ),
			'all_items'          => esc_html__( 'All Items', 'hop-elementor-kit' ),
			'view_item'          => esc_html__( 'View Item', 'hop-elementor-kit' ),
			'search_items'       => esc_html__( 'Search Item', 'hop-elementor-kit' ),
			'not_found'          => esc_html__( 'No Item found', 'hop-elementor-kit' ),
			'not_found_in_trash' => esc_html__( 'No Item found in Trash', 'hop-elementor-kit' ),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__( 'Hop Sliders', 'hop-elementor-kit' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'query_var'           => true,
			'rewrite'             => array( 'slug' => 'hop_ekits_slide' ),
			'can_export'          => true,
			'has_archive'         => false,
			'capability_type'     => 'page',
			'menu_position'       => 58,
			'exclude_from_search' => true,
			'menu_icon'           => 'https://hoptrendy.org/wp-content/uploads/2024/09/16.png',
			'hierarchical'        => true,
			'supports'            => array( 'title', 'editor', 'elementor' ),
		);

		register_post_type( self::CPT, $args );

		$labels = array(
			'name'                  => esc_html__( 'Sliders', 'hop-elementor-kit' ),
			'singular_name'         => esc_html__( 'Slider', 'hop-elementor-kit' ),
			'search_items'          => esc_html__( 'Search Sliders', 'hop-elementor-kit' ),
			'popular_items'         => esc_html__( 'Popular Sliders', 'hop-elementor-kit' ),
			'all_items'             => esc_html__( 'All Sliders', 'hop-elementor-kit' ),
			'parent_item'           => esc_html__( 'Parent Slider', 'hop-elementor-kit' ),
			'parent_item_colon'     => esc_html__( 'Parent Slider', 'hop-elementor-kit' ),
			'edit_item'             => esc_html__( 'Edit Slider', 'hop-elementor-kit' ),
			'update_item'           => esc_html__( 'Update Slider', 'hop-elementor-kit' ),
			'add_new_item'          => esc_html__( 'Add New Slider', 'hop-elementor-kit' ),
			'new_item_name'         => esc_html__( 'New Slide', 'hop-elementor-kit' ),
			'add_or_remove_items'   => esc_html__( 'Add or remove Sliders', 'hop-elementor-kit' ),
			'choose_from_most_used' => esc_html__( 'Choose from most used sliders', 'hop-elementor-kit' ),
			'menu_name'             => esc_html__( 'Sliders', 'hop-elementor-kit' ),
			'not_found'             => esc_html__( 'No Sliders found', 'hop-elementor-kit' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => false,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'show_tagcloud'     => false,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'hop_ekits_slider' ),
			'capabilities'      => array(),
		);

		register_taxonomy( self::TAXONOMY, array( self::CPT ), $args );
	}

	

	function filter_slider_by_taxonomy() {
		global $typenow;
		$post_type = self::CPT;
		$taxonomy  = self::TAXONOMY;
		if ( $typenow == $post_type ) {
			$selected      = isset( $_GET[ $taxonomy ] ) ? $_GET[ $taxonomy ] : '';
			$info_taxonomy = get_taxonomy( $taxonomy );
			wp_dropdown_categories( array(
				'show_option_all' => sprintf( __( 'All %s', 'hop-elementor-kit' ), $info_taxonomy->label ),
				'taxonomy'        => $taxonomy,
				'name'            => $taxonomy,
				'orderby'         => 'name',
				'selected'        => $selected,
				'show_count'      => false,
				'hide_empty'      => false,
			) );
		};
	}

	function convert_id_to_term_in_query( $query ) {
		global $pagenow;
		$post_type = self::CPT;
		$taxonomy  = self::TAXONOMY;
		$q_vars    = &$query->query_vars;
		if ( $pagenow == 'edit.php' && isset( $q_vars['post_type'] ) && $q_vars['post_type'] == $post_type && isset( $q_vars[ $taxonomy ] ) && is_numeric( $q_vars[ $taxonomy ] ) && $q_vars[ $taxonomy ] != 0 ) {
			$term                = get_term_by( 'id', $q_vars[ $taxonomy ], $taxonomy );
			$q_vars[ $taxonomy ] = $term->slug;
		}
	}
}

Post_Type::instance();



