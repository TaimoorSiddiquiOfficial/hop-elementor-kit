<?php

namespace Hop_EL_Kit\Modules\HeaderFooter;

use Hop_EL_Kit\Modules\Modules;
use Hop_EL_Kit\SingletonTrait;
use Hop_EL_Kit\Custom_Post_Type;
use Hop_EL_Kit\Rest_API;
use Hop_EL_Kit\Settings;

class Init extends Modules {

	use SingletonTrait;

	public function __construct() {
		$this->includes();

		parent::__construct();
	}

	public function includes() {
		if ( ! is_admin() ) {
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/header-footer/class-frontend.php';
		}
	}

	public function add_admin_tabs( $tabs ) {
		$datas = array(
			'header' => esc_html__( 'Header', 'hop-elementor-kit' ),
			'footer' => esc_html__( 'Footer', 'hop-elementor-kit' ),
		);

		foreach ( $datas as $key => $name ) {
			if ( ! Settings::instance()->get_enable_modules( $key ) ) {
				continue;
			}
			$tabs[ $key ] = array(
				'name' => $name,
				'url'  => add_query_arg(
					array(
						'post_type'            => Custom_Post_Type::CPT,
						Custom_Post_Type::TYPE => $key,
					),
					admin_url( 'edit.php' )
				),
			);
		}

		return $tabs;
	}

	public function add_localization_admin( $localize ) {
		$localize['list_conditions']['header'] = $this->get_conditions();
		$localize['list_conditions']['footer'] = $this->get_conditions();

		return $localize;
	}

	public function get_conditions() {
		$data = array(
			array(
				'label'    => esc_html__( 'Entire Site', 'hop-elementor-kit' ),
				'value'    => 'all',
				'is_query' => false,
			),
			array(
				'label'    => esc_html__( 'Archive', 'hop-elementor-kit' ),
				'value'    => 'archive_post_type',
				'is_query' => true,
			),
			array(
				'label'    => esc_html__( 'Singular', 'hop-elementor-kit' ),
				'value'    => 'singular_post_type',
				'is_query' => true,
			),
			array(
				'label'    => esc_html__( 'Select Page', 'hop-elementor-kit' ),
				'value'    => 'select_page',
				'is_query' => true,
			),
			array(
				'label'    => esc_html__( '404 Page', 'hop-elementor-kit' ),
				'value'    => '404_page',
				'is_query' => false,
			),
		);

		if ( class_exists( '\RealPress\RealPress' ) ) {
			$data[] = array(
				'label'    => esc_html__( 'RealPress Agent', 'hop-elementor-kit' ),
				'value'    => 'realpress_agent',
				'is_query' => false,
			);
		}

		return $data;
	}

	public function is( $condition ) {
		switch ( $condition['type'] ) {
			case 'all':
				return true;
				break;
			case 'archive_post_type':
				if ( $condition['query'] === 'post' ) {
					return is_archive() || is_search() || is_author() || is_category() || is_home() || is_tag() || is_tax();
				} elseif ( $condition['query'] === 'product' ) {
					return class_exists( '\WooCommerce' ) && ( is_shop() || is_product_taxonomy() || ( is_search() && 'product' === get_query_var( 'post_type' ) ) );
				} elseif ( $condition['query'] === 'realpress-property' ) {
					return class_exists( '\RealPress\RealPress' ) && ( is_post_type_archive( 'realpress-property' ) || is_tax( get_object_taxonomies( REALPRESS_PROPERTY_CPT ) ) || is_page( \RealPress\Helpers\Settings::get_page_id( 'agent_list_page' ) ) );
				} else {
					return is_post_type_archive( $condition['query'] );
				}
				break;
			case 'singular_post_type':
				return is_singular( $condition['query'] );
				break;
			case 'select_page':
				return is_page( $condition['query'] );
				break;
			case '404_page':
				return is_404();
				break;
			case 'realpress_agent':
				return class_exists( '\RealPress\RealPress' ) && \RealPress\Helpers\Page::is_agent_detail_page();
				break;
		}
	}

	public function priority( $type ) {
		$priority = 100;

		switch ( $type ) {
			case 'all':
				$priority = 10;
				break;
			case 'archive_post_type':
				$priority = 20;
				break;
			case 'singular_post_type':
				$priority = 30;
				break;
			case 'select_page':
				$priority = 40;
				break;
			case '404_page':
				$priority = 50;
				break;
			case 'realpress_agent':
				$priority = 60;
				break;
		}

		return apply_filters( 'hop_ekit/condition/priority', $priority, $type );
	}

	public function add_meta_box() {
		$post_id = isset( $_GET['post'] ) ? $_GET['post'] : false;

		if ( ! $post_id ) {
			return;
		}

		$type = get_post_meta( $post_id, 'hop_elementor_type', true );

		if ( $type === 'header' ) {
			$this->add_meta_box_header();
		}
	}

	private function add_meta_box_header() {
		add_meta_box(
			'hop_ekit_meta_box_header',
			esc_html__( 'Settings', 'hop-elementor-kit' ),
			array( $this, 'render_meta_box_header' ),
			Custom_Post_Type::CPT,
			'normal',
			'high'
		);
	}

	public function render_meta_box_header( $post ) {
		parent::render_meta_box( $post );

		$enable_sticky = get_post_meta( $post->ID, 'hop_elementor_sticky', true );
		?>
		<div class="hop-ekit-meta-boxes">
			<div class="hop-ekit-meta-box">
				<div class="hop-ekit-meta-box__title">
					<?php
					esc_html_e( 'Sticky Header', 'hop-elementor-kit' ); ?>
				</div>
				<div class="hop-ekit-meta-box__content">
					<label>
						<input type="checkbox" name="hop_elementor_sticky" value="1" <?php
						checked( $enable_sticky, '1' ); ?>>
						<?php
						esc_html_e( 'Enable sticky', 'hop-elementor-kit' ); ?>
					</label>
				</div>
			</div>
		</div>
		<?php
	}

	public function save_meta_box( $post_id ) {
		$type = get_post_meta( $post_id, 'hop_elementor_type', true );

		if ( $type === 'header' ) {
			$this->save_meta_box_header( $post_id );
		}
	}

	private function save_meta_box_header( $post_id ) {
		// Enable sticky
		$enable_sticky = isset( $_POST['hop_elementor_sticky'] ) ? true : false;

		update_post_meta( $post_id, 'hop_elementor_sticky', $enable_sticky );
	}
}

Init::instance();
