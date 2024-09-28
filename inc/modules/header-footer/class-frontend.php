<?php

namespace Hop_EL_Kit\Modules\HeaderFooter;

use Hop_EL_Kit\SingletonTrait;
use Hop_EL_Kit\Custom_Post_Type;
use Hop_EL_Kit\Settings;

class FrontEnd {
	use SingletonTrait;

	public $header;

	public $footer;

	public function __construct() {
		add_action( 'template_redirect', array( $this, 'hooks' ) );

		add_action( 'hop_ekit/modules/header_footer/template/header', array( $this, 'render_header' ) );
		add_action( 'hop_ekit/modules/header_footer/template/footer', array( $this, 'render_footer' ) );
		add_action( 'hop_ekit/modules/header_footer/template/attributes', array( $this, 'render_attributes' ) );
	}

	public function override_header() {
		require HOP_EKIT_PLUGIN_PATH . 'inc/modules/header-footer/templates/header.php';

		$templates   = array();
		$templates[] = 'header.php';

		remove_all_actions( 'wp_head' );

		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}

	public function override_footer() {
		require HOP_EKIT_PLUGIN_PATH . 'inc/modules/header-footer/templates/footer.php';

		$templates   = array();
		$templates[] = 'footer.php';

		// Avoid running wp_footer hooks again.
		remove_all_actions( 'wp_footer' );

		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}

	public function render_attributes( string $type = 'header' ) {
		$attributes = array(
			'class' => 'hop-ekit__' . esc_attr( $type ) . '__inner',
		);

		$id = $type === 'header' ? $this->header : $this->footer;

		if ( ! empty( $id ) ) {
			$sticky = get_post_meta( $id, 'hop_elementor_sticky', true );

			if ( $sticky ) {
				$attributes['class'] .= ' hop-ekits__sticky';
			}
		}

		$attributes = apply_filters( 'hop_ekit/modules/header_footer/attributes', $attributes );

		$attributes = array_map( 'esc_attr', $attributes );

		echo \Elementor\Utils::print_html_attributes( $attributes );
	}

	public function render_header() {
		if ( $this->header ) {
			echo \Hop_EL_Kit\Utilities\Elementor::instance()->render_content( $this->header );
		}
	}

	public function render_footer() {
		if ( $this->footer ) {
			echo \Hop_EL_Kit\Utilities\Elementor::instance()->render_content( $this->footer );
		}
	}

	public function hooks() {
		$current_template = basename( get_page_template_slug() );

		if ( $current_template === 'elementor_canvas' ) {
			return;
		}

		// Support for theme-support.
		$header = Init::instance()->get_layout_id( 'header' );
		$footer = Init::instance()->get_layout_id( 'footer' );

		if ( ! empty( $header ) && Settings::instance()->get_enable_modules( 'header' ) ) {
			$this->header = absint( $header );
			\Hop_EL_Kit\Utilities\Elementor::instance()->render_content_css( $this->header );
			add_action( 'get_header', array( $this, 'override_header' ) );
		}

		if ( ! empty( $footer ) && Settings::instance()->get_enable_modules( 'footer' ) ) {
			$this->footer = absint( $footer );
			\Hop_EL_Kit\Utilities\Elementor::instance()->render_content_css( $this->footer );
			add_action( 'get_footer', array( $this, 'override_footer' ) );
		}
	}
}

FrontEnd::instance();
