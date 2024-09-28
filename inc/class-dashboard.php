<?php

namespace Hop_EL_Kit;

class Dashboard {
	use SingletonTrait;

	const MENU_SLUG = 'hop_elementor_kit';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'hop_ekit/rest_api/register_endpoints', array( $this, 'register_endpoints' ), 10, 1 );
	}

	public function admin_enqueue_scripts( $hook ) {
		// Only load in dashboard page.
		if ( $hook !== 'toplevel_page_' . self::MENU_SLUG ) {
			return;
		}

		$file_info = include HOP_EKIT_PLUGIN_PATH . 'inc/build/dashboard.asset.php';

		wp_enqueue_script( 'hop-ekit-dashboard', HOP_EKIT_PLUGIN_URL . 'inc/build/dashboard.js',
			$file_info['dependencies'], $file_info['version'], true );
		wp_enqueue_style( 'hop-ekit-dashboard', HOP_EKIT_PLUGIN_URL . 'inc/build/dashboard.css', array( 'wp-components' ),
			$file_info['version'] );

		wp_localize_script(
			'hop-ekit-dashboard',
			'hop_ekit_dashboard',
			array(
				'banner' => HOP_EKIT_PLUGIN_URL . 'inc/build/libraries/banner.gif',
			)
		);
	}

	public function admin_menu() {
		add_menu_page(
			esc_html__( 'Hop Elementor', 'hop-elementor-kit' ),
			esc_html__( 'Hop Elementor', 'hop-elementor-kit' ),
			'manage_options',
			self::MENU_SLUG,
			function () {
				echo '<div id="hop-ekit-dashboard-app"></div>';
			},
			'https://hoptrendy.org/wp-content/uploads/2024/09/16.png',
			'58.6'
		);
	}

	public function register_endpoints( $namespace ) {
		register_rest_route(
			$namespace,
			'/changelog',
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( $this, 'changelog' ),
				'permission_callback' => function () {
					return current_user_can( 'manage_options' );
				},
			)
		);
	}

	public function changelog() {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$changelog = $wp_filesystem->get_contents( HOP_EKIT_PLUGIN_PATH . 'readme.txt' );
		$split     = explode( '== Changelog ==', $changelog );

		$readme = ! empty( $split[1] ) ? $split[1] : '';

		if ( ! empty( $readme ) ) {
			$readme = preg_replace( '|\n*===\s*([^=]+?)\s*=*\s*\n+|im', PHP_EOL . "\n# $1\n" . PHP_EOL, $readme );
			$readme = preg_replace( '|\n*==\s*([^=]+?)\s*=*\s*\n+|im', PHP_EOL . "\n## $1\n" . PHP_EOL, $readme );
			$readme = preg_replace( '|\n*=\s*([^=]+?)\s*=*\s*\n+|im', PHP_EOL . "\n### $1\n" . PHP_EOL, $readme );
		}

		return rest_ensure_response( $readme );
	}
}

Dashboard::instance();
