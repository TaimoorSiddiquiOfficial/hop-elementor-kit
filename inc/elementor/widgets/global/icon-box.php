<?php

namespace Elementor;

// Exit if accessed directly
use Hop_EL_Kit\GroupControlTrait;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hop_Ekit_Widget_Icon_Box extends Hop_Ekit_Widget_Heading {
	use GroupControlTrait;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-icon-box';
	}

	public function get_title() {
		return esc_html__( 'Icon Box', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-icon-box';
	}

	public function get_keywords() {
		return [
			'hop',
			'icon',
			'info',
			'box',
		];
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	protected function register_controls() {
		$this->register_style_icons();
		parent::register_controls();
		$this->register_style_link();
	}

	protected function register_section_style_general() {
		$this->start_controls_section(
			'ekit_heading_section_general',
			array(
				'label' => esc_html__( 'Content Alignment', 'hop-elementor-kit' ),
				//				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'vertical_align',
			array(
				'label'     => esc_html__( 'Vertical Align', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Top', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center'     => array(
						'title' => esc_html__( 'Middle', 'hop-elementor-kit' ),
						'icon'  => ' eicon-v-align-middle',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Bottom', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'   => 'flex-start',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .ekits-iconbox' => 'align-items: {{VALUE}}; display: flex;',
				),
				'condition' => [
					'pos!' => 'top',
				],
			)
		);
		$this->add_responsive_control(
			'horizon_align',
			array(
				'label'     => esc_html__( 'Horizontal Align', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Start', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => ' eicon-h-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'End', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'   => 'flex-start',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .content-inner, {{WRAPPER}} .iconbox-top' => 'align-items: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_align',
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
					'{{WRAPPER}} .content-inner' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_icons() {
		$this->start_controls_section(
			'icon_group',
			[
				'label' => __( 'Icon', 'hop-elementor-kit' ),
			]
		);

		$this->add_responsive_control(
			'iconbox_img_icon',
			[
				'label'       => esc_html__( 'Select Icon type', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options'     => [
					'none'   => [
						'title' => esc_html__( 'None', 'hop-elementor-kit' ),
						'icon'  => 'fa fa-ban',
					],
					'number' => [
						'title' => esc_html__( 'Number', 'hop-elementor-kit' ),
						'icon'  => 'eicon-number-field',
					],
					'icon'   => [
						'title' => esc_html__( 'Icon', 'hop-elementor-kit' ),
						'icon'  => 'fa fa-info-circle',
					],
					'img'    => [
						'title' => esc_html__( 'Image', 'hop-elementor-kit' ),
						'icon'  => 'eicon-image-bold',
					],
				],
				'default'     => 'icon',
			]
		);

		$this->add_control(
			'iconbox_image',
			[
				'label'     => esc_html__( 'Image', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'iconbox_img_icon' => 'img',
				],
			]
		);

		$this->add_control(
			'icons',
			[
				'label'     => esc_html__( 'Select Icon:', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => [
					'iconbox_img_icon' => 'icon',
				],
			]
		);

		$this->add_control(
			'iconbox_number',
			[
				'label'     => esc_html__( 'Number', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'iconbox_img_icon' => 'number',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => __( 'Icon Size (px)', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 14,
				'min'       => 0,
				'step'      => 1,
				'condition' => [
					'iconbox_img_icon' => [ 'icon', 'number' ],
				],
				'selectors' => [
					'{{WRAPPER}} .ekits-iconbox .boxes-icon' => '--iconbox-icon-size: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'pos',
			[
				'label'     => esc_html__( 'Position Icon', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'  => [
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-left',
					],
					'top'   => [
						'title' => esc_html__( 'Top', 'hop-elementor-kit' ),
						'icon'  => ' eicon-v-align-top',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => ' eicon-h-align-right',
					]
				],
				'default'   => 'top',
				'condition' => [
					'iconbox_img_icon!' => 'none',
				],
			]
		);

		$this->add_control(
			'draw_icon',
			[
				'label'       => esc_html__( 'SVG Draw', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'hop-elementor-kit' ),
				'label_off'   => esc_html__( 'No', 'hop-elementor-kit' ),
				'default'     => 'no',
				'description' => esc_html__( 'Working when icon is SVG', 'hop-elementor-kit' ),
				'condition'   => [
					'iconbox_img_icon' => 'icon',
				],
			]
		);

		$this->end_controls_section();
		// Style for draw svg
		$this->register_style_draw_icon(
			[
				'iconbox_img_icon' => 'icon',
				'draw_icon'        => 'yes'
			]
		);

		$this->start_controls_section(
			'icon_setting',
			[
				'label'     => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'iconbox_img_icon!' => 'none',
				],
			]
		);

		$this->add_responsive_control(
			'width_icon_box',
			[
				'label'      => esc_html__( 'Box Icon Width', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .ekits-iconbox' => '--width-icon-box: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'height_icon_box',
			[
				'label'      => esc_html__( 'Icon Box Height', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .ekits-iconbox' => '--height-icon-box: {{SIZE}}{{UNIT}}; '
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin_btn',
			[
				'label'     => esc_html__( 'Margin Bottom (px)', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .ekits-iconbox .boxes-icon' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_style',
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
					'{{WRAPPER}} .ekits-iconbox .boxes-icon' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_dimensions',
			[
				'label'     => esc_html_x( 'Width', 'Border Control', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'condition' => [
					'icon_border_style!' => 'none'
				],
				'selectors' => [
					'{{WRAPPER}} .ekits-iconbox .boxes-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--hop-icon-box-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label'     => esc_html__( 'Border Color:', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ekits-iconbox .boxes-icon' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'icon_border_style!' => 'none'
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ekits-iconbox .boxes-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_icon_radius',
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
					'{{WRAPPER}} .ekits-iconbox .boxes-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'icon_hover_color',
			[
				'label'     => esc_html__( 'Icon Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--hop-icon-box-color-hover: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_border_color_hover',
			[
				'label'     => esc_html__( 'Border Color:', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ekits-iconbox .boxes-icon:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'icon_border_style!' => 'none'
				],
			]
		);

		$this->add_control(
			'icon_bg_color_hover',
			[
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ekits-iconbox .boxes-icon:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'border_icon_radius_h',
			[
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ekits-iconbox .boxes-icon:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}


	protected function register_style_link() {
		$this->start_controls_section(
			'read_more_group',
			[
				'label' => __( 'Link', 'hop-elementor-kit' ),
			]
		);
		$this->add_control(
			'enable_link',
			[
				'label'   => __( 'Enable Link', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'link',
			[
				'label'         => __( 'URL', 'hop-elementor-kit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'hop-elementor-kit' ),
				'show_external' => true,
				'default'       => [
					'url' => '',
				],
				'condition'     => [
					'enable_link' => 'yes',
				]
			]
		);
		$this->add_control(
			'link_opt',
			[
				'label'     => esc_html__( 'Url For', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'title'      => __( 'Title', 'hop-elementor-kit' ),
					'title_icon' => __( 'Title and Icon', 'hop-elementor-kit' ),
					'read_more'  => __( 'Show Read More', 'hop-elementor-kit' ),
				],
				'default'   => 'title',
				'condition' => [
					'enable_link' => 'yes',
				]
			]
		);

		$this->add_control(
			'read_text',
			[
				'label'       => __( 'Read More Text', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your text here', 'hop-elementor-kit' ),
				'default'     => esc_html__( 'Read More', 'hop-elementor-kit' ),
				'label_block' => true,
				'condition'   => [
					'link_opt' => 'read_more',
				]
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'read_more_style',
			[
				'label'     => esc_html__( 'Read More', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'link_opt' => 'read_more',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'read_more_typography',
				'selector' => '{{WRAPPER}} .iconbox-read a',
			)
		);
		$this->add_responsive_control(
			'read_more_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .iconbox-read a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'read_more_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .iconbox-read' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'read_more_border',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .iconbox-read a',
				'exclude'  => array( 'color' ),
			)
		);
		$this->start_controls_tabs(
			'read_more_color_tabs'
		);
		$this->start_controls_tab(
			'read_more_color_tab',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'read_more_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .iconbox-read a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'read_more_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_border_border!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .iconbox-read a' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'read_more_color_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'read_more_color_hover',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .iconbox-read a:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'read_more_border_color_hover',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_border_border!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .iconbox-read a:hover' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render_icon( $settings ) {
		$html = $html_icon = '';
		if ( $settings['iconbox_img_icon'] == 'none' ) {
			return;
		}
		// get img
		if ( $settings['iconbox_img_icon'] == 'img' ) {
			$html_icon = Group_Control_Image_Size::get_attachment_image_html( $settings, 'iconbox_image' );
		}
		// get Icon
		if ( $settings['iconbox_img_icon'] == 'icon' ) {
			ob_start();
			Icons_Manager::render_icon( $settings['icons'], [ 'aria-hidden' => 'true' ] );
			$html_icon = ob_get_contents();
			ob_end_clean();
		}
		// get number
		if ( $settings['iconbox_img_icon'] == 'number' ) {
			$html_icon = $settings['iconbox_number'] ? '<span class="number">' . $settings['iconbox_number'] . '</span>' : '';
		}
		if ( $settings['link_opt'] == 'title_icon' && $this->render_link() ) {
			$html .= $this->render_link();
			$html .= $html_icon;
			$html .= '</a>';
		} else {
			$html = $html_icon;
		}
		if ( isset( $settings['draw_icon'] ) && $settings['draw_icon'] == 'yes' ) {
			$svg_options = [
				'fill'      => $settings['svg_fill'] === 'after' ? 'fill-svg' : '',
				'loop'      => $settings['svg_loop'] ? esc_attr( $settings['svg_loop'] ) : 'no',
				'offset'    => esc_attr( $settings['svg_draw_offset'] ),
				'direction' => esc_attr( $settings['svg_direction'] ),
				'speed'     => esc_attr( $settings['svg_draw_speed'] ),
			];
			$this->add_render_attribute( 'boxes-icon', [
					'class'         => [
						'boxes-icon icon-svg-draw',
						esc_attr( $settings['svg_animation_on'] ),
						$settings['svg_fill'] === 'before' ? 'fill-svg' : ''
					],
					'data-settings' => wp_json_encode( $svg_options )
				]
			);
		} else {
			$this->add_render_attribute( 'boxes-icon', [
					'class' => [ 'boxes-icon' ],
				]
			);
		}

		return $html ? '<div ' . $this->get_render_attribute_string( 'boxes-icon' ) . '>' . $html . '</div>' : '';
	}

	protected function render_link() {
		$settings = $this->get_settings_for_display();
		if ( $settings['enable_link'] == 'no' ) {
			return;
		}
		if ( isset( $settings['link'] ) && ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link-widget', $settings['link'], true );
		}

		return $this->get_render_attribute_string( 'link-widget' ) ? '<a ' .
		                                                             $this->get_render_attribute_string( 'link-widget' ) . '>' : '';
	}

	protected function render() {
		$settings        = $this->get_settings_for_display();
		$open_link_title = $close_link_title = '';
		// link for title
		if ( $settings['link_opt'] != 'read_more' && $this->render_link() ) {
			$open_link_title  = $this->render_link();
			$close_link_title = '</a>';
		}
		echo '<div class="ekits-iconbox iconbox-' . $settings['pos'] . '">';

		echo $this->render_icon( $settings );

		echo '<div class="content-inner hop-ekits-heading">';

		parent::render_title( $settings, $open_link_title, $close_link_title );
		// show button read more
		if ( $settings['link_opt'] == 'read_more' && $this->render_link() && $settings['read_text'] ) {
			echo '<div class="iconbox-read">' . $this->render_link() . wp_kses_post( $settings['read_text'] ) . '</a></div>';
		}
		echo '</div>';
		echo '</div>';
	}
}
