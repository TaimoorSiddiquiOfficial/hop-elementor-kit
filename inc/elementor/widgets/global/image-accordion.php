<?php

namespace Elementor;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Repeater;


class Hop_Ekit_Widget_Image_Accordion extends Widget_Base {
	public function get_name() {
		return 'hop-ekits-image-accordion';
	}

	public function get_title() {
		return esc_html__( 'Image Accordion', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-image-rollover';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	public function get_keywords() {
		return [
			'hop',
			'image accordion',
			'accordion',
			'image',
		];
	}

	protected function register_controls() {
		/**
		 * Image accordion Content Settings
		 */
		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'content_horizontal_align',
			[
				'label'     => __( 'Horizontal Alignment', 'hop-elementor-kit' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .hop-ekits-image-accordion__item .overlay' => 'justify-content: {{VALUE}}; text-align: {{VALUE}}',
				),
			]
		);

		$this->add_control(
			'content_vertical_align',
			[
				'label'     => __( 'Vertical Alignment', 'hop-elementor-kit' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => array(
						'title' => esc_html__( 'Top', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center'     => [
						'title' => __( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-middle',
					],

					'flex-end' => array(
						'title' => esc_html__( 'Bottom', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-bottom',
					),

				],
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekits-image-accordion__item .overlay' => 'align-items: {{VALUE}};',
				),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => __( 'Select Title Tag', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1'   => __( 'H1', 'hop-elementor-kit' ),
					'h2'   => __( 'H2', 'hop-elementor-kit' ),
					'h3'   => __( 'H3', 'hop-elementor-kit' ),
					'h4'   => __( 'H4', 'hop-elementor-kit' ),
					'h5'   => __( 'H5', 'hop-elementor-kit' ),
					'h6'   => __( 'H6', 'hop-elementor-kit' ),
					'span' => __( 'Span', 'hop-elementor-kit' ),
					'p'    => __( 'P', 'hop-elementor-kit' ),
					'div'  => __( 'Div', 'hop-elementor-kit' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'is_active',
			[
				'label'        => __( 'Make it active?', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'hop-elementor-kit' ),
				'label_off'    => __( 'No', 'hop-elementor-kit' ),
				'return_value' => 'yes',
			]
		);

		$repeater->add_control(
			'background_img',
			[
				'label'       => esc_html__( 'Background Image', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::MEDIA,
				'label_block' => true,
				'default'     => [
					'url' => Utils::get_placeholder_image_src(),
					'id'  => - 1
				],
			]
		);

		$repeater->add_control(
			'tittle',
			[
				'label'       => esc_html__( 'Title', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Accordion item title', 'hop-elementor-kit' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'desc',
			[
				'label'       => esc_html__( 'Content', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => esc_html__( 'Accordion content goes here!', 'hop-elementor-kit' ),
			]
		);

		$repeater->add_control(
			'show_link',
			[
				'label'   => esc_html__( 'Enable Link', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''          => __( 'None', 'hop-elementor-kit' ),
					'box'       => __( 'Content', 'hop-elementor-kit' ),
					'read_more' => __( 'Button Read More', 'hop-elementor-kit' ),
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'         => esc_html__( 'Link', 'hop-elementor-kit' ),
				'type'          => Controls_Manager::URL,
				'dynamic'       => [ 'active' => true ],
				'label_block'   => true,
				'default'       => [
					'url'         => '#',
					'is_external' => '',
				],
				'show_external' => true,
				'condition'     => [
					'show_link!' => '',
				],
			]
		);
		$repeater->add_control(
			'label_link',
			[
				'label'       => esc_html__( 'Button Label', 'elementskit-lite' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__( 'Read More', 'elementskit-lite' ),
				'condition'   => [
					'show_link' => 'read_more',
				],
			]
		);
		$this->add_control(
			'img_accordions',
			[
				'type'        => Controls_Manager::REPEATER,
				'seperator'   => 'before',
				'default'     => [
					[
						'tittle'         => esc_html__( 'Image Accordion #1', 'hop-elementor-kit' ),
						'desc'           => esc_html__( 'Image Accordion content goes here!', 'hop-elementor-kit' ),
						'background_img' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'tittle'         => esc_html__( 'Image Accordion #2', 'hop-elementor-kit' ),
						'desc'           => esc_html__( 'Image Accordion content goes here!', 'hop-elementor-kit' ),
						'background_img' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'tittle'         => esc_html__( 'Image Accordion #3', 'hop-elementor-kit' ),
						'desc'           => esc_html__( 'Image Accordion content goes here!', 'hop-elementor-kit' ),
						'background_img' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'tittle'         => esc_html__( 'Image Accordion #4', 'hop-elementor-kit' ),
						'desc'           => esc_html__( 'Image Accordion content goes here!', 'hop-elementor-kit' ),
						'background_img' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
				],
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{tittle}}',
			]
		);

		$this->end_controls_section();

		$this->register_controls_thumbnail_style();

		$this->register_controls_content_style();
		$this->register_controls_read_more();
	}

	protected function register_controls_thumbnail_style() {
		$this->start_controls_section(
			'thumbnail_settings',
			[
				'label' => esc_html__( 'Thumbnail', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'accordion_height',
			[
				'label'     => esc_html__( 'Height (Unit: px)', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '350',
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion' => 'min-height: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'thumbnail_margin',
			[
				'label'      => __( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'thumbnail_radius',
			[
				'label'      => __( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				],
			]
		);
		$this->add_control(
			'img_overlay_color',
			[
				'label'     => esc_html__( 'Overlay Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, .3)',
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'img_hover_color',
			[
				'label'     => esc_html__( 'Hover Overlay Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, .5)',
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item:hover::before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'thumbnail_border',
				'label'    => __( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekits-image-accordion__item',
			]
		);


		$this->end_controls_section();
	}

	protected function register_controls_content_style() {
		$this->start_controls_section(
			'typography_settings',
			[
				'label' => esc_html__( 'Content', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'thumbnail_padding',
			[
				'label'      => __( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_text',
			[
				'label'     => esc_html__( 'Title', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label'      => esc_html__( 'Margin Bottom', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .hop-ekits-image-accordion__item .title',
			]
		);

		$this->add_control(
			'content_text',
			[
				'label'     => esc_html__( 'Content', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .hop-ekits-image-accordion__item .desc',
			]
		);
		$this->add_responsive_control(
			'content_space',
			[
				'label'      => esc_html__( 'Margin Bottom', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function register_controls_read_more() {
		$this->start_controls_section(
			'read_more_style',
			[
				'label' => esc_html__( 'Read More', 'eduma' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'more_padding',
			[
				'label'      => esc_html__( 'Padding', 'eduma' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .button-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'more_typography',
				'label'    => esc_html__( 'Typography', 'eduma' ),
				'selector' => '{{WRAPPER}} .hop-ekits-image-accordion__item .button-read-more',
			]
		);

		$this->add_responsive_control(
			'btn_border_style',
			[
				'label'     => esc_html_x( 'Border Type', 'Border Control', 'eduma' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'none'   => esc_html__( 'None', 'eduma' ),
					'solid'  => esc_html_x( 'Solid', 'Border Control', 'eduma' ),
					'double' => esc_html_x( 'Double', 'Border Control', 'eduma' ),
					'dotted' => esc_html_x( 'Dotted', 'Border Control', 'eduma' ),
					'dashed' => esc_html_x( 'Dashed', 'Border Control', 'eduma' ),
					'groove' => esc_html_x( 'Groove', 'Border Control', 'eduma' ),
				],
				'default'   => 'none',
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .button-read-more' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_dimensions',
			[
				'label'     => esc_html_x( 'Width', 'Border Control', 'eduma' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'condition' => [
					'btn_border_style!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .button-read-more' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_btn_style' );
		$this->start_controls_tab(
			'tab_btn_normal',
			[
				'label' => esc_html__( 'Normal', 'eduma' ),
			]
		);
		$this->add_control(
			'btn_text_color',
			[
				'label'     => __( 'Text Color', 'eduma' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .button-read-more' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_border_color',
			[
				'label'     => __( 'Border Color', 'eduma' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'btn_border_style!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .button-read-more' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg_color',
			[
				'label'     => __( 'Background Color', 'eduma' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .button-read-more' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'eduma' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				],
				'selectors'  => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .button-read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			[
				'label' => esc_html__( 'Hover', 'eduma' ),
			]
		);
		$this->add_control(
			'btn_text_color_hover',
			[
				'label'     => __( 'Text Color', 'eduma' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .button-read-more:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_border_color_hover',
			[
				'label'     => __( 'Border Color', 'eduma' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'btn_border_style!' => 'none'
				],
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .button-read-more:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'eduma' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-image-accordion__item .button-read-more:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['img_accordions'] ) ) {
			return;
		}
		?>
		<div class="hop-ekits-image-accordion">
		<?php
		foreach ( $settings['img_accordions'] as $key => $img_accordion ) : ?>
			<?php
			$this->add_render_attribute(
				'image-accordion-item-' . $key,
				[
					'class' => 'hop-ekits-image-accordion__item',
					'style' => "background-image: url(" . esc_url( $img_accordion['background_img']['url'] ) . ")",
				]
			);
			if ( $img_accordion['is_active'] === 'yes' ) {
				$this->add_render_attribute( 'image-accordion-item-' . $key, 'class', 'overlay-active' );
			}
			?>
			<div <?php $this->print_render_attribute_string( 'image-accordion-item-' . $key ) ?>>
				<div class="overlay">
					<div class="overlay-inner">
					<?php

					if ( $img_accordion['tittle'] ) {
						$title_tag = Utils::validate_html_tag($settings['title_tag']);
						echo sprintf('<%s class="title">%s</%s>', $title_tag, wp_kses_post($img_accordion['tittle']), $title_tag);
					}
					if ( $img_accordion['desc'] ) {
						printf( '<div class="desc">%1$s</div>', $img_accordion['desc'] );
					}

					if ( $img_accordion['show_link'] != '' ) {
						$label_link = '';
						if ( ! empty( $img_accordion['link']['url'] ) ) {
							$this->add_link_attributes( 'link-' . $key, $img_accordion['link'] );
						}

						if ( $img_accordion['show_link'] == 'read_more' ) {
							$this->add_render_attribute( 'link-' . $key, 'class', 'button-read-more' );
							$label_link = $img_accordion['label_link'];
						} else {
							$this->add_render_attribute( 'link-' . $key, 'class', 'read-more' );
						}
						?>
						<a <?php Utils::print_unescaped_internal_string( $this->get_render_attribute_string( 'link-' . esc_attr( $key ) ) ); ?>>
							<?php echo esc_attr( $label_link ); ?>
						</a>
					<?php } ?>
				</div>

			</div>
			</div>
		<?php endforeach; ?>
		</div>
		<?php
	}
}
