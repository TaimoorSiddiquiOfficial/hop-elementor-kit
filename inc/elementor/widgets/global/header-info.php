<?php

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hop_Ekit_Widget_Header_Info extends Widget_Base {

	public function get_name() {
		return 'hop-ekits-header-info';
	}

	public function get_title() {
		return esc_html__( 'Header Info', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-form-vertical';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'hop',
			'header info',
			'list info',
			'info',
		];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_tab_content',
			array(
				'label' => esc_html__( 'Header Info Settings', 'hop-elementor-kit' ),
			)
		);

		$headerinfogroup = new Repeater();
		$headerinfogroup->add_control(
			'icons',
			array(
				'label'       => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => array(
					'value'   => 'far fa-address-book',
					'library' => 'Font Awesome 5 Free',
				),
			)
		);

		$headerinfogroup->add_control(
			'text',
			array(
				'label'       => esc_html__( 'Text', 'hop-elementor-kit' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Over 7 million students',
				'description' => esc_html__( '"Focused Title" Settings will be worked, If you use this {{something}} format',
					'hop-elementor-kit' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$headerinfogroup->add_control(
			'link',
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
			'group',
			array(
				'label'       => esc_html__( 'Header Info', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $headerinfogroup->get_controls(),
				'default'     => array(
					array(
						'text' => esc_html__( 'Over 7 million students', 'hop-elementor-kit' ),
					),

				),
				'title_field' => '{{{ text }}}',
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'header_icon_style',
			array(
				'label' => esc_html__( 'Header Info', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'layout',
			array(
				'label'     => esc_html__( 'Display', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'block'        => array(
						'title' => esc_html__( 'Default', 'hop-elementor-kit' ),
						'icon'  => 'eicon-editor-list-ul',
					),
					'inline-block' => array(
						'title' => esc_html__( 'Inline', 'hop-elementor-kit' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'default'   => 'inline-block',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .hop-header-info '      => 'margin: 0;',
					'{{WRAPPER}} .hop-header-info > li ' => 'display: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'alignment',
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
				'default'   => 'left',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .hop-header-info' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'item_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-header-info > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-header-info > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		// start tab for content
		$this->start_controls_tabs(
			'style_tabs'
		);

		// start normal tab
		$this->start_controls_tab(
			'style_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .hop-header-info > li > a, {{WRAPPER}} .hop-header-info > li' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'item_bg',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-header-info > li' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-header-info > li > a,{{WRAPPER}} .hop-header-info > li',
			)
		);

		$this->end_controls_tab();
		// end normal tab

		// start hover tab
		$this->start_controls_tab(
			'style_hover',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'text_color_hover',
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .hop-header-info > li:hover > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'item_bg_hover',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-header-info > li:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography_hover',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-header-info > li:hover > a',
			)
		);

		$this->end_controls_tab();
		// end hover tab

		$this->end_controls_tabs();

		$this->add_control(
			'icon_heading',
			array(
				'label'     => __( 'Icon', 'hop-elementor-kit' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// start tab for content
		$this->start_controls_tabs(
			'icon_style_tabs'
		);

		// start normal tab
		$this->start_controls_tab(
			'icon_style_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .hop-header-info > li i'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-header-info > li svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		// end normal tab

		// start hover tab
		$this->start_controls_tab(
			'icon_style_hover',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'icon_color_hover',
			array(
				'label'     => esc_html__( 'Icon Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .hop-header-info > li:hover i'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-header-info > li:hover svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		// end hover tab

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 2,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-header-info > li i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hop-header-info > li svg' => 'max-width: {{SIZE}}{{UNIT}}; height: auto',
				),
			)
		);
		$this->add_responsive_control(
			'icon_spacing',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'body:not(.rtl) {{WRAPPER}} .hop-header-info > li i,body:not(.rtl) {{WRAPPER}} .hop-header-info > li svg' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .hop-header-info > li i,body.rtl {{WRAPPER}} .hop-header-info > li svg'             => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
		$this->register_section_style_focused_text();
	}

	protected function register_section_style_focused_text() {
		$this->start_controls_section(
			'focused_style',
			[
				'label' => esc_html__( 'Focused text', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'focused_color',
			[
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-header-info > li .focused-text' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'focused_typography',
				'selector' => '{{WRAPPER}} .hop-header-info > li .focused-text',
			]
		);
		$this->add_responsive_control(
			'focused_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-header-info > li .focused-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="header-info-swapper">
			<ul class="hop-header-info">
				<?php
				if ( $settings['group'] ) {
					foreach ( $settings['group'] as $key => $item ) {
						if ( ! empty( $item['link']['url'] ) ) {
							$this->add_link_attributes( 'button-' . esc_attr( $key ), $item['link'] );
						}
						?>
						<li>
							<?php
							if ( ! empty( $item['link']['url'] ) ) : ?>
							<a <?php
							$this->print_render_attribute_string( 'button-' . esc_attr( $key ) ); ?>>
								<?php
								endif; ?>
								<?php
								if ( ! empty( $item['icons']['value'] ) ) : ?>
									<span>
									<?php
									Icons_Manager::render_icon( $item['icons'], array( 'aria-hidden' => 'true' ) ); ?>
								</span>
								<?php
								endif; ?>

								<?php
								echo str_replace( array( '{{', '}}' ),
									array( '<span class="focused-text">', '</span>' ), $item['text'] ); ?>

								<?php
								if ( ! empty( $item['link']['url'] ) ) : ?>
							</a>
						<?php
						endif; ?>
						</li>
						<?php
					}
				}
				?>
			</ul>
		</div>
		<?php
	}
}
