<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Hop_Ekit_Widget_Course_Item_Nav extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-course-item-nav';
	}

	public function get_title() {
		return esc_html__( 'Course Item Navigation', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-post-navigation';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE_ITEM );
	}

	public function get_help_url() {
		return '';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'show_label',
			array(
				'label'     => esc_html__( 'Show Label', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'hop-elementor-kit' ),
				'label_off' => esc_html__( 'Hide', 'hop-elementor-kit' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'prev_label',
			array(
				'label'     => esc_html__( 'Previous Label', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Previous', 'hop-elementor-kit' ),
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'next_label',
			array(
				'label'     => __( 'Next Label', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Next', 'hop-elementor-kit' ),
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_arrow',
			array(
				'label'     => esc_html__( 'Show Arrows Icon', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'hop-elementor-kit' ),
				'label_off' => esc_html__( 'Hide', 'hop-elementor-kit' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'arrow_left',
			array(
				'label'       => esc_html__( 'Arrows Prev Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'separator'   => 'before',
				'default'     => array(
					'value'   => 'fas fa-angle-left',
					'library' => 'fa-solid',
				),
				'recommended' => array(
					'fa-solid' => array(
						'angle-left',
						'angle-double-left',
						'chevron-left',
						'chevron-circle-left',
						'caret-left',
						'arrow-left',
						'long-arrow-alt-left',
						'arrow-circle-left',
					),
				),
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->add_control(
			'arrow_right',
			array(
				'label'       => esc_html__( 'Arrows Next Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => array(
					'value'   => 'fas fa-angle-right',
					'library' => 'fa-solid',
				),
				'recommended' => array(
					'fa-solid' => array(
						'angle-right',
						'angle-double-right',
						'chevron-right',
						'chevron-circle-right',
						'caret-right',
						'arrow-right',
						'long-arrow-alt-right',
						'arrow-circle-right',
					),
				),
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->add_control(
			'arrow',
			array(
				'label'     => esc_html__( 'Select Icon', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'fa fa-angle-left'          => esc_html__( 'Angle', 'hop-elementor-kit' ),
					'fa fa-angle-double-left'   => esc_html__( 'Double Angle', 'hop-elementor-kit' ),
					'fa fa-chevron-left'        => esc_html__( 'Chevron', 'hop-elementor-kit' ),
					'fa fa-chevron-circle-left' => esc_html__( 'Chevron Circle', 'hop-elementor-kit' ),
					'fa fa-caret-left'          => esc_html__( 'Caret', 'hop-elementor-kit' ),
					'fa fa-arrow-left'          => esc_html__( 'Arrow', 'hop-elementor-kit' ),
					'fa fa-long-arrow-left'     => esc_html__( 'Long Arrow', 'hop-elementor-kit' ),
					'fa fa-arrow-circle-left'   => esc_html__( 'Arrow Circle', 'hop-elementor-kit' ),
					'fa fa-arrow-circle-o-left' => esc_html__( 'Arrow Circle Negative', 'hop-elementor-kit' ),
				),
				'default'   => 'fa fa-angle-left',
				'condition' => array(
					'arrow_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'show_title',
			array(
				'label'     => esc_html__( 'Show Post Title', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'hop-elementor-kit' ),
				'label_off' => esc_html__( 'Hide', 'hop-elementor-kit' ),
				'default'   => 'yes',
			)
		);

		$this->end_controls_section();

		$this->register_style_controls();
	}

	protected function register_style_controls() {
		$this->start_controls_section(
			'section_style_label',
			array(
				'label' => esc_html__( 'Label', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_label_style' );

		$this->start_controls_tab(
			'label_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.hop-ekit-single-course-item__navigation__link__content--label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'label_color_hover',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'label_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.hop-ekit-single-course-item__navigation__link__content--label:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} span.hop-ekit-single-course-item__navigation__link__content--label',
				'exclude'  => array( 'line_height' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			array(
				'label'     => esc_html__( 'Course Title', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_title' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_post_navigation_style' );

		$this->start_controls_tab(
			'tab_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.hop-ekit-single-course-item__navigation__link__content--title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_color_hover',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'hover_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.hop-ekit-single-course-item__navigation__link__content--title:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} span.hop-ekit-single-course-item__navigation__link__content--title',
				'exclude'  => array( 'line_height' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'arrow_style',
			array(
				'label'     => esc_html__( 'Arrow Icon', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_title' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_post_navigation_arrow' );

		$this->start_controls_tab(
			'arrow_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'arrow_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.hop-ekit-single-course-item__navigation__arrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_background_color',
			array(
				'label'     => esc_html__( 'Background', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.hop-ekit-single-course-item__navigation__arrow' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'arrow_color_hover',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'arrow_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.hop-ekit-single-course-item__navigation__arrow:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_background_hover_color',
			array(
				'label'     => esc_html__( 'Background', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.hop-ekit-single-course-item__navigation__arrow:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'arrow_size',
			array(
				'label'     => esc_html__( 'Size', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 6,
						'max' => 300,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-course-item__navigation__arrow' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'arrow_gap',
			array(
				'label'     => esc_html__( 'Gap', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-course-item__navigation__link > a' => 'column-gap: {{SIZE}}{{UNIT}};',
				),
				'range'     => array(
					'em' => array(
						'min' => 0,
						'max' => 5,
					),
				),
			)
		);

		$this->add_control(
			'arrow_size_spacing',
			array(
				'label'     => esc_html__( 'Icon Size', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-course-item__navigation__arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 200,
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'arrow_border',
				'selector' => '{{WRAPPER}} .hop-ekit-single-course-item__navigation__arrow',
			)
		);

		$this->add_responsive_control(
			'arrow_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-single-course-item__navigation__arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'arrow_box_shadow',
				'exclude'  => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} .hop-ekit-single-course-item__navigation__arrow',
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-course-item/before-preview-query' );

		$settings = $this->get_settings_for_display();

		$prev_icon = $settings['arrow_left'];
		$next_icon = $settings['arrow_right'];

		if ( $prev_icon === 'svg' ) {
			$prev_icon_html = Icons_Manager::render_uploaded_svg_icon( $prev_icon['value'] );
		} else {
			$prev_icon_html = Icons_Manager::render_font_icon( $prev_icon );
		}

		if ( $next_icon === 'svg' ) {
			$next_icon_html = Icons_Manager::render_uploaded_svg_icon( $next_icon['value'] );
		} else {
			$next_icon_html = Icons_Manager::render_font_icon( $next_icon );
		}

		$course = learn_press_get_course();

		if ( ! $course ) {
			return;
		}

		$next_item = false;
		$prev_item = false;

		$next_id = $course->get_next_item();
		$prev_id = $course->get_prev_item();

		if ( $next_id ) {
			$next_item = $course->get_item( $next_id );
			if ( $next_item instanceof \LP_Course_Item ) {
				$next_item->set_course( $course->get_id() );
			}
		}

		if ( $prev_id ) {
			$prev_item = $course->get_item( $prev_id );
			if ( $prev_item instanceof \LP_Course_Item ) {
				$prev_item->set_course( $course->get_id() );
			}
		}

		if ( ! $prev_item && ! $next_item ) {
			return;
		}
		?>

		<div class="hop-ekit-single-course-item__navigation">
			<div class="hop-ekit-single-course-item__navigation__prev hop-ekit-single-course-item__navigation__link">
				<?php
				if ( $prev_item ) : ?>
					<a href="<?php
					echo esc_url_raw( $prev_item->get_permalink() ); ?>" rel="prev">
						<?php
						if ( 'yes' === $settings['show_arrow'] ) : ?>
							<span
								class="hop-ekit-single-course-item__navigation__arrow hop-ekit-single-course-item__navigation__arrow--prev">
								<?php
								echo wp_kses_post( $prev_icon_html ); ?>
								<span class="elementor-screen-only">
									<?php
									echo esc_html__( 'Prev', 'hop-elementor-kit' ); ?>
								</span>
							</span>
						<?php
						endif; ?>

						<span class="hop-ekit-single-course-item__navigation__link__content">
							<?php
							if ( 'yes' === $settings['show_label'] ) : ?>
								<span class="hop-ekit-single-course-item__navigation__link__content--label">
									<?php
									echo esc_html( $settings['prev_label'] ); ?>
								</span>
							<?php
							endif; ?>

							<?php
							if ( 'yes' === $settings['show_title'] ) : ?>
								<span class="hop-ekit-single-course-item__navigation__link__content--title">
									<?php
									echo esc_html( $prev_item->get_title() ); ?>
								</span>
							<?php
							endif; ?>
						</span>
					</a>
				<?php
				endif; ?>
			</div>

			<div class="hop-ekit-single-course-item__navigation__next hop-ekit-single-course-item__navigation__link">
				<?php
				if ( $next_item ) : ?>
					<a href="<?php
					echo esc_url_raw( $next_item->get_permalink() ); ?>" rel="next">
						<span class="hop-ekit-single-course-item__navigation__link__content">
							<?php
							if ( 'yes' === $settings['show_label'] ) : ?>
								<span class="hop-ekit-single-course-item__navigation__link__content--label">
									<?php
									echo esc_html( $settings['next_label'] ); ?>
								</span>
							<?php
							endif; ?>

							<?php
							if ( 'yes' === $settings['show_title'] ) : ?>
								<span class="hop-ekit-single-course-item__navigation__link__content--title">
									<?php
									echo esc_html( $next_item->get_title() ); ?>
								</span>
							<?php
							endif; ?>
						</span>

						<?php
						if ( 'yes' === $settings['show_arrow'] ) : ?>
							<span
								class="hop-ekit-single-course-item__navigation__arrow hop-ekit-single-course-item__navigation__arrow--next">
								<?php
								echo wp_kses_post( $next_icon_html ); ?>
								<span class="elementor-screen-only">
									<?php
									echo esc_html__( 'Next', 'hop-elementor-kit' ); ?>
								</span>
							</span>
						<?php
						endif; ?>
					</a>
				<?php
				endif; ?>
			</div>
		</div>

		<?php
		do_action( 'hop-ekit/modules/single-course-item/after-preview-query' );
	}
}
