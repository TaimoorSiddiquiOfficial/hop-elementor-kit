<?php

namespace Elementor;

use Hop_EL_Kit\LoginRegisterTrait;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hop_Ekit_Widget_Login_Form extends Widget_Base { 
	use  LoginRegisterTrait;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-login-form';
	}

	public function get_title() {
		return esc_html__( 'Login | Register Form', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-lock-user';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'login-section',
			[
				'label' => esc_html__( 'Login', 'hop-elementor-kit' )
			]
		);
		$this->add_control(
			'title_from',
			[
				'label' => __( 'Login Form Title', 'hop-elementor-kit' ),
				'type'  => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h2',
			]
		);
		$this->add_control(
			'redirect_after_login',
			[
				'label'     => __( 'Redirect After Login', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'label_off' => __( 'Off', 'hop-elementor-kit' ),
				'label_on'  => __( 'On', 'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'redirect_url',
			[
				'type'        => Controls_Manager::URL,
				'show_label'  => false,
				'options'     => false,
				'separator'   => false,
				'placeholder' => __( 'https://your-link.com', 'hop-elementor-kit' ),
				'description' => __( 'Note: Because of security reasons, you can ONLY use your current domain here.',
					'hop-elementor-kit' ),
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => [
					'redirect_after_login' => 'yes',
				],
			]
		);

		$this->add_control(
			'redirect_after_logout',
			[
				'label'     => __( 'Redirect After Logout', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'label_off' => __( 'Off', 'hop-elementor-kit' ),
				'label_on'  => __( 'On', 'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'redirect_logout_url', [
				'type'        => Controls_Manager::URL,
				'show_label'  => false,
				'options'     => false,
				'separator'   => false,
				'placeholder' => __( 'https://your-link.com', 'hop-elementor-kit' ),
				'description' => __( 'Note: Because of security reasons, you can ONLY use your current domain here.',
					'hop-elementor-kit' ),
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => [
					'redirect_after_logout' => 'yes',
				],
			]
		);

		$this->add_control(
			'custom_labels',
			[
				'label' => __( 'Custom Label', 'hop-elementor-kit' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'user_placeholder',
			[
				'label'     => __( 'Username Placeholder', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Username or Email Address', 'hop-elementor-kit' ),
				'condition' => [
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'password_placeholder',
			[
				'label'     => __( 'Password Placeholder', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Password', 'hop-elementor-kit' ),
				'condition' => [
					'custom_labels' => 'yes',
				],
			]
		);
		$this->add_control(
			'text_login',
			[
				'label'     => __( 'Text Button', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Login', 'hop-elementor-kit' ),
				'condition' => [
					'custom_labels' => 'yes',
				],
			]
		);
		if ( get_option( 'users_can_register' ) ) {
			$this->add_control(
				'show_register', [
					'label'     => __( 'Register', 'hop-elementor-kit' ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'yes',
					'label_off' => __( 'Hide', 'hop-elementor-kit' ),
					'label_on'  => __( 'Show', 'hop-elementor-kit' ),
				]
			);
		}

		$this->end_controls_section();
		//
		$this->register_controls_from_rg();
	}

	protected function register_controls_from_rg() {
		$this->start_controls_section(
			'register-section',
			array(
				'label'     => esc_html__( 'Register', 'hop-elementor-kit' ),
				'condition' => [
					'show_register' => 'yes',
				],
			)
		);
		$this->add_control(
			'title_from_rg',
			[
				'label' => __( 'Register Form Title', 'hop-elementor-kit' ),
				'type'  => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'tag_rg',
			[
				'label'   => esc_html__( 'HTML Tag', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h2',
			]
		);
		$this->add_control(
			'auto_login',
			[
				'label'     => __( 'Auto Login After Register', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'label_off' => __( 'Off', 'hop-elementor-kit' ),
				'label_on'  => __( 'On', 'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'redirect_register_url', [
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Redirect After Register', 'hop-elementor-kit' ),
				'placeholder' => __( 'https://your-link.com', 'hop-elementor-kit' ),
				'description' => __( 'Note: Because of security reasons, you can ONLY use your current domain here.',
					'hop-elementor-kit' ),
				'condition'   => [
					'auto_login' => '',
				],
			]
		);

		$this->add_control(
			'custom_labels_rg',
			[
				'label' => __( 'Custom Label', 'hop-elementor-kit' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'rg_user_placeholder',
			[
				'label'     => __( 'Username Placeholder', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Username', 'hop-elementor-kit' ),
				'condition' => [
					'custom_labels_rg' => 'yes',
				],
			]
		);

		$this->add_control(
			'rg_email_placeholder',
			[
				'label'     => __( 'Password Placeholder', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Email', 'hop-elementor-kit' ),
				'condition' => [
					'custom_labels_rg' => 'yes',
				],
			]
		);
		$this->add_control(
			'text_register',
			[
				'label'     => __( 'Text Button', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Register', 'hop-elementor-kit' ),
				'condition' => [
					'custom_labels_rg' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		$this->_register_settings_styles();
		$this->_register_login_styles();
	}

	protected function _register_settings_styles() {
		$this->start_controls_section(
			'settings_style',
			array(
				'label' => esc_html__( 'Settings', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			)
		);
		$this->add_control(
			'layout_settings_style',
			array(
				'label'     => esc_html__( 'Layout', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'layout_form_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'layout_form_max_width',
			array(
				'label'      => esc_html__( 'Max Width', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 480,
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-form-login' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'layout_form_paddding',
			[
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-form-login' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'layout_form_border',
				'selector'  => '{{WRAPPER}} .hop-form-login',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'layout_form_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-form-login' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'layout_form_box_shadow',
				'exclude'  => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} .hop-form-login',
			)
		);
		$this->add_control(
			'heading_title_settings_style',
			array(
				'label'     => esc_html__( 'Title', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'header_title_align',
			array(
				'label'     => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .title' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'header_title_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'header_title_Typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .title',
			]
		);
		$this->add_responsive_control(
			'header_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function _register_login_styles() {
		$this->start_controls_section(
			'form_style',
			array(
				'label' => esc_html__( 'Form', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'heading_lable_style',
			array(
				'label'     => esc_html__( 'Lable', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'login_lable_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .description,{{WRAPPER}} .form-login-bottom,{{WRAPPER}} .login-remember' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'login_lable_Typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .description,{{WRAPPER}} .form-login-bottom,{{WRAPPER}} .login-remember,
				{{WRAPPER}} .lost-pass-link',
			]
		);
		$this->add_control(
			'heading_input_style',
			array(
				'label'     => esc_html__( 'Input', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'login_input_Typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-form-login .input,{{WRAPPER}} .hop-form-login .input::placeholder',
			]
		);
		$this->add_responsive_control(
			'login_input_max_width',
			array(
				'label'      => esc_html__( 'Max Width', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				),
				'default'    => array(
					'unit' => '%',
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-form-login .input ,{{WRAPPER}} form#lostpasswordform p input[type=text]' => 'max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hop-form-login form'                                                         => 'text-align:center;',
				),
			)
		);
		$this->add_responsive_control(
			'login_input_paddding',
			[
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-form-login .input,{{WRAPPER}} form#lostpasswordform p input[type=text]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'login_input_border',
				'selector' => '{{WRAPPER}} .hop-form-login .input,{{WRAPPER}} form#lostpasswordform p input[type=text]',
				//'separator' => 'before',
				'exclude'  => array( 'color' )
			)
		);
		$this->add_control(
			'login_input_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-form-login .input,{{WRAPPER}} form#lostpasswordform p input[type=text]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_login_form_input' );
		$this->start_controls_tab(
			'tab_login_form_input_normal',
			[
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			]
		);
		$this->add_control(
			'login_input_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login .input::placeholder,{{WRAPPER}} .hop-form-login .input' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'login_input_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login .input' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'login_input_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [ 'login_input_border_border!' => [ '', 'none' ] ],

				'selectors' => array(
					'{{WRAPPER}} .hop-form-login .input' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_login_input_form_focus',
			[
				'label' => esc_html__( 'Focus', 'hop-elementor-kit' ),
			]
		);
		$this->add_control(
			'login_input_focus_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login .input:focus'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-form-login .input:placeholder' => 'color: {{VALUE}};',

				),
			)
		);
		$this->add_control(
			'login_input_focus_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login .input:focus' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'login_input_focus_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [ 'login_input_border_border!' => [ '', 'none' ] ],
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login .input:focus' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'heading_button_submit_style',
			array(
				'label'     => esc_html__( 'Button Submit', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'login_form_bt_submit_align',
			array(
				'label'     => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .login-submit,{{WRAPPER}} .hop-form-login form' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'login_form_bt_submit_Typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-form-login .button,{{WRAPPER}} form#lostpasswordform p input[type=submit]',
			]
		);
		$this->add_responsive_control(
			'login_form_bt_submit_max_width',
			array(
				'label'      => esc_html__( 'Max Width', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				),
				'default'    => array(
					'unit' => '%',
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-form-login .button,{{WRAPPER}} form#lostpasswordform p input[type=submit]' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'login_form_bt_submit_paddding',
			[
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-form-login .button,{{WRAPPER}} form#lostpasswordform p input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'login_form_bt_submit_margin',
			[
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-form-login .button,{{WRAPPER}} form#lostpasswordform p input[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'login_form_bt_submit_border',
				'selector' => '{{WRAPPER}} .hop-form-login .button,{{WRAPPER}} form#lostpasswordform p input[type=submit]',
				'exclude'  => array( 'color' )
				//'separator' => 'before',
			)
		);
		$this->add_control(
			'login_form_bt_submit_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-form-login .button,{{WRAPPER}} form#lostpasswordform p input[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_login_form_bt_submit' );
		$this->start_controls_tab(
			'tab_login_form_bt_submit_normal',
			[
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			]
		);
		$this->add_control(
			'login_form_bt_submit_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login .button' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'login_form_bt_submit_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login .button' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'login_form_bt_submit_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [ 'login_form_bt_submit_border_border!' => [ '', 'none' ] ],
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login  .button,{{WRAPPER}} form#lostpasswordform p input[type=submit]' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_login_input_form_hover',
			[
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			]
		);
		$this->add_control(
			'login_form_bt_submit_color_hover',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login .button:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'login_form_bt_submit_bg_color_hover',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login .button:hover' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'login_form_bt_submit_border_color_hover',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [ 'login_form_bt_submit_border_border!' => [ '', 'none' ] ],
				'selectors' => array(
					'{{WRAPPER}} .hop-form-login .button:hover,{{WRAPPER}} form#lostpasswordform p input[type=submit]:hover' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		update_option( 'hop_login_page', get_the_ID() );

		$settings        = $this->get_settings_for_display();
		$current_url     = $this->hop_get_current_url();
		$logout_redirect = $current_url;
		if ( 'yes' === $settings['redirect_after_logout'] && ! empty( $settings['redirect_logout_url']['url'] ) ) {
			$logout_redirect = $settings['redirect_logout_url']['url'];
		}
		if ( is_user_logged_in() && ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$current_user = wp_get_current_user();
			echo '<div class="hop-logged-in-message message-success">' . sprintf( __( 'You are Logged in as %1$s (<a href="%2$s">Logout</a>)',
					'hop-elementor-kit' ), $current_user->display_name, wp_logout_url( $logout_redirect ) ) . '</div>';

			return;
		}


		if ( ( isset( $_GET['result'] ) && $_GET['result'] != 'failed' ) || isset( $_GET['action'] ) ) :
			$this->render_form_register();
			$this->render_form_lostpassword();
			$this->render_form_resetpass();
			if ( isset( $_GET['result'] ) ) {
				if ( $_GET['result'] == 'registered' ) :
					echo '<p class="message message-success">' . esc_html__( 'Registration is successful. Confirmation will be e-mailed to you.',
							'hop-elementor-kit' ) . '</p>';
				endif;
				/*** Send mail reset success ***/
				if ( $_GET['result'] == 'reset' ) :
					echo '<p class="message message-success">' . esc_html__( 'Check your email to get a link to create a new password.',
							'hop-elementor-kit' ) . '</p>';
				endif;
				/*** Reset pass success ***/
				if ( $_GET['result'] == 'changed' ) :
					echo '<p class="message message-success">' . sprintf( wp_kses( __( 'Password changed. You can <a href="%s">login</a> now.',
							'hop-elementor-kit' ), array( 'a' => array( 'href' => array() ) ) ),
							$this->hop_get_login_page_url() ) . '</p>';
				endif;

				return;
			}

			return;
		endif;

		$this->render_form_login( $current_url );
	}

	protected function render_form_login( $current_url ) {
		$settings       = $this->get_settings_for_display();
		$hop_login_msg = wp_kses_post( $_GET['hop_login_msg'] ?? '' );
		$redirect_url   = $current_url;
		if ( 'yes' === $settings['redirect_after_login'] && ! empty( $settings['redirect_url']['url'] ) ) {
			$redirect_url = $settings['redirect_url']['url'];
		}

		$user_label = $settings['user_placeholder'] ? $settings['user_placeholder'] : esc_html__( 'Username or email',
			'hop-elementor-kit' );
		$pass_label = $settings['password_placeholder'] ? $settings['password_placeholder'] : esc_html__( 'Password',
			'hop-elementor-kit' );
		$btn_label  = $settings['text_login'] ? $settings['text_login'] : esc_html__( 'Login', 'hop-elementor-kit' );


		if ( isset( $_GET['result'] ) && $_GET['result'] == 'failed' ) {
			if ( ! empty( $hop_login_msg ) ) {
				echo sprintf( '<p class="message message-error">%s</p>',
					esc_html( html_entity_decode( wp_unslash( $hop_login_msg ) ) ) );
			}
		}
		?>
		<div class="hop-form-login">
		<?php
		if ( $settings['title_from'] ) {
			$title_tag = Utils::validate_html_tag($settings['tag']);
			echo sprintf('<%s class="title">%s</%s>', $title_tag, esc_html__($settings['title_from'], 'hop-elementor-kit'), $title_tag);	
		} ?>
		<form name="loginform" action="<?php
		echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post" novalidate>
			<p class="login-username">
				<input type="text" name="log" placeholder="<?php
				echo esc_attr( $user_label ); ?>" class="input required" size="20"/>
			</p>
			<p class="login-password">
				<input type="password" name="pwd" placeholder="<?php
				echo esc_attr( $pass_label ); ?>" class="input required" value="" size="20"/>
			</p>
			<?php
			/**
			 * Fires following the 'Password' field in the login form.
			 *
			 * @since 2.1.0
			 */
			do_action( 'login_form' );
			?>
			<p class="forgetmenot login-remember">
				<label for="rememberMe">
					<input name="rememberme" type="checkbox" id="rememberMe" value="forever"/> <?php
					esc_html_e( 'Remember Me', 'hop-elementor-kit' ); ?>
				</label>
				<?php
				echo '<a class="lost-pass-link" href="' . $this->hop_get_lost_password_url() . '" title="' . esc_attr__( 'Forgot Password?',
						'hop-elementor-kit' ) . '">' . esc_html__( 'Forgot Password?',
						'hop-elementor-kit' ) . '</a>'; ?>

			</p>

			<p class="login-submit">
				<input type="submit" name="wp-submit" class="button button-primary" value="<?php
				echo esc_attr( $btn_label ); ?>"/>
				<input type="hidden" name="redirect_to" value="<?php
				echo esc_url( $redirect_url ); ?>"/>
				<input type="hidden" name="hop_login_user">
			</p>

		</form>
		<?php
		$registration_enabled = get_option( 'users_can_register' );
		if ( $registration_enabled && $settings['show_register'] === 'yes' ) :
			echo '<div class="form-login-bottom">' . esc_html__( 'Not a member yet? ',
					'hop-elementor-kit' ) . ' <a href="' . esc_attr( $this->hop_get_register_url() ) . '">' . esc_html__( 'Register now',
					'hop-elementor-kit' ) . '</a></div>';
		endif;
		?>
		</div>
	<?php
	}

	protected function render_form_register() {
		$settings     = $this->get_settings_for_display();
		$redirect_url = $this->hop_get_login_page_url();
		$class        = '';
		if ( $settings['auto_login'] ) {
			if ( $settings['redirect_register_url'] ) {
				$redirect_url = $settings['redirect_register_url'];
			}
			$class = ' auto_login';
		} else {
			$redirect_url = add_query_arg( 'result', 'registered', $this->hop_get_login_page_url() );
		}


		if ( ! empty( $_GET['action'] ) && $_GET['action'] == 'register' ) :
			if ( get_option( 'users_can_register' ) ) : ?>
				<?php
				$hop_register_msg = wp_kses_post( $_GET['hop_register_msg'] ?? '' );
				if ( ! empty( $_GET['hop_register_msg'] ) ) {
					echo sprintf( '<p class="message message-error">%s</p>',
						esc_html( html_entity_decode( wp_unslash( $hop_register_msg ) ) ) );
				}

				$user_label  = $settings['rg_user_placeholder'] ? $settings['rg_user_placeholder'] : esc_html__( 'Username',
					'hop-elementor-kit' );
				$email_label = $settings['rg_email_placeholder'] ? $settings['rg_email_placeholder'] : esc_html__( 'Email',
					'hop-elementor-kit' );
				$btn_label   = $settings['text_register'] ? $settings['text_register'] : esc_html__( 'Sign up',
					'hop-elementor-kit' );
				?>
				<div class="hop-form-login">
				<?php
				if ( $settings['title_from_rg'] ) {
					$tag_rg = Utils::validate_html_tag($settings['tag_rg']);
					echo sprintf('<%s class="title">%s</%s>', $tag_rg, esc_html__($settings['title_from_rg'], 'hop-elementor-kit'), $tag_rg);	
				} ?>
				<form name="registerform" class="hop-register-form<?php
				echo esc_attr( $class ); ?>" action="<?php
				echo esc_url( site_url( 'wp-login.php?action=register', 'login_post' ) ); ?>" method="post"
					  novalidate="novalidate">
					<p>
						<input placeholder="<?php
						echo esc_attr( $user_label ); ?>" type="text" name="user_login" class="input required"/>
					</p>

					<p>
						<input placeholder="<?php
						echo esc_attr( $email_label ); ?>" type="email" name="user_email" class="input required"/>
					</p>

					<?php
					if ( $settings['auto_login'] ) { ?>
						<p>
							<input placeholder="<?php
							esc_attr_e( 'Password', 'hop-elementor-kit' ); ?>" type="password" name="password"
								   class="input required"/>
						</p>
						<p>
							<input placeholder="<?php
							esc_attr_e( 'Repeat Password', 'hop-elementor-kit' ); ?>" type="password"
								   name="repeat_password" class="input required"/>
						</p>
					<?php
					} ?>

					<?php

					do_action( 'register_form' );
					?>

					<p>
						<input type="hidden" name="redirect_to" value="<?php
						echo esc_url( $redirect_url ); ?>"/>
						<input type="hidden" name="modify_user_notification" value="1">
						<input type="hidden" name="hop_register_user">
						<?php
						if ( $settings['auto_login'] ) {
							echo '<input type="hidden" name="register_auto_login" value="1">';
						} ?>
					</p>

					<?php
					do_action( 'signup_hidden_fields', 'create-another-site' ); ?>
					<p class="login-submit">
						<input type="submit" name="wp-submit" class="button button-primary" value="<?php
						echo esc_attr( $btn_label ); ?>"/>
					</p>
				</form>

				<?php
				echo '<div class="form-login-bottom">' . esc_html__( 'Are you a member? ',
						'hop-elementor-kit' ) . ' <a href="' . $this->hop_get_login_page_url() . '">' . esc_html__( 'Login now',
						'hop-elementor-kit' ) . '</a></div>'; ?>
				</div>

			<?php
			else : ?>
				<?php
				echo '<p class="message message-error">' . esc_html__( 'Your site does not allow users registration.',
						'hop-elementor-kit' ) . '</p>'; ?>

			<?php
			endif;
		endif;
	}

	protected function render_form_lostpassword() { ?>
		<?php
		/*** Lost password request ***/
		if ( isset( $_GET['action'] ) && $_GET['action'] == 'lostpassword' ) :
			$hop_lostpass_msg = wp_kses_post( $_GET['hop_lostpass_msg'] ?? '' );
			if ( ! empty( $hop_lostpass_msg ) ) {
				echo sprintf( '<p class="message message-error">%s</p>',
					esc_html( html_entity_decode( wp_unslash( $hop_lostpass_msg ) ) ) );
			}
			?>

			<div class="hop-form-login">
				<h2 class="title"><?php
					esc_html_e( 'Get Your Password', 'hop-elementor-kit' ); ?></h2>
				<form name="lostpasswordform" id="lostpasswordform" action="<?php
				echo esc_url( network_site_url( 'wp-login.php?action=lostpassword', 'login_post' ) ); ?>" method="post">
					<p class="description"><?php
						esc_html_e( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.',
							'hop-elementor-kit' ); ?></p>

					<p>
						<input placeholder="<?php
						esc_attr_e( 'Username or email', 'hop-elementor-kit' ); ?>" type="text" name="user_login"
							   class="input required"/>
					</p>
					<p>
						<input type="hidden" name="redirect_to" value="<?php
						echo esc_attr( add_query_arg( 'result', 'reset', $this->hop_get_login_page_url() ) ); ?>"/>
						<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large"
							   value="<?php
							   esc_attr_e( 'Reset password', 'hop-elementor-kit' ); ?>"/>
						<input type="hidden" name="hop_lostpass"/>
					</p>
					<?php
					do_action( 'lostpassword_form' ); ?>
				</form>
			</div>
		<?php
		endif; ?>
	<?php
	}

	protected function render_form_resetpass() {
		?>
		<?php
		if ( isset( $_GET['action'] ) && $_GET['action'] == 'rp' ) : ?>
			<?php
			$hop_resetpass_msg = wp_kses_post( $_GET['hop_resetpass_msg'] ?? '' );
			if ( ! empty( $hop_resetpass_msg ) ) {
				echo sprintf( '<p class="message message-error">%s</p>',
					esc_html( html_entity_decode( wp_unslash( $hop_resetpass_msg ) ) ) );
			}
			?>
			<div class="hop-form-login">
				<h2 class="title"><?php
					esc_html_e( 'Change Password', 'hop-elementor-kit' ); ?></h2>

				<form name="resetpassform" id="resetpassform" action="<?php
				echo site_url( 'wp-login.php?action=resetpass' ); ?>" method="post" autocomplete="off">
					<input type="hidden" id="user_login" name="login" value="<?php
					echo isset( $_GET['login'] ) ? esc_attr( $_GET['login'] ) : ''; ?>" autocomplete="off"/>
					<input type="hidden" name="key" value="<?php
					echo isset( $_GET['key'] ) ? esc_attr( $_GET['key'] ) : ''; ?>"/>

					<p>
						<input placeholder="<?php
						esc_attr_e( 'New password', 'hop-elementor-kit' ); ?>" type="password" name="password"
							   id="password" class="input"/>
					</p>

					<p class="resetpass-submit">
						<input type="submit" name="submit" id="resetpass-button" class="button" value="<?php
						_e( 'Reset Password', 'hop-elementor-kit' ); ?>"/>
					</p>

					<p class="message message-success">
						<?php
						esc_html_e( 'Hint: The password should be at least twelve characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ &amp; ).',
							'hop-elementor-kit' ); ?>
					</p>

				</form>
			</div>
		<?php
		endif; ?>
	<?php
	}
}
