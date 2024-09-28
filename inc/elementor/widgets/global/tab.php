<?php

namespace Elementor;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hop_Ekit_Widget_Tab extends Widget_Base {
	public function get_name() {
		return 'hop-ekits-tab';
	}

	public function get_title() {
		return esc_html__( 'Tab', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-tabs';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'hop',
			'tab',
			'tabs',
		];
	}

	protected function register_controls() {
		/**
		 * Advance Tabs Settings
		 */
		$this->start_controls_section(
			'general_settings',
			[
				'label' => esc_html__( 'General Settings', 'hop-elementor-kit' ),
			]
		);
		$this->add_control(
			'tab_layout',
			[
				'label'       => esc_html__( 'Layout', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'tabs-horizontal',
				'label_block' => false,
				'options'     => [
					'tabs-horizontal' => esc_html__( 'Horizontal', 'hop-elementor-kit' ),
					'tabs-vertical'   => esc_html__( 'Vertical', 'hop-elementor-kit' ),
				],
			]
		);
		$this->add_control(
			'icon_position',
			[
				'label'        => esc_html__( 'Icon Position', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'left',
				'options'      => [
					'top'    => [
						'title' => esc_html__( 'Top', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-top',

					],
					'left'   => [
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-right',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'description'  => sprintf( __( 'Set icon position for title.', 'hop-elementor-kit' ) ),
				'prefix_class' => 'icon-position-',
			]
		);


		$this->add_control(
			'tabs_align_horizontal',
			[
				'label'        => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					''        => [
						'title' => esc_html__( 'Start', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-center',
					],
					'end'     => [
						'title' => esc_html__( 'End', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-right',
					],
					'stretch' => [
						'title' => esc_html__( 'Justified', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-stretch',
					],
				],
				'prefix_class' => 'hop-tabs-alignment-',
				'condition'    => [
					'tab_layout' => 'tabs-horizontal',
				],
			]
		);

		$this->add_control(
			'tabs_align_vertical',
			[
				'label'        => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					''       => [
						'title' => esc_html__( 'Start', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'end'    => [
						'title' => esc_html__( 'End', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'hop-tabs-alignment-',
				'condition'    => [
					'tab_layout' => 'tabs-vertical',
				],
			]
		);

		$this->end_controls_section();
		/**
		 * Advance Tabs Content Settings
		 */
		$this->start_controls_section(
			'content_settings',
			[
				'label' => esc_html__( 'Content', 'hop-elementor-kit' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label'   => esc_html__( 'Tab Title', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Tab Title', 'hop-elementor-kit' ),
			]
		);

		$repeater->add_control(
			'tab_title_icon',
			[
				'label'       => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => false,
				'skin'        => 'inline'
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label'   => esc_html__( 'Tab Content', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vehicula lacus nibh, quis egestas ex tincidunt eu. Nunc et sem luctus, ultricies orci sit amet, gravida dui.',
					'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'type'        => Controls_Manager::REPEATER,
				'seperator'   => 'before',
				'default'     => [
					[ 'tab_title' => esc_html__( 'Tab Title 1', 'hop-elementor-kit' ) ],
					[ 'tab_title' => esc_html__( 'Tab Title 2', 'hop-elementor-kit' ) ],
					[ 'tab_title' => esc_html__( 'Tab Title 3', 'hop-elementor-kit' ) ],
				],
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{tab_title}}',
			]
		);

		$this->add_control(
			'tab_caret_show',
			[
				'label'        => esc_html__( 'Show Caret on Active Tab', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'tab_caret_size',
			[
				'label'     => esc_html__( 'Caret Size', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 10,
				],
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hop-tabs-nav' => '--hop-caret-icon-size: {{SIZE}}px;',
				],
				'condition' => [
					'tab_caret_show' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->register_controls_style_title();

		$this->register_controls_style_content();

		$this->start_controls_section(
			'responsive_controls',
			[
				'label' => esc_html__( 'Responsive Controls', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();
	}


	protected function register_controls_style_title() {
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Tab Title', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .hop-tabs-nav li,{{WRAPPER}} .tab-accordion-title',
			]
		);
		$this->add_responsive_control(
			'title_width',
			[
				'label'      => __( 'Title Min Width', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hop-tabs-vertical .hop-tabs-nav' => 'min-width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'tab_layout' => 'tabs-vertical',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => __( 'Icon Size', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 16,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hop-tabs-nav li i,{{WRAPPER}} .tab-accordion-title i'     => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hop-tabs-nav li img,{{WRAPPER}} .tab-accordion-title img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hop-tabs-nav li svg,{{WRAPPER}} .tab-accordion-title svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_gap',
			[
				'label'      => __( 'Icon Gap', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 10,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hop-tabs-nav li,{{WRAPPER}} .tab-accordion-title' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_gap',
			[
				'label'      => __( 'Tab Gap', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 10,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hop-tabs-nav'       => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tab-accordion-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-tabs-nav li,{{WRAPPER}} .tab-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_margin',
			[
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-tabs-nav li,{{WRAPPER}} .tab-accordion-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-tabs-nav li,{{WRAPPER}} .tab-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_header_tabs' );
		// Normal State Tab
		$this->start_controls_tab( 'tabs_header_normal', [ 'label' => esc_html__( 'Normal', 'hop-elementor-kit' ) ] );
		$this->add_control(
			'tab_color',
			[
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f1f1f1',
				'selectors' => [
					'{{WRAPPER}}  .hop-tabs-nav,{{WRAPPER}} .tab-accordion-title' => '--hop-tab-bg-color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'tab_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .hop-tabs-nav,{{WRAPPER}} .tab-accordion-title' => '--hop-tab-text-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'tab_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .hop-tabs-nav li i,{{WRAPPER}} .tab-accordion-title i'      => 'color: {{VALUE}};',
					'{{WRAPPER}}  .hop-tabs-nav li svg,{{WRAPPER}} .tab-accordion-title svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'tab_icon_show' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'tab_border',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-tabs-nav li, {{WRAPPER}} .tab-accordion-title',
			]
		);

		$this->end_controls_tab();
		// Hover State Tab
		$this->start_controls_tab( 'tabs_header_hover', [ 'label' => esc_html__( 'Active', 'hop-elementor-kit' ) ] );
		$this->add_control(
			'tab_color_hover',
			[
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .hop-tabs-nav, {{WRAPPER}} .tab-accordion-title' => '--hop-tab-bg-color-hover: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_text_color_hover',
			[
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .hop-tabs-nav, {{WRAPPER}} .tab-accordion-title' => '--hop-tab-text-color-hover: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'tab_icon_color_hover',
			[
				'label'     => esc_html__( 'Icon Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .hop-tabs-nav li:hover >i,{{WRAPPER}} .hop-tabs-nav li[aria-selected=true] > i'      => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-tabs-nav li:hover > svg,{{WRAPPER}} .hop-tabs-nav li[aria-selected=true] > svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'tab_icon_show' => 'yes',
				],
			]
		);
		$this->add_control(
			'tab_border_hover',
			[
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .hop-tabs-nav li:hover,{{WRAPPER}} .hop-tabs-nav li[aria-selected=true]' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 'tab_border_border!' => '' ],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function register_controls_style_content() {
		/**
		 * -------------------------------------------
		 * Tab Style Advance Tabs Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'content_style_settings',
			[
				'label' => esc_html__( 'Content', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hop-tabs-content > div' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .hop-tabs-content > div' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .hop-tabs-content > div',
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-tabs-content > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-tabs-content > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'content_border',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-tabs-content > div',
			]
		);
		$this->add_responsive_control(
			'content_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-tabs-content > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'content_shadow',
				'selector'  => '{{WRAPPER}} .hop-tabs-content > div',
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$prefix_tab_id = 'item-tab-' . esc_attr( $this->get_id() ) . '-';
		$this->add_render_attribute(
			'hop_tab_wrapper',
			[
				'id'    => "hop-tabs-{$this->get_id()}",
				'class' => [ 'hop-ekit-tablist', 'hop-' . $settings['tab_layout'] ],
			]
		);
		if ( $settings['tab_caret_show'] == 'yes' ) {
			$this->add_render_attribute( 'hop_tab_wrapper', 'class', 'active-caret-on' );
		}
		?>

		<div <?php $this->print_render_attribute_string( 'hop_tab_wrapper' ); ?>>
			<ul class="hop-tabs-nav" role="tablist">
				<?php
				foreach ( $settings['tabs'] as $index => $tab ) :
					$tab_count = $index + 1;
					$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tab', $index );
					$this->add_render_attribute( $tab_title_setting_key, [
						'class'         => 'tab-item',
						'aria-selected' => 1 === $tab_count ? 'true' : 'false',
						'role'          => 'tab',
						'tabindex'      => 1 === $tab_count ? '0' : '-1',
						'aria-controls' => $prefix_tab_id . $tab_count,
					] );
					?>
					<li <?php $this->print_render_attribute_string( $tab_title_setting_key ); ?>>
						<?php
						if ( empty( $settings['tab_title_icon'] ) ) {
							Icons_Manager::render_icon( $tab['tab_title_icon'] );
						}
						echo wp_kses_post( $tab['tab_title'] );
						?>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="hop-tabs-content">
				<?php
				foreach ( $settings['tabs'] as $index => $tab ) :
					$tab_count = $index + 1;
					$tab_title_setting_key_mobile = $this->get_repeater_setting_key(
						'tab_title_mobile', 'tab',
						$index
					);
					$this->add_render_attribute( $tab_title_setting_key_mobile, [
						'class'         => 'tab-accordion-title',
						'aria-selected' => 1 === $tab_count ? 'true' : 'false',
						'role'          => 'tab',
						'tabindex'      => 1 === $tab_count ? '0' : '-1',
						'aria-controls' => $prefix_tab_id . $tab_count,
					] );
					?>
					<div <?php $this->print_render_attribute_string( $tab_title_setting_key_mobile ); ?>>
						<?php
						if ( empty( $settings['tab_title_icon'] ) ) {
							Icons_Manager::render_icon( $tab['tab_title_icon'] );
						}
						echo wp_kses_post( $tab['tab_title'] );
						?>
					</div>

					<div id="<?php echo esc_attr( $prefix_tab_id . $tab_count ); ?>" role="tabpanel"
						 aria-labelledby="<?php echo esc_attr( $prefix_tab_id . $tab_count ); ?>"
						 tabindex="<?php echo esc_attr( 1 === $tab_count ? '0' : '-1' ); ?>" <?php echo esc_attr( 1 != $tab_count ? 'hidden' : '' ); ?>>
						<?php echo wp_kses_post( $tab['tab_content'] ); ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}
