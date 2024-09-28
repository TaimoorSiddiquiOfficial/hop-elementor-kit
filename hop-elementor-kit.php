<?php
/**
 * Plugin Name: Hop Elementor Kit
 * Description: It is page builder for the Elementor page builder.
 * Author: hopframework
 * Version: 1.2.6
 * Author URI: https://hopframework.com
 * Requires at least: 6.3
 * Tested up to: 6.6.1
 * Requires PHP: 7.4
 * Text Domain: hop-elementor-kit
 * Domain Path: /languages/
 * Elementor tested up to: 3.24.4
 * Requires Plugins: elementor
 */


 

use Elementor\Core\Files\Manager as Files_Manager;
use Elementor\Plugin;

defined( 'ABSPATH' ) || exit;

define( 'HOP_EKIT_VERSION', '1.2.6' );
const HOP_EKIT_PLUGIN_FILE = __FILE__;
define( 'HOP_EKIT_PLUGIN_PATH', plugin_dir_path( HOP_EKIT_PLUGIN_FILE ) );
define( 'HOP_EKIT_PLUGIN_URL', plugin_dir_url( HOP_EKIT_PLUGIN_FILE ) );
define( 'HOP_EKIT_PLUGIN_BASE', plugin_basename( HOP_EKIT_PLUGIN_FILE ) );
define( 'HOP_EKIT_DEV', false );

/**
 * Class Hop Elementor Kits Plugin
 *
 * @author Nhamdv from hopframework <daonham95@gmail.com>
 */
if ( ! class_exists( 'Hop_EL_Kit' ) ) {
	final class Hop_EL_Kit {
		protected static $instance = null;

		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 99 );

			if ( ! $this->elementor_is_active() ) {
				add_action( 'admin_notices', array( $this, 'required_plugins_notice' ) );

				return;
			}

			if ( defined( 'HOP_EKIT_PRO_VERSION' ) ) {
				add_action( 'admin_notices', array( $this, 'notice_hop_elementor_kit_pro' ) );
			}

			$this->includes();

			do_action( 'hop_ekit_loaded' );
		}

		protected function includes() {
			// Utilities
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/utilities/singleton-trait.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/utilities/class-response.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/utilities/class-elementor.php';
			// Group Add Control
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/utilities/group-control-trait.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/utilities/login-register-trait.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/utilities/widget-loop-trait.php';

			// Include
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/class-dashboard.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/class-settings.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/class-post-type.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/class-enqueue-scripts.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/class-rest-api.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/class-shortcode.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/class-structured-data.php';
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/class-functions.php';

			// Elementor
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/elementor/class-elementor.php';

			// Modules, must load on hook plugins_loaded to check class exists.
			add_action( 'plugins_loaded', [ $this, 'included_files_when_plugins_loaded' ] );
			// Include old, when all plugins extend move self to hook plugins_loaded will remove.
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/class-init.php';

			// Upgrade.
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/upgrade/class-init.php';
		}

		/**
		 * Include files when plugins loaded.
		 *
		 * @return void
		 * @since 1.2.0
		 */
		public function included_files_when_plugins_loaded() {
			require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/class-init.php';
		}

	

		public function load_textdomain() {
			load_plugin_textdomain( 'hop-elementor-kit', false, basename( HOP_EKIT_PLUGIN_PATH ) . '/languages' );
		}

		public function register_activation_hook() {
			if ( $this->elementor_is_active() ) {
				if ( Plugin::$instance->files_manager instanceof Files_Manager ) {
					Plugin::$instance->files_manager->clear_cache();
				}
			}
		}

		public function elementor_is_active() {
			return defined( 'ELEMENTOR_VERSION' );
		}

		public function required_plugins_notice() {
			$screen = get_current_screen();

			if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
				return;
			}

			$plugin = 'elementor/elementor.php';

			$installed_plugins      = get_plugins();
			$is_elementor_installed = isset( $installed_plugins[ $plugin ] );

			if ( $is_elementor_installed ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}

				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s',
					'activate-plugin_' . $plugin );

				$message = sprintf( '<p>%s</p>',
					esc_html__( 'Hop Elementor Kit requires Elementor to be activated.', 'hop-elementor-kit' ) );
				$message .= sprintf( '<p><a href="%s" class="button-primary">%s</a></p>', $activation_url,
					esc_html__( 'Activate Elementor Now', 'hop-elementor-kit' ) );
			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}

				$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ),
					'install-plugin_elementor' );

				$message = sprintf( '<p>%s</p>',
					esc_html__( 'Hop Elementor Kit requires Elementor to be installed.', 'hop-elementor-kit' ) );
				$message .= sprintf( '<p><a href="%s" class="button-primary">%s</a></p>', $install_url,
					esc_html__( 'Install Elementor Now', 'hop-elementor-kit' ) );
			}

			printf( '<div class="notice notice-error is-dismissible"><p>%s</p></div>', wp_kses_post( $message ) );
		}

		public function notice_hop_elementor_kit_pro() {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			// Deactive Hop Elementor Kit Pro.
			deactivate_plugins( 'hop-elementor-kit-pro/hop-elementor-kit-pro.php' );

			$deactivate_url = wp_nonce_url( admin_url( 'plugins.php?action=deactivate&plugin=hop-elementor-kit-pro/hop-elementor-kit-pro.php' ),
				'deactivate-plugin_hop-elementor-kit-pro/hop-elementor-kit-pro.php' );
			?>
			<div class="notice notice-error is-dismissible">
				<p><?php
					esc_html_e( 'Hop Elementor Kit Pro is merged into Hop Elementor Kit. Please deactivate Hop Elementor Kit Pro to avoid conflicts.',
						'hop-elementor-kit' ); ?></p>
				<p><a href="<?php
					echo esc_url( $deactivate_url ); ?>" class="button-primary"><?php
						esc_html_e( 'Deactivate Hop Elementor Kit Pro', 'hop-elementor-kit' ); ?></a></p>
			</div>
			<?php
		}

		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function __clone() {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'hop-elementor-kit' ), '1.0' );
		}

		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'hop-elementor-kit' ), '1.0' );
		}
	}
}

include( __DIR__ . '\inc\elementor\templates\import.php');
include( __DIR__ . '\inc\elementor\templates\init.php');
include( __DIR__ . '\inc\elementor\templates\load.php');
include( __DIR__ . '\inc\elementor\templates\api.php');

\Hop_EL_Kit\Templates\Import::instance()->load();
\Hop_EL_Kit\Templates\Load::instance()->load();
\Hop_EL_Kit\Templates\Templates::instance()->init();

if (!defined('TEMPLATE_LOGO_SRC')){
	define('TEMPLATE_LOGO_SRC', plugin_dir_url( __FILE__ ) . 'inc/elementor/templates/assets/img/template_logo.ico');
}
// Update CSS Print Method in Elementor.
register_activation_hook(
	__FILE__,
	function () {
		Hop_EL_Kit::instance()->register_activation_hook();
	}
);

// If Multilsite.
// if ( function_exists( 'is_multisite' ) && is_multisite() ) {
// 	add_action(
// 		'plugins_loaded',
// 		function() {
// 			Hop_EL_Kit::instance();
// 		},
// 		90
// 	);
// } else {
Hop_EL_Kit::instance();
// }
