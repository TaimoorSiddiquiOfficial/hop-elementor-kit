<?php

namespace Hop_EL_Kit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

trait GroupControlTrait {

	public function render_load_more_pagination(
		$settings,
		$load_more_type,
		$paged = 1,
		$page_limit = 1,
		$next_page = ''
	) {
		?>
		<div class="hop-ekits-archive__loadmore-data" data-page="<?php
		echo absint( $paged ); ?>"
			 data-max-page="<?php
			 echo absint( $page_limit ); ?>"
			 data-next-page="<?php
			 echo esc_url( $this->get_wp_link_page( $next_page ) ); ?>"
			 data-infinity-scroll="<?php
			 echo absint( $settings['pagination_type'] === 'load_more_infinite_scroll' ); ?>"></div>
		<div class="hop-ekits-archive__loadmore-button">
			<?php
			if ( 'load_more_on_click' === $load_more_type ) : ?>
				<a class="hop-ekits-archive__loadmore-btn" href="#">
					<?php
					if ( ! empty( $settings['load_more_selected_icon']['value'] ) && $settings['load_more_icon_align'] === 'left' ) : ?>
						<span class="hop-ekits-archive__loadmore-icon">
								<?php
								Icons_Manager::render_icon( $settings['load_more_selected_icon'],
									array( 'aria-hidden' => 'true' ) ); ?>
							</span>
					<?php
					endif; ?>

					<?php
					echo esc_html( $settings['load_more_button_text'] ); ?>

					<?php
					if ( ! empty( $settings['load_more_selected_icon']['value'] ) && $settings['load_more_icon_align'] === 'right' ) : ?>
						<span class="hop-ekits-archive__loadmore-icon">
								<?php
								Icons_Manager::render_icon( $settings['load_more_selected_icon'],
									array( 'aria-hidden' => 'true' ) ); ?>
							</span>
					<?php
					endif; ?>
				</a>
			<?php
			endif; ?>

			<?php
			if ( ! empty( $settings['load_more_spinner']['value'] ) ) : ?>
				<div class="hop-ekits-archive__loadmore-spinner hide">
					<?php
					Icons_Manager::render_icon( $settings['load_more_spinner'], array( 'aria-hidden' => 'true' ) ); ?>
				</div>
			<?php
			endif; ?>
		</div>
		<?php
	}

	// Slider
	public function render_nav_pagination_slider( $settings ) {
		$hiden_nav_mobile = '';
		if ( $settings['slider_show_pagination'] != 'none' ) :
			$hiden_nav_mobile = ' hidden-nav-mobile';
			?>
			<div
				class="hop-slider-pagination <?php
				echo 'hop-' . esc_attr( $settings['slider_show_pagination'] ); ?>"></div>
		<?php
		endif; ?>

		<?php
		if ( $settings['slider_show_arrow'] ) : ?>
			<div class="hop-slider-nav hop-slider-nav-prev<?php
			echo esc_attr( $hiden_nav_mobile ); ?>">
				<?php
				Icons_Manager::render_icon( $settings['slider_arrows_left'], array( 'aria-hidden' => 'true' ) ); ?>
			</div>

			<div class="hop-slider-nav hop-slider-nav-next<?php
			echo esc_attr( $hiden_nav_mobile ); ?>">
				<?php
				Icons_Manager::render_icon( $settings['slider_arrows_right'], array( 'aria-hidden' => 'true' ) ); ?>
			</div>
		<?php
		endif;
	}

	public function _register_settings_slider( $condition = null, $frontend_available = true ) {
		// setting slider section
		$section_args = [
			'label' => esc_html__( 'Settings Slider', 'hop-elementor-kit' )
		];

		if ( is_array( $condition ) ) {
			$section_args['condition'] = $condition;
		}

		$this->start_controls_section(
			'skin_slider_settings', $section_args
		);

		$this->add_responsive_control(
			'slidesPerView',
			array(
				'label'              => esc_html__( 'Item Show', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 20,
				'step'               => 1,
				'default'            => 3,
				'frontend_available' => $frontend_available,
				'devices'            => array( 'widescreen', 'desktop', 'tablet', 'mobile' ),
				'mobile_default'     => '2',
				'selectors'          => array(
					'{{WRAPPER}}' => '--hop-ekits-slider-show: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'slidesPerGroup',
			array(
				'label'              => esc_html__( 'Item Scroll', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 20,
				'step'               => 1,
				'default'            => 3,
				'frontend_available' => $frontend_available,
				'devices'            => array( 'widescreen', 'desktop', 'tablet', 'mobile' ),
			)
		);
		$this->add_responsive_control(
			'spaceBetween',
			array(
				'label'              => esc_html__( 'Item Space', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 0,
				'max'                => 100,
				'step'               => 1,
				'default'            => 30,
				'frontend_available' => $frontend_available,
				'devices'            => array( 'widescreen', 'desktop', 'tablet', 'mobile' ),
				'mobile_default'     => '15',
				'selectors'          => array(
					'{{WRAPPER}}' => '--hop-ekits-slider-space: {{VALUE}}px',
				),
			)
		);
		$this->add_control(
			'slider_speed',
			array(
				'label'              => esc_html__( 'Animation Speed', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 100000,
				'step'               => 1,
				'default'            => 1000,
				'frontend_available' => $frontend_available,
			)
		);

		$this->add_control(
			'slider_autoplay',
			array(
				'label'              => esc_html__( 'Autoplay', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'hop-elementor-kit' ),
				'label_off'          => esc_html__( 'No', 'hop-elementor-kit' ),
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => $frontend_available,
			)
		);

		$this->add_control(
			'autoplay_speed',
			array(
				'label'              => esc_html__( 'Auto Speed', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 10000,
				'step'               => 1,
				'default'            => 1000,
				'frontend_available' => $frontend_available,
				'condition'          => array(
					'slider_autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'pause_on_interaction',
			array(
				'label'              => esc_html__( 'Pause on Interaction', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'hop-elementor-kit' ),
				'label_off'          => esc_html__( 'No', 'hop-elementor-kit' ),
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => $frontend_available,
				'condition'          => array(
					'slider_autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'pause_on_hover',
			array(
				'label'              => esc_html__( 'Pause on Hover', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => 'yes',
				'label_on'           => esc_html__( 'Yes', 'hop-elementor-kit' ),
				'label_off'          => esc_html__( 'No', 'hop-elementor-kit' ),
				'return_value'       => 'yes',
				'frontend_available' => $frontend_available,
				'condition'          => array(
					'slider_autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'slider_show_arrow',
			array(
				'label'              => esc_html__( 'Show Arrow', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'hop-elementor-kit' ),
				'label_off'          => esc_html__( 'No', 'hop-elementor-kit' ),
				'return_value'       => 'yes',
				'default'            => '',
				'frontend_available' => $frontend_available,
			)
		);

		$this->add_control(
			'slider_show_pagination',
			array(
				'label'              => esc_html__( 'Pagination Options', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'options'            => array(
					'none'        => esc_html__( 'Hide', 'hop-elementor-kit' ),
					'bullets'     => esc_html__( 'Bullets', 'hop-elementor-kit' ),
					'number'      => esc_html__( 'Number', 'hop-elementor-kit' ),
					'progressbar' => esc_html__( 'Progress', 'hop-elementor-kit' ),
					'scrollbar'   => esc_html__( 'Scrollbar', 'hop-elementor-kit' ),
					'fraction'    => esc_html__( 'Fraction', 'hop-elementor-kit' ),
				),
				'frontend_available' => $frontend_available,
			)
		);

		$this->add_control(
			'slider_loop',
			array(
				'label'              => esc_html__( 'Enable Loop?', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'hop-elementor-kit' ),
				'label_off'          => esc_html__( 'No', 'hop-elementor-kit' ),
				'return_value'       => 'yes',
				'default'            => '',
				'frontend_available' => $frontend_available,
			)
		);

		$this->end_controls_section();
	}

	public function _register_setting_slider_dot_style( $condition = null ) {
		// dot style
		$section_args = [
			'label'     => esc_html__( 'Pagination', 'hop-elementor-kit' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'slider_show_pagination!' => 'none' ]
		];

		if ( is_array( $condition ) ) {
			$section_args['condition'] = $condition;
		}

		$this->start_controls_section(
			'slider_dot_tab', $section_args
		);

		$this->add_control(
			'slider_pagination_offset_position_v',
			array(
				'label'       => esc_html__( 'Vertical Position', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'default'     => '100',
				'options'     => array(
					'0'   => array(
						'title' => esc_html__( 'Top', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-top',
					),
					'100' => array(
						'title' => esc_html__( 'Bottom', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .hop-slider-pagination' => 'top:{{VALUE}}%;',
				),
			)
		);
		$this->add_responsive_control(
			'slider_pagination_vertical_offset',
			array(
				'label'       => esc_html__( 'Vertical align', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => - 500,
				'max'         => 500,
				'step'        => 1,
				'selectors'   => array(
					'{{WRAPPER}} .hop-slider-pagination' => '-webkit-transform: translateY({{VALUE}}px); -ms-transform: translateY({{SIZE}}px); transform: translateY({{SIZE}}px);',
				),
			)
		);

		$this->add_responsive_control(
			'slider_dot_spacing',
			array(
				'label'      => esc_html__( 'Spacing', 'hop-elementor-kit' ),
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
					'size' => 12,
				),
				'condition'  => array(
					'slider_show_pagination' => array( 'bullets', 'number' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-slider-pagination' => '--hop-pagination-space: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'pagination_number_typography',
				'condition' => array(
					'slider_show_pagination' => 'number',
				),
				'selector'  => '{{WRAPPER}} .hop-number .swiper-pagination-bullet',
			)
		);

		$this->add_responsive_control(
			'pagination_number_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'condition'  => array(
					'slider_show_pagination' => 'number',
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-number .swiper-pagination-bullet' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),

			)
		);

		$this->add_responsive_control(
			'slider_dot_border_radius',
			array(
				'label'      => esc_html__( 'Border radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'condition'  => array(
					'slider_show_pagination' => array( 'bullets', 'number' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'slider_dot_active_border',
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
				'condition' => array(
					'slider_show_pagination' => array( 'bullets', 'number' ),
				),
				'default'   => 'none',
				'selectors' => array(
					'{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'slider_dot_active_border_dimensions',
			array(
				'label'     => esc_html_x( 'Width', 'Border Control', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'condition' => array(
					'slider_dot_active_border!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'dot_setting_tab',
			array(
				'condition' => array(
					'slider_show_pagination' => array( 'bullets', 'number', 'progressbar', 'scrollbar' ),
				),
			)
		);

		$this->start_controls_tab(
			'dot_slider_style',
			array(
				'label' => esc_html__( 'Default', 'hop-elementor-kit' ),
			)
		);

		$this->add_responsive_control(
			'slider_dot_width',
			array(
				'label'      => esc_html__( 'Width', 'hop-elementor-kit' ),
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
					'size' => 6,
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-bullets .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'slider_show_pagination' => 'bullets',
				),
			)
		);

		$this->add_responsive_control(
			'slider_dot_height',
			array(
				'label'      => esc_html__( 'Height', 'hop-elementor-kit' ),
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
					'size' => 6,
				),
				'condition'  => array(
					'slider_show_pagination' => array( 'bullets', 'progressbar', 'scrollbar' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-bullets .swiper-pagination-bullet'       => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hop-progressbar,{{WRAPPER}} .hop-scrollbar' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'slider_dot_background',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet'          => 'background-color: {{VALUE}}; opacity: 1;',
					'{{WRAPPER}} .swiper-pagination-progressbar,{{WRAPPER}} .hop-scrollbar' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'slider_pagination_number',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'slider_show_pagination' => 'number',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-number .swiper-pagination-bullet' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'slider_pagination_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'slider_dot_active_border!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'slider_dot_border_radius_box_shadow_normal',
				'label'     => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector'  => '{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet',
				'condition' => array(
					'slider_show_pagination' => array( 'bullets', 'number' ),
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'dot_slider_active_style',
			array(
				'label' => esc_html__( 'Active', 'hop-elementor-kit' ),
			)
		);

		$this->add_responsive_control(
			'slider_dot_active_width',
			array(
				'label'      => esc_html__( 'Width', 'hop-elementor-kit' ),
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
					'size' => 8,
				),
				'condition'  => array(
					'slider_show_pagination' => 'bullets',
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'slider_dot_active_height',
			array(
				'label'      => esc_html__( 'Height', 'hop-elementor-kit' ),
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
					'size' => 8,
				),
				'condition'  => array(
					'slider_show_pagination' => 'bullets',
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'slider_dot_active_bg',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet:hover,{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-progressbar .swiper-pagination-progressbar-fill,{{WRAPPER}} .hop-scrollbar .swiper-scrollbar-drag'                                 => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'slider_pagination_number_active',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'slider_show_pagination' => 'number',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-number .swiper-pagination-bullet:hover,{{WRAPPER}} .hop-number .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'slider_dot_active_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'slider_dot_active_border!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet:hover' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'slider_dot_border_radius_box_shadow_active',
				'label'     => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector'  => '{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,{{WRAPPER}} .hop-slider-pagination .swiper-pagination-bullet:hover',
				'condition' => array(
					'slider_show_pagination' => array( 'bullets', 'number' ),
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function _register_setting_slider_nav_style( $condition = null ) {
		$section_args = [
			'label'     => esc_html__( 'Nav', 'hop-elementor-kit' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'slider_show_arrow' => 'yes' ]
		];

		if ( is_array( $condition ) ) {
			$section_args['condition'] = $condition;
		}

		$this->start_controls_section(
			'slider_nav_style_tab', $section_args
		);

		$this->start_controls_tabs(
			'slider_nav_group_tabs'
		);

		$this->start_controls_tab(
			'slider_nav_prev_tab',
			array(
				'label' => esc_html__( 'Prev', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'slider_arrows_left',
			array(
				'label'       => esc_html__( 'Prev Arrow Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => array(
					'value'   => 'fas fa-arrow-left',
					'library' => 'Font Awesome 5 Free',
				),
			)
		);

		$this->add_control(
			'prev_offset_orientation_h',
			array(
				'label'       => esc_html__( 'Horizontal Orientation', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'default'     => 'left',
				'options'     => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'render_type' => 'ui',
			)
		);
		$this->add_responsive_control(
			'prev_indicator_offset_h',
			array(
				'label'       => esc_html__( 'Offset', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => - 500,
				'step'        => 1,
				'default'     => 10,
				'selectors'   => array(
					'{{WRAPPER}} .hop-slider-nav-prev' => '{{prev_offset_orientation_h.VALUE}}:{{VALUE}}px',
				),
			)
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'slider_nav_next_tab',
			array(
				'label' => esc_html__( 'Next', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'slider_arrows_right',
			array(
				'label'       => esc_html__( 'Next Arrow Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => array(
					'value'   => 'fas fa-arrow-right',
					'library' => 'Font Awesome 5 Free',
				),
			)
		);

		$this->add_control(
			'next_offset_orientation_h',
			array(
				'label'       => esc_html__( 'Horizontal Orientation', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'default'     => 'right',
				'options'     => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'render_type' => 'ui',
			)
		);

		$this->add_responsive_control(
			'next_indicator_offset_h',
			array(
				'label'       => esc_html__( 'Offset', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => - 500,
				'step'        => 1,
				'default'     => 10,
				'selectors'   => array(
					'{{WRAPPER}} .hop-slider-nav-next' => '{{next_offset_orientation_h.VALUE}}:{{VALUE}}px',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_control(
			'slider_nav_offset_position_v',
			array(
				'label'       => esc_html__( 'Vertical Position', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'default'     => '50',
				'options'     => array(
					'0'   => array(
						'title' => esc_html__( 'Top', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-top',
					),
					'50'  => array(
						'title' => esc_html__( 'Middle', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'100' => array(
						'title' => esc_html__( 'Bottom', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .hop-slider-nav' => 'top:{{VALUE}}%;',
				),
			)
		);
		$this->add_responsive_control(
			'slider_nav_vertical_offset',
			array(
				'label'       => esc_html__( 'Vertical align', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => - 500,
				'max'         => 500,
				'step'        => 1,
				'selectors'   => array(
					'{{WRAPPER}} .hop-slider-nav' => '-webkit-transform: translateY({{VALUE}}px); -ms-transform: translateY({{SIZE}}px); transform: translateY({{SIZE}}px);',
				),
			)
		);

		$this->add_responsive_control(
			'slider_nav_font_size',
			array(
				'label'      => esc_html__( 'Font Size', 'hop-elementor-kit' ),
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
					'size' => 36,
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-slider-nav'     => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hop-slider-nav svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'slider_nav_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-slider-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'slider_nav_width',
			array(
				'label'      => esc_html__( 'Width', 'hop-elementor-kit' ),
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
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-slider-nav' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'slider_nav_height',
			array(
				'label'      => esc_html__( 'Height', 'hop-elementor-kit' ),
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
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-slider-nav' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'slider_nav_hover_normal_tabs'
		);

		$this->start_controls_tab(
			'slider_nav_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_responsive_control(
			'slider_nav_color_normal',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .hop-slider-nav'          => 'color: {{VALUE}};fill: {{VALUE}}',
					'{{WRAPPER}} .hop-slider-nav svg path' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'slider_nav_bg_color_normal',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .hop-slider-nav' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'slider_nav_box_shadow_normal',
				'label'    => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-slider-nav',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'slider_nav_border_normal',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-slider-nav',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'slider_nav_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_responsive_control(
			'slider_nav_color_hover',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-slider-nav:hover'          => 'color: {{VALUE}};fill: {{VALUE}}',
					'{{WRAPPER}} .hop-slider-nav:hover svg path' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'slider_nav_bg_color_hover',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-slider-nav:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'slider_nav_box_shadow_hover',
				'label'    => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-slider-nav:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'slider_nav_border_hover',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-slider-nav:hover',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	// Register style Page Navigation
	public function register_navigation_archive() {
		$this->start_controls_section(
			'section_pagination',
			array(
				'label' => esc_html__( 'Pagination', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'pagination_type',
			array(
				'label'              => esc_html__( 'Pagination', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '',
				'options'            => array(
					''                          => esc_html__( 'None', 'hop-elementor-kit' ),
					'numbers'                   => esc_html__( 'Numbers', 'hop-elementor-kit' ),
					'prev_next'                 => esc_html__( 'Previous/Next', 'hop-elementor-kit' ),
					'numbers_and_prev_next'     => esc_html__( 'Numbers',
							'hop-elementor-kit' ) . ' + ' . esc_html__( 'Previous/Next', 'hop-elementor-kit' ),
					'load_more_on_click'        => esc_html__( 'Load on Click', 'hop-elementor-kit' ),
					'load_more_infinite_scroll' => esc_html__( 'Infinite Scroll', 'hop-elementor-kit' ),
				),
				'frontend_available' => true,
			)
		);

		/*$this->add_control(
			'pagination_page_limit',
			array(
				'label'     => esc_html__( 'Page Limit', 'hop-elementor-kit' ),
				'default'   => '5',
				'condition' => array(
					'pagination_type!' => array(
						'load_more_on_click',
						'load_more_infinite_scroll',
						'',
					),
				),
			)
		);*/

		$this->add_control(
			'pagination_numbers_shorten',
			array(
				'label'     => esc_html__( 'Shorten', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => array(
					'pagination_type' => array(
						'numbers',
						'numbers_and_prev_next',
					),
				),
			)
		);

		$this->add_control(
			'pagination_prev_label',
			array(
				'label'     => __( 'Previous Label', 'hop-elementor-kit' ),
				'default'   => __( '&laquo; Previous', 'hop-elementor-kit' ),
				'condition' => array(
					'pagination_type' => array(
						'prev_next',
						'numbers_and_prev_next',
					),
				),
			)
		);

		$this->add_control(
			'pagination_next_label',
			array(
				'label'     => __( 'Next Label', 'hop-elementor-kit' ),
				'default'   => __( 'Next &raquo;', 'hop-elementor-kit' ),
				'condition' => array(
					'pagination_type' => array(
						'prev_next',
						'numbers_and_prev_next',
					),
				),
			)
		);

		$this->add_control(
			'load_more_spinner',
			[
				'label'                  => esc_html__( 'Spinner', 'hop-elementor-kit' ),
				'type'                   => Controls_Manager::ICONS,
				'fa4compatibility'       => 'icon',
				'default'                => [
					'value'   => 'fas fa-spinner',
					'library' => 'fa-solid',
				],
				'exclude_inline_options' => [ 'svg' ],
				'recommended'            => [
					'fa-solid' => [
						'spinner',
						'cog',
						'sync',
						'sync-alt',
						'asterisk',
						'circle-notch',
					],
				],
				'skin'                   => 'inline',
				'label_block'            => false,
				'condition'              => [
					'pagination_type' => [
						'load_more_on_click',
						'load_more_infinite_scroll',
					],
				],
				'frontend_available'     => true,
			]
		);

		$this->add_control(
			'load_more_button_heading',
			[
				'label'     => esc_html__( 'Button', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				],
			]
		);

		$this->add_control(
			'load_more_button_text',
			[
				'label'     => esc_html__( 'Load More Text', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Load More', 'hop-elementor-kit' ),
				'ai'        => [
					'active' => false,
				],
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				],
			]
		);

		$this->add_responsive_control(
			'load_more_align',
			[
				'label'     => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				],
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-archive__loadmore-button' => '--hop-ekits-archive-loadmore-button-justify: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'load_more_selected_icon',
			[
				'label'            => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'condition'        => [
					'pagination_type' => 'load_more_on_click',
				],
			]
		);

		$this->add_control(
			'load_more_icon_align',
			[
				'label'     => esc_html__( 'Icon Position', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => esc_html__( 'Before', 'hop-elementor-kit' ),
					'right' => esc_html__( 'After', 'hop-elementor-kit' ),
				],
				'condition' => [
					'pagination_type'                 => 'load_more_on_click',
					'load_more_selected_icon[value]!' => ''
				],
			]
		);

		$this->add_control(
			'load_more_icon_indent',
			[
				'label'      => esc_html__( 'Icon Spacing', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hop-ekits-archive__loadmore-btn' => '--hop-ekits-archive-loadmore-gap: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'pagination_type'                 => 'load_more_on_click',
					'load_more_selected_icon[value]!' => ''
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_pagination_archive( $class = null ) {
		$this->start_controls_section(
			'section_style_pagination',
			array(
				'label'     => esc_html__( 'Pagination', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pagination_type!' => [
						'load_more_on_click',
						'load_more_infinite_scroll',
						'',
					],
				],
			)
		);
		$this->add_control(
			'pagination_align',
			array(
				'label'     => __( 'Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					"{{WRAPPER}} $class" => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'pagination_type!' => array(
						'load_more_on_click',
						'load_more_infinite_scroll',
						'',
					),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pagination_typography',
				'selector' => '{{WRAPPER}} ' . $class,
				'exclude'  => array(
					'letter_spacing',
					'font_style',
					'text_decoration',
					'line_height',
					'text_transform',
					'word_spacing'
				),
			)
		);

		$this->add_responsive_control(
			'pagination_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					"{{WRAPPER}} $class" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'pagination_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					"{{WRAPPER}} $class .page-numbers:not(.dots)" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_border_style',
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
					"{{WRAPPER}} $class .page-numbers:not(.dots)" => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_border_dimensions',
			array(
				'label'     => esc_html_x( 'Width', 'Border Control', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'condition' => array(
					'pagination_border_style!' => 'none',
				),
				'selectors' => array(
					"{{WRAPPER}} $class  .page-numbers:not(.dots)" => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					"{{WRAPPER}} $class .page-numbers:not(.dots)" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pagination_box_shadow',
				'selector' => "{{WRAPPER}} $class .page-numbers:not(.dots)",
			)
		);
		$this->start_controls_tabs( 'pagination_colors' );

		$this->start_controls_tab(
			'pagination_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'pagination_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"{{WRAPPER}} $class .page-numbers:not(.dots)" => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'pagination_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"{{WRAPPER}} $class .page-numbers:not(.dots)" => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'pagination_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'pagination_border_style!' => 'none',
				),
				'selectors' => array(
					"{{WRAPPER}} $class .page-numbers:not(.dots)" => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_color_hover',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'pagination_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"{{WRAPPER}} $class a.page-numbers:hover,
					{{WRAPPER}} $class .page-numbers.current" => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pagination_hover_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"{{WRAPPER}} $class a.page-numbers:hover,
					{{WRAPPER}} $class .page-numbers.current" => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'pagination_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'pagination_border_style!' => 'none',
				),
				'selectors' => array(
					"{{WRAPPER}} $class a.page-numbers:hover,
					{{WRAPPER}} $class .page-numbers.current" => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'pagination_spacing',
			array(
				'label'     => esc_html__( 'Space Between', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'separator' => 'before',
				'default'   => array(
					'size' => 10,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					"body:not(.rtl) {{WRAPPER}} $class .page-numbers:not(:first-child)" => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
					"body:not(.rtl) {{WRAPPER}} $class .page-numbers:not(:last-child)"  => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
					"body.rtl {{WRAPPER}} $class .page-numbers:not(:first-child)"       => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
					"body.rtl {{WRAPPER}} $class .page-numbers:not(:last-child)"        => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pagination_loadmore_style',
			[
				'label'     => esc_html__( 'Pagination', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pagination_type' => [
						'load_more_on_click',
						'load_more_infinite_scroll',
					],
				],
			]
		);

		$this->add_control(
			'heading_load_more_style_button',
			[
				'label'     => esc_html__( 'Button Load More', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'heading_load_more_style_typography',
				'selector'  => '{{WRAPPER}} .hop-ekits-archive__loadmore-btn',
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				],
			]
		);

		$this->start_controls_tabs( 'load_more_tabs_button_style', [
			'condition' => [
				'pagination_type' => 'load_more_on_click',
			]
		] );

		$this->start_controls_tab(
			'load_more_tab_button_normal',
			[
				'label'     => esc_html__( 'Normal', 'hop-elementor-kit' ),
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				]
			]
		);

		$this->add_control(
			'load_more_button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-archive__loadmore-btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				]
			]
		);

		$this->add_control(
			'load_more_button_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-archive__loadmore-btn' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'load_more_tab_button_hover',
			[
				'label'     => esc_html__( 'Hover', 'hop-elementor-kit' ),
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				],
			]
		);

		$this->add_control(
			'load_more_hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-archive__loadmore-btn:hover, {{WRAPPER}} .hop-ekits-archive__loadmore-btn:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-ekits-archive__loadmore-btn:hover svg, {{WRAPPER}} .hop-ekits-archive__loadmore-btn:focus svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				],
			]
		);

		$this->add_control(
			'load_more_bg_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hop-ekits-archive__loadmore-btn:hover, {{WRAPPER}} .hop-ekits-archive__loadmore-btn:focus' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'load_more_border',
				'selector'  => '{{WRAPPER}} .hop-ekits-archive__loadmore-btn',
				'separator' => 'before',
				'condition' => [
					'pagination_type' => 'load_more_on_click',
				],
			]
		);

		$this->add_control(
			'load_more_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-ekits-archive__loadmore-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'pagination_type' => 'load_more_on_click',
				],
			]
		);

		$this->add_responsive_control(
			'load_more_text_padding',
			[
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-ekits-archive__loadmore-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
				'condition'  => [
					'pagination_type' => 'load_more_on_click',
				],
			]
		);

		$this->add_responsive_control(
			'load_more_margin',
			[
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .hop-ekits-archive__loadmore-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'pagination_type' => 'load_more_on_click',
				],
			]
		);

		$this->end_controls_section();
	}

	// style for button
	protected function register_button_style( string $prefix_name, string $selector ) {
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => "{$prefix_name}_typography",
				'selector' => "{{WRAPPER}} $selector",
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => "{$prefix_name}_border",
				'selector' => "{{WRAPPER}} $selector",
				'exclude'  => [ 'color' ]
			)
		);

		$this->add_responsive_control(
			$prefix_name . '_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					"{{WRAPPER}} $selector" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => $prefix_name . '_button_box_shadow',
				'selector' => "{{WRAPPER}} $selector",
			)
		);

		$this->add_responsive_control(
			"{$prefix_name}_text_padding",
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					"{{WRAPPER}} $selector" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( "tabs_{$prefix_name}_style" );

		$this->start_controls_tab(
			"tab_{$prefix_name}_normal",
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			"{$prefix_name}_button_text_color",
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					"{{WRAPPER}} $selector" => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => "{$prefix_name}_background",
				'label'    => esc_html__( 'Background', 'hop-elementor-kit' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => "{{WRAPPER}} $selector",
			)
		);
		$this->add_control(
			"{$prefix_name}_border_color",
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					"{$prefix_name}_border_border!" => '',
				),
				'selectors' => array(
					"{{WRAPPER}} $selector" => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			"tab_{$prefix_name}_hover",
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			"{$prefix_name}_hover_color",
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"{{WRAPPER}} $selector:hover, {{WRAPPER}} $selector:focus" => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => "{$prefix_name}_button_background_hover",
				'label'    => esc_html__( 'Background', 'hop-elementor-kit' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => "{{WRAPPER}} $selector:hover, {{WRAPPER}} $selector:focus",
			)
		);

		$this->add_control(
			"{$prefix_name}_button_hover_border_color",
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					"{$prefix_name}_border_border!" => '',
				),
				'selectors' => array(
					"{{WRAPPER}} $selector:hover, {{WRAPPER}} $selector:focus" => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	protected function register_style_draw_icon( $condition = null ) {
		$section_args = [
			'label' => esc_html__( 'SVG Draw', 'hop-elementor-kit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		];
		if ( is_array( $condition ) ) {
			$section_args['condition'] = $condition;
		}
		$this->start_controls_section(
			'draw_setting', $section_args
		);

		$this->add_control(
			'svg_path_thickness',
			[
				'label'     => esc_html__( 'Path Thickness', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::NUMBER,
				'step'      => .1,
				'min'       => 0,
				'max'       => 50,
				'selectors' => [
					'{{WRAPPER}} .icon-svg-draw svg path'    => 'stroke-width: {{SIZE}};',
					'{{WRAPPER}} .icon-svg-draw svg circle'  => 'stroke-width: {{SIZE}};',
					'{{WRAPPER}} .icon-svg-draw svg rect'    => 'stroke-width: {{SIZE}};',
					'{{WRAPPER}} .icon-svg-draw svg polygon' => 'stroke-width: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'svg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'selectors' => [
					'{{WRAPPER}}  svg path'   => 'stroke:{{VALUE}};',
					'{{WRAPPER}}  svg circle' => 'stroke:{{VALUE}};',
					'{{WRAPPER}}  svg rect'   => 'stroke:{{VALUE}};',
					'{{WRAPPER}} svg polygon' => 'stroke:{{VALUE}};',
				],
			]
		);
		$this->add_control(
			'svg_fill',
			[
				'label'     => esc_html__( 'SVG Fill Type', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'none',
				'options'   => [
					'none'   => esc_html__( 'None', 'hop-elementor-kit' ),
					'after'  => esc_html__( 'Fill After Draw', 'hop-elementor-kit' ),
					'before' => esc_html__( 'Fill Before Draw', 'hop-elementor-kit' ),
				],
			]
		);
		$this->add_control(
			'svg_fill_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Fill Color', 'hop-elementor-kit' ),
				'selectors' => [
					'{{WRAPPER}}  .fill-svg svg path'                 => 'fill:{{VALUE}};',
					'{{WRAPPER}} .icon-svg-draw.fill-svg svg path'    => 'fill:{{VALUE}};',
					'{{WRAPPER}} .icon-svg-draw.fill-svg svg circle'  => 'fill:{{VALUE}};',
					'{{WRAPPER}} .icon-svg-draw.fill-svg svg rect'    => 'fill:{{VALUE}};',
					'{{WRAPPER}} .icon-svg-draw.fill-svg svg polygon' => 'fill:{{VALUE}};'
				],
				'condition' => [
					'svg_fill!' => 'none'
				]
			]
		);


		$this->add_control(
			'svg_fill_transition',
			[
				'label'       => esc_html__( 'Fill Transition', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'condition'   => [
					'svg_fill!' => 'none'
				],
				'selectors'   => [
					'{{WRAPPER}} .fill-svg svg path' => 'animation-duration: {{SIZE}}s;',
				],
				'description' => esc_html__( 'Duration on SVG fills (in seconds)', 'hop-elementor-kit' )
			]
		);
		$this->add_control(
			'svg_animation_on',
			[
				'label'     => esc_html__( 'Animation', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'page-load',
				'options'   => [
					'none'        => esc_html__( 'None', 'hop-elementor-kit' ),
					'page-load'   => esc_html__( 'On Page Load', 'hop-elementor-kit' ),
					'page-scroll' => esc_html__( 'On Page Scroll', 'hop-elementor-kit' ),
					'hover'       => esc_html__( 'Mouse Hover', 'hop-elementor-kit' ),
				],
				'separator' => 'before'
			]
		);
		$this->add_control(
			'svg_draw_offset',
			[
				'label'       => esc_html__( 'Drawing Start Point', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 1000,
				'step'        => 1,
				'default'     => 50,
				'condition'   => [
					'svg_animation_on' => [ 'page-scroll' ]
				],
				'description' => esc_html__( 'The point at which the drawing begins to animate as scrolls down (in pixels).',
					'hop-elementor-kit' )
			]
		);

		$this->add_control(
			'svg_loop',
			[
				'label'        => esc_html__( 'Repeat Drawing', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'hop-elementor-kit' ),
				'label_off'    => esc_html__( 'No', 'hop-elementor-kit' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'svg_animation_on' => [ 'page-load' ]
				]
			]
		);
		$this->add_control(
			'svg_direction',
			[
				'label'     => esc_html__( 'Direction', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'reverse',
				'options'   => [
					'reverse' => esc_html__( 'Reverse', 'hop-elementor-kit' ),
					'restart' => esc_html__( 'Restart', 'hop-elementor-kit' ),
				],
				'condition' => [
					'svg_animation_on' => [ 'page-load' ]
				]
			]
		);
		$this->add_control(
			'svg_draw_speed',
			[
				'label'     => esc_html__( 'Speed (in ms)', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 300,
				'step'      => 1,
				'default'   => 20,
				'condition' => [
					'svg_animation_on!' => [ 'page-scroll' ]
				],
			]
		);


		$this->end_controls_section();
	}

}
