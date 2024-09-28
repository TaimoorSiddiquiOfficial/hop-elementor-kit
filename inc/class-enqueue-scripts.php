<?php

namespace Hop_EL_Kit;

use Hop_EL_Kit\Custom_Post_Type;

class Enqueue {
	use SingletonTrait;

	public $version;

	public function __construct() {
		$this->version = HOP_EKIT_VERSION;

		if ( HOP_EKIT_DEV ) {
			$this->version = time();
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ), 100 );
		add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'register_icon_hop_ekits_elementor' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'elementor_editor_scripts' ), 1000 );
		add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'enqueue_widgets_scripts' ), 1000 );
	}

	public function admin_scripts() {
		global $pagenow;
		$screen = get_current_screen();

		if ( ( Custom_Post_Type::CPT === $screen->id && ( 'post.php' === $pagenow || 'post-new.php' === $pagenow ) ) || ( 'edit.php' == $pagenow && 'edit-' . Custom_Post_Type::CPT == $screen->id ) ) {
			$file_info = include HOP_EKIT_PLUGIN_PATH . 'inc/build/admin.asset.php';

			wp_enqueue_script( 'hop-ekit-admin', HOP_EKIT_PLUGIN_URL . 'inc/build/admin.js', $file_info['dependencies'],
				$file_info['version'], true );
			wp_enqueue_style( 'hop-ekit-admin', HOP_EKIT_PLUGIN_URL . 'inc/build/admin.css', array( 'wp-components' ),
				$this->version );

			$this->localize_admin();
		}

		do_action( 'hop_ekit/admin/enqueue' );
	}

	public function frontend_scripts() {
		wp_enqueue_script( 'hop-ekit-frontend', HOP_EKIT_PLUGIN_URL . 'inc/build/frontend.js', array(), $this->version,
			true );
		wp_enqueue_style( 'hop-ekit-frontend', HOP_EKIT_PLUGIN_URL . 'inc/build/frontend.css', array(), $this->version );
		wp_enqueue_style( 'font-awesome-5-all', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.css', array(),
			$this->version );

		do_action( 'hop_ekit/frontend/enqueue' );
	}

	public function elementor_editor_scripts() {
		$info = include HOP_EKIT_PLUGIN_PATH . 'inc/build/elementor-editor.asset.php';

		wp_enqueue_script( 'hop-ekit-elementor-editor', HOP_EKIT_PLUGIN_URL . 'inc/build/elementor-editor.js',
			array_merge( $info['dependencies'], array( 'nested-elements' ) ), $info['version'], true );
	}

	public function enqueue_widgets_scripts() {
		$info = include HOP_EKIT_PLUGIN_PATH . 'inc/build/widgets.asset.php';

		wp_enqueue_script( 'hop-ekit-widgets', HOP_EKIT_PLUGIN_URL . 'inc/build/widgets.js',
			array_merge( $info['dependencies'], array( 'elementor-frontend' ) ), $info['version'], true );
		wp_enqueue_style( 'hop-ekit-widgets', HOP_EKIT_PLUGIN_URL . 'inc/build/widgets.css',
			array( 'elementor-frontend' ), $this->version );
		wp_localize_script(
			'hop-ekit-widgets',
			'ekits_script',
			array(
				'ajax_url'     => admin_url( 'admin-ajax.php' ),
				'text_minutes' => esc_html__( '&nbsp;minutes', 'hop-elementor-kit' ),
				'text_second'  => esc_html__( '&nbsp;second', 'hop-elementor-kit' ),
			)
		);
	}

	public function localize_admin() {
		$list_types = Custom_Post_Type::instance()->tabs;

		$types = array();

		if ( ! empty( $list_types ) ) {
			foreach ( $list_types as $key => $type ) {
				$types[] = array(
					'value' => $key,
					'label' => $type['name'] ?? $key,
				);
			}
		}

		wp_localize_script(
			'hop-ekit-admin',
			'hopEKit',
			apply_filters(
				'hop_ekit/admin/enqueue/localize',
				array(
					'types' => $types,
				)
			)
		);
	}

	public function register_icon_hop_ekits_elementor( $font ) {
		$ekits_fonts_icon['hop-ekits-fonts'] = array(
			'name'          => 'hop-ekits-fonts',
			'label'         => esc_html__( 'Hop Elementor Kit', 'hop-elementor-kit' ),
			'url'           => HOP_EKIT_PLUGIN_URL . 'inc/build/libraries/hop-ekits/css/hop-ekits-icons.min.css',
			'prefix'        => 'tk-',
			'displayPrefix' => 'tk',
			'labelIcon'     => 'eicon-elementor',
			'ver'           => $this->version,
			'fetchJson'     => HOP_EKIT_PLUGIN_URL . 'inc/build/libraries/hop-ekits/js/hop-ekits.json',
			'native'        => true,
		);

		return array_merge( $font, $ekits_fonts_icon );
	}
}

Enqueue::instance();
