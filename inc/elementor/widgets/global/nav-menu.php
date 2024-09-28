<?php

namespace Elementor;

use Hop_EL_Kit\Modules\MegaMenu\Main_Walker;
use Hop_EL_Kit\Settings;

class Hop_Ekit_Widget_Nav_Menu extends Widget_Base {
	public $base;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-nav-menu';
	}

	public function get_title() {
		return esc_html__( 'Nav Menu', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-nav-menu';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'hop',
			'menu',
			'nav menu',
		];
	}

	public function get_list_menus() {
		$output = array(
			'0' => esc_html__( '--Select Menu--', 'hop-elementor-kit' ),
		);
		$menus  = wp_get_nav_menus();

		if ( ! empty( $menus ) ) {
			foreach ( $menus as $menu ) {
				$output[ $menu->slug ] = $menu->name;
			}
		}
		$output['custom_html'] = esc_html__( 'Custom HTML', 'hop-elementor-kit' );

		return $output;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Nav Menu Settings', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'menu_id',
			array(
				'label'   => esc_html__( 'Select Menu', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->get_list_menus(),
			)
		);
		$custom_html = new Repeater();
		$custom_html->add_control(
			'item_text',
			array(
				'label'       => esc_html__( 'Text', 'hop-elementor-kit' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Item menu',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$custom_html->add_control(
			'item_link',
			array(
				'label'         => esc_html__( 'Link', 'hop-elementor-kit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://example.com', 'hop-elementor-kit' ),
				'show_external' => true,
				'default'       => array(
					'url' => '',
				),
				'dynamic'       => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'custom_menu_html',
			array(
				'label'         => esc_html__( 'Item Menu HTML', 'hop-elementor-kit' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $custom_html->get_controls(),
				'title_field'   => '{{{ item_text }}}',
				'prevent_empty' => false,
				'description'   => esc_html__( 'Custom Menu only has level 1', 'hop-elementor-kit' ),
				'condition'     => [
					'menu_id' => 'custom_html',
				],
			)
		);
		$this->add_responsive_control(
			'menu_list_align',
			array(
				'label'     => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'start', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'end', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekits-menu__container .hop-ekits-menu__nav li::marker' => 'font-size: 0;',
					'{{WRAPPER}} .hop-ekits-menu__container .hop-ekits-menu__nav'            => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// Setting
		$this->_register_style_setting_menu_item();
		$this->_register_style_setting_submenu_item();
		$this->_register_style_setting_submenu_panel();
		$this->_register_style_style_mobile();
	}

	protected function _register_style_setting_menu_item() {
		$this->start_controls_section(
			'style_tab_menuitem',
			array(
				'label' => esc_html__( 'Menu item', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'menuitem_content_typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekits-menu__container .hop-ekits-menu__nav > li > a, {{WRAPPER}} .hop-ekits-menu__container .hop-ekits-menu__nav > li > .hop-ekits-menu__nav-text',
			)
		);

		$this->add_control(
			'menu_item_h',
			array(
				'label'     => esc_html__( 'Menu Item', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'nav_menu_tabs'
		);
		// Normal
		$this->start_controls_tab(
			'nav_menu_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_responsive_control(
			'menu_text_color',
			array(
				'label'           => esc_html__( 'Text color', 'hop-elementor-kit' ),
				'type'            => Controls_Manager::COLOR,
				'desktop_default' => '#000000',
				'tablet_default'  => '#000000',
				'selectors'       => array(
					'{{WRAPPER}}' => '--menu-text-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'arrow_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--menu-arrow-icon-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();

		// Hover
		$this->start_controls_tab(
			'nav_menu_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_responsive_control(
			'item_color_hover',
			array(
				'label'     => esc_html__( 'Text color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#707070',
				'selectors' => array(
					'{{WRAPPER}}' => '--menu-text-color-hover: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		// active
		$this->start_controls_tab(
			'nav_menu_active_tab',
			array(
				'label' => esc_html__( 'Active', 'hop-elementor-kit' ),
			)
		);

		$this->add_responsive_control(
			'nav_menu_active_text_color',
			array(
				'label'     => esc_html__( 'Text color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#707070',
				'selectors' => array(
					'{{WRAPPER}}' => '--menu-active-text-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'menu_item_spacing',
			array(
				'label'           => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'separator'       => array( 'before' ),
				'desktop_default' => array(
					'top'    => 0,
					'right'  => 15,
					'bottom' => 0,
					'left'   => 15,
					'unit'   => 'px',
				),
				'tablet_default'  => array(
					'top'    => 10,
					'right'  => 15,
					'bottom' => 10,
					'left'   => 15,
					'unit'   => 'px',
				),
				'size_units'      => array( 'px' ),
				'selectors'       => array(
					'{{WRAPPER}} .hop-ekits-menu__nav > li > a, {{WRAPPER}} .hop-ekits-menu__nav > li > .hop-ekits-menu__nav-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);


		$this->end_controls_section();
	}

	protected function _register_style_setting_submenu_item() {
		$this->start_controls_section(
			'hop_kits_style_tab_submenu_item',
			array(
				'label'     => esc_html__( 'Submenu item', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'menu_id!' => 'custom_html',
				],
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'hop_kits_menu_item_typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekits-menu__nav .hop-ekits-menu__dropdown  li > a,{{WRAPPER}} .hop-ekits-menu__nav .hop-ekits-menu__content  li > a,{{WRAPPER}} .hop-ekits-menu__icon-menu-back',
			)
		);

		$this->add_responsive_control(
			'hop_kits_submenu_item_margin',
			array(
				'label'           => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'devices'         => array( 'desktop', 'tablet' ),
				'desktop_default' => array(
					'top'    => 15,
					'right'  => 15,
					'bottom' => 15,
					'left'   => 15,
					'unit'   => 'px',
				),
				'tablet_default'  => array(
					'top'    => 15,
					'right'  => 15,
					'bottom' => 15,
					'left'   => 15,
					'unit'   => 'px',
				),
				'size_units'      => array( 'px' ),
				'selectors'       => array(
					'{{WRAPPER}} .hop-ekits-menu__nav .hop-ekits-menu__dropdown  li,{{WRAPPER}} .hop-ekits-menu__nav .hop-ekits-menu__content  li ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'hop_kits_submenu_item_spacing',
			array(
				'label'           => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'devices'         => array( 'desktop', 'tablet' ),
				'desktop_default' => array(
					'top'    => 15,
					'right'  => 15,
					'bottom' => 15,
					'left'   => 15,
					'unit'   => 'px',
				),
				'tablet_default'  => array(
					'top'    => 15,
					'right'  => 15,
					'bottom' => 15,
					'left'   => 15,
					'unit'   => 'px',
				),
				'size_units'      => array( 'px' ),
				'selectors'       => array(
					'{{WRAPPER}} .hop-ekits-menu__nav .hop-ekits-menu__dropdown  li,{{WRAPPER}} .hop-ekits-menu__nav .hop-ekits-menu__content  li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'hop_kits_submenu_active_hover_tabs'
		);
		$this->start_controls_tab(
			'hop_kits_submenu_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_responsive_control(
			'hop_kits_submenu_item_color',
			array(
				'label'     => esc_html__( 'Text color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}}' => '--submenu-item-color: {{VALUE}}',
				),

			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hop_kits_submenu_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_responsive_control(
			'hop_kits_submenu_item_color_hover',
			array(
				'label'     => esc_html__( 'Text color (hover)', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#707070',
				'selectors' => array(
					'{{WRAPPER}}' => '--submenu-item-color-hover: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hop_kits_submenu_active_tab',
			array(
				'label' => esc_html__( 'Active', 'hop-elementor-kit' ),
			)
		);

		$this->add_responsive_control(
			'hop_kits_submenu_item_color_active',
			array(
				'label'     => esc_html__( 'Text color (Active)', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#707070',
				'selectors' => array(
					'{{WRAPPER}}' => '--submenu-item-color-active: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hop_kits_menu_item_border_heading',
			array(
				'label'     => esc_html__( 'Sub Menu Items Border', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'hop_kits_menu_item_border',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekits-menu__nav .hop-ekits-menu__content  li,{{WRAPPER}} .hop-ekits-menu__nav .hop-ekits-menu__dropdown  li',
			)
		);

		$this->end_controls_section();
	}

	protected function _register_style_setting_submenu_panel() {
		$this->start_controls_section(
			'hop_kits_style_tab_submenu_panel',
			array(
				'label'     => esc_html__( 'Submenu panel', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'menu_id!' => 'custom_html',
				],
			)
		);
		$this->add_responsive_control(
			'hop_kits_sub_panel_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekits-menu__content,{{WRAPPER}} .hop-ekits-menu__dropdown' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'hop_kits_sub_panel_padding',
			array(
				'label'     => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'default'   => array(
					'top'      => '15',
					'bottom'   => '15',
					'left'     => '0',
					'right'    => '0',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekits-menu__content,{{WRAPPER}} .hop-ekits-menu__dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'hop_kits_panel_submenu_border',
				'label'    => esc_html__( 'Panel Menu Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekits-menu__content,{{WRAPPER}} .hop-ekits-menu__dropdown',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'hop_kits_submenu_container_background',
				'label'    => esc_html__( 'Container background', 'hop-elementor-kit' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .hop-ekits-menu__content,{{WRAPPER}} .hop-ekits-menu__dropdown',
			)
		);

		$this->add_responsive_control(
			'hop_kits_submenu_panel_border_radius',
			array(
				'label'           => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'desktop_default' => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
					'unit'   => 'px',
				),
				'tablet_default'  => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
					'unit'   => 'px',
				),
				'size_units'      => array( 'px' ),
				'selectors'       => array(
					'{{WRAPPER}} .hop-ekits-menu__content,{{WRAPPER}} .hop-ekits-menu__dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'hop_kits_submenu_container_width',
			array(
				'label'           => esc_html__( 'Container width', 'hop-elementor-kit' ),
				'type'            => Controls_Manager::TEXT,
				'devices'         => array( 'desktop' ),
				'desktop_default' => '220px',
				'tablet_default'  => '200px',
				'selectors'       => array(
					'{{WRAPPER}} .hop-ekits-menu__nav .hop-ekits-menu__dropdown' => 'min-width: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'hop_kits_panel_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekits-menu__content,{{WRAPPER}} .hop-ekits-menu__dropdown',
			)
		);

		$this->end_controls_section();
	}

	protected function _register_style_style_mobile() {
		$this->start_controls_section(
			'hop_kits_menu_mobile',
			array(
				'label' => esc_html__( 'Mobile Options', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'effect_submenu',
			array(
				'label'   => esc_html__( 'Effect Sub Menu', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->add_control(
			'menu_mobile_bg_color',
			array(
				'label'     => esc_html__( 'Background color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--hop-ekits-menu-mobile-container-bgcolor: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'hamburger_button_heading',
			array(
				'label'     => esc_html__( 'Hamburger Button Setting', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_hamburger_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekits-menu__mobile .hop-ekits-menu__mobile__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'icon_hamburger_border',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekits-menu__mobile',
			)
		);
		$this->add_control(
			'icon_hamburger_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekits-menu__mobile' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'bg_icon_hamburger',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--hop-ekits-menu-mobile-bg-button-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'icon_hamburger',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--hop-ekits-menu-mobile-button-color: {{VALUE}}',
				),
			)
		);


		$this->end_controls_section();
	}

	public function render() {
		$settings         = $this->get_settings_for_display();
		$classes 		  = '';
		
		if ( isset($settings['effect_submenu']) && $settings['effect_submenu'] == 'yes'  ) {
			$btn_mobile_close   = '<div class="hop-ekits-menu__icon-wrapper">
								<div class="hop-ekits-menu__icon-menu-back"><span>'. esc_html__('Back','hop-elementor-kit') .'</span></div>
								<button class="hop-ekits-menu__mobile__close">
									<svg xmlns="https://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
									</svg>
								</button>
								</div>';
			$classes = 'effect-submenu';
		}else {
			$btn_mobile_close = '<button class="hop-ekits-menu__mobile__close">
									<svg xmlns="https://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
									</svg>
								</button>';
		}

		$html_hamburger   = '<button class="hop-ekits-menu__mobile">
								<span class="hop-ekits-menu__mobile__icon hop-ekits-menu__mobile__icon--open">
									<svg xmlns="https://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
										 stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											  d="M4 6h16M4 12h16M4 18h16"/>
									</svg>
								</span>
							</button>';
		echo '<div class="hop-ekits-menu '. esc_attr($classes) .'">';

		if ( ! empty( $settings['menu_id'] ) && $settings['menu_id'] == 'custom_html' ) {
			if ( $settings['custom_menu_html'] ) {
				echo $html_hamburger;
				echo '<div class="hop-ekits-menu__container">' . $btn_mobile_close . '<ul class="hop-ekits-menu__nav navbar-main-menu">';
				$this->render_custom_html_menu( $settings );
				echo '</ul></div>';
			} else {
				echo '<small>' . esc_html__( 'You need create item for menu', 'hop-elementor-kit' ) . '</small>';
			}
		} elseif ( ! empty( $settings['menu_id'] ) && is_nav_menu( $settings['menu_id'] ) ) {
			$args = array(
				'items_wrap'      => apply_filters( 'hop_ekit/nav-menu/before/items_wrap',
						$btn_mobile_close ) . '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'container'       => 'div',
				'container_id'    => 'hop-ekits-menu-' . esc_attr( $settings['menu_id'] ),
				'container_class' => 'hop-ekits-menu__container',
				'menu'            => $settings['menu_id'],
				'menu_class'      => 'hop-ekits-menu__nav navbar-main-menu',
				'depth'           => 4,
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
			);

			if ( Settings::instance()->get_enable_modules( 'megamenu' ) ) {
				$args['walker'] = new Main_Walker();
			}

			echo $html_hamburger;
			wp_nav_menu( $args );
		} else {
			echo '<small>' . esc_html__( 'Edit widget and choose a menu', 'hop-elementor-kit' ) . '</small>';
		}
		echo '</div>';
	}

	public function render_custom_html_menu( $settings ) {
		if ( $settings['custom_menu_html'] ) {
			foreach ( $settings['custom_menu_html'] as $key => $item ) {
				echo '<li class="menu-item nav-item">';

				if ( ! empty( $item['item_link']['url'] ) ) {
					$this->add_link_attributes( 'item_link-' . esc_attr( $key ), $item['item_link'] ); ?>

					<a <?php
					$this->print_render_attribute_string( 'item_link-' . esc_attr( $key ) ); ?>
						class="hop-ekits-menu__nav-link">

						<?php
						echo esc_html( $item['item_text'] ); ?>

					</a>
					<?php
				} else {
					echo '<span class="hop-ekits-menu__nav-text">' . esc_html( $item['item_text'] ) . '</span>';
				}

				echo '</li>';
			}
		}
	}
}
