<?php

namespace Hop_EL_Kit\Modules;

use Hop_EL_Kit\SingletonTrait;

class Init {
	use SingletonTrait;

	public function __construct() {
		$this->includes();
	}

	public function includes() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/class-modules.php';
		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/class-cache.php';
		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/mega-menu/class-init.php';
		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/header-footer/class-init.php';
		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/archive-post/class-init.php';
		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/single-post/class-init.php';
		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/slider/class-init.php';

		$backtrace       = debug_backtrace();
		$check_class_woo = true;
		$check_class_lp  = true;
		// For case write include code correct hook plugins_loaded.
		if ( $backtrace[4]['function'] === 'included_files_when_plugins_loaded' ) {
			$check_class_woo = class_exists( 'WooCommerce' );
			$check_class_lp  = class_exists( 'LearnPress' );
		}

		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) && $check_class_woo ) {
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/class-woocommerce.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/archive-product/class-init.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/single-product/class-init.php';
		}

		if ( is_plugin_active( 'learnpress/learnpress.php' ) && $check_class_lp ) {
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/archive-course/class-init.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/archive-course/class-rest-api.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/single-course/class-init.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/single-course-item/class-init.php';
		}

		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/loop-item/class-init.php';
	}
}

Init::instance();
