<?php

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hop_Ekit_Widget_Back_To_Top extends Widget_Base {

	public function get_name() {
		return 'hop-ekits-back-to-top';
	}

	public function get_title() {
		return esc_html__( 'Back To Top', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-arrow-up';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'hop',
			'back to top',
			'to top',
		];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'back_to_top_section_tab_content',
			array(
				'label' => esc_html__( 'Back To Top Settings', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'button_icons',
			array(
				'label'   => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-arrow-up',
					'library' => 'Font Awesome 5 Free',
				),
			)
		);

		$this->add_control(
			'circle_progress',
			array(
				'label'   => esc_html__( 'Circle Progress', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);

		$this->add_responsive_control(
			'button_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
				'options'   => array(
					'left'   => array(
						'description' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'        => 'eicon-text-align-left',
					),
					'center' => array(
						'description' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'        => 'eicon-text-align-center',
					),
					'right'  => array(
						'description' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'        => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .back-to-top__swapper' => 'cursor: pointer; text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
		$this->_register_setting_button_style();
	}

	protected function _register_setting_button_style() {
		$this->start_controls_section(
			'back_to_top_style_section',
			array(
				'label' => esc_html__( 'Button Style', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'button_typography',
				'label'          => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector'       => '{{WRAPPER}} .back-to-top__button',
				'exclude'        => array( 'letter_spacing', 'font_style', 'text_decoration' ),
				'fields_options' => array(
					'typography'     => array(
						'default' => 'custom',
					),
					'font_weight'    => array(
						'default' => '400',
					),
					'font_size'      => array(
						'default'    => array(
							'size' => '16',
							'unit' => 'px',
						),
						'size_units' => array( 'px' ),
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
			)
		);

		$this->add_responsive_control(
			'button_width',
			array(
				'label'      => esc_html__( 'Width (px)', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .back-to-top__button' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_height',
			array(
				'label'      => esc_html__( 'Height (px)', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .back-to-top__button' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .back-to-top__button',
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
					'{{WRAPPER}} .back-to-top__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .back-to-top__button'        => 'color: {{VALUE}}; border-color: {{VALUE}}',
					'{{WRAPPER}} .scroll-circle-progress svg' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_normal_bg_color',
			array(
				'label'     => esc_html__( 'Background', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .back-to-top__button' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_shadow_normal',
				'label'    => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .back-to-top__button',
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
			'button_hover_clr',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .back-to-top__button:hover' => 'color: {{VALUE}}; border-color: {{VALUE}}',
					'{{WRAPPER}} .back-to-top__button:focus' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_hover_bg_clr',
			array(
				'label'     => esc_html__( 'Background', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .back-to-top__button:hover' => 'background: {{VALUE}}',
					'{{WRAPPER}} .back-to-top__button:focus' => 'background: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_shadow_hover',
				'label'    => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .back-to-top__button:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$svg_html = $class = '';
		if ( $settings['circle_progress'] == 'yes' ) {
			$class    = ' scroll-circle-progress';
			$svg_html = '<svg width="100%" height="100%" viewBox="-1 -1 102 102">
				<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
			</svg>';
		}
		?>
		<div class="back-to-top__swapper" id="back-to-top-kits">
			<div class="back-to-top__button<?php echo esc_attr( $class ); ?>">
				<?php
				echo $svg_html;

				Icons_Manager::render_icon( $settings['button_icons'], array( 'aria-hidden' => 'true' ) );
				?>
			</div>
		</div>
		<?php
	}
}
