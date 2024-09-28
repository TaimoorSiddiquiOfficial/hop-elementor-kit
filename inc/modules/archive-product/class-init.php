<?php

namespace Hop_EL_Kit\Modules\ArchiveProduct;

use Hop_EL_Kit\Modules\Modules;
use Hop_EL_Kit\Custom_Post_Type;
use Hop_EL_Kit\SingletonTrait;

class Init extends Modules {
	use SingletonTrait;

	public function __construct() {
		$this->tab      = 'archive-product';
		$this->tab_name = esc_html__( 'Archive Product', 'hop-elementor-kit' );

		parent::__construct();
	}

	public function template_include( $template ) {
		if ( ! class_exists( '\WooCommerce' ) ) {
			return $template;
		}

		$this->template_include = is_shop() || is_product_taxonomy() || ( is_search() && 'product' === get_query_var( 'post_type' ) );

		return parent::template_include( $template );
	}

	public function is( $condition ) {
		switch ( $condition['type'] ) {
			case 'all':
				return is_post_type_archive( 'product' ) || is_tax( get_object_taxonomies( 'product' ) );
			case 'shop_page':
				return is_shop();
			case 'product_categories':
				return is_tax( 'product_cat' );
			case 'product_tags':
				return is_tax( 'product_tag' );
			case 'product_search':
				return is_search() && 'product' === get_query_var( 'post_type' );
			case 'product_term':
				$object      = get_queried_object();
				$taxonomy_id = is_object( $object ) && property_exists( $object, 'term_id' ) ? $object->term_id : false;

				return (int) $taxonomy_id === (int) $condition['query'] && ! is_search();
		}

		return false;
	}

	public function priority( $type ) {
		$priority = 100;

		switch ( $type ) {
			case 'all':
				$priority = 10;
				break;
			case 'shop_page':
				$priority = 20;
				break;
			case 'product_categories':
			case 'product_tags':
				$priority = 30;
				break;
			case 'product_search':
				$priority = 40;
				break;
			case 'product_term':
				$priority = 50;
				break;
		}

		return apply_filters( 'hop_ekit/condition/priority', $priority, $type );
	}

	public function get_conditions() {
		return array(
			array(
				'label'    => esc_html__( 'All product archives', 'hop-elementor-kit' ),
				'value'    => 'all',
				'is_query' => false,
			),
			array(
				'label'    => esc_html__( 'Shop page', 'hop-elementor-kit' ),
				'value'    => 'shop_page',
				'is_query' => false,
			),
			array(
				'label'    => esc_html__( 'Product categories', 'hop-elementor-kit' ),
				'value'    => 'product_categories',
				'is_query' => false,
			),
			array(
				'label'    => esc_html__( 'Product tags', 'hop-elementor-kit' ),
				'value'    => 'product_tags',
				'is_query' => false,
			),
			array(
				'label'    => esc_html__( 'Product search page', 'hop-elementor-kit' ),
				'value'    => 'product_search',
				'is_query' => false,
			),
			array(
				'label'    => esc_html__( 'Select product term (category, tag)', 'hop-elementor-kit' ),
				'value'    => 'product_term',
				'is_query' => true,
			),
		);
	}
}

Init::instance();
