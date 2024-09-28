<?php

namespace Elementor;

// If this file is called directly, abort.
use Hop_EL_Kit\GroupControlTrait;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hop_Ekit_Widget_SVG_Draw extends Widget_Base {
	use GroupControlTrait;

	public function get_name() {
		return 'svg-draw';
	}

	public function get_title() {
		return esc_html__( 'Icon SVG Draw', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon  eicon-favorite';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'svg',
			'draq',
			'animation',
			'icon',
			'icon animation',
			'svg animation',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'elementor' ),
			]
		);
		$this->add_control(
			'selected_icon',
			[
				'label'   => esc_html__( 'Icon', 'elementor' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);
		$this->add_control(
			'link',
			[
				'label'   => esc_html__( 'Link', 'elementor' ),
				'type'    => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label'     => esc_html__( 'Alignment', 'elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'size',
			[
				'label'      => esc_html__( 'Size', 'elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon svg' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'rotate',
			[
				'label'          => esc_html__( 'Rotate', 'elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
				'default'        => [
					'unit' => 'deg',
				],
				'tablet_default' => [
					'unit' => 'deg',
				],
				'mobile_default' => [
					'unit' => 'deg',
				],
				'selectors'      => [
					'{{WRAPPER}} .elementor-icon i, {{WRAPPER}} .elementor-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->end_controls_section();
		// Style for draw svg
		$this->register_style_draw_icon();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$svg_options = [
			'fill'      => $settings['svg_fill'] === 'after' ? 'fill-svg' : '',
			'loop'      => $settings['svg_loop'] ? esc_attr( $settings['svg_loop'] ) : 'no',
			'offset'    => esc_attr( $settings['svg_draw_offset'] ),
			'direction' => esc_attr( $settings['svg_direction'] ),
			'speed'     => esc_attr( $settings['svg_draw_speed'] ),
		];
		$this->add_render_attribute( 'icon-wrapper', [
				'class'         => [
					'elementor-icon icon-svg-draw',
					esc_attr( $settings['svg_animation_on'] ),
					$settings['svg_fill'] === 'before' ? 'fill-svg' : ''
				],
				'data-settings' => wp_json_encode( $svg_options )
			]
		);

		$icon_tag = 'div';

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'icon-wrapper', $settings['link'] );

			$icon_tag = 'a';
		}
		?>
		<<?php
		Utils::print_unescaped_internal_string( $icon_tag . ' ' . $this->get_render_attribute_string( 'icon-wrapper' ) ); ?>>
		<?php
		Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
		?>
		</<?php
		Utils::print_unescaped_internal_string( $icon_tag ); ?>>
		<?php
	}
}
