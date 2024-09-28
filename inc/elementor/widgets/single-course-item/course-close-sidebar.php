<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Hop_Ekit_Widget_Course_Close_Sidebar extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-course-close-sidebar';
	}

	public function get_title() {
		return esc_html__( 'Close Sidebar', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-close';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE_ITEM );
	}

	public function get_help_url() {
		return '';
	}


	protected function register_controls() {
		$this->start_controls_section(
			'section_general',
			array(
				'label' => esc_html__( 'General', 'hop-elementor-kit' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'icon_close',
			array(
				'label'       => esc_html__( 'Select Icon Close', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'separator'   => 'before',
				'default'     => array(
					'value'   => 'fas fa-expand',
					'library' => 'fa-solid',
				),
				'skin'        => 'inline',
				'label_block' => false,
			)
		);

		$this->add_control(
			'icon_open',
			array(
				'label'       => esc_html__( 'Select Icon Open', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => array(
					'value'   => 'fas fa-compress',
					'library' => 'fa-solid',
				),
				'skin'        => 'inline',
				'label_block' => false,
			)
		);
		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-toggle-sidebar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => __( 'Icon Size (px)', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 14,
				'min'       => 0,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-toggle-sidebar i'   => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .hop-ekit-toggle-sidebar svg' => 'width: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'border_style',
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
					'{{WRAPPER}} .hop-ekit-toggle-sidebar' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_dimensions',
			[
				'label'     => esc_html_x( 'Width', 'Border Control', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'condition' => [
					'border_style!' => 'none'
				],
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-toggle-sidebar' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_color_icon_border_style' );

		$this->start_controls_tab(
			'tab_color_color_normal',
			[
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-toggle-sidebar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-toggle-sidebar i'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-ekit-toggle-sidebar svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'     => esc_html__( 'Border Color:', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-toggle-sidebar' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'border_style!' => 'none'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_color_icon_border_hover',
			[
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'color_hover',
			[
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-toggle-sidebar:hover i'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-ekit-toggle-sidebar:hover svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_color_hover',
			[
				'label'     => esc_html__( 'Border Color:', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-toggle-sidebar:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'border_style!' => 'none'
				],
			]
		);

		$this->add_control(
			'bg_color_hover',
			[
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-toggle-sidebar:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'border_radius',
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
					'{{WRAPPER}} .hop-ekit-toggle-sidebar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .hop-ekit-toggle-sidebar',
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-course-item/before-preview-query' );

		$settings = $this->get_settings_for_display();
		echo '<label for="sidebar-toggle" class="hop-ekit-toggle-sidebar">';
		echo '<span class="icon-open">';
		Icons_Manager::render_icon( $settings['icon_open'], [ 'aria-hidden' => 'true' ] );
		echo '</span>';
		echo '<span class="icon-close">';
		Icons_Manager::render_icon( $settings['icon_close'], [ 'aria-hidden' => 'true' ] );
		echo '</span>';
		echo '</label><input type="checkbox" id="sidebar-toggle" title="Show/Hide curriculum" />';

		do_action( 'hop-ekit/modules/single-course-item/after-preview-query' );
	}
}
