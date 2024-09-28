<?php

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hop_Ekit_Widget_Login_Popup extends Widget_Base {

	public function get_name() {
		return 'hop-ekits-login-icon';
	}

	public function get_title() {
		return esc_html__( 'Login Icon', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-lock-user';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'hop',
			'login',
			'icon login',
		];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content',
			[
				'label' => esc_html__( 'General', 'hop-elementor-kit' )
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'base'  => esc_html__( 'Redirect Page', 'hop-elementor-kit' ),
					'popup' => esc_html__( 'Popup From (Comming Soon)', 'hop-elementor-kit' ),
				],
				'default' => 'base',
			]
		);
		//		$this->add_control(
		//			'sub_info',
		//			[
		//				'label'   => esc_html__( 'Show Sub Info User', 'hop-elementor-kit' ),
		//				'type'    => Controls_Manager::SWITCHER,
		//				'default' => ''
		//			]
		//		);


		if ( get_option( 'users_can_register' ) ) {
			$this->add_control(
				'text_register', [
					'label'       => esc_html__( 'Register Label', 'hop-elementor-kit' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => esc_html__( 'Register', 'hop-elementor-kit' ),
					'placeholder' => esc_html__( 'Register', 'hop-elementor-kit' ),
					'separator'   => 'before'
				]
			);
			$this->add_control(
				'url_register', [
					'label' => esc_html__( 'Register Url', 'hop-elementor-kit' ),
					'type'  => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'register_icons',
				[
					'label'       => esc_html__( 'Register Icon', 'hop-elementor-kit' ),
					'type'        => Controls_Manager::ICONS,
					'skin'        => 'inline',
					'label_block' => false,
					'default'     => [
						'value'   => 'far fa-user',
						'library' => 'Font Awesome 5 Free',
					],
				]
			);
		}

		$this->add_control(
			'text_login', [
				'label'       => esc_html__( 'Login Label', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Login', 'hop-elementor-kit' ),
				'placeholder' => esc_html__( 'Login', 'hop-elementor-kit' ),
				'separator'   => 'before'
			]
		);
		$this->add_control(
			'login_url', [
				'label' => esc_html__( 'Login Url', 'hop-elementor-kit' ),
				'type'  => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'login_icons',
			[
				'label'       => esc_html__( 'Login Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'far fa-user',
					'library' => 'Font Awesome 5 Free',
				],
			]
		);

		$this->add_control(
			'text_logout', [
				'label'       => esc_html__( 'Logout Label', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Logout', 'hop-elementor-kit' ),
				'placeholder' => esc_html__( 'Logout', 'hop-elementor-kit' ),
				'separator'   => 'before'
			]
		);
		$this->add_control(
			'logout_icons',
			[
				'label'       => esc_html__( 'Logout Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'fas fa-share',
					'library' => 'Font Awesome 5 Free',
				],
			]
		);
		$this->add_control(
			'text_profile', [
				'label'       => esc_html__( 'Profile Label', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Profile', 'hop-elementor-kit' ),
				'placeholder' => esc_html__( 'Profile', 'hop-elementor-kit' ),
				'separator'   => 'before'
			]
		);
		$this->add_control(
			'profile_url', [
				'label' => esc_html__( 'Profile Url', 'hop-elementor-kit' ),
				'type'  => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'profile_icons',
			[
				'label'       => esc_html__( 'Profile Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'far fa-user',
					'library' => 'Font Awesome 5 Free',
				],
			]
		);

		$this->end_controls_section();

		$this->register_style_setting_label();

		if ( get_option( 'users_can_register' ) ) {
			$this->register_style_setting_label_register( esc_html__( 'Register Label', 'hop-elementor-kit' ),
				'register' );
		}

		$this->register_style_setting_label_register( esc_html__( 'Login Label', 'hop-elementor-kit' ), 'login' );
		$this->register_style_setting_label_register( esc_html__( 'Logout Label', 'hop-elementor-kit' ), 'logout' );
		$this->register_style_setting_label_register( esc_html__( 'Profile Label', 'hop-elementor-kit' ), 'profile' );
	}

	protected function register_style_setting_label() {
		$this->start_controls_section(
			'settings_style_tabs',
			[
				'label' => esc_html__( 'Settings ', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-login-icon a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_margin',
			[
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-login-icon a'             => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .hop-login-icon a:last-child'  => 'margin-right: 0;',
					'{{WRAPPER}} .hop-login-icon a:first-child' => 'margin-left: 0;',
				],
			]
		);
		$this->add_responsive_control(
			'icon_space',
			[
				'label'      => esc_html__( 'Space icon', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .hop-login-icon' => '--login-icon-space: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hop-login-icon a i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hop-login-icon a svg' => 'max-width: {{SIZE}}{{UNIT}}; height: auto',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'settings_typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}}  .hop-login-icon a',
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_setting_label_register( $label, $class ) {
		$this->start_controls_section(
			$class . '_settings_style_tabs',
			[
				'label' => $label,
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			$class . '_settings_border',
			[
				'label'     => esc_html_x( 'Border Type', 'Border Control', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'none'   => esc_html__( 'None', 'hop-elementor-kit' ),
					'solid'  => esc_html_x( 'Solid', 'Border Control', 'hop-elementor-kit' ),
					'double' => esc_html_x( 'Double', 'Border Control', 'hop-elementor-kit' ),
					'dotted' => esc_html_x( 'Dotted', 'Border Control', 'hop-elementor-kit' ),
					'dashed' => esc_html_x( 'Dashed', 'Border Control', 'hop-elementor-kit' ),
					'groove' => esc_html_x( 'Groove', 'Border Control', 'hop-elementor-kit' ),
				],
				'default'   => 'none',
				'selectors' => [
					'{{WRAPPER}} .hop-login-icon .' . $class => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			$class . '_border_dimensions',
			[
				'label'     => esc_html_x( 'Width', 'Border Control', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'condition' => [
					$class . '_settings_border!' => 'none'
				],
				'selectors' => [
					'{{WRAPPER}} .hop-login-icon .' . $class => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( $class . '_tabs_color_settings_style' );
		$this->start_controls_tab(
			$class . '_tab_color_link_normal',
			[
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			]
		);
		$this->add_control(
			$class . '_text_color',
			[
				'label'     => __( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-login-icon .' . $class => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			$class . '_icon_color',
			[
				'label'     => __( 'Icon Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-login-icon .' . $class . ' i'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-login-icon .' . $class . ' svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$class . '_border_text',
			[
				'label'     => __( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					$class . '_settings_border!' => 'none'
				],
				'selectors' => [
					'{{WRAPPER}} .hop-login-icon .' . $class => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$class . '_bg_text',
			[
				'label'     => __( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-login-icon .' . $class => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			$class . '_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				],
				'selectors'  => [
					'{{WRAPPER}} .hop-login-icon .' . $class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			$class . '_tab_color_hover',
			[
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			]
		);
		$this->add_control(
			$class . '_text_color_hover',
			[
				'label'     => __( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-login-icon .' . $class . ':hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			$class . '_icon_color_hover',
			[
				'label'     => __( 'Icon Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-login-icon .' . $class . ':hover i'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-login-icon .' . $class . ':hover svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$class . '_border_text_hover',
			[
				'label'     => __( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-login-icon .' . $class . ':hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					$class . '_settings_border!' => 'none'
				],
			]
		);
		$this->add_control(
			$class . '_bg_text_hover',
			[
				'label'     => __( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-login-icon .' . $class . ':hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			$class . '_border_radius_h',
			[
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-login-icon .' . $class . ':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$class_sub_info = isset( $settings['sub_info'] ) && $settings['sub_info'] ? ' has_sub_info' : '';
		?>
		<div class="hop-login-icon<?php
		echo esc_attr( $class_sub_info ); ?>">
			<?php
			//			$layout               = isset( $settings['layout'] ) ? $settings['layout'] : 'base';
			$registration_enabled = get_option( 'users_can_register' );
			// Login popup link output
			if ( is_user_logged_in() ) {
				if ( ( isset( $settings['text_profile'] ) && $settings['text_profile'] ) || ( ! empty( $settings['profile_icons']['library'] ) ) ) {
					echo '<a class="profile" href="' . esc_url( $settings['profile_url'] ) . '">';
					Icons_Manager::render_icon( $settings['profile_icons'], [ 'aria-hidden' => 'true' ] );
					echo esc_html( $settings['text_profile'] );
					echo '</a>';
				}
				if ( ( isset( $settings['text_logout'] ) && $settings['text_logout'] ) || ( ! empty( $settings['logout_icons']['library'] ) ) ) {
					echo '<a class="logout" href="' . esc_url( wp_logout_url( home_url() ) ) . '">';
					Icons_Manager::render_icon( $settings['logout_icons'], [ 'aria-hidden' => 'true' ] );
					echo esc_html( $settings['text_logout'] );
					echo '</a>';
				}
			} else {
				if ( $registration_enabled && ( isset( $settings['text_register'] ) && $settings['text_register'] )
					 || ( ! empty( $settings['register_icons']['library'] ) ) ) {
					echo '<a class="register" href="' . esc_url( $settings['url_register'] ) . '">';
					Icons_Manager::render_icon( $settings['register_icons'], [ 'aria-hidden' => 'true' ] );
					echo esc_html( $settings['text_register'] );
					echo '</a>';
				}
				if ( ( isset( $settings['text_login'] ) && $settings['text_login'] ) || ( ! empty( $settings['login_icons']['library'] ) ) ) {
					echo '<a class="login" href="' . esc_url( $settings['login_url'] ) . '">';
					Icons_Manager::render_icon( $settings['login_icons'], [ 'aria-hidden' => 'true' ] );
					echo esc_html( $settings['text_login'] );
					echo '</a>';
				}
			}
			?>
		</div>
		<?php
		//add_action( 'wp_footer', array( $this, 'display_login_popup_form' ), 5 );
	}

	public function display_login_popup_form() {
		$settings = $this->get_settings_for_display();

		if ( ! is_user_logged_in() ) {
			$registration_enabled = get_option( 'users_can_register' );
			?>
			<div id="hop-popup-login">

			</div>
			<?php
		}
	}
}
