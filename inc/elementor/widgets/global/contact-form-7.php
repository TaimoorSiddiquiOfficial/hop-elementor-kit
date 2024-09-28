<?php

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hop_Ekit_Widget_Contact_Form_7 extends Widget_Base {

	public function get_name() {
		return 'hop-ekits-contact-form-7';
	}

	public function get_title() {
		return esc_html__( 'Contact Form 7', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-mail';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'hop',
			'contact from',
			'from 7',
			'contact',
		];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function list_shortcode_contact_form() {
		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		$contact_forms = array();
		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$contact_forms[ $cform->ID ] = $cform->post_title;
			}
		} else {
			$contact_forms[ esc_html__( 'No contact forms found', 'hop-elementor-kit' ) ] = 0;
		}

		return $contact_forms;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'contact_form_7_tab_content',
			array(
				'label' => esc_html__( 'Content', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'id_form',
			array(
				'label'   => esc_html__( 'Select contact form', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->list_shortcode_contact_form(),
			)
		);

		$this->end_controls_section();
		$this->_register_setting_input_style();
		$this->_register_setting_button_style();
	}

	protected function _register_setting_input_style() {
		$this->start_controls_section(
			'cf7_style_input_section',
			array(
				'label' => esc_html__( 'Input Style', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'input_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),

			)
		);
		$this->add_responsive_control(
			'input_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};display: inherit;',
				),

			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'input_typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap .input-field',
			)
		);

		$this->add_responsive_control(
			'input_width',
			array(
				'label'      => esc_html__( 'Width', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'input_border_style',
			array(
				'label'     => esc_html_x( 'Border Type', 'Border Control', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'none'   => esc_html__( 'None', 'hop-elementor-kit' ),
					'solid'  => esc_html_x( 'Solid', 'Border Control', 'hop-elementor-kit' ),
					'double' => esc_html_x( 'Double', 'Border Control', 'hop-elementor-kit' ),
					'dotted' => esc_html_x( 'Dotted', 'Border Control', 'hop-elementor-kit' ),
					'dashed' => esc_html_x( 'Dashed', 'Border Control', 'hop-elementor-kit' ),
					'groove' => esc_html_x( 'Groove', 'Border Control', 'hop-elementor-kit' ),
				),
				'default'   => 'none',
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea' => 'border-style: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'input_border_dimensions',
			array(
				'label'     => esc_html_x( 'Width', 'Border Control', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'condition' => array(
					'input_border_style!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'input_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit'     => 'px',
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'input_tabs' );

		$this->start_controls_tab(
			'input_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'input_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input::-webkit-input-placeholder,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input::-moz-placeholder,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea::-moz-placeholder'                   => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input:-ms-input-placeholder,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea:-ms-input-placeholder'           => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input:-moz-placeholder,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea:-moz-placeholder'                     => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'input_normal_color',
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'input_normal_bg_color',
			array(
				'label'     => esc_html__( 'Background', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'input_normal_border_color',
			array(
				'label'     => esc_html__( 'Border', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'input_border_style!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'input_shadow_normal',
				'label'    => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'input_focus',
			array(
				'label' => esc_html__( 'Focus', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'input_focus_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input:hover,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea:hover,
					{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input:focus,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'input_shadow_hover',
				'label'    => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input:hover,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea:hover,
				{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap input:focus,{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-form-control-wrap textarea:focus',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function _register_setting_button_style() {
		$this->start_controls_section(
			'cf7_style_button_section',
			array(
				'label' => esc_html__( 'Button Style', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),

			)
		);
		$this->add_control(
			'button_spacing',
			array(
				'label'     => esc_html__( 'Buttom Spacing', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit',
			)
		);

		$this->add_responsive_control(
			'button_width',
			array(
				'label'      => esc_html__( 'Width', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'max' => 500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'button_align',
			array(
				'label'     => esc_html__( 'Button Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					),
					'none'  => array(
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit' => 'margin-left: auto; margin-right:auto; display: block;margin-{{VALUE}}: 0;',
				),
			)
		);

		$this->add_responsive_control(
			'button_border_style',
			array(
				'label'     => esc_html_x( 'Border Type', 'Border Control', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'none'   => esc_html__( 'None', 'hop-elementor-kit' ),
					'solid'  => esc_html_x( 'Solid', 'Border Control', 'hop-elementor-kit' ),
					'double' => esc_html_x( 'Double', 'Border Control', 'hop-elementor-kit' ),
					'dotted' => esc_html_x( 'Dotted', 'Border Control', 'hop-elementor-kit' ),
					'dashed' => esc_html_x( 'Dashed', 'Border Control', 'hop-elementor-kit' ),
					'groove' => esc_html_x( 'Groove', 'Border Control', 'hop-elementor-kit' ),
				),
				'default'   => 'none',
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit' => 'border-style: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'button_border_dimensions',
			array(
				'label'     => esc_html_x( 'Width', 'Border Control', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'condition' => array(
					'button_border_style!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit'     => 'px',
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'button_tabs' );

		$this->start_controls_tab(
			'button_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'button_normal_color',
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_normal_bg_color',
			array(
				'label'     => esc_html__( 'Background', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'button_normal_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_border_style!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_shadow_normal',
				'label'    => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'button_hover_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_hover_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit:hover' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_border_style!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_shadow_hover',
				'label'    => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-wpcf7 .wpcf7-submit:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['id_form'] ) ) : ?>
			<div class="hop-ekit-wpcf7">
				<?php
				Utils::print_unescaped_internal_string( do_shortcode( '[contact-form-7 id="' . absint( $settings['id_form'] ) . '"]' ) ); ?>
			</div>
		<?php
		endif;
	}
}
