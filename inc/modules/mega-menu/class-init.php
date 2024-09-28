<?php

namespace Hop_EL_Kit\Modules\MegaMenu;

use Hop_EL_Kit\SingletonTrait;
use Hop_EL_Kit\Settings;

class Init {
	use SingletonTrait;

	public function __construct() {
		if ( ! Settings::instance()->get_enable_modules( 'megamenu' ) ) {
			return;
		}

		add_action( 'hop_ekit/admin/enqueue', array( $this, 'admin_enqueue' ) );
		add_action( 'before_delete_post', array( $this, 'before_delete_post' ), 10, 2 );
		add_filter( 'single_template', array( $this, 'load_canvas_template' ) );
		add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'add_button_mega_menu' ), 10, 5 );
		add_action( 'admin_head-nav-menus.php', array( $this, 'add_meta_box' ) );
		add_filter( 'wp_nav_menu_args', array( $this, 'modify_nav_menu_args' ), 99999 );

		$this->includes();
	}

	public function includes() {
		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/mega-menu/class-post-type.php';
		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/mega-menu/class-rest-api.php';
		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/mega-menu/class-menu-walker.php';
	}

	/**
	 * Fires just before the move buttons of a nav menu item in the menu editor.
	 *
	 * @param int $item_id Menu item ID.
	 * @param WP_Post $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param stdClass $args An object of menu item arguments.
	 * @param int $id Nav menu ID.
	 *
	 * @since WP 5.4.0
	 *
	 */
	public function add_button_mega_menu( $item_id, $item, $depth, $args, $id ) {
		if ( $depth == 0 ) {
			echo '<div class="hop-ekits-menu" data-id="' . absint( $item_id ) . '"></div>';
		}
	}

	public function modify_nav_menu_args( $args ) {
		$nav_locations = get_nav_menu_locations();

		$location = $args['theme_location'] ?? false;

		if ( ! empty( $nav_locations ) && $location ) {
			$menu_id = $nav_locations[ $location ];

			if ( $menu_id ) {
				$enable = get_term_meta( $menu_id, Rest_API::ENABLE_MEGA_MENU, true );

				if ( absint( $enable ) ) {
					$args = wp_parse_args(
						array(
							// 'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							// 'container'       => 'div',
							// 'container_id'    => 'hop-ekits-menu-' . esc_attr( $menu_id ),
							// 'container_class' => 'hop-ekits-menu__container',
							'menu'       => $menu_id,
							'menu_class' => 'hop-ekits-menu__nav',
							// 'depth'           => 4,
							// 'echo'            => true,
							// 'fallback_cb'     => 'wp_page_menu',
							'walker'     => new Main_Walker(),
						),
						$args
					);
				}
			}
		}

		return $args;
	}

	/**
	 * Add Script Mega Menu to Menu Screen.
	 *
	 * @return void
	 */
	public function admin_enqueue() {
		$screen = get_current_screen();

		$version = HOP_EKIT_VERSION;

		if ( HOP_EKIT_DEV ) {
			$version = time();
		}

		if ( 'nav-menus' === $screen->base ) {
			wp_enqueue_media();
			wp_enqueue_script( 'hop-ekit-megamenu', HOP_EKIT_PLUGIN_URL . 'inc/build/menu.js', array(
				'lodash',
				'wp-block-editor',
				'wp-components',
				'wp-element',
				'wp-hooks',
				'wp-i18n',
				'wp-media-utils',
				'wp-polyfill',
				'wp-primitives',
				'wp-url'
			), $version, true );
			wp_enqueue_style( 'hop-ekit-megamenu', HOP_EKIT_PLUGIN_URL . 'inc/build/menu.css', array( 'wp-components' ),
				$version );
			wp_enqueue_style( 'hop-ekit-admin-font-awesome', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.css',
				array(), $version );

			$this->localize();
		}
	}

	public function localize() {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$brands_path  = ELEMENTOR_ASSETS_PATH . 'lib/font-awesome/js/brands.js';
		$regular_path = ELEMENTOR_ASSETS_PATH . 'lib/font-awesome/js/regular.js';
		$solid_path   = ELEMENTOR_ASSETS_PATH . 'lib/font-awesome/js/solid.js';

		if ( file_exists( $brands_path ) ) {
			$brands = $wp_filesystem->get_contents( $brands_path );
		}
		if ( file_exists( $regular_path ) ) {
			$regular = $wp_filesystem->get_contents( $regular_path );
		}
		if ( file_exists( $solid_path ) ) {
			$solid = $wp_filesystem->get_contents( $solid_path );
		}

		wp_localize_script(
			'hop-ekit-megamenu',
			'hopEKitMenu',
			apply_filters(
				'hop_ekit/admin/menu/enqueue/localize',
				array(
					'fontAwesome'   => array(
						'brands'  => isset( $brands ) ? json_decode( $brands, true ) : array(),
						'regular' => isset( $regular ) ? json_decode( $regular, true ) : array(),
						'solid'   => isset( $solid ) ? json_decode( $solid, true ) : array(),
					),
					'menuContainer' => apply_filters( 'hop_ekit/mega_menu/menu_container/class', false ),
				)
			)
		);
	}

	/**
	 * Delete Mega Menu before menu is deleted.
	 *
	 * @param integer $post_id
	 * @param \WP_Post $post
	 *
	 * @return void
	 */
	public function before_delete_post( int $post_id, \WP_Post $post ) {
		if ( $post_id && is_nav_menu_item( $post_id ) ) {
			$mega_menu_id = get_post_meta( $post_id, Rest_API::META_KEY, true );

			if ( ! empty( $mega_menu_id ) ) {
				wp_delete_post( $mega_menu_id, true );
			}
		}
	}

	/**
	 *  Single template function which will choose our template
	 *
	 * @param [type] $single_template
	 *
	 * @return void
	 */
	
	
	 public function load_canvas_template( $single_template ) {
		 global $post;
	 
		 if ( $post->post_type === 'nav_menu_item' ) {
			 $elementor_modules  = \Elementor\Plugin::$instance->modules_manager->get_modules( 'page-templates' );
			 $elementor_template = $elementor_modules->get_template_path( $elementor_modules::TEMPLATE_CANVAS );
			 $elementor_template = apply_filters( 'hop_ekit/mega_menu/menu_container/class/overide', $elementor_template, $post );
	 
			 // Check for custom template in your template directory
			 $custom_template = get_template_directory() . '/elementor-template.php';
	 
			 if ( file_exists( $custom_template ) ) {
				 return $custom_template;
			 }
	 
			 if ( file_exists( $elementor_template ) ) {
				 return $elementor_template;
			 }
		 }
	 
		 return $single_template;
	 }

	public function add_meta_box() {
		global $pagenow;

		if ( 'nav-menus.php' === $pagenow ) {
			add_meta_box(
				'hop_ekit-menu-settings',
				esc_html__( 'Hop Menu Settings', 'hop-elementor-kit' ),
				array( $this, 'render_metabox' ),
				'nav-menus',
				'side',
				'high'
			);
		}
	}

	public function render_metabox() {
		?>
		<div id="hop-ekits-menu__settings"></div>
		<?php
	}
}

Init::instance();
