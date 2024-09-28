<?php

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hop_Ekit_Widget_Video extends Widget_Base {

	public function get_name() {
		return 'hop-video';
	}

	public function get_title() {
		return esc_html__( 'Video Popup', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-youtube';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'video',
			'video popup',
			'popup',
			'hop',
		];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content',
			[
				'label' => esc_html__( 'Video', 'hop-elementor-kit' )
			]
		);
		$this->add_control(
			'text_video', [
				'label'       => esc_html__( 'Video Label', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Video', 'hop-elementor-kit' ),
				'placeholder' => esc_html__( 'video', 'hop-elementor-kit' ),
				'separator'   => 'before'
			]
		);
		$this->add_control(
			'video_icons',
			[
				'label'       => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'far fa-play',
					'library' => 'Font Awesome 5 Free',
				],
			]
		);
		$this->add_control(
			'video_width',
			[
				'label'       => esc_html__( 'Video Width', 'hop-elementor-kit' ),
				'description' => esc_html__( 'Enter the width of a video. For example, 100% or 60px.',
					'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'video_height',
			[
				'label'       => esc_html__( 'Video Height', 'hop-elementor-kit' ),
				'description' => esc_html__( 'Enter the height of a video. For example, 100% or 60px.',
					'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'video_type',
			[
				'label'   => esc_html__( 'Video Source', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'vimeo'   => esc_html__( 'Vimeo', 'hop-elementor-kit' ),
					'youtube' => esc_html__( 'Youtube', 'hop-elementor-kit' ),
				],
				'default' => 'vimeo'
			]
		);


		$this->add_control(
			'external_video',
			[
				'label'       => esc_html__( 'Vimeo Video ID', 'hop-elementor-kit' ),
				'description' => esc_html__( 'Enter the Vimeo video ID. For example, if the link video is https://player.vimeo.com/video/61389324 then the video ID is 61389324',
					'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'condition'   => [
					'video_type' => [ 'vimeo' ]
				]
			]
		);


		$this->add_control(
			'youtube_id',
			[
				'label'       => esc_html__( 'Youtube Video ID', 'hop-elementor-kit' ),
				'description' => esc_html__( 'Enter Youtube video ID . Example if link video https://www.youtube.com/watch?v=orl1nVy4I6s then video ID is orl1nVy4I6s ',
					'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'condition'   => [
					'video_type' => [ 'youtube' ]
				]
			]
		);

		$this->end_controls_section();
		$this->_register_style();
	}

	protected function _register_style() {
		$this->start_controls_section(
			'video_popup_style',
			array(
				'label' => esc_html__( 'Style', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_button_video' );
		$this->start_controls_tab(
			'tab_button_video_normal',
			[
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			]
		);
		$this->add_control(
			'heading_settings_style',
			array(
				'label' => esc_html__( 'Settings', 'hop-elementor-kit' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_responsive_control(
			'button_video_paddding',
			[
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-video-popup .modalbutton ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'video_popup_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-video-popup .modalbutton' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'video_popup_border',
				'selector' => '{{WRAPPER}} .hop-video-popup .modalbutton',
			)
		);
		$this->add_control(
			'video_popup_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-video-popup .modalbutton ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'heading_icon_style',
			array(
				'label' => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			'video_icon_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-video-popup .modalbutton i'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-video-popup .modalbutton svg path' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'video_popup_icon_size',
			array(
				'label'      => esc_html__( 'Size', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 40,
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-video-popup .modalbutton i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hop-video-popup .modalbutton svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'video_popup_icon_space',
			array(
				'label'      => esc_html__( 'Space', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 40,
				),
				'selectors'  => array(
					'body:not(.rtl) {{WRAPPER}} .hop-video-popup .modalbutton i, body:not(.rtl) {{WRAPPER}} .hop-video-popup .modalbutton svg' => 'margin-left: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .hop-video-popup .modalbutton i,body.rtl {{WRAPPER}} .hop-video-popup .modalbutton svg'              => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'heading_label_style',
			array(
				'label' => esc_html__( 'Label', 'hop-elementor-kit' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			'video_label_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-video-popup .modalbutton' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'video_label_Typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-video-popup .modalbutton',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_video_hover',
			[
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'video_popup_icon_color_hover',
			array(
				'label'     => esc_html__( 'Icon Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-video-popup .modalbutton i:hover'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-video-popup .modalbutton svg path:hover' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'video_popup_label_color_hover',
			array(
				'label'     => esc_html__( 'Label Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-video-popup .modalbutton:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'video_popup_bg_color_hover',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-video-popup .modalbutton:hover' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'video_popup_border_color_hover',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-video-popup .modalbutton:hover' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$width = $height = '100%';
		if ( isset( $settings['video_width'] ) && '' != $settings['video_width'] ) {
			$width = $settings['video_width'];
		}
		if ( isset( $settings['video_height'] ) && '' != $settings['video_height'] ) {
			$height = $settings['video_height'];
		}

		$popup_id = 'popup-id-' . esc_attr($this->get_id());
		?>
		<div class="hop-video-popup">
			<div class="video-info">
				<?php
				if ( ( isset( $settings['text_video'] ) && $settings['text_video'] ) || ( ! empty( $settings['video_icons']['library'] ) ) ) {
					echo '<a class="modalbutton" href="#' . esc_attr( $popup_id ) . '">';
					echo esc_html( $settings['text_video'] );
					Icons_Manager::render_icon( $settings['video_icons'], [ 'aria-hidden' => 'true' ] );
					echo '</a>';
				}
				?>
			</div>
			<div class="ekits-modal" id="<?php
			echo esc_attr( $popup_id ); ?>">
				<div class="ekits-modal__overlay ModalOverlay"></div>
				<div class="ekits-modal__container">
					<button class="ekits-modal__close ModalClose">&#10005;</button>
					<?php
					if ( isset( $settings['video_type'] ) && $settings['video_type'] == 'youtube' ) {
						echo '<div class="video"><iframe id="hop-video" width="' . $width . '" height="' . $height . '" src="https://www.youtube.com/embed/' . esc_attr( $settings['youtube_id'] ) . '" allowfullscreen style="border: 0;"></iframe></div>';
					} else {
						echo '<div class="video"><iframe id="hop-video" width="' . $width . '" height="' . $height . '" src="https://player.vimeo.com/video/' . esc_attr( $settings['external_video'] ) . '?portrait=0&title=0&byline=0&badge=0" webkitallowfullscreen mozallowfullscreen allowfullscreen style="border: 0px;"></iframe></div>';
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}
}
